<HTML>
<HEAD>
<TITLE>�zenetk�ld� adatai</TITLE>
<link rel="stylesheet" href="stylesheet.php" type="text/css">
</HEAD>
<body topmargin="0" leftmargin="0">
<? 
include("config.php");
$date = $_GET['date'];
$time = $_GET['time'];
$name = $_GET['name'];
$ip = $_GET['ip'];
$agent = $_GET['agent'];

if($action == "report"){
	$subject = "Reported Tag";
	$message = "A visitor has reported a tag posted on the $date at $time\n\n";
	$message .= "The tag was posted by $name with the IP $ip\n\n";
	$message .= "Regards\nCJ Tag Board V3.0";
	$headers = "From: CJ Tag Board V3.0 <$email>\r\nReply-To: $email\r\n";
	$success = mail($email,$subject,$message,$headers);
	if($success){
		$report = "Az �zenet tov�bb�tva az adminnak";
	}
	else{
		$report = "Az �zenettov�bb�t�skor hiba l�pett fel";
	}
}
?>
  
  <table border="0" cellspacing="0" width="100%" cellpadding="5">
    <tr>
      <td width="100%" colspan="2" bgcolor="<? echo $bgcolor1; ?>"><font size=2><b><? echo $name; ?><b></font></td>
    </tr>
    <tr>
      <td width="1%">D�tum:</td>
      <td width="99%"><? echo $date; ?></td>
    </tr>
    <tr>
      <td width="1%">Id�:</td>
      <td width="99%"><? echo $time; ?></td>
    </tr>
    <tr>
      <td width="1%">IP:</td>
      <td width="99%"><? echo $ip; ?></td>
    </tr>
    <tr>
      <td width="1%">B�ng�sz�:</td>
      <td width="99%"><? echo $agent; ?></td>
    </tr>
  </table>
  <br>
  <?
  if(isset($report)){
  ?>
  <div align="center"><font color=red><? echo $report; ?></font></div><br>
  <?
  }
  ?>
  <div align="center"><a href="javascript:self.close()">Bez�r</a> | <A HREF="?action=report&name=<? echo $name; ?>&ip=<? echo $ip; ?>&date=<? echo $date; ?>&time=<? echo $time; ?>&agent=<? echo $agent; ?>">Jelent�s az Adminnak</A></div>
