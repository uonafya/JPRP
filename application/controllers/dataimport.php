<?php
/**
 * Created by PhpStorm.
 * User: the_fegati
 * Date: 9/2/15
 * Time: 9:53 AM
 */

class Dataimport extends CI_Controller{

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('dataimport_model');
    }

    function index(){
        $data['page']='data-import';
        $data['agencyname']=$this->session->userdata('groupname');
        $this->load->view('template', $data);
    }

    function fetch_data(){
        $data_array="";
        $count=0;
        $datasets = $this->input->post('datasets');
        # API login Credentials
        $username = "kayeli";
        $password = "Kdenno25@gmail";

        $period = $this->input->post('startDate');

        //get orgunits from dataimport_model and loop fetching data for each
        $orgUnits = $this->dataimport_model->get_orgunits();
        foreach($orgUnits as $key => $value) {
            $orgUnit = $value->ouid;

            foreach ($datasets as $key => $value) {

                //HTTP GET request -Using Curl -Response JSON
                $dataset = $value;

                // $url ="http://test.hiskenya.org/api/dataSets/"."$dataset"."/dataValueSet?";
                $url = "http://test.hiskenya.org/api/dataValueSets.json?dataSet=" . $dataset . "&period=" . $period . "&orgUnit=" . $orgUnit . "&children=false";

                //$data = array("period" => "$period", "orgUnit" => "$orgUnit");
                //$data_string = http_build_query($data);
                //  $url.="$data_string";

                // initailizing curl
                $ch = curl_init();
                //curl options
                curl_setopt($ch, CURLOPT_POST, false);
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
                curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_TIMEOUT, 60);
                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
                //execute
                $result = curl_exec($ch);

                //close connection
                curl_close($ch);

             // print_r($result); die();
                if ($result) {
                    $json = json_decode($result, TRUE);
                    if(isset($json['dataValues'])){
                        foreach ($json['dataValues'] as $key => $val) {
                            //echo ."  ".." ".$val["period"]."  ".$val["value"];
                            $dataelementid = $this->dataimport_model->get_dataelement_id($val["dataElement"]);
                            $periodid = 22594;
                            $categoryoptioncomboid = 16;
                            $attributeoptioncomboid = 16;
                            $sourceid = $this->dataimport_model->get_orgunit_id($val["orgUnit"]);
                            $storedby = $val["storedBy"];
                            $lastupdated = $val["lastUpdated"];
                            $value = $val["value"];
                            $followup = $val["followUp"];
                                    $data_array[$count]=array(
                                        "dataelementid"=>$dataelementid,
                                        "periodid"=>$periodid,
                                        "sourceid" => $sourceid,
                                        "categoryoptioncomboid"=>$categoryoptioncomboid,
                                        "attributeoptioncomboid"=>$attributeoptioncomboid,
                                        "value"=>$value,
                                        "storedby"=>"API CALL",
                                        "created"=>$lastupdated,
                                        "lastupdated"=>$lastupdated,
                                        "followup"=>"false"
                                    );
                                    $count=$count+1;


                                if ($count==1000) {
                                    $this->dataimport_model->bulk_dumb($data_array);
                                    $count=0;
                                    unset($data_array);
                                }
                        }
                        if ($data_array!="") {
                            $this->dataimport_model->bulk_dumb($data_array);

                            echo "aye!";die();
                    }

                } else {

                    echo -1;
                }
            }
        }
//        die();
    }

}
}