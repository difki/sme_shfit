<html>

<body>

  <head>

    <meta charset="UTF-8">

    <title>Forgot Password</title>

    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>

    

    <link rel="stylesheet" href="css/normalize.css">



    

        <link rel="stylesheet" href="css/style.css">



    

    

    

  </head>



<?php



// In case of success

 if (isset($_POST["submit"]))

	{

				

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

			

//check email

				$email = $_POST["mail"];

                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 

	                  echo "<div style='text-align:right'><h3><font color='red'>    הדואר האלקטרוני (אימייל) נכתב בתבנית שגויה   </font> </h3>"; 				  

			else {

			$sql = "SELECT password FROM ApprovedUser au WHERE (au.mail = '".$_POST["mail"]."');";

			//$sql="select password from ApprovedUser where mail='".$_POST["mail"]."';";

			$result = mysqli_query($conn,$sql);

			$temp=mysqli_num_rows($result);

			if ($result->num_rows == 0)

			//if (!$result)

			{ 

				

				echo "<div style='text-align:right'><h3><font color='red'>    איימיל זה לא קיים במערכת    </font> </h3>"; 

				//echo $result;

			//	die("איימיל זה לא קיים במערכת<br>".mysqli_error($conn));

				//echo "<script>window.location = 'http://http://bitahon.tk/registration.php'</script>";	

			}else {

				//לעשות כפתור חזור

		     	echo "<div style='text-align:right'><h3><font color='green'>    הסיסמא נשלחה בהצלחה לכתובת המייל שציינת   </font> </h3>"; 	

				$row = $result->fetch_assoc();

				$msg="     סיסמתך לאתר יחידת האבטחה בטכניון היא ".$row["password"]." .";

				mail($_POST["mail"]," הסיסמא שלך לאתר יחידת האבטחה בטכניון",$msg);	

			      }

		

				

				

			    }

     		

				

				

			

	} 

			







?>

	<center>

	<h1>שכחתי סיסמא  </h1>

<p> ,במידה ושכחת את סיסמתך לאתר </p>

<p>הזן את כתובת המייל שאיתה נרשמת לאתר והסיסמה תישלח אלייך לאחר מספר דקות </p>



<br/><br/><br/>

		<form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">

           

        

			אימייל

			

              <input type="text" required autocomplete="off" name="mail" value="<?php echo $_POST['mail'];?>"/> <br/><br/>          

			  <button type="submit" class="login login-submit" name="submit"/>שלח</button>

		  

          

        </form>

	</center>

</body>



</html>