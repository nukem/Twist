<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

/**
 * Soundbooka
 * 
 * @author     Chathura Payagala <chathupayagala@gmail.com>
 */
class User extends MY_Controller {

  function User() {
    parent::__construct();
    $this->load->model('mUser');
    $this->load->model('mArtist');
	$this->load->model('mArticle');
  }

  public function login() {
	$this->session->set_userdata('is_loged', false);
	$this->session->set_userdata('artist', null);  
	$this->session->set_userdata('artists', array());
	$this->session->set_userdata('profile_name', array());	
	
	if(!$this->input->post('username') || ! $this->input->post('password')) {
		$this->session->set_flashdata('error', 'Please enter Email and Password.');
	  	redirect('/');
		die;
	}
	
	$this->db->where('email', $this->input->post('username'));
	$this->db->where('password', $this->input->post('password'));
	//echo $this->input->post('username').$this->input->post('password');
	$q = $this->db->get('user');
	
	if ($q->num_rows()) {
		$user = $q->row();
		$this->db->where('user_id', $user->id);
		$a = $this->db->get('artist');
		
		//$this->db->select('id','profile_name');
		$this->db->where('email', $this->input->post('username'));
		$new_array = $this->db->get('user');
		foreach ($new_array->result_array() as $key => $r) {
		  $sites[$key] = $r['id'];
		}
		$this->db->where_in('user_id', $sites);
		$b = $this->db->get('artist');
		$arr = array();
		$arr1 = array();
		foreach ($b->result_array() as $r) {
		  ///print_r($r);
		  ///exit();
		  $arr[] = $r['id'];
		  $arr1[] = $r['profile_name'];
		  
		}
		if ($a->num_rows()) {
			$artist = $a->row();
			//if ($artist->status == 'approved') {
				$this->session->set_userdata('is_loged', true);
				$this->session->set_userdata('artist_id',$artist->id);
				$this->session->set_userdata('user_id',$user->id);
				$this->session->set_userdata('artists',$arr);
				$this->session->set_userdata('profile_name',$arr1);
				$this->session->set_userdata('email',$this->input->post('username'));
				//$this->session->set_userdata('artists_name',$artist->profile_name);
				
				/* TESTING CODE REMOVE WHEN IN LIVE */
				if($this->input->post('username')=='max.emb@gmail.com')  $this->session->set_userdata('profile_type','booka');
				
				$this->session->set_flashdata('message', 'Welcome back, ' . $artist->first_name .' '. $artist->last_name);
				redirect('artist/step1/' . $artist->id); 
				//redirect('artist/manage_profile/' . $artist->id); 
				die;
				
			/*} else {
				$this->session->set_flashdata('error', 'Account is inactive - please try again later.');
				redirect('/');
				die;
			}*/
		}
	}
	$this->session->set_flashdata('error', 'Invalid Email or Password - please try again.');
	redirect('/');
	die;
  }
	
  
  
  public function directLogin($id) {
	$this->session->set_userdata('is_loged', false);
	$this->session->set_userdata('artist', null);  
	$this->session->set_userdata('artists', array());
	$this->session->set_userdata('profile_name', array());	
	
	$sql = "select a.email,a.password from user a, artist b where a.id=b.user_id and b.id = '{$id}'";
	$query = $this->db->query($sql);
	$cred = $query->result_array();

	$username = $cred[0]['email'];
	$password = $cred[0]['password'];
	
	
	if(!$username || ! $password) {
		$this->session->set_flashdata('error', 'Wrong Link.');
	  	redirect('/');
		die;
	}
	
	$this->db->where('email', $username);
	$this->db->where('password', $password);
	$q = $this->db->get('user');
	
	if ($q->num_rows()) {
		$user = $q->row();
		$this->db->where('user_id', $user->id);
		$a = $this->db->get('artist');
		
		$this->db->where('email', $username);
		$new_array = $this->db->get('user');
		foreach ($new_array->result_array() as $key => $r) {
		  $sites[$key] = $r['id'];
		}
		$this->db->where_in('user_id', $sites);
		$b = $this->db->get('artist');
		$arr = array();
		$arr1 = array();
		foreach ($b->result_array() as $r) {
		  $arr[] = $r['id'];
		  $arr1[] = $r['profile_name'];
		}
		if ($a->num_rows()) {
			$artist = $a->row();
			$this->session->set_userdata('is_loged', true);
			$this->session->set_userdata('artist_id',$artist->id);
			$this->session->set_userdata('user_id',$user->id);
			$this->session->set_userdata('artists',$arr);
			$this->session->set_userdata('profile_name',$arr1);
			$this->session->set_userdata('email',$username);
			
			$this->session->set_flashdata('message', 'You can now complete your profile.');
			//$this->session->set_flashdata('message', 'Welcome back, ' . $artist->first_name .' '. $artist->last_name);
			if(isset($_GET['url']) and $_GET['url'] !='') redirect($_GET['url']); 
			else redirect('artist/step1/' . $id); //$artist->id
			die;
		}
	}
	$this->session->set_flashdata('error', 'Wrong Link - please try again.');
	redirect('/');
	die;
  }
  
  
  
  public function logout() {
	$this->session->set_userdata('is_loged', false);
	$this->session->set_userdata('artist', null);
	redirect('/');
	die;
  }
  
  public function forgot() {
	/*print_r($_POST);
	exit;*/
	if(!$_POST['sec_ans'] || ! $_POST['username']) {
		$this->session->set_flashdata('error', 'Please enter Email and Security Answer.');
	  	redirect('/');
		die;
	}
	
	$this->db->where('email', $_POST['username']);
	$this->db->where('secret_question', $_POST['secret_question']);
	$this->db->where('secret_answer', $_POST['sec_ans']);
	$q = $this->db->get('user');
	
	if($q->num_rows()){
		$this->session->set_flashdata('message', 'Your Username & Password sent to Email.');
		$user_details = $q->row();
		$this->_sendEmail($user_details);
		redirect(base_url());
		die;
		
	}else{
		$this->session->set_flashdata('error', 'Please enter correct Email,Security Question & Security Answer');
		redirect('/');
		die;
	}
	
  }
  
  function _sendEmail($id) {
		
		$id=(array)$id;
			
		  $this->load->library('email');
		
		  $this->email->initialize();
		  $this->email->from('arun@visiontechdigital.com');
		  $this->email->to($id['email']);
		  $this->email->subject('Forgot Password');
		  $user_name = $id['email'];
		  $password = $id['password'];
		
		$html = '<html>
	<head>
	</head>
	<body>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td align="center" valign="top"><table width="639" border="0" cellspacing="0" cellpadding="0">
		  <tr>
			<td><img src="http://www.soundbooka.com/version1/images/email_head.jpg" width="639" height="143" /></td>
		  </tr>
		  <tr>
			<td style="padding-top:30px; padding-left:20px;padding-bottom:20px;color: #332B28; font-family:Lato,Arial,Helvetica,sans-serif; font-size: 14px;">Please find User details below.</td>
		  </tr>
		  <tr>
			<td style="padding-top:30px; padding-left:20px;padding-bottom:20px;color: #332B28; font-family:Lato,Arial,Helvetica,sans-serif; font-size: 14px;">Email : '.$user_name.'</td>
		  </tr>
		  <tr>
		  
			<td style="padding-top:30px; padding-left:20px;padding-bottom:20px;color: #332B28; font-family:Lato,Arial,Helvetica,sans-serif; font-size: 14px;">Password : '.$password.'</td>
		  </tr>
		  <tr>
			<td><img src="http://www.soundbooka.com/version1/images/email_footer.jpg" width="639" height="83" border="0" usemap="#Map" /></td>
		  </tr>
		</table></td>
	  </tr>
	</table>

	<map name="Map" id="Map">
	  <area shape="rect" coords="9,4,28,24" href="http://www.facebook.com/soundbooka" target="_blank" />
	  <area shape="rect" coords="30,4,51,25" href="http://www.twitter.com/soundbooka" target="_blank" />
	  <area shape="rect" coords="4,30,636,78" href="http://www.soundbooka.com/version1/" />
	</map>
	</body>
	</html>';
		
		$body = $html ;
		
		$this->email->message($body);
		//$this->email->send();

		send_email($user_name, "Forgot Password", $body);

		return;
	  }

}