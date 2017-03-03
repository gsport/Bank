<?php 
session_start();
include ('dbc.php'); 

if (!isset($_GET['usr']) && !isset($_GET['code']) )
{
$msg = "HIBA: Rossz kód...";
exit();
}

$rsCode = mysql_query("SELECT activation_code from users where user_email='$_GET[usr]'") or die(mysql_error());

list($acode) = mysql_fetch_array($rsCode);

if ($_GET['code'] == $acode)
{
mysql_query("update users set user_activated=1 where user_email='$_GET[usr]'") or die(mysql_error());
echo "E-mail sikeresen aktiválva <a href=\"login.php\">Bejelentkezés</a>";
} else
{ echo "HIBA: Az aktiváló kód nem található..."; }






?>

