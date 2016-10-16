<?php
	define("TITLE", "Home | Franklin's Fine Dining");
	
	include('menui.php');
	
?>


<?php

if ($_SESSION['login']!=TRUE){
	include('login.php');	
	}

?>




