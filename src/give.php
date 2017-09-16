 <html>



   <head>
      <script type="text/javascript">
         <!--
         function colourFunction() {
        	 var myselect = document.getElementById("select1"),
        	 colour = myselect.options[myselect.selectedIndex].className;
        	 myselect.className = colour;
        	 myselect.blur(); //This just unselects the select list without having to click
        	 somewhere else on the page
        	 }
         //-->

      </script>

      
   </head>
<body>
 <?php
	include('menu.php');
	include('strings.php');
	include('pagebase.php');
?>
<center><h1><u>מסירת משמרת</u></h1>
<h4> בחר משמרת למסירה</h4>

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


$sql2="SELECT assignedat_start, assignedat_end, assignedat_date, assignedat_day, gpid, status
FROM AssignedAt
WHERE user_id=$id";
$res2=mysqli_query($conn,$sql2);

echo'
<center>
<form method="post">
<select name="give_shift" onchange="colourFunction()">';


$i=0;
while( $r2=mysqli_fetch_array($res2)){
	if ($r2[5]==1)
		echo "<option class='red' value='$i' >".$r2[0]." ".$r2[1]." ".$r2[2]." ".$r2[3]." ".$guardpost[$r2[4]]."</option> ";
	else 
		echo "<option class='white' value='$i' >".$r2[0]." ".$r2[1]." ".$r2[2]." ".$r2[3]." ".$guardpost[$r2[4]]."</option> ";
	$i=$i+1;
}


echo '</select>
<br><br>
<center>
		<button type="submit" class="login login-cancel" name="cancel">בטל בקשה</button>
		<button type="submit" class="login login-submit" name="submit">בקש חילוף</button>
</center>
</form>
</center>';





if (isset($_POST["submit"])){

	$sql3="SELECT assignedat_start, assignedat_end, assignedat_date, assignedat_day, gpid
	FROM AssignedAt 
	WHERE user_id=$id";
	$res3=mysqli_query($conn,$sql3);
	$i=0;
	
	while( $r3=mysqli_fetch_array($res3)){
		
		if ($i==$_POST["give_shift"]){
			
			$sql4 ="UPDATE AssignedAt SET status=1 where assignedat_start='".$r3[0]."' AND assignedat_end='".$r3[1]."' AND assignedat_date ='".$r3[2]."' AND assignedat_day= '".$r3[3]."' AND gpid= ".$r3[4].";";
			$res4=mysqli_query($conn,$sql4);

			if ($res4){

				//echo '<script type="javascript">';
				//echo 'document.write("Hello World!")';
				//echo 'window.alert("sometext1111");';
				//echo '</script>';

				
				//echo '<script language="javascript">';
// 				echo '<script type="text/javascript">';
// 				echo 'alert("message successfully sent")';
// 				echo '</script>';
				
// 				print '<script type="text/javascript">';
// 				print 'alert("The email address")';
// 				print '</script>';

				
				
				//window.alert("sometext1111");
				echo "<br><br>בקשה נקלטה";	
				echo '<script type="text/javascript">window.alert("הודעת אישור!");</script>';
				//echo "<br><br>בקשה11111111111111 נקלטה";
				header("Location: give.php");
				
				
			}

		
		}
		$i=$i+1;
	}

}


if (isset($_POST["cancel"])){

	$sql3="SELECT assignedat_start, assignedat_end, assignedat_date, assignedat_day, gpid
	FROM AssignedAt
	WHERE user_id=$id";
	$res3=mysqli_query($conn,$sql3);
	$i=0;

	while( $r3=mysqli_fetch_array($res3)){

		if ($i==$_POST["give_shift"]){

			$sql4 ="UPDATE AssignedAt SET status=0 where assignedat_start='".$r3[0]."' AND assignedat_end='".$r3[1]."' AND assignedat_date ='".$r3[2]."' AND assignedat_day= '".$r3[3]."' AND gpid= ".$r3[4].";";
			$res4=mysqli_query($conn,$sql4);
			if ($res4){
				//echo "<br><br>בקשת ביטול נקלטה";
				echo '<script type="text/javascript">window.alert("בקשת ביטול נקלטה");</script>';
				//header("Location: give.php");
			}


		}
		$i=$i+1;
	}
}


include('bottom.php');
?>
</body>
</html>