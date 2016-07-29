<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Log-in</title> 
        <link rel="stylesheet" href="css/style.css" 
  </head>

  <body>

    <div class="login-card">
    <h1>עדכון משתמשים</h1><br>
	<tr>
	<form method="post">
	<select name="Approve">
	<option value="default">Choose worker</option>
					<?php
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
					$sql = "select * from ApprovedUser ORDER BY Fname;";
					$x=mysqli_query($conn,$sql);
					while($row = mysqli_fetch_array($x))
					{
						echo '<option value="'.$row['id'].'">'.$row['Fname'].' '.$row['Lname'].'</option>';
					}
					
					?>
					</select>
					</tr>
					<br>
					<input type="submit" name="choose" class="login login-submit" value="בחר">
					
					<?php
					
					
					$servername = "localhost";
					$username = "proj";
					$password = "proj";
					$dbname = "bitahon";
					$conn = new mysqli($servername, $username, $password, $dbname);
					$conn->query("SET character_set_client=utf8");
					$conn->query("SET character_set_connection=utf8");
					$conn->query("SET character_set_database=utf8");
					$conn->query("SET character_set_results=utf8");
					$conn->query("SET character_set_server=utf8");
					
					if (isset($_POST["choose"]))
					
					{
						$id=$_POST["Approve"];
						$sql = "select * from ApprovedUser where (ApprovedUser.id = ".$id.");";
						$result=mysqli_query($conn,$sql);
						$row = $result->fetch_assoc();
						echo '<center>';
						echo "שם פרטי";
						echo '<input type="text" name="Fname" value="'.$row['Lname'].'">';
						echo "שם משפחה";
						echo '<input type="text" name="Lname" value="'.$row['Lname'].'">';
						echo "תעודת זהות";
						echo '<input type="text" name="id" value="'.$row['id'].'">';
						echo "דואר אלקטרוני";
						echo '<input type="text" name="mail" value="'.$row['mail'].'">';
						echo "טלפון";
						echo '<input type="text" name="telephone1" value="'.$row['telephone1'].'">';
						echo "טלפון למקרה חירום";
						echo '<input type="text" name="telephone2" value="'.$row['telephone2'].'">';
						echo "כתובת";
						echo '<input type="text" name="address" value="'.$row['address'].'">';
						echo "תפקיד";
						echo "<br>";
						echo '<select name="role">';
						echo '<option value="'.$row['role'].'">'.$row['role'].'</option>';
						$sql3 = "select role_name from Role;";
						$x1=mysqli_query($conn,$sql3);
						while($row3 = mysqli_fetch_array($x1))
						{
							echo '<option value="'.$row3['role_name'].'">'.$row3['role_name'].'</option>';
						}
						echo '</select>';
						echo "<br>";
						echo "<br>";
						echo "מזהה עמדה";
						echo "<br>";
						echo '<select name="gpid">';
						echo '<option value="'.$row['gpid'].'">'.$row['gpid'].'</option>';
						$sql4 = "select guardpost_id from GuardPost;";
						$x2=mysqli_query($conn,$sql4);
						while($row4 = mysqli_fetch_array($x2))
						{
							echo '<option value="'.$row4['guardpost_id'].'">'.$row4['guardpost_id'].'</option>';
						}
						echo '</select>';
						echo "<br>";
						echo "<br>";
					}
					
					if (isset($_POST["update"]))
					{
		
						  
					   			
						
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
				 
		    if (!preg_match_all('$\S*(?=\S{2,})$', $Fname)){
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
				 
				 if (!preg_match_all('$\S*(?=\S{2,})$', $Lname)){
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
				 if (!preg_match_all('$\S*(?=\S{7,})$', $telephone1)){  //min 7 digits
                      $flag_telephone1=1;
                    }		 
				
				
			   //check טלפון למקרי חירום
			    $flag_telephone2=0;
				$telephone2 = $_POST["telephone2"];
				$telephone2 =preg_replace("/[^0-9]/","",$telephone2 );
			     if (!ctype_digit($telephone2)) {
                         $flag_telephone2=1;
                         }
				 if (!preg_match_all('$\S*(?=\S{7,})$', $telephone2)){  //min 7 digits
                       $flag_telephone2=1;
                    }
				
				//check password 
				$flag_password=0;
				$candidate= $_POST["pass1"];
                 if (!preg_match_all('$\S*(?=\S{6,})$', $candidate)){
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
					     	$sql1 = "UPDATE ApprovedUser SET id=".$_POST['id'].",Fname='".$_POST['Fname']."',Lname='".$_POST['Lname']."',telephone1='".$_POST['telephone1']."',telephone2='".$_POST['telephone2']."',mail='".$_POST['mail']."',address='".$_POST['address']."',role='".$_POST['role']."',gpid='".$_POST['gpid']."' where (ApprovedUser.id = ".$id.");";
					     	$result1 = mysqli_query($conn,$sql1);
					     	header("Location:updateApproved.php");    
						}
				  
				   
					
					
					}
					
					if (isset($_POST["delete"]))
					{
						$id=$_POST['id'];
						$sql2 = "DELETE from ApprovedUser where (ApprovedUser.id = ".$id.");";
						$result2=mysqli_query($conn,$sql2);
						header("Location:updateApproved.php");
					}
					?>
					
    <input type="submit" name="update" class="login login-submit" value="עדכן">
	<input type="submit" name="delete" class="login login-submit" value="מחק">
  </form>
    
  </div>


    
    
    
    
  </body>
</html>
