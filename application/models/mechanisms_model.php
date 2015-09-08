<?php

/**
 * 
 */
class Mechanisms_model extends CI_Model {

    public function empty_attribution_mechanisms(){
        $this->db->truncate('attribution_mechanisms'); 
    }
	public function mechanisms_list(){
		$mechanisms=$this->db->get("attribution_mechanisms");
		if (sizeof($mechanisms->result())>=1) {
			return $mechanisms->result();
		}
		return "";
	}
	
	public function mechanism_info($id){
		$info=$this->db->get_where("attribution_mechanisms",array("id"=>$id));
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
	
	
	public function excel_import($mechanisms_name, $mechanisms_id,$mechanisms_uid, $attribution_key){
			$mechanisms=array(
				"mechanism_name"=>$mechanisms_name,
				"mechanism_id"=>$mechanisms_id,
				"mechanism_uid"=>$mechanisms_uid,
				"attribution_key"=>$attribution_key
			);
			if (!$this->db->insert("attribution_mechanisms",$mechanisms)) {
				return "Program Members Update";
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
}
