<!DOCTYPE html>
<html >


  <body>
  <?php

	
	include('menu.php');
	include('pagebase.php');

	if($_SESSION["global_role"]=='סייר'||$_SESSION["global_role"]=='אחראי עמדה'||$_SESSION["global_role"]=='מוקדן')
		header("Location:myschedule.php");
	
?>

<center>

      <?php
  session_start();
  echo "<h1>שלום ".$_SESSION["global_name"]."</h1>";


  
  ?>
</center>
   
  </body>
</html>
