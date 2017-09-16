<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Registration</title>
    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
    
    <link rel="stylesheet" href="css/normalize.css">

    
        <link rel="stylesheet" href="css/style_registration.css">
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

        <script src="js/index.js"></script>
    
    
    
  </head>

  <body>
	
		<?php	
			include('menu.php');
			include('strings.php');
			include('pagebase.php');
		

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
		 //echo "<script>window.location = 'http://bitahon.tk/'</script>";

		if ($_POST["pass1"] == $_POST["pass_confirm"]) {
			// success!
			
			$sql = "INSERT INTO User VALUES(".$_POST['id'].",'".$_POST['Fname']."','".$_POST['Lname']."','".$_POST['telephone1']."','".$_POST['telephone2']."','".$_POST['mail']."','".$_POST['address']."','".$_POST['pass1']."');";
			$result = mysqli_query($conn,$sql);
			if (!$result)
			{
				echo $result;
				echo $sql;
				die(".תעודת זהות קיימת במערכת<br>".mysqli_error($conn));
				//echo "<script>window.location = 'http://http://bitahon.tk/registration.php'</script>";	
			}
				//לעשות כפתור חזור
			
			echo "<script>window.location = 'http://bitahon.tk/'</script>";
		
		}
		else {
		   // failed 
		   echo "<h3 color=#332233> !שימו לב! הסיסמא אינה זהה</h3>";
		}

		// GO TO MAIN
		//echo "<script>window.location = 'http://bitahon.tk/'</script>";
		}
	?>
     
    <div class="login-card">
    <center>
          <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
           
        <div class="top-row">
			<div class="field-wrap">
			:שם פרטי
              <label> <span class="req"></span>
              </label>
              <input type="text"required autocomplete="off" name="Fname" value="myfname"/>
            </div>
          
		  
         
            <div class="field-wrap"> 
			:שם משפחה
              <label> <span class="req"></span> </label>
              <input type="text" required autocomplete="off" name="Lname" value="mylname"/>
            </div>
		</div>
		
		<div class="top-row">
            <div class="field-wrap">
			:תעודת זהות
              <label>
               
			   <span class="req"></span>
              </label>
              <input type="text"required autocomplete="off" name="id" value="30"/>
            </div>
           

        
            <div class="field-wrap">
			:דואר אלקטרוני
              <label>
              <span class="req"></span>
              </label>
              <input type="email" required autocomplete="off" name="mail" value="mymail@m.com"/>
            </div>
		</div>
		  
        <div class="top-row">
            <div class="field-wrap">
			:טלפון
              <label>
               <span class="req"></span>
              </label>
              <input type="text" required autocomplete="off" name="telephone1" value="myph1"/>
            </div>
        
            <div class="field-wrap">
			:טלפון למקרה חירום
              <label>
                 <span class="req"></span>
              </label>
              <input type="text"required autocomplete="off" value="myph2"/>
            </div>
        </div> 
            
			<div class="field-wrap">
			:כתובת
            <label>
               <span class="req"></span>
            </label>
            <input type="text"required autocomplete="off" name="address" value="myadd"/>
			</div>     
		
		<div class="top-row">
            <div class="field-wrap">
			:סיסמא
              <label>
                 <span class="req"></span>
              </label>
              <input type="password" required autocomplete="off" name="pass1" />
            </div>
                 
          
            <div class="field-wrap">
			:אימות סיסמא
              <label>
                <span class="req"></span>
              </label>
              <input type="password" required autocomplete="off" name="pass_confirm";/>
            </div>
        </div>

            
            
        <button type="submit" class="button button-block" name="submit"/>הרשמה</button>
		  
          
        </form>

    </div>
        
       
        
    </div><!-- tab-content -->
      
</div> <!-- /form -->

<?php 
			include('bottom.php');

?>
 </body>
</html>

