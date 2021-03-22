<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mentor_model extends CI_Model
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

	public function signUpmentor($username, $password, $email, $account_type)
	{
		$data = array(
			'username' => $username,
			'email' => $email,
			'password' => password_hash($password, PASSWORD_DEFAULT),
			'account_type' => $account_type
		);
		return $this->db->insert('tblusers', $data);
	}

	public function loginValidation($uname, $pword)
	{
		$query = $this->db->query("SELECT * FROM tblusers where username='$uname' && account_type='M'");

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

	public function add_post($post_type, $user_id, $post_title, $date_created, $post_content, $routine_count, $routine_format, $file_name, $fullpath, $type_of_diet)
	{

		$data = array(
			'post_image_name' => $file_name,
			'post_type' => $post_type,
			'post_user_id' => $user_id,
			'post_title' => $post_title,
			'date_posted' => $date_created,
			'post_content' => $post_content,
			'routine_count' => $routine_count,
			'routine_format' => $routine_format,
			'post_image_url' => $fullpath,
			'type_of_diet' => $type_of_diet,
		);

		return $this->db->insert('tblposts', $data);
	}

	public function get_posts()
	{
		$sess_id = $this->session->userdata('id');

		$qstr = $this->db->query("SELECT * from tblposts LEFT JOIN tblusers on tblposts.post_user_id = tblusers.userId WHERE tblposts.post_user_id='$sess_id' ");
		//$qstr=$this->db->get_where('tblposts', array('post_type'=> 'Diet_Plan'));
		//$query=$this->db->query($qstr);


		if ($qstr->num_rows() > 0) {
			$result = $qstr->result_array();
		} else {
			$result = null;
		}
		return $result;
	}


	public function edit_diet($post_id)
	{

		$this->db->where('post_id', $post_id);
		$query = $this->db->get('tblposts');
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		} else {
			$result = null;
		}
		return $result;
	}


	public function update_dietPlan($field, $post_id)
	{


		$this->db->where('post_id', $post_id);
		$this->db->update('tblposts', $field);
		// echo $this->db->last_query();

		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}


	public function get_dietPlan()
	{
			$userId=$this->session->userdata['id'];

		$this->db->select('*');
		$this->db->from('tblposts p');
		$this->db->join('tblusers u', 'p.post_user_id=u.userId');
		$this->db->where('p.archive !=', 1);
		$this->db->where('u.userId',$userId);
		$this->db->order_by('p.date_posted', 'desc');
		$qstr = $this->db->get();
//    $qstr=$this->db->query("SELECT * FROM tblposts LEFT JOIN tblusers on tblposts.post_user_id=tblusers.userId where tblposts.archive != 1 order by tblposts.date_posted desc");
		$sess_id = $this->session->userdata('id');

		if ($qstr->num_rows() > 0) {
			$return_array = array();
			foreach ($qstr->result() as $val)
			{
				$val->images = $this->get_diet_plan_images($val->post_id);
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

	function get_diet_plan_images($post_id)
	{

		$this->db->select('*');
		$this->db->from('tblimages');
		$this->db->where('post_id', $post_id);
		$this->db->where('image_post_type', 'diet_plan');
		$this->db->limit(4);
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

				$val->images= $this->get_diet_plan_images($val->post_id);
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
	public function upload($file_name)
	{
		$data = array(

			'post_image_name' => $file_name,

		);

		return $this->db->insert('tblposts', $data);
	}


	public function get_community_post()
	{

		$qstr = $this->db->query("SELECT * FROM tblcommunity LEFT JOIN tblusers on tblcommunity.thread_user_id=tblusers.userId where tblcommunity.archive_status != 1 order by tblcommunity.thread_date desc");

		if ($qstr->num_rows() > 0) {
			$result = $qstr->result_array();
		} else {
			$result = null;
		}
		return $result;

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


	public function add_community_comment($community_comment, $date_created, $community_post_id)
	{


		$data = array(
			'comment_content' => $community_comment,
			'comment_date' => $date_created,
			'comment_user_id' => $this->session->userdata('id'),
			'community_id' => $community_post_id,

		);

		print_r($data);
		return $this->db->insert('tblcommunitycomments', $data);

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


	public function archive_post($field, $post_id)
	{

		$this->db->where('post_id', $post_id);
		$this->db->update('tblposts', $field);
		// echo $this->db->last_query();

		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}

	}

	public function add_like($post_id, $current_user)
	{

		$data = array(
			'like_post_id' => $post_id,
			'like_user_id' => $current_user,

		);

		print_r($data);
		return $this->db->insert('tblcommunitycomments', $data);

	}

	public function update_like($post_id, $current_user)
	{
		$qstr = $this->db->query("SELECT * FROM tblposts where post_id = $post_id");
		// $this->db->where('post_id', $post_id);
		// $this->db->update('tblposts', $field);
		// echo $this->db->last_query();

		if ($qstr->num_rows() > 0) {
			$result = $qstr->result_array();

		} else {
			$result = null;
		}
		return $result;
	}

	public function get_likes($post_id)
	{
		$current_user = $this->session->userdata('id');
		$qstr = $this->db->query("SELECT * FROM tbllikes join tblposts on tbllikes.like_post_id=tblposts.postid ");
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


	public function updateMyProfile($field, $id)
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


	public function post_thread($title, $desciption, $date_created)
	{
		$id = $this->session->userdata('id');
		$data = array(
			'thread_user_id' => $id,
			'thread_title' => $title,
			'thread_content' => $desciption,
			'thread_date' => $date_created
		);
		print_r($data);
		return $this->db->insert('tblcommunity', $data);
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


}
