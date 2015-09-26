<?php

/**
 * Created by IntelliJ IDEA.
 * User: banga
 * Date: 22/09/15
 * Time: 10:05
 */
class Message extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('message_model');
        $this->load->model('user_model');
    }
   
    public function index($errors = null)
    {
        if ($this->session->userdata('marker') != 1) {
            redirect($this->index());
        } else {
            //Check If User Has Authority(program_management)
            
            if ($this->user_model->get_user_role('program_management', $this->session->userdata('userroleid'))) {
                $data['username']=$this->session->userdata('username');
                $data['sent_mails'] = $this->message_model->sent_mails();
                $data['received_mails'] = $this->message_model->received_mails();
                $data['right'] = $this->user_model->get_user_role('program_management', $this->session->userdata('userroleid'));
                $data['page'] = 'message/inbox.php';
                $data['error_message'] = str_replace("%20", " ", $errors);
                $data['agencyname'] = $this->session->userdata('groupname');
                $this->load->view('template', $data);
            } else {
                $data['message'] = "Kindly Contact The Administrator You Have No Access Rights To This Module";
                $this->load->view('error', $data);
            }
        }
    }


//    Send Mail
    public function save_mail()
    {
        if ($this->session->userdata('marker') != 1) {
            redirect($this->index());
        } else {
            //Check If User Has Authority(program_management) To  Save Mail
            if ($this->user_model->get_user_role('program_management', $this->session->userdata('userroleid'))) {
                if ($progress = $this->message_model->save_mail() == TRUE) {
                    $message = $message = "Mail Sent";
                    redirect("/message/index/$message", 'refresh');
                } else {
                    $message = $progress . "  error. Kindly Try Again";
                    redirect("/message/index/$message", 'refresh');
                }
            } else {
                $data['message'] = "Kindly Contact The Administrator You Have No Access Rights To This Module";
                $this->load->view('error', $data);
            }
        }
    }



}
