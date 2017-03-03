<?
include("config.php");
$fp = @fopen($datfile, 'r'); 
if($fp){  
	$array = explode("\n", fread($fp, filesize($datfile))); 
}
else{
	print "<b>$datfile Does not exist, please check the location of {$datfile}!";
}

?>
<html>
<head>
<?
if($meta_refresh == 1){
	print "<meta http-equiv=\"refresh\" content=\"$meta_refresh_rate; url=$PHP_SELF\">";
}
?>
<title>CJ Tag Board V3.0</title>
<link rel="stylesheet" href="stylesheet.php" type="text/css">
<script language = "JavaScript">
<!-- Begin
function popUp(URL) {
    day = new Date();
    id = day.getTime();
    eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=no,location=0,statusbar=0,menubar=0,resizable=0,width=400,height=150,left = 262,top = 184');");
}
// End -->
</script>
</head>
<body topmargin="0" leftmargin="0">
<?
if($print_how_many == 1){
	include("stats.txt");
}
if($printall == 1){
	?>
	<small><A HREF="all.php">Kor�bbi �zenetek</a></small><br>
	<?
}
?>
<br>
<?
if(isset($_GET['msg']))
	print $_GET['msg'];

print "<table border=\"0\" cellpadding=\"$tag_spacing\" cellspacing=\"0\" width=\"100%\">";

if($view == "desc"){
	$bgcolor = true;
	for($i=0;$i<=sizeof($array);$i++){
		$atag = $array[$i];
		if(strlen($atag) > 1){
			print "<tr>";
			if($bgcolor){
				print "<td width=\"100%\" bgcolor=\"$bgcolor1\">$atag</td>";
				$bgcolor = false;
			}
			else{
				print "<td width=\"100%\" bgcolor=\"$bgcolor2\">$atag</td>";
				$bgcolor = true;
			}
			print "</tr>";
		}
	}
}
else{
	$bgcolor = true;
	for($i=sizeof($array);$i>=0;$i--){
		$atag = $array[$i];
		if(strlen($atag) > 1){
			print "<tr>";
			if($bgcolor){
				print "<td width=\"100%\" bgcolor=\"$bgcolor1\">$atag</td>";
				$bgcolor = false;
			}
			else{
				print "<td width=\"100%\" bgcolor=\"$bgcolor2\">$atag</td>";
				$bgcolor = true;
			}
			print "</tr>";
		}
	}
}

print "</table>";

?>
</body>
</html>