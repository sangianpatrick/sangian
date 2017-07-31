<?php
class Manage_lecturer_staff extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('M_manage_ls');
	}

	public function index(){
		if ($this->session->userdata('sess_status') === TRUE && $this->session->userdata('sess_userlevel') === '1') {
			$data = [
				'title' => "NursingRP | Admin's Managing Lecturer & Staff",
				'page'  => "Manage Lecturer & Staff",
				'ts_list'  => $this->M_manage_ls->get_all_ts(),
			];
			$this->load->view('admin/manage_lecturer_staff',$data);
		} else {
			$url = 'http://localhost/fikep-thesis/';
			$error_data = [
				'icon'     => '<link rel="shortcut icon" href="<?php echo base_url();?>assets/logo.ico" />',
				'heading'  => "Error Page 404",
				'message'  => "&nbsp Sorry, You are not authorized to access this page. <br> &nbsp >> &nbsp <a  href='".$url."'>Go to sign in page</a>",
			];

			$this->load->view('errors/html/error_404', $error_data);
		}
	}

	function check_acc(){
		if ($this->session->userdata('sess_status') === TRUE && $this->session->userdata('sess_userlevel') === '1') {
			$checking = $this->M_manage_ls->check_acc($_POST['acc']);
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

	public function add(){
		if ($this->session->userdata('sess_status') === TRUE && $this->session->userdata('sess_userlevel') === '1') {
			$add_data = [
				'ts_nip' => $_POST['ts_nip'],
				'ts_firstname' => $_POST['ts_firstname'],
				'ts_lastname' => $_POST['ts_lastname'],
				'ts_gender'   => $_POST['ts_gender'],
				'ts_role'   => $_POST['ts_role'],
				'ts_phone'	=> $_POST['ts_phone'],
				'ts_email'	=> $_POST['ts_email'],
				'ts_address'  => $_POST['ts_address']
			];
			$usr_data = [
				'user_username' => $_POST['ts_nip'],
				'user_password' => do_hash($_POST['ts_nip'],'md5'),
				'user_level'    => '2',
			];
			$this->M_manage_ls->add_ts('teacher_staff','user',$add_data,$usr_data);
			$this->session->set_flashdata('ts','succ_add');
			redirect('admin/manage_lecturer_staff');
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

	public function update(){
		if ($this->session->userdata('sess_status') === TRUE && $this->session->userdata('sess_userlevel') === '1') {
			$updt_data = [
				'ts_firstname' => $_POST['ts_firstname'],
				'ts_lastname' => $_POST['ts_lastname'],
				'ts_gender'   => $_POST['ts_gender'],
				'ts_role'   => $_POST['ts_role'],
				'ts_phone'	=> $_POST['ts_phone'],
				'ts_email'	=> $_POST['ts_email'],
				'ts_address'  => $_POST['ts_address']
			];
			$this->M_manage_ls->update_ts('teacher_staff',$updt_data,$_GET['nip']);
			$this->session->set_flashdata('ts','succ_updt');
			redirect('admin/manage_lecturer_staff');
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

	public function inactivate(){
		if ($this->session->userdata('sess_status') === TRUE && $this->session->userdata('sess_userlevel') === '1') {
			$updt_data = [
				'user_status' => 0 
			];
			$this->M_manage_ls->activation_ts('user',$updt_data,$_GET['nip']);
			$this->session->set_flashdata('ts','succ_inactv');
			redirect('admin/manage_lecturer_staff');
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

	public function activate(){
		if ($this->session->userdata('sess_status') === TRUE && $this->session->userdata('sess_userlevel') === '1') {
			$updt_data = [
				'user_status' => 1 
			];
			$this->M_manage_ls->activation_ts('user',$updt_data,$_GET['nip']);
			$this->session->set_flashdata('ts','succ_actv');
			redirect('admin/manage_lecturer_staff');
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