<?php
class Signout extends CI_Controller{
	public function index(){
		session_destroy();
		redirect(base_url());
	}
}