<?php
class M_manage_stud extends CI_Model{
	public function get_all_stud(){
		$return = array();
		$this->db->select("*");
		$this->db->from("student");
		$this->db->join('user',"user.user_username = student.stud_nim");

		$query = $this->db->get();

		 if ($query->num_rows()>0) {
		 	foreach ($query->result() as $row) {
		 		array_push($return, $row);
			}
		}
		return $return;
	}

	public function check_acc($acc){
		$this->db->select('stud_id');
		$this->db->from('student');
		$this->db->where('stud_nim', $acc);
		//$this->db->where('USER_STTS', 1);
		
		$query = $this->db->get();
		
		if($query->num_rows() > 0) {
			return $query->row();
		}
		
		return NULL;
	}

	public function add_stud($tbl1,$tbl2,$data1,$data2){
		$this->db->insert($tbl1, $data1);
		$this->db->insert($tbl2, $data2);
	}

	public function update_stud($tbl,$data,$nim){
		$this->db->where('stud_nim', $nim); 
		$this->db->update($tbl, $data); 
	}

	public function activation_stud($tbl,$data,$nim){
		$this->db->where('user_username', $nim); 
		$this->db->update($tbl, $data); 
	}
}