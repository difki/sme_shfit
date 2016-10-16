
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

<button type="submit" class="button button-block" name="kill"/>התנתק</button>
<?php

session_start();
echo "<h1>שלום ".$_SESSION["global_name"]."</h1>";

	if(isset($_POST['kill'])){
		session_destroy();
		header("refresh:0");
		
	}	 
?>
</form>
		<div id="navigation">
			<ul>
			<!-- -->
				<?php
					
				echo $_POST["id"];

					$servername = "localhost";

					$username = "barifrah1_proj";

					$password = "proj1234";

					$dbname = "barifrah1_bitahon";

					// Create connection
					$conn = new mysqli($servername, $username, $password, $dbname);
					// Check connection
					if ($conn->connect_error) {
						die("Connection failed: " . $conn->connect_error);
					} 
					$conn->query("SET character_set_client=utf8");
$conn->query("SET character_set_connection=utf8");
$conn->query("SET character_set_database=utf8");
$conn->query("SET character_set_results=utf8");
$conn->query("SET character_set_server=utf8");

					/* //old data base
					$sql = "SELECT name, link
					FROM User u INNER JOIN ApprovedUser au ON u.id = au.id
					INNER JOIN Role r ON au.role= r.rolename
					INNER JOIN UserPermission up ON up.rolename = r.rolename 
					NATURAL JOIN Permissions WHERE (u.id = ".$_POST["id"].");";
					*/
					session_start();
					 //not working
					$sql = "SELECT permission_name, permission_link
					FROM ApprovedUser au  
					INNER JOIN Role r ON au.role= r.role_name
					INNER JOIN UserPermission up ON up.up_role_name = r.role_name 
					INNER JOIN Permission p ON p.permission_name=up.up_name
					WHERE au.id = ".$_SESSION["global_id"].";";  
					
					//echo "<h1>שלום ".$_SESSION["global_name"]."</h1>";
					//WHERE (au.id = ".$_SESSION["global_id"].");";  
					
					/*$sql = "SELECT *
					FROM ApprovedUser au  
					WHERE (au.id = ".$_SESSION["global_id"].");";
					*/
					 
					
					
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
						// output data of each row
						
						while($row = $result->fetch_assoc()) {

							echo "<li><a href=".$row["permission_link"]." target='main_frame'>".$row["permission_name"]."</a></li>";
							
							}
					}
					
					//session_destroy();
					$conn->close();
					?>

			</ul>
		</div>



