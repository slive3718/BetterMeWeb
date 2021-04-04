<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
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

	public function index()
	{


	}

	public function signUpUser($username, $password, $email, $account_type)
	{

		$datas = array(
			'username' => $username,
			'email' => $email,
			'password' => password_hash($password, PASSWORD_DEFAULT),
			'account_type' => $account_type
		);
		return $this->db->insert('tblusers', $datas);
	}

	public function loginValidation($uname, $pword)
	{
		$query = $this->db->query("SELECT * FROM tblusers where username='$uname' && account_type='U'");


		if ($query->num_rows() > 0) {
			$row = $query->row_array();


			if (password_verify($pword, $row['password'])) {
				return true;

			} else {

				$this->session->set_flashdata('error', 'Invalid Username or Password !');
				return false;
			}
		} else {
			$this->session->set_flashdata('error', 'Invalid Username or Password !');
			return false;
		}
	}


	public function check_user($username, $email)
	{
		$qstr = $this->db->query("SELECT * FROM tblusers WHERE username='$username' && email='$email' LIMIT 1");

		if ($qstr->num_rows() > 0) {
			$result = $qstr->result_array();
		} else {
			$result = null;
		}
		return $result;
	}


	public function get_session_data()
	{

		$sess_uname = $this->session->userdata('uname');

		$qstr = $this->db->get('tblusers');
		$qstr = $this->db->get_where('tblusers', array('username' => $sess_uname));
		//$query=$this->db->query($qstr);
		if ($qstr->num_rows() > 0) {
			$result = $qstr->result_array();
		} else {
			$result = null;
		}
		return $result;
	}


	 function get_dietPlan()
	{
		$this->db->select('*');
		$this->db->from('tblposts p');
		$this->db->join('tblusers u','p.post_user_id=u.userId');
		$this->db->where ('p.archive !=',1);

		$this->db->order_by('p.date_posted','desc');
		$qstr=$this->db->get();

		if ($qstr->num_rows() > 0 ){
			$return_array = array();
			foreach($qstr->result() as $val){

				$val->images= $this->get_diet_plan_images($val->post_id);
				$val->getLikeStatus = $this->getLikeStatus($val->post_id);
				$val->getLikeCount = $this->getLikeCount($val->post_id);
			}

		}
		$sess_id = $this->session->userdata('id');

		if ($qstr->num_rows() > 0) {
			$result = $qstr->result();
		} else {
			$result = null;
		}
		return $result;
	}

	function get_diet_plan_images($post_id){

		$this->db->select('*');
		$this->db->from('tblimages');
		$this->db->where('post_id', $post_id);
		$this->db->where('image_post_type','diet_plan');
		$this->db->where('image_name!=','');
		$this->db->limit(6);
		$qstr = $this->db->get();
		if ($qstr) {
			return $qstr->result();
		} else {
			return '';
		}
	}
	function get_diet_plan_images_all($post_id){

		$this->db->select('*');
		$this->db->from('tblimages');
		$this->db->where('post_id', $post_id);
		$this->db->where('image_post_type','diet_plan');
		$qstr = $this->db->get();
		if ($qstr) {
			return $qstr->result();
		} else {
			return '';
		}
	}



	public function get_dietPlanFull($post_id)
	{
		$this->db->select('*');
		$this->db->from('tblposts p');
		$this->db->join('tblusers u','p.post_user_id=u.userId');
		$this->db->where ('p.archive !=',1);
		$this->db->where('post_id',$post_id);

		$this->db->order_by('p.date_posted','desc');
		$qstr=$this->db->get();

		if ($qstr->num_rows() > 0 ){
			$return_array = array();
			foreach($qstr->result() as $val){

				$val->images= $this->get_diet_plan_images_all($val->post_id);
			}

		}
		$sess_id = $this->session->userdata('id');

		if ($qstr->num_rows() > 0) {
			$result = $qstr->result();
		} else {
			$result = null;
		}
		return $result;
	}



	public function model_show_profilepic()
	{
		$qstr = $this->db->query('SELECT * from profilepic');


		if ($qstr->num_rows() > 0) {
			$result = $qstr->result_array();
		} else {
			$result = null;
		}
		return $result;
	}


	public function get_community_post()
	{

		$qstr = $this->db->query("SELECT * FROM tblcommunity LEFT JOIN tblusers on tblcommunity.thread_user_id=tblusers.userId where tblcommunity.archive_status !=1 order by tblcommunity.thread_date desc limit 20");

		if ($qstr->num_rows() > 0) {
			$result = $qstr->result_array();
		} else {
			$result = null;
		}
		return $result;

	}


	public function get_my_Profileinfo($current_user)
	{

		$qstr = $this->db->get('tblusers');
		$qstr = $this->db->get_where('tblusers', array('userId' => $current_user));
		//$query=$this->db->query($qstr);
		if ($qstr->num_rows() > 0) {
			$result = $qstr->result_array();
		} else {
			$result = null;
		}
		return $result;
	}


	public function updateMyProfileInfo($field, $id)
	{

		$this->db->where('userId', $id);
		$this->db->update('tblusers', $field);
		// echo $this->db->last_query();

		if ($this->db->affected_rows() == 1) {
			return true;
		} else {
			return false;
		}
	}


	public function add_profilePic($id, $date_picuploaded, $file_name)
	{
		$qstr = $this->db->query("SELECT * FROM profilepic where p_user_id = $id");


		if ($qstr->num_rows() > 0) {
			$data = array(
				'p_user_id' => $id,
				'p_name' => $file_name,

				'p_dateuploaded' => $date_picuploaded,

			);

			return $this->db->update('profilepic', $data);

			$data['userpic'] = array(
				'user_picture_status' => '1'
			);

			return $this->db->update('tblusers', $data['userpic']);
			$this->session->set_flashdata('msgerror', 'Fields cannot be empty');
			exit;
		} else {
			$data = array(
				'p_user_id' => $id,
				'p_name' => $file_name,

				'p_dateuploaded' => $date_picuploaded,

			);

			return $this->db->insert('profilepic', $data);

			$data['userpic'] = array(
				'user_picture_status' => '1'
			);

			return $this->db->insert('tblusers', $data['userpic']);
			$this->session->set_flashdata('msgerror', 'Fields cannot be empty');
			exit;
		}
	}


	public function profilePic_Status($id)
	{
		$data = array(
			'user_picture_status' => '1'
		);

		$this->db->where('userId', $id);
		return $this->db->update('tblusers', $data);

		$this->session->set_flashdata('msgerror', 'Fields cannot be empty');
		exit;
	}


	public function post_thread($title, $desciption, $date_created)
	{
		$id = $this->session->userdata('id');
		$data = array(
			'thread_user_id' => $id,
			'thread_title' => $title,
			'thread_content' => $desciption,
			'thread_date' => $date_created
		);

		return $this->db->insert('tblcommunity', $data);
	}

	public function get_this_community_post($community_post_id)
	{

		$qstr = $this->db->query("SELECT * FROM tblcommunity LEFT JOIN tblusers on tblcommunity.thread_user_id=tblusers.userId where tblcommunity.community_id='$community_post_id'");

		if ($qstr->num_rows() > 0) {
			$result = $qstr->result_array();
		} else {
			$result = null;
		}
		return $result;
	}


	public function get_this_community_comment($community_post_id)
	{
		$qstr = $this->db->query('SELECT * FROM tblcommunitycomments JOIN tblcommunity on tblcommunitycomments.community_id=tblcommunity.community_id left JOIN tblusers on tblcommunitycomments.comment_user_id=tblusers.userId ');


		if ($qstr->num_rows() > 0) {
			$result = $qstr->result_array();
		} else {
			$result = null;
		}
		return $result;
	}

	public function get_myComment($comment_id)
	{

		$qstr = $this->db->query("SELECT * from tblcommunitycomments where comment_id = $comment_id");


		if ($qstr->num_rows() > 0) {
			$result = $qstr->result_array();
		} else {
			$result = null;
		}
		return $result;
	}


	public function updateMyComment($comment_id, $field)
	{
		$this->db->where('comment_id', $comment_id);
		$this->db->update('tblcommunitycomments', $field);
		// echo $this->db->last_query();

		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}


	public function add_community_comment($community_comment, $date_created, $community_post_id)
	{


		$data = array(
			'comment_content' => $community_comment,
			'comment_date' => $date_created,
			'comment_user_id' => $this->session->userdata('id'),
			'community_id' => $community_post_id,

		);


		return $this->db->insert('tblcommunitycomments', $data);

	}


	public function get_myCommunityThread($community_id)
	{
		$qstr = $this->db->query("SELECT * from tblcommunity where community_id = $community_id");


		if ($qstr->num_rows() > 0) {
			$result = $qstr->result_array();
		} else {
			$result = null;
		}
		return $result;
	}


	public function updateMyThread($thread_id, $field)
	{
		$this->db->where('community_id', $thread_id);
		$this->db->update('tblcommunity', $field);
		// echo $this->db->last_query();

		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	function getAllProfileInfo()
	{
		$userid = $this->session->userdata['id'];
		$this->db->select('*');
		$this->db->from('tblusers');
		$this->db->where('userId', $userid);
		$qstr = $this->db->get();

		//$query=$this->db->query($qstr);
		if ($qstr->num_rows() > 0) {
			$return_array = array();
			foreach ($qstr->result() as $val) {
				$val->getAllProfilePost = $this->getAllProfilePost($val->userId);
				$val->getAllusersToFollow = $this->getAllusersToFollow();
				$val->getFollowtbl = $this->getFollowtbl($val->userId);


				// $val->getAllImages=$this->getAllImages($val->userId);
				$return_array[] = $val;
				// echo '<pre>';
				// print_r($return_array);
			}
			return $return_array;
		} else {
			$result = null;
		}
		return '';

	}

	function getAllProfilePost($userid)
	{

		$this->db->select('*');
		$this->db->from('profile_post pp');
//		$this->db->join('tblarchive ar', 'pp.post_id=ar.post_id','left');
		$this->db->where('pp.user_id', $userid);
//		$this->db->where('ar.user_confirm_action!=',"1");
		$this->db->order_by('pp.date','desc');
		$this->db->order_by('pp.post_id','desc');
		$qstr = $this->db->get();
		if ($qstr->num_rows() > 0) {
			$return_array = array();
			foreach ($qstr->result() as $val) {
//				print_r($val->post_id);exit;
				$val->post_images = $this->getImagePerPost($val->post_id);
				$val->getArchiveStatus = $this->getArchiveStatus($val->post_id);

				$return_array[] = $val;
			}
			return $return_array;
		} else {
			return '';
		}
	}


// function getAllImages($userid){

//     $this->db->select('*');
//     $this->db->from('tblimages');
//     $this->db->where('user_id', $userid);
//     $qstr=$this->db->get();  
//     if ($qstr->num_rows()>0) {
//         return $qstr->result();
//     } else {
//         return '';
//     }
// }

	function get_post_id($userid)
	{

		$this->db->select('*');
		$this->db->from('tblpost_id');
		$this->db->where('user_id', $userid);
		$qstr = $this->db->get();
		if ($qstr->num_rows() > 0) {
			return $qstr->result();
		} else {
			return '';
		}
	}

	function getAllusersToFollow()
	{
		$sessId = $this->session->userdata['id'];
		$this->db->select('*');
		$this->db->from('tblusers');
		$this->db->where('account_type!=', '1');
		$this->db->where('userId!=', $sessId);
		$qstr = $this->db->get();
		if ($qstr->num_rows() > 0) {
			return $qstr->result();
		} else {
			return '';
		}
	}

	function getAllusers()
	{

		$this->db->select('*');
		$this->db->from('tblusers');
		// $this->db->where('account_type!=');
		$qstr = $this->db->get();
		if ($qstr->num_rows() > 0) {
			return $qstr->result();
		} else {
			return '';
		}
	}


	function getVisitProfileInfo($profile_id)
	{
		$sessId = $this->session->userdata['id'];
		$this->db->select('*');
		$this->db->from('tblusers');
		$this->db->where('userId', $profile_id);
		$qstr = $this->db->get();
		//$query=$this->db->query($qstr);
		if ($qstr->num_rows() > 0) {
			$return_array = array();
			foreach ($qstr->result() as $val) {
				$val->getAllProfilePost = $this->getAllProfilePost($profile_id);
				$val->getAllusersToFollow = $this->getAllusersToFollow();
				$val->getImagePerPost = $this->getImagePerPost($val->userId);
				$return_array[] = $val;
			}
			return $return_array;
		} else {
			$result = null;
		}
		return '';

	}

	function followUser($userId)
	{
		$sessId = $this->session->userdata['id'];
		$this->db->select('*');
		$this->db->from('tblfollow');
		$this->db->where('follower_id=', $sessId);
		$this->db->where('following_id=', $userId);
		$qstr = $this->db->get();
		// print_r($qstr);exit;
		if ($qstr->num_rows() >= 1) {
			foreach ($qstr->result() as $res) {
				// print_r($res);exit;
				if ($res->subscribe == 1) {
					$this->db->select('*');
					$this->db->from('tblfollow');
					$this->db->where('follower_id=', $sessId);
					$this->db->where('following_id=', $userId);
					$set = array('follower_id' => $sessId, 'following_id' => $userId, 'subscribe' => '0');
					return $this->db->update('tblfollow', $set);
				} else {
					$this->db->select('*');
					$this->db->from('tblfollow');
					$this->db->where('follower_id=', $sessId);
					$this->db->where('following_id=', $userId);
					$set = array('follower_id' => $sessId, 'following_id' => $userId, 'subscribe' => '1');
					return $this->db->update('tblfollow', $set);
				}
			}
			// print_r("here");exit;

		} else {
			$set = array('follower_id' => $sessId, 'following_id' => $userId, 'subscribe' => '1');
			return $this->db->insert('tblfollow', $set);
		}

	}

	function getFollowtbl($sessId)
	{

		$this->db->select('*');
		$this->db->from('tblfollow');
		$this->db->where('follower_id', $sessId);
		$qstr = $this->db->get();

		return $qstr->result();
	}

	function getAllFollowedUserPosts()
	{

		$sessId = $this->session->userdata['id'];
		$this->db->select('*');
		$this->db->from('profile_post s');
		$this->db->join('tblfollow f', 's.user_id=f.following_id');
		$this->db->join('tblusers u', 's.user_id=u.userId');
		// $this->db->where('f.follower_id',$sessId);
		$this->db->where('f.follower_id', $sessId);
		$this->db->where('f.subscribe=', '1');
		$this->db->order_by('s.date', 'desc');
		$qstr = $this->db->get();

		if ($qstr) {
			$return_array = array();
			foreach ($qstr->result() as $val) {
				// print_r($val->following_id);exit;
//			$val->getFollowedInfo= $this->getFollowedInfo($val->following_id);
				$val->getImagePerPost = $this->getImagePerPost($val->post_id);
				$return_array[] = $val;
			}
			return $return_array;
		} else {
			return '';
		}

		// print_r($qstr->result());
		return '';
	}

	function getAllSubscribe($userid)
	{
		$this->db->select('*');
		$this->db->from('profile_post p');
		$this->db->join('tblusers u', 'p.user_id=u.userId');
		$this->db->where('user_id', $userid);
		$qstr = $this->db->get();
		if ($qstr->result() > 0) {

			return $qstr->result();
		}

	}

	function getImagePerPost($post_id)
	{
		$this->db->select('*');
		$this->db->from('tblimages');
		$this->db->where('post_id', $post_id);
		$qstr = $this->db->get();
		if ($qstr) {
			return $qstr->result();
		} else {
			return '';
		}
	}

	function remove_myProfilePost($post_id){
		$this->db->select('*');
		$this->db->from('profile_post');
		$this->db->where('post_id',$post_id);
		$this->db->delete();

	}

	function get_editMyProfilePost($post_id){
		$this->db->select('pp.*');
		$this->db->select('u.user_picture_status');
		$this->db->from('profile_post pp');
		$this->db->join('tblusers u','pp.user_id= u.userId');
		$this->db->where('post_id',$post_id);
		$result= $this->db->get();

		if ($result){
			return $result->result();
		}else{
			return '';
		}

	}


	function getImagesInPost($post_id){

		$this->db->select ('*');
		$this->db->from ('tblimages');
		$this->db->where ('post_id',$post_id);
		$result= $this->db->get();

		if($result->result() > 0 ){
			return $result;
		}else{
			return 'no image';
		}
	}

	function likeHomepagePost($post_id){
		$this->db->select ('*');
		$this->db->from ('tbllikes');
		$this->db->where ('like_post_id',$post_id);
		$this->db->where ('like_from_id',$this->session->userdata('id'));
		$getDb = $this->db->get();

		if ($getDb->num_rows() > 0 ){
			foreach($getDb->result() as $db){
				$status=$db->like_status;
			}
			if($status=='1'){
				$int_array = array(
					'like_status'=>'0',
				);

				$this->db->where ('like_post_id',$post_id);
				$this->db->where ('like_from_id',$this->session->userdata('id'));
				$this->db->update('tbllikes',$int_array);
				return '1';
			}else{
				$int_array = array(
					'like_status'=>'1',
				);

				$this->db->where ('like_post_id',$post_id);
				$this->db->where ('like_from_id',$this->session->userdata('id'));
				$this->db->update('tbllikes',$int_array);
				return '2';
			}

		}else{
			$int_array = array(
				'like_from_id'=>$this->session->userdata('id'),
				'like_post_id'=>$post_id,
				'like_status'=>'1',
			);
			$this->db->insert('tbllikes',$int_array);
			return '2';
		}
		return '';
	}

	function getLikeStatus($post_id){
		$this->db->select ('like_status');
		$this->db->from ('tbllikes');
		$this->db->where ('like_post_id',$post_id);
		$this->db->where ('like_from_id',$this->session->userdata('id'));
		$getDb = $this->db->get();

		if($getDb->num_rows() >0){

			return $getDb->result();

		}else{
			return '';
		}
	}
	function getLikeCount($post_id){
		$this->db->select('*');
		$this->db->from ('tbllikes');
		$this->db->where ('like_post_id',$post_id);
		$this->db->where ('like_status=','1');
		$getDb = $this->db->get();

		if($getDb->num_rows() > 0){
			 return $getDb->num_rows();
		}else{
			return '';
		}

	}

	function getTopDiets(){

//		SELECT * FROM `tbllikes` join tblposts on tbllikes.like_post_id = tblposts.post_id group by like_post_id
//		SELECT sum(like_status) FROM `tbllikes` group by like_post_id


		$this->db->select('*');
		$this->db->select('(SELECT SUM(like_status)) AS like_sum');
		$this->db->from('tbllikes l');
		$this->db->join('tblposts p','l.like_post_id=p.post_id','left');
		$this->db->group_by('l.like_post_id');
		$this->db->order_by('like_sum','desc');
		$this->db->limit(10);
		$getDb = $this->db->get();
//		echo "<pre>";
//		print_r($getDb->result());
//
//		exit;
		if($getDb->num_rows()>0){

			return $getDb->result();
		}else{
			return '';
		}
	}

	function getArchiveStatus($post_id){
		$this->db->select('*');
		$this->db->from('tblarchive');
		$this->db->where('archive_from=','profile_posts');
		$this->db->where('post_id=',$post_id);

		$result=$this->db->get();
		if ($result){
			return $result->result();
		}else{
			return '';
		}
	}

	function confirm_read_archived_post($post_id){
		$this->db->select('*');
		$this->db->from('tblarchive');
		$this->db->where('archive_from=','profile_posts');
		$this->db->where('post_id=',$post_id);

		$result=$this->db->update('tblarchive',array('user_confirm_action'=>'1'));
		if ($result){
			return $result;
		}else{
			return '';
		}
	}
}
