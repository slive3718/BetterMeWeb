<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->database();
        $this->load->model('user_model');
        $this->load->library('form_validation');
        $this->load->helper('date');
        $this->load->library('upload');
      
        date_default_timezone_set("Asia/Kuala_Lumpur");

		$account_type=$this->session->userdata('account_type');
		if($account_type && $account_type != 'U' ){
			$this->session->sess_destroy();
			$this->load->view('user/login');

		}

    }
    public function index()
    {
        redirect(base_url(). 'user/check_session');
    }

    public function viewLogin()
    {
        $this->load->view('user/login');
    }


     
    
    public function validateUser()
    {
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run()) {
            $uname= $this->input->post('username');
            $pword= $this->input->post('password');

                
            //   print_r($this->session);
            if ($this->user_model->loginValidation($uname, $pword)) {
                $session_data = array(
                                  'uname'=>$uname,
                                  
                                );
                           
                $this->session->set_userdata($session_data);
                redirect(base_url(). 'user/check_session');
            } else {
                $this->session->set_flashdata('msgerror', 'Invalid Username and Password');
                redirect(base_url(). 'user/viewLogin');
            }
        } else {
            $this->session->set_flashdata('msgerror', 'Invalid Username and Password');
            redirect(base_url(). 'user/viewLogin');
        }
    }

     
    public function check_session()
    {
        $sess=$this->user_model->get_session_data();
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
        redirect(base_url().'user/homepage');
    }

    
    public function logout()
    {
        $this->session->unset_userdata('uname');
        $this->session->sess_destroy();
        redirect(base_url().'user/viewLogin');
    }


    public function viewSignUp()
    {
        $this->load->view('user/createAccount');
    }



    public function signUp()
    {
        if ($this->input->post('submit')) {
            $username= $this->input->post('username');
            $password= $this->input->post('password');
            $confirmpassword= $this->input->post('confirmpassword');
            $email= $this->input->post('email');
            $account_type= $this->input->post('account_type');
        }

        if ($username && $password && $email && $confirmpassword) {
            if ($confirmpassword != $password) {
                $this->session->set_flashdata('msgerror', 'Password did not match');
                redirect(base_url().'user/viewSignUp');
                exit;
            }


            $checkuser_query=$this->user_model->check_user($username, $email);

            if ($checkuser_query > 0) {
                $this->session->set_flashdata('msgerror', 'Username or Email already in used');
                    
                redirect(base_url().'user/viewSignUp');
            } else {
                $data['inserted']=$this->user_model->signUpUser($username, $password, $email, $account_type);

                if ($data) {
                    $this->session->set_flashdata('msgsuccess', 'Registration Success');
                    if ($account_type ="U") {
                        redirect(base_url().'user/viewLogin');
                    } else {
                        redirect(base_url().'user/viewLogin');
                    }
                }
            }
        } else {
            $this->session->set_flashdata('msgerror', 'Fill up all fields');
        	redirect(base_url().'user/viewSignUp');
        }
    }

 

    public function homepage()
    {
        $posts=$this->user_model->get_dietPlan();
        $data['rows']=$posts;

        $profpic=$this->user_model->model_show_profilepic();
        $data['profpic']=$profpic;

        $community_posts=$this->user_model->get_community_post();
        $data['community_posts']=$community_posts;

		$data['getTopDiets'] = $this->user_model->getTopDiets();

        $data['page_title']= "Homepage";

        $this->load->view('user/templates/header', $data);
        $this->load->view('user/homepage', $data);
        $this->load->view('user/homeCommentModal');
    }

   

    public function get_session_data()
    {
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



    public function gotoMentor()
    {
        $this->load->view('mentor/login');
    }




    public function view_community()
    {
    }
    public function view_this_community_post($community_post_id)
    {
        if (isset($this->session->userdata['id'])) {
            $posts=$this->user_model->get_this_community_post($community_post_id);
            $comments=$this->user_model->get_this_community_comment($community_post_id);
            $data['comments']=$comments;
            $data['rows']=$posts;

            $profpic=$this->user_model->model_show_profilepic();
            $data['profpic']=$profpic;

            $data['page_title']="View Community Post";
            $this->load->view('user/templates/header', $data);
            $this->load->view('user/viewThisCommunityPost', $data);
            $this->load->view('user/templates/footer');
        } else {
            redirect(base_url().'user/logout');
        }
    }


    public function viewFullDiet($post_id)
    {
        if (isset($this->session->userdata['id'])) {
            $posts=$this->user_model->get_dietPlanFull($post_id);
            $data['rows']=$posts;
			$data['comments'] = $this->user_model->getCommentHomepage($post_id);
            $data['page_title']= "Diet Post";

            $this->load->view('user/templates/header', $data);
            $this->load->view('user/viewFullDietPlan', $data);
            $this->load->view('user/templates/footer');
        } else {
            redirect(base_url().'user/logout');
        }
    }



    public function viewMyProfileInfo()
    {
        if (isset($this->session->userdata['id'])) {
            $current_user = $this->session->userdata('id');
            $myInfo=$this->user_model->get_my_Profileinfo($current_user);
            $data['myInfo']=$myInfo;
            $data['page_title']="Profile Settings";
            $this->load->view('user/templates/header', $data);
            $this->load->view('user/myProfileInfo', $data);
            $this->load->view('user/templates/footer');
        } else {
            redirect(base_url('user/logout'));
        }
    }

    public function editMyProfile()
    {
        if (isset($this->session->userdata['id'])) {
            $current_user = $this->session->userdata('id');
            $myInfo=$this->user_model->get_my_Profileinfo($current_user);
            $data['myInfo']=$myInfo;
            $data['page_title']="My Profile";
            $this->load->view('user/templates/header', $data);
            $this->load->view('user/editMyProfile', $data);
            $this->load->view('user/templates/footer');
        }
    }
    

    public function updateMyProfileInfo($id)
    {
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
            $result = $this->user_model->updateMyProfileInfo($field, $id);

            if ($result) {
                $this->session->set_flashdata('msgsuccess', "Profile successfully updated.");

                redirect(base_url('user/viewMyProfileInfo'));
            } else {
                $this->session->set_flashdata('msgwarn', "No changes made");
    
                redirect(base_url('user/viewMyProfileInfo'));
            }
        } else {
            redirect(base_url('user/logout'));
        }
    }



    public function upload_profilePic()
    {
        $this->load->view('user/uploadProfilePic');
    }

    

    public function do_upload_profilepic()
    {
        $id=$this->session->userdata('id');
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
        $data = array('upload_data' => $this->upload->data());
        $file_name=$this->upload->data('file_name');
        if (isset($file_name)) {
            $this->user_model->add_profilePic($id, $date_picuploaded, $file_name);
            $this->user_model->profilePic_Status($id);

            $this->session->set_flashdata('msgsuccess', "Profile Picture Update Success.");
            redirect(base_url('user/viewMyProfileInfo'));
        }
    }
    
    public function create_thread(){
        if (isset($this->session->userdata['id'])) {
            $data['page_title']="Create Thread";
            $this->load->view('user/templates/header', $data);
            $this->load->view('user/createThread');
        }else{
            redirect(base_url('user/logout'));
        }
    }
    
    public function post_thread()
    {
        $datestring = '%Y-%m-%d %h:%i:%s';
        $time = time();
            
        $date_created=mdate($datestring, $time);
    
        $title=$this->input->post('title');
        $description=$this->input->post('description');
    
        $result=$this->user_model->post_thread($title, $description, $date_created);
        if ($result) {
            $this->session->set_flashdata('msgsuccess_c', "Save Success");
            redirect(base_url('user/homepage'));
        } else {
            $this->session->set_flashdata('msgerror', "Save unsuccessfull");
        }
    }
    
        
        
 
    public function editMyComment($comment_id)
    {
        if (isset($this->session->userdata['id'])) {
            $current_user = $this->session->userdata('id');
            $myComments=$this->user_model->get_myComment($comment_id);
            $data['myComments']=$myComments;
            $data['page_title']="Edit Comment";
            $this->load->view('user/templates/header', $data);
            $this->load->view('user/editMyComment', $data);
            $this->load->view('templates/footer');
        }
    }

    public function updateMyComment($comment_id)
    {
        $comment_content=$this->input->post('community_comment');
        $community_post_id=$this->input->post('community_id');
     
        // $height=$this->input->post('height');
 
        $field = array(
        
        'comment_content'=>$comment_content,
     );
        $result = $this->user_model->updateMyComment($comment_id, $field);

        if ($result) {
            $this->session->set_flashdata('msgsuccess', "Comment successfully updated.");

            redirect(base_url('user/view_this_community_post/'.$community_post_id));
        } else {
            $this->session->set_flashdata('msgwarn', "No changes made");
    
            redirect(base_url('user/view_this_community_post/'.$community_post_id));
        }
    }
    

    
    public function add_community_comment($community_post_id)
    {
        $this->session->set_flashdata('lasId', $community_post_id);


        $community_comment=$this->input->post('community_comment');
        $datestring = '%Y-%m-%d %h:%i:%s';
        $time = time();
    
        $date_created=mdate($datestring, $time);

        echo $community_comment,$date_created;


        if ($community_comment && $community_post_id) {
            $data['inserted']=$this->user_model->add_community_comment($community_comment, $date_created, $community_post_id);
           
            if ($data) {
                $this->session->set_flashdata('msgsuccess', 'Comment Plan Successfully Created');
                  
                redirect(base_url().'user/view_this_community_post/'.$community_post_id);
            } else {
                echo "hi";
            }
        }
    }



    public function editMyCommunityThread($community_id)
    {
        if (isset($this->session->userdata['id'])) {
            $current_user = $this->session->userdata('id');
            $myThread=$this->user_model->get_myCommunityThread($community_id);
            $data['myThread']=$myThread;
            $data['page_title']="Edit My Thread";
            $this->load->view('user/templates/header', $data);
            $this->load->view('user/editMyThread', $data);
            $this->load->view('templates/footer');
        } else {
            redirect(base_url('user/logout'));
        }
    }

    public function updateMyThread($thread_id)
    {
        if (isset($this->session->userdata['id'])) {
            $thread_content=$this->input->post('description');
            $thread_title=$this->input->post('title');
 
            // $height=$this->input->post('height');

            $field = array(
    'thread_title'=>$thread_title,
    'thread_content'=>$thread_content,
    
 );
            $result = $this->user_model->updateMyThread($thread_id, $field);

            if ($result) {
                $this->session->set_flashdata('msgsuccess', "Comment successfully updated.");

                redirect(base_url('user/view_this_community_post/'.$thread_id));
            } else {
                $this->session->set_flashdata('msgwarn', "No changes made");

                redirect(base_url('user/view_this_community_post/'.$thread_id));
            }
        } else {
            redirect(base_url('user/logout'));
        }
    }

    public function deleteMyComment($comment_id)
    {
        if (isset($this->session->userdata['id'])) {
            $comment_id =  $this->uri->segment(3);
            $thread_id=  $this->uri->segment(4);
            $this->db->delete('tblcommunitycomments', array('comment_id' => $comment_id));
    
            redirect(base_url('user/view_this_community_post/'.$thread_id));
        } else {
            redirect(base_url('user/logout'));
        }
    }

    public function myProfile()
    {
        $userid=$this->session->userdata['id'];
        if ($userid) {
            $data['user_info']=$this->user_model->getAllProfileInfo();
            // $data['profile_post_info']=$this->user_model->get_my_Profileinfo($userid);
            $data['page_title']="My Profile";
            $this->load->view("user/templates/headerProfile", $data);
            $this->load->view("user/myProfile", $data);
            // $this->load->view("user/templates/footer");
        }
    }


    public function following()
    {
        $session_id=$this->session->userdata['id'];
        if ($session_id) {
            $data['user_info']=$this->user_model->getAllProfileInfo();
   
            // $this->load->view("user/templates/header");
            $data['page_title']="Follow People";
            $this->load->view("user/templates/headerProfile", $data);
            $this->load->view("user/following", $data);
            // $this->load->view("user/templates/footer");
        }
    }


    
    public function followers()
    {
        $session_id=$this->session->userdata['id'];
        if ($session_id) {
            $data['user_info']=$this->user_model->get_my_Profileinfo($session_id);
    
            // $this->load->view("user/templates/header");
            $data['page_title']="My Followers";
            $this->load->view("user/templates/headerProfile", $data);
            $this->load->view("user/followers", $data);
            // $this->load->view("user/templates/footer");
        }
    }

    public function create_profile_post()
    {
        $user_id=$this->session->userdata['id'];
        $post = $this->input->post();
        $int_array = array(
        'content' => $post['content'],
        'user_id'=>$user_id,
        'date'=> date('Y-m-d'),
    );
        $last_post=$this->user_model->get_post_id();
        if ($last_post){
            $result=$this->db->insert("profile_post", $int_array);
        
        }
        if ($result) {
            echo "success";
        } else {
            echo "error";
        }
    
} 

public function do_upload(){
    $post = $this->input->post();
    $id=$this->session->userdata('id');
    $config['upload_path']          = './uploads/profile_posts';
    $config['allowed_types']        = 'jpg|png|jpeg|avi|mp4|';
    $config['max_size']             = 100000;
    $config['max_width']            = 100000;
    $config['max_height']           = 100000;
    // $config['overwrite']           = true;
    // $config['file_name']           = 'profile'.$id;

 
    $datestring = "%Y-%m-%d %h:%i:%s";
    // $date_picuploaded =mdate($datestring);
    
    $dataInfo = array();
    $files = $_FILES;
    $cpt = count($_FILES['userfile']['name']);
    $cpt = count($_FILES['userfile']['name']);
    for($i=0; $i<$cpt; $i++)
    {           
        $_FILES['userfile']['name']= $files['userfile']['name'][$i];
        $_FILES['userfile']['type']= $files['userfile']['type'][$i];
        $_FILES['userfile']['tmp_name']= $files['userfile']['tmp_name'][$i];
        $_FILES['userfile']['error']= $files['userfile']['error'][$i];
        $_FILES['userfile']['size']= $files['userfile']['size'][$i];    

        $this->upload->initialize($config);
        $this->upload->do_upload();
        $dataInfo[] = $this->upload->data();
    }
$image_arr = array();
    foreach ($dataInfo as $info) {
            $image_name=($info['file_name']);
            array_push($image_arr,$image_name);
    }

    // print_r(implode('/',$image_arr));
    // exit;

    $int_array = array(
        'content' => $post['content'],
        'user_id'=>$id,
        'date'=> date('Y-m-d'),
        'image_name'=>implode('/',$image_arr),
    );
   
     $result=$this->db->insert("profile_post", $int_array);
    exit;

        // // print_r($dataInfo);
        // foreach ($dataInfo as $info){
        //     print_r($info['file_name']);
        //      $image_info = array(
        //         'image_name' =>($info['file_name']),
        //         'post_id'=>"",
        //         'user_id'=>$id,
        //         'date_created'=> date('Y-m-d'),
        //     );
        //      $result=$this->db->insert("tblimages", $image_info);
        // }
       

 }


 public function visit_profile($profile_id){
    $userid=$this->session->userdata('id');
    if ($userid) {
        $data['user_info']=$this->user_model->getVisitProfileInfo($profile_id);
        $data['page_title']="Profile Visit";
        $this->load->view("user/templates/headerProfile", $data);
        $this->load->view('user/visitProfile',$data);
        // $this->load->view("user/templates/footer");
    }
 }

 public function follow_user($userId){
    
    $sessId=$this->session->userdata('id');
    if ($sessId) {
        $data['user_info']=$this->user_model->followUser($userId);
        redirect(base_url().'user/following');
    }
       

 }

 
 public function follow_user_Jquery(){
     $post=$this->input->post();
    $userId=$post['userId'];
    $sessId=$this->session->userdata('id');
    if ($sessId) {
        $data['user_info']=$this->user_model->followUser($userId);
    if($data){
        echo "success";
    }else{
        echo "error"; 
    }    
    }
 }

 public function followed_user(){
    $data['user_info']=$this->user_model->getAllProfileInfo();
    $data['followedUsersDatas']=$this->user_model->getAllFollowedUserPosts();
    $data['page_title']="Followed People";
    $this->load->view("user/templates/headerProfile", $data);
    $this->load->view('user/followedUser',$data);
    }

public function add_new_post(){
        $post = $this->input->post();
        $id=$this->session->userdata('id');
        $config['upload_path']          = './uploads/profile_posts';
        $config['allowed_types']        = 'jpg|png|jpeg|gif|';
        $config['max_size']             = 100000;
        $config['max_width']            = 100000;
        $config['max_height']           = 100000;
        $datestring = "%Y-%m-%d %h:%i:%s";

        $dataInfo = array();
        $files = $_FILES;
        $cpt = count($_FILES['userfile']['name']);
        $cpt = count($_FILES['userfile']['name']);
        for($i=0; $i<$cpt; $i++)
        {           
            $_FILES['userfile']['name']= $files['userfile']['name'][$i];
            $_FILES['userfile']['type']= $files['userfile']['type'][$i];
            $_FILES['userfile']['tmp_name']= $files['userfile']['tmp_name'][$i];
            $_FILES['userfile']['error']= $files['userfile']['error'][$i];
            $_FILES['userfile']['size']= $files['userfile']['size'][$i];    
    
            $this->upload->initialize($config);
            $this->upload->do_upload();
            $dataInfo[] = $this->upload->data();
        }

        $int_array = array(
            'content' => $post['content'],
            'user_id'=>$id,
            'date'=> date('Y-m-d'),
        );
       
         $result=$this->db->insert("profile_post", $int_array);
         $res_id=$this->db->insert_id();
				if(is_uploaded_file($_FILES['userfile']['tmp_name'])){
                    $image_arr = array();
                    foreach ($dataInfo as $info) {
                            $image_name=($info['file_name']);
                            // array_push($image_arr,$image_name);
                            $result=$this->db->insert("tblimages", array('image_name'=>$image_name,'post_id'=>$res_id,'user_id'=>$id,'date_created'=>date('Y-m-d')));
                    }
                    redirect(base_url('user/myProfile'));
                }
    }

	public function remove_myProfilePost($post_id)
	{
		$result = $this->user_model->remove_myProfilePost($post_id);
		if($result > 0 ){
			redirect(base_url().'user/myProfile');
			$this->session->set_flashdata('msgsuccess', ' Profile Post Successfully Removed ');
		}
		else{
			redirect(base_url().'user/myProfile');
			$this->session->set_flashdata('msgwarn', ' No changes made ');
		}
	}
	public function edit_myProfilePost($post_id){
		$result = $this->user_model->get_editMyProfilePost($post_id);

		if($result){
			$data['gotMyProfilePost']=$result;
            $data['page_title']="Edit My Profile Post";
			$this->load->view("user/templates/header", $data);
			$this->load->view('user/editMyProfilePost',$data);
		}
		else{
			echo "Error 123 Something wrong please tell the Administrator";
		}
	}


	public function getImagesInPost(){

		$post_id = $this->input->post('postId');
		$result=$this->user_model->getImagesInPost($post_id);
		if($result){

			echo json_encode($result->result());

		}else{
			echo json_encode(array());
		}
	}

	public function removeImageInPost(){

		$post_id = $this->input->post('postId');
		$image_id= $this->input->post('imageId');


		$this->db->select('*');
		$this->db->from('tblimages');
		$this->db->where('post_id',$post_id);
		$this->db->where('image_id',$image_id);
		$result= $this->db->delete();
		if($result){
			echo $result;
		}else{
			echo '';
		}
	}


	public function update_profilePost($post_id){

			$post = $this->input->post();
			$id=$this->session->userdata('id');
			$post_id= $post_id;

			$config['upload_path']          = './uploads/profile_posts';
			$config['allowed_types']        = 'jpg|png|jpeg|gif|';
			$config['max_size']             = 100000;
			$config['max_width']            = 100000;
			$config['max_height']           = 100000;
			$datestring = "%Y-%m-%d %h:%i:%s";

			$dataInfo = array();
			$files = $_FILES;
			$cpt = count($_FILES['userfile']['name']);
			$cpt = count($_FILES['userfile']['name']);
			for($i=0; $i<$cpt; $i++)
			{
				$_FILES['userfile']['name']= $files['userfile']['name'][$i];
				$_FILES['userfile']['type']= $files['userfile']['type'][$i];
				$_FILES['userfile']['tmp_name']= $files['userfile']['tmp_name'][$i];
				$_FILES['userfile']['error']= $files['userfile']['error'][$i];
				$_FILES['userfile']['size']= $files['userfile']['size'][$i];

				$this->upload->initialize($config);
				$this->upload->do_upload();
				$dataInfo[] = $this->upload->data();
			}

			$int_array = array(
				'content' => $post['content'],
				'user_id'=>$id,
				'date'=> date('Y-m-d'),
			);

			$this->db->where('post_id',$post_id);
			$result=$this->db->update("profile_post", $int_array);
				if(is_uploaded_file($_FILES['userfile']['tmp_name'])){
				$image_arr = array();
				foreach ($dataInfo as $info) {
					$image_name=($info['file_name']);
					// array_push($image_arr,$image_name);
					$result=$this->db->insert("tblimages", array('image_name'=>$image_name,'post_id'=>$post_id,'user_id'=>$id,'date_created'=>date('Y-m-d')));
				}
                
			}
            redirect(base_url('user/myProfile'));


	}

	public function likeHomepagePost(){
    	$post=$this->input->post();
    	$post_id=$post['postId'];
    	$result=$this->user_model->likeHomepagePost($post_id);
		if($result=="2"){
			echo 'like';
		}else if ($result=='1'){
			echo 'unlike';
		}else{
			echo 'error';
		}
	}

	public function confirm_read_archived_post(){
		$post=$this->input->post();
		$post_id=$post['postId'];
		print_r($post['postId']);
		$result=$this->user_model->confirm_read_archived_post($post_id);
		if($result=="1"){
		echo "success";
		}else {
		echo "error";
		}
	}

	public function getCommentHomepage(){

	}

	public function addCommentHomepage(){
    	$post=$this->input->post();
		$result = $this->user_model->addCommentHomepage($post);
		if ($result){
			$result_array = array('status'=>'success' );
		}else{
			$result_array = array('status'=>'error');
		}
		echo json_encode($result_array);
	}

	public function deleteMyCommentHomepage(){
		$post=$this->input->post();
		$this->db->where('id',$post['commentId']);
		$result = $this->db->delete('tblpostcomment');
			if($result){
				$result_array = array("status" => "success");
			}else{
				$result_array = array('status'=>'error');
			}

		echo json_encode($result_array);
	}
}
