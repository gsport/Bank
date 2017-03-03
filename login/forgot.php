<?php
include 'dbc.php';
if ($_POST['Submit']=='Send')
{
$host = $_SERVER['HTTP_HOST'];
$rs_search = mysql_query("select user_email from users where user_email='$_POST[email]'");
$user_count = mysql_num_rows($rs_search);

if ($user_count != 0)
{
$newpwd = rand(1000,9999);
$host = $_SERVER['HTTP_HOST'];
$newmd5pwd = md5($newpwd);
mysql_query("UPDATE users set user_pwd='$newmd5pwd' where user_email='$_POST[email]'");
$message = 
"\n\n
Felhasználó: $_POST[email] \n
Jelszó: $newpwd \n
____________________________________________
*** BEJELENTKEZÉS ***** \n
LINK: http://$host/login.php \n\n
_____________________________________________
Ez egy autómatikus üzenet, ne válaszolj rá!

";

	mail($_POST['email'], "Új jelszó kérése", $message,
    "From: \"Auto-Response\" <robot@$host>\r\n" .
     "X-Mailer: PHP/" . phpversion());
	 
die("Az adatok elküldve.");
} else die("Az e-mail cím nem található!");

}
?>
<meta content="text/plain; charset=UTF-8" http-equiv="content-type">
<h3>Elfelejtett jelszó</h3>
<p>Kérlek írd be a regisztrált e-mail címed.</p>
<table width="50%" border="0" cellpadding="1" cellspacing="0">
  <tr>
    <td> 
      <form name="form1" method="post" action="">
        <p><br>
          <strong>E-mail:</strong> 
          <input name="email" type="text" id="email">
          <input type="submit" name="Submit">
        </p>
      </form></td>
  </tr>
</table>
<p>&nbsp;</p>

