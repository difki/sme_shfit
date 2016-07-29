<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Log-in</title> 
        <link rel="stylesheet" href="css/style.css" 
  </head>

  <body>

    <div class="login-card">
    <h1>אישור משתמשים</h1><br>
	<tr>
	<select name="Approve">
	<option value="default">Choose worker</option>
		
					<option value="pot"> pot </option>';
					</select>
					</tr>
					<br>
					


  <form method="post">
	<input type="submit" name="choose" class="login login-submit" value="בחר">
	
	     	<?php
    
    		if (isset($_POST["choose"]))
					
					{	echo pot;
						echo $_POST["Approve"];
					}
					?>
  </form>
  
 
					
					
			
    
  <div class="login-help">
    <a href="registration.php">משתמש חדש</a>  •  <a href="index.php?next=forgot">שכחתי סיסמא</a>
  </div>
</div>

pot<br>
     	<?php
    
    		if (isset($_POST["choose"]))
					
					{
						echo pot;
						echo $_POST["Approve"];
					}
					?>
					pot2
  </body>
</html>
