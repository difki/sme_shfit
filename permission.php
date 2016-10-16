<!DOCTYPE html>

<html >

  <head>

    <meta charset="UTF-8">

    <title>הרשאות</title>

    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>

    

    <link rel="stylesheet" href="css/normalize.css">



    

        <link rel="stylesheet" href="css/tab.css" type="text/css">

  </head>

  <body>
  <?php include('menu.php');
		include('pagebase.php');	
					?>
    <h1 align="center">הגדרת הרשאות</h1><br/>
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
					
				
					
					
					$sql = "select * from Role;";
					$sql2 = "select * from Permission;";
					$x1=mysqli_query($conn,$sql);
                    $x3=$x1;
					$x2=mysqli_query($conn,$sql2);
					$roles=array();
					$j=0;
					while($row = mysqli_fetch_array($x1))
					{
						$roles[$j]=$row['role_name'];
						$j=$j+1;
					}
					 $x2=mysqli_query($conn,$sql2);
                    $per=array();
                    $k=0;
                    while($row = mysqli_fetch_array($x2))
					{
						if ($row['permission_catnum']==777){
							continue;
						}
						$per[$k]=$row['permission_name'];
						$k=$k+1;
					}
					
					if (isset($_POST["submit"]))
					{
						$m=0;
						foreach($roles as $r)
						{
							foreach($per as $p)
							{
								if($_POST[$m]=="c")
								{
									$sql="insert into UserPermission values('".$p."','".$r."');";
									$x=mysqli_query($conn,$sql);
								}
								else
								{
									$sql="delete from UserPermission where up_name='".$p."' and up_role_name='".$r."';";
									$x2=mysqli_query($conn,$sql);
								}
								$m=$m+1;
							}
							
						}
						header("Location:permission.php");

					}
					$h=0;
					echo '<form method="post">';
					echo '<center><table border=1 class="tftable"><tr>';
					echo '<th></th>';
                   
                    foreach($per as $e)
					{
						
						echo '<th>'.$e.'</th>';
					}
                    echo '</tr>';
					foreach($roles as $i )
					{
						echo'<tr>';
						echo '<th>'.$i.'</th>';
						foreach ($per as $p)
						{
							$sql2="select exists(select * from UserPermission where up_name='".$p."' and up_role_name='".$i."');";
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
		<center><button  type="submit" class="login login-submit" name="submit"/>צור הרשאה </button></center>
		</form>
		
<?php
include('bottom.php');
?>
	</body>
	</html>