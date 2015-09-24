<?php
/**
 * Created by IntelliJ IDEA.
 * User: banga
 * Date: 22/09/15
 * Time: 10:12
 */
class Message_model extends CI_Model {

//    Fetch User's Sent Mails
    public function sent_mails(){
        $mail_username=$this->session->userdata('username');
        if($mail_username!=false) {
            $sent_mails = $this->db->get_where('portal_message', array('sender_username' => $mail_username));
            if (sizeof($sent_mails->result()) >= 1) {
                return $sent_mails->result();
            }
        }
        return "";

    }

    //    Fetch User's Received Mails
    public function received_mails(){

        $mail_username=$this->session->userdata('username');
        if($mail_username!=false){

            $received_mails=$this->db->get_where('portal_message', array('receiver_username'=>$mail_username));
            if (sizeof($received_mails->result())>=1) {
                return $received_mails->result();
            }

        }

        return "";
    }

    //    Fetch User's Received Mail replies
    public function received_mail_replies($message_id){

        $replies=$this->db->get_where('portal_message_reply', array('message_id'=>$message_id));
        if (sizeof($replies->result())>=1) {
            return $replies->result();
        }
        return "";

    }

    //Save Mail
    public function save_mail(){

        $sender_username=$this->session->userdata('username');
        $receiver_username=$this->input->post('receiver');
        $subject=$this->input->post('subject');
        $content=$this->input->post('content');
        $timestamp=date("Y-m-d H:m:s");

        if($sender_username!=false){

            $data=array('sender_username' =>$sender_username ,
            'receiver_username'=>$receiver_username,
            'message_subject'=>$subject,
            'message_content'=>$content,
            'timestamp'=>$timestamp);

            if($this->db->insert('portal_message', $data))
            {
                return true;
            }
        }

        return "Sending Mail";
    }
}