<?php 
include('strings.php');


function check_page_permission() {
	
	$permision=0;
//	$conn = new mysqli($sql_servername, $sql_username, $sql_password, $sql_dbname);
	//$conn->query("SET character_set_client=utf8");
	//$conn->query("SET character_set_connection=utf8");
	//$conn->query("SET character_set_database=utf8");
	//$conn->query("SET character_set_results=utf8");
	//$conn->query("SET character_set_server=utf8");
	
	$id=$_SESSION["global_id"];

	$sql = "SELECT p.permission_link
							FROM ApprovedUser au
							INNER JOIN Role r ON au.role= r.role_name
							INNER JOIN UserPermission up ON up.up_role_name = r.role_name
							INNER JOIN Permission p ON p.permission_name=up.up_name
							WHERE au.id = ".$_SESSION["global_id"].";";
	$result=mysqli_query($conn,$sql);
	while($row = $result->fetch_assoc()) {
		if ( $row["permission_link"] == basename(__FILE__)){
			
		}
			$permission=1;
	
	}
	if ($permision==0){
		
		echo 403;
	}

}








?>