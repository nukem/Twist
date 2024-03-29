<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

/**
 * Soundbooka
 * 
 * @author     Chathura Payagala <chathupayagala@gmail.com>
 */
class Artist extends MY_Controller {

  function Artist() {
    parent::__construct();
    $this->load->model('mUser');
    $this->load->model('mArtist');
	$this->load->model('mArticle');
  }

  public function index() {
    $data = array(
        'title' => '',
        'main_content' => 'home'
    );
    $this->load->view('template', $data);
  }

  public function registered($id) {
    //send_email('chathupayagala@gmail.com', 'subject', 'message');
    $data = array(
        'title' => 'Registration Complete',
        'main_content' => 'artist/registered',
		'id' => $id
    );
    $this->load->view('template', $data);
  }
  
  public function re_send($id) {
	$this->_sendEmail($id);
	die('OK');  
  }
  
  public function change_email($id) {
	$this->db->where('id', $id);
    $q = $this->db->get('artist');
	$result = $q->row();
	$user_id = $result->user_id;
	$sql = "update user set email = '{$_GET['email']}' where id = '{$user_id}'";
	$this->db->query($sql);
	$this->_sendEmail($id);
	die('OK');   
  }
	
  public function updateArtistStatus() {
	$status = $_POST['aAtatus'];
	$id = $_POST['AId'];
    $sql="update artist set status='$status' where id='$id'";
	$this->db->query($sql);
	if($status == 'approved')
	{
		$this->sendEmailApproved($id);

	}else if($status == 'reject')
	{
		$this->sendEmailRejected($id);
	}
	
	//die('OK');  
  }  
  // Date: 30 Nov ' 11 EM code starts here
  public function savevent()
  {
  	$this->form_validation->set_rules('event_title', 'Event Title', 'required');
    $this->form_validation->set_rules('event_loc', 'Event Location', 'required');
    $this->form_validation->set_rules('event_desc', 'Event Description', 'required');
    $this->form_validation->set_rules('event_start_date', 'Start Date', 'required');
    $this->form_validation->set_rules('event_to_date', 'End Date', 'required');
   // $this->form_validation->set_rules('event_occ', 'Event Occurence', 'required|is_numeric');
    
    $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
    if ($this->form_validation->run() == FALSE) {
      $data = array(
          'title' => 'Edit Events',
          'main_content' => 'artist/saveevent'
      );
     $data['form_errors'] = $this->form_validation->error_array();
     $this->load->view('template', $data);
      
    } else {
    			$id = $_REQUEST['id'];
    	  	$form_data = array(
          'id' => $id,
          'event_title' => set_value('event_title'),
          'event_loc' => set_value('event_loc'),
          'event_desc' => set_value('event_desc'),
          'start_date' => set_value('event_start_date'),
          'to_date' => set_value('event_to_date'),
          'start_time' => set_value('event_start_time'),
          'end_time' => set_value('event_end_time'),
          'event_occ' => set_value('event_occ'),
          'repeater' => set_value('repeater'),
          'radio_daily' => set_value('radio_daily'),
          'daily' => set_value('daily'),
          'select_weekly' => set_value('select_weekly'),
          'weekly' => set_value('weekly'),
          'select_monthly' => set_value('select_monthly'),
          'select_yearly' => set_value('select_yearly'),
          'selectmonth' => set_value('selectmonth'),
		  'repeat_start_date' => set_value('repeat_start_date')
          );
		
      $aid = $this->mArtist->savevent($form_data);
       $this->session->set_flashdata('message', 'You have successfully saved event.');
      	?>
      	<script type="text/javascript" language="javascript">	
      		if (window.opener && !window.opener.closed) {
					window.opener.location.reload();
			} 
      		window.close();
      	</script>
      	<?php //redirect('/artist/registered/'.$aid);
    }  
	  
  }
  // EM Code ends here

  public function register() {
   
//
    //$this->form_validation->set_rules('type', 'Account Type', 'required|trim');
   	$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|callback_check_profile');
    $this->form_validation->set_rules('email_confirm', 'Email Confirm', 'required|trim|valid_email');
    $this->form_validation->set_rules('password', 'Password', 'required|trim');
    $this->form_validation->set_rules('password_confirm', 'Password Confirm', 'required|trim');
    $this->form_validation->set_rules('secret_question', 'Secret Question', 'required');
    $this->form_validation->set_rules('secret_answer', 'Secret Answer', 'required');
    $this->form_validation->set_rules('dob_day', 'Birth Day', 'required');
    $this->form_validation->set_rules('dob_month', 'Birth Month', 'required');
    $this->form_validation->set_rules('dob_year', 'Birth Year', 'required');
    $this->form_validation->set_rules('age', 'Age verification', 'required|is_numeric');
    $this->form_validation->set_rules('agree', 'Agree Terms', 'required|is_numeric');

    $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

    if ($this->form_validation->run() == FALSE) {
      $data = array(
          'title' => 'Register',
          'main_content' => 'artist/register'
      );
      $data['form_errors'] = $this->form_validation->error_array();
      $data['types'] = $this->mUtil->getCodes('Account Types');
	  $questions = $this->mUtil->getCodes('Secret Questions');
      foreach ($questions as $s) {
		$data['questions'][$s] = $s;  
	  }
	  
      $this->load->view('template', $data);
    } else {
      $form_data = array(
          'id' => 0,
          'email' => set_value('email'),
          'password' => set_value('password'),
          'type' => set_value('type'),
          'secret_question' => set_value('secret_question'),
          'secret_answer' => set_value('secret_answer'),
          'newsletter' => set_value('newsletter'),
          'dob' => set_value('dob_year') . "-" . set_value('dob_month') . "-" . set_value('dob_day')
		 );
      if ($newID = $this->mUser->save($form_data)) {
       $aid = $this->mArtist->save(array('id' => 0, 'user_id' => $newID, 'status' => 'pre-registered'),$_POST);
       $this->session->set_flashdata('message', 'You can now complete your profile.');
     	$this->_sendEmail($aid);
	    //redirect('/artist/registered/'.$aid);
		$captcha=$this->random_text();
	  
		redirect('/user/directLogin/'.$aid.'?clr='.$captcha);
	  } else {
        $this->session->set_flashdata('error', 'An error occurred saving your information. Please try again later');

        $data = array(
            'title' => 'Register',
            'main_content' => 'artist/register'
        );
        $this->load->view('template', $data);
      }
    }
  }

  function _sendEmail($id) {
    $this->load->library('email');
    $artist = $this->mArtist->get($id);
    $user = $this->mUser->get($artist->user_id);
	$article = $this->mArticle->getEmailTemplate(194220);
	
	  $captcha=$this->random_text();
	  
		//$profile_link = "<a href='" . base_url() . "artist/step1/{$id}'>Create my profile</a>";
		$profile_link = "<a href='" . base_url() . "user/directLogin/{$id}?clr={$captcha}' style=\"font-size:16px;font-weight:bold;text-decoration:underline;\">Create my profile</a>";
	
	$html = str_replace('%Create my profile%',$profile_link,$article->content);
	
    $body = $html ;
	
	$email_from_address='noreply@soundbooka.com';
	$email_from_name='Soundbooka';
    $config['protocol'] = 'sendmail';
	$config['mailpath'] = '/usr/sbin/sendmail';
	$config['charset'] = 'iso-8859-1';
	$config['mailtype'] = 'html';
	$config['wordwrap'] = TRUE;

	$this->email->initialize($config);
	$this->email->from($email_from_address, $email_from_name);
	$this->email->to($user->email);
	$this->email->cc(trim($article->cc));
	$this->email->bcc(trim($article->bcc).",".trim($article->bcc_add));
	$this->email->subject($article->subject);
	$this->email->message($html);
	$this->email->send();

    return;
  }
    function sendEmailApproved($id) 
	{
		$artist = $this->mArtist->get($id);
		$user = $this->mUser->get($artist->user_id);
		$article = $this->mArticle->getEmailTemplate(194220);
		$profile_name=str_replace(' ','_',$artist->profile_name);
		$profile_link = "<a href='" . base_url() . "profile/view/{$profile_name}'>here</a>";
		
	$html = "<html>
<head>
</head>
<body>
<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
  <tr>
    <td align=\"center\" valign=\"top\"><table width=\"639\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
      <tr>
        <td><img src=\"http://www.soundbooka.com/version1/images/email_head.jpg\" width=\"639\" 
		height=\"143\" /></td>
      </tr>
      <tr>
        <td style=\"padding-top:30px; padding-left:20px;padding-bottom:20px;padding-right:10px;color: #332B28; font-family:Lato,Arial,Helvetica,sans-serif; font-size: 14px;\">Hi!<br/><br/>Soundbooka are pleased to inform you that your Profile Page has been reviewed and activated. You will now be able to be booked for gigs through <a href=\"www.soundbooka.com\">www.soundbooka.com</a><br/><br/>View your activated Soundbooka Profile Page ".$profile_link."<br/><br/>For more information please contact us at <a href=\"mailto:info@soundbooka.com\">info@soundbooka.com</a><br/><br/>Thanks,<br/><br/>The Soundbooka Team <br/><br/><a href=\"www.soundbooka.com\">www.soundbooka.com</a>
</td>
      </tr>
      <tr>
        <td><img src=\"http://www.soundbooka.com/version1/images/email_footer.jpg\" width=\"639\" height=\"83\" border=\"0\" usemap=\"#Map\" /></td>
      </tr>
    </table></td>
  </tr>
</table>

<map name=\"Map\" id=\"Map\">
  <area shape=\"rect\" coords=\"9,4,28,24\" href=\"http://www.facebook.com/soundbooka\" target=\"_blank\" />
  <area shape=\"rect\" coords=\"30,4,51,25\" href=\"http://www.twitter.com/soundbooka\" target=\"_blank\" />
  <area shape=\"rect\" coords=\"4,30,636,78\" href=\"http://www.soundbooka.com/version1/\" />
</map>
</body>
</html>";

    send_email($user->email, "Welcome to Soundbooka!", $html);
	//die('OK');  
    return;
  }
  
  function sendEmailRejected($id) 
	{
		$artist = $this->mArtist->get($id);
		$user = $this->mUser->get($artist->user_id);
		$article = $this->mArticle->getEmailTemplate(194220);
		$this->load->library('email');
		$this->email->from($article->email_from);
		$this->email->cc($article->cc);
		$this->email->bcc($article->bcc);
		$this->email->subject("Registration Pending");
    
		
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
        <td style="padding-top:30px; padding-left:20px;padding-bottom:20px;padding-right:10px;color: #332B28; font-family:Lato,Arial,Helvetica,sans-serif; font-size: 14px;">Hi!<br/><br/>
		Unfortunately your Soundbooka Profile Page will not be activated as it does not meet our minimum quality standards.<br/><br>You will be able to register as an Artist on Soundbooka again in three months. For more information please visit the Soundbooka FAQ page here.<a href="http://www.soundbooka.com/version1/faq">here</a>.<br/><br/>Thanks,<br/><br/>The Soundbooka Team <br/><br/><a href="www.soundbooka.com">www.soundbooka.com</a>    </td>
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

    send_email($user->email, "Your Soundbooka Profile", $body);
//die('OK');  
    return;
  }

  public function step1($id=0) {
	$this->chk_login();
	if (!$id) {
      $this->session->set_flashdata('error', 'You have to resigter first.');
      redirect('/artist/register');
    }
	
	$this->form_validation->set_rules('first_name', 'First Name', 'required|trim');
    $this->form_validation->set_rules('last_name', 'Last Name', 'required|trim');
    $this->form_validation->set_rules('gender', 'Gender', 'required|trim');
    $this->form_validation->set_rules('address', 'Address', 'required|trim');
    $this->form_validation->set_rules('suburb', 'Suburb', 'required|trim');
    $this->form_validation->set_rules('state', 'State', 'required|trim');
    $this->form_validation->set_rules('country', 'Country', 'required|trim');
    $this->form_validation->set_rules('postcode', 'Postcode', 'required');
    $this->form_validation->set_rules('phone_code', 'Phone Code', '');
    $this->form_validation->set_rules('phone_number', 'Phone Number', 'required');
    $this->form_validation->set_rules('phone_alternate', 'Alternate Phone', '');

    $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
	
	
    if ($this->form_validation->run() == FALSE) {
      $data = array(
          'title' => 'Create Profile Step 1',
          'main_content' => 'artist/step1'
      );
      $data['form_errors'] = $this->form_validation->error_array();
      $data = array_merge($data, (array) $this->mArtist->get($id));
	  if (empty($data['id'])) {
		  $this->session->set_flashdata('error', 'Profile does not exist - please try again.');
		  redirect('/artist/register');
	  }

      $data['countries'] = $this->mUtil->getCountryList();
      $data['states'] = $this->mUtil->getStateList(set_value('country', $data['country']));
      $data['genders'] = $this->mUtil->getCodes('gender');
      //print_r($data);die;
      $this->load->view('template', $data);
    } else {
		$wz_artist = (array)$this->mArtist->get($id);
		$wz_status = $wz_artist['status'];
      $form_data = array(
          'id' => $id,
          'first_name' => set_value('first_name'),
          'last_name' => set_value('last_name'),
          'gender' => set_value('gender'),
          'address' => $this->input->post('address'),
          'suburb' => set_value('suburb'),
          'state' => set_value('state'),
          'country' => set_value('country'),
          'postcode' => set_value('postcode'),
          'phone_code' => set_value('phone_code'),
          'phone_number' => set_value('phone_number'),
          'phone_alternate' => set_value('phone_alternate'),
		  'status' => ($wz_status=='step6'||$wz_status=='incomplete'||$wz_status=='updated')?'updated':($wz_status=='registered'?'registered':'step1')
      );

      if ($newID = $this->mArtist->save($form_data)) {
        //$this->session->set_flashdata('message', 'You can now complete your profile.');
        redirect('/artist/step2/' . $newID);
      } else {
        $this->session->set_flashdata('error', 'An error occurred saving your information. Please try again later');

        $data = array(
            'title' => 'Create Profile Step 1',
            'main_content' => 'artist/step1'
        );
	        $this->load->view('template', $data);
      }
    }
  }

  public function step2($id=0) {
	$this->chk_login();
    //print_r($_POST);die;
    if (!$id) {
      $this->session->set_flashdata('error', 'You have to resigter first.');
      redirect('/artist/register');
    }
	
	$this->form_validation->set_rules('profile_name', 'Profile Name', 'required|trim|callback_check_unique_profile');
	
    $this->form_validation->set_rules('profile_type', 'Profile Type', 'required|trim');
	//$this->form_validation->set_rules('specialization', 'specialization', '');
	//$this->form_validation->set_rules('preferred_medium', 'preferred_medium', '');
	$this->form_validation->set_rules('dj_combo', 'dj_combo', '');
	$this->form_validation->set_rules('no_of_members', 'No of Members ', 'integer');
	
    $this->form_validation->set_rules('genre', 'genre', '');
    $this->form_validation->set_rules('equipment', 'equipment', '');

    $this->form_validation->set_rules('fee_hour', 'fee_hour', '');
    $this->form_validation->set_rules('fee_gig', 'fee_gig', '');
    $this->form_validation->set_rules('gig_hours', 'Performance time ', 'numeric');

    $this->form_validation->set_rules('travel_city', 'travel_city', '');
    $this->form_validation->set_rules('travel_state', 'travel_state', '');
    $this->form_validation->set_rules('travel_interstate', 'travel_interstate', '');
    $this->form_validation->set_rules('travel_international', 'travel_international', '');

    $this->form_validation->set_rules('has_manager', 'Manager', 'trim');
    $this->form_validation->set_rules('availability', 'Availability', 'required');
    if ($this->input->post('has_manager') == 1) {
      $this->form_validation->set_rules('manager_name', 'Manager Name', 'required|trim');
      $this->form_validation->set_rules('manager_email', 'Manager Email', 'required|trim');
      $this->form_validation->set_rules('manager_phone', 'Manager Phone', 'required|trim');
    }
    $this->form_validation->set_rules('has_insurance', 'Insurance', 'required|trim');

    $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

	if(isset($_POST['travel_city']) || isset($_POST['travel_state']) || isset($_POST['travel_interstate']) || isset($_POST['travel_international'])){
		$temp = 1;
	}else{
		$temp = 0;
	}
	
    if (isset($_POST) && is_array($_POST) && count($_POST)) {
      $myErrors = array();
	  if(preg_match('#[/_]#',$_POST['profile_name']))
	  {
		$myErrors[] = 'Please enter valid Profile Name';
	  }
      if (!isset($_POST['genre']) && ($this->input->post('profile_type') !=  10)) {
        $myErrors[] = 'Select at least one genre';
      }
	if (!isset($_POST['gigs_arr'])) {
		$chk_gig = array('9','10');
		/*if (in_array($_POST['profile_type'], $chk_gig)){
		$myErrors[] = 'Select at least one preferred-gig';
		}*/
		if($_POST['profile_type'] ==  '1'){
		$myErrors[] = 'Select at least one preferred-gig';
		}
		elseif($_POST['profile_type'] ==  '3'){
		$myErrors[] = 'Select at least one preferred-gig';
		}
		elseif($_POST['profile_type'] ==  '7'){
		$myErrors[] = 'Select at least one preferred-gig';
		}

	}
	  if ((!isset($_POST['gig_hours']) || !isset($_POST['fee_hour']) || empty($_POST['gig_hours']) || empty($_POST['fee_hour'])) && empty($_POST['fee_gig']) ) {
        $myErrors[] = 'Enter performance fee';
      }
	  if (!isset($_POST['specialization_arr']) && ($this->input->post('profile_type') ==  10)) {
        $myErrors[] = 'Select specialisation';
      }
		
	  if($temp == 0){
		$myErrors[] = 'Travel field is required';
	  }
	  
      //if (!isset($_POST['available_mon']) && !isset($_POST['available_tue']) && !isset($_POST['available_wed']) && !isset($_POST['available_thu']) && !isset($_POST['available_fri']) && !isset($_POST['available_sat']) && !isset($_POST['available_sun'])) {
        //$myErrors[] = 'Select your availability';
      //}

      foreach ($myErrors as $k => $me) {
        $this->form_validation->set_error('custom_' . $k, $me);
      }
	  
	  $_POST['specialization'] = @implode(",",$_POST['specialization_arr']);
	  $_POST['preferred_medium'] = @implode(",",$_POST['preferred_medium_arr']);
	  $_POST['needed_equipment'] = @implode(",",$_POST['needed_equipment_arr']);
    }

    if ($this->form_validation->run() == FALSE || count($myErrors)) {
      $data = array(
          'title' => 'Create Profile Step 2',
          'main_content' => 'artist/step2'
      );
     $artists= (array) $this->mArtist->get($id);
      $data['form_errors'] = $this->form_validation->error_array();
       if(!empty($_POST) && count($_POST)){
		foreach($_POST as $k=>$v){
			$data[$k]=$v;
		}
	  }
	  else $data = array_merge($data, $artists);
	  //print_r($data);die;
	  if (empty($artists['id'])) {
		  $this->session->set_flashdata('error', 'Profile does not exist - please try again.');
		  redirect('/artist/register');
	  }
	 $data['id']=$artists['id']; 
	  
	  $data['types'] = $this->mUtil->getProfileTypeList();

	  $data['categories'] = $this->mUtil->getInstrumentCategoryList();
      $data['instruments'] = $this->mUtil->getInstrumentList();

	  $data['specializations'] = $this->mUtil->getCodes('Specialization'); 
      $data['gigs'] = $this->mUtil->getCodes('gigs');
      $data['gigHours'] = $this->mUtil->getCodes('gig minimum hours');
	  $data['mediums'] = $this->mUtil->getCodes('Preferred Medium');
	  $data['equipments'] = $this->mUtil->getCodes('Preferred Equipments');
	  
	  //print_r($data);die;

      if (isset($_POST) && is_array($_POST) && count($_POST)) {
        $data['genre'] = (array) @$_POST['genre'];
      } else {
        $data['genre'] = array($data['genre1'], $data['genre2'], $data['genre3'], $data['genre4'], $data['genre5']);
      }
	  
	  if (isset($_POST) && is_array($_POST) && count($_POST)) {
        $data['specialization'] = (array) @$_POST['specialization_arr'];
		$data['preferred_medium'] = (array) @$_POST['preferred_medium_arr'];
		$data['needed_equipment'] = (array) @$_POST['needed_equipment_arr'];
      } else {
        $data['specialization'] = explode(",",$data['specialization']);
		$data['preferred_medium'] = explode(",",$data['preferred_medium']);
		$data['needed_equipment'] = explode(",",$data['needed_equipment']);
      }
	      $this->load->view('template', $data);
    } else {
		
		//Other data insertion starts
		/*$id_genere = count($_POST['genre']);
		$_POST['genre'][$id_genere] = $_POST['other_gen'];*/
		#if(@$_POST['genre'][0]=='99999' || @$_POST['genre'][1]=='99999' || @$_POST['genre'][2]=='99999' || @$_POST['genre'][3]=='99999' || @$_POST['genre'][4]=='99999')
		if(in_array('99999',$_POST['genre']))
		{
			$this->db->where('genre', $_POST['other_gen']);
			$this->db->where('user_id', $id);
			$q = $this->db->get('genre');
			if($q->num_rows() == 0){
			
			$this->db->query(" Insert Into genre  set genre = '".$_POST['other_gen']."',description='', active = '1', artist_type = '".$_POST['profile_type']."',user_id = '".$id."'");
			
			$other_gens_id = $this->db->insert_id();
			$generekey = array_search('99999',$_POST['genre']);
			$_POST['genre'][$generekey] = $other_gens_id;
			
			}
				
		}
		
		if(in_array('99999',$_POST['specialization_arr']))
		{
			$this->db->where('bascode1', $_POST['other_specialization']);
			$this->db->where('basgroup1', 'Specialization');
			$spe = $this->db->get('xbasetypes');
			if($spe->num_rows() == 0){
			$this->db->query(" Insert Into xbasetypes  set basgroup1 = 'Specialization', active = '1', bascode1 = '".$_POST['other_specialization']."',user_id = '".$id."'");
			$other_spl_id = $this->db->insert_id();
			$spkey = array_search('99999',$_POST['specialization_arr']);
			$_POST['specialization_arr'][$spkey] = $other_spl_id;
			}
		}
		if(in_array('99999',$_POST['gigs_arr']))
		{
			$this->db->where('bascode1', $_POST['other_gig']);
			$this->db->where('basgroup1', 'Gigs');
			$gig = $this->db->get('xbasetypes');
			if($gig->num_rows() == 0){
				$this->db->query(" Insert Into xbasetypes  set basgroup1 = 'Gigs', active = '1', bascode1 = '".$_POST['other_gig']."',user_id = '".$id."'");
				$other_gig_id = $this->db->insert_id();
				$gigkey = array_search('99999',$_POST['gigs_arr']);
				$_POST['gigs_arr'][$gigkey] = $other_gig_id;	
			}
		}
		
		//Other data insertion ends
	 
		$wz_artist = (array)$this->mArtist->get($id);
		$wz_status = $wz_artist['status'];
      $form_data = array(
          'id' => $id,
          'profile_name' => set_value('profile_name'),
          'profile_type' => set_value('profile_type'),
          'genre1' => @implode(',',$_POST['genre']),
          'equipment' => $this->input->post('equipment'),
          'fee_hour' => set_value('fee_hour'),
          'fee_gig' => set_value('fee_gig'),
          'gig_hours' => set_value('gig_hours'),
          'travel_city' => set_value('travel_city'),
          'travel_state' => set_value('travel_state'),
          'travel_interstate' => set_value('travel_interstate'),
          'travel_international' => set_value('travel_international'),
          'has_manager' => set_value('has_manager'),
          'manager_name' => set_value('manager_name'),
          'manager_email' => set_value('manager_email'),
          'manager_phone' => set_value('manager_phone'),
          'has_insurance' => set_value('has_insurance'),
		  'specialization' => @implode(",",$_POST['specialization_arr']),
		  'dj_combo' => set_value('dj_combo'),
		  'preferred_medium' => @implode(",",$_POST['preferred_medium_arr']),
		  'no_of_members' => set_value('no_of_members'),
		  'needed_equipment' => @implode(",",$_POST['needed_equipment_arr']),
		  'no_cdgs' => $this->input->post('other_CDGS'),
		  'no_vinyl' => $this->input->post('other_vinyl'),
		  'status' => ($wz_status!='step1')?$wz_status:'step2'
      );

      if ($newID = $this->mArtist->save($form_data)) {
        //$this->session->set_flashdata('message', 'You can now complete your profile.');
		//$this->_doUpload($newID);
		
		$this->mArtist->saveGigs($newID, @$_POST['gigs_arr']);
		$this->mArtist->saveAvailability($newID, @$_POST['availability']);
		
		if ($this->input->post('save')) {
        	redirect('/artist/step3/' . $newID);
		} else {
			redirect('/artist/step1/' . $newID);
		}
      } else {
        $this->session->set_flashdata('error', 'An error occurred saving your information. Please try again later');

        $data = array(
            'title' => 'Create Profile Step 2',
            'main_content' => 'artist/step2'
        );
	        $this->load->view('template', $data);
      }
    }
  }
  public function check_unique_profile($str)
  {
	$pquery = "select * from artist where profile_name ='".$str."' and id!='".$this->uri->segment(3)."'";
	$q = $this->db->query($pquery);	
	if(!preg_match("/^[a-z0-9]+([\\s]{1}[a-z0-9]|[a-z0-9])+$/i", $str))
	{
		$this->form_validation->set_message('check_unique_profile', ' Profile Name can only be letters number or spaces.');
		return FALSE;
	}
	else if($q->row())
	{
		$this->form_validation->set_message('check_unique_profile', 'The Profile name is already being used.');
		return FALSE;
	}
	else
	{	
		return TRUE;
	}

	}

  public function step3($id=0) {
	$this->chk_login();
	if (!$id) {
      $this->session->set_flashdata('error', 'You have to resigter first.');
      redirect('/artist/register');
    }
	
	$this->form_validation->set_rules('plot', 'plot', '');
	
	if ($this->input->post('isPost') == 1) {
		/*$this->db->query(" delete from plots  where artist_id = '$id'");
		foreach($_POST['plot'] as $plot){
			if($plot !='') $this->db->query(" Insert Into plots  set artist_id = '$id', plot = '$plot'");
		 }*/
	$wz_artist = (array)$this->mArtist->get($id);
	$wz_status = $wz_artist['status'];
	$form_data = array(
	  'id' => $id,
	  'status' => ($wz_status!='step2')?$wz_status:'step3'
	);
    $newID = $this->mArtist->save($form_data);
	if ($this->input->post('save')) {
        	redirect('/artist/step4/' . $id);
		} else {
			redirect('/artist/step2/' . $id);
		}
	}
	
	
	  $data = array(
          'title' => 'Create Profile Step 3',
          'main_content' => 'artist/step3'
      );

	  $data = array_merge($data, (array) $this->mArtist->get($id));
	  if (empty($data['id'])) {
		  $this->session->set_flashdata('error', 'Profile does not exist - please try again.');
		  redirect('/artist/register');
	  }
	  //print_r($data);die;
	  
      $this->load->view('template', $data);
  }

  public function step4($id=0) {
	$this->chk_login();
	$this->load->helper('text');
	if (!$id) {
      $this->session->set_flashdata('error', 'You have to resigter first.');
      redirect('/artist/register');
    }
	$this->form_validation->set_rules('info1', 'info1', 'callback_word_count');
    $this->form_validation->set_rules('info2', 'info2', '');
    $this->form_validation->set_rules('info3', 'info3', '');
    $this->form_validation->set_rules('info4', 'info4', '');
	$this->form_validation->set_rules('facebook', 'facebook', '');
	$this->form_validation->set_rules('twitter', 'twitter', '');

    $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
	
    if ($this->form_validation->run() == FALSE) {
      $data = array(
          'title' => 'Create Profile Step 4',
          'main_content' => 'artist/step4'
      );
      $data['form_errors'] = $this->form_validation->error_array();
	  
	  $data = array_merge($data, (array) $this->mArtist->get($id));
	  //echo '<div style="display:none;">'; print_r($data); echo '</div>';exit;
	  if (empty($data['id'])) {
		  $this->session->set_flashdata('error', 'Profile does not exist - please try again.');
		  redirect('/artist/register');
	  }
	  
	   #echo '<div style="display:none;">'; print_r($data); echo '</div>';
      $this->load->view('template', $data);
    } else {
		$wz_artist = (array)$this->mArtist->get($id);
		$wz_status = $wz_artist['status'];
      $form_data = array(
	  	  'id' => $id,
          'info1' => set_value('info1'),
          'info2' => set_value('info2'),
          'info3' => set_value('info3'),
          'info4' => set_value('info4'),
		  'facebook' => set_value('facebook'),
		  'twitter' => set_value('twitter'),
			'status' => ($wz_status!='step3')?$wz_status:'step4'
		);
      if ($newID = $this->mArtist->save($form_data)) {
	    if ($this->input->post('save')) {
        	redirect('/artist/step5/' . $newID);
		} else {
			redirect('/artist/step3/' . $newID);
		}
      
	  } else {
        $this->session->set_flashdata('error', 'An error occurred saving your information. Please try again later');

        $data = array(
          'title' => 'Create Profile Step 4',
          'main_content' => 'artist/step4'
        );
	        $this->load->view('template', $data);
      }
    }
  }
  public function word_count($str)
  {
		$cnt  = str_word_count($str);
	if ( $cnt<30)
		{
			$this->form_validation->set_message('word_count', 'Add more information so that people know more about you. (Min. 30 words)');

				return FALSE;
			
			
		}
		else
		{
			return TRUE;
		}
  }
  public function step5($id=0) {
	$this->chk_login();
   if (!$id) {
      $this->session->set_flashdata('error', 'You have to resigter first.');
      redirect('/artist/register');
    }
   $this->form_validation->set_rules('payment_method', 'Payment Method', 'required');
   
   if ($this->input->post('payment_method') == 1) {
    $this->form_validation->set_rules('paypal_email', 'Paypal Email', 'required|valid_email');
   } else {
	   $this->form_validation->set_rules('paypal_email', 'Paypal Email', '');
   }
    //$this->form_validation->set_rules('abn', 'ABN', 'required');
    //$this->form_validation->set_rules('business_name', 'Business Name', 'required');
	$this->form_validation->set_rules('business_address', 'Business Address', '');
	$this->form_validation->set_rules('has_gst', 'GST', 'required');
	


    $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

    if ($this->form_validation->run() == FALSE) {
      $data = array(
          'title' => 'Create Profile Step 5',
          'main_content' => 'artist/step5'
      );
      $data['form_errors'] = $this->form_validation->error_array();
	  $data = array_merge($data, (array) $this->mArtist->get($id));
	  if (empty($data['id'])) {
		  $this->session->set_flashdata('error', 'Profile does not exist - please try again.');
		  redirect('/artist/register');
	  }
      $this->load->view('template', $data);
    } else {
		$wz_artist = (array)$this->mArtist->get($id);
		$wz_status = $wz_artist['status'];
      $form_data = array(
	  	  'id' => $id,
          'payment_method' => set_value('payment_method'),
          'paypal_email' => set_value('paypal_email'),
          'abn' => set_value('abn'),
          'business_name' => set_value('business_name'),
		  'business_address' => set_value('business_address'),
		  'has_gst' => set_value('has_gst'),
		  'status' => ($wz_status!='step4')?$wz_status:'step5'
		);
      if ($newID = $this->mArtist->save($form_data)) {
	    if ($this->input->post('save')) {
        	redirect('/artist/step6/' . $newID);
		} else {
			redirect('/artist/step4/' . $newID);
		}
      
	  } else {
        $this->session->set_flashdata('error', 'An error occurred saving your information. Please try again later');

        $data = array(
          'title' => 'Create Profile Step 5',
          'main_content' => 'artist/step5'
        );
	        $this->load->view('template', $data);
      }
    }
  }

  public function step6($id=0) {
	$this->chk_login();
	if (!$id) {
      $this->session->set_flashdata('error', 'You have to resigter first.');
      redirect('/artist/register');
    }
	$wz_artist = (array)$this->mArtist->get($id);
	$wz_status = $wz_artist['status'];
	$form_data = array(
	  'id' => $id,
		'status' => ($wz_status!='step5')?$wz_status:'registered'
	);
    $newID = $this->mArtist->save($form_data);
    $data = array(
        'title' => '',
        'main_content' => 'artist/step6',
		'id' => $id
    );
    $this->load->view('template', $data);
  }
  
  public function create_new($id) {
	  if (!$id) {
      $this->session->set_flashdata('error', 'You have to resigter first.');
      redirect('/artist/register');
    }
	
	$artist = $this->mArtist->get($id);
	  if (!isset($artist->id) || !$artist->id) {
		  $this->session->set_flashdata('error', 'You have to resigter first.');
		  redirect('/artist/register');
	  }
	$data = array();
	$data =  array_merge($data ,(array)$this->mUser->get($artist->user_id));
	
	$ins['id'] = 0;
	$ins['user_id'] = $artist->user_id ;
	$ins['first_name'] = $artist->first_name ;
	$ins['last_name'] = $artist->last_name ;
	$ins['address'] = $artist->address ;
	$ins['suburb'] = $artist->suburb ;
	$ins['state'] = $artist->state ;
	$ins['country'] = $artist->country ;
	$ins['postcode'] = $artist->postcode ;
	$ins['phone_code'] = $artist->phone_code ;
	$ins['phone_number'] = $artist->phone_number ;
	$ins['phone_alternate'] = $artist->phone_alternate ;
	$ins['gender'] = $artist->gender ;
	  
	$aid = $this->mArtist->save($ins);
	redirect('/artist/step1/'.$aid);
  }
  
   private function _doUpload($id) {
	  return; //ajaxuploader implemented
	  
	  if ($_FILES['userfile']['error'] != 0) return;
	  
		$config['overwrite'] = TRUE;
		$config['allowed_types'] = 'jpg|jpeg|gif|png';
		$config['max_size'] = 2000;
		$config['upload_path'] = realpath(APPPATH . '../wpdata/images');
		
		$ins['parent'] = $id;
		$ins['title'] = '';
		$ins['online'] = 1;
		$ins['position'] = 10;
		$this->db->insert('wp_image_gallery', $ins);
		$newId = $this->db->insert_id();
		
		$config['file_name'] = $newId . ".jpg";

		$this->load->library('upload', $config);
		if ($this->upload->do_upload()) {
			$idata = $this->upload->data();
			$this->db->set('title', $idata['raw_name']);
			$this->db->where('id', $newId);
			$this->db->update('wp_image_gallery');
		} else {
			$this->db->where('id', $newId);
			$this->db->delete('wp_image_gallery');
		}
    }
	  function manage_profile($id){
		$this->chk_login();
		if (!$id) {
		  $this->session->set_flashdata('error', 'You have to resigter first.');
		  redirect('/artist/register');
		}
		 $data = array(
			  'title' => 'Create Profile Step 1',
			  'main_content' => 'artist/manage_profile'
		  );
		$r = $this->db->query("SELECT a.id as id, u.email from artist a, user u WHERE a.id='{$id}' AND a.user_id=u.id");
		$artist=($r->result_array());
		$email=$artist[0]['email'];
		
		$data['other_profiles']=$this->mArtist->other_profile($email);
		// echo '<pre style="display:none;">';print_r($data);echo '</pre>';
		$artist=($r->result_array());
		$type = $this->db->query("SELECT artist_id,type from artist_type where active = '1' ");
		$data['artist_type'] = ($type->result_array());
		$this->load->view('template', $data);
	  }
	  function personal_info($id){
		$this->chk_login();
		if (!$id) {
		$this->session->set_flashdata('error', 'You have to resigter first.');
		redirect('/artist/register');
		}
		$this->form_validation->set_rules('first_name', 'First Name', 'required|trim');
		$this->form_validation->set_rules('last_name', 'Last Name', 'required|trim');
		$this->form_validation->set_rules('secret_answer', 'Secret Answer', 'required');
			
		if ($this->form_validation->run() == FALSE) {
		$data = array(
		'title' => 'Personal Information',
		'main_content' => 'artist/personal_info'
		);
		$data['form_errors'] = $this->form_validation->error_array();
		$questions = $this->mUtil->getCodes('Secret Questions');
		  foreach ($questions as $s) {
			$data['questions'][$s] = $s;  
		  }
		$sql = "select artist.*, artist_type.type as artist_type_name,usr.email from artist LEFT JOIN artist_type ON artist.profile_type=artist_type.artist_id LEFT JOIN user usr ON usr.id = artist.user_id where artist.id = '{$id}' ";
		$query = $this->db->query($sql);
		$data['personal'] = ($query->result_array());
		#echo '<pre style="display:none;">';print_r($data);echo '</pre>';
			
		$this->load->view('template', $data);
		} else {
		#echo '<pre style="display:none;">';print_r($_POST);echo '</pre>';
		$this->session->set_flashdata('message', 'You have updated successfully.');
		$dob=$_POST['dob_year'].'-'.$_POST['dob_month'].'-'.$_POST['dob_day'];

		$secret_question=mysql_real_escape_string($_POST['secret_question']);
		$secret_answer=mysql_real_escape_string($_POST['secret_answer']);
		
		$updatesql ="UPDATE `artist` a, user u SET a.`first_name` = '{$_POST['first_name']}', a.`last_name` = '{$_POST['last_name']}', a.gender='{$_POST['gender']}', u.dob='{$dob}', u.secret_answer='{$secret_answer}', u.secret_question='{$secret_question}' ";
		if($_POST['password1']!='') $updatesql.=", u.password='{$_POST['password1']}'";
		$updatesql.=" WHERE a.`id` ='{$id}' && a.user_id=u.id";		
		
		$this->db->query($updatesql);
		redirect('/artist/personal_info/'.$id);
		}
	  }
	  function check_profile($email){
		if($email=='') { return false; }
		$other_profiles=$this->mArtist->other_profile($email);	  
		if(sizeof($other_profiles)>0) {
			$this->form_validation->set_message('check_profile', 'This email is already registered. Login to edit or add more profiles.');
			return false;
		}
		else return true;
	  }
	  public function chk_login(){
		if($this->session->userdata('is_loged')==1) {
			return;
		}
		else {
			$this->session->set_flashdata('error', 'Please Login.');
			redirect($this->config->item('base_url').'artist');
		}	  
	  }
	  public function audio($src='audio', $url=''){
		$data['url']=$url;
		if(!empty($_POST['url'])) $data['url']=$_POST['url'];
		$this->load->view('artist/'.$src,$data);
	  }
	  
	  function random_text(){
	  $codelenght = 10;
	  $newcode_length=0;$newcode='';
		 while($newcode_length < $codelenght) {
		 $x=1;
		 $y=3;
		 $part = rand($x,$y);
		 if($part==1){$a=48;$b=57;}  // Numbers
		 if($part==2){$a=65;$b=90;}  // UpperCase
		 if($part==3){$a=97;$b=122;} // LowerCase
		 $code_part=chr(rand($a,$b));
		 $newcode_length = $newcode_length + 1;
		 $newcode = $newcode.$code_part;
		 }
		 return $newcode;
	}
  }