<?php

// Defining Program Variables ------------------------------------------------------------------------//

include("config.php");

$name = $_POST['name'];
$cjmsg = $_POST['cjmsg'];
$url = $_POST['url'];
$ip = $_SERVER['REMOTE_ADDR'];
$agent = $_SERVER['HTTP_USER_AGENT'];
$added_time = time();

// Checking for banned IPs ----------------------------------------------------------------------------//

$banned_array = file($ipbanfile);
foreach ($banned_array as $key => $bip) {
	if($ip == trim($bip)){
		header("location: {$display}?msg=<font color=maroon>Banned:</font><br>You have been banned from using the Tag Board <img src=e/razz.gif><p>");
		exit;
	}
}

// Checking for flooders ------------------------------------------------------------------------------//

if(flooder($ip)){
   header("location: {$display}?msg=<font color=maroon>Flood v�delem:</font><br>�jabb �zenetet csak $flood_time m�sodpercenk�nt k�ldhetsz el<p>&flood=on");
   exit;
}
else{
	$floodfp = fopen($floodfile, "a");
	fwrite($floodfp, "$added_time|$ip|\n");
	fclose($floodfp);
}

// Checking for blank fields -------------------------------------------------------------------------//

$sub_error = false;
$sub_emsg = "<font color=maroon>Hi�nyz� adat:</font><br>";

if(!isset($name) || $name == ""){			// if some idiot just clicks "tag"
	$sub_emsg .= "<li>N�v";
	$sub_error = true;
}
if(!isset($cjmsg) || $cjmsg == ""){
	$sub_emsg .= "<li>�zenet";
	$sub_error = true;
}
if($sub_error){
	header("location: {$display}?msg=$sub_emsg<p>");
	exit;
}

// Replacing and converting ------------------------------------------------------------------------//

$cjmsg = str_replace("&lt;","<", $cjmsg);
$cjmsg = str_replace("&gt;",">", $cjmsg);
$cjmsg = strip_tags($cjmsg);					// strips HTML tags from tag
$name = strip_tags($name);						// strips all HTML tags from name
$ename = $name;										// sets email name
$cjmsg = ubbCode($cjmsg);

if($smilies == 1){
	$cjmsg = convertSmilies($cjmsg);
}

// Bad Word Filter function

foreach($badword_array as $insult=>$ok){
        $cjmsg = eregi_replace("$insult", "$ok", "$cjmsg");
        }

foreach($badword_array as $insult=>$ok){
        $name = eregi_replace("$insult", "$ok", "$name");
        }

############################################################
############################################################

$name .= ":";
$person = $name;
$name = "<img src=\"e/ip.gif\" border =\"0\"> $person";

if($stats == 1){
	$date = date("l d F - Y");
	$time = date("g:i:s a");
   $write = "<small><b><a href=\"javascript:popUp('details.php?name=$person&ip=$ip&agent=$agent&date=$date&time=$time')\" title=\"View Details\">$name</a></b><br><!--@-->$cjmsg<!--#--><br></small>\r\n";
}
else{
	$write = "<small><b>$name</b><br><!--@-->$cjmsg<!--#--><br></small>\r\n";
}

$tagomfile = file($datfile);

if ($cjmsg != "") {
	if (strlen($cjmsg) < 2000) {			// after converting smilies...
		$fd = fopen ($datfile, "w");

		$write = stripslashes($write);		
		
		fwrite ($fd, $write);
			for ($count = 0; $count < $NUM_COMMENTS-1; $count++) {
				fwrite ($fd, $tagomfile[$count]);
			}

			if($printall == 1){
					$alltagomfile = file($datfileall);
					$amount = count($alltagomfile);

					$fdall = fopen ($datfileall, "w");

					fwrite ($fdall, $write);
						for ($counter = 0; $counter <= $amount+1; $counter++) {
							fwrite ($fdall, $alltagomfile[$counter]);
						}
					fclose($fdall);
				}
	}
fclose($fd);

// Write the counter....

require("tagcount.txt");

$countfilename = "tagcount.txt";
$increment = $tagcount + 1;
$incrementoutput = "<? $" . "tagcount = " . $increment . "; ?>";
$countwrite = fopen($countfilename, "w");
fwrite ($countwrite, $incrementoutput);
fclose($countwrite);

}

// email the admin?

if($send_notify == "yes"){
	$cjmsg = strip_tags($cjmsg);					// strips potential smilies from tag
	$recipient = "$yourname <$email>";
	$subject = "You have been Tagged!";
	$message = "$yourwebsite has been tagged!\nOn: $date - $time\n\nName: $ename\n\nMessage: $cjmsg";
	$headers = "From: $ename <$email>\r\nReply-To: $email\r\n";
	mail ($recipient, $subject, $message, $headers);
}

// else dont do anything to the data file

header("location: {$display}?msg=K�sz�nj�k az �zeneted $ename<p>");
exit;

function flooder($ip){
    global $flood_time, $floodfile;

    $old_db = file($floodfile);
    $new_db = fopen($floodfile, w);
    $result = FALSE;
    foreach($old_db as $old_db_line){
        $old_db_arr = explode("|", $old_db_line);
        if(($old_db_arr[0] + $flood_time) > time() ){
            fwrite($new_db, $old_db_line);
            if($old_db_arr[1] == $ip){ 
				$result = TRUE; 
			}
        }
    }
    fclose($new_db);
    return $result;
}

function ubbCode($text){
    // Array of tags with opening and closing
    $tagArray['b'] = array('open'=>'<b>','close'=>'</b>');
    $tagArray['i'] = array('open'=>'<i>','close'=>'</i>');
    $tagArray['u'] = array('open'=>'<u>','close'=>'</u>');
    $tagArray['url'] = array('open'=>'<a target="_blank" href="','close'=>'">\\1</a>');
    $tagArray['email'] = array('open'=>'<a href="mailto:','close'=>'">\\1</a>');
    $tagArray['url=(.*)'] = array('open'=>'<a target="_blank" href="','close'=>'">\\2</a>');
    $tagArray['email=(.*)'] = array('open'=>'<a href="mailto:','close'=>'">\\2</a>');
    $tagArray['color=(.*)'] = array('open'=>'<font color="','close'=>'">\\2</font>');

    foreach($tagArray as $tagName=>$replace){
         $tagEnd=preg_replace('/\W/Ui','',$tagName);
         $text = preg_replace("|\[$tagName\](.*)\[/$tagEnd\]|Ui","$replace[open]\\1$replace[close]",$text);
    }
    return $text;
}

function convertSmilies($cjmsg){
	$cjmsg = str_replace(":D","<img src=\"e/grin.gif\">", $cjmsg);
	$cjmsg = str_replace(":)","<img src=\"e/smile.gif\">", $cjmsg);
	$cjmsg = str_replace(":lol","<img src=\"e/lol.gif\">", $cjmsg);
	$cjmsg = str_replace(":p","<img src=\"e/razz.gif\">", $cjmsg);
	$cjmsg = str_replace(":evil","<img src=\"e/evil.gif\">", $cjmsg);
	$cjmsg = str_replace(":(","<img src=\"e/sad.gif\">", $cjmsg);
	$cjmsg = str_replace(":|","<img src=\"e/shocked.gif\">", $cjmsg);
	$cjmsg = str_replace(";)","<img src=\"e/wink.gif\">", $cjmsg);
	$cjmsg = str_replace(":x","<img src=\"e/mad.gif\">", $cjmsg);
	$cjmsg = str_replace(":cry","<img src=\"e/cry.gif\">", $cjmsg);
	$cjmsg = str_replace(":blink","<img src=\"e/rolleyes.gif\">", $cjmsg);
	$cjmsg = str_replace(":o","<img src=\"e/suprised.gif\">", $cjmsg);
	$cjmsg = str_replace(":?","<img src=\"e/question.gif\">", $cjmsg);
	$cjmsg = str_replace(":s","<img src=\"e/confused.gif\">", $cjmsg);
	$cjmsg = str_replace("B)","<img src=\"e/cool.gif\">", $cjmsg);
	$cjmsg = str_replace(":red","<img src=\"e/redface.gif\">", $cjmsg);

	$cjmsg = str_replace("\n","", $cjmsg);	
	$cjmsg = str_replace("\r","", $cjmsg);
	return $cjmsg;
}

?>
