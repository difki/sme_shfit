<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Log-in</title> 
        <link rel="stylesheet" href="css/style.css" 
  </head>

<body>
<?php
	define("TITLE", "Home | Franklin's Fine Dining");
	
	include('menu.php');
	include('pagebase.php');
	
?>


    <div class="login-card">
    <h1>ניהול עמדות</h1><br>
	<tr>
	<form method="post">
	<center><select name="gp">
	<option value="default">בחר עמדה</option>
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
					$sql = "select * from GuardPost;";
					$x=mysqli_query($conn,$sql);
					while($row = mysqli_fetch_array($x))
					{
						echo '<option value="'.$row['guardpost_id'].'">'.$row['guardpost_name'].'</option>';
					}
					
					?>
					</select></center>
					</tr>
					<br>
					<input type="submit" name="choose" class="login login-submit" value="בחר">
					
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
					
					if (isset($_POST["choose"]))
					
					{
						$gpid=$_POST["gp"];
						$sql = "select * from GuardPost where (guardpost_id = ".$gpid.");";
						$result=mysqli_query($conn,$sql);
						$row = $result->fetch_assoc();
						echo '<center>';
						echo "מזהה עמדה";
						echo '<input type="text" name="gpid" value="'.$row['guardpost_id'].'" readonly>';
						echo "שם העמדה";
						echo '<input type="text" name="name" value="'.$row['guardpost_name'].'"readonly>';
						echo "מספר תקנים";
						echo '<input type="text" name="tek" value="'.$row['guardpost_norm'].'">';
						echo "מיקום העמדה";
						echo '<input type="text" name="place" value="'.$row['guardpost_place'].'">';
						echo "<br>";

					}
					
					if (isset($_POST["update"]))
					{		
							$sql2="update GuardPost set guardpost_norm=".$_POST['tek'].",guardpost_place='".$_POST['place']."' where guardpost_id=".$_POST['gpid'].";";
							$result=mysqli_query($conn,$sql2);
							echo "<script type='text/javascript'>alert('העדכון הסתיים בהצלחה')</script>";
							header( "refresh:0;url=userGate.php" );
					}

					if (isset($_POST["delete"]))
					{		
							$gpid=$_POST['gpid'];
							$sql2 = "DELETE from GuardPost where (guardpost_id = ".$_POST['gp'].");";
							$result2=mysqli_query($conn,$sql2);
							echo "<script type='text/javascript'>alert('המחיקה הסתיימה בהצלחה')</script>";
							header( "refresh:0;url=userGate.php" );
					}

					?>

					
					
    <input type="submit" name="update" class="login login-submit" value="אשר הרשמה">
    <br>
    <br>
    <br>
    <input type="submit" name="delete" class="login login-submit" value="מחק רשומה">

  </form>
    
  </div>


    

<? include('bottom.php'); ?>
  </body>
</html>
