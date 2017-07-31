<?php
class M_signin extends CI_Model{
	public function authentication($username,$password){
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('user_username', $username);
		$this->db->where('user_password', md5($password));
		$this->db->where('user_status', 1);
		
		$query = $this->db->get();
		
		if($query->num_rows() > 0) {
			return $query->row();
		}
		
		return NULL;
	}

	public function get_userdata_ts($username){
		$this->db->select('*');
		$this->db->from('teacher_staff');
		$this->db->where('ts_nip', $username);
		
		$query = $this->db->get();
		
		if($query->num_rows() > 0) {
			return $query->row();
		}
		
		return NULL;
	}

	public function get_userdata_stud($username){
		$this->db->select('*');
		$this->db->from('student');
		$this->db->where('stud_nim', $username);
		
		$query = $this->db->get();
		
		if($query->num_rows() > 0) {
			return $query->row();
		}
		
		return NULL;
	}
}