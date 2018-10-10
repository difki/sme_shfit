<!DOCTYPE html>
<html >

  <head>

    <meta charset="UTF-8">

    <title>הכשרות</title>

    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>

    

    <link rel="stylesheet" href="css/normalize.css">



    

        <link rel="stylesheet" href="css/tab.css" type='text/css'>

  </head>

  <body>
  <?php include('menu.php');
		include('pagebase.php');
  ?>

    <h1 align="center">הגדרת הכשרות</h1><br/>
		<?php
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
					
				
					
					
					$sql = "select * from ApprovedUser;";
					$sql2 = "select * from GuardPost;";
					$x1=mysqli_query($conn,$sql);
                    $x3=$x1;
					$x2=mysqli_query($conn,$sql2);
					$id=array();
					$j=0;
					while($row = mysqli_fetch_array($x1))
					{
						$id[$j]=$row['id'];
						$j=$j+1;
					}
					 $x2=mysqli_query($conn,$sql2);
                    $gp=array();
                    $k=0;
                    while($row = mysqli_fetch_array($x2))
					{
						$gp[$k]=$row['guardpost_id'];
						$k=$k+1;
					}
					
					if (isset($_POST["submit"]))
					{
						$m=0;
						foreach($id as $r)
						{
							foreach($gp as $p)
							{
								if($_POST[$m]=="c")
								{
									$sql="insert into TrainedAt values('".$r."','".$p."');";
									$x=mysqli_query($conn,$sql);
								}
								else
								{
									$sql="delete from TrainedAt where trainedat_id='".$r."' and gpid='".$p."';";
									$x2=mysqli_query($conn,$sql);
								}
								$m=$m+1;
							}
							
						}
					}
					$h=0;
					echo '<form method="post">';
					echo '<center><table border=1 class="tftable"><tr>';
					echo '<th></th>';
                   
                    foreach($gp as $e)
					{
						$sql="select guardpost_name from GuardPost where guardpost_id=".$e.";";
						$name=mysqli_query($conn,$sql);
						while($row = mysqli_fetch_array($name))
						echo '<th>'.$row[0].'</th>';
					}
                    echo '</tr>';
					foreach($id as $i )
					{
						$sql="select Fname,Lname from ApprovedUser where id=".$i.";";
						echo'<tr>';
						$name=mysqli_query($conn,$sql);
						while($row = mysqli_fetch_array($name))
						echo '<th>'.$row[0]." ".$row[1].'</th>';
						foreach ($gp as $p)
						{
							$sql2="select exists(select * from TrainedAt where trainedat_id='".$i."' and gpid='".$p."');";
							$x2=mysqli_query($conn,$sql2);
							while($row = mysqli_fetch_array($x2)){
								if($row[0]==1)
								
									echo '<td><input type="checkbox" name="'.$h.'" value="c" checked></td>';
								else
									echo '<td><input type="checkbox" name="'.$h.'" value="c"></td>';
							}
							$h=$h+1;
						}
         
						echo '</tr>';
					}
					echo '</table></center>';
		?>
		<br/><br/>
		<center><button  type="submit" class="login login-submit" name="submit"/>עדכן הכשרות </button></center>
		</form>
		
	<?php include('bottom.php'); ?>
	</body>
	</html>
