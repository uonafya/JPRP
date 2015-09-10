<?php

/**
 * 
 */
 
class Moh_model extends CI_Model {
	
	public function development_list(){
		$list=$this->db->get_where("attribution_hierarchy",array("level"=>2,"parentid"=>$this->session->userdata('group_uid')));
		if (sizeof($list->result())>=1) {
			return $list->result();
		}
		return "";
	}
	public function devpartner_programs_list($devuid){
		$list=$this->db->get_where("attribution_hierarchy_programs",array("hierarchy_uid"=>$devuid));
		if (sizeof($list->result())>=1) {
			return $list->result();
		}
		return "";		
	}
	
	public function devpartner_details($devuid){
		$list=$this->db->get_where("attribution_hierarchy",array("uid"=>$devuid));
		if (sizeof($list->result())>=1) {
			return $list->row();
		}
		return "";			
	}
	
	public function devpartner_agencies($devuid){
		$list=$this->db->get_where("attribution_hierarchy",array("level"=>3,"parentid"=>$devuid));
		if (sizeof($list->result())>=1) {
			return $list->result();
		}
		return "";	
	}
	
	
	public function addnewdevp(){
		$name= $this->input->post('name');
		$shortname= $this->input->post('sname');
		$code= $this->input->post('code');
		$programs=$dataelements = $this->input->post("programs");
		$length=11;
		$devp_uid = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
		//Step1 Check if Development Partner exists
		$check=$this->db->get_where("attribution_hierarchy",array("name"=>$name));
		if (sizeof($check->result())==0) {
			//step2 Check If There's A usergroup with same name
			$check=$this->db->get_where("usergroup",array("name"=>$name));
			if (sizeof($check->result())==0) {
				//Step3 Create UserGroup and CategoryOption 
				$this->db->select_max('usergroupid');
				$group_query = $this->db->get('usergroup');
				$usergroup_id= 1+(integer)$group_query->row()->usergroupid;				
				$usergroup=array(
					"usergroupid"=>$usergroup_id,
					"uid"=>$devp_uid,
					"code"=>$devp_uid,
					"name"=>$name,
	                'created'=>date("Y-m-d"),
	                'lastupdated'=>date("Y-m-d")				
				);
				$this->db->insert("usergroup",$usergroup);	
				//Create Category Option
				$this->db->select_max('categoryoptionid');
				$option_query = $this->db->get('dataelementcategoryoption');
				$categoryoption_id= 1+(integer)$option_query->row()->categoryoptionid;			
				$categoryoption=array(
					"categoryoptionid"=>$categoryoption_id,
					"uid"=>$devp_uid,
					"code"=>$devp_uid,
					"name"=>$name,
					"shortname"=>substr($shortname,0,30),
	                'lastupdated'=>date("Y-m-d")				
				);
				$this->db->insert("dataelementcategoryoption",$categoryoption);		
				//Step3 Insert Into attribution_hierarchy table
				$hierarchy=array(
					"uid"=>$devp_uid,
					"code"=>$code,
					"name"=>$name,
					"shortname"=>$shortname,
					"level"=>2,
					"parentid"=>$this->session->userdata('group_uid')			
				);
				$this->db->insert("attribution_hierarchy",$hierarchy);	
				//Step4 Insert Programs to attribution_hierarchy_programs
				foreach ($this->input->post("programs") as $row) {
					$programinfo=$this->db->get_where("attribution_programs",array("program_id"=>$row));
					$dets=$programinfo->row();
					$hierarchy_programs=array(
						"program_name"=>$dets->program_name,
						"program_id"=>$dets->program_id,
						"program_description"=>$dets->program_description,
						"hierarchy_uid"=>$devp_uid,
						"created_by"=>$this->session->userdata("name")	
					);
					if ($this->db->insert("attribution_hierarchy_programs",$hierarchy_programs)) {
						
					}else{
						return "An Error Occured During Development Partner Program Creation";
					}
					
				}	
				return true;
				
			} else {
				return " A User Group With Same Name Exists Kindly Contact Admin Or Try Again With A Different Name";
			}
			
		} else {
			return "Development Partner Exists In Database. Kindly Try Again With A Different Name";
		}

		
	}
}
