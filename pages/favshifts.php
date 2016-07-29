<!DOCTYPE html>

<html >

  <head>

    <meta charset="UTF-8">

    <title>Users List</title>

    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>

    

    <link rel="stylesheet" href="css/normalize.css">



    

        <link rel="stylesheet" href="css/style.css">



    

    

    

  </head>

  <body>

  <?php
	include('menu.php');
  

//  $_SESSION["global_gpid"]

  //$_SESSION["global_id"]

  session_start();
$emda= $_SESSION["global_gpid"];


  

  echo'<center><h1><u> משמרות מועדפות</u></h1></center>';

  

  echo '<form method="post">';

  

  

					$servername = "localhost";

					$username = "barifrah1_proj";

					$password = "proj1234";

					$dbname = "barifrah1_bitahon";

					$conn = new mysqli($servername, $username, $password, $dbname);

					$conn->query("SET character_set_client=utf8");

					$conn->query("SET character_set_connection=utf8");

					$conn->query("SET character_set_database=utf8");

					$conn->query("SET character_set_results=utf8");

					$conn->query("SET character_set_server=utf8");

					

							
							
							
							
							
							
							
							
							


					

							$sql3="select shift_start,shift_end from Shift where shift_day='ראשון' and gpid=".$_SESSION["global_gpid"]." order by shift_start ASC;";

							$res1=mysqli_query($conn,$sql3);

							$sund1=array(0,0,0,0,0);

							$sund2=array(0,0,0,0,0);

							$i=-1;

							while($row6=mysqli_fetch_array($res1))

							{

			

								$sund1[$i+1]=$row6[0];
								

								$sund2[$i+1]=$row6[1];
				

							 $i=$i+1;

							}

							$am_sund=$i+1;
						

						

							

							$sql3="select shift_start,shift_end from Shift where shift_day='שני' and gpid=".$_SESSION["global_gpid"]." order by shift_start ASC;";

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
							

							

							$sql3="select shift_start,shift_end from Shift where shift_day='שלישי' and gpid=".$_SESSION["global_gpid"]." order by shift_start ASC;";

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
							

							

							$sql3="select shift_start,shift_end from Shift where shift_day='רביעי' and gpid=".$_SESSION["global_gpid"]." order by shift_start ASC;";

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
							

							

							$sql3="select shift_start,shift_end from Shift where shift_day='חמישי' and gpid=".$_SESSION["global_gpid"]." order by shift_start ASC;";

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
							
							

							$sql3="select shift_start,shift_end from Shift where shift_day='שישי' and gpid=".$_SESSION["global_gpid"]." order by shift_start ASC;";

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
						

							

							$sql3="select shift_start,shift_end from Shift where shift_day='שבת' and gpid=".$_SESSION["global_gpid"]." order by shift_start ASC;";

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
						

							 echo '<br/> <br/>';
							 
							 
							 
							 
							 
							 
							 
						if (isset($_POST["submit"]))
						{
							
										$next_week = strtotime('next Sunday');

										$date_monday = date("Y-m-d", strtotime('monday', $next_week));

										$date_tuesday = date("Y-m-d", strtotime('tuesday', $next_week));

										$date_wednesday = date("Y-m-d", strtotime('wednesday', $next_week));

										$date_thursday = date("Y-m-d", strtotime('thursday', $next_week));

										$date_friday = date("Y-m-d", strtotime('friday', $next_week));

										$date_saturday = date("Y-m-d", strtotime('saturday', $next_week));

										$date_sunday = date("Y-m-d", strtotime('sunday', $next_week));
							
							
							
							for($i=0;$i<$am_sund;$i=$i+1)

							{
								
								$sql1 = "INSERT INTO FavoriteShifts VALUES('".$sund1[$i]."','".$sund2[$i]."','ראשון',".$emda.",".$_SESSION["global_id"].",".$_POST[$i].");";


							}
							
							for($i=5;$i<5+$am_mond;$i=$i+1)

							{
								
								$sql1 = "INSERT INTO FavoriteShifts VALUES('".$mond1[$i-5]."','".$mond2[$i-5]."','שני',".$emda.",".$_SESSION["global_id"].",".$_POST[$i].");";

											$result1 = mysqli_query($conn,$sql1);


											

							}
							
							for($i=10;$i<10+$am_tues;$i=$i+1)

							{
								
								$sql1 = "INSERT INTO FavoriteShifts VALUES('".$tues1[$i-10]."','".$tues2[$i-10]."','שלישי',".$emda.",".$_SESSION["global_id"].",".$_POST[$i].");";

											$result1 = mysqli_query($conn,$sql1);


											

							}
							
							for($i=15;$i<15+$am_wede;$i=$i+1)

							{
								
								$sql1 = "INSERT INTO FavoriteShifts VALUES('".$wede1[$i-15]."','".$wede2[$i-15]."','רביעי',".$emda.",".$_SESSION["global_id"].",".$_POST[$i].");";

											$result1 = mysqli_query($conn,$sql1);


											

							}
							
							for($i=20;$i<20+$am_thur;$i=$i+1)

							{
								
								$sql1 = "INSERT INTO FavoriteShifts VALUES('".$thur1[$i-20]."','".$thur2[$i-20]."','חמישי',".$emda.",".$_SESSION["global_id"].",".$_POST[$i].");";

											$result1 = mysqli_query($conn,$sql1);


											

							}
							
							for($i=25;$i<25+$am_frid;$i=$i+1)

							{
								
								$sql1 = "INSERT INTO FavoriteShifts VALUES('".$frid1[$i-25]."','".$frid2[$i-25]."','שישי',".$emda.",".$_SESSION["global_id"].",".$_POST[$i].");";
											$result1 = mysqli_query($conn,$sql1);


											

							}
							
							for($i=30;$i<30+$am_saut;$i=$i+1)

							{
								
								$sql1 = "INSERT INTO FavoriteShifts VALUES('".$saut1[$i-30]."','".$saut2[$i-30]."','שבת',".$emda.",".$_SESSION["global_id"].",".$_POST[$i].");";

											$result1 = mysqli_query($conn,$sql1);


											

							}
							
							
							$sql3 ="UPDATE Fairness set shiftasked=".$_POST['num']." where user_id=".$_SESSION["global_id"].";";

											$result1 = mysqli_query($conn,$sql3);
							
							 
							 
						}





							echo ' <table dir=rtl align="center" border="1">';

							echo '<tr><td>ראשון</td><td >שני</td><td >שלישי</td><td >רביעי</td><td >חמישי</td><td >שישי</td><td>שבת</td></tr>';

							echo '<tr>';

							

						//sunday

							echo '<td><table dir=rtl align="center">';

							$sql3="select shift_start,shift_end from Shift where shift_day='ראשון' and gpid=".$_SESSION["global_gpid"]." order by shift_start ASC;";

							$res=mysqli_query($conn,$sql3);

							$i=0;

							while( $r1=mysqli_fetch_array($res)){ 

							echo '<tr><td>'.$r1[0].'-'.$r1[1].'</td><td><select name="'.$i.'"><option value="3">מעדיף</option><option value="2">יכול</option><option value="1">מעדיף שלא</option><option value="0">לא</option></select></td></tr>'; 

							$i=$i+1;}

							echo '</table></td>';

							

						//monday	

							echo '<td><table dir=rtl align="center">';

							$sql3="select shift_start,shift_end from Shift where shift_day='שני' and gpid=".$_SESSION["global_gpid"]." order by shift_start ASC;";

							$res=mysqli_query($conn,$sql3);

							$i=5;

							while( $r1=mysqli_fetch_array($res)){ 

							echo '<tr><td>'.$r1[0].'-'.$r1[1].'</td><td><select name="'.$i.'"><option value="3">מעדיף</option><option value="2">יכול</option><option value="1">מעדיף שלא</option><option value="0">לא</option></select></td></tr>'; 

							$i=$i+1;}

							echo '</table></td>';

							

						//tuesday

						

						echo '<td><table dir=rtl align="center">';

							$sql3="select shift_start,shift_end from Shift where shift_day='שלישי' and gpid=".$_SESSION["global_gpid"]." order by shift_start ASC;";

							$res=mysqli_query($conn,$sql3);

							$i=10;

							while( $r1=mysqli_fetch_array($res)){ 

							echo '<tr><td>'.$r1[0].'-'.$r1[1].'</td><td><select name="'.$i.'"><option value="3">מעדיף</option><option value="2">יכול</option><option value="1">מעדיף שלא</option><option value="0">לא</option></select></td></tr>'; 

							$i=$i+1;}

							echo '</table></td>';

						

						//wednesday

						

							echo '<td><table dir=rtl align="center">';

							$sql3="select shift_start,shift_end from Shift where shift_day='רביעי' and gpid=".$_SESSION["global_gpid"]." order by shift_start ASC;";

							$res=mysqli_query($conn,$sql3);

							$i=15;

							while( $r1=mysqli_fetch_array($res)){ 

							echo '<tr><td>'.$r1[0].'-'.$r1[1].'</td><td><select name="'.$i.'"><option value="3">מעדיף</option><option value="2">יכול</option><option value="1">מעדיף שלא</option><option value="0">לא</option></select></td></tr>'; 

							$i=$i+1;}

							echo '</table></td>';

							

						//thursday	

							echo '<td><table dir=rtl align="center">';

							$sql3="select shift_start,shift_end from Shift where shift_day='חמישי' and gpid=".$_SESSION["global_gpid"]." order by shift_start ASC;";

							$res=mysqli_query($conn,$sql3);

							$i=20;

							while( $r1=mysqli_fetch_array($res)){ 

							echo '<tr><td>'.$r1[0].'-'.$r1[1].'</td><td><select name="'.$i.'"><option value="3">מעדיף</option><option value="2">יכול</option><option value="1">מעדיף שלא</option><option value="0">לא</option></select></td></tr>'; 

							$i=$i+1;}

							echo '</table></td>';

							

						//friday	

							echo '<td><table dir=rtl align="center">';

							$sql3="select shift_start,shift_end from Shift where shift_day='שישי' and gpid=".$_SESSION["global_gpid"]." order by shift_start ASC;";

							$res=mysqli_query($conn,$sql3);

							$i=25;

							while( $r1=mysqli_fetch_array($res)){ 

							echo '<tr><td>'.$r1[0].'-'.$r1[1].'</td><td><select name="'.$i.'"><option value="3">מעדיף</option><option value="2">יכול</option><option value="1">מעדיף שלא</option><option value="0">לא</option></select></td></tr>'; 

							$i=$i+1;}

							echo '</table></td>';

							

						//sautrday

						

							echo '<td><table dir=rtl align="center">';

							$sql3="select shift_start,shift_end from Shift where shift_day='שבת' and gpid=".$_SESSION["global_gpid"]." order by shift_start ASC;";

							$res=mysqli_query($conn,$sql3);

							$i=30;

							while( $r1=mysqli_fetch_array($res)){ 

							echo '<tr><td>'.$r1[0].'-'.$r1[1].'</td><td><select name="'.$i.'"><option value="3">רוצה</option><option value="2">יכול</option><option value="1">מעדיף שלא</option><option value="0">לא</option></select></td></tr>'; 

							$i=$i+1;}

							echo '</table></td>';



						

							echo '</tr></table>';
							echo '<br/><center> <input type="number" min="1" max="7" STEP="1" VALUE=1 style="text-align:center;" name="num">:מספר משמרות מועדף </center>';
							echo '<br/><br/> <center><button type="submit" class="login login-submit" name="submit">הזן העדפות</button></center>'

							

  

  ?>

  </form>

  </body>

  </html>