<?php

?>


<?php

if ($_SESSION['login']!=TRUE){
	include('login.php');	
	}
else {
	header("Location: myschedule.php");	
}
if($_SESSION["global_role"]=='סייר'||$_SESSION["global_role"]=='אחראי עמדה'||$_SESSION["global_role"]=='מוקדן')
	header("Location:myschedule.php");
?>




