<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->database();
        $this->load->library('session');
      
        $this->load->library('form_validation');
    }

    public function index(){

        
    }

    public function signUpAdmin($username,$password,$email,$account_type){
      
        $data = [
            'username'=> $username,
            'email'=>$email,
            'password'=>password_hash($password, PASSWORD_DEFAULT),
            'account_type'=>$account_type
            ];
            return $this->db->insert('tblusers', $data);
    }

    public function loginValidation($uname, $pword){
          
        $query = $this->db->query("SELECT * FROM tblusers where username='$uname'");


        if ($query->num_rows()>0) {
            $row = $query->row_array();
            
            if ($row['account_type']==='A') {
                $this->session->set_flashdata('msgerror','Account is not Admin');
                redirect('admin/viewLogin');
                exit();
            }
    
            if (password_verify($pword, $row['password'])) {
                return true;
                
                echo "here";
                
                
            } else {
                
                echo "false";
                // $this->session->set_flashdata('error','Invalid Username or Password !');
                return false;
            }
        } else {
            // $this->session->set_flashdata('error','Invalid Username or Password !');
            return false;
        }
    }


    public function check_user($username,$email)
        {
            $qstr=$this->db->query("SELECT * FROM tblusers WHERE username='$username' && email='$email' LIMIT 1");
                
            if ($qstr->num_rows() > 0) {
                $result=$qstr->result_array();
            } else {
                $result=null;
            }
            return $result;
        }
       

public function get_session_data(){

    $sess_uname=$this->session->userdata('uname');

    $qstr=$this->db->get('tblusers');
    $qstr=$this->db->get_where('tblusers', array('username'=> $sess_uname));
    //$query=$this->db->query($qstr);
    if ($qstr->num_rows() > 0) {
        $result=$qstr->result_array();
    } else {
        $result=null;
    }
    return $result;
}

public function add_post($post_type,$user_id,$post_title,$date_created,$post_content,$routine_count,$routine_format,$file_name,$fullpath,$target_audience){

    $data = [
        'post_image_name'=> $file_name,
        'post_type'=> $post_type,
        'post_user_id'=>$user_id,
        'post_title'=>$post_title,
        'date_posted'=>$date_created,
        'post_content'=>$post_content,
        'routine_count'=>$routine_count,
        'routine_format'=>$routine_format,
        'post_image_url'=>$fullpath,
        'targetAudiendce'=>$target_audience,
        ];
        print_r($data);
        return $this->db->insert('tblposts', $data);
}

public function get_posts(){
    $qstr=$this->db->get('tblposts');
    $qstr=$this->db->get_where('tblposts', array('post_type'=> 'Diet_Plan'));
    //$query=$this->db->query($qstr);


    if ($qstr->num_rows() > 0) {
        $result=$qstr->result_array();
    } else {
        $result=null;
    }
    return $result;
}

public function get_dietPlanFull($post_id){
    $qstr=$this->db->get('tblposts');
    $qstr=$this->db->get_where('tblposts', array('post_type'=> 'Diet_Plan', 'post_id'=>$post_id));
    //$query=$this->db->query($qstr);


    if ($qstr->num_rows() > 0) {
        $result=$qstr->result_array();
    } else {
        $result=null;
    }
    return $result;
}


public function edit_diet($post_id){

    $this->db->where('post_id', $post_id);
    $query = $this->db->get('tblposts');
    if ($query->num_rows() > 0) {
      $result=$query->result_array();
    } else {
        $result=null;
    }
return $result;
}


public function update_dietPlan($field,$post_id){

    
    $this->db->where('post_id', $post_id);
    $this->db->update('tblposts', $field);
   // echo $this->db->last_query();

    if ($this->db->affected_rows() > 0) {
        return true;
    } else {
        return false;
    }
}



public function get_dietPlan(){
    $qstr=$this->db->query("SELECT * FROM tblposts LEFT JOIN tblusers on tblposts.post_user_id=tblusers.userId where tblposts.archive != 1 order by tblposts.date_posted desc");
    // $qstr=$this->db->get_where('tblposts', array('post_type'=> 'Diet_Plan','archive'=>'0' ));
    //$query=$this->db->query($qstr);


    if ($qstr->num_rows() > 0) {
        $result=$qstr->result_array();
    } else {
        $result=null;
    }
    return $result;
}

public function upload($file_name){
    $data = [
      
        'post_image_name'=> $file_name,
    
        ];
        
    return $this->db->insert('tblposts', $data);
}
    
  

public function get_community_post(){

    $qstr=$this->db->query("SELECT * FROM tblcommunity LEFT JOIN tblusers on tblcommunity.thread_user_id=tblusers.userId where tblcommunity.archive_status !=1 order by tblcommunity.thread_date desc ");

    if ($qstr->num_rows() > 0) {
        $result=$qstr->result_array();
    } else {
        $result=null;
    }
    return $result;
    
}

public function get_this_community_post($community_post_id){

    $qstr=$this->db->query("SELECT * FROM tblcommunity LEFT JOIN tblusers on tblcommunity.thread_user_id=tblusers.userId where tblcommunity.community_id='$community_post_id'");

    if ($qstr->num_rows() > 0) {
        $result=$qstr->result_array();
    } else {
        $result=null;
    }
    return $result;
}

public function add_community_comment($community_comment,$date_created,$community_post_id){


    $data = [
        'comment_content'=> $community_comment,
        'comment_date'=>$date_created,
        'comment_user_id'=>$this->session->userdata('id'),
        'community_id'=>$community_post_id,
  
        ];

        print_r($data);
    return $this->db->insert('tblcommunitycomments', $data);   
        
}

public function get_this_community_comment($community_post_id){
    $qstr=$this->db->query('SELECT * FROM tblcommunitycomments JOIN tblcommunity on tblcommunitycomments.community_id=tblcommunity.community_id left JOIN tblusers on tblcommunitycomments.comment_user_id=tblusers.userId');

    
    
    

    if ($qstr->num_rows() > 0) {
        $result=$qstr->result_array();
    } else {
        $result=null;
    }
    return $result;
}


public function archive_post($field,$post_id){
  
    $this->db->where('post_id', $post_id);
    $this->db->update('tblposts', $field);
   // echo $this->db->last_query();

    if ($this->db->affected_rows() > 0) {
        return true;
    } else {
        return false;
    }
        
}

public function archive_community_thread($field,$community_id){
  
    $this->db->where('community_id', $community_id);
    $this->db->update('tblcommunity', $field);
   // echo $this->db->last_query();

    if ($this->db->affected_rows() > 0) {
        return true;
    } else {
        return false;
    }

    
        
}








public function get_archiveDietPlan(){
    $qstr=$this->db->query("SELECT * FROM tblposts LEFT JOIN tblusers on tblposts.post_user_id=tblusers.userId where tblposts.archive > 0");
    // $qstr=$this->db->get_where('tblposts', array('post_type'=> 'Diet_Plan','archive'=>'0' ));
    //$query=$this->db->query($qstr);


    if ($qstr->num_rows() > 0) {
        $result=$qstr->result_array();
    } else {
        $result=null;
    }
    return $result;
}



public function get_archivedCommunityThread(){

    $qstr=$this->db->query("SELECT * FROM tblcommunity LEFT JOIN tblusers on tblcommunity.thread_user_id=tblusers.userId where tblcommunity.archive_status >0 order by tblcommunity.thread_date desc ");

    if ($qstr->num_rows() > 0) {
        $result=$qstr->result_array();
    } else {
        $result=null;
    }
    return $result;
    
}


}