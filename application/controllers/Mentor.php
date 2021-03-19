<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mentor extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->database();
        $this->load->helper('date');
        $this->load->model('mentor_model');
             
        $this->load->library('form_validation');
        $this->load->library('upload');
        date_default_timezone_set("Asia/Kuala_Lumpur");
    }
	public function index()
	{
        redirect(base_url().'mentor/homepage');

    }

    public function viewLogin(){
          
       
        $this->load->view('mentor/login');
          
     }


     
     public function validateUser(){
       
      


        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run()) {
            $uname= $this->input->post('username');
            $pword= $this->input->post('password');

                
            //   print_r($this->session);
            if ($this->mentor_model->loginValidation($uname, $pword)) {
                $session_data = array(
                                  'uname'=>$uname,
                                  
                                );
                           
                $this->session->set_userdata($session_data);
                redirect(base_url(). 'mentor/check_session');      
                
            
                
            }
            else{
                $this->session->set_flashdata('msgerror', 'Invalid Username and Password');
                redirect(base_url(). 'mentor/viewLogin');

            }
        }else{
            $this->session->set_flashdata('msgerror', 'Invalid Username and Password');
            redirect(base_url(). 'mentor/viewLogin');        
        }
       
     }

    public function viewSignUp(){
    
       $this->load->view('mentor/createAccount');

    }

    public function check_session(){
        $sess=$this->mentor_model->get_session_data();
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
        redirect(base_url().'mentor/homepage');
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
                    redirect(base_url().'mentor/viewSignUp');
                        exit;
                      
                }


                $checkuser_query=$this->mentor_model->check_user($username,$email);

                if ($checkuser_query > 0) {
                   $this->session->set_flashdata('msgerror', 'Username or Email already in used');
                    
                        redirect(base_url().'mentor/viewSignUp');
                }else {
                    $data['inserted']=$this->mentor_model->signUpmentor($username,$password,$email,$account_type);

                    if ($data){
                        $this->session->set_flashdata('msgsuccess', 'Data Saved Successfully');
                        if ($account_type ="M"){
                            redirect(base_url().'mentor/viewLogin');
                        }
                       else {
                        redirect(base_url().'user/viewLogin');
                       }
                    }

                }
                }
 
       else{
        $this->session->set_flashdata('msgerror', 'Fill up all fields');
        redirect(base_url().'mentor/viewSignUp');
       }

    
    }


  

 public function homepage(){
    
        $posts=$this->mentor_model->get_dietPlan();
        $data['rows']=$posts;

        $profpic=$this->mentor_model->model_show_profilepic();
        $data['profpic']=$profpic;

        $community_posts=$this->mentor_model->get_community_post();
        $data['community_posts']=$community_posts;

        $data['page_title']= "Homepage";
        $this->load->view('templates/header',$data);
        $this->load->view('mentor/homepage',$data);
      
        $this->load->view('templates/footer');

      
   
    

 }



    public function gotoUser(){
        
        $this->load->view('user/login');
    }

        
    public function createAccountSuccess(){
        $this->load->view('mentor/createAccountSuccess');
    }



    public function addMotivationalPosts($post_type=""){


    $this->load->view('templates/header');
    $data['post_type']=$post_type;
    $this->load->view('mentor/addMotivationalPost',$data);
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
                $data['inserted']=$this->mentor_model->add_post($post_type,$userid,$title,$date_created,$content);

                if ($data){
                    $this->session->set_flashdata('msgsuccess', 'Data Saved Successfully');
                        
                            redirect(base_url().'mentor/motivationalPosts');
                }
            }


    }


    public function logout(){
    //$this->load->view('mentor/templates/alerts');
            $this->session->unset_userdata('uname');
            $this->session->sess_destroy();
            redirect(base_url().'mentor/viewLogin');
        
    }

public function motivationalPosts(){

    $posts=$this->mentor_model->get_posts();
    $data['posts']=$posts;

$this->load->view('templates/header');

$this->load->view('mentor/motivationalPosts',$data);

$this->load->view('templates/footer');
}


public function edit_Diet($post_id){
    if (isset($this->session->userdata['id'])) {
        $posts=$this->mentor_model->edit_diet($post_id);
        $data['posts']=$posts;
    
        $data['page_title']="Edit Diet";

        $this->load->view('templates/header', $data);
        $this->load->view('mentor/editDiet', $data);
        $this->load->view('templates/footer');
    }else {
        redirect(base_url().'mentor/logout');
    }
}




public function viewDiet(){
if (isset($this->session->userdata['id'])) {
    $posts=$this->mentor_model->get_dietPlan();
    $data['rows']=$posts;

    $data['page_title']="View Diet";
    $this->load->view('templates/header',$data);
    $this->load->view('mentor/viewDietPlan', $data);
    $this->load->view('templates/footer');
}
else {
    redirect(base_url().'mentor/logout');
}
}
public function viewFullDiet($post_id){
    if (isset($this->session->userdata['id'])) {
       
        $posts=$this->mentor_model->get_dietPlanFull($post_id);
        $data['rows']=$posts;

        $data['page_title']= "Diet Post";

        // $likes=$this->mentor_model->get_likes($post_id);
        // $data['likes']=$posts;

        
        
        $this->load->view('templates/header',$data);
        $this->load->view('mentor/viewFullDietPlan', $data);
        $this->load->view('templates/footer');
   } else{
        redirect(base_url().'mentor/logout');
    }
}

public function addDietPlan(){
    if (isset($this->session->userdata['id'])) {
        $data['page_title']="Add Diet Plan";
        $this->load->view('templates/header', $data);
        $this->load->view('mentor/addDietPlan');
        $this->load->view('templates/footer');
    } else{
        redirect(base_url().'mentor/logout');
    }
}

public function update_dietPlan(){
    if (isset($this->session->userdata['id'])) {
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
    //   if (! $this->upload->do_upload('userfile')) {


    $this->load->view('mentor/formUpload');

    //  } else {
     
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

    
    
        $result = $this->mentor_model->update_dietPlan($field, $post_id);
        

    if ($result) {
        $this->session->set_flashdata('msgsuccess', "Post successfully updated.");
       $this->session->set_flashdata('tempid',$post_id);
     
     redirect(base_url('mentor/viewDiet'));
    } else {
       $this->session->set_flashdata('msgwarn', "No changes");
       $this->session->set_flashdata('tempid',$post_id);
        redirect(base_url('mentor/viewDiet'));
    }
    }else{
       
      
        $field = array(
    'post_content'=>$post_content,
    'post_title'=>$post_title,

    );

    
    
        $result = $this->mentor_model->update_dietPlan($field, $post_id);
        

    if ($result) {
        $this->session->set_flashdata('msgsuccess', "Post successfully updated.");
       $this->session->set_flashdata('tempid',$post_id);
     
     redirect(base_url('mentor/viewDiet'));
    } else {
       $this->session->set_flashdata('msgwarn', "No changes");
       $this->session->set_flashdata('tempid',$post_id);
        redirect(base_url('mentor/viewDiet'));
    }
    }
    
} else{
    redirect(base_url().'mentor/logout');
}

}



public function archive_post($post_id){
    if (isset($this->session->userdata['id'])) {
  
    $archive="1";
 
    $field = array(
   
    'archive'=>$archive,
    );

    $result = $this->mentor_model->archive_post($field, $post_id);

    if ($result) {
        $this->session->set_flashdata('msgsuccess', "Post successfully deleted.");
       $this->session->set_flashdata('tempid',$post_id);
       redirect(base_url('mentor/viewDiet'));
        
      
    } else {
       $this->session->set_flashdata('msgwarn', "No changes made in your comment");
       $this->session->set_flashdata('tempid',$post_id);
       redirect(base_url('mentor/viewDiet'));
     
    } 
} else{
    redirect(base_url().'mentor/logout');
}

}









public function do_addPost(){


    if (isset($this->session->userdata['id'])) {
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

        if ($post_type && $user_id && $post_content && $post_title) {
            echo"here";
            $data['inserted']=$this->mentor_model->add_post($post_type, $user_id, $post_title, $date_created, $post_content, $routine_count, $routine_format, $activity_type);
            print_r($data);
            if ($data) {
                $this->session->set_flashdata('msgsuccess', 'Diet Plan Successfully Created');
                   
                redirect(base_url().'mentor/viewDiet');
            } else {
                echo "hi";
            }
        }
    } else{
        redirect(base_url().'mentor/logout');
    }
    
}

public function viewUpload(){
    $this->load->view('mentor/formUpload');
}



public function upload(){


    $id=$this->session->userdata('id');
    // $config['upload_path'] = './assets/images/';
    //	$config['allowed_types'] = '*';
    
    $config['upload_path']          = './uploads/images/';
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


    $this->load->view('mentor/formUpload');

    //  } else {
     
    $data = array('upload_data' => $this->upload->data());
    $file_name=$this->upload->data('file_name');
    if (isset($file_name)) {
        $this->mentor_model->upload($id,$file_name);
        
     
    }
        
      
    redirect('mentor/viewUpload');
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


    $this->load->view('mentor/formUpload');

    //  } else {
     
    $data = array('upload_data' => $this->upload->data());
    $file_name=$this->upload->data('file_name');
    if (isset($file_name)) {
       
        $user_id= $this->session->userdata('id');
  
        $datestring = '%Y-%m-%d %h:%i:%s';
            $time = time();
            
        $date_created=mdate($datestring, $time);
    
    
        $post_type=$this->input->post("post_type");
        $user_id=$this->input->post("user_id");
        $activity_type=$this->input->post("activity_type");
        $post_title=$this->input->post("post_title");
        $post_content=htmlspecialchars($this->input->post("post_content"));
        
        $routine_format=$this->input->post("routine_format");
        $routine_count=$this->input->post("routine_count");
    
    echo $post_content;
    
        if ($post_type && $user_id && $post_content && $post_title ){
            $fullpath="betterMe_Ci3/".$config['upload_path'].$file_name;
            $data['inserted']=$this->mentor_model->add_post($post_type,$user_id,$post_title,$date_created,$post_content,$routine_count,$routine_format,$file_name,$fullpath,$activity_type);
                print_r($data);
            if ($data){
        
    
                $this->session->set_flashdata('msgsuccess', 'Diet Plan Successfully Created');
                       
                        redirect(base_url().'mentor/viewDiet');
            }else{
                echo "hi";
            }
        }
    
    }
    else {
        $user_id= $this->session->userdata('id');
  
        $datestring = '%Y-%m-%d %h:%i:%s';
            $time = time();
            
        $date_created=mdate($datestring, $time);
    
    
        $post_type=$this->input->post("post_type");
        $user_id=$this->input->post("user_id");
        $activity_type=$this->input->post("activity_type");
        $post_title=$this->input->post("post_title");
        $post_content=htmlspecialchars($this->input->post("post_content"));
        
        $routine_format=$this->input->post("routine_format");
        $routine_count=$this->input->post("routine_count");
    
    echo $post_content;
    
        if ($post_type && $user_id && $post_content && $post_title ){
            
    
            $data['inserted']=$this->mentor_model->add_post($post_type,$user_id,$post_title,$date_created,$post_content,$routine_count,$routine_format,$activity_type);
                print_r($data);
            if ($data){
        
    
                $this->session->set_flashdata('msgsuccess', 'Diet Plan Successfully Created');
                       
                        redirect(base_url().'mentor/viewDiet');
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

        $posts=$this->mentor_model->get_this_community_post($community_post_id);
        $comments=$this->mentor_model->get_this_community_comment($community_post_id);
        $data['comments']=$comments;
        $data['rows']=$posts;


        $profpic=$this->mentor_model->model_show_profilepic();
        $data['profpic']=$profpic;

        $data['page_title']="View Community Post";
        
        $this->load->view('templates/header',$data);
        $this->load->view('mentor/viewThisCommunityPost', $data);
        $this->load->view('templates/footer');
    }else{
        redirect(base_url().'mentor/logout');
    }
        
}



public function add_community_comment($community_post_id){
    $this->session->set_flashdata('lasId', $community_post_id);


    $community_comment=$this->input->post('community_comment');
    $datestring = '%Y-%m-%d %h:%i:%s';
    $time = time();
    
    $date_created=mdate($datestring, $time);

    echo $community_comment,$date_created;


    if ($community_comment && $community_post_id) {
        $data['inserted']=$this->mentor_model->add_community_comment($community_comment, $date_created, $community_post_id);
           
        if ($data) {
            $this->session->set_flashdata('msgsuccess', 'Comment Plan Successfully Created');
                  
            redirect(base_url().'mentor/view_this_community_post/'.$community_post_id);
        } else {
            echo "hi";
        }
    }
}



public function post_like($post_id,$current_user){
    if (isset($this->session->userdata['id'])) {
        $community_comment=$this->input->post('community_comment');

        if ($post_id && $current_user) {
            $data['inserted']=$this->mentor_model->add_like($post_id, $current_user);
           
            if ($data) {
                // $this->session->set_flashdata('msgsuccess', 'Comment Plan Successfully Created');
                  
            // redirect(base_url().'mentor/view_this_community_post/');
            } else {
                echo "hi";
            }
        }
    } else {
        redirect(base_url().'mentor/logout');
    }
}

public function viewMyProfile(){
    if (isset($this->session->userdata['id'])){
            
        $current_user = $this->session->userdata('id');
        $myInfo=$this->mentor_model->get_my_Profileinfo($current_user);
        $data['myInfo']=$myInfo;
        $data['page_title']="My Profile";
        $this->load->view('templates/header',$data);
        $this->load->view('mentor/myProfile',$data);
        $this->load->view('templates/footer');

    }else{
        redirect(base_url('mentor/logout'));
    }

}
public function editMyProfile(){
    if (isset($this->session->userdata['id'])){

        $current_user = $this->session->userdata('id');
        $myInfo=$this->mentor_model->get_my_Profileinfo($current_user);
        $data['myInfo']=$myInfo;
        $data['page_title']="My Profile";
        $this->load->view('templates/header',$data);
        $this->load->view('mentor/editMyProfile',$data);
        $this->load->view('templates/footer');

    }else{
        redirect(base_url('mentor/logout'));
    }

}

public function updateMyProfile($id){
    if (isset($this->session->userdata['id'])) {
        print_r($id);
        $username=$this->input->post('uname');
        $firstName=$this->input->post('fname');
        $middleName=$this->input->post('mname');
        $lastName=$this->input->post('lname');
        $email=$this->input->post('email');
        $dob=$this->input->post('dob');
        $sex=$this->input->post('sex');
        $password=$this->input->post('pword');
        $age=$this->input->post('age');
        $city=$this->input->post('city');
        $province=$this->input->post('province');
        $contact=$this->input->post('contact_no');
        // $weight=$this->input->post('weight');
        // $height=$this->input->post('height');
 
        $field = array(
        'username'=>$username,
        'email'=>$email,
        'first_name'=>$firstName,
        'middle_name'=>$middleName,
        'last_name'=>$lastName,
        'dob'=>$dob,
        // 'password'=>$password,
        'age'=>$age,
        'sex'=>$sex,
        'city'=>$city,
        'province'=>$province,
        'contact'=>$contact,
     );
        $result = $this->mentor_model->updateMyProfile($field, $id);

        if ($result) {
            $this->session->set_flashdata('msgsuccess', "Post successfully deleted.");

            redirect(base_url('mentor/viewMyProfile'));
        } else {
            $this->session->set_flashdata('msgwarn', "No changes made");
    
            redirect(base_url('mentor/viewMyProfile'));
        }
    }
    else{
        redirect(base_url('mentor/logout'));
    }
   
}


function upload_profilePic(){
    
$this->load->view('mentor/uploadProfilePic');


}


    public function do_upload_profilepic()
    {
        $id=$this->session->userdata('id');
        // $config['upload_path'] = './assets/images/';
        //	$config['allowed_types'] = '*';
        
        $config['upload_path']          = './uploads/profilepic';
        $config['allowed_types']        = 'jpg';
        $config['max_size']             = 100000;
        $config['max_width']            = 100000;
        $config['max_height']           = 100000;
        $config['overwrite']           = true;
        $config['file_name']           = 'profile'.$id;
        

        $datestring = "%Y-%m-%d %h:%i:%s";
        $date_picuploaded =mdate($datestring);
        
       
  


        $this->upload->initialize($config);

        $this->upload->do_upload('userfile');
        //   if (! $this->upload->do_upload('userfile')) {

        
        //  } else {
         
        $data = array('upload_data' => $this->upload->data());
        $file_name=$this->upload->data('file_name');
        if (isset($file_name)) {
            $this->mentor_model->add_profilePic($id, $date_picuploaded, $file_name);
            $this->mentor_model->profilePic_Status($id);

            $this->session->set_flashdata('msgsuccess', "Profile Picture Update Success.");
       redirect(base_url('mentor/viewMyProfile'));
     
        }
            
          
      //  redirect('mentor/viewMyProfile');
    }

    public function show_profilepic(){
         
        $profile_picture=$this->admin_model->model_show_profilepic();
        $data['profile_picture']=$profile_picture;

        foreach ($profile_picture as $picture){
            $filename=$picture['p_name'];
            echo '<img src="'.base_url().'./uploads/profilepic/'.$filename.'" width="350px" height="120px"></a></div>';
        }
      

    }


    public function create_thread(){
        if (isset($this->session->userdata['id'])) {
            $data['page_title']="Create Thread";
            $this->load->view('templates/header', $data);
            $this->load->view('mentor/createThread');
        }else{
            redirect(base_url('mentor/logout'));
        }
    }

    public function post_thread(){
        if (isset($this->session->userdata['id'])) {
        $datestring = '%Y-%m-%d %h:%i:%s';
        $time = time();
        
        $date_created=mdate($datestring, $time);

        $title=$this->input->post('title');
        $description=$this->input->post('description');

        $result=$this->mentor_model->post_thread($title,$description,$date_created);
        if ($result){
            $this->session->set_flashdata('msgsuccess_c',"Save Success");
            redirect(base_url('mentor/homepage'));
        }else{
            $this->session->set_flashdata('msgerror',"Save unsuccessfull");
        }
    }else{
        redirect(base_url('mentor/logout'));
        }
    }


 
    public function editMyComment($comment_id){
        if (isset($this->session->userdata['id'])) {

            $current_user = $this->session->userdata('id');
            $myComments=$this->mentor_model->get_myComment($comment_id);
            $data['myComments']=$myComments;
            $data['page_title']="Edit Comment";
            $this->load->view('templates/header',$data);
            $this->load->view('mentor/editMyComment',$data);
            $this->load->view('templates/footer');
        }
            
    }

    public function updateMyComment($comment_id){
        if (isset($this->session->userdata['id'])) {
            $comment_content=$this->input->post('community_comment');
            $community_post_id=$this->input->post('community_id');
     
            // $height=$this->input->post('height');
 
            $field = array(
        
        'comment_content'=>$comment_content,
     );
            $result = $this->mentor_model->updateMyComment($comment_id, $field);

            if ($result) {
                $this->session->set_flashdata('msgsuccess', "Comment successfully updated.");

                redirect(base_url('mentor/view_this_community_post/'.$community_post_id));
            } else {
                $this->session->set_flashdata('msgwarn', "No changes made");
    
                redirect(base_url('mentor/view_this_community_post/'.$community_post_id));
            }
        }else{
            redirect(base_url('mentor/logout'));
        }
    }
    

    public function editMyCommunityThread($community_id){
        if (isset($this->session->userdata['id'])) {

            $current_user = $this->session->userdata('id');
            $myThread=$this->mentor_model->get_myCommunityThread($community_id);
            $data['myThread']=$myThread;
            $data['page_title']="Edit My Thread";
            $this->load->view('templates/header',$data);
            $this->load->view('mentor/editMyThread',$data);
            $this->load->view('templates/footer');
        }
            else {
                redirect(base_url('mentor/logout'));
            }
    }
    
    public function updateMyThread($thread_id){
        if (isset($this->session->userdata['id'])) {
            $thread_content=$this->input->post('description');
            $thread_title=$this->input->post('title');
     
            // $height=$this->input->post('height');
 
            $field = array(
        'thread_title'=>$thread_title,
        'thread_content'=>$thread_content,
        
     );
            $result = $this->mentor_model->updateMyThread($thread_id, $field);

            if ($result) {
                $this->session->set_flashdata('msgsuccess', "Comment successfully updated.");

                redirect(base_url('mentor/view_this_community_post/'.$thread_id));
            } else {
                $this->session->set_flashdata('msgwarn', "No changes made");
    
                redirect(base_url('mentor/view_this_community_post/'.$thread_id));
            }
        }else{
            redirect(base_url('mentor/logout'));
        }
    }
   
    public function deleteMyComment($comment_id){
        if (isset($this->session->userdata['id'])) {
            $comment_id =  $this->uri->segment(3);
            $thread_id=  $this->uri->segment(4);
            $this->db->delete('tblcommunitycomments', array('comment_id' => $comment_id));
        
            redirect(base_url('mentor/view_this_community_post/'.$thread_id));
        }else{
            redirect(base_url('mentor/logout'));
        }
    }
}
