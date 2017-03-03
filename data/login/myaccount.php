<?php
session_start();
if (!isset($_SESSION['user']))
{
 die ("Access Denied");
}
?> 

<?php if (isset($_SESSION['user'])) { ?>
<meta content="text/plain; charset=UTF-8" http-equiv="content-type">
<p>Belépve <?php echo $_SESSION['user']; ?> | <a href="settings.php">Beállítások</a> 
  | <a href="logout.php">Kilépés</a> </p>
<?php } ?>  
