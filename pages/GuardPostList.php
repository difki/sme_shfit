<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Post Guard List</title>
    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
    
    <link rel="stylesheet" href="css/normalize.css">

    
        <link rel="stylesheet" href="css/style.css">

    
    
    
  </head>

  <body>
  <div id="contents">
  <div class="login-card">
  <center>
  <h1><u>עמדות קיימות במערכת</u></h1>
	
		<?php	
		
		$servername = "localhost";
		$username = "barifrah1_proj";
		$password = "proj1234";
		$dbname = "barifrah1_bitahon";
		
	/*	$conn->query("SET character_set_client=utf8");
		$conn->query("SET character_set_connection=utf8");
		$conn->query("SET character_set_database=utf8");
		$conn->query("SET character_set_results=utf8");
		$conn->query("SET character_set_server=utf8");*/

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 
		$sql="Select * FROM GuardPost;";
		$result = mysqli_query($conn,$sql);
		if (!$result)
		{
			die("Couldn't find .<br>".mysqli_error($conn));
		}
		else
		{
			echo '<table border="1"><tr><td>מספר במערכת</td><td>שם העמדה</td><td>מיקום</td><td>כוח אדם דרוש</td></tr>';
			while($row=mysqli_fetch_array($result))
			{
			echo '<tr><td>'.$row['guardpost_id'].'</td><td>'.$row['guardpost_name'].'</td><td>'.$row['guardpost_place'].'</td><td>'.$row['guardpost_norm'].'</td></tr>';
			}
		}

		// Closing the connection
		mysqli_close($conn);
	?>
 </div>
  </body>
</html>

