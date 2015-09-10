<?php
/**
 * Created by IntelliJ IDEA.
 * User: banga
 * Date: 10/09/15
 * Time: 13:42
 */
class Development_partners extends CI_Controller{

    function __construct() {
        parent:: __construct();
        $this->load->helper('url');
        $this->load->model('development_partners_model');
        $this->load->model('mechanisms_model');
        $this->load->model('programs_model');
        $this->load->model('user_model');
    }

    public function index($errors=null){
        if($this->session->userdata('marker')!=1){
            redirect($this->index());
        }else{
            //Check If User Has Authority(program_magement)
            if ($this->user_model->get_user_role('program_management',$this->session->userdata('useruid'))) {
                $data["agencies"]=$this->development_partners_model->agency_list();
                $data['development_partner_right']=$this->user_model->get_user_role('program_management',$this->session->userdata('useruid'));
                $data['page']='agency-list';
                $data['error_message']=str_replace("%20", " ", $errors);
                $data['agencyname']=$this->session->userdata('groupname');
                $this->load->view('template',$data);
            } else {
                $data['message']="Kindly Contact The Administrator You Have No Access Rights To This Module";
                $this->load->view('error',$data);
            }
        }
    }

    public function add_agency(){
        if($this->session->userdata('marker')!=1){
            redirect($this->index());
        }else{
            //Check If User Has Authority(program_magement) To Create agencies
            if ($this->user_model->get_user_role('program_management',$this->session->userdata('useruid'))) {
                $data['page']='agency-add';
                $data['orgunits']=$this->mechanisms_model->get_all_orgunits();
                $data['programs']=$this->development_partners_model->get_programs_assigned_devp();
                $data['agencyname']=$this->session->userdata('groupname');
                $this->load->view('template',$data);
            } else {
                $data['message']="Kindly Contact The Administrator You Have No Access Rights To This Module";
                $this->load->view('error',$data);
            }
        }
    }

    public function save_agency()
    {
        if ($this->session->userdata('marker') != 1) {
            redirect($this->index());
        } else {
            //Check If User Has Authority(program_magement) To  Create an Agency
            if ($this->user_model->get_user_role('program_management', $this->session->userdata('useruid'))) {
                if ($progress = $this->development_partners_model->save_agency() ===TRUE) {
                    $message = "Agency Has  Been Successfully Created";
                    redirect("/development_partners/index/$message", 'refresh');
                } else {
                    $message =  $progress;
                    redirect("/development_partners/index/$message", 'refresh');
                }
            } else {
                $data['message'] = "Kindly Contact The Administrator You Have No Access Rights To This Module";
                $this->load->view('error', $data);
            }
        }
    }

    public function view_agency($agency_id){
        if($this->session->userdata('marker')!=1){
            redirect($this->index());
        }else{
            //Check If User Has Authority(program_magement) To Create Programs
            if ($this->user_model->get_user_role('program_management',$this->session->userdata('useruid'))) {
                $data['program_right']=$this->user_model->get_user_role('program_management',$this->session->userdata('useruid'));
                $data['page']='agency-view';
                $data['program'] = $this->development_partners_model->agency_programs_list($agency_id);
                $data['agency_details']= $this->development_partners_model->agency_details($agency_id);
                $data['mechanisms'] = $this->development_partners_model->agency_mechanisms($agency_id);
                $data['error_message']=str_replace("%20", " ", "");
                $data['agencyname']=$this->session->userdata('groupname');
                $this->load->view('template',$data);
            } else {
                $data['message']="Kindly Contact The Administrator You Have No Access Rights To This Module";
                $this->load->view('error',$data);
            }
        }
    }



}
