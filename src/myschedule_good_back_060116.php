<!DOCTYPE html>
<html>

  <head>

    <meta charset="UTF-8">

    <title>הסידור השבועי שלי </title>
	
 <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>   
 <!--<link rel="stylesheet" href="css/style_sch_guy.css" -->
  <!--<link rel="stylesheet" href="css/normalize.css">-->
 <!--<link rel="stylesheet" href="css/style.css">-->

		<link rel="stylesheet" href="css/table.css" type='text/css'>
		<link rel="stylesheet" href="css/inner_tab.css" type='text/css'>
		 
	 <style>


</style>
		 
		 
		 
		 
  </head> 
  <form method="post">
  <body>

   <?php
	include('menu.php');
	include('func.php');
	include('strings.php');
	echo '<div align="center" id="pag" style="position:relative;width:1195px;left:275px;top:50px"';
  
  session_start();
  $emda= $_SESSION["global_gpid"];
$id=$_SESSION["global_id"];

  echo'<center><h1><u> הסידור השבועי שלי</u></h1></center>';

  echo '<form method="post">';


					$conn = new mysqli($sql_servername, $sql_username, $sql_password, $sql_dbname);
					$conn->query("SET character_set_client=utf8");
					$conn->query("SET character_set_connection=utf8");
					$conn->query("SET character_set_database=utf8");
					$conn->query("SET character_set_results=utf8");
					$conn->query("SET character_set_server=utf8");
					$next_week = strtotime('next Sunday');
					$date_saturday = date("Y-m-d", strtotime('saturday', $next_week));
					$date_sunday = date("Y-m-d", strtotime('sunday', $next_week));
	 
					$guardpost=array();
					$sql1="SELECT guardpost_id, guardpost_name FROM GuardPost";
					$res1=mysqli_query($conn,$sql1);
					while( $r1=mysqli_fetch_array($res1)){
						$guardpost[$r1[0]]=$r1[1];
						};

				
	
						

					$sql2="SELECT assignedat_start, assignedat_end, assignedat_date, assignedat_day, gpid
					FROM AssignedAt	
					WHERE user_id=$id and assignedat_date>='".$date_sunday."' and assignedat_date<='".$date_saturday."' order by assignedat_date ASC;";
					$res2=mysqli_query($conn,$sql2);
		
					$i=0;
					while( $r2=mysqli_fetch_array($res2)){
					
					$postEmda=$guardpost[$r2[4]];
					echo "<center>";
					echo '<div class="tabtry" style="height:50px; width:400px" >';
					echo "<table border=1 cellspacing=0 cellpading=0 >  
					<tr> <td>$r2[0]-$r2[1]  ,  $r2[2]  ,$postEmda ,$r2[3]  </td></tr> 
										
					</table></div></center>"; 

					$i=$i+1;
					}
				
				echo "<center><h3>השיבוץ השבועי בעמדת השמירה שלך - $postEmda </h3></center>" ;
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
								echo ' <table dir=rtl align="center" border="1">';
								echo '<tr><td>יום</td><td >משמרות</td></tr>';
								echo '<tr>';
									
								$i=0;
								$j=0;
								foreach ($week as $day){
									echo "<tr><td>$day</td>";
									echo '<td><table dir=rtl align="center">';
									$sql3="  SELECT assignedat_start,assignedat_end, au.Fname,au.Lname
									FROM AssignedAt aa INNER JOIN ApprovedUser au ON aa.user_id=au.id
									where assignedat_day='$day' and assignedat_date>='".$date_sunday."' and assignedat_date<='".$date_saturday."' and au.gpid=".$_SESSION["global_gpid"]." order by assignedat_start ASC;";
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
								
								echo '<center><div class="tabtry" >';
								echo ' <table  align="center" border="1">';
								echo '<tr><td>ראשון</td><td >שני</td><td >שלישי</td><td >רביעי</td><td >חמישי</td><td >שישי</td><td>שבת</td></tr>';
								echo '<tr>';
								$i=0;
								$j=0;
								foreach ($week as $day)
								{
									
									echo '<td>
												<div class="inner_tab">
												<table dir=rtl align="center">';
									$sql3="  SELECT assignedat_start,assignedat_end, au.Fname,au.Lname 
									FROM AssignedAt aa INNER JOIN ApprovedUser au ON aa.user_id=au.id 
									where assignedat_day='$day' and assignedat_date>='".$date_sunday."' and assignedat_date<='".$date_saturday."' and au.gpid=".$_SESSION["global_gpid"]." order by assignedat_start ASC;";
									$res=mysqli_query($conn,$sql3);
									while( $r1=mysqli_fetch_array($res))
									{ 
										echo '<tr><td>'.$r1["assignedat_start"].'-'.$r1["assignedat_end"].'</td><td>'.$r1["Fname"].' '.$r1["Lname"].'</td></tr>'; 
										$i=$i+1;
									}
									echo '</table></div></td>';
									$j=$j+5;
									$i=$j;
							
								}
								echo '</tr></table></div></center>';
							}
							
							

							
							
							
					?>
</div>
<div id="down" background-color="green" style="position:relative;width:1195px;top:100px;left:275px"><img src="bot.png"></div>
 </body>
  
 
      
 
  </html>