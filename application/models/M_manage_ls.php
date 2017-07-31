<?php
class M_manage_ls extends CI_Model{
	public function get_all_ts(){
		$return = array();
		$this->db->select("*");
		$this->db->from("teacher_staff");
		$this->db->join('user',"user.user_username = teacher_staff.ts_nip");

		$query = $this->db->get();

		if ($query->num_rows()>0) {
		 	foreach ($query->result() as $row) {
		 		array_push($return, $row);
			}
		}
		return $return;
	}

	public function check_acc($acc){
		$this->db->select('ts_id');
		$this->db->from('teacher_staff');
		$this->db->where('ts_nip', $acc);
		//$this->db->where('USER_STTS', 1);
		
		$query = $this->db->get();
		
		if($query->num_rows() > 0) {
			return $query->row();
		}
		
		return NULL;
	}

	public function add_ts($tbl1,$tbl2,$data1,$data2){
		$this->db->insert($tbl1, $data1);
		$this->db->insert($tbl2, $data2);
	}

	public function update_ts($tbl,$data,$nip){
		$this->db->where('ts_nip', $nip); 
		$this->db->update($tbl, $data); 
	}

	public function activation_ts($tbl,$data,$nip){
		$this->db->where('user_username', $nip); 
		$this->db->update($tbl, $data); 
	}
}