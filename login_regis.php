<!DOCTYPE html>
<html >
	<head>
		<meta charset="UTF-8">
		<title>הרשמה</title> 
        <link rel="stylesheet" href="css/style_reg_guy.css" 
       
	</head>

	<body>

		<div class="login-card">
		<h1>הרשמה למערכת</h1><br>
	
		
		<?php	
		
					$try=0;

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
				
               //check Fname
               $flag_Fname=0;
			    $flag_F=0;
				$dummi=array();
				$Fname = $_POST["Fname"];
			  if (strcspn($Fname,'0123456789' ) != strlen($Fname)) { //checks if contains numberes
			       $flag_Fname=1;
				   $flag_F=1;
			     }
				 
			if (strcspn($Fname,'~;!@#$%^&*)(_-=+/*-][{{{\,:;?/><.}}}]' ) != strlen($Fname)) { //checks if contains charcteres
			       $flag_Fname=1;
			     }
				 
		    if (!preg_match_all('$\S*(?=\S{2,})$', $Fname,$dummi)){
                     $flag_Fname=1;
					  $flag_F=1;
                    }
				 
                 
                //check Lname
               $flag_Lname=0;
			   $flag_L=0;
				$Lname = $_POST["Lname"];
			  if (strcspn($Lname, '0123456789' ) != strlen($Lname)) { //checks if contains numberes
			       $flag_Lname=1;
			     }
				 
				   if (strcspn($Lname, '~;!@#$%^&*_-=+/*-\,:;?/><.'  ) != strlen($Lname)) { //checks if contains charcteres
			       $flag_Lname=1;
			     }
				 
				 if (!preg_match_all('$\S*(?=\S{2,})$', $Lname,$dummi)){
                     $flag_Lname=1;
					  $flag_L=1;
                    }
                 
				
				//check email
				 $flag_Email=0;
				$email = $_POST["mail"];
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                      $flag_Email=1;
                                 }
								 
			  //check id 
			   $flag_id=0;
				$id = $_POST["id"];
			     if (!ctype_digit($id)) {
                         $flag_id=1;
                         }
				 $len = strlen($id);
                 if ($len != 9) {
				       $flag_id=1;
					   }
					   
				//check טלפון
				 $flag_telephone1=0;
				$telephone1 = $_POST["telephone1"];
				$telephone1 =preg_replace("/[^0-9]/","",$telephone1,$try );
			     if (!ctype_digit($telephone1)) {
                         $flag_telephone1=1;
                         }
				 if (!preg_match_all('$\S*(?=\S{7,})$', $telephone1,$dummi)){  //min 7 digits
                      $flag_telephone1=1;
                    }		 
				
				
			   //check טלפון למקרי חירום
			    $flag_telephone2=0;
				$telephone2 = $_POST["telephone2"];
				$telephone2 =preg_replace("/[^0-9]/","",$telephone2 ,$try);
			     if (!ctype_digit($telephone2)) {
                         $flag_telephone2=1;
                         }
				 if (!preg_match_all('$\S*(?=\S{7,})$', $telephone2,$dummi)){  //min 7 digits
                       $flag_telephone2=1;
                    }
				
				//check password 
				$flag_password=0;
				$candidate= $_POST["pass1"];
                 if (!preg_match_all('$\S*(?=\S{6,})$', $candidate,$dummi)){
                     $flag_password=1;
                    }
				
				
				
				if ( ($_POST["pass1"] == $_POST["pass_confirm"] ) && ($flag_Lname==0) && ($flag_Fname==0) && ($flag_password==0)  && ($flag_id==0)  && ($flag_telephone1==0) &&  ($flag_telephone2==0)  && ($flag_Email==0)   && ($_POST["telephone1"] != $_POST["telephone2"] ) ) {
					// success!
					$sql = "INSERT INTO User VALUES(".$_POST['id'].",'".$_POST['Fname']."','".$_POST['Lname']."','".$_POST['telephone1']."','".$_POST['telephone2']."','".$_POST['mail']."','".$_POST['address']."','".$_POST['pass1']."');";
					$result = mysqli_query($conn,$sql);
					if (!$result)
					{
						 echo "<div style='text-align:right'><h3> <font color='red'> תעודת זהות/אימייל כבר קיים  במערכת   </font>   </h3>"; 
						
						//echo $result;
						//die(".תעודת זהות קיימת במערכת<br>".mysqli_error($conn));
					} else{
						 echo "<div style='text-align:right'><h3> <font color='green'>  ההרשמה עברה בהצלחה !  כעת חכה עד שתאושר על ידי מנהל המערכת    </font>   </h3>";
						 $msg="הרשמתך הושלמה בהצלחה כעת חכה עד שתאושר  על ידי מנהל המערכת ";
						  mail($_POST["mail"]," הרשמתך הושלמה בהצלחה",$msg);	
						//לעשות כפתור חזור
						//echo "<script>window.location = 'http://bitahon.tk/'</script>";	
					}
						
						
				}
				else {
				   // failed 
				   
				  
				   
				   
				   if ( $flag_Fname==1) {
					   
					   if( $flag_F==1){
						   
						   echo "<div style='text-align:right'><h3><font color='red'>   השם הפרטי אמור להכיל לכל הפחות 2 אותיות    </font> </h3>"; 
					   }
					else {echo "<div style='text-align:right'><h3><font color='red'>   שם פרטי מכיל תווים לא חוקיים –צריך להכיל רק אותיות  </font> </h3>";  }	   
					 
				   }
				   
				   
				   if ( $flag_Lname==1) {
					   
					    if( $flag_L==1){
						   
						   echo "<div style='text-align:right'><h3><font color='red'>  שם המשפחה אמור להכיל לפחות 2 אותיות     </font> </h3>"; 
					   }
					else{ echo "<div style='text-align:right'><h3><font color='red'>  שם משפחה מכיל תווים לא חוקיים – צריך להכיל רק אותיות  </font> </h3>"; }  
				   }
				   
				   
				    if ( $flag_id==1) {
					 echo "<div style='text-align:right'><h3> <font color='red'>  שגיאה בהזנת מספר תעודת הזהות  המספר אמור להכיל 9 ספרות </font>   </h3>";  
				   }
				   
				   
			 
				    if ( $flag_Email==1) {
					 echo "<div style='text-align:right'><h3><font color='red'>  הדואר האלקטרוני (אימייל) נכתב בתבנית שגויה </font> </h3>";  
				   }
				   
				   
				   
				   
				    if ( $flag_telephone1==1) {
					 echo "<div style='text-align:right'><h3> <font color='red'>  מספר טלפון לא חוקי – אמור להכיל רק ספרות ולהכיל לכל הפחות 7 ספרות </font>   </h3>";  
				   }
				   
				   
				    if ( $flag_telephone2==1) {
					 echo "<div style='text-align:right'><h3> <font color='red'>מספר טלפון למקרה חירום לא חוקי – אמור להכיל רק ספרות ולהכיל לכל הפחות 7 ספרות  </font>   </h3>";  
				   }
				   
				   
				   
				      if ( ($_POST["telephone1"] == $_POST["telephone2"] )  ) {
				   echo "<div style='text-align:right'><h3><font color='red'>  מספר הטלפון ומספר הטלפון לשעת חירום אמורים להיות שונים   </font></h3>";}
				   
				   
				   
				      if ( $flag_password==1) {
					 echo "<div style='text-align:right'><h3> <font color='red'> הסיסמה אמורה להכיל  לכל הפחות 6 תווים    </font>   </h3>";  
				   }
				   
				   
				 
				   
				   
				   if ( ($_POST["pass1"] != $_POST["pass_confirm"] )  ) {
				   echo "<div style='text-align:right'><h3> <font color='red'>  !שימו לב! הסיסמא אינה זהה  </font></h3>";}
				}

			// GO TO MAIN
			//echo "<script>window.location = 'http://bitahon.tk/'</script>";
			}
		?>
		
     
		<center>
          <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
           
        
			שם פרטי
			
              <input type="text"required autocomplete="off"  style="text-align:right;" name="Fname" value="<?php echo $_POST['Fname'];?>"/>
           
			שם משפחה

              <input type="text" required autocomplete="off"  style="text-align:right;"  name="Lname" value="<?php echo $_POST['Lname'];?>"/>
		
			תעודת זהות
              <input type="text"required autocomplete="off" style="text-align:right;"  name="id" value="<?php echo $_POST['id'];?>"/>
            
			דואר אלקטרוני
              <input type="text" required autocomplete="off" name="mail" value="<?php echo $_POST['mail'];?>"/>
        
			טלפון
              <input type="text" required autocomplete="off" style="text-align:right;"  name="telephone1" value="<?php echo $_POST['telephone1'];?>"/>
            
			טלפון למקרה חירום
              <input type="text"required autocomplete="off" style="text-align:right;"  name="telephone2" value="<?php echo $_POST['telephone2'];?>"/>  
			
			כתובת
            <input type="text"required autocomplete="off" style="text-align:right;"  name="address" value="<?php echo $_POST['address'];?>"/>

			סיסמא
              <input type="password" required autocomplete="off" style="text-align:right;"  name="pass1" value="<?php echo $_POST['pass1'];?>"/>
            
			אימות סיסמא
              <input type="password" required autocomplete="off" style="text-align:right;"  name="pass_confirm" value="<?php echo $_POST['pass_confirm'];?>"/>
                        
			<button type="submit" class="login login-submit" name="submit"/>הרשמה</button>
		  
          
        </form>

    </div>
      
	<?php
		// Closing the connection
		mysqli_close($conn);
	?>

	</div>
    

	</body>
</html>
