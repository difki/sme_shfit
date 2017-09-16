<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>עדכון עמדות שמירה</title> 
        <link rel="stylesheet" href="css/style.css" 
  </head>

  <body>

    <div class="login-card">
    <h1>עדכון ומחיקת עמדות שמירה</h1><br>
	<tr>
	<form method="post">
	<select name="Approve">
	<option value="default"></option>
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
					$sql = "select * from GuardPost;";
					$x=mysqli_query($conn,$sql);
					while($row = mysqli_fetch_array($x))
					{
						echo '<option value="'.$row['guardpost_id'].'">'.$row['guardpost_name'].'</option>';
					}
					
					?>
					</select>
					</tr>
					<br>
					<input type="submit" name="choose" class="login login-submit" value="בחר עמדה">
					
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
						//echo "111";
						//$id=$_POST['guardpost_id'];
						$id=$_POST["Approve"];
						$sql = "select * from GuardPost where (GuardPost.guardpost_id = ".$id.");";
						$result=mysqli_query($conn,$sql);
						$row = $result->fetch_assoc();
												
						
						echo '<center>';
						echo "מספר עמדה";
						echo '<input type="text" style="text-align:right;" readonly="readonly" name="gid" value="'.$row['guardpost_id'].'">';
						echo "שם העמדה";
						echo '<input type="text" style="text-align:right;" name="Guard_name" value="'.$row['guardpost_name'].'">';
						echo "מיקום העמדה";
						echo '<input type="text" style="text-align:right;" name="Guard_pos" value="'.$row['guardpost_place'].'">';
						echo "כמות תקנים לעמדה   ";
						echo '<input type="number" style="text-align:right;" min="0" max="100" STEP="1" VALUE="'.$row['guardpost_norm'].'" name="Guard_norm" value="'.$row['guardpost_norm'].'">';
						echo '	<input type="submit" name="update" class="login login-submit" value="עדכן">';
						echo '</br>';
						echo '</br>';
						echo '</br>';
						echo '	<input type="submit" back name="delete" class="login login-submit" value="מחק עמדה">';
					}
					
					if (isset($_POST["update"]))
					{
							$id=$_POST['gid'];
							$sql1 = "UPDATE GuardPost SET guardpost_name='".$_POST['Guard_name']."', guardpost_place='".$_POST['Guard_pos']."', guardpost_norm='".$_POST['Guard_norm']."' where (guardpost_id = ".$id.");";
							$result1 = mysqli_query($conn,$sql1);
					}
					
					if (isset($_POST["delete"]))
					{
							$id=$_POST['gid'];
							$sql2 = "DELETE from GuardPost where (GuardPost.guardpost_id = ".$id.");";
							$result2=mysqli_query($conn,$sql2);
					}
					
					?>
	
	</form>
    

	</div>


    
    
    
    
  </body>
</html>
