<?php

$videourl = $_GET['videourl'];


	$video_url = $videourl;
	#$video_url = "http://tsr2.propvid.tv/tsr3/pv/view.php?sc=0f5f100057";
	#$video_url = "http://tsr2.propvid.tv/tsr3/pv/view.php?sc=d1aad7d06e";

	if(isset($video_url)) {
		if(stripos($video_url, 'youtube') !== false) {

			include('AutoEmbed.class.php');
			$embed = new AutoEmbed();
			$embed->parseUrl($videourl);
			$video_id = preg_replace('/[^0-9]+/', '', $videourl);
			$embed->setParam('wmode','transparent');
			$code = $embed->getEmbedCode();
			$json = array();
			$json['swfobject'] = $code;
			
		} else {
			
			//$dom = new DomDocument();
			//$dom->validateOnParse = true;
			$html_file = trim($video_url);
			//@$dom->loadHTMLFile($html_file);
			//$img = $dom->getElementsByTagName('img');
			//var_dump($dom);

			$html = file_get_contents($video_url);

			//$re = "@<tr><th[^>]*>([^<]|<[^/]|</[^t]|</t[^a])+</tr>@is";
			$re = "@<div style=\"[a-z:;]+?\">[^<]*<table>[^<]*<tr><th[^>]*>([^<]|<[^/]|</[^t]|</t[^a])+</tr>[^<]*</table>[^<]*</div>@is";
			$pr = preg_match_all($re, $html, $matches);

			$embed_re = '/var mediatype = \'(.+?)\';/';
			$pr = preg_match_all($embed_re, $html, $embed_matches);
			$json['swfobject'] = array_pop($embed_matches[1]);

			$json['agents'] = '<div id="bottom_right_box">';
			$json['agents'] .= $matches[0][0] . $matches[0][1];
			$json['agents'] .= '</div>';


			$json['agents'] = str_ireplace('<td class="agent_row_desc">&nbsp;</td>', '', $json['agents']);
			$json['agents'] = str_ireplace('<td class="agent_row_desc"> </td>', '', $json['agents']);




			$img_re = "@src='(/files/headshots/[a-z_0-9-]+?.jpg)'@";
			$pr = preg_match($img_re, $html, $img);
			/*
			# Scrape the page for the agent photo.
				foreach($img as $image) {
					$json['agent_photo'] = 'http://tsr2.propvid.tv/tsr3/pv/' . $image[1];
				}
			 */
			$json['agent_photo'] = 'http://imagetrack.com.au' . $img[1];
			# Scrape the page for agent details.
			//$json['agents'] = $dom->saveXML($dom->getElementById('bottom_right_box'));

			preg_match('/sc=([a-z0-9]+)/', $video_url, $matches);
			
			if(is_array($matches) && count($matches) > 0) {
				$json['scode'] = $matches[1];
			}
			

		}

		echo json_encode($json);
	}

?>
