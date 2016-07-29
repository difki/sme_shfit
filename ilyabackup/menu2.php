
<!DOCTYPE html>
<!-- Website template by freewebsitetemplates.com -->
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Ilya</title>
	<link rel="stylesheet" href="css/style.css" type="text/css" charset="utf-8" />	
	<!--[if lte IE 7]>
		<link rel="stylesheet" href="css/ie.css" type="text/css" charset="utf-8" />	
	<![endif]-->
</head>

<body>

<style>

</style>
<center>

<img src="images/logo.jpg" alt="LOGO" align="middle" width="5%" height="6%" /></a>
</center>
<form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">

<button type="submit" class="button button-block" name="kill"/>KILL</button>
<?php

session_start();
echo "<h1>POT ".$_SESSION["global_name"]."</h1>";

	if(isset($_POST['kill'])){
     echo "pin";
	 session_destroy();
	 
}	 
?>
</form>
</body>
</html>

