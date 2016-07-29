<!DOCTYPE html>
<!-- Website template by freewebsitetemplates.com -->
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Ilya</title>
	<link rel="stylesheet" href="css/style.css" type="text/css" charset="utf-8" />	

</head>

<body>
	<div id="header">
		<a href="index.html" id="logo" align="middle"><img src="images/logo.jpg" alt="LOGO" width="150" height="150" /></a>

	</div> <!-- /#header -->


	<div id="contents">
		<div class="body">
		
			<div id="main">
				<?php
					
					$next = $_GET["next"];

					switch ($next) {
										case "new_user":
													readfile("new_user.html");
													break;
										case "forgot":
													require('forgot.php');
													forgot();
													break;

										default:
												 readfile("login.html");
										}
				?>

			</div>
		</div>
	</div> <!-- /#contents -->
	<div id="footer">
	<h8>קישורים לעתיד</h8>
</div>
</body>
</html>