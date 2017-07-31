<?php
class Rp_submission extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('M_manage_ls');
		$this->load->model('M_student');
	}

	public function index(){
		if ($this->session->userdata('sess_status') === TRUE && $this->session->userdata('sess_userlevel') === '3') {

			$data = [
				'title' => "NursingRP | Submission of RP's Topic & Features",
				'page'  => "Topic's Submission",
				'lecturer' => $this->M_student->get_all_ts(),
				'check_sub' => $this->M_student->check_sub()
			];
			$this->load->view('student/rp_submission',$data);
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

	public function send(){
		if ($this->session->userdata('sess_status') === TRUE && $this->session->userdata('sess_userlevel') === '3') {

			$submission = [
				'tt_topic' => $_POST['tt_topic'],
				'tt_title' => $_POST['tt_title'],
				'tt_desc'  => $_POST['tt_desc'],
				'tt_advisory' => $_POST['tt_advisory'],
				'tt_submitted_by' => $_SESSION['sess_nim']
			];

			$this->M_student->tt_submission($submission);
			redirect('student/rp_submission');
			
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

	public function resend(){
		if ($this->session->userdata('sess_status') === TRUE && $this->session->userdata('sess_userlevel') === '3') {

			$submission = [
				'tt_topic' => $_POST['tt_topic'],
				'tt_title' => $_POST['tt_title'],
				'tt_desc'  => $_POST['tt_desc'],
				'tt_correct' => 0
			];

			$this->M_student->tt_resub($submission,$_GET['id']);
			redirect('student/rp_submission');
			
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
}
