
<!DOCTYPE html>

<html >

  <head>
    <meta charset="UTF-8">
    <title>שיבוץ ידני</title>
    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/tab.css" type="text/css">
  </head>
  <body>

	
  <?php
	include('menu.php');
	include('strings.php');
	include('pagebase.php');
	
	$conn = new mysqli($sql_servername, $sql_username, $sql_password, $sql_dbname);
	$conn->query("SET character_set_client=utf8");
	$conn->query("SET character_set_connection=utf8");
	$conn->query("SET character_set_database=utf8");
	$conn->query("SET character_set_results=utf8");
	$conn->query("SET character_set_server=utf8");
	

//  $_SESSION["global_gpid"]

  //$_SESSION["global_id"]
echo'<center><h1><u> שיבוץ ידני</u></h1>';
  session_start();
  $emda= $_SESSION["global_gpid"];
  echo '<form method="post">';

		if($_SESSION["global_role"]!='אחראי עמדה')
		{

		echo '<select name="emda4">';
		$sql4 = "select guardpost_id,guardpost_name from GuardPost;";
		$x2=mysqli_query($conn,$sql4);
		while($row4 = mysqli_fetch_array($x2))
			{
				echo '<option value="'.$row4['guardpost_id'].'">'.$row4['guardpost_name'].'</option>';
			}
		echo '</select>';
		echo '<br/><br/> <center><button type="submit" class="login login-submit" name="submit2">בחר עמדה</button></center><br/>';
		}
		if (isset($_POST["submit2"]))
		{
		$emda=$_POST['emda4'];
		$_SESSION["global_assignem"]=$_POST['emda4'];
		 $sl="select guardpost_name from GuardPost where guardpost_id=".$_SESSION["global_assignem"].";";
		 $em=mysqli_query($conn,$sl);
		  while($row5=mysqli_fetch_array($em))
		  {
			$emname=$row5[0];
		  }
		echo'<h4> הנך מבצע שיבוץ  עבור עמדת '.$emname.'  </h4></center>';
		}//end of if
		if($_SESSION["global_role"]=='אחראי עמדה')
		{
		 $sl="select guardpost_name from GuardPost where guardpost_id=".$emda.";";
		$em=mysqli_query($conn,$sl);
		while($row5=mysqli_fetch_array($em))
		  {
			$emname=$row5[0];
		  }
		
		echo'<h4> הנך מבצע שיבוץ  עבור עמדת '.$emname.'  </h4></center>';
		}//end of else
	  
	  	echo "<br>Num of requested shifts<br>";
                echo ' <table class="tftable" align="center" border="1" width="150">';
                echo "<tr><th>Name</th><th>Num</th>";
                $num_shifts_asked="select Fname, shiftasked from ApprovedUser join Fairness where Fairness.user_id=ApprovedUser.id;";
                $num_of_shift_asked=mysqli_query($conn,$num_shifts_asked);
                while ($num=mysqli_fetch_array($num_of_shift_asked)){

                        echo "<tr><td>$num[0]</td><td>$num[1]</td></tr>";
                }
                echo "</table><br><br>";
		
  if (isset($_POST["submit"]))
	{
	if($_SESSION["global_role"]!='אחראי עמדה')
	{
	$emda=$_SESSION["global_assignem"];
	}
	else
	{
		$emda=$_SESSION["global_gpid"];
	}
					$next_week = strtotime('next Sunday');
					$date_monday = date("Y-m-d", strtotime('monday', $next_week));
					$date_tuesday = date("Y-m-d", strtotime('tuesday', $next_week));
					$date_wednesday = date("Y-m-d", strtotime('wednesday', $next_week));
					$date_thursday = date("Y-m-d", strtotime('thursday', $next_week));
					$date_friday = date("Y-m-d", strtotime('friday', $next_week));
					$date_saturday = date("Y-m-d", strtotime('saturday', $next_week));
					$date_sunday = date("Y-m-d", strtotime('sunday', $next_week));
					$bigweek=array(
							array(day => "ראשון",array(0,0,0,0,0),array(0,0,0,0,0),am_day => 0,dat=>$date_sunday),
							array(day => "שני",array(0,0,0,0,0),array(0,0,0,0,0),am_day =>0,dat=>$date_monday),
							array(day => "שלישי",array(0,0,0,0,0),array(0,0,0,0,0),am_day =>0,dat=>$date_tuesday),
							array(day => "רביעי",array(0,0,0,0,0),array(0,0,0,0,0),am_day =>0,dat=>$date_wednesday),
							array(day => "חמישי",array(0,0,0,0,0),array(0,0,0,0,0),am_day =>0,dat=>$date_thursday),
							array(day => "שישי",array(0,0,0,0,0),array(0,0,0,0,0),am_day =>0,dat=>$date_friday),
							array(day => "שבת",array(0,0,0,0,0),array(0,0,0,0,0),am_day =>0,dat=>$date_saturday),	
					);
					$j=0;
					foreach ($bigweek as $bigday){
						
						$sql3="select shift_start,shift_end from Shift where shift_day='$bigday[day]' and gpid=".$emda." order by ord ASC;";
						 
						$res1=mysqli_query($conn,$sql3);
						$i=-1;
						while($row6=mysqli_fetch_array($res1))
						{
							$bigday[1][$i+1]=$row6[0];
							
							$bigday[2][$i+1]=$row6[1];
						
							$i=$i+1;
						}
						$bigday[am_day]=$i+1;
						$bigweek[$j]=$bigday;

						$j=$j+1;

					};
							 echo '<br/> <br/>';
									 
							if($_SESSION["global_role"]!='אחראי עמדה')
							{
								$emda=$_SESSION["global_assignem"];
							}
							$sqld="delete from AssignedAt where gpid=".$emda." and  assignedat_date>='".$date_sunday."' and assignedat_date<='".$date_saturday."';";
							$result2 = mysqli_query($conn,$sqld);		
							$j=0;
								foreach ($bigweek as $bigday){	
								for($i=$j;$i<$j+$bigday[am_day];$i=$i+1)
								{
									$sql1 = "INSERT INTO AssignedAt VALUES('".$bigday[1][$i-$j]."','".$bigday[2][$i-$j]."','".$bigday[dat]."','".$bigday[day]."',".$emda.",".$_POST[$i].",0);";
									$result1 = mysqli_query($conn,$sql1);	
								}
								$j=$j+5;
							}
						$sql3 ="UPDATE Fairness set shiftasked=".$_POST['num']." where user_id=".$_SESSION["global_id"].";";
											$result1 = mysqli_query($conn,$sql3);
						}

							echo ' <table class="tftable" align="center" border="1">';
							
							$week=array(
									1  => "ראשון",
									2  => "שני",
									3  => "שלישי",
									4  => "רביעי",
									5  => "חמישי",
									6  => "שישי",
									7  => "שבת",
							)	;
							echo '<tr><th>ראשון</th><th >שני</th><th >שלישי</th><th >רביעי</th><th >חמישי</th><th >שישי</th><th>שבת</th></tr>';
							echo '<tr>';
							
						
							$i=0;
							$j=0;
						foreach ($week as $day){
							echo '<td><table class="tftable" dir=rtl align="center">';
							$sql3="select shift_start,shift_end from Shift where shift_day='".$day."' and gpid=".$emda." order by ord ASC;";
							$res=mysqli_query($conn,$sql3);
							while( $r1=mysqli_fetch_array($res)){ 
							echo '<tr><td>'.$r1[0].'-'.$r1[1].'</td></tr><tr><td>';
							echo '<select name="'.$i.'">';
							$sql5="select distinct A.id,A.Fname,A.Lname,F.favshifts_rank from ApprovedUser A Join FavoriteShifts F on A.id=F.user_id where F.favshifts_start='".$r1[0]."' and F.favshifts_end='".$r1[1]."' and F.favshifts_day='".$day."' and A.gpid=".$emda." order by F.favshifts_rank desc; ";

							$res5=mysqli_query($conn,$sql5);
							$sql6="select distinct F.user_id from AssignedAt F where F.assignedat_start='".$r1[0]."' and F.assignedat_end='".$r1[1]."' and F.assignedat_day='".$day."' and F.gpid=".$emda."  and assignedat_date>='".$date_sunday."' and assignedat_date<='".$date_saturday."' ; ";
							$res6=mysqli_query($conn,$sql6);
							while( $r6=mysqli_fetch_array($res6))
								$aid=$r6[0];
							
							while( $r5=mysqli_fetch_array($res5)){
							if($r5[3]==0)
								$color="red";
							elseif($r5[3]==1)
								$color="orange";
							elseif($r5[3]==2)
								$color="yellow";
							else
								$color="green";
							
							if($r5[0]==$aid)
								echo '<option selected style="background-color:'.$color.'" value='.$r5[0].'>'.$r5[1].' '.$r5[2].' '.$r5[3].'</option>'; 
							else
								echo '<option style="background-color:'.$color.'" value='.$r5[0].'>'.$r5[1].' '.$r5[2].' '.$r5[3].'</option>';
							}// end of while
							echo '</select></td></tr>';
							$i=$i+1;
							}// end of while
							echo '</table></td>';
							$j=$j+5;
							$i=$j;
						}
							echo '</tr></table>';
							echo '<br/><br/> <center><button type="submit" class="login login-submit" name="submit">שבץ</button></center>';

  ?>
  </form>
  <?php include('bottom.php');?>
  </body>
  </html>
