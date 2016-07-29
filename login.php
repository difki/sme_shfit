




   <?php include('menu.php');
	include('pagebase.php'); ?>
    <h1>התחברות למערכת</h1><br>
					<?php
					$servername = "localhost";
					$username = "barifrah1_proj";
					$password = "proj1234";
					$dbname = "barifrah1_bitahon";
					// Create connection
					$conn = new mysqli('localhost','barifrah1_proj','proj1234','barifrah1_bitahon');
					
					$conn->query("SET character_set_client=utf8");
					$conn->query("SET character_set_connection=utf8");
					$conn->query("SET character_set_database=utf8");
					$conn->query("SET character_set_results=utf8");
					$conn->query("SET character_set_server=utf8");
					if (isset($_POST["login"]))
					{
						echo "<script>window.frames['menu'].location.reload(true)</script>";
						$flag=0;
						$pass=$_POST['pass'];
						$id=$_POST['id'];
						
						  //check id 
			             $flag_id=0;
			             if (!ctype_digit($id)) {
                           $flag_id=1;
                             }
				         $len = strlen($id);
                         if ($len != 9) {
				           $flag_id=1;
					         }
							 
							 
				         if ( $flag_id==1) {
					          echo "<div style='text-align:right'><h3> <font color='red'>  שגיאה בהזנת מספר תעודת הזהות  המספר אמור להכיל 9 ספרות </font>   </h3>";  
				             }
				   
						
						
						//check password 
				        $flag_password=0;
						$dummy = array();
				        $candidate= $pass;
                        if (!preg_match_all('$\S*(?=\S{6,})$', $candidate,$dummy)){
                            $flag_password=1;
							 echo "<div style='text-align:right'><h3> <font color='red'> הסיסמה אמורה להכיל  לכל הפחות 6 תווים    </font>   </h3>";  
                          }
					
						
						if( $flag_password==0 &&  $flag_id==0 ){
						
						$sql = "SELECT * FROM ApprovedUser au WHERE (au.id = ".$id.");";
						$result = mysqli_query($conn,$sql);
						$temp=mysqli_num_rows($result);
						if ($result->num_rows == 0)
						{
							echo "<div style='text-align:right'><h3><font color='red'>    משתמש/תעודת זהות לא קיים במערכת    </font> </h3>"; 
							$flag=1;
						}
						else
						{
							$row = $result->fetch_assoc();
						}
						if ($row["password"]==$pass && $temp!=0)
						{
							echo "<div style='text-align:right'><h3><font color='green'> התחברות עברה בהצלחה     </font> </h3>"; 
							session_start();
							$_SESSION['login'] = TRUE;
							$_SESSION["global_id"] = $row["id"];
							$_SESSION["global_name"] = $row["Fname"];
							$_SESSION["global_role"] = $row["role"];
							$_SESSION["global_gpid"] = $row["gpid"];
							$sql1 = "SELECT up_name FROM ApprovedUser au INNER JOIN UserPermission up ON au.role=up.up_role_name WHERE (au.id = ".$id.");";
							$result1 = mysqli_query($conn,$sql1);
							$_SESSION["global_permissions"] = $result1;


							
							
							// login success navigation   
							header("Location:userGate.php");
							
						}
						else 
						{
							if ($flag==0)
							{
								echo "<div style='text-align:right'><h3><font color='red'> !!סיסמא שגויה     </font> </h3>"; 
							}
						}
						
						}
					}
					
  					
?>
  <center><div class="login-card">
  
    <form align="left" method="post">
    <input  type="text" required autocomplete="on" style="text-align:right;" name="id" placeholder="תעודת זהות"  value="<?php echo $_POST['id'];?>">
    <input type="password" required autocomplete="on" style="text-align:right;" name="pass" placeholder="סיסמא" value="<?php echo $_POST['pass'];?>">
    <input type="submit" name="login" class="login login-submit" value="התחברות">
  </form>
  <div class="login-help">
    <a href="login_regis.php">משתמש חדש</a>  •  <a href="forgot.php">שכחתי סיסמא</a> 
  </div>
  
  </div></center>

<?php include('bottom.php'); ?>

    
    
    
    
  </body>
</html>
