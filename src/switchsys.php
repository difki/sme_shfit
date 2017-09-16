  <?php
	include('menu.php');
	include('strings.php');
?>
<?php 

session_start();
$emda= $_SESSION["global_gpid"];
$id=$_SESSION["global_id"];
?>

<center><h1><u> מערכת החלפות</u></h1>


<center>
<a href='take.php'  ><img src="take.png" height="142" width="242"></a>   <a href='give.php' ><img src="give.png" height="142" width="242"></a><br>
</center>

