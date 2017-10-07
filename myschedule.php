<!DOCTYPE html>
<html>

  <head>

    <meta charset="UTF-8">

    <title>הסידור השבועי שלי </title>
	
 <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>   
 <!--<link rel="stylesheet" href="css/style_sch_guy.css" -->
  <!--<link rel="stylesheet" href="css/normalize.css">-->
 <!--<link rel="stylesheet" href="css/style.css">-->

		<link rel="stylesheet" href="css/tab.css" type='text/css'>
		<!--<link rel="stylesheet" href="css/ilya.css" type='text/css'>-->
		 
  </head> 
  <form method="post">
  <body>

   <?php
	include('menu.php');
	include('pagebase.php');
	
  
  session_start();
  $emda= $_SESSION["global_gpid"];
$id=$_SESSION["global_id"];

  echo'<center><h1><u> הסידור השבועי שלי</u></h1></center>';

  echo '<form method="post">';

 //===============================mySQ L connection================================================
					$conn = new mysqli($sql_servername, $sql_username, $sql_password, $sql_dbname);
					$conn->query("SET character_set_client=utf8");
					$conn->query("SET character_set_connection=utf8");
					$conn->query("SET character_set_database=utf8");
					$conn->query("SET character_set_results=utf8");
					$conn->query("SET character_set_server=utf8");

//======================================Dates Next Week======================================================					
					$next_week = strtotime('next Sunday');
					$date_monday = date("d-m-Y", strtotime('monday', $next_week));
					$date_tuesday = date("d-m-Y", strtotime('tuesday', $next_week));
					$date_wednesday = date("d-m-Y", strtotime('wednesday', $next_week));
					$date_thursday = date("d-m-Y", strtotime('thursday', $next_week));
					$date_friday = date("d-m-Y", strtotime('friday', $next_week));
					$date_saturday = date("d-m-Y", strtotime('saturday', $next_week));
					$date_sunday = date("d-m-Y", strtotime('sunday', $next_week));
//======================================Dates This Week ======================================================
					$today=jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("m"),date("d"), date("Y")) , 1 );
					
						if ($today=="Sunday"){
							$this_week = strtotime('Sunday');
						}
						else{
							$this_week = strtotime('last Sunday');
						}
						
					$this_date_monday = date("d-m-Y", strtotime('monday', $this_week));
					$this_date_tuesday = date("d-m-Y", strtotime('tuesday', $this_week));
					$this_date_wednesday = date("d-m-Y", strtotime('wednesday', $this_week));
					$this_date_thursday = date("d-m-Y", strtotime('thursday', $this_week));
					$this_date_friday = date("d-m-Y", strtotime('friday', $this_week));
					$this_date_saturday = date("d-m-Y", strtotime('saturday', $this_week));
					$this_date_sunday = date("d-m-Y", strtotime('sunday', $this_week));
//======================================Get guardpost======================================================	 
					$guardpost=array();
					$sql1="SELECT guardpost_id, guardpost_name FROM GuardPost";
					$res1=mysqli_query($conn,$sql1);
					while( $r1=mysqli_fetch_array($res1)){
						$guardpost[$r1[0]]=$r1[1];
						};
//======================================Get the shifts for this week======================================================
						$sql_this="SELECT assignedat_start, assignedat_end, assignedat_date, assignedat_day, gpid
					FROM AssignedAt
					WHERE user_id=".$id." and assignedat_date>='".$this_date_sunday."' and assignedat_date<='".$this_date_saturday."' order by assignedat_date ASC;";
						$rest_this=mysqli_query($conn,$sql_this);
//======================================Get the shifts for next week======================================================
					$sql2="SELECT assignedat_start, assignedat_end, assignedat_date, assignedat_day, gpid
					FROM AssignedAt	
					WHERE user_id=".$id." and assignedat_date>='".$date_sunday."' and assignedat_date<='".$date_saturday."' order by assignedat_date ASC;";
					$res2=mysqli_query($conn,$sql2);
		
					$i=0;

					while( $r2=mysqli_fetch_array($res2)){

					$postEmda=$guardpost[$r2[4]];

					echo '<table class="tftable" border=1 cellspacing=0 cellpading=0 >';  
					echo '<tr> <th>'.$r2[0].'-'.$r2[1].'  , '. $r2[2].'  ,'.$postEmda.' ,'.$r2[3].'  </th></tr> ';
										
					echo '</table>';

					$i=$i+1;
					}
				
				echo "<center><h3>השיבוץ השבועי בעמדת השמירה שלך $postEmda </h3></center>" ;
					$j=0;
						//	 echo '<br/> ';	
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
//================================This week===========================================================
								
								echo ' <table class="tftable"  align="center" border="1">';
								
								echo '<tr><th>יום</td><th>משמרות - השבוע</td></tr>';
								echo '<tr>';
									
								$i=0;
								$j=0;
								
								$this_date_saturday = date("Y-m-d", strtotime('saturday', $this_week));
								$this_date_sunday = date("Y-m-d", strtotime('sunday', $this_week));
								foreach ($week as $day){
									echo "<tr><td>$day</td>";
									echo '<td><table class="tftable" align="center" border="1">';
									$sql3="  SELECT assignedat_start,assignedat_end, au.Fname,au.Lname,S.ord
									FROM AssignedAt aa Inner JOIN Shift S INNER JOIN ApprovedUser au ON aa.user_id=au.id and S.shift_start=aa.assignedat_start and S.shift_end=aa.assignedat_end and S.shift_day=aa.assignedat_day and S.gpid=aa.gpid
									where assignedat_day='$day' and assignedat_date>='".$this_date_sunday."' and assignedat_date<='".$this_date_saturday."' and au.gpid=".$_SESSION["global_gpid"]." order by S.ord ASC;";
									$res=mysqli_query($conn,$sql3);
								
									while( $r1=mysqli_fetch_array($res)){
											
										echo '<tr><td>'.$r1["assignedat_start"].'-'.$r1["assignedat_end"].'</td><td>'.$r1["Fname"].' '.$r1["Lname"].'</td></tr>';
										$i=$i+1;}
										echo '</table></td>';
										$j=$j+5;
										$i=$j;
										echo"</tr>";
											
								}
//================================Next week===========================================================
								echo ' <table class="tftable"  align="center" border="1">';
						
								echo '<tr><th>יום</td><th >משמרות - שבוע הבא</td></tr>';
								echo '<tr>';
									
								$i=0;
								$j=0;
								
								$date_saturday = date("Y-m-d", strtotime('saturday', $next_week));
								$date_sunday = date("Y-m-d", strtotime('sunday', $next_week));
								foreach ($week as $day){
									echo "<tr><td>$day</td>";
									echo '<td><table class="tftable" align="center" border="1">';
									$sql3="  SELECT assignedat_start,assignedat_end, au.Fname,au.Lname,S.ord
									FROM AssignedAt aa Inner JOIN Shift S INNER JOIN ApprovedUser au ON aa.user_id=au.id and S.shift_start=aa.assignedat_start and S.shift_end=aa.assignedat_end and S.shift_day=aa.assignedat_day and S.gpid=aa.gpid
									where assignedat_day='$day' and assignedat_date>='".$date_sunday."' and assignedat_date<='".$date_saturday."' and au.gpid=".$_SESSION["global_gpid"]." order by S.ord ASC;";
									$res=mysqli_query($conn,$sql3);
										
									while( $r1=mysqli_fetch_array($res)){
											
										echo '<tr><td>'.$r1["assignedat_start"].'-'.$r1["assignedat_end"].'</td><td>'.$r1["Fname"].' '.$r1["Lname"].'</td></tr>';
										$i=$i+1;}
										echo '</table></td>';
										$j=$j+5;
										$i=$j;
										echo"</tr>";
											
								}
			
							}				
//================================Desktop===========================================================
							else
							{
			
//================================This week===========================================================
//================================Shifts===========================================================

								echo ' <table class="tftable"  align="center" border="1">';
								echo "<center><h3>משמרות</h3></center>";
								echo '<tr><th>ראשון '.$this_date_sunday.'</th><th >שני '.$this_date_monday.'</th><th >שלישי '.$this_date_tuesday.'</th><th >רביעי '.$this_date_wednesday.'</th><th >חמישי '.$this_date_thursday.'</th><th >שישי '.$this_date_friday.'</th><th>שבת '.$this_date_saturday.'</th></tr>';
								echo '<tr>';
								$i=0;
								$j=0;
								$this_date_saturday = date("Y-m-d", strtotime('saturday', $this_week));
								$this_date_sunday = date("Y-m-d", strtotime('sunday', $this_week));
								foreach ($week as $day)
								{
										
									echo '<td>
								
												<table class="tftable" align="center" border="1">';
									$sql3="  SELECT assignedat_start,assignedat_end, au.Fname,au.Lname,S.ord
									FROM AssignedAt aa Inner JOIN Shift S INNER JOIN ApprovedUser au ON aa.user_id=au.id and S.shift_start=aa.assignedat_start and S.shift_end=aa.assignedat_end and S.shift_day=aa.assignedat_day and S.gpid=aa.gpid
									where assignedat_day='$day' and assignedat_date>='".$this_date_sunday."' and assignedat_date<='".$this_date_saturday."' and au.gpid=".$_SESSION["global_gpid"]." order by S.ord ASC;";
									$res=mysqli_query($conn,$sql3);
									while( $r1=mysqli_fetch_array($res))
									{
										echo '<tr><td>'.$r1["assignedat_start"].'-'.$r1["assignedat_end"].'</td></tr><tr><td>'.$r1["Fname"].' '.$r1["Lname"].'</td></tr>';
										echo '<td bgcolor="#dcdac0"></td>';
										$i=$i+1;
									}
									echo '</table></div></td>';
									
									$j=$j+5;
									$i=$j;
										
								}
								echo '</tr></table><br>';
//================================Next week===========================================================          
//================================Shifts===========================================================
								echo ' <table class="tftable"  align="center" border="1">';
								echo "<center><h3>משמרות</h3></center>";
								echo '<tr><th>ראשון '.$date_sunday.'</th><th >שני '.$date_monday.'</th><th >שלישי '.$date_tuesday.'</th><th >רביעי '.$date_wednesday.'</th><th >חמישי '.$date_thursday.'</th><th >שישי '.$date_friday.'</th><th>שבת '.$date_saturday.'</th></tr>';
								echo '<tr>';
								$i=0;
								$j=0;
								$date_saturday = date("Y-m-d", strtotime('saturday', $next_week));
								$date_sunday = date("Y-m-d", strtotime('sunday', $next_week));
								foreach ($week as $day)
								{
										
									echo '<td>
								
												<table class="tftable" align="center" border="1">';
									$sql3="  SELECT assignedat_start,assignedat_end, au.Fname,au.Lname,S.ord
									FROM AssignedAt aa Inner JOIN Shift S INNER JOIN ApprovedUser au ON aa.user_id=au.id and S.shift_start=aa.assignedat_start and S.shift_end=aa.assignedat_end and S.shift_day=aa.assignedat_day and S.gpid=aa.gpid
									where assignedat_day='$day' and assignedat_date>='".$date_sunday."' and assignedat_date<='".$date_saturday."' and au.gpid=".$_SESSION["global_gpid"]." order by S.ord ASC;";
									$res=mysqli_query($conn,$sql3);
									
									while( $r1=mysqli_fetch_array($res))
									{
										echo '<tr><td>'.$r1["assignedat_start"].'-'.$r1["assignedat_end"].'</td></tr><tr><td>'.$r1["Fname"].' '.$r1["Lname"].'</td></tr>';
										echo '<td bgcolor="#dcdac0"></td>';
										$i=$i+1;
									}
									echo '</table></div></td>';
									$j=$j+5;
									$i=$j;
										
								}
								echo '</tr></table><br>';
								
							}
							$get_sme_id="SELECT id, Fname FROM `ApprovedUser` WHERE gpid=$emda ORDER BY `ApprovedUser`.`role` DESC";
							$smes = mysqli_query($conn,$get_sme_id);

							while( $id=mysqli_fetch_array($smes)){
								$count_shifts_query="select COUNT(*) from Shift S JOIN AssignedAt A on S.shift_start=A.assignedat_start and S.shift_end=A.assignedat_end and S.shift_day=A.assignedat_day and S.gpid=A.gpid JOIN ApprovedUser AP on AP.id=A.user_id where A.assignedat_date>='".$date_sunday."' and A.assignedat_date<='".$date_saturday."'  and A.gpid=".$emda." and A.user_id=".$id[0]." ;";
								$num_of_shift=mysqli_query($conn,$count_shifts_query);
								$num=mysqli_fetch_array($num_of_shift);
								echo "$id[1] - $num[0] <br>";


							
							}
							
							if($_SESSION["global_role"]=='אחראי עמדה')
							{
								if(isset($_POST["submit"]))
								{
									$sql="delete from AssignedAt where gpid=".$_SESSION['global_gpid']." and assignedat_date>='".$date_sunday."' and assignedat_date<='".$date_saturday."';";
									echo $sql;
									$res2=mysqli_query($conn,$sql);
									echo "<script type='text/javascript'>alert('.איפוס השיבוץ בוצע בהצלחה')</script>";
									header("Refresh:0");
									
								}
								echo '<form method="post"><button type="submit" class="login login-submit" name="submit"/>אפס שיבוץ</button></form><br><br>';
								
								
								
							}
							
							

							
							
			
 //include('bottom.php');

?>
 </body>
  
 
      
 
  </html>
