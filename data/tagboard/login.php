<?
if($_GET['action'] == "submit"){
	if(!isset($_POST['username']) || !isset($_POST['password'])){
		print "<font color=maroon><b>No Username or Password</b></font><p><p>";
		login();
	}
	else if($_POST['username'] == $user && $_POST['password'] == $pass){
		$username = $_POST['username']; 
		$_SESSION['username'] = $username; 

  		$password = $_POST['password']; 
		$_SESSION['password'] = $password; 

		?>

	<font size="3"><b>A bejelentkezés sikeres</b></font>     
	 <?
		echo "<p><A HREF=\"admin_index.php?";
		echo session_name();
		echo "=";
		echo session_id();
		echo "\">Kattints ide</a> a folytatáshoz...<p>";
	}
	else{
		print "<font color=maroon><b>Helytelen felhasználónév vagy jelszó</b></font><p><p>";
		login();
	}

}
else{
	print "<font color=maroon>Az adminisztrációs felület eléréséhez be kell jelentkezned</font><p><p>";
	login();
}

function login(){

?>

  <table border="0" cellpadding="5" cellspacing="0" width="100%">
    <tr>
      <td width="1%"><img border="0" src="login.jpg" width="70" height="70"></td>
      <td width="99%"><font size="3">Admin bejelentkezés</font></td>
    </tr>
  </table>
<br><form method="post" action="<? $PHP_SELF; ?>?action=submit">
<table border="0" cellpadding="5" cellspacing="0" width="100">
  <tr>
    <td><b>Username</b></td>
    <td> <input type=text name=username size="20"></td>
  </tr>
  <tr>
    <td><b>Password</b></td>
    <td> <input type=password name=password size="20"></td>
  </tr>
  <tr>
    <td colspan="2">
<center><input type=submit value='Bejelentkezés'></center>
    </td>
  </tr>

</table>

</form>
<?
}
// If you like this script then vote for it at Hotscripts or PHPResource or wherever you got it from!
// I would appreciate it if all copyright could remain to abide with the Data Protection act.
// If you would however like to remove it then a kind donation should be sent via paypal to webmaster@cj-design.com
// Please do not manipulate this code to pass it off as your own
?>