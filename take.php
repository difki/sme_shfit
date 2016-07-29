 <html> 

<header>
</header>

<body>
  <?php
	include('menu.php');
	include('strings.php');
	include('pagebase.php');
?>
<center><h1><u>קבלת משמרת</u></h1>
<h4> בחר משמרת לקבלה</h4>

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

$guardpost=array();
$sql1="SELECT guardpost_id, guardpost_name FROM GuardPost";
$res1=mysqli_query($conn,$sql1);
while( $r1=mysqli_fetch_array($res1)){
	$guardpost[$r1[0]]=$r1[1];
};

$sql2="SELECT assignedat_start, assignedat_end, assignedat_date, assignedat_day, gpid
FROM AssignedAt
WHERE user_id!=$id AND status = 1";
$res2=mysqli_query($conn,$sql2);

?>
<center>
<form method="post">
<select name="my_shifts">
<?php 


$i=0;
if (!mysqli_num_rows($res2)) {
	echo "<option>  אין משמרות למסירה </option>";
}
while( $r2=mysqli_fetch_array($res2)){
	echo "<option value='$i'>".$r2[0]." ".$r2[1]." ".$r2[2]." ".$r2[3]." ".$guardpost[$r2[4]]."</option> ";
	$i=$i+1;
}


echo '</select>
<br><br>
		
<center><button type="submit" class="login login-submit" name="submit">קבל משמרת</button></center>
</form>
</center>' ;
		 
if (isset($_POST["submit"])){
	
	$problematic=0;//PH for the check function
	if ($problematic==1){
		//if (echo "<script type='text/javascript'>confirm('Are you sure you want to save this thing into the database?')</script>";)
		echo "האם אתה בטוח?";
		echo '<br><center><button type="submit" class="login login-submit" name="sure">אני בטוח</button></center>';
	}
	if (isset($_POST["sure"])){
		
		$sql3="SELECT assignedat_start, assignedat_end, assignedat_date, assignedat_day, gpid
		FROM AssignedAt
		WHERE user_id!=$id AND status = 1";
		$res3=mysqli_query($conn,$sql3);
		$i=0;
		
		while( $r3=mysqli_fetch_array($res3)){
		
			if ($i==$_POST["my_shifts"]){
					
				$sql4 ="UPDATE AssignedAt SET status=0, user_id=".$id." where assignedat_start='".$r3[0]."' AND assignedat_end='".$r3[1]."' AND assignedat_date ='".$r3[2]."' AND assignedat_day= '".$r3[3]."' AND gpid= ".$r3[4].";";
				$res4=mysqli_query($conn,$sql4);
				if ($res4){
					//window.alert("sometext1111");
					echo "<br><br>בקשה נקלטה";
					echo "<script type='text/javascript'>alert('בקשה נקלטה')</script>";
				}
		
		
			}
			$i=$i+1;
		}
		
	}
	if ($problematic==0){
	 
//============================================The actual "give" code by Tal========================================================	
	$sql3="SELECT assignedat_start, assignedat_end, assignedat_date, assignedat_day, gpid
	FROM AssignedAt 
	WHERE user_id!=$id AND status = 1";
	$res3=mysqli_query($conn,$sql3);
	$i=0;
	
	while( $r3=mysqli_fetch_array($res3)){
		
		if ($i==$_POST["my_shifts"]){
			
			$sql4 ="UPDATE AssignedAt SET status=0, user_id=".$id." where assignedat_start='".$r3[0]."' AND assignedat_end='".$r3[1]."' AND assignedat_date ='".$r3[2]."' AND assignedat_day= '".$r3[3]."' AND gpid= ".$r3[4].";";
			$res4=mysqli_query($conn,$sql4);
			if ($res4){
				//window.alert("sometext1111");
					echo "<br><br>בקשה נקלטה";
					echo "<script type='text/javascript'>alert('בקשה נקלטה')</script>";
			}

		
		}
		$i=$i+1;
	}
//=============================================================================================================================	
	}

}
	
	
	

include('bottom.php');
?>


</body>
</html>
