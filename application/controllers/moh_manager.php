<?php


/**
 * 
 */
class Moh_manager extends CI_Controller {
	
	function __construct() {
		parent:: __construct();
        $this->load->helper('url');  
		$this->load->model('moh_model');  	
		$this->load->model('mechanisms_model'); 
		$this->load->model('programs_model');	
		$this->load->model('user_model'); 
	}
	public function index($errors=null){
        if($this->session->userdata('marker')!=1){
            redirect($this->index());
        }else{
        	//Check If User Has Authority(program_magement) To Create Programs
        	if ($this->user_model->get_user_role('program_management',$this->session->userdata('useruid'))) {
        		$data["dplist"]=$this->moh_model->development_list();
				$data['program_right']=$this->user_model->get_user_role('program_management',$this->session->userdata('useruid'));
				$data['page']='developmentpartners-list'; 
				$data['error_message']=str_replace("%20", " ", $errors); 
	            $data['agencyname']=$this->session->userdata('groupname');
	            $this->load->view('template',$data);     		       		
			} else {
				$data['message']="Kindly Contact The Administrator You Have No Access Rights To This Module";
                $this->load->view('error',$data);			
			}       
        }			
	}
	
	public function adddevp(){
        if($this->session->userdata('marker')!=1){
            redirect($this->index());
        }else{
        	//Check If User Has Authority(program_magement) To Create Programs
        	if ($this->user_model->get_user_role('program_management',$this->session->userdata('useruid'))) {
				$data['program_right']=$this->user_model->get_user_role('program_management',$this->session->userdata('useruid'));
				$data['page']='developmentpartners-add'; 
				$data['programs'] = $this->programs_model->all_programs_list();
				$data['error_message']=str_replace("%20", " ", ""); 
	            $data['agencyname']=$this->session->userdata('groupname');
	            $this->load->view('template',$data);     		       		
			} else {
				$data['message']="Kindly Contact The Administrator You Have No Access Rights To This Module";
                $this->load->view('error',$data);			
			}       
        }			
	}
    public function newdevp()
    {
        if ($this->session->userdata('marker') != 1) {
            redirect($this->index());
        } else {
            //Check If User Has Authority(program_magement) To  Create a Mechanism
            if ($this->user_model->get_user_role('program_management', $this->session->userdata('useruid'))) {
            	$progress = $this->moh_model->addnewdevp();
                if ($progress === true) {
                    $message = "The Development Partner Has Successfully Been Created";
                    redirect("/moh_manager/index/$message", 'refresh');
                } else {
                    $message =  $progress ;
                    redirect("/moh_manager/index/$message", 'refresh');
                }
            } else {
                $data['message'] = "Kindly Contact The Administrator You Have No Access Rights To This Module";
                $this->load->view('error', $data);
            }
        }
    }
	
	public function devpartnerview($devuid){
        if($this->session->userdata('marker')!=1){
            redirect($this->index());
        }else{
        	//Check If User Has Authority(program_magement) To Create Programs
        	if ($this->user_model->get_user_role('program_management',$this->session->userdata('useruid'))) {
				$data['program_right']=$this->user_model->get_user_role('program_management',$this->session->userdata('useruid'));
				$data['page']='developmentpartners-view'; 
				$data['program'] = $this->moh_model->devpartner_programs_list($devuid);
				$data['devpartner_details']= $this->moh_model->devpartner_details($devuid);
				$data['agencies'] = $this->moh_model->devpartner_agencies($devuid);
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
