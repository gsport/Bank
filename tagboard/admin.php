<?
if (!isset($_SESSION['username']) && !isset($_SESSION['password'])){
	header("Location: admin_index.php");
	exit;
}
if (isset($_SESSION['username']) && isset($_SESSION['password'])){

include("config.php");

if($_GET['action'] == "edit"){
	printheader();
	editTag($_GET['tagid']);
	viewTags();
}
else if($_GET['action'] == "delete"){
	printheader();
	deleteTag($_GET['tagid']);
	viewTags();
}
else if($_GET['action'] == "ipban"){
		showBanned();
}
else if($_GET['action'] == "logout"){
		logout();
}
else if($_GET['action'] == "about"){
		about();
}
else if($_GET['action'] == "support"){
		print "<font size=3><b>CJ Tag Board V3.0 Support</b></font><p>";
		print "For support on the CJ Tag Board V3.0 go to the CJ Website Design forums by clicking the link below:<br><br><A HREF=\"http://www.cj-design.com/forum\">CJ Website Design Forums</A>";
}
else{
	printheader();
	viewTags();
}

}

function printheader(){
	print "<font size=3><b>CJ Tag Board V3.0 Adminisztráció</b></font><p>";
}

function editTag($tag){

	global $datfileall, $datfile, $administer_amount, $NUM_COMMENTS;

	if($_POST['submit'] == "submit"){
		$tagid = $_POST['tagid'];
		$newtag = $_POST['cjmsg'];
		$newtag = str_replace("&lt;","<", $newtag);
		$newtag = str_replace("&gt;",">", $newtag);
		$newtag = stripslashes($newtag);
		$newtag = smileyfiyer($newtag);
		$newtag = ubbCode($newtag);

		if($tagid < $NUM_COMMENTS){
			$fp2 = @fopen($datfile, 'r'); 
				if($fp2){  
					$array2 = explode("\n", fread($fp2, filesize($datfile)));
					fclose($fp2);
					$delete = array_pop($array2);
					$new = replacer($array2[$tagid],$newtag);

					$array2[$tagid] = $new; // inserting new
					
					$fpwrite2 = fopen($datfile,"w");
					for($a=0;$a<count($array2);$a++){
						fwrite($fpwrite2,$array2[$a]."\n");
					}
					fclose($fpwrite2);
					print "<li>Üzenet módosítva a következõ fájlban: \"$datfile\"";
				}
				else{
					print "<li>A $datfile fájl nem létezik, kérlek ellenõrizd az elérési utat: {$datfile}!";
					print "<li>Üzenet módosítása sikertelen a következõ fájlban: \"$datfile\"";
				}				
		}

		$fp = @fopen($datfileall, 'r');
		if($fp){  
			$array = explode("\n", fread($fp, filesize($datfileall)),$administer_amount+1);
			$delete = array_pop($array);
			$new = replacer($array[$tagid],$newtag);
			$array[$tagid] = $new; // inserting new
			
			$fpwrite = fopen($datfileall,"w");
			for($b=0;$b<count($array);$b++){
				fwrite($fpwrite,$array[$b]."\n");
			}
			fclose($fpwrite);
			print "<li>Üzenet módosítva a következõ fájlban: \"$datfileall\"<p>";
		}
		else{
			print "<li>A $datfileall fájl nem létezik, kérlek ellenõrizd az elérési utat: {$datfileall}!";
			print "<li>Üzenet módosítása sikertelen a következõ fájlban: \"$datfileall\"<p>";
		}
	}
	else{
		$fp = @fopen($datfileall, 'r'); 
		if($fp){  
			$array = explode("\n", fread($fp, filesize($datfileall)),$administer_amount+1);
			fclose($fp);
			$delete = array_pop($array);

			$show = remover($array[$tag], "<!--@-->", "<!--#-->");
			$show = desmileyfier($show);

			print "<font size=2><b>Üzenet szerkesztése</b></font>";

			print "<form method=post action=$PHP_SELF?action=edit name=\"tagboard\">";
			print "<input type=hidden name=submit value=submit>";
			print "<input type=hidden name=tagid value=$tag>";
			print "<textarea name=cjmsg cols=\"45\" rows=\"8\">$show</textarea><br><br>";
			print "<input type=\"submit\" value=\"Mentés\">&nbsp;<input type=\"reset\" value=\"Vissza\">&nbsp;<input type=\"button\" class=\"xtra\" value=\"Kód beszúrása\" OnClick=\"popXtras('insert.php')\">";
			print "</form>";
			print "<p>";
		}
		else{
			print "<b>A $datfileall fájl nem létezik, kérlek ellenõrizd az elérési utat: {$datfileall}!";
		}
	}
}

function deleteTag($tag){

	global $datfileall, $datfile, $administer_amount, $NUM_COMMENTS;

		$tagid = $_GET['tagid'];
		if($tagid < $NUM_COMMENTS){
			$fp2 = @fopen($datfile, 'r'); 
				if($fp2){  
					$array2 = explode("\n", fread($fp2, filesize($datfile)));
					fclose($fp2);
					$delete = array_pop($array2);
					unset($array2[$tagid]); // delete it!
					$newarray2 = array_values($array2);					
					$fpwrite2 = fopen($datfile,"w");
					for($a=0;$a<count($newarray2);$a++){
						fwrite($fpwrite2,$newarray2[$a]."\n");
					}
					fclose($fpwrite2);
					print "<li>Üzenet törlése a következõ fájlban: \"$datfile\"";
				}
				else{
					print "<li>A $datfile fájl nem létezik, kérlek ellenõrizd az elérési utat: {$datfile}!";
					print "<li>Az üzenet törlése sikertelen \"$datfile\"";
				}				
		}

		$fp = @fopen($datfileall, 'r');
		if($fp){  
			$array = explode("\n", fread($fp, filesize($datfileall)),$administer_amount+1);
			$delete = array_pop($array);
			unset($array[$tagid]); // delete it!
			$newarray = array_values($array);	
			$fpwrite = fopen($datfileall,"w");
			for($b=0;$b<count($newarray);$b++){
				fwrite($fpwrite,$newarray[$b]."\n");
			}
			fclose($fpwrite);
			print "<li>Üzenet törlése a következõ fájlban: \"$datfileall\"<p>";
			
			require("tagcount.txt");
			$countfilename = "tagcount.txt";
			$increment = $tagcount - 1;
			$incrementoutput = "<? $" . "tagcount = " . $increment . "; ?>";
			$countwrite = fopen($countfilename, "w");
			fwrite ($countwrite, $incrementoutput);
			fclose($countwrite);
		}
		else{
			print "<li>A $datfileall fájl nem létezik, kérlek ellenõrizd az elérési utat: {$datfileall}!";
			print "<li>Az üzenet törlése sikertelen \"$datfileall\"<p>";
		}
}

function viewTags(){

global $datfileall, $administer_amount;

$bgcolor1 = "#F1F1F1";
$bgcolor2 = "#FFFFFF";

$fp = @fopen($datfileall, 'r'); 
if($fp){  
	$array = explode("\n", fread($fp, filesize($datfileall)),$administer_amount+1);
}
else{
	print "<b>$datfileall Does not exist, please check the location of {$datfileall}!";
}
$delete = array_pop($array);
print "<table border=\"0\" cellpadding=\"5\" cellspacing=\"0\" width=\"550\" style=\"border: 1 solid #000000\">";
$bgcolor = true;
	for($i=0;$i<=sizeof($array);$i++){
		$atag = $array[$i];
		if(strlen($atag) > 1){
			print "\n<tr>\n";
			if($bgcolor){
				if(strlen($atag) > 300)
					$atag = wordwrap($atag, 55, "\n", 1);
				print "<td width=\"98%\" bgcolor=\"$bgcolor1\">$atag</td>\n";
				print "<td width=\"1%\" bgcolor=\"$bgcolor1\">\n<input type=\"button\" value=\"Szerkeszt\" onclick=\"LoadEdit('$PHP_SELF?action=edit&tagid=$i')\">\n</td>";
				print "<td width=\"1%\" bgcolor=\"$bgcolor1\">\n<input type=\"button\" value=\"Töröl\" onclick=\"ConfirmDelete('$PHP_SELF?action=delete&tagid=$i')\">\n</td>\n";
				$bgcolor = false;
			}
			else{
				if(strlen($atag) > 300)
					$atag = wordwrap($atag, 55, "\n", 1);
				print "<td width=\"98%\" bgcolor=\"$bgcolor2\">$atag</td>\n";
				print "<td width=\"1%\" bgcolor=\"$bgcolor2\">\n<input type=\"button\" value=\"Szerkeszt\" onclick=\"LoadEdit('$PHP_SELF?action=edit&tagid=$i')\">\n</td>";
				print "<td width=\"1%\" bgcolor=\"$bgcolor2\">\n<input type=\"button\" value=\"Töröl\" onclick=\"ConfirmDelete('$PHP_SELF?action=delete&tagid=$i')\">\n</td>";
				$bgcolor = true;
			}
			print "</tr>\n";
		}
	}
print "</table>";

} // end function

function remover($string, $sep1, $sep2){
       $string = substr($string, 0, strpos($string,$sep2));		// gives start to <!--#-->
       $string = substr(strstr($string, $sep1),0);					// gives <!--@--> to <!--#-->
	   $string = str_replace($sep1,"", $string);					// deletes <!--@-->
       return $string;
}
function replacer($oldtag,$newtag){
	$firstpart = substr($oldtag, 0, strpos($oldtag,"<!--@-->"));	
	$secondpart = substr($oldtag, strpos($oldtag,"<!--#-->"), strlen($oldtag));	
	$new = $firstpart."<!--@-->".$newtag.$secondpart;
	return $new;
}
function desmileyfier($cjmsg){
	$cjmsg = str_replace("<img src=\"e/grin.gif\">",":D ", $cjmsg);
	$cjmsg = str_replace("<img src=\"e/smile.gif\">",":) ", $cjmsg);
	$cjmsg = str_replace("<img src=\"e/lol.gif\">",":lol ", $cjmsg);
	$cjmsg = str_replace("<img src=\"e/razz.gif\">",":p ", $cjmsg);
	$cjmsg = str_replace("<img src=\"e/evil.gif\">",":evil ", $cjmsg);
	$cjmsg = str_replace("<img src=\"e/sad.gif\">",":( ", $cjmsg);
	$cjmsg = str_replace("<img src=\"e/shocked.gif\">",":| ", $cjmsg);
	$cjmsg = str_replace("<img src=\"e/wink.gif\">",";) ", $cjmsg);
	$cjmsg = str_replace("<img src=\"e/mad.gif\">",":x ", $cjmsg);
	$cjmsg = str_replace("<img src=\"e/cry.gif\">",":cry ", $cjmsg);
	$cjmsg = str_replace("<img src=\"e/rolleyes.gif\">",":blink ", $cjmsg);
	$cjmsg = str_replace("<img src=\"e/suprised.gif\">",":o ", $cjmsg);
	$cjmsg = str_replace("<img src=\"e/question.gif\">",":? ", $cjmsg);
	$cjmsg = str_replace("<img src=\"e/confused.gif\">",":s ", $cjmsg);
	$cjmsg = str_replace("<img src=\"e/cool.gif\">","B) ", $cjmsg);
	$cjmsg = str_replace("<img src=\"e/redface.gif\">",":red ", $cjmsg);
	return $cjmsg;
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
function smileyfiyer($cjmsg){
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
	return $cjmsg;
}
function showBanned(){
	print "<font size=\"3\"><b>IP cím kibannolása</b></font><p>";
	global $ipbanfile;
	if($_POST['submit'] == "submit"){
		$ban = $_POST['banned'];
		if (is_writable($ipbanfile)){
		    $fp = @fopen($ipbanfile, 'w');
			if($fp){
				fwrite($fp,$ban);
				print "<li>Adatok frissítve a következõ fájlban: \"$ipbanfile\"<p>";
			}
			else{
				print "<li>A $ipbanfile fájl nem létezik, kérlek ellenõrizd az elérési utat: {$ipbanfile}!<p>";
			}
		}
		else{
			print "<li>A $ipbanfile fájl nem írható, kérlek adj CHMOD 777 írási jogosultságot a fájlraa<p>";
		}
		fclose($fp);
	}					
?>
<font size="2">Kibannolt IP címek (címek soronként)</font>
<form action="<? echo $PHP_SELF; ?>?action=ipban" method="post">
<input type=hidden name=submit value=submit>
<textarea cols="20" rows="20" name="banned">
<? include $ipbanfile; ?>
</textarea><br>
<input type="submit" value="Mentés">
</form>
<?
}
function logout(){
  session_destroy();
?>
			   <font size="3"><b>Kilépés sikeres</b></font>
				<br>
				<br>
				<li><A HREF="admin_index.php">Belépés</A>
				<li><a href="javascript:self.close()">Ablak bezárás</a>   
<? 
}
function about(){
?>

			   <font size="3"><b>CJ Tag Board V3.0 névjegy</b></font>
				<br>
				<br>
				The CJ Tag Board V3.0 was created by CJ Website Design.  The script is released under the GPL License.<br>
				The author of the script is <A HREF="mailto:webmaster@cj-design.com">James Crooke</A><br><br>
				Support CJ Website Design by visiting <A HREF="http://www.cj-design.com/?id=donate">this link</A>.<br><br>
				<b>Enjoy the CJ Tag Board V3.0!</b>
   
<? 
}
?>
