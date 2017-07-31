<?php
class Test extends CI_Controller{
	public function index(){
		$n = $_GET['nilai'];
		if ($n <= 7) {
			echo "F";
		}elseif ($n>=8 && $n<=11) {
			echo "D-";
		}
	}
}