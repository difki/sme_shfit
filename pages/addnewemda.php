<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>יצירת עמדה</title> 
        <link rel="stylesheet" href="css/style.css" 
  </head>

  <body>

    <div class="login-card">
    <h1>יצירת עמדה חדשה</h1><br>
	
	
		
		<?php	
		
		
			$servername = "localhost";
			$username = "barifrah1_proj";
			$password = "proj1234";
			$dbname = "barifrah1_bitahon";

			// Create connection
			$conn = new mysqli($servername, $username, $password, $dbname);


			// Check connection
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			}
			
			$conn->query("SET character_set_client=utf8");
			$conn->query("SET character_set_connection=utf8");
			$conn->query("SET character_set_database=utf8");
			$conn->query("SET character_set_results=utf8");
			$conn->query("SET character_set_server=utf8");
			
			// In case of success 
			if (isset($_POST["submit"]))
			{	

				//if ( ($_POST["pass1"] == $_POST["pass_confirm"] ) &&  ($flag_password==0)  && ($flag_id==0)  && ($flag_telephone1==0) &&  ($flag_telephone2==0)  && ($flag_Email==0)   && ($_POST["telephone1"] != $_POST["telephone2"] ) ) {
					// success!
					$result2 = mysql_query("SHOW TABLE STATUS LIKE 'GuardPost'");
					$row2 = mysql_fetch_array($result2);
					$nextId = $row2['Auto_increment']; 
					
				//	$r=mysql_query("select max(guardpost_id) + 1 from GuardPost");
					//$r=mysql_query("SELECT LAST_INSERT_ID(`1`) + 1 FROM GuardPost");
					//int mysql_insert_id ([ resource $link_identifier = NULL ] );
					//$r=mysql_insert_id()+1;
					$r=mysql_query("SELECT max(guardpost_id) from GuardPost");
					echo $r;
					//$sql = "INSERT INTO GuardPost(`guardpost_id`, `guardpost_name`, `guardpost_place`, `guardpost_norm`) VALUES('$r',".$_POST['Guard_name'].",'".$_POST['Guard_pos']."','".$_POST['Guard_norm']."');";
					$sql = "INSERT INTO GuardPost (`guardpost_id`,`guardpost_name`, `guardpost_place`, `guardpost_norm`) VALUES(DEFAULT,'".$_POST['Guard_name']."','".$_POST['Guard_pos']."','".$_POST['Guard_norm']."');";
					$result = mysqli_query($conn,$sql);
					if (!$result)
					{
						echo $result;
						die(".שגיאה<br>".mysqli_error($conn));
					}
						//לעשות כפתור חזור
						//echo "<script>window.location = 'http://bitahon.tk/'</script>";
				//}

			}

			// GO TO MAIN
			//echo "<script>window.location = 'http://bitahon.tk/'</script>";
		///////	}
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
              <!--<input type="text"required autocomplete="off" name="Guard_norm"/>-->
			</br>
			</br>
			
            <button type="submit" class="login login-submit" name="submit"/>הוסף עמדה</button>
		  
          
			</form>
		</center
    </div>

	</div>

	<?php
		// Closing the connection
		mysqli_close($conn);
	?>
  
    
	</body>
</html>

