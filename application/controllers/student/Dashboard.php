<?php
class Dashboard extends CI_Controller{
	function __construct(){
		parent::__construct();
	}

	public function index(){
		if ($this->session->userdata('sess_status') === TRUE && $this->session->userdata('sess_userlevel') === '3') {
			$data = [
				'title' => "NursingRP | Student's Dashboard",
				'page'  => "Dashboard"
			];
			$this->load->view('student/dashboard',$data);
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