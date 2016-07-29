<!DOCTYPE html>

<html >
<head>
<html >


    <meta charset="UTF-8">
    <title>תכנית עבודה שבועית</title>
    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/tab.css" type='text/css'>
</head>



    <body>
	<?php 
		include('menu.php'); 
		include('strings.php');
		include('pagebase.php');
		session_start();
		?>
	  
<!--<center>-->

  <h1><u>עריכת משמרות</u></h1>



  <form method="post">

  <?php 

					$conn = new mysqli($sql_servername, $sql_username, $sql_password, $sql_dbname);
					$conn->query("SET character_set_client=utf8");
					$conn->query("SET character_set_connection=utf8");
					$conn->query("SET character_set_database=utf8");
					$conn->query("SET character_set_results=utf8");
					$conn->query("SET character_set_server=utf8");
					if($_SESSION["global_role"]!='סייר'&& $_SESSION["global_role"]!='אחראי עמדה')
					{
		               echo '<select  name="gpid">';
						$sql4 = "select guardpost_id,guardpost_name from GuardPost;";
						$x2=mysqli_query($conn,$sql4);
						while($row4 = mysqli_fetch_array($x2))
						{
							echo '<option value="'.$row4['guardpost_id'].'">'.$row4['guardpost_name'].'</option>';
						}
						echo '</select><br/><br/>';
						echo '<button type="submit" class="login login-submit" name="submit2"/>בחר</button>';
					}
					else
						$emda=$_SESSION["global_gpid"];
						if (isset($_POST["submit2"]))
							{
								$emda=$_POST['gpid'];
							}
							$sql3="select shift_start,shift_end from Shift where shift_day='ראשון' and gpid=".$emda." order by ord ASC;";
							$res=mysqli_query($conn,$sql3);
							$sund1=array(0,0,0,0,0);
							$sund2=array(0,0,0,0,0);
							$i=-1;
							while($row6=mysqli_fetch_array($res))
							{
								$sund1[$i+1]=$row6[0];
								$sund2[$i+1]=$row6[1];
							 $i=$i+1;
							}
							$am_sund=$i+1;
							$sql3="select shift_start,shift_end from Shift where shift_day='שני' and gpid=".$emda." order by ord ASC;";
							$res=mysqli_query($conn,$sql3);
							$mond1=array(0,0,0,0,0);
							$mond2=array(0,0,0,0,0);
							$i=-1;
							while($row6=mysqli_fetch_array($res))
							{
								$mond1[$i+1]=$row6[0];
								$mond2[$i+1]=$row6[1];
							 $i=$i+1;
							}
							$am_mond=$i+1;
							$sql3="select shift_start,shift_end from Shift where shift_day='שלישי' and gpid=".$emda." order by ord ASC;";
							$res=mysqli_query($conn,$sql3);
							$tues1=array(0,0,0,0,0);
							$tues2=array(0,0,0,0,0);
							$i=-1;
							while($row6=mysqli_fetch_array($res))
							{
								$tues1[$i+1]=$row6[0];
								$tues2[$i+1]=$row6[1];
							 $i=$i+1;
							}
							$am_tues=$i+1;
							$sql3="select shift_start,shift_end from Shift where shift_day='רביעי' and gpid=".$emda." order by ord ASC;";
							$res=mysqli_query($conn,$sql3);
							$wede1=array(0,0,0,0,0);
							$wede2=array(0,0,0,0,0);
							$i=-1;
							while($row6=mysqli_fetch_array($res))
							{
								$wede1[$i+1]=$row6[0];
								$wede2[$i+1]=$row6[1];
							 $i=$i+1;
							}
							$am_wede=$i+1;
							$sql3="select shift_start,shift_end from Shift where shift_day='חמישי' and gpid=".$emda." order by ord ASC;";
							$res=mysqli_query($conn,$sql3);
							$thur1=array(0,0,0,0,0);
							$thur2=array(0,0,0,0,0);
							$i=-1;
							while($row6=mysqli_fetch_array($res))
							{
								$thur1[$i+1]=$row6[0];
								$thur2[$i+1]=$row6[1];
							 $i=$i+1;
							}
							$am_thur=$i+1;
							$sql3="select shift_start,shift_end from Shift where shift_day='שישי' and gpid=".$emda." order by ord ASC;";
							$res=mysqli_query($conn,$sql3);
							$frid1=array(0,0,0,0,0);
							$frid2=array(0,0,0,0,0);
							$i=-1;
							while($row6=mysqli_fetch_array($res))
							{
								$frid1[$i+1]=$row6[0];
								$frid2[$i+1]=$row6[1];
							 $i=$i+1;
							}
							$am_frid=$i+1;
							$sql3="select shift_start,shift_end from Shift where shift_day='שבת' and gpid=".$emda." order by ord ASC;";
							$res=mysqli_query($conn,$sql3);
							$saut1=array(0,0,0,0,0);
							$saut2=array(0,0,0,0,0);
							$i=-1;
							while($row6=mysqli_fetch_array($res))
							{
								$saut1[$i+1]=$row6[0];
								$saut2[$i+1]=$row6[1];
							 $i=$i+1;
							}
							$am_saut=$i+1;
							 echo ' <br/>';
							$next_week = strtotime('next Sunday');
							$date_monday = date("d-m-Y", strtotime('monday', $next_week));
							$date_tuesday = date("d-m-Y", strtotime('tuesday', $next_week));
							$date_wednesday = date("d-m-Y", strtotime('wednesday', $next_week));
							$date_thursday = date("d-m-Y", strtotime('thursday', $next_week));
							$date_friday = date("d-m-Y", strtotime('friday', $next_week));
							$date_saturday = date("d-m-Y", strtotime('saturday', $next_week));
							$date_sunday = date("d-m-Y", strtotime('sunday', $next_week));
							$sql4="select guardpost_name from GuardPost where guardpost_id=".$emda.";";
							$res2=mysqli_query($conn,$sql4);
							while($row6=mysqli_fetch_array($res2))
								$emname=$row6[0];
							 echo 'הנך בונה את תוכנית העבודה השבועית לעמדת :'.$emname;
							 echo ' <br/><table class="tftable" align="center"  border="0" cellspacing="0" cellpadding="0">';
							 echo '<tr><th colspan="2" align="center">ראשון '.$date_sunday.'</th><th colspan="2" align="center">שני '.$date_monday.'</th><th colspan="2" align="center">שלישי '.$date_tuesday.'</th><th colspan="2" align="center">רביעי '.$date_wednesday.'</th></tr>';
							 echo '<tr><td colspan="2" align="center"><input type="number" min="0" max="5" STEP="1" VALUE='.$am_sund.'  style="text-align:right;" name="su"></td><td colspan="2" align="center"><input type="number" min="0" max="5" STEP="1" VALUE='.$am_mond.'  style="text-align:right;" name="mo"></td><td colspan="2" align="center"><input type="number" min="0" max="5" STEP="1" VALUE='.$am_tues.'  style="text-align:right;" name="tu"></td><td colspan="2" align="center"><input type="number" min="0" max="5" STEP="1" VALUE='.$am_wede.'  style="text-align:right;" name="we"></td></tr>';
							 echo '<tr><td>שעת סיום</td><td>שעת התחלה</td><td>שעת סיום</td><td>שעת התחלה</td><td>שעת סיום</td><td>שעת התחלה</td><td>שעת סיום</td><td>שעת התחלה</td>';
							 echo '<tr><td><input type="time" name="11" value='.$sund2[0].' /></td><td><input type="time" name="12" value='.$sund1[0].' /></td><td><input type="time" name="21" value='.$mond2[0].' /></td><td><input type="time" name="22" value='.$mond1[0].' /></td><td><input type="time" name="31" value='.$tues2[0].' /></td><td><input type="time" name="32" value='.$tues1[0].' /></td><td><input type="time" name="41" value='.$wede2[0].' /></td><td><input type="time" name="42" value='.$wede1[0].' /></td></tr>';
							 echo '<tr><td><input type="time" name="13" value='.$sund2[1].' /></td><td><input type="time" name="14" value='.$sund1[1].' /></td><td><input type="time" name="23" value='.$mond2[1].' /></td><td><input type="time" name="24" value='.$mond1[1].' /></td><td><input type="time" name="33" value='.$tues2[1].' /></td><td><input type="time" name="34" value='.$tues2[1].' /></td><td><input type="time" name="43" value='.$wede2[1].' /></td><td><input type="time" name="44" value='.$wede1[1].' /></td></tr>';
							 echo '<tr><td><input type="time" name="15" value='.$sund2[2].' /></td><td><input type="time" name="16" value='.$sund1[2].' /></td><td><input type="time" name="25" value='.$mond2[2].' /></td><td><input type="time" name="26" value='.$mond1[2].' /></td><td><input type="time" name="35" value='.$tues2[2].' /></td><td><input type="time" name="36" value='.$tues2[2].' /></td><td><input type="time" name="45" value='.$wede2[2].' /></td><td><input type="time" name="46" value='.$wede1[2].' /></td></tr>';
							 echo '<tr><td><input type="time" name="17" value='.$sund2[3].' /></td><td><input type="time" name="18" value='.$sund1[3].' /></td><td><input type="time" name="27" value='.$mond2[3].' /></td><td><input type="time" name="28" value='.$mond1[3].' /></td><td><input type="time" name="37" value='.$tues2[3].' /></td><td><input type="time" name="38" value='.$tues2[3].' /></td><td><input type="time" name="47" value='.$wede2[3].' /></td><td><input type="time" name="48" value='.$wede1[3].' /></td></tr>';
							 echo '<tr><td><input type="time" name="19" value='.$sund2[4].' /></td><td><input type="time" name="20" value='.$sund1[4].' /></td><td><input type="time" name="29" value='.$mond2[4].' /></td><td><input type="time" name="30" value='.$mond1[4].' /></td><td><input type="time" name="39" value='.$tues2[4].' /></td><td><input type="time" name="40" value='.$tues2[4].' /></td><td><input type="time" name="49" value='.$wede2[4].' /></td><td><input type="time" name="50" value='.$wede1[4].' /></td></tr>';
							 echo '</table>';
							 echo '<table class="tftable" align="center"  border="0" cellspacing="0" cellpadding="0">';
							 echo '<tr><th colspan="2" align="center">חמישי '.$date_thursday.'</th><th colspan="2" align="center">שישי '.$date_friday.'</th><th colspan="2" align="center">שבת '.$date_saturday.'</th></tr>';
							 echo '<td colspan="2" align="center"><input type="number" min="0" max="5" STEP="1" VALUE='.$am_thur.'  style="text-align:right;" name="th"></td><td colspan="2" align="center"><input type="number" min="0" max="5" STEP="1" VALUE='.$am_frid.'  style="text-align:right;" name="fr"></td><td colspan="2" align="center"><input type="number" min="0" max="5" STEP="1" VALUE='.$am_saut.'  style="text-align:right;" name="sa"></td></tr>';
							 echo '<td>שעת סיום</td><td>שעת התחלה</td><td>שעת סיום</td><td>שעת התחלה</td><td>שעת סיום</td><td>שעת התחלה</td></tr> ';
							 echo '<tr><td><input type="time" name="51" value='.$thur2[0].' /></td><td><input type="time" name="52" value='.$thur1[0].' /></td><td><input type="time" name="61" value='.$frid2[0].' /></td><td><input type="time" name="62" value='.$frid1[0].' /></td><td><input type="time" name="71" value='.$saut2[0].' /></td><td><input type="time" name="72" value='.$saut1[0].' /></td></tr>';
							 echo '<tr><td><input type="time" name="53" value='.$thur2[1].' /></td><td><input type="time" name="54" value='.$thur1[1].' /></td><td><input type="time" name="63" value='.$frid2[1].' /></td><td><input type="time" name="64" value='.$frid1[1].' /></td><td><input type="time" name="73" value='.$saut2[1].' /></td><td><input type="time" name="74" value='.$saut1[1].' /></td></tr>';
							 echo '<tr><td><input type="time" name="55" value='.$thur2[2].' /></td><td><input type="time" name="56" value='.$thur1[2].' /></td><td><input type="time" name="65" value='.$frid2[2].' /></td><td><input type="time" name="66" value='.$frid1[2].' /></td><td><input type="time" name="75" value='.$saut2[2].' /></td><td><input type="time" name="76" value='.$saut1[2].' /></td></tr>';
							 echo '<tr><td><input type="time" name="57" value='.$thur2[3].' /></td><td><input type="time" name="58" value='.$thur1[3].' /></td><td><input type="time" name="67" value='.$frid2[3].' /></td><td><input type="time" name="68" value='.$frid1[3].' /></td><td><input type="time" name="77" value='.$saut2[3].' /></td><td><input type="time" name="78" value='.$saut1[3].' /></td></tr>';
							 echo '<tr><td><input type="time" name="59" value='.$thur2[4].' /></td><td><input type="time" name="60" value='.$thur1[4].' /></td><td><input type="time" name="69" value='.$frid2[4].' /></td><td><input type="time" name="70" value='.$frid1[4].' /></td><td><input type="time" name="79" value='.$saut2[4].' /></td><td><input type="time" name="80" value='.$saut1[4].' /></td></tr>';
							 echo '<tr><td colspan="6" align="center"><button type="submit" class="login login-submit" name="submit"/>שלח</button></td>';
	 if (isset($_POST["submit"]))
		{
			// להוסיף בדיקה האם התאריכים של שבוע הבא כבר קיימים במסד
			$next_week = strtotime('next Sunday');
			$date_monday = date("Y-m-d", strtotime('monday', $next_week));
			$date_tuesday = date("Y-m-d", strtotime('tuesday', $next_week));
			$date_wednesday = date("Y-m-d", strtotime('wednesday', $next_week));
			$date_thursday = date("Y-m-d", strtotime('thursday', $next_week));
			$date_friday = date("Y-m-d", strtotime('friday', $next_week));
			$date_saturday = date("Y-m-d", strtotime('saturday', $next_week));
			$date_sunday = date("Y-m-d", strtotime('sunday', $next_week));
			$sql2="delete from Shift where gpid=".$emda.";";
			$res=mysqli_query($conn,$sql2);
			$sql2="delete from FavoriteShifts where gpid=".$emda.";";
			$res=mysqli_query($conn,$sql2);
			$sql3 ="UPDATE Fairness F join ApprovedUser A on F.user_id=A.id set F.favsupdate='0000-00-00' where where A.gpid=".$emda.";";
			$res=mysqli_query($conn,$sql3);
			$sun="ראשון";
			$x=$_POST["su"];
			for($i=11;$i<=10+2*$x;$i=$i+2)
			{
				$sql1 = "INSERT INTO Shift VALUES('".$_POST[$i+1]."','".$_POST[$i]."','".$sun."',".$emda.",".$i.");";
							$result1 = mysqli_query($conn,$sql1);
			}
			$mon="שני";
			$x=$_POST["mo"];
			echo $x;
			for($i=21;$i<=20+2*$x;$i=$i+2)
			{
				$sql1 = "INSERT INTO Shift VALUES('".$_POST[$i+1]."','".$_POST[$i]."','".$mon."',".$emda.",".$i.");";
							$result1 = mysqli_query($conn,$sql1);
			}
			$tus="שלישי";
			$x=$_POST["tu"];
			for($i=31;$i<=30+2*$x;$i=$i+2)
			{
				$sql1 = "INSERT INTO Shift VALUES('".$_POST[$i+1]."','".$_POST[$i]."','".$tus."',".$emda.",".$i.");";
							$result1 = mysqli_query($conn,$sql1);		
			}
			$wed="רביעי";
			$x=$_POST["we"];
			for($i=41;$i<=40+2*$x;$i=$i+2)
			{
				$sql1 = "INSERT INTO Shift VALUES('".$_POST[$i+1]."','".$_POST[$i]."','".$wed."',".$emda.",".$i.");";
							$result1 = mysqli_query($conn,$sql1);
			}
			$thu="חמישי";
			$x=$_POST["th"];
			for($i=51;$i<=50+2*$x;$i=$i+2)
			{
				$sql1 = "INSERT INTO Shift VALUES('".$_POST[$i+1]."','".$_POST[$i]."','".$thu."',".$emda.",".$i.");";
							$result1 = mysqli_query($conn,$sql1);		
			}
			$fri="שישי";
			$x=$_POST["fr"];
			for($i=61;$i<=60+2*$x;$i=$i+2)
			{
				$sql1 = "INSERT INTO Shift VALUES('".$_POST[$i+1]."','".$_POST[$i]."','".$fri."',".$emda.",".$i.");";
							$result1 = mysqli_query($conn,$sql1);		
			}
			$sau="שבת";
			$x=$_POST["sa"];
			for($i=71;$i<=70+2*$x;$i=$i+2)
			{
				$sql1 = "INSERT INTO Shift VALUES('".$_POST[$i+1]."','".$_POST[$i]."','".$sau."',".$emda.",".$i.");";
							$result1 = mysqli_query($conn,$sql1);
		
			}
			
			header( "assign.php" );
		}
		
  ?>

  </form>

<!--</center>-->
</div>;
 <div id="down" align="center" style="position:relative;width:100%;top:430px;left:0%"><img width="100%" src="bot2.png"></div>;
</body>

</html>



