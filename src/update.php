<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>update</title> 
        <link rel="stylesheet" href="css/style.css" 
  </head>

  <body>

    <div class="login-card">
    <h1>עדכון פרטים ומחיקה </h1><br>
	<tr>
	<select name="Approve">
	<option value="">Choose worker</option>
					<?php
		$servername = "localhost";
		$username = "barifrah1_proj";
		$password = "proj1234";
		$dbname = "barifrah1_bitahon";
					// Create connection
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
					echo "</select>";
				
					echo "</tr>";
					echo "<br>";
					echo $_POST['Approve'];
					if (isset($_POST["choose"]))
					{
						echo $_POST['Approve'];
						$id=$_POST["Approve"];
						$sql = "select * from User where (User.id = ".$id.");";
						$result=mysqli_query($conn,$sql);
						$row = $result->fetch_assoc();
						echo '<input type="text" name="id" value="'.$row['Fname'].'">';
					}
					?>
					
  <form method="post">
	<input type="submit" name="choose" class="login login-submit" value="בחר">
    
  </form>
    
</div>


    
    
    
    
  </body>
</html>
