<!DOCTYPE html>
<html>

  <head>

    <meta charset="UTF-8">

    <title>הסידור השבועי שלי </title>
	
 <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>   
 <link rel="stylesheet" href="css/style_sch_guy.css" 
 <link rel="stylesheet" href="css/normalize.css">
<link rel="stylesheet" href="css/style.css">
		 
	 
		 
		 
		 
		 
  </head> 
  <form method="post">
  <body>

   <?php
	include('menu.php');
  
  session_start();
  $emda= $_SESSION["global_gpid"];
$id=$_SESSION["global_id"];

  echo'<center><h1><u> הסידור השבועי שלי</u></h1></center>';

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
	 
					$guardpost=array();
					$sql1="SELECT guardpost_id, guardpost_name FROM GuardPost";
					$res1=mysqli_query($conn,$sql1);
					while( $r1=mysqli_fetch_array($res1)){
						$guardpost[$r1[0]]=$r1[1];
						};

				
	
						

					$sql2="SELECT assignedat_start, assignedat_end, assignedat_date, assignedat_day, gpid
					FROM AssignedAt	
					WHERE user_id=$id order by assignedat_date ASC;";
					$res2=mysqli_query($conn,$sql2);
		
					$i=0;
					while( $r2=mysqli_fetch_array($res2)){
					
					$postEmda=$guardpost[$r2[4]];
					echo "<center><table border=1 cellspacing=0 cellpading=0 >  
					<tr> <td>$r2[0]-$r2[1]  ,  $r2[2]  ,$postEmda ,$r2[3]  </td></tr> 
										
					</table></center>"; 

					$i=$i+1;
					}
				
				echo "<center><h3>השיבוץ השבועי בעמדת השמירה שלך - $postEmda </h3></center>" ;
				
				
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
						
						$sql3="select shift_start,shift_end from Shift where shift_day='$bigday[day]' and gpid=".$_SESSION["global_gpid"]." order by shift_start ASC;";
						 
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
							 echo '<br/> ';
									 
					

							echo ' <table dir=rtl align="center" border="1">';
							
							$week=array(
									1  => "ראשון",
									2  => "שני",
									3  => "שלישי",
									4  => "רביעי",
									5  => "חמישי",
									6  => "שישי",
									7  => "שבת",
							)	;
							echo '<tr><td>ראשון</td><td >שני</td><td >שלישי</td><td >רביעי</td><td >חמישי</td><td >שישי</td><td>שבת</td></tr>';
							echo '<tr>';
							
						
							$i=0;
							$j=0;
						foreach ($week as $day){
							
							echo '<td><table dir=rtl align="center">';
							$sql3="select shift_start,shift_end from Shift where shift_day='$day' and gpid=".$_SESSION["global_gpid"]." order by shift_start ASC;";
							$res=mysqli_query($conn,$sql3);
							
							
							
							$sql5="SELECT assignedat_start, assignedat_end, assignedat_date, assignedat_day, gpid,user_id
							FROM AssignedAt	
							WHERE assignedat_day='$day' and gpid=".$_SESSION["global_gpid"]." order by assignedat_start ASC;";
							$res6=mysqli_query($conn,$sql5);
							
							while( $r1=mysqli_fetch_array($res) and $r3=mysqli_fetch_array($res6)){

								$sql8 = "select * from ApprovedUser where (ApprovedUser.id = ".$r3[5].");";
								$result=mysqli_query($conn,$sql8);
								$row = $result->fetch_assoc();
							
							 
								if($r1[0]==$r3[0] and $r1[1]==$r3[1])
									echo '<tr><td>'.$r1[0].'-'.$r1[1].'-'.$row['Fname'].' '.$row['Lname']. '</td></tr>'; 
								$i=$i+1;}
								echo '</table></td>';
								$j=$j+5;
								$i=$j;
							}

							echo '</tr></table>';
							
 echo '<br/> ';
  echo '<br/> ';


					

					
					?>

 
  

 </body>
  
   </form>
      
 
  </html>