<?php

/**
 * 
 */
class User_model extends CI_Model {
	
	function get_user_role($authorities_name, $user_uid){
		$this->db->select('uid');
		$this->db->where('uid', $user_uid); 
		$this->db->from('userinfo');
		$this->db->join('attribution_roles_members', 'attribution_roles_members.attributionroleid=userinfo.attributionroleid ');	
		$this->db->join('attributionauthorities', 'attributionauthorities.attributionauthoritiesid = attribution_roles_members.atributionauthoritesid AND attributionauthorities.attributionauthoritiesname=\''.$authorities_name.'\'');	
		$query = $this->db->get();
		//echo $this->db->last_query();
		if (sizeof($query->result())!=0) {
			return true;
		} else {
			return false;
		}
		
	}
	
}
