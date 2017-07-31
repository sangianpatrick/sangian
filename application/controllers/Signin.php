<?php
class Signin extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('M_signin');
	}

	public function index(){
		if ($this->session->userdata('sess_status') === TRUE) {
			switch ($_SESSION['sess_userlevel']) {
				case '1':
					redirect('admin/dashboard');
					break;

				case '2':
					redirect('lecturer/dashboard');
					break;

				case '3':
					redirect('student/dashboard');
					break;
			}
		} else {
			$csrf = [
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
			];
			//print_r($csrf);
			$this->load->view('signin',$csrf);
		}
	}

	public function user_auth(){
		if ($this->session->userdata('sess_status') === TRUE) {
			switch ($_SESSION['sess_userlevel']) {
				case '1':
					redirect('admin/dashboard');
					break;

				case '2':
					redirect('lecturer/dashboard');
					break;

				case '3':
					redirect('student/dashboard');
					break;
			}
		} else {
			$username = $_POST['username'];
			$password = $_POST['password'];
			$validation = $this->M_signin->authentication($username,$password);
			if ($validation) {
				switch ($validation->user_level) {
					case '1':
						$get_userdata_ts = $this->M_signin->get_userdata_ts($username);
						$signin_data  = [
							'sess_nip'      => $get_userdata_ts->ts_nip,
							'sess_fullname' => $get_userdata_ts->ts_lastname.', '.$get_userdata_ts->ts_firstname,
							'sess_userlevel'=> $validation->user_level,
							'sess_role'		=> $get_userdata_ts->ts_role,
							'sess_gender'   => $get_userdata_ts->ts_gender,
							'sess_status'   => TRUE,
						];
						$this->session->set_userdata($signin_data);
						redirect('admin/dashboard');
						break;

					case '2':
						$get_userdata_ts = $this->M_signin->get_userdata_ts($username);
						$signin_data  = [
							'sess_nip'      => $get_userdata_ts->ts_nip,
							'sess_fullname' => $get_userdata_ts->ts_lastname.', '.$get_userdata_ts->ts_firstname,
							'sess_userlevel'=> $validation->user_level,
							'sess_role'		=> $get_userdata_ts->ts_role,
							'sess_gender'   => $get_userdata_ts->ts_gender,
							'sess_status'   => TRUE,
						];
						$this->session->set_userdata($signin_data);
						redirect('lecturer/dashboard');
						break;

					case '3':
						$get_userdata_stud = $this->M_signin->get_userdata_stud($username);
						$signin_data  = [
							'sess_nim'      => $get_userdata_stud->stud_nim,
							'sess_fullname' => $get_userdata_stud->stud_lastname.', '.$get_userdata_stud->stud_firstname,
							'sess_userlevel'=> $validation->user_level,
							'sess_gender'   => $get_userdata_stud->stud_gender,
							'sess_status'   => TRUE,
						];
						$this->session->set_userdata($signin_data);
						redirect('student/dashboard');
						break;
				}
			} else{
				$this->session->set_flashdata('signin','error');
				redirect(base_url());
			}
		}
		
	}
}