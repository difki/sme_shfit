
<html >
  <head>
    <meta charset="UTF-8">
    <title>ספר טלפונים</title>
		<link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/tab.css" type='text/css'>
		


  </head>
  <body>
		<?php	
		include('menu.php');
		include('strings.php');
		include('pagebase.php');
		 echo ' <center><h1 text-align="center"><u>העמדה שלי</u></h1>';

					$conn = new mysqli($sql_servername, $sql_username, $sql_password, $sql_dbname);
					
							// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 

					$conn->query("SET character_set_client=utf8");

					$conn->query("SET character_set_connection=utf8");

					$conn->query("SET character_set_database=utf8");

					$conn->query("SET character_set_results=utf8");

					$conn->query("SET character_set_server=utf8");


		$sql="Select * FROM ApprovedUser where gpid=".$_SESSION["global_gpid"].";";
		$result = mysqli_query($conn,$sql);
		$sql2="Select * FROM ApprovedUser Join GuardPost on gpid=guardpost_id where gpid=1 or role='אחראי עמדה';";
		$result2 = mysqli_query($conn,$sql2);
		if (!$result)
		{
			die("Couldn't find .<br>".mysqli_error($conn));
		}
		else
		{
			echo '<table class="tftable"  border="1" ';
			echo '<tr><th>שם</th><th>כתובת</th><th>אימייל</th><th>מספר טלפון </th><th>טלפון נוסף</th></tr>';
			while($row=mysqli_fetch_array($result))
			{
			echo '<tr ><td>'.$row['Fname'].' '.$row['Lname'].'</td><td>'.$row['address'].'</td><td>'.$row['mail'].'</td><td>'.$row['telephone1'].'</td><td>'.$row['telephone2'].'</td></tr>';
			}
			echo '	</table>';
		}
		
			echo '<br/><br/><br/>';
			echo ' <center><h1 text-align="center"><u>מספרים כלליים</u></h1>';
			echo '<table class="tftable" align="center" border=1  >';
			echo '<tr><th>שם</th><th>תפקיד</th><th>אימייל</th><th>מספר טלפון </th><th>טלפון נוסף</th></tr>';
			while($row=mysqli_fetch_array($result2))
			{
			if($row['role']=='אחראי עמדה')
				echo '<tr><td>'.$row['Fname'].' '.$row['Lname'].'</td><td>'.$row['role'].' '.$row['guardpost_name'].'</td><td>'.$row['mail'].'</td><td>'.$row['telephone1'].'</td><td>'.$row['telephone2'].'</td></tr>';
			else
				echo '<tr><td>'.$row['Fname'].' '.$row['Lname'].'</td><td>'.$row['role'].'</td><td>'.$row['mail'].'</td><td>'.$row['telephone1'].'</td><td>'.$row['telephone2'].'</td></tr>';
			}
		echo '</table>';


	?>
	
	<?php include('bottom.php'); ?>
  </body>
</html>

