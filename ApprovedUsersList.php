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
  <h1><u>Users List</u></h1>
	
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
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 
		$sql="Select * FROM ApprovedUser;";
		$result = mysqli_query($conn,$sql);
		if (!$result)
		{
			die("Couldn't find .<br>".mysqli_error($conn));
		}
		else
		{
			echo '<table border="1"><tr><td>Id</td><td>First Name</td><td>Last Name</td><td>Telephone</td><td>Emergency Telephone</td><td>Email</td><td>Address</td><<td>Role</td><<td>GuardPost</td></tr>';
			while($row=mysqli_fetch_array($result))
			{
			echo '<tr><td>'.$row['id'].'</td><td>'.$row['Fname'].'</td><td>'.$row['Lname'].'</td><td>'.$row['telephone1'].'</td><td>'.$row['telephone2'].'</td><td>'.$row['mail'].'</td><td>'.$row['address'].'</td><td>'.$row['role'].'</td><td>'.$row['gpid'].'</td></tr>';
			}
		}

		// Closing the connection
		mysqli_close($conn);
	?>
 
  </body>
</html>

