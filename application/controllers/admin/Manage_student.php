<?php
class Manage_student extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('M_manage_stud');
	}

	public function index(){
		if ($this->session->userdata('sess_status') === TRUE && $this->session->userdata('sess_userlevel') === '1') {
			$data = [
				'title' => "NursingRP | Admin's Managing Student",
				'page'  => "Manage Student",
				'stud_list'  => $this->M_manage_stud->get_all_stud()
			];
			$this->load->view('admin/manage_student',$data);
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
			$checking = $this->M_manage_stud->check_acc($_POST['acc']);
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
				'stud_nim' => $_POST['stud_nim'],
				'stud_firstname' => $_POST['stud_firstname'],
				'stud_lastname' => $_POST['stud_lastname'],
				'stud_gender'   => $_POST['stud_gender'],
				'stud_phone'	=> $_POST['stud_phone'],
				'stud_email'	=> $_POST['stud_email'],
				'stud_address'  => $_POST['stud_address']
			];
			$usr_data = [
				'user_username' => $_POST['stud_nim'],
				'user_password' => do_hash($_POST['stud_nim'],'md5'),
				'user_level'    => '3',
			];
			$this->M_manage_stud->add_stud('student','user',$add_data,$usr_data);
			$this->session->set_flashdata('stud','succ_add');
			redirect('admin/manage_student');
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
				'stud_firstname' => $_POST['stud_firstname'],
				'stud_lastname' => $_POST['stud_lastname'],
				'stud_gender'   => $_POST['stud_gender'],
				'stud_phone'	=> $_POST['stud_phone'],
				'stud_email'	=> $_POST['stud_email'],
				'stud_address'  => $_POST['stud_address']
			];
			$this->M_manage_stud->update_stud('student',$updt_data,$_GET['nim']);
			$this->session->set_flashdata('stud','succ_updt');
			redirect('admin/manage_student');
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
			$this->M_manage_stud->activation_stud('user',$updt_data,$_GET['nim']);
			$this->session->set_flashdata('stud','succ_inactv');
			redirect('admin/manage_student');
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
			$this->M_manage_stud->activation_stud('user',$updt_data,$_GET['nim']);
			$this->session->set_flashdata('stud','succ_actv');
			redirect('admin/manage_student');
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