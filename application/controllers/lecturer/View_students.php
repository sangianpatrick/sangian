<?php
class View_students extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('M_manage_stud');
	}

	public function index(){
		if ($this->session->userdata('sess_status') === TRUE && $this->session->userdata('sess_userlevel') === '2' && ($this->session->userdata('sess_role') === '1'||$this->session->userdata('sess_role') === '2')) {
			$data = [
				'title' => "NursingRP | Lecturer's View Students",
				'page'  => "All Student",
				'stud_list'  => $this->M_manage_stud->get_all_stud()
			];
			$this->load->view('lecturer/view_students',$data);
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
