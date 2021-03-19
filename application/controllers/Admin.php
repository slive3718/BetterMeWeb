<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->database();
        $this->load->helper('date');
        $this->load->model('admin_model');
             
        $this->load->library('form_validation');
        $this->load->library('upload');
        date_default_timezone_set("Asia/Kuala_Lumpur");
    }
	public function index()
	{
        redirect(base_url().'admin/homepage');

    }

    public function viewLogin(){
          
       
        $this->load->view('admin/login');
          
     }


     
     public function validateUser(){
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run()) {
            $uname= $this->input->post('username');
            $pword= $this->input->post('password');
            //   print_r($this->session);
            if ($this->admin_model->loginValidation($uname, $pword)) {
                $session_data = array(
                                  'uname'=>$uname,
                                );        
                $this->session->set_userdata($session_data);
                redirect(base_url(). 'admin/check_session');      
            }
            else{
                $this->session->set_flashdata('msgerror', 'Invalid Username and Password');
                redirect(base_url(). 'admin/viewLogin');
            }
        }else{
            $this->session->set_flashdata('msgerror', 'Invalid Username and Password');
            redirect(base_url(). 'admin/viewLogin');        
        }
       
     }

    public function viewSignUp(){
    
       $this->load->view('admin/createAccount');

    }

    public function check_session(){
        $sess=$this->admin_model->get_session_data();
        $data=$sess;

        foreach ($data as $datas) {
            $id=$datas['userId'];
            $account_type=$datas['account_type'];
        }


        $session_data = array(
        'id'=> $id,
        'account_type'=> $account_type,
       
    );
    
        $this->session->set_userdata($session_data);
        redirect(base_url().'admin/homepage');
    }

    public function signUp(){

       if($this->input->post('submit')) {
            $username= $this->input->post('username');
            $password= $this->input->post('password');
            $confirmpassword= $this->input->post('confirmpassword');
            $email= $this->input->post('email');
            $account_type= $this->input->post('account_type');
      }

       if ($username && $password && $email && $confirmpassword){
                if ($confirmpassword != $password){
                    $this->session->set_flashdata('msgerror', 'Password did not match');
                    redirect(base_url().'admin/viewSignUp');
                        exit;       
                }


                $checkuser_query=$this->admin_model->check_user($username,$email);
                if ($checkuser_query > 0) {
                   $this->session->set_flashdata('msgerror', 'Username or Email already in used'); 
                        redirect(base_url().'admin/viewSignUp');
                }else {
                    $data['inserted']=$this->admin_model->signUpAdmin($username,$password,$email,$account_type);
                    if ($data){
                        $this->session->set_flashdata('msgsuccess', 'Data Saved Successfully');
                        redirect(base_url().'admin/createAccountSuccess');
                    }
                }
                }
       else{
        $this->session->set_flashdata('msgerror', 'Fill up all fields');
        redirect(base_url().'admin/viewSignUp');
       }
    }


public function homepage(){
    
        $posts=$this->admin_model->get_dietPlan();
        $data['rows']=$posts;
        $community_posts=$this->admin_model->get_community_post();
        $data['community_posts']=$community_posts;
        $data['page_title']= "Homepage";
        $this->load->view('admin/templates/header',$data);
        $this->load->view('admin/homepage',$data);
        $this->load->view('templates/footer');

}



public function gotoUser(){
    $this->load->view('user/login');
}

     
public function createAccountSuccess(){
    $this->load->view('admin/createAccountSuccess');
}



public function addMotivationalPosts($post_type=""){
$this->load->view('admin/templates/header');
$data['post_type']=$post_type;
$this->load->view('admin/addMotivationalPost',$data);
$this->load->view('templates/footer');
}

public function do_AddMotivationalPost(){
$post_type=$_POST["post_type"];
$userid=$_POST["user_id"];
$title=$_POST["title"];
$datestring = '%Y-%m-%d %h:%i:%s';
$time = time();  
$date_created=mdate($datestring, $time);
$content=$_POST["content"];
        if ($post_type && $title && $content){
            $data['inserted']=$this->admin_model->add_post($post_type,$userid,$title,$date_created,$content);
            if ($data){
                $this->session->set_flashdata('msgsuccess', 'Data Saved Successfully');
                       
              redirect(base_url().'admin/motivationalPosts');
            }
        }
}


public function logout(){
   //$this->load->view('admin/templates/alerts');
        $this->session->unset_userdata('uname');
        $this->session->sess_destroy();
        redirect(base_url().'admin/viewLogin');     
}

public function motivationalPosts(){
  $posts=$this->admin_model->get_posts();
 $data['posts']=$posts;
$this->load->view('admin/templates/header');
$this->load->view('admin/motivationalPosts',$data);
$this->load->view('templates/footer');
}


public function edit_Diet($post_id){
        $posts=$this->admin_model->edit_diet($post_id);
        $data['posts']=$posts;
       $data['page_title']="Edit Diet";
        $this->load->view('admin/templates/header',$data);
    $this->load->view('admin/editDiet',$data);
    $this->load->view('templates/footer');
}



public function viewDiet(){
if (isset($this->session->userdata['id'])) {
    $posts=$this->admin_model->get_dietPlan();
    $data['rows']=$posts;
    $data['page_title']= "View Diet";
    $this->load->view('admin/templates/header',$data);
    $this->load->view('admin/viewDietPlan', $data);
    $this->load->view('templates/footer');
}
else {
    redirect(base_url().'admin/logout');
}
}
public function viewFullDiet($post_id){
    if (isset($this->session->userdata['id'])) {
        $posts=$this->admin_model->get_dietPlanFull($post_id);
        $data['rows']=$posts;
        $data['page_title']= "View Full Diet Description";
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/viewFullDietPlan', $data);
        $this->load->view('templates/footer');
    }else{
        redirect(base_url().'admin/logout');
    }
}

public function addDietPlan(){
    $data['page_title']= "Add Diet Plan";
    $this->load->view('admin/templates/header',$data);
    $this->load->view('admin/addDietPlan');
    $this->load->view('templates/footer');
}

public function update_dietPlan(){
    $post_content=$this->input->post('post_content');
    $post_title=$this->input->post('post_title');
    $post_id=$this->input->post('post_id');
    $config['upload_path']          = './uploads/images/';
    $config['allowed_types']        = 'gif|jpg|png';
    $config['max_size']             = 100000;
    $config['max_width']            = 100000;
    $config['max_height']           = 100000;
    $config['overwrite']           = false;
    $datestring = "%Y-%m-%d %h:%i:%s";
    $dateposted =mdate($datestring);   
    $this->upload->initialize($config);
    $this->upload->do_upload('userfile');

    $this->load->view('admin/formUpload');
    $data = array('upload_data' => $this->upload->data());
    $file_name=$this->upload->data('file_name');
    if (isset($file_name)) {
        $image_name = $file_name;
        $fullpath="betterMe_Ci3/".$config['upload_path'].$file_name;
        $field = array(
    'post_content'=>$post_content,
    'post_title'=>$post_title,
    'post_image_name'=>$image_name,
    'post_image_url'=>$fullpath,
    );
        $result = $this->admin_model->update_dietPlan($field, $post_id);
    if ($result) {
        $this->session->set_flashdata('msgsuccess', "Post successfully updated.");
       $this->session->set_flashdata('tempid',$post_id);
     redirect(base_url('admin/viewDiet'));
    } else {
       $this->session->set_flashdata('msgwarn', "No changes");
       $this->session->set_flashdata('tempid',$post_id);
        redirect(base_url('admin/viewDiet'));
    }
    }else{
    $field = array(
    'post_content'=>$post_content,
    'post_title'=>$post_title,
    );
        $result = $this->admin_model->update_dietPlan($field, $post_id);
    if ($result) {
        $this->session->set_flashdata('msgsuccess', "Post successfully updated.");
       $this->session->set_flashdata('tempid',$post_id);
     redirect(base_url('admin/viewDiet'));
    } else {
       $this->session->set_flashdata('msgwarn', "No changes");
       $this->session->set_flashdata('tempid',$post_id);
        redirect(base_url('admin/viewDiet'));
    }
    }

}



public function archive_post(){
		$post=$this->input->post();
		$post_id=$post['sessionId'];
    $archive="1";
    $field = array(
    'archive'=>$archive,
    );
    $result = $this->admin_model->archive_post($field, $post_id);
    if ($result) {
        $this->session->set_flashdata('msgsuccess', "Post successfully deleted.");
       $this->session->set_flashdata('tempid',$post_id);
		   echo 'success';
    } else {
       $this->session->set_flashdata('msgwarn', "No changes made in your comment");
       $this->session->set_flashdata('tempid',$post_id);
     echo 'error';
    }   
}

public function restore_post()
{
	$post=$this->input->post();
	$post_id=$post['sessionId'];
    $archive="0";
    $field = array(
    'archive'=>$archive,
    );
    $result = $this->admin_model->archive_post($field, $post_id);
    if ($result) {
        $this->session->set_flashdata('msgsuccess', "Post successfully restored.");
       $this->session->set_flashdata('tempid',$post_id);
       echo "success";
    } else {
       $this->session->set_flashdata('msgwarn', "No changes made");
       $this->session->set_flashdata('tempid',$post_id);
		echo "error";
    } 
}


public function archive_community_thread($community_id){
    $archive=1;
    $field = array(
    'archive_status'=>$archive,
    );
    $result = $this->admin_model->archive_community_thread($field, $community_id);
    if ($result) {
        $this->session->set_flashdata('msgsuccess', "Post successfully restored.");  
       redirect(base_url('admin/review_community_thread'));  
    } else {
       $this->session->set_flashdata('msgwarn', "No changes made");  
       redirect(base_url('admin/review_community_thread'));   
    } 
}




public function do_addPost(){



    

    $user_id= $this->session->userdata('id');
  
    $datestring = '%Y-%m-%d %h:%i:%s';
        $time = time();
        
    $date_created=mdate($datestring, $time);


    $post_type=$this->input->post("post_type");
    $user_id=$this->input->post("user_id");
    $activity_type=$this->input->post("diet_type");
    $post_title=$this->input->post("post_title");
    $post_content=$this->input->post("post_content");
    
    $routine_format=$this->input->post("routine_format");
    $routine_count=$this->input->post("routine_count");

echo $post_content;

    if ($post_type && $user_id && $post_content && $post_title ){
     echo"here";
        $data['inserted']=$this->admin_model->add_post($post_type,$user_id,$post_title,$date_created,$post_content,$routine_count,$routine_format);
            print_r($data);
        if ($data){
            $this->session->set_flashdata('msgsuccess', 'Diet Plan Successfully Created');
                   
                    redirect(base_url().'admin/viewDiet');
        }else{
            echo "hi";
        }
    }

    
}

public function viewUpload(){
    $this->load->view('admin/formUpload');
}



public function upload(){


    $id=$this->session->userdata('id');
    // $config['upload_path'] = './assets/images/';
    //	$config['allowed_types'] = '*';
    
    $config['upload_path']          = './uploads/images';
    $config['allowed_types']        ='gif|jpg|png';
    $config['max_size']             = 100000;
    $config['max_width']            = 100000;
    $config['max_height']           = 100000;
    $config['overwrite']           = false;
 
    

    $datestring = "%Y-%m-%d %h:%i:%s";
    $dateposted =mdate($datestring);   
    
  
   


    $this->upload->initialize($config);

    $this->upload->do_upload('userfile');
    //   if (! $this->upload->do_upload('userfile')) {


    $this->load->view('admin/formUpload');

    //  } else {
     
    $data = array('upload_data' => $this->upload->data());
    $file_name=$this->upload->data('file_name');
    if (isset($file_name)) {
        $this->admin_model->upload($id,$file_name);
        
     
    }
        
      
    redirect('admin/viewUpload');
}



public function temp_add(){

    // $config['upload_path'] = './assets/images/';
    //	$config['allowed_types'] = '*';
    
    $config['upload_path']          = './uploads/images/';
    $config['allowed_types']        = 'gif|jpg|png';
    $config['max_size']             = 100000;
    $config['max_width']            = 100000;
    $config['max_height']           = 100000;
    $config['overwrite']           = false;
   
 
    $datestring = "%Y-%m-%d %h:%i:%s";
    $dateposted =mdate($datestring);   
    $this->upload->initialize($config);

    $this->upload->do_upload('userfile');
    //   if (! $this->upload->do_upload('userfile')) {


    $this->load->view('admin/formUpload');

    //  } else {
     
    $data = array('upload_data' => $this->upload->data());
    $file_name=$this->upload->data('file_name');
    if (isset($file_name)) {
        $user_id= $this->session->userdata('id');
        $datestring = '%Y-%m-%d %h:%i:%s';
            $time = time();
        $date_created=mdate($datestring, $time);
        $target_audience = $this->input->post("targetAudience");
        $post_type=$this->input->post("post_type");
        $user_id=$this->input->post("user_id");
        $activity_type=$this->input->post("diet_type");
        $post_title=$this->input->post("post_title");
        $post_content=$this->input->post("post_content");
        $routine_format=$this->input->post("routine_format");
        $routine_count=$this->input->post("routine_count");
    echo $post_content;
        if ($post_type && $user_id && $post_content && $post_title ){
            $fullpath="betterMe_Ci3/".$config['upload_path'].$file_name;
            $data['inserted']=$this->admin_model->add_post($post_type,$user_id,$post_title,$date_created,$post_content,$routine_count,$routine_format,$file_name,$fullpath,$target_audience);
                print_r($data);
            if ($data){
                $this->session->set_flashdata('msgsuccess', 'Diet Plan Successfully Created');
                  
                   //     redirect(base_url().'admin/viewDiet');
            }else{
                echo "hi";
            }
        }
    }
    else {
        $user_id= $this->session->userdata('id');
        $fullpath="";
        $datestring = '%Y-%m-%d %h:%i:%s';
            $time = time();
        $date_created=mdate($datestring, $time);
        $post_type=$this->input->post("post_type");
        $user_id=$this->input->post("user_id");
        $activity_type=$this->input->post("diet_type");
        $post_title=$this->input->post("post_title");
        $post_content=$this->input->post("post_content");
        $routine_format=$this->input->post("routine_format");
        $routine_count=$this->input->post("routine_count");
    echo $post_content;
        if ($post_type && $user_id && $post_content && $post_title ){
            $data['inserted']=$this->admin_model->add_post($post_type,$user_id,$post_title,$date_created,$post_content,$routine_count,$routine_format,$fullpath);
                print_r($data);
            if ($data){
                $this->session->set_flashdata('msgsuccess', 'Diet Plan Successfully Created');
                       
                        redirect(base_url().'admin/viewDiet');
            }else{
                echo "hi";
            }
        }
    }
    
}


public function view_community(){
    
}



public function view_this_community_post($community_post_id){
  
    if (isset($this->session->userdata['id'])) {

        $posts=$this->admin_model->get_this_community_post($community_post_id);
        $comments=$this->admin_model->get_this_community_comment($community_post_id);
        $data['rows']=$posts;
        $data['comments']=$comments;
        $data['page_title']= "View Community";
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/viewThisCommunityPost', $data);
        $this->load->view('admin/templates/footer');
    }else{
        redirect(base_url().'admin/logout');
    }
        
}


public function addUser(){
    $this->load->view('admin/templates/header');
    $this->load->view('admin/addUser');
    $this->load->view('admin/templates/footer');
}


public function add_community_comment($community_post_id){
    if (isset($this->session->userdata['id'])) {
        $this->session->set_flashdata('lasId', $community_post_id);
        $community_comment=$this->input->post('community_comment');
        $datestring = '%Y-%m-%d %h:%i:%s';
        $time = time();
        $date_created=mdate($datestring, $time);
        echo $community_comment,$date_created;
        if ($community_comment && $community_post_id) {
            $data['inserted']=$this->admin_model->add_community_comment($community_comment, $date_created, $community_post_id);
            if ($data) {
                $this->session->set_flashdata('msgsuccess', 'Comment Plan Successfully Created');
                  
                redirect(base_url().'admin/view_this_community_post/'.$community_post_id);
            } else {
                echo "hi";
            }
        }
    }
    else{
        redirect(base_url().'admin/logout');
    }
}


public function review_community_thread(){
    if (isset($this->session->userdata['id'])) {
        $community_posts=$this->admin_model->get_community_post();
        $data['community_posts']=$community_posts;
        $data['page_title']= "Review Community Thread";
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/reviewCommunityThread', $data);
        $this->load->view('admin/templates/footer');
    }else{
            redirect(base_url().'admin/logout');
        }
}


public function post_like($community_post_id){
    if ( $community_post_id) {
        $data['liked']= $this->admin_model->add_Like($community_post_id);
           
        if ($data) {
         
        } else {
            
        }
    }
}



public function viewArchiveDiet(){
    if (isset($this->session->userdata['id'])) {
        $posts=$this->admin_model->get_archiveDietPlan();
        $data['rows']=$posts;
        $data['page_title']= "View Archive Diets";
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/viewArchiveDietPlans', $data);
        $this->load->view('templates/footer');
    }
    else {
        redirect(base_url().'admin/logout');
    }
    }

    
    public function viewArchivedCommunityThread(){
        if (isset($this->session->userdata['id'])) {
        $community_posts=$this->admin_model->get_archivedCommunityThread();
        $data['community_posts']=$community_posts;
        $data['page_title']= "View Archive Community Thread";
              $this->load->view('admin/templates/header', $data);
            $this->load->view('admin/viewArchivedCommunityThread',$data);
            $this->load->view('admin/templates/footer');
        }
        else {
            redirect(base_url().'admin/logout');
        }
        }

      
    public function restoreCommunityThread($threadId){
            $archive=0;
            $field = array(
            'archive_status'=>$archive,
            );
            $result = $this->admin_model->archive_community_thread($field, $threadId);
            if ($result) {
                $this->session->set_flashdata('msgsuccess', "Post successfully restored.");    
               redirect(base_url('admin/review_community_thread'));
            } else {
               $this->session->set_flashdata('msgwarn', "No changes made");
             
               redirect(base_url('admin/review_community_thread')); 
        }
    }

    public function reviewProfilePosts(){
		$data['all_profile_posts']=$this->admin_model->getAllProfilePosts();
		$this->load->view('admin/templates/header', $data);
		$this->load->view('admin/reviewProfilePosts',$data);

	}
	public function archiveProfilePost(){
		$post=$this->input->post();
		$postId=$post['sessionId'];
		$qstr = $this->admin_model->archive_user_profile_post($postId);
	    if ($qstr){
			echo"success";
		}else{
	    	echo "error";
		}

	}
}
