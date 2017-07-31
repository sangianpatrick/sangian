<?php
class Defense_schedule extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('M_student');
		$this->load->model('M_hop');
	}

	public function index(){
		if ($this->session->userdata('sess_status') === TRUE && $this->session->userdata('sess_userlevel') === '3') {
			$data = [
				'title' => "NursingRP | Student's Defense Schedule",
				'page'  => "Defense Schedule",
				'check_sub' => $this->M_student->check_sub(),
				'schedule' =>$this->M_student->get_sch()
			];
			$this->load->view('student/defense_schedule',$data);
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