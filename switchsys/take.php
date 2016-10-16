  <?php
	include('menu.php');
	include('strings.php');
?>
<?php 

session_start();
$emda= $_SESSION["global_gpid"];
$id=$_SESSION["global_id"];

$conn = new mysqli($sql_servername, $sql_username, $sql_password, $sql_dbname);
$conn->query("SET character_set_client=utf8");
$conn->query("SET character_set_connection=utf8");
$conn->query("SET character_set_database=utf8");
$conn->query("SET character_set_results=utf8");
$conn->query("SET character_set_server=utf8");



?>
<!-- 
SELECT assignedat_start, assignedat_end, assignedat_date, assignedat_day, gpid
FROM AssignedAt
WHERE status = 0 AND gpid = 1 AND user_id<>$id

 
SELECT assignedat_start, assignedat_end, assignedat_date, assignedat_day, gpid
FROM AssignedAt
WHERE user_id=$id-->