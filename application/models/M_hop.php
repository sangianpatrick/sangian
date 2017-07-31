<?php
class M_hop extends CI_Model{
	public function get_all_submission(){
		$return = array();
		$this->db->select("tmp_thesis.*, concat(student.stud_lastname, ', ', student.stud_firstname) as stud_fullname, concat(teacher_staff.ts_lastname, ', ', teacher_staff.ts_firstname) as ts_fullname, teacher_staff.ts_gender");
		$this->db->from("tmp_thesis");
		$this->db->where("tmp_thesis.tt_approval !=",2);
		//$this->db->where("tmp_thesis.tt_correction =",1);
		$this->db->join('student','student.stud_nim = tmp_thesis.tt_submitted_by');
		$this->db->join('teacher_staff','teacher_staff.ts_nip = tmp_thesis.tt_advisory');

		$query = $this->db->get();

		 if ($query->num_rows()>0) {
		 	foreach ($query->result() as $row) {
		 		array_push($return, $row);
			}
		}
		return $return;
	}

	public function update_tbl($tbl,$where,$data){
		$this->db->where('tt_id', $where);
		$this->db->update($tbl, $data);

		if ($_GET['action'] == 2) {
			$this->db->query('insert into approved_thesis (tt_id,at_topic,at_title,at_conducted_by,at_advisory,at_desc) select tt_id,tt_topic, tt_title, tt_submitted_by,tt_advisory,tt_desc from tmp_thesis where tt_id ="'.$_GET['id'].'"');
		}
	}

	public function get_all_unschedule(){
		$return = array();
		$this->db->select("approved_thesis.*,concat(student.stud_lastname,', ', student.stud_firstname) as stud_fullname, concat(teacher_staff.ts_lastname, ', ', teacher_staff.ts_firstname) as ts_fullname, teacher_staff.ts_gender");
		$this->db->from("approved_thesis");
		//$this->db->where("tmp_thesis.tt_correction =",1);
		$this->db->join('student','student.stud_nim = approved_thesis.at_conducted_by');
		$this->db->join('teacher_staff','teacher_staff.ts_nip = approved_thesis.at_advisory');
		$this->db->where('approved_thesis.at_id NOT IN (SELECT at_id FROM defense_schedule)');
		//$this->db->join('defense_schedule', 'defense_schedule.at_id = approved_thesis.at_id');

		$query = $this->db->get();

		 if ($query->num_rows()>0) {
		 	foreach ($query->result() as $row) {
		 		array_push($return, $row);
			}
		}
		return $return;
	}

	public function get_all_schedule(){
		$return = array();
		$this->db->select("approved_thesis.*,concat(student.stud_lastname,', ', student.stud_firstname) as stud_fullname, concat(teacher_staff.ts_lastname, ', ', teacher_staff.ts_firstname) as ts_fullname, teacher_staff.ts_gender, defense_schedule.ds_id, defense_schedule.ds_date, defense_schedule.ds_time, defense_schedule.ds_room, defense_schedule.ds_scoring_sess");
		$this->db->from("approved_thesis");
		//$this->db->where("tmp_thesis.tt_correction =",1);
		$this->db->join('student','student.stud_nim = approved_thesis.at_conducted_by');
		$this->db->join('teacher_staff','teacher_staff.ts_nip = approved_thesis.at_advisory');
		$this->db->join('defense_schedule', 'defense_schedule.at_id = approved_thesis.at_id');
		$this->db->order_by("defense_schedule.ds_date","asc");

		$query = $this->db->get();

		 if ($query->num_rows()>0) {
		 	foreach ($query->result() as $row) {
		 		array_push($return, $row);
			}
		}
		return $return;
	}

	public function get_all_panelist(){
		$return = array();
		$this->db->select("*");
		$this->db->from("teacher_staff");
		$this->db->join('user','user.user_username = teacher_staff.ts_nip');
		$this->db->where('user_status','1');
		$this->db->where('user_level','2');
		$this->db->where('ts_role !=','4');

		$query = $this->db->get();

		 if ($query->num_rows()>0) {
		 	foreach ($query->result() as $row) {
		 		array_push($return, $row);
			}
		}
		return $return;
	}

	public function check_panelist($ts_id,$ds_date,$ds_time){
		$this->db->select('pan_id');
		$this->db->from('panelist');
		$this->db->where('ts_nip', $ts_id);
		$this->db->where('ds_date', $ds_date);
		$this->db->where('ds_time', $ds_time);
		$this->db->join('defense_schedule','defense_schedule.ds_id = panelist.ds_id');
		//$this->db->where('USER_STTS', 1);

		$query = $this->db->get();

		if($query->num_rows() > 0) {
			return $query->row();
		}

		return NULL;
	}

	public function create_sch($data){
		$this->db->insert('defense_schedule', $data);
	}

	public function retrieve($sql){
		$query = $this->db->query($sql);

		if($query->num_rows() > 0) {
			return $query->row();
		}

		return NULL;
	}

	public function add_pan($data1,$data2){
		$this->db->insert('panelist', $data1);
		$this->db->insert('panelist', $data2);
	}

	public function get_the_pan($at_id){
		$return = array();
		$this->db->select('*');
		$this->db->from("panelist");
		$this->db->where("defense_schedule.at_id",$at_id);
		$this->db->join('defense_schedule','defense_schedule.ds_id = panelist.ds_id');
		$this->db->join('teacher_staff','teacher_staff.ts_nip = panelist.ts_nip');
		$this->db->order_by('panelist.pan_type');

		$query = $this->db->get();

		 if ($query->num_rows()>0) {
		 	foreach ($query->result() as $row) {
		 		array_push($return, $row);
			}
		}
		return $return;
	}

	public function run_query($sql){
		$this->db->query($sql);
	}

	public function get_my_apprentices(){
		$return = array();
		$this->db->select("at_topic, at_title, at_desc, stud_firstname, stud_lastname");
		$this->db->from("approved_thesis");
		$this->db->join('student','student.stud_nim = approved_thesis.at_conducted_by');
		$this->db->where('approved_thesis.at_advisory',$_SESSION['sess_nip']);

		$query = $this->db->get();

		 if ($query->num_rows()>0) {
		 	foreach ($query->result() as $row) {
		 		array_push($return, $row);
			}
		}
		return $return;
	}

	public function get_pan_sch(){
		$return = array();
		$this->db->select("approved_thesis.*,concat(student.stud_lastname,', ', student.stud_firstname) as stud_fullname, concat(teacher_staff.ts_lastname, ', ', teacher_staff.ts_firstname) as ts_fullname, teacher_staff.ts_gender, defense_schedule.ds_id, defense_schedule.ds_date, defense_schedule.ds_time, defense_schedule.ds_room, defense_schedule.ds_scoring_sess");
		$this->db->from("approved_thesis");
		//$this->db->where("tmp_thesis.tt_correction =",1);
		$this->db->join('student','student.stud_nim = approved_thesis.at_conducted_by');
		$this->db->join('teacher_staff','teacher_staff.ts_nip = approved_thesis.at_advisory');
		$this->db->join('defense_schedule', 'defense_schedule.at_id = approved_thesis.at_id');
		$this->db->join('panelist', 'panelist.ds_id = defense_schedule.ds_id');
		$this->db->where('panelist.ts_nip', $_SESSION['sess_nip']);
		$this->db->order_by("defense_schedule.ds_date","asc");

		$query = $this->db->get();

		 if ($query->num_rows()>0) {
		 	foreach ($query->result() as $row) {
		 		array_push($return, $row);
			}
		}
		return $return;
	}

	public function checkp($at_id){
		$this->db->select('panelist.pan_id');
		$this->db->from('panelist');
		$this->db->join('defense_schedule','defense_schedule.ds_id = panelist.ds_id');
		$this->db->where('panelist.ts_nip', $_SESSION['sess_nip']);
		$this->db->where('defense_schedule.at_id', $at_id);
		//$this->db->where('USER_STTS', 1);

		$query = $this->db->get();

		if($query->num_rows() > 0) {
			return $query->row();
		}

		return NULL;
	}

	public function get_definfo_by($tid){
		$return = array();
		$this->db->select("approved_thesis.*,concat(student.stud_lastname,', ', student.stud_firstname) as stud_fullname, concat(teacher_staff.ts_lastname, ', ', teacher_staff.ts_firstname) as ts_fullname, teacher_staff.ts_gender, defense_schedule.ds_id, defense_schedule.ds_date, defense_schedule.ds_time, defense_schedule.ds_room, panelist.pan_type");
		$this->db->from("approved_thesis");
		//$this->db->where("tmp_thesis.tt_correction =",1);
		$this->db->join('student','student.stud_nim = approved_thesis.at_conducted_by');
		$this->db->join('teacher_staff','teacher_staff.ts_nip = approved_thesis.at_advisory');
		$this->db->join('defense_schedule', 'defense_schedule.at_id = approved_thesis.at_id');
		$this->db->join('panelist', 'panelist.ds_id = defense_schedule.ds_id');
		$this->db->where('approved_thesis.at_id',$tid);
		$this->db->where('panelist.ts_nip', $_SESSION['sess_nip']);
		$this->db->order_by("defense_schedule.ds_date","asc");

		$query = $this->db->get();

		 if ($query->num_rows()>0) {
		 	foreach ($query->result() as $row) {
		 		array_push($return, $row);
			}
		}
		return $return;
	}

	public function submit_point($points){
		$this->db->insert('defense_result', $points);
	}

	public function get_defense_thesis(){
		$return = array();
		$this->db->select("defense_result.at_id, sum(defense_result.dr_total) as total, group_concat(defense_result.dr_desc separator ', ') as dr_desc, group_concat(defense_result.dr_tc separator ', ') as dr_tc , approved_thesis.at_title,approved_thesis.at_topic,concat(student.stud_lastname,', ', student.stud_firstname) as stud_fullname");
		$this->db->from("defense_result");
		$this->db->join("defense_schedule",'defense_schedule.at_id = defense_result.at_id');
		$this->db->join('approved_thesis','approved_thesis.at_id = defense_result.at_id');
		$this->db->join('student','student.stud_nim = approved_thesis.at_conducted_by');
		$this->db->where('defense_schedule.ds_scoring_sess',2);
		$this->db->group_by('defense_result.at_id');
		$query = $this->db->get();

		 if ($query->num_rows()>0) {
		 	foreach ($query->result() as $row) {
		 		array_push($return, $row);
			}
		}
		return $return;
	}
}
