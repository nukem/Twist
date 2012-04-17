<?php
function consise_text($text, $limit = 20, $spaces = false){
	if(!$spaces){
		$text = preg_replace('/\s+/', ' ', $text);
	}
	$pieces = explode(' ', $text);
	$cnt = count($pieces);
	if($cnt > $limit){
		$newtext = '';
		for($i=0; $i<$limit; $i++){
			$newtext .= $pieces[$i] . ' ';
		}
	}else{
		$newtext = $text . ' ';
	}
	return preg_replace('/\.[^\.]*$/', '', $newtext);
}

function in_array_deep($needle, $haystack, $key = false) {
	// thanks vandor at ahimsa dot hu (php.net) for the idea
	foreach($haystack as $k => $v) {
		if( is_array($v) ){
			if(in_array_deep($needle, $v, $key) === true) return true;
		}elseif($needle == $v){
			if(!$key){
				return true;
			}elseif($key == $k){
				return true;
			}
		}
	}
	return false;
}

function show_value($key) {
	global $record;
	if(isset($_POST[$key]) && trim($_POST[$key]) != '') {
		return $_POST[$key];
	} else if(isset($record[$key]) && trim($record[$key]) != '') {
		return $record[$key];
	} else {
		return '';
	}
}

function save_np_categories($userid = 0, $subscribe = 0, $categories = array()) {
	if($subscribe == false) {
		$sql = 'DELETE FROM np_customer_category WHERE custid_fk = ' . $userid;
		dbq($sql);
		$return['success'] = true;
		$return['message'] = 'User removed from Newsletter Pro';
	} else {
		if(count($categories) <= 0) {
			$return['success'] = false;
			$return['message'] = 'Unable to save user. At least one category is required.';
		} else {
			$sql = 'DELETE FROM np_customer_category WHERE custid_fk = ' . $userid;
			dbq($sql);

			foreach($categories as $cat) {
				$sql = 'INSERT INTO np_customer_category (custid_fk, categoryid_fk) VALUES (' . $userid . ', ' . $cat . ');';
				dbq($sql);
			}
			$return['success'] = true;
			$return['message'] = 'Newsletter Pro categories have been saved.';
		}
	}
	return $return;
}

/* the original set of functons by  J-LOWE */
function dbq ($query) {
	global $message;
	if (ereg ('^SELECT', $query)) {
		$result = mysql_query ($query) or die(mysql_error() . $query);	
		while ($row = mysql_fetch_array ($result, MYSQL_ASSOC))
			$return[] = $row;
		if (isset ($return))
			return ($return);
		else
			return (false);
	} elseif (ereg ('^INSERT', $query)) {
		mysql_query ($query) or die(mysql_error() . $query);
		return (mysql_insert_id ());
	} else {
		mysql_query ($query) or die(mysql_error() . $query);
		return (mysql_affected_rows ());
	}
}

function CroppedThumbnail($width_orig, $height_orig, $thumbnail_width,$thumbnail_height, $myImage) {
    //getting the image dimensions  
    $ratio_orig = $width_orig/$height_orig;
    
    if ($thumbnail_width/$thumbnail_height > $ratio_orig) {
       $new_height = $thumbnail_width/$ratio_orig;
       $new_width = $thumbnail_width;
    } else {
       $new_width = $thumbnail_height*$ratio_orig;
       $new_height = $thumbnail_height;
    }
    
    $x_mid = $new_width/2;  //horizontal middle
    $y_mid = $new_height/2; //vertical middle
    
    $process = imagecreatetruecolor(round($new_width), round($new_height)); 
    
    imagecopyresampled($process, $myImage, 0, 0, 0, 0, $new_width, $new_height, $width_orig, $height_orig);
    $thumb = imagecreatetruecolor($thumbnail_width, $thumbnail_height); 
    imagecopyresampled($thumb, $process, 0, 0, ($x_mid-($thumbnail_width/2)), ($y_mid-($thumbnail_height/2)), $thumbnail_width, $thumbnail_height, $thumbnail_width, $thumbnail_height);

    imagedestroy($process);
    imagedestroy($myImage);
    return $thumb;
}

function resize_img ($oldFile, $newFile, $newWidth, $newHeight, $method, $stretch, $jpgQuality, $fillR, $fillG, $fillB) {
	$imageInfo = getimagesize ($oldFile);
	switch ($imageInfo[2]) {
	case 1:
		$oldImage = imagecreatefromgif ($oldFile);
		break;
	case 2:
		$oldImage = imagecreatefromjpeg ($oldFile);
		break;
	case 3:
		$oldImage = imagecreatefrompng ($oldFile);
		break;
	}
	if ($method == 'shrink') {
		if (! $stretch && $imageInfo[0] < $newWidth && $imageInfo[1] < $newHeight) {
			$newImage = imagecreatetruecolor ($imageInfo[0], $imageInfo[1]);
			imagecopyresampled ($newImage, $oldImage, 0, 0, 0, 0, $imageInfo[0], $imageInfo[1], $imageInfo[0], $imageInfo[1]);
		} else {
			if ($imageInfo[0] / $imageInfo[1] >= $newWidth / $newHeight) {
				$newImage = imagecreatetruecolor ($newWidth, ($newWidth * $imageInfo[1]) / $imageInfo[0]);
				imagecopyresampled ($newImage, $oldImage, 0, 0, 0, 0, $newWidth, ($newWidth * $imageInfo[1]) / $imageInfo[0], $imageInfo[0], $imageInfo[1]);
			} else {
				$newImage = imagecreatetruecolor (($imageInfo[0] * $newHeight) / $imageInfo[1] , $newHeight);
				imagecopyresampled ($newImage, $oldImage, 0, 0, 0, 0, ($imageInfo[0] * $newHeight) / $imageInfo[1], $newHeight, $imageInfo[0], $imageInfo[1]);
			}
		}
		imagejpeg ($newImage, $newFile, $jpgQuality);
	} elseif ($method == 'crop') {
		$newImage = CroppedThumbnail($imageInfo[0], $imageInfo[1], $newWidth, $newHeight, $oldImage);
		imagejpeg ($newImage, $newFile, $jpgQuality);
	} elseif ($method == 'fit') {
		$newImage = imagecreatetruecolor ($newWidth, $newHeight);
		$color = imagecolorallocate ($newImage, $fillR, $fillG, $fillB);
		imagefill ($newImage, 0, 0, $color);
		if (! $stretch && ($imageInfo[0] < $newWidth && $imageInfo[1] < $newHeight)) {
			imagecopyresampled ($newImage, $oldImage, floor (($newWidth - $imageInfo[0]) / 2), floor (($newHeight - $imageInfo[1]) / 2), 0, 0, $imageInfo[0], $imageInfo[1], $imageInfo[0], $imageInfo[1]);
		} else {
			if ($imageInfo[0] / $imageInfo[1] >= $newWidth / $newHeight)
				imagecopyresampled ($newImage, $oldImage, 0, floor (($newHeight - ($newWidth * $imageInfo[1]) / $imageInfo[0]) / 2), 0, 0, $newWidth, ($newWidth * $imageInfo[1]) / $imageInfo[0], $imageInfo[0], $imageInfo[1]);
			else
				imagecopyresampled ($newImage, $oldImage, floor (($newWidth - ($imageInfo[0] * $newHeight) / $imageInfo[1]) / 2), 0, 0, 0, ($imageInfo[0] * $newHeight) / $imageInfo[1], $newHeight, $imageInfo[0], $imageInfo[1]);
		}
		imagejpeg ($newImage, $newFile, $jpgQuality);
	}
}

function get_js_size ($image, $frame) {
	$imagesize = getimagesize ($image);
	return ("width=" . ($imagesize[0] + $frame) . ",height=" . ($imagesize[1] + $frame));
}

function get_html_size ($image) {
	$imagesize = getimagesize ($image);
	return ('width="' . $imagesize[0] . '" height="' . $imagesize[1] . '"');
}

function strip_slashes_deep ($var) {
	$var = is_array ($var) ? array_map ('strip_slashes_deep', $var) : stripslashes ($var);
	return $var;
}

function strip_accents ($str) {
	$translation = array ('Á' => 'A', 'Ä' => 'A', 'Č' => 'C', 'Ď' => 'D', 'É' => 'E', 'Ě' => 'E', 'Ë' => 'E', 'Í' => 'I', 'Ň' => 'N', 'Ó' => 'O', 'Ö' => 'O', 'Ř' => 'R', 'Š' => 'S', 'Ť' => 'T', 'Ú' => 'U', 'Ů' => 'U', 'Ü' => 'U', 'Ý' => 'Y', 'Ž' => 'Z', 'á' => 'a', 'ä' => 'a', 'č' => 'c', 'ď' => 'd', 'é' => 'e', 'ě' => 'e', 'ë' => 'e', 'í' => 'i', 'ň' => 'n', 'ó' => 'o', 'ö' => 'o', 'ř' => 'r', 'š' => 's', 'ť' => 't', 'ú' => 'u', 'ů' => 'u', 'ü' => 'u', 'ý' => 'y', 'ž' => 'z');
	return strtr ($str, $translation);
}

function retrieve_coords($address) {

	$gc_url = 'http://maps.google.com/maps/geo?q=' . urlencode($address) . '&output=csv&oe=utf8&sensor=false&gl=au';
	$wfp = fopen($gc_url, 'r');
	$data = fread($wfp, 1024);
	fclose($wfp);
	$data = explode(',', $data);
	$coords = array(
		'lat' => '',
		'lon' => ''
	);
	if (count($data) == 4 && $data[2] != 0 && $data[3] != 0)
	{
		$coords = array(
			'lat' => $data[2],
			'lon' => $data[3]
		);
	}

	return $coords;

}


?>
