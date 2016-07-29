
<!DOCTYPE html>
<!-- Website template by freewebsitetemplates.com -->
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Bitahon - Technion</title>
	 <link rel="stylesheet" href="styles.css" type="text/css" charset="utf-8" />
	<!--[if lte IE 7]>
		<link rel="stylesheet" href="css/ie.css" type="text/css" charset="utf-8" />	
	<![endif]-->
</head>

<body>

<center>

<img src="images/logo.jpg" alt="LOGO" align="middle" width="5%" height="6%" /></a>
</center>

<?php

session_start();

 

echo "</form>";


					
//===============================mySQL connection================================================

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
					session_start(); // PHP session
					
//===============================Get permitions for the menu quary================================================					
					$sql = "SELECT p.permission_name, p.permission_link
					FROM ApprovedUser au  
					INNER JOIN Role r ON au.role= r.role_name
					INNER JOIN UserPermission up ON up.up_role_name = r.role_name 
					INNER JOIN Permission p ON p.permission_name=up.up_name
					WHERE au.id = ".$_SESSION["global_id"].";";  
					
			
					$result = $conn->query($sql);
					
//===============================The Menu================================================

					
//===============================PHP IF with pure HTML================================================
					if ($result->num_rows > 0) {?>	
					</center>
					<form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">

					<button type="submit" class="button button-block" name="kill"/>התנתק</button>
					
					<?php  
						// output data of each row
					echo " <h4 align=\"right\"> שלום  ".$_SESSION["global_name"]." &nbsp;&nbsp;&nbsp;</h4>";
						
					if(isset($_POST['kill'])){
							session_destroy();
							header("Location: index.php");
					}
					echo	"<div id='cssmenu'>";

					echo "<ul align=\"middle\">";
						while($row = $result->fetch_assoc()) {
							echo "<li><b><a href=".$row["permission_link"]." '>".$row["permission_name"]."</a></b></li>";
						}
					}
					
					//session_destroy();
					$conn->close();
					?>

			</ul>
		

</div>








