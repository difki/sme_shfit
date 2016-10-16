<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>יצירת עמדה</title> 
        <link rel="stylesheet" href="css/style.css" 
  </head>

  <body>
	<?php
	include('menu.php');
	include('pagebase.php');
	?>
    <div class="login-card">
    <h1>יצירת עמדה חדשה</h1><br>
	
	
		
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
			
			// In case of success 
			if (isset($_POST["submit"]))
			{	


					$sql = "INSERT INTO GuardPost VALUES(DEFAULT,'".$_POST['Guard_name']."','".$_POST['Guard_pos']."','".$_POST['Guard_norm']."');";
					$result = mysqli_query($conn,$sql);
					echo "<script type='text/javascript'>alert('הוספת העמדה הושלמה בהצלחה')</script>";
					header( "refresh:0;url=userGate.php" );
			}


			$conn->close();
		?>
		
     
		<center>
			<form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
           
        
			שם העמדה
			
              <input type="text"required autocomplete="off" style="text-align:right;" name="Guard_name" />
           
			מיקום העמדה

              <input type="text" required autocomplete="off"  style="text-align:right;" name="Guard_pos"/>
		
			כמות תקנים לעמדה
			</br>
				<input type="number" min="0" max="100" STEP="1" VALUE="1"  style="text-align:right;" name="Guard_norm">
			</br>
			</br>
			
            <button type="submit" class="login login-submit" name="submit"/>הוסף עמדה</button>
		  
          
			</form>
		</center
    </div>


  
    <? include('bottom.php'); ?>
	</body>
</html>

