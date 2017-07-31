<?php
class Research_project extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('M_hop');
	}

	public function index(){
		if ($this->session->userdata('sess_status') === TRUE && $this->session->userdata('sess_userlevel') === '2' && $this->session->userdata('sess_role')=== '2') {
			$data = [
				'title' => "NursingRP | Student's Research Project",
				'page'  => "Student's Research Project"
			];
			$this->load->view('lecturer/research_project',$data);
		} else {
			$url = 'http://localhost/fikep-thesis/';
			$error_data = [
				'icon'     => '<link rel="shortcut icon" href="<?php echo base_url();?>assets/logo.ico" />',
				'heading'  => "Error Page 404",
				'message'  => "&nbsp Sorry, You are not authorized to access this page. <br> &nbsp >> &nbsp <a  href='".$url."'>Go to sign in page</a>"
			];

			$this->load->view('errors/html/error_404', $error_data);
		}
	}

	public function apprentices(){
		if ($this->session->userdata('sess_status') === TRUE && $this->session->userdata('sess_userlevel') === '2' && $this->session->userdata('sess_role') != '4') {
			$data = [
				'title' => "NursingRP | My Apprentices",
				'page'  => "My Apprentices",
				'apprentices' => $this->M_hop->get_my_apprentices(),
			];
			$this->load->view('lecturer/my_apprentices',$data);
		} else {
			$url = 'http://localhost/fikep-thesis/';
			$error_data = [
				'icon'     => '<link rel="shortcut icon" href="<?php echo base_url();?>assets/logo.ico" />',
				'heading'  => "Error Page 404",
				'message'  => "&nbsp Sorry, You are not authorized to access this page. <br> &nbsp >> &nbsp <a  href='".$url."'>Go to sign in page</a>"
			];

			$this->load->view('errors/html/error_404', $error_data);
		}
	}

	public function submission(){
		if ($this->session->userdata('sess_status') === TRUE && $this->session->userdata('sess_userlevel') === '2' && $this->session->userdata('sess_role')=== '2') {
			if (!empty($_GET['id']) && !empty($_GET['action'])) {
				if ($_GET['action'] == 1) {
					$data = [
						'tt_comment' => $_POST['tt_comment'],
						'tt_approval' => 1,
						'tt_correct'  => 1
					];

					$this->M_hop->update_tbl('tmp_thesis',$_GET['id'],$data);
				}elseif ($_GET['action'] == 2) {
					$data = [
						'tt_comment' => $_POST['tt_comment'],
						'tt_approval' => 2
					];
					$this->M_hop->update_tbl('tmp_thesis',$_GET['id'],$data);
				}
				redirect('lecturer/research_project/submission');
			}else {
				$data = [
					'title' => "NursingRP | Topic's Submission",
					'page'  => "Topic's Submission",
					'submission' => $this->M_hop->get_all_submission()
				];

				$this->load->view('lecturer/topic_submission',$data);
			}
		} else {
			$url = 'http://localhost/fikep-thesis/';
			$error_data = [
				'icon'     => '<link rel="shortcut icon" href="<?php echo base_url();?>assets/logo.ico" />',
				'heading'  => "Error Page 404",
				'message'  => "&nbsp Sorry, You are not authorized to access this page. <br> &nbsp >> &nbsp <a  href='".$url."'>Go to sign in page</a>"
			];

			$this->load->view('errors/html/error_404', $error_data);
		}
	}

	public function defense_schedule(){
		if ($this->session->userdata('sess_status') === TRUE && $this->session->userdata('sess_userlevel') === '2' && ($this->session->userdata('sess_role')=== '1' || $this->session->userdata('sess_role')=== '2')) {
			if (isset($_GET['action']) == 'create') {
				$schedule = [
					'ds_date'  => $_POST['ds_date'],
					'ds_time'  => date('H:i:s', strtotime($_POST['ds_time'])),
					'ds_room'  => $_POST['ds_room'],
					'at_id'    => $_GET['atid']
				];
				$this->M_hop->create_sch($schedule);
				$last = $this->M_hop->retrieve("SELECT MAX(ds_id) AS id FROM defense_schedule");
				if ($last) {
					$pan1=[
						'pan_type' => '1',
						'ds_id' => $last->id,
						'ts_nip' => $_POST['ds_panelist1']
					];

					$pan2=[
						'pan_type' => '2',
						'ds_id' => $last->id,
						'ts_nip' => $_POST['ds_panelist2']
					];
					$this->M_hop->add_pan($pan1,$pan2);
				}
				redirect('lecturer/research_project/defense_schedule','refresh');
			}else {
				$data = [
					'title' => "NursingRP | Defense Schedule",
					'page'  => "Defense Schedule",
					'scheduled' => $this->M_hop->get_all_schedule(),
					'unscheduled' => $this->M_hop->get_all_unschedule(),
					'panelists' => $this->M_hop->get_all_panelist()

				];
				$this->load->view('lecturer/defense_schedule',$data);
			}
		} else {
			$url = 'http://localhost/fikep-thesis/';
			$error_data = [
				'icon'     => '',
				'heading'  => "Error Page 404",
				'message'  => "&nbsp Sorry, You are not authorized to access this page. <br> &nbsp >> &nbsp <a  href='".$url."'>Go to sign in page</a>"
			];

			$this->load->view('errors/html/error_404', $error_data);
		}
	}

	public function check_panelist(){
		if ($this->session->userdata('sess_status') === TRUE && $this->session->userdata('sess_userlevel') === '2' && $this->session->userdata('sess_role')=== '2') {

			$checking = $this->M_hop->check_panelist($_POST['pan'],$_POST['date'],date('H:i:s', strtotime($_POST['time'])));
			if ($checking) {
				echo json_encode(array('status'=>1));
			}else{
				echo json_encode(array('status'=>0));
			}
		} else {
			$url = 'http://localhost/fikep-thesis/';
			$error_data = [
				'icon'     => '<link rel="shortcut icon" href="<?php echo base_url();?>assets/logo.ico" />',
				'heading'  => "Error Page 404",
				'message'  => "&nbsp Sorry, You are not authorized to access this page. <br> &nbsp >> &nbsp <a  href='".$url."'>Go to sign in page</a>"
			];

			$this->load->view('errors/html/error_404', $error_data);
		}
	}

	public function scoring_session(){
		if ($_SESSION['sess_status'] === TRUE && $_SESSION['sess_userlevel'] == 2 && $_SESSION['sess_role'] == 1 ) {
			if($_GET['type'] == 1){
				$sql = "UPDATE defense_schedule SET ds_scoring_sess=1 WHERE ds_id=".$_GET['id'];
			}elseif ($_GET['type'] == 0) {
				$sql = "UPDATE defense_schedule SET ds_scoring_sess=2 WHERE ds_id=".$_GET['id'];
			}
			echo $sql;
			$this->M_hop->run_query($sql);
			redirect(site_url('lecturer/research_project/defense_schedule'));
		}else {
			$url = 'http://localhost/fikep-thesis/';
			$error_data = [
				'icon'     => '',
				'heading'  => "Error Page 404",
				'message'  => "&nbsp Sorry, You are not authorized to access this page. <br> &nbsp >> &nbsp <a  href='".$url."'>Go to sign in page</a>"
			];

			$this->load->view('errors/html/error_404', $error_data);
		}
	}

	public function scoring_form(){
		if ($_SESSION['sess_status'] === TRUE && $_SESSION['sess_userlevel'] == 2 && $_SESSION['sess_role'] != 4 ) {
			if (!$this->M_hop->checkp($_GET['tid'])) {
				$url = 'http://localhost/fikep-thesis/';
				$error_data = [
					'icon'     => '',
					'heading'  => "Error Page 404",
					'message'  => "&nbsp Sorry, You are not authorized to access this page. <br> &nbsp >> &nbsp <a  href='".$url."'>Go to sign in page</a>"
				];

				$this->load->view('errors/html/error_404', $error_data);
			}else{
				$data = [
					'title' => "NursingRP | Scoring Form",
					'page' => "Scoring Form",
					'cntnt' => $this->M_hop->get_definfo_by($_GET['tid'])
				];
				$this->load->view('lecturer/scoring',$data);
			}

		}else {
			$url = 'http://localhost/fikep-thesis/';
			$error_data = [
				'icon'     => '',
				'heading'  => "Error Page 404",
				'message'  => "&nbsp Sorry, You are not authorized to access this page. <br> &nbsp >> &nbsp <a  href='".$url."'>Go to sign in page</a>"
			];

			$this->load->view('errors/html/error_404', $error_data);
		}
	}

	public function panelist(){
		if ($_SESSION['sess_status'] === TRUE && $_SESSION['sess_userlevel'] == 2 && $_SESSION['sess_role'] != 4 ) {
			$data = [
				'title' => "NursingRP | Panelist Schedule",
				'page' => "Panelist Schedule",
				'scheduled' => $this->M_hop->get_pan_sch(),
			];
			$this->load->view('lecturer/panelist_schedule',$data);
		}else {
			$url = 'http://localhost/fikep-thesis/';
			$error_data = [
				'icon'     => '',
				'heading'  => "Error Page 404",
				'message'  => "&nbsp Sorry, You are not authorized to access this page. <br> &nbsp >> &nbsp <a  href='".$url."'>Go to sign in page</a>"
			];

			$this->load->view('errors/html/error_404', $error_data);
		}
	}

	public function calculate(){
		if ($_SESSION['sess_status'] === TRUE && $_SESSION['sess_userlevel'] == 2 && $_SESSION['sess_role'] != 4 ) {
			if ($_GET['acceptance'] == 1) {
				$value = [
					'dr_jp' => (int)$_POST['jp'],
					'dr_lb' => (int)$_POST['lb'],
					'dr_rm' => (int)$_POST['rm'],
					'dr_tp' => (int)$_POST['tp'],
					'dr_mp' => (int)$_POST['mp'],
					'dr_tip' => (int)$_POST['tip'],
					'dr_kk' => (int)$_POST['kk'],
					'dr_hi' => (int)$_POST['hi'],
					'dr_mep' => (int)$_POST['mep'],
					'dr_pdp' => (int)$_POST['pdp'],
					'dr_pre' => (int)$_POST['pre'],
					'dr_pm' => (int)$_POST['pm'],
					'dr_fp' => (int)$_POST['fp']
				];
				$jml = array_sum($value);

				$points = [
					'dr_jp' => $_POST['jp'],
					'dr_lb' => $_POST['lb'],
					'dr_rm' => $_POST['rm'],
					'dr_tp' => $_POST['tp'],
					'dr_mp' => $_POST['mp'],
					'dr_tip' => $_POST['tip'],
					'dr_kk' => $_POST['kk'],
					'dr_hi' => $_POST['hi'],
					'dr_mep' => $_POST['mep'],
					'dr_pdp' => $_POST['pdp'],
					'dr_pre' => $_POST['pre'],
					'dr_pm' => $_POST['pm'],
					'dr_fp' => $_POST['fp'],
					'dr_total' => $jml,
					'dr_desc' => $_POST['ket'],
					'dr_status' => $_POST['reko'],
					'dr_tc' => $_POST['up'],
					'at_id' => $_GET['tid'],
					'pan_type' => $_GET['pantype'],
					'ts_nip' => $_SESSION['sess_nip'],
				];

				$this->M_hop->submit_point($points);
			}elseif ($_GET['acceptance'] == 0) {

				$points = [
					'dr_jp' => 0,
					'dr_lb' => 0,
					'dr_rm' => 0,
					'dr_tp' => 0,
					'dr_mp' => 0,
					'dr_tip' => 0,
					'dr_kk' => 0,
					'dr_hi' => 0,
					'dr_mep' => 0,
					'dr_pdp' => 0,
					'dr_pre' => 0,
					'dr_pm' => 0,
					'dr_fp' => 0,
					'dr_desc' =>'---',
					'dr_status' => 0,
					'dr_tc' => '---',
					'at_id' => $_GET['tid'],
					'pan_type' => $_GET['pantype'],
					'ts_nip' => $_SESSION['sess_nip'],
				];
				$this->M_hop->submit_point($points);

			}else{
				$url = 'http://localhost/fikep-thesis/';
				$error_data = [
					'icon'     => '',
					'heading'  => "Error Page 404",
					'message'  => "&nbsp Sorry, You are not authorized to access this page. <br> &nbsp >> &nbsp <a  href='".$url."'>Go to sign in page</a>"
				];

				$this->load->view('errors/html/error_404', $error_data);
			}
			$url = 'http://localhost/fikep-thesis/';
			$error_data = [
				'icon'     => '',
				'heading'  => "Success",
				'message'  => "&nbsp Please wait until the Dean close the scoring session.Thank you. <br> &nbsp >> &nbsp <a  href='".$url."'>Go to home page</a>"
			];

			$this->load->view('errors/html/error_404', $error_data);

		}else {
			$url = 'http://localhost/fikep-thesis/';
			$error_data = [
				'icon'     => '',
				'heading'  => "Error Page 404",
				'message'  => "&nbsp Sorry, You are not authorized to access this page. <br> &nbsp >> &nbsp <a  href='".$url."'>Go to sign in page</a>"
			];

			$this->load->view('errors/html/error_404', $error_data);
		}
	}
}
