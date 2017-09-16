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
    <h1>אישור משתמשים</h1><br>
	<tr>
	<form method="post">
	<center><select name="Approve">
	<option value="default">Choose worker</option>
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
					$sql = "select * from User;";
					$x=mysqli_query($conn,$sql);
					while($row = mysqli_fetch_array($x))
					{
						echo '<option value="'.$row['id'].'">'.$row['Fname'].' '.$row['Lname'].'</option>';
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
						$id=$_POST["Approve"];
						$sql = "select * from User where (User.id = ".$id.");";
						$result=mysqli_query($conn,$sql);
						$row = $result->fetch_assoc();
						$pass=$row['password'];
						echo '<center>';
						echo "שם פרטי";
						echo '<input type="text" name="Fname" value="'.$row['Fname'].'">';
						echo "שם משפחה";
						echo '<input type="text" name="Lname" value="'.$row['Lname'].'">';
						echo "תעודת זהות";
						echo '<input type="text" name="id" value="'.$row['id'].'">';
						echo "דואר אלקטרוני";
						echo '<input type="text" name="mail" value="'.$row['mail'].'">';
						echo "טלפון";
						echo '<input type="text" name="telephone1" value="'.$row['telephone1'].'">';
						echo "טלפון למקרה חירום";
						echo '<input type="text" name="telephone2" value="'.$row['telephone2'].'">';
						echo "כתובת";
						echo '<input type="text" name="address" value="'.$row['address'].'">';
						echo "תפקיד";
						echo "<br>";
						echo '<select name="role">';
						echo '<option value="default">Choose role</option>';
						$sql3 = "select role_name from Role;";
						$x1=mysqli_query($conn,$sql3);
						while($row3 = mysqli_fetch_array($x1))
						{
							echo '<option value="'.$row3['role_name'].'">'.$row3['role_name'].'</option>';
						}
						echo '</select>';
						echo "<br>";
						echo "<br>";
						echo "מזהה עמדה";
						echo "<br>";
						echo '<select name="gpid">';
						echo '<option value="default">Choose Guard Post id</option>';
						$sql4 = "select guardpost_id from GuardPost;";
						$x2=mysqli_query($conn,$sql4);
						while($row4 = mysqli_fetch_array($x2))
						{
							echo '<option value="'.$row4['guardpost_id'].'">'.$row4['guardpost_id'].'</option>';
						}
						echo '</select>';
						echo "<br>";
						echo "<br>";

					}
					
					if (isset($_POST["update"]))
					{		
							$id=$_POST['id'];
							$sql5 = "select password from User where (User.id = ".$id.");";
							$res=mysqli_query($conn,$sql5);
							$r = $res->fetch_assoc();
							echo $r['password'];
							$sql1 = "INSERT INTO ApprovedUser(id,Fname,Lname,telephone1,telephone2,mail,address,password,role,gpid) VALUES(".$_POST['id'].",'".$_POST['Fname']."','".$_POST['Lname']."','".$_POST['telephone1']."','".$_POST['telephone2']."','".$_POST['mail']."','".$_POST['address']."','".$r['password']."','".$_POST['role']."','".$_POST['gpid']."');";
							$result1 = mysqli_query($conn,$sql1);
							$sql3 = "INSERT INTO Fairness VALUES(".$_POST['id'].",0,3);";
							$result3 = mysqli_query($conn,$sql3);
							$sql2 = "DELETE from User where (User.id = ".$id.");";
							$result2=mysqli_query($conn,$sql2);
							$msg="המשתמש שלך אושר על ידי מנהל המערכת , כעת תוכל להתחבר ולהגיש את העדפותיך לקראת השיבוץ השבועי הקרוב ";
							mail($_POST["mail"]," המשתמש שלך אושר על ידי מנהל המערכת",$msg);
							header("Location:approve.php");
					}

					if (isset($_POST["delete"]))
					{		
							$id=$_POST['id'];
							$sql2 = "DELETE from User where (User.id = ".$id.");";
							$result2=mysqli_query($conn,$sql2);
							header("Location:approve.php");
					}

					?>

					
					
    <input type="submit" name="update" class="login login-submit" value="אשר הרשמה">
    <br>
    <br>
    <br>
    <input type="submit" name="delete" class="login login-submit" value="מחק רשומה">

  </form>
    
  </div>


    


  </body>
</html>
