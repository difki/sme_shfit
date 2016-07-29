<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Registration</title>
    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
    
    <link rel="stylesheet" href="css/normalize.css">

    
        <link rel="stylesheet" href="css/style.css">

    
    
    
  </head>

  <body>
	
		<?php	
		
		$servername = "localhost";
		$username = "proj";
		$password = "proj";
		$dbname = "bitahon";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 

		//$sql = "INSERT INTO User VALUES(".$_POST['id'].",'".$_POST['sname']."','".$_POST['lname']."','".$_POST['telephone1']."','".$_POST['telephone2']."','".$_POST['mail']."','".$_POST['address']."','".$_POST['pass1']."');";
		//$sql = "INSERT INTO User (id,Sname,Lname,telephone1,telephone2,mail,address,password) VALUES ('.$_POST['id'].','.$_POST['sname'].','.$_POST['lname'].','.$_POST['telephone1'].','.$_POST['telephone2'].','.$_POST['mail'].','.$_POST['address'].','.$_POST['pass1'].');";			
					
		///////$result = $conn->query($sql);
		$result = mysqli_query($conn,$sql);


		
	// In case of success
		if (isset($_POST["submit"]))
		{
		// First insert data to the Parts table
		$sql = "INSERT INTO User VALUES(".$_POST['id'].",'".$_POST['sname']."','".$_POST['lname']."','".$_POST['telephone1']."','".$_POST['telephone2']."','".$_POST['mail']."','".$_POST['address']."','".$_POST['pass1']."');";
		$result = mysqli_query($conn,$sql);
		// In case of failure
		if (!$result)
		{
			die("Couldn't add worker.<br>".mysqli_error($conn));
		}


		$result = mysqli_query($conn,$sql);
		// In case of failure
		if (!$result)
		{
			die("Couldn't add new worker.<br>".mysqli_error($conn));
		}		

		}
		
		


		/*if ($result->num_rows > 0) 
		{
		// output data of each row
						
			while($row = $result->fetch_assoc()) {

				echo "<li><a href=http://".$row["link"].">".$row["name"]."</a></li>";

				}
		}

		else {
			echo "NO permissions!";
		}
		*/
		$conn->close();
	?>
     
    <div class="login-card">
    <center>
          <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
          
		  
          <div class="top-row">
            <div class="field-wrap">
              <label> שם משפחה<span class="req">*</span> </label>
              <input type="text" required autocomplete="off" name="lname"/>
            </div>
        
		
            <div class="field-wrap">
              <label>
                שם פרטי<span class="req">*</span>
              </label>
              <input type="text"required autocomplete="off" name="sname"/>
            </div>
          </div>
		  
		  
            <div class="top-row">
            <div class="field-wrap">
              <label>
               טלפון<span class="req">*</span>
              </label>
              <input type="text" required autocomplete="off" name="telephone1"/>
            </div>
        
		
            <div class="field-wrap">
              <label>
               ת"ז<span class="req">*</span>
              </label>
              <input type="text"required autocomplete="off" name="id"/>
            </div>
          </div>  
                  
          <div class="top-row">
            <div class="field-wrap">
              <label>
               דוא"ל<span class="req">*</span>
              </label>
              <input type="email" required autocomplete="off" name="mail"/>
            </div>
        
            <div class="field-wrap">
              <label>
               טלפון למקרי חירום<span class="req">*</span>
              </label>
              <input type="text"required autocomplete="off" name="telephone2"/>
            </div>
          </div> 
            
        <div class="field-wrap">
            <label>
              כתובת מגורים<span class="req">*</span>
            </label>
            <input type="text"required autocomplete="off" name="address"/>
          </div>     
            
            
          <div class="top-row">
            <div class="field-wrap">
              <label>
               אימות סיסמה<span class="req">*</span>
              </label>
              <input type="password" required autocomplete="off" name="pass2"/>
            </div>
        
            <div class="field-wrap">
              <label>
                קבע סיסמה<span class="req">*</span>
              </label>
              <input type="password" required autocomplete="off" name="pass1"/>
            </div>
          </div> 
            
            
            
            
          <button type="submit" class="button button-block"/>הרשמה</button>
		  

          
          </form>

        </div>
        
       
        
      </div><!-- tab-content -->
      
</div> <!-- /form -->
<?php
	// Closing the connection
	mysqli_close($conn);
?>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

        <script src="js/index.js"></script>

    
    
    
  </body>
</html>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

        <script src="js/index.js"></script>

    
    
    
  </body>
</html>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

        <script src="js/index.js"></script>

    
    
    
  </body>
</html>

