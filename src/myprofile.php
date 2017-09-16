<!DOCTYPE html>
<html>

  <head>

    <meta charset="UTF-8">

    <title>פרופיל משתמש</title>
	
			

    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>

    
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
		 


  </head>
  <body >

   <?php
	include('menu.php');
	include('pagebase.php');
	
  
  session_start();
  $emda= $_SESSION["global_gpid"];

  echo'<center><h1><u> פרופיל אישי</u></h1></center>';
  

  echo '<form method="post">';

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
	 
	 ?>
	 
    <center>
        <div class="login-card">
<?php
	if (isset($_POST["submit"]))
	{
			$a=array();								  
					   			
						
						  //check Fname
               $flag_Fname=0;
			    $flag_F=0;
				$Fname = $_POST["Fname"];
			  if (strcspn($Fname,'0123456789' ) != strlen($Fname)) { //checks if contains numberes
			       $flag_Fname=1;
			     }
				 
			if (strcspn($Fname,'~;!@#$%^&*)(_-=+/*-][{{{\,:;?/><.}}}]' ) != strlen($Fname)) { //checks if contains charcteres
			       $flag_Fname=1;
			     }
				 
		    if (!preg_match_all('$\S*(?=\S{2,})$', $Fname,$a)){
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
				 
				 if (!preg_match_all('$\S*(?=\S{2,})$', $Lname,$a)){
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
				$telephone1 =preg_replace("/[^0-9]/","",$telephone1 );
			     if (!ctype_digit($telephone1)) {
                         $flag_telephone1=1;
                         }
				 if (!preg_match_all('$\S*(?=\S{7,})$', $telephone1,$a)){  //min 7 digits
                      $flag_telephone1=1;
                    }		 
				
				
			   //check טלפון למקרי חירום
			    $flag_telephone2=0;
				$telephone2 = $_POST["telephone2"];
				$telephone2 =preg_replace("/[^0-9]/","",$telephone2 );
			     if (!ctype_digit($telephone2)) {
                         $flag_telephone2=1;
                         }
				 if (!preg_match_all('$\S*(?=\S{7,})$', $telephone2,$a)){  //min 7 digits
                       $flag_telephone2=1;
                    }
				
				//check password 
				$flag_password=0;
				$candidate= $_POST["pass1"];
                 if (!preg_match_all('$\S*(?=\S{6,})$', $candidate,$a)){
                     $flag_password=1;
                    }
				
				  
				   
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
				   		
					   
				  
					   
						if ( ($flag_Lname==0) && ($flag_Fname==0)   && ($flag_id==0)  && ($flag_telephone1==0) &&  ($flag_telephone2==0)  && ($flag_Email==0)   && ($_POST["telephone1"] != $_POST["telephone2"] ) ) 
						{	
				          	$id=$_POST['id'];
					     	$sql1 = "UPDATE ApprovedUser SET id=".$_POST['id'].",Fname='".$_POST['Fname']."',Lname='".$_POST['Lname']."',telephone1='".$_POST['telephone1']."',telephone2='".$_POST['telephone2']."',mail='".$_POST['mail']."',address='".$_POST['address']."' where (ApprovedUser.id = ".$id.");";
							$result1 = mysqli_query($conn,$sql1);
							$session["global_name"]=$_POST['id'];							
					     	header("Location:myprofile.php");    
						}
				  
				   
					
					
	}
					
					
					
					
			?>
		   <form method="post">
		  
					<link rel="stylesheet" href="css/um-profile.css"> 
			
					<?php

						$id=$_POST["Approve"];
						$sql = "select * from ApprovedUser where (ApprovedUser.id = ".$_SESSION["global_id"].");";
						$result=mysqli_query($conn,$sql);
						$row = $result->fetch_assoc();
						$sql = "select guardpost_name from GuardPost where (guardpost_id = ".$_SESSION["global_gpid"].");";
						$result2=mysqli_query($conn,$sql);
						$row2 = $result2->fetch_assoc();
						echo '<center>';
						echo "שם פרטי";
						echo '<input type="text" name="Fname"  style="text-align:right;" value="'.$row['Fname'].'"readonly>';
						echo "<br>";
						echo "שם משפחה";
						echo '<input type="text" name="Lname" style="text-align:right;" value="'.$row['Lname'].'"readonly>';
						echo "<br>";
						echo "תעודת זהות";
						echo '<input type="text" name="id" style="text-align:right;" value="'.$row['id'].'"readonly>';
						echo "<br>";
						echo "דואר אלקטרוני";
						echo '<input type="text" name="mail" style="text-align:right;" value="'.$row['mail'].'">';
						echo "<br>";
						echo "טלפון";
						echo '<input type="text" name="telephone1" style="text-align:right;" value="'.$row['telephone1'].'">';
						echo "<br>";
						echo "טלפון למקרה חירום";
						echo '<input type="text" name="telephone2" style="text-align:right;" value="'.$row['telephone2'].'">';
						echo "<br>";
						echo "כתובת";
						echo '<input type="text" name="address" style="text-align:right;" value="'.$row['address'].'">';
						echo "<br>";
						echo "תפקיד:  ";
						echo $row['role'];
						echo "<br>";
						echo "<br>";
						echo "עמדה:   ";
						echo $row2['guardpost_name'];
						echo "<br>";
						echo "<br>";
						echo '<button type="submit" class="login login-submit" name="submit"/>עדכן פרטים</button>';
					?>

 
  


  
   </form>
   </div>   
   </div>
   <div id="down" align="center" style="position:relative;width:100%;top:150px;left:0%"><img src="bot.png"></div>
  </body>
  </html>