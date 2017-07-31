<?php 
class M_student extends CI_Model{

	public function get_all_ts(){
		$return = array();
		$this->db->select("*");
		$this->db->from("teacher_staff");
		$this->db->join('user',"user.user_username = teacher_staff.ts_nip");
		$this->db->where('user.user_status',1);
		$this->db->where('user.user_level ',2);
		$this->db->where('ts_role !=',4);


		$query = $this->db->get();

		if ($query->num_rows()>0) {
		 	foreach ($query->result() as $row) {
		 		array_push($return, $row);
			}
		}
		return $return;
	}

	public function check_sub(){
		$this->db->select('*');
		$this->db->from('tmp_thesis');
		$this->db->where('tt_submitted_by', $_SESSION['sess_nim']);
		
		$query = $this->db->get();
		
		if($query->num_rows() > 0) {
			return $query->row();
		}
		
		return NULL;
	}

	public function tt_submission($data){
		$this->db->insert('tmp_thesis', $data);
	}
	public function tt_resub($data,$id){
		$this->db->where('tt_id', $id); 
		$this->db->update('tmp_thesis', $data); 
	}

	public function get_sch(){
		$this->db->select("approved_thesis.*, concat(teacher_staff.ts_lastname, ', ', teacher_staff.ts_firstname) as ts_fullname, teacher_staff.ts_gender, defense_schedule.ds_id, defense_schedule.ds_date, defense_schedule.ds_time, defense_schedule.ds_room");
		$this->db->from("approved_thesis");
		$this->db->join('teacher_staff','teacher_staff.ts_nip = approved_thesis.at_advisory');
		$this->db->join('defense_schedule', 'defense_schedule.at_id = approved_thesis.at_id');
		$this->db->where('approved_thesis.at_conducted_by',$_SESSION['sess_nim']);

		$query = $this->db->get();
		
		if($query->num_rows() > 0) {
			return $query->row();
		}
		
		return NULL;
	}
}