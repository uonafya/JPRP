<?php
/**
 * Created by PhpStorm.
 * User: the_fegati
 * Date: 9/3/15
 * Time: 12:35 PM
 */

class Dataimport_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->database();

    }
    //fetch orgunits from local db
    public function get_orgunits() {
        $data='';
        //$this->db->select('ouid');
        $orgunits=$this->db->get('attribution_orgunits');
            foreach ($orgunits->result() as $row) {
                $data[]=$row;
            }

        return $data;
    }

    //returns orgunitid given orgunituid
    public function get_orgunit_id($uid){
        $id = $this->db->get_where('organisationunit',array('uid'=>$uid))->row()->organisationunitid;
        return $id;
    }

    //returns dataelementid given dataelementuid
    public function get_dataelement_id($uid){
        $id = $this->db->get_where('dataelement',array('uid'=>$uid))->row()->dataelementid;
        return $id;
    }

    //insert the imported data in batches
    public function bulk_dumb($data) {
        echo "called a pal here </br>";
        $this->db->insert_batch('datavalue',$data);
        echo "bulk inserted </br>";
        die();
    }
}