<!DOCTYPE html>

<html >

<head>
<link rel="stylesheet" href="css/style.css" >
<link rel="stylesheet" href="css/tab.css" type='text/css'>
</head>
  <body>

	<form method="post" >
  <?php
	include('menu.php');

	include('pagebase.php');
	echo '<center><h1><u> משמרות מועדפות</u></h1></center>';
	$conn = new mysqli($sql_servername, $sql_username, $sql_password, $sql_dbname);
	$conn->query("SET character_set_client=utf8");
	$conn->query("SET character_set_connection=utf8");
	$conn->query("SET character_set_database=utf8");
	$conn->query("SET character_set_results=utf8");
	$conn->query("SET character_set_server=utf8");
	$next_week = strtotime('next Sunday');
	$date_monday = date("d-m-Y", strtotime('monday', $next_week));
	$date_tuesday = date("d-m-Y", strtotime('tuesday', $next_week));
	$date_wednesday = date("d-m-Y", strtotime('wednesday', $next_week));
	$date_thursday = date("d-m-Y", strtotime('thursday', $next_week));
	$date_friday = date("d-m-Y", strtotime('friday', $next_week));
	$date_saturday = date("d-m-Y", strtotime('saturday', $next_week));
	$date_sunday = date("d-m-Y", strtotime('sunday', $next_week));
	$date_sun=date("Y-m-d", strtotime('sunday', $next_week));
	$date_sau=date("Y-m-d", strtotime('saturday', $next_week));
	$today=date("Y-m-d", strtotime('today'));
	session_start();
	$emda= $_SESSION["global_gpid"];
	$check="select count(*) from AssignedAt where gpid=".$_SESSION["global_gpid"]." and assignedat_date>='".$date_sun."' and assignedat_date<='".$date_sau."';";
	$result3 = mysqli_query($conn,$check);
	while($row5=mysqli_fetch_array($result3))
		$count=$row5[0];
	
	if($count!=0)
		{
			echo "<script type='text/javascript'>alert('.לא ניתן להזין העדפות מכיוון שהשיבוץ בעמדתך לשבוע הקרוב כבר נקבע')</script>";
			header( "refresh:0;url=userGate.php" );
		}
								

//  $_SESSION["global_gpid"]

  //$_SESSION["global_id"]



  

			
					$bigweek=array(
							array(day => "ראשון",array(0,0,0,0,0),array(0,0,0,0,0),am_day => 0),
							array(day => "שני",array(0,0,0,0,0),array(0,0,0,0,0),am_day =>0),
							array(day => "שלישי",array(0,0,0,0,0),array(0,0,0,0,0),am_day =>0),
							array(day => "רביעי",array(0,0,0,0,0),array(0,0,0,0,0),am_day =>0),
							array(day => "חמישי",array(0,0,0,0,0),array(0,0,0,0,0),am_day =>0),
							array(day => "שישי",array(0,0,0,0,0),array(0,0,0,0,0),am_day =>0),
							array(day => "שבת",array(0,0,0,0,0),array(0,0,0,0,0),am_day =>0),	
					);
					$j=0;
					foreach ($bigweek as $bigday){
						
						$sql3="select shift_start,shift_end from Shift where shift_day='".$bigday[day]."' and gpid=".$_SESSION["global_gpid"]." order by ord ASC;";
						 
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
					$sl="select guardpost_name from GuardPost where guardpost_id=".$emda.";";
					$em=mysqli_query($conn,$sl);
					while($row5=mysqli_fetch_array($em))
						{
							$emname=$row5[0];
						}
					 echo '<center><h4> הנך מגיש העדפות בעמדת '.$emname.'</h4></center>';
					 echo '<center><h4> לשיבוץ בתאריכים : '.$date_saturday.'    -    '.$date_sunday.'</h4></center>';
							
							 
							
					echo '<ul dir="rtl" style="list-style-position: inside;"><table border=0><tr><td>סייר יקר הינך עומד להגיש את העדפותיך לשיבוץ השבועי הקרוב להלן מספר הערות נא וודא ביצועם:</td></tr>';
					echo '<tr><td> <li>ניתן לבקש בין 1 ל 7 משמרות שבועיות , במידה וברצונך לא לעבוד השבוע אל תבצע הזנת העדפות אולם אין זה מבטיח שלא תשובץ השבוע.</li></td></tr>';
					echo '<tr><td><li> בתהליך הדירוג אתה נדרש לדרג כל משמרת בין 0 ל 3 כאשר 0- לא יכול , 1 - מעדיף שלא , 2 -יכול , 3 - רוצה.</li></td></tr>';
					echo '<tr><td><li> ניתן להזין שוב העדפות כדי לדרוס את ההעדפות הקודמות במידה וברצונך לשנות את החלטתך לאחר ההגשה</li></td></tr>';
					echo '<tr><td><li> שים לב שהזנת ההעדפות לשבוע הנ"ל תתאפשר כל עוד לא בוצע שיבוץ לעמדה שלך ע"י אחראי העמדה, במידה וברצונך להגיש העדפות או לשנות את החלטתך לאחר מכן, פנה לאחראי העמדה</li></td></tr></table></ul>';
						if (isset($_POST["cancel"]))
						{
							header("Location:favshifts.php");
						}
						if (isset($_POST["submit"]))
						{
							
								$sql="delete from FavoriteShifts where user_id=".$_SESSION["global_id"].";";
								$result2 = mysqli_query($conn,$sql);
											
											$j=0;
								foreach ($bigweek as $bigday)
								{							
								for($i=$j;$i<$j+$bigday[am_day];$i=$i+1)	
								{
										$sql1 = "INSERT INTO FavoriteShifts VALUES('".$bigday[1][$i-$j]."','".$bigday[2][$i-$j]."','".$bigday[day]."',".$emda.",".$_SESSION["global_id"].",".$_POST[$i].");";
										//echo $sql1;
										$result1 = mysqli_query($conn,$sql1);	
								}
									$j=$j+5;
								}
								$sql3 ="UPDATE Fairness set shiftasked=".$_POST['num']." where user_id=".$_SESSION["global_id"].";";
								//echo $sql3;
								$result1 = mysqli_query($conn,$sql3);
								$sql3 ="UPDATE Fairness set favsupdate='".$today."' where user_id=".$_SESSION["global_id"].";";
								$result1 = mysqli_query($conn,$sql3);
								echo "<script type='text/javascript'>alert('.תהליך הזנת העדפות הסתיים בהצלחה')</script>";
								header( "refresh:0;url=userGate.php" );
							
							
						}
						$week=array(
								1  => "ראשון",
								2  => "שני",
								3  => "שלישי",
								4  => "רביעי",
								5  => "חמישי",
								6  => "שישי",
								7  => "שבת",
						)	;
						
						
						//================================Mobile===========================================================
						if(isMobile()){
							echo ' <table class="tftable" dir=rtl align="center" border="1">';
							echo '<tr><th>יום</td><td >משמרות</tj></tr>';
							echo '<tr>';
							
							$i=0;
							$j=0;
							foreach ($week as $day){
								echo "<tr><td>$day</td>";
								echo '<td><table dir=rtl align="center">';
								$sql3="select shift_start,shift_end from Shift where shift_day='$day' and gpid=".$_SESSION["global_gpid"]." order by ord ASC;";
								$res=mysqli_query($conn,$sql3);
									
								while( $r1=mysqli_fetch_array($res)){
									
									echo '<td>'.$r1[0].'-'.$r1[1].'</td><td><select name="'.$i.'"><option value="3" class="red">רוצה</option><option value="2">יכול</option><option value="1">מעדיף שלא</option><option value="0">לא</option></select></td></tr>';
									$i=$i+1;}
									echo '</table></td>';
									$j=$j+5;
									$i=$j;
									echo"</tr>";
									
							}
							$sql="select shiftasked from Fairness where user_id=".$_SESSION["global_id"].";";
							$res6=mysqli_query($conn,$sql);
							while( $r6=mysqli_fetch_array($res6))
								$sha=$r6[0];
							
								echo '</tr><tr><td>:מספר משמרות מועדף</td><td colspan=6><input type="number" min="1" max="7" STEP="1" VALUE='.$sha.' style="text-align:center;" name="num"></td></tr><tr><td colspan=7><button type="submit" class="login login-submit" name="submit" >הזן העדפות</button></td></tr></table></div>';
									
						}
							
							
//================================Desktop===========================================================							
							else{
								
								$sql="select shiftasked from Fairness where user_id=".$_SESSION["global_id"].";";
								$res6=mysqli_query($conn,$sql);
							while( $r6=mysqli_fetch_array($res6))
								$sha=$r6[0];
							echo '<br/>';
							echo '<table class="tftable" style="width:30%;height:10%"><tr><td><font size="4"><b>מספר משמרות מועדף:</b></font></td><td colspan=6><input type="number" min="1" max="7" STEP="1" VALUE='.$sha.' style="text-align:center;" name="num"></td></tr></table><br/><br/>';
								
								echo ' <table class="tftable"  align="center" border="1">';
								echo '<tr><th>ראשון '.$date_sunday.'</th><th >שני '.$date_monday.'</th><th >שלישי '.$date_tuesday.'</th><th >רביעי '.$date_wednesday.'</th><th >חמישי '.$date_thursday.'</th><th >שישי '.$date_friday.'</th><th>שבת '.$date_saturday.'</th></tr>';
								echo '<tr>';
						
								$i=0;
								$j=0;
								foreach ($week as $day){
									
									echo '<td>';
									echo '<table class="tftable" align="center">';
									$sql3="select shift_start,shift_end from Shift where shift_day='$day' and gpid=".$_SESSION["global_gpid"]." order by ord ASC;";
									$res=mysqli_query($conn,$sql3);
							
									while( $r1=mysqli_fetch_array($res))
									{ 
										$sql6="select F.favshifts_rank from FavoriteShifts F where F.favshifts_start='".$r1[0]."' and F.favshifts_end='".$r1[1]."' and F.favshifts_day='".$day."' and F.gpid=".$_SESSION["global_gpid"]." and user_id=".$_SESSION["global_id"]."; ";
										//echo $sql6;
										$res6=mysqli_query($conn,$sql6);
										$aid=5;
										while( $r6=mysqli_fetch_array($res6))
											$aid=$r6[0];
										echo '<tr><td>'.$r1[0].'-'.$r1[1].'</td></tr>';
										if($aid==0)
											echo '<tr><td><select name="'.$i.'"><option value="3">רוצה</option><option value="2">יכול</option><option value="1">מעדיף שלא</option><option selected value="0">לא</option></select></td></tr>';
										elseif($aid==1)
											echo '<tr><td><select name="'.$i.'"><option value="3">רוצה</option><option value="2">יכול</option><option selected value="1">מעדיף שלא</option><option  value="0">לא</option></select></td></tr>';
										elseif($aid==2)
											echo '<tr><td><select name="'.$i.'"><option value="3">רוצה</option><option selected value="2">יכול</option><option  value="1">מעדיף שלא</option><option  value="0">לא</option></select></td></tr>';
										elseif($aid==3)
											echo '<tr><td><select name="'.$i.'"><option selected value="3">רוצה</option><option  value="2">יכול</option><option  value="1">מעדיף שלא</option><option  value="0">לא</option></select></td></tr>';
										else
											echo '<tr><td><select name="'.$i.'"><option selected value="3">רוצה</option><option value="2">יכול</option><option  value="1">מעדיף שלא</option><option  value="0">לא</option></select></td></tr>';
										$i=$i+1;
									}
									echo '</table></td>';
									$j=$j+5;
									$i=$j;
							
						}
								
							echo '</tr><tr><td colspan=7><button type="submit" class="login login-submit" name="submit" >הזן העדפות</button></td></tr></table></div>';
							
							//echo $sql;
						
						}
						//	if (isset($_POST["verify"]))
						//{
							//echo '<center><p>האם אתה בטוח שברצונך לשמור את ההעדפות החדשות?</p>';
							//echo '<center><button type="submit" class="login login-submit" name="cancel" >ביטול</button>';
							//echo " ";
							//echo '<button type="submit" class="login login-submit" name="submit" >אישור</button></center>';
							
						//}
							?>
						

  
  </form>
  <?php 
 echo '</div>';
 
  if (isMobile()){
 
  	
  
  }
  
  else {
  
  	echo' <div id="down" align="center" style="position:relative;width:100%;top:150px;left:0%"><img width="70%" src="bot2.png"></div>';
  	 	
  	
  }

  ?>
  </body>
  </html>