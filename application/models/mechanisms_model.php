<?php

/**
 * 
 */
class Mechanisms_model extends CI_Model {

    public function empty_attribution_mechanisms(){
        $this->db->truncate('attribution_mechanisms'); 
    }
	public function mechanisms_list(){
		$mechanisms=$this->db->get_where("attribution_mechanisms", array('mechanism_status' => "active"));
		if (sizeof($mechanisms->result())>=1) {
			return $mechanisms->result();
		}
		return "";
	}
	
	public function mechanism_info($id){
		$info=$this->db->get_where("attribution_mechanisms",array("mechanism_id"=>$id));
		if (sizeof($info->result())==1) {
			return $info->row();
		}
		return false;
	}
	
	public function get_mech_programs($id){
		$programs=$this->db->get_where("attribution_mechanisms_programs",array("mechanism_id"=>$id));
		if (sizeof($programs->result())>=1) {
			return $programs->result();
		}
		return "";		
	}
	public function supportupdate($info_array,$id){
		$this->db->where('id', $id);
		if ($this->db->update("attribution_mechanisms_programs",$info_array)) {
			return true;
		}	
		return false;
	}
	
	
	/*public function excel_import($mechanisms_name, $mechanisms_id,$mechanisms_uid, $attribution_key){
			$mechanisms=array(
				"mechanism_name"=>$mechanisms_name,
				"mechanism_id"=>$mechanisms_id,
				"mechanism_uid"=>$mechanisms_uid,
				"attribution_key"=>$attribution_key
			);
			if (!$this->db->insert("attribution_mechanisms",$mechanisms)) {
				return "Program Members Update";
			}		
	}*/
	
	public function mechanisms_excel_import($mechanisms_name, $partner_name, $mechanisms_id){
		//Check If The Mechanism Has An Attribution Key
		$control=sizeof($this->db->get_where("attribution_keys",array("mechanism_id"=>$mechanisms_id))->result());
		if ($control==1) {
			//Update Mechanisms Table
			if (sizeof($this->db->get_where("attribution_mechanisms",array("mechanism_id"=>$mechanisms_id))->result())==0) {
				
				$existing_mech=$this->db->get_where("attribution_keys",array("mechanism_id"=>$mechanisms_id))->row();	
				$stored_mechanisms=array(
					"mechanism_name"=>$existing_mech->mechanism_name,
					"datim_id"=>$existing_mech->mechanism_id,
					"mechanism_uid"=>$existing_mech->mechanism_uid,
					"mechanism_id"=>$existing_mech->mechanism_id,
					"attribution_key"=>$existing_mech->categorycombo_id,
					"partner_name"=>$partner_name
				);
				$this->db->insert("attribution_mechanisms",$stored_mechanisms);				
			}

		}elseif($control==0) {//Generate Attribution Key If Key Doesn't Exist 
			//Step1 Generate User Group
			$length=11;//Length Of UID String Generator
						
			$this->db->select_max('usergroupid');
			$group_query = $this->db->get('usergroup');
			$usergroup_id= 1+(integer)$group_query->row()->usergroupid;
		    $usergroup_uid = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
			$mechanisms_uid=$usergroup_uid;
			$usergroup=array(
				"usergroupid"=>$usergroup_id,
				"uid"=>$usergroup_uid,
				"code"=>$mechanisms_id,
				"name"=>$partner_name,
                'created'=>date("Y-m-d"),
                'lastupdated'=>date("Y-m-d")				
			);
			$this->db->insert("usergroup",$usergroup);

			//Step 1b Generate Usergroup Access rights
			$this->db->select_max('usergroupaccessid');
			$groupaccess_query = $this->db->get('usergroupaccess');
			$usergroupaccess_id= 1+(integer)$groupaccess_query->row()->usergroupaccessid;			
			$usergroupaccess=array(
				"usergroupaccessid"=>$usergroupaccess_id,
				"access"=>"r-------",
				"usergroupid"=>$usergroup_id			
			);			
			$this->db->insert("usergroupaccess",$usergroupaccess);

			//Step 2 Create Option Group For The User Group
		    $categoryoption_uid = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);	
			$this->db->select_max('categoryoptionid');
			$option_query = $this->db->get('dataelementcategoryoption');
			$categoryoption_id= 1+(integer)$option_query->row()->categoryoptionid;			
			$categoryoption=array(
				"categoryoptionid"=>$categoryoption_id,
				"uid"=>$categoryoption_uid,
				"code"=>$mechanisms_id,
				"name"=>$partner_name,
				"shortname"=>substr($partner_name,0,30),
                'created'=>date("Y-m-d"),
                'lastupdated'=>date("Y-m-d")				
			);
			$this->db->insert("dataelementcategoryoption",$categoryoption);
			//echo $this->db->last_query();

			//Step 3 Add Option To Category
			$categoryid=$this->db->get_where('dataelementcategory',array('name'=>'Mechanisms'))->row()->categoryid;
            $maxorder= $this->db->query("SELECT MAX(sort_order) as max FROM categories_categoryoptions WHERE categoryid=$categoryid ")->row()->max;
            $this->db->insert('categories_categoryoptions',array('categoryoptionid'=>$categoryoption_id,'categoryid'=>$categoryid,'sort_order'=>$maxorder+1));			

			//Step 4 create CategoryOptionCombo : Attribution Key(new generated categoryoptioncomboid)
			$optioncombo_uid=substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);   
			$categoryoptioncomboid=$this->db->query('Select max(categoryoptioncomboid) as maxs from categoryoptioncombo')->row()->maxs+1;
			$combo=array(
				'categoryoptioncomboid'=>$categoryoptioncomboid,
				'uid'=>substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length),
				'created'=>date("Y-m-d"),
				'lastupdated'=>date("Y-m-d")
			);
			$this->db->insert('categoryoptioncombo',$combo);

			//Step5 Add categoryoptionid and categoryoptioncomboid to categoryoptioncombos_categoryoptions
			$categoryoptioncombos_categoryoptions=array(
				'categoryoptionid'=>$categoryoption_id,
				'categoryoptioncomboid'=>$categoryoptioncomboid
			);
			$this->db->insert('categoryoptioncombos_categoryoptions',$categoryoptioncombos_categoryoptions);	

			//Step 6 Add Categoryoptioncombo and categorycomboid to categorycombos_optioncombos
			$categorycomboid=$this->db->get_where("categorycombo",array("name"=>"Mechanisms Combo"))->row()->categorycomboid;
			$categorycombos_optioncombos=array(
				'categorycomboid'=>$categorycomboid,
				'categoryoptioncomboid'=>$categoryoptioncomboid
			);
			$this->db->insert('categorycombos_optioncombos',$categorycombos_optioncombos);		

			//Step 7 Update  attribution_keys 
			$attribution_keys=array(
				'mechanism_id'=>$mechanisms_id,
				'mechanism_name'=>$partner_name,
				'mechanism_uid'=>$usergroup_uid,
				'usergroup_id'=>$usergroup_id,
				'categorycombo_id'=>$categoryoptioncomboid,
				'categoryoption_id'=>$categoryoption_id,
			);	
			$this->db->insert("attribution_keys",$attribution_keys);

			//Step 8 : Insert Data to attribution_mechanisms	
			$mechanisms=array(
				"mechanism_name"=>$mechanisms_name,
				"mechanism_id"=>$mechanisms_id,
				"mechanism_uid"=>$mechanisms_uid,
				"attribution_key"=>$categoryoptioncomboid,
				"partner_name"=>$partner_name,
				"created_by"=>$this->session->userdata('useruid'),
            	"date_created"=>date("d-m-Y H:m:s"),
            	"mechanism_status"=>"active"
			);
			$this->db->insert("attribution_mechanisms",$mechanisms);
		}
		
	}
	
	
	public function get_all_orgunits(){
		$this->db->select('uid, name');
		$orgunits=$this->db->get("organisationunit");
		if (sizeof($orgunits->result())>=1) {
			return $orgunits->result();
		}
		return "";
	}

	public function deletemechanism($mechanism_id){
		$details=array(
			"program_status"=>"dropped",
		);

		$this->db->where('mechanism_id', $mechanism_id);	
		 	
		if (!$this->db->update("attribution_mechanisms", $details)) {
			return false;
		}	

		return true;					 
	 }
}
