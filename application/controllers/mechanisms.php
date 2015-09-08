<?php

/**
 * 
 */

class Mechanisms extends CI_Controller {
	
	function __construct() {
		parent:: __construct();
        $this->load->helper('url');   	
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
        		$data["mechanisms"]=$this->mechanisms_model->mechanisms_list();
				$data['mechanisms_right']=$this->user_model->get_user_role('program_management',$this->session->userdata('useruid'));
				$data['page']='mechanisms-list'; 
				$data['error_message']=str_replace("%20", " ", $errors); 
	            $data['agencyname']=$this->session->userdata('groupname');
	            $this->load->view('template',$data);     		       		
			} else {
				$data['message']="Kindly Contact The Administrator You Have No Access Rights To This Module";
                $this->load->view('error',$data);			
			}       
        }			
	}
	
	public function mechanismsexcelimport(){
		$file_name=substr( $this->input->get('url'), strpos( $this->input->get('url'), "?file=") + 6);
        if($this->session->userdata('marker')!=1){
            redirect($this->index());
        }else{
        	//Check If User Has Authority(program_magement) To Create Programs
        	if ($this->user_model->get_user_role('program_management',$this->session->userdata('useruid'))) {
        		$file = "C:\\xampp\\htdocs\\attribution\\server\\php\\files\\$file_name";
				$no_empty_rows=TRUE;
				$this->mechanisms_model->empty_attribution_mechanisms();
				$this->load->library('excel');
                //read file from path
                $objPHPExcel = PHPExcel_IOFactory::load($file);
                 $sheetname='MER category option combos';
                //get only the Cell Collection
                //$active=$objPHPExcel->setActiveSheetIndexByName($sheetname);
                $cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
        
                $highestColumm = $objPHPExcel->setActiveSheetIndex(0)->getHighestColumn();
                $highestRow = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();
                
                //echo 'getHighestColumn() =  [' . $highestColumm . ']<br/>';
                //echo 'getHighestRow() =  [' . $highestRow . ']<br/>';
                
                //$cell_collection= array_map('array_filter', $objPHPExcel);
                        
                $rows = $highestRow; 
                //echo $rows."active  </br>";
                $empty_cells_alert="";
                $count=1; 
                $empty_column=1;
                $data_rows=1;
				$mechanisms_name="";
				$mechanisms_id="";
				$mechanisms_uid="";
				$attribution_key="";
                //extract to a PHP readable array format
                //print_r($cell_collection);
                foreach ($cell_collection as $cell) {
            
                    //Only Get Rows With All Columns Filled
                    if ($objPHPExcel->getActiveSheet()->getCell("A".$count)->getValue()!=null && 
                    $objPHPExcel->getActiveSheet()->getCell("B".$count)->getValue()!=null &&
                     $objPHPExcel->getActiveSheet()->getCell("C".$count)->getValue()!=null){
                        if ($cell=="A".$count) {
                            //Get Mechanism Name    
                            $column ='A';
                            $row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
                            $data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();
                            if ($row != 1 && $data_value!='') {
                                $mechanisms_name = $data_value;
                            }    
                        } elseif($cell=="B".$count){
                            $column ='B';
                            $row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
                            $data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();
                            if ($row != 1 && $data_value!='') {
								$partner_name = $data_value;
                            }         
                        }elseif($cell=="C".$count){
                        	$count=$count+1;
                            $column ='C';
                            $row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
                            $data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();
                            if ($row != 1 && $data_value!='' ) {
                                $mechanisms_id = $data_value;
                                $data_rows=$data_rows+1;
								$this->mechanisms_model->mechanisms_excel_import($mechanisms_name,$partner_name, $mechanisms_id);								
                            }
                        //Get Rows With  Partial Column Data
                        }elseif($objPHPExcel->getActiveSheet()->getCell("A".$count)->getValue()!=null || $objPHPExcel->getActiveSheet()->getCell("B".$count)->getValue()!=null || $objPHPExcel->getActiveSheet()->getCell("C".$count)->getValue()!=null ){                       
                                $empty_cells_alert[$empty_column]="Empty Cell In Row $count";
                                $empty_column=$empty_column+1;
                                $count=$count+1;
                                $no_empty_rows=FALSE;
                        }
                        
                    
                }  
				     		       		
			}  
                    $data = array(
                    'message' => "Data Has Been Successfully Uploaded Into The Database"
                    );    
                    echo json_encode($data) ;   
        }else {
				$data['message']="Kindly Contact The Administrator You Have No Access Rights To This Module";
                $this->load->view('error',$data);			
			} 	
	}
	}
	
	public function addmechanism(){
        if($this->session->userdata('marker')!=1){
            redirect($this->index());
        }else{
        	//Check If User Has Authority(program_magement) To Create Programs
        	if ($this->user_model->get_user_role('program_management',$this->session->userdata('useruid'))) {
				$data['page']='mechanisms-add';
				$data['orgunits']=$this->mechanisms_model->get_all_orgunits();
				$data['programs']=$this->programs_model->all_programs_list();
	            $data['agencyname']=$this->session->userdata('groupname');
	            $this->load->view('template',$data);     		       		
			} else {
				$data['message']="Kindly Contact The Administrator You Have No Access Rights To This Module";
                $this->load->view('error',$data);			
			}       
        }			
	}
	
	public function viewmechanism($mech_id){
        if($this->session->userdata('marker')!=1){
            redirect($this->index());
        }else{
        	//Check If User Has Authority(program_magement) To Create Programs
        	if ($this->user_model->get_user_role('program_management',$this->session->userdata('useruid'))) {
        		$data["mech_details"]=$this->mechanisms_model->mechanism_info($mech_id);
				$data["mech_programs"]=$this->mechanisms_model->get_mech_programs($mech_id);  
				$data['attribution_right']=$this->user_model->get_user_role('attribution',$this->session->userdata('useruid'));		
				$data['program_right']=$this->user_model->get_user_role('program_management',$this->session->userdata('useruid'));				
				$data['page']='mechanisms-view';  
	            $data['agencyname']=$this->session->userdata('groupname');
	            $this->load->view('template',$data);     		       		
			} else {
				$data['message']="Kindly Contact The Administrator You Have No Access Rights To This Module";
                $this->load->view('error',$data);			
			}       
        }
	}
	
	public function supportupdate(){
        if($this->session->userdata('marker')!=1){
            redirect($this->index());
        }else{
        	//Check If User Has Authority(program_magement) To Create Programs
        	if ($this->user_model->get_user_role('program_management',$this->session->userdata('useruid'))) {
				if (isset($_POST["data"])) {
					$data = json_decode($_POST["data"],true);
	                $infoarray=array(
	                    "support_type"=>$data["type"],
	                    "start_date"=>$data["sdate"],
	                    "stop_date"=>$data["edate"]
	                );
			        if (sizeof($infoarray)<=0) {
			           header('Content-Type: application/x-json; charset=utf-8');          
			            echo "<span class='error'>Error! No Data Was Captured. Please Try Again</span>";                
			        }		
			        $result = $this->mechanisms_model->supportupdate($infoarray,$data["support_id"]);         
			        if ($result) {
			            header('Content-Type: application/x-json; charset=utf-8');          
			            echo  "<span>Support Update Was Successful</span>"; 			        	                 
			        }else{
			            header('Content-Type: application/x-json; charset=utf-8');          
			            echo  "<span class='error'>An Error Has Occured During Update Process Kindly Try Again</span>"; 
			        }					 					
				}	else{
									header('Content-Type: application/x-json; charset=utf-8'); 
									echo "An Error Occured When Getting The New Details Kindly Try Again";
				}		
			} else {
				$data['message']="Kindly Contact The Administrator You Have No Access Rights To This Module";
                $this->load->view('error',$data);			
			}       
        }									
	}

    public function deletemechanism($mechanism_id){
        if($this->session->userdata('marker')!=1){
            redirect($this->index());
        }else{
            //Check If User Has Authority(program_magement) To delete Programs
            if ($this->user_model->get_user_role('program_management',$this->session->userdata('useruid'))) {
                if($this->mechanisms_model->deletemechanism($mechanism_id)==TRUE){
                    header('Content-Type: application/x-json; charset=utf-8'); 
                    echo "The Mechanism Has Successfully Been removed";
                }else{
                    header('Content-Type: application/x-json; charset=utf-8'); 
                    echo "An Error Occured While Deleting The Mechanism. Kindly Try Again";
                }               
            } else {
                $data['message']="Kindly Contact The Administrator You Have No Access Rights To This Module";
                $this->load->view('error',$data);           
            }       
        }           
    }
		
}
