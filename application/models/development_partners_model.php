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
        $agencies = $this->db->get_where("attribution_hierarchy", array("parentid" => $this->session->userdata('group_uid'), "level" => 3));
        if (sizeof($agencies->result()) >= 1) {
            return $agencies->result();
        }
        return "";
    }

//    Programs Assigned to the development Partner
    public function get_programs_assigned_devp()
    {

        $usergroupid = $this->session->userdata('group_uid');
//		echo "string   $usergroupid";
//		$query = $this->db->get_where("attribution_hierarchy", array("uid" => $usergroupid));
//        if (sizeof($query->result())==0) {
//            return false;
//        }

//        $parentid = $query->row()->parentid;
        //Get list of programs under the parent uid

        if (!$query2 = $this->db->get_where("attribution_hierarchy_programs", array("hierarchy_uid" => $usergroupid))) {
            return false;
        }
        return $query2->result();


    }

    public function save_agency()
    {

        $name = $this->input->post('name');
        $shortname = $this->input->post('sname');
        $code = $this->input->post('code');
        $programs = $dataelements = $this->input->post("programs");
        $length = 11;
        $agency_uid = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
        //Step1 Check if Development Partner exists
        $check = $this->db->get_where("attribution_hierarchy", array("name" => $name))->result();
        if (sizeof($check) == 0) {
            //step2 Check If There's A usergroup with same name
            $check = $this->db->get_where("usergroup", array("name" => $name))->result();
            if (sizeof($check) == 0) {
                //Step3 Create UserGroup and CategoryOption
                $this->db->select_max('usergroupid');
                $group_query = $this->db->get('usergroup');
                $usergroup_id = 1 + (integer)$group_query->row()->usergroupid;
                $usergroup = array(
                    "usergroupid" => $usergroup_id,
                    "uid" => $agency_uid,
                    "code" => $agency_uid,
                    "name" => $name,
                    'created' => date("Y-m-d"),
                    'lastupdated' => date("Y-m-d")
                );
                $this->db->insert("usergroup", $usergroup);
                //Create Category Option
                $this->db->select_max('categoryoptionid');
                $option_query = $this->db->get('dataelementcategoryoption');
                $categoryoption_id = 1 + (integer)$option_query->row()->categoryoptionid;
                $categoryoption = array(
                    "categoryoptionid" => $categoryoption_id,
                    "uid" => $agency_uid,
                    "code" => $agency_uid,
                    "name" => $name,
                    "shortname" => substr($shortname, 0, 30),
                    'lastupdated' => date("Y-m-d")
                );

                $this->db->insert("dataelementcategoryoption", $categoryoption);
                //Step3 Insert Into attribution_hierarchy table
                $hierarchy = array(
                    "uid" => $agency_uid,
                    "code" => $code,
                    "name" => $name,
                    "shortname" => $shortname,
                    "level" => 3,
                    "parentid" => $this->session->userdata('group_uid')
                );

                $this->db->insert("attribution_hierarchy", $hierarchy);
                //Step4 Insert Programs to attribution_hierarchy_programs
                foreach ($this->input->post("programs") as $row) {
                    $programinfo = $this->db->get_where("attribution_programs", array("program_id" => $row));
                    $dets = $programinfo->row();
                    $hierarchy_programs = array(
                        "program_name" => $dets->program_name,
                        "program_id" => $dets->program_id,
                        "hierarchy_uid" => $agency_uid,
                        "created_by" => $this->session->userdata('name')
                    );

                    if ($this->db->insert("attribution_hierarchy_programs", $hierarchy_programs)) {

                    } else {
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

    public function agency_programs_list($agency_id)
    {
        $list = $this->db->get_where("attribution_hierarchy_programs", array("hierarchy_uid" => $agency_id));
        if (sizeof($list->result()) >= 1) {
            return $list->result();
        }
        return "";
    }

    public function agency_programs_list_update($agency_id)
    {
        $usergroupid = $this->session->userdata('group_uid');
        $query = "  SELECT * FROM  attribution_hierarchy_programs ahp WHERE  NOT EXISTS
  (SELECT * FROM   attribution_hierarchy_programs ahpa WHERE  ahpa.hierarchy_uid='$agency_id' and ahp.program_id = ahpa.program_id) and  ahp.hierarchy_uid='$usergroupid'";
        $list = $this->db->query($query);
        if (sizeof($list->result()) >= 1) {
            return $list->result();
        }
        return "";
    }


    public function agency_details($agency_id)
    {
        $list = $this->db->get_where("attribution_hierarchy", array("uid" => $agency_id));
        if (sizeof($list->result()) >= 1) {
            return $list->row();
        }
        return "";
    }

    public function agency_mechanisms($agency_id)
    {
        $list = $this->db->get_where("attribution_hierarchy", array("level" => 4, "parentid" => $agency_id));
        if (sizeof($list->result()) >= 1) {
            return $list->result();
        }
        return "";
    }

    public function save_agency_update()
    {
        $name = $this->input->post('name');
        $agency_uid = $this->input->post('agency_uid');
        $shortname = $this->input->post('sname');
        $code = $this->input->post('code');
        $programs = $this->input->post("programs");
        var_dump($programs);
        $length = 11;

//        //Step1 Check if Development Partner exists
//        $check = $this->db->get_where("attribution_hierarchy", array("name" => $name))->result();
//        if (sizeof($check) === 0) {
        //step2 -Update agency details in the usergroup
        $usergroup = array(
            "name" => $name,
            'lastupdated' => date("Y-m-d")
        );

        $this->db->where('uid', $agency_uid);
        if (!$this->db->update("usergroup", $usergroup)) {
            return "Error Updating user group";
        }

        //Step3-Update agency details in the category option
        $categoryoption = array(
            "name" => $name,
            "shortname" => substr($shortname, 0, 30),
            'lastupdated' => date("Y-m-d")
        );

        $this->db->where('uid', $agency_uid);
        if (!$this->db->update("dataelementcategoryoption", $categoryoption)) {
            return "Error Updating Category Option";
        }

        //Step4  Update attribution_hierarchy table
        $hierarchy = array(
            "code" => $code,
            "name" => $name,
            "shortname" => $shortname
        );

        $this->db->where('uid', $agency_uid);
        if (!$this->db->update("attribution_hierarchy", $hierarchy)) {
            return "Error Updating Attribution Hierarchy";
        }

        //Step5 Insert Programs to attribution_hierarchy_programs
        $this->db->delete("attribution_hierarchy_programs", array('hierarchy_uid' => $agency_uid));
        foreach ($programs as $row) {
            if (!$programinfo = $this->db->get_where("attribution_programs", array("program_id" => $row))) {
                echo "Error Updating Details at program info";
            }

            $dets = $programinfo->row();

            $hierarchy_programs = array(
                "program_name" => $dets->program_name,
                "program_id" => $dets->program_id,
                "hierarchy_uid" => $agency_uid
            );


            if ($this->db->insert("attribution_hierarchy_programs", $hierarchy_programs)) {

            } else {
                return "An Error Occured During The C";
            }


        }

        return TRUE;

//


    }


}