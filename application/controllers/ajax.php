<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

/**
 * Soundbooka
 * 
 * @author     Chathura Payagala <chathupayagala@gmail.com>
 */
class Ajax extends MY_Controller {

  function Ajax() {
    parent::__construct();
    $this->load->model('mUser');
    $this->load->model('mArtist');
    $this->load->model('mUtil');
  }

  public function index() {
    die('-1');
  }

  public function getStateOptions($country_id) {
    $states = $this->mUtil->getStateList($country_id);
    $options = array('' => '<option value="">-- please select --</option>');
    foreach ($states as $k => $s) {
      $options[] = "<option value='{$k}'>{$s}</option>";
    }
    echo implode("\n", $options);
    die;
  }
  
  public function getInstrumentOptions($cat_id) {
    $states = $this->mUtil->getInstrumentList($cat_id);
    $options = array('' => '<option value="">-- please select --</option>');
    foreach ($states as $k => $s) {
      $options[] = "<option value='{$k}'>{$s}</option>";
    }
    echo implode("\n", $options);
    die;
  }
	
	
	public function saveInstrument() {
		$ret = $this->mArtist->saveInstrument($_POST);
		echo $ret;
		die;
	}
	
	public function removeInstrument() {
		$this->db->where('id',$_POST['ai_id']);
		$this->db->delete('artist_Instruments');
		die;
	}
	
	public function setProfilePic() {
		$this->db->where('parent',$_POST['artist_id']);
		$this->db->set('position',10);
		$this->db->update('wp_image_gallery');
		
		$this->db->where('id',$_POST['id']);
		$this->db->set('position',0);
		$this->db->update('wp_image_gallery');
		die;
	}
	
	public function removeProfilePic() {
		unlink(realpath('wpdata/images/'.$_POST['id'].'.jpg'));
		unlink(realpath('wpdata/images/'.$_POST['id'].'_*.jpg'));
		$this->db->where('id',$_POST['id']);
		$this->db->delete('wp_image_gallery');
		die;
	}
	
	public function saveMedia() {
		$d = explode("/",$_POST['date_recorded']);
		$_POST['date_recorded'] = $d[2] . "-" . $d[1] . "-" . $d[0];
		$ret = $this->mArtist->saveMedia($_POST);
		echo $ret;
		die;
	}
	
	
	public function removeMedia() {
		$this->db->where('id',$_POST['am_id']);
		$this->db->delete('artist_media');
		die;
	}
	
	public function removePlot() {
		$this->db->where('id',$_POST['plot_id']);
		$this->db->delete('plots');
		die;
	}
	
	public function getVideo() {
		$url = urldecode($_POST['url']);
		echo video_player($url);
		die;
	}
	/*public function getAudio() {
		$url = urldecode($_REQUEST['url']);
		echo audio_player($url);
		die;
	}*/
	
	public function deletetest(){
		$this->db->where('status', 'test');
		$this->db->delete('artist');
		die;
	}
	
	public function getAudio() {
	  $url = urldecode($_POST['url']);
	  //echo $url;
	  $test = explode('/',$url);
	  if($test['2'] == 'soundbooka.com'){
	   echo '<div id="audioplayer_1" style="margin-left:150px;"><img src="<?=base_url()?>images/ajax-loader.gif" /></div>
	  <script type="text/javascript">  
	  AudioPlayer.embed("audioplayer_1", {soundFile: "'.$url.'",autostart: "yes"}); 
	  </script>';  
	  }
	  else{
	  echo audio_player($url,1);
	  }
	 }
	public function savePlot() {
		$artist_id=$_POST['artist_id'];
		$plot=$_POST['plot'];
		$this->db->insert('plots',array('artist_id'=>$artist_id, 'plot'=>$plot));
		die(1);
	 }
	 
	 function gigs($id=0){
		if($id==0) return;
		/*$data['artist_id']=$id;
		$q=$this->db->query("SELECT * FROM manage_gigs WHERE status!='deactive'");
		$data['gigs']=$q->result_array();
		$q=$this->db->query("SELECT * FROM artist_gig_map WHERE artist_id={$id}");
		$a=$q->result_array();
		$id=array();
		if(count($a)>0) { foreach($a as $v) $id[]=$v['gig_id']; }*/
		$data['artists']=$id;
		
		#echo '<pre style="display:none;">';print_r($data['artists']);echo '</pre>';
		
		
		$this->load->view('booka/offer_gig',$data);
	}
}