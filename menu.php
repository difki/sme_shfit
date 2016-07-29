<!doctype html>
<html lang=''>
<head>
   <meta charset='utf-8'>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="styles.css">
   <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
   <script src="script.js"></script>
   <title></title>
</head>

<body>


<!--<img src="images/logo.jpg" alt="LOGO" align="middle" width="5%" height="6%" /></a>-->


<?php
include ('strings.php');
include ('func.php');
session_start();

if (isMobile()){?>
	
	<div style="width:100%;top:0px;left:0%;" align="center" ><img width="100%" src="logobit2.png"></img></div>
<?php	
}

else {?>

<div style="width:100%;position:relative;top:0px;left:0%;" align="center" ><img width="70%" src="logobit2.png"></img></div>
	
	<?php
	
}

				
//===============================mySQ L connection================================================

				// Create connection
				$conn = new mysqli($sql_servername, $sql_username, $sql_password, $sql_dbname);
				// Check connection
				if ($conn->connect_error) {
					die("Connection failed: " . $conn->connect_error);
					} 
					$conn->query("SET character_set_client=utf8");
					$conn->query("SET character_set_connection=utf8");
					$conn->query("SET character_set_database=utf8");
					$conn->query("SET character_set_results=utf8");
					$conn->query("SET character_set_server=utf8");
					session_start();// PHP session
				
//===============================Page permisson check================================================					
	
	$permision=0;
	
	$id=$_SESSION["global_id"];
	
	if ($id==NULL) {$id=-1;}
	$sql = "SELECT p.permission_link
			FROM ApprovedUser au
			INNER JOIN Role r ON au.role= r.role_name
			INNER JOIN UserPermission up ON up.up_role_name = r.role_name
			INNER JOIN Permission p ON p.permission_name=up.up_name
			WHERE au.id = ".$id.";";
	$result=mysqli_query($conn,$sql);
	
	
	while($row = $result->fetch_assoc()) {
		
		if ( $row["permission_link"] == basename($_SERVER['REQUEST_URI'])){
			
			$permission=1;
		
		}
	}
	//special case: login screen
	if (basename($_SERVER['REQUEST_URI'])=='index.php' || basename($_SERVER['REQUEST_URI'])==NULL || basename($_SERVER['REQUEST_URI'])=='userGate.php' ){$permission=1;}
if ($permission==0){
		header("Location: userGate.php");
		}
if ($id==-1 && basename($_SERVER['REQUEST_URI'])!='index.php' ){
	header("Location: index.php");
}
	
					
//===============================The Menu================================================
	$sql="SELECT * FROM Category";
	$result = $conn->query($sql);
					
//===============================PHP IF with pure HTML================================================
	if ($_SESSION["global_name"]!=NULL) {?>	
		</center>
		<?php  
		
		
		
		if(isset($_POST['kill'])){
				
		}
		
		if (isMobile()){
			echo '<div  id="cssmenu">';
		}
		else {
			echo '<div style="width:70%;position: relative;left: 15%; z-index:1" align="center" id="cssmenu">';
		}
		
		
		echo "<ul>";
		while($row = $result->fetch_assoc() ) {	
			//echo "<li><b><a href=".$row["permission_link"]." '>".$row["permission_name"]."</a></b></li>";
			$sql = "SELECT p.permission_name, p.permission_link
			FROM ApprovedUser au
			INNER JOIN Role r ON au.role= r.role_name
			INNER JOIN UserPermission up ON up.up_role_name = r.role_name
			INNER JOIN Permission p ON p.permission_name=up.up_name
			WHERE au.id = ".$_SESSION["global_id"]." AND p.permission_catnum=".$row["category_id"]." ;";
			$inner_result=mysqli_query($conn,$sql);
			if ($inner_result!=NULL){
					$inner_result_row_num=mysqli_num_rows($inner_result);
			}
			if ($row["category_id"] == 777) {//general
					continue;    
			}
			//=========================With sub menus================================
			if ($inner_result_row_num>1){
				echo "<li><a>".$row["category_name"]."</a>";
				echo "<ul>";
				while($inner_row = $inner_result->fetch_assoc()) {
						echo "<li><a href=".$inner_row["permission_link"]." '>".$inner_row["permission_name"]."</a></li>";
				}
				echo "</ul></li>";
			}
			//=========================================================================
			if ($inner_result_row_num==1){
					while($inner_row = $inner_result->fetch_assoc()) {
							echo "<li><a href=".$inner_row["permission_link"]." '>".$inner_row["permission_name"]."</a></li>";			
					}
			}					
		}
	}
			
					//session_destroy();
					$conn->close();
					?>
			</ul>

</div>
<?php
if($_SESSION['login']==TRUE)
{
	
	if (isMobile()){
		//<a href="kill.php" style="color:#69c"><b>התנתק</b></a></font></td>';

		
	}
	else {
	echo '<div style="position:relative;left:20%;bottom:95px;width:70%"><table><tr><td ><font color="white">';
	
	echo '<td ><font color="white"><b> Hello ' .$_SESSION["global_name"].'</b></font></td></tr></table></div>';
	}
}
?>