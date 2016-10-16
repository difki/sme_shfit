<!DOCTYPE html>
<!-- Website template by freewebsitetemplates.com -->
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Ilya</title>
	<link rel="stylesheet" href="css/style.css" type="text/css" charset="utf-8" />	
	<!--[if lte IE 7]>
		<link rel="stylesheet" href="css/ie.css" type="text/css" charset="utf-8" />	
	<![endif]-->
</head>

<body>
	<div id="header">
		<a href="index.html" id="logo" align="middle"><img src="images/logo.jpg" alt="LOGO" width="150" height="150" /></a>
		<div id="navigation">
			<ul>
			<!-- -->
				<?php
					
				echo $_POST["id"];
					$servername = "localhost";
					$username = "proj";
					$password = "proj";
					$dbname = "bitahon";
					echo "@@@@@";

					// Create connection
					$conn = new mysqli($servername, $username, $password, $dbname);
					// Check connection
					if ($conn->connect_error) {
						die("Connection failed: " . $conn->connect_error);
					} 

					$sql = "SELECT name, link
					FROM User u INNER JOIN ApprovedUser au ON u.id = au.id
					INNER JOIN Role r ON au.role= r.rolename
					INNER JOIN UserPermission up ON up.rolename = r.rolename 
					NATURAL JOIN Permissions WHERE (u.id = ".$_POST["id"].");";
					
					
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
						// output data of each row
						
						while($row = $result->fetch_assoc()) {

							echo "<li><a href=http://".$row["link"].">".$row["name"]."</a></li>";

							}
					}

					else {
							echo "NO permissions!";
					}
					$conn->close();
					?>

			</ul>
		</div>

	</div> <!-- /#header -->


	<div id="contents">
		<div class="body">
			
			<div id="main">
				<?php
				
								readfile("ilyasexp/page1.txt");
				
				
				?>
				<br>
<center> <iframe width="800" height="600" src="https://www.youtube.com/embed/Bt5QvYv6LXw?start=9" frameborder="0" allowfullscreen></iframe></center>
			</div>
		</div>
	</div> <!-- /#contents -->
	<div id="footer">
	<h8>קישורים לעתיד</h8>
	<!--	<ul class="contacts">
			<h3>Contact Us</h3>
			<li><span>Email</span><p>: company@email.com</p></li>
			<li><span>Address</span><p>: 189 Lorem Ipsum Pellentesque, Mauris Etiam ut velit odio Proin id nisi enim 0000</p></li>
			<li><span>Phone</span><p>: 117-683-9187-000</p></li>
		</ul>
		<ul id="connect">
			<h3>Get Updated</h3>
			<li><a href="blog.html">Blog</a></li>
			<li><a href="http://facebook.com/freewebsitetemplates" target="_blank">Facebook</a></li>
			<li><a href="http://twitter.com/fwtemplates" target="_blank">Twitter</a></li>
		</ul>
		<div id="newsletter">
			<p><b>Sign-up for Newsletter</b>
				In sollicitudin vulputate metus, sed commodo diam elementum nec. Sed et risus sed magna convallis adipiscing.
			</p>
			<form action="" method="">
				<input type="text" value="Name" class="txtfield" onblur="javascript:if(this.value==''){this.value=this.defaultValue;}" onfocus="javascript:if(this.value==this.defaultValue){this.value='';}" />
				<input type="text" value="Enter Email Address" class="txtfield" onblur="javascript:if(this.value==''){this.value=this.defaultValue;}" onfocus="javascript:if(this.value==this.defaultValue){this.value='';}" />
				<input type="submit" value="" class="button" />
			</form>
		</div>
		<span class="footnote">&copy; Copyright &copy; 2011. All rights reserved</span>
	</div> <!-- /#footer -->
</body>
</html>

<!--
SELECT name
	FROM User u 
	INNER JOIN ApprovedUser au ON u.id = au.id
	INNER JOIN Role r ON au.role= r.rolename
	INNER JOIN UserPermission up ON up.name = r.rolename;
	
	
	WHERE (u.id = id);
-->