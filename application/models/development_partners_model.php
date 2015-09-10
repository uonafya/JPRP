<?php

/**
 * Created by IntelliJ IDEA.
 * User: banga
 * Date: 10/09/15
 * Time: 13:53
 */
class Development_partners_model extends CI_Model
{

    public function agency_list()
    {
        $agencies = $this->db->get_where("attribution_hierarchy", array("parentid" =>$this->session->userdata('group_uid'), "level"=>3));
        if (sizeof($agencies->result()) >= 1) {
            return $agencies->result();
        }
        return "";
    }

//    Programs Assigned to the development Partner
   public function get_programs_assigned_devp(){

       $usergroupid=$this->session->userdata('group_uid');

       if(!$query=$this->db->get_where("attribution_hierarchy", array("uid" => $usergroupid))){
           return false;
       }

       echo $parentid=$query->row()->parentid;
       //Get list of programs under the parent uid

       if(!$query2=$this->db->get_where("attribution_hierarchy_programs", array("hierarchy_uid" => $parentid))){
           return false;
       }
       return $query2->result();


   }

    public function save_agency(){

        $name= $this->input->post('name');
        $shortname= $this->input->post('sname');
        $code= $this->input->post('code');
        $programs=$dataelements = $this->input->post("programs");
        $length=11;
        $agency_uid = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
        //Step1 Check if Development Partner exists
        $check=$this->db->get_where("attribution_hierarchy",array("name"=>$name))->result();
        if (sizeof($check)==0) {
            //step2 Check If There's A usergroup with same name
            $check=$this->db->get_where("usergroup",array("name"=>$name))->result();
            if (sizeof($check)==0) {
                //Step3 Create UserGroup and CategoryOption
                $this->db->select_max('usergroupid');
                $group_query = $this->db->get('usergroup');
                $usergroup_id= 1+(integer)$group_query->row()->usergroupid;
                $usergroup=array(
                    "usergroupid"=>$usergroup_id,
                    "uid"=>$agency_uid,
                    "code"=>$agency_uid,
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
                    "uid"=>$agency_uid,
                    "code"=>$agency_uid,
                    "name"=>$name,
                    "shortname"=>substr($shortname,0,30),
                    'lastupdated'=>date("Y-m-d")
                );

                $this->db->insert("dataelementcategoryoption",$categoryoption);
                //Step3 Insert Into attribution_hierarchy table
                $hierarchy=array(
                    "uid"=>$agency_uid,
                    "code"=>$code,
                    "name"=>$name,
                    "shortname"=>$shortname,
                    "level"=>3,
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
                        "hierarchy_uid"=>$agency_uid,
                        "created_by"=>$this->session->userdata('name')
                    );

                    if ($this->db->insert("attribution_hierarchy_programs",$hierarchy_programs)) {

                    }else{
                        return "An Error Occured During The Creation Of Development Partners";
                    }

                }

                return TRUE;

            } else {
                return " A User Group With Same Name Exists Kindly Contact Admin Or Try Again With A Different Name";
            }

        } else {
            return "Development Partner Exists In Database. Kindly Try Again With A Different Name";
        }


    }

    public function agency_programs_list($agency_id){
        $list=$this->db->get_where("attribution_hierarchy_programs",array("hierarchy_uid"=>$agency_id));
        if (sizeof($list->result())>=1) {
            return $list->result();
        }
        return "";
    }


    public function agency_details($agency_id){
        $list=$this->db->get_where("attribution_hierarchy",array("uid"=>$agency_id));
        if (sizeof($list->result())>=1) {
            return $list->row();
        }
        return "";
    }

    public function agency_mechanisms($agency_id){
        $list=$this->db->get_where("attribution_hierarchy",array("level"=>4,"parentid"=>$agency_id));
        if (sizeof($list->result())>=1) {
            return $list->result();
        }
        return "";
    }


}