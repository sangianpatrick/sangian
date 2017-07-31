<?php
class Post_defense extends CI_Controller{
	function __construct(){
		parent::__construct();
    $this->load->model('M_hop');
	}

	public function index(){
		if ($this->session->userdata('sess_status') === TRUE && $this->session->userdata('sess_userlevel') === '1') {
			$data = [
				'title' => "NursingRP | Admin's View Thesis",
				'page'  => "View Thesis",
        'all_thesis' => $this->M_hop->get_defense_thesis(),
			];
			$this->load->view('admin/view_thesis',$data);
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
