<?php

	

	include('menu.php');

?>

  <head>



    <meta charset="UTF-8">



    <title>Add Shifts</title>



 <!--   <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>

<link rel="stylesheet" href="css/normalize.css"> 

  <link rel="stylesheet" href="css/style.css"> -->

  

  </head>

    <body>
<div id="contents">

	<form method="post">

	  <?php

	  

	  echo '<br/><br/> <center><button type="submit" class="login login-submit" name="submit">צור שיבוץ</button></center>';

	  if (isset($_POST["submit"])){

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

					

			$next_week = strtotime('next Sunday');



			$date_monday = date("Y-m-d", strtotime('monday', $next_week));



			$date_tuesday = date("Y-m-d", strtotime('tuesday', $next_week));



			$date_wednesday = date("Y-m-d", strtotime('wednesday', $next_week));



			$date_thursday = date("Y-m-d", strtotime('thursday', $next_week));



			$date_friday = date("Y-m-d", strtotime('friday', $next_week));



			$date_saturday = date("Y-m-d", strtotime('saturday', $next_week));



			$date_sunday = date("Y-m-d", strtotime('sunday', $next_week));

	  

	  $sql="select * from Shift where gpid=1 and shift_day='ראשון' order by shift_start;";

	  $su=mysqli_query($conn,$sql);

	  $sql="select * from Shift where gpid=1 and shift_day='שני' order by shift_start;";

	  $mo=mysqli_query($conn,$sql);

	  $sql="select * from Shift where gpid=1 and shift_day='שלישי' order by shift_start;";

	  $tu=mysqli_query($conn,$sql);

	  $sql="select * from Shift where gpid=1 and shift_day='רביעי' order by shift_start;";

	  $we=mysqli_query($conn,$sql);

	  $sql="select * from Shift where gpid=1 and shift_day='חמישי' order by shift_start;";

	  $th=mysqli_query($conn,$sql);

	  $sql="select * from Shift where gpid=1 and shift_day='שישי' order by shift_start;";

	  $fr=mysqli_query($conn,$sql);

	  $sql="select * from Shift where gpid=1 and shift_day='שבת' order by shift_start;";

	  $sa=mysqli_query($conn,$sql);

	  

	  $sql="select count(*) from Shift where gpid=1 and shift_day='ראשון' order by shift_start;";

	  $nsu=mysqli_query($conn,$sql);

	  $sql="select count(*) from Shift where gpid=1 and shift_day='שני' order by shift_start;";

	  $nmo=mysqli_query($conn,$sql);

	  $sql="select count(*) from Shift where gpid=1 and shift_day='שלישי' order by shift_start;";

	  $ntu=mysqli_query($conn,$sql);

	  $sql="select count(*) from Shift where gpid=1 and shift_day='רביעי' order by shift_start;";

	  $nwe=mysqli_query($conn,$sql);

	  $sql="select count(*) from Shift where gpid=1 and shift_day='חמישי' order by shift_start;";

	  $nth=mysqli_query($conn,$sql);

	  $sql="select count(*) from Shift where gpid=1 and shift_day='שישי' order by shift_start;";

	  $nfr=mysqli_query($conn,$sql);

	  $sql="select count(*) from Shift where gpid=1 and shift_day='שבת' order by shift_start;";

	  $nsa=mysqli_query($conn,$sql);

	  

	  $shind=array();

	  $k=0;

	  while($row=mysqli_fetch_array($su))

	  {

	  $shind[$k]=$row;

	  $k=$k+1;

	  }

	  while($row=mysqli_fetch_array($mo))

	  {

	  $shind[$k]=$row;

	  $k=$k+1;

	  }

	  while($row=mysqli_fetch_array($tu))

	  {

	  $shind[$k]=$row;

	  $k=$k+1;

	  }

	  while($row=mysqli_fetch_array($we))

	  {

	  $shind[$k]=$row;

	  $k=$k+1;

	  }

	  while($row=mysqli_fetch_array($th))

	  {

	  $shind[$k]=$row;

	  $k=$k+1;

	  }

	  while($row=mysqli_fetch_array($fr))

	  {

	  $shind[$k]=$row;

	  $k=$k+1;

	  }

	  while($row=mysqli_fetch_array($sa))

	  {

	  $shind[$k]=$row;

	  $k=$k+1;

	  }



		 $sql="select distinct user_id from FavoriteShifts where gpid=1 order by user_id;"; 

		 $u1=mysqli_query($conn,$sql);

		 $users=array();

		 $k1=0;

		 while($row=mysqli_fetch_array($u1))

		{

		  

		  $users[$k1]=$row['user_id'];

		  $temp=$row['user_id'];

		  $k1=$k1+1;

		  

		  

		}
		$a=2;
		$c2=0;
		for($a=2;$a<8;$a=$a+1)
		{
			$sql="select distinct F.user_id from FavoriteShifts F Join Fairness FA on F.user_id=FA.user_id where F.gpid=1 and FA.shiftasked>=".$a." order by F.user_id;";
			$u1=mysqli_query($conn,$sql);
			$sql2="select  count(distinct F.user_id) from FavoriteShifts F Join Fairness FA on F.user_id=FA.user_id where F.gpid=1 and FA.shiftasked>=".$a." order by F.user_id;";
			$c=mysqli_query($conn,$sql2);
			while($r=mysqli_fetch_array($c))
				$c2=$r[0];
			if($k-$k1>=$c2)
			{
				 while($row=mysqli_fetch_array($u1))

				{
				  $users[$k1]=$row['user_id'];
				  $temp=$row['user_id'];
				  $k1=$k1+1; 
				}
			}
			else

				break;
		}


		// in case of shortage of guards
		for($l=$k1;$l<$k;$l=$l+1)

		{
			$ar=array();
			$m=0;
			if($k-$k1<$c2)
				$s="select user_id,fairness from ApprovedUser A JOIN Fairness F on A.id=F.user_id  where F.shiftasked>=".$a." and F.fairness=(select min(fairness) from Fairness F2 JOIN ApprovedUser A2 where A.gpid=1); ";
			else
				$s="select user_id,fairness from ApprovedUser A JOIN Fairness F on A.id=F.user_id where F.fairness=(select min(fairness) from Fairness F2 JOIN ApprovedUser A2 where A.gpid=1); ";

			$u1=mysqli_query($conn,$s);

			while($row=mysqli_fetch_array($u1))

			{

				$ar[$m]=$row['user_id'];

				$m=$m+1;

				$fair=$row['fairness'];

			}
			
			$r=rand(0,$m-1);

			$temp=$ar[$r];
			$sql2="update Fairness SET fairness=".($fair+3)." where user_id=".$temp.";";
			$e=mysqli_query($conn,$sql2);
			$users[$l]=$temp;

			

		}

		 

		 

		 $mat=array();

		 for($a=0;$a<$k;$a=$a+1)

		 {

			$mat[$a]=array();

			 for($b=0;$b<$k;$b=$b+1)

			 {

				 $sql="select favshifts_rank from FavoriteShifts where gpid=1 and favshifts_start='".$shind[$a]['shift_start']."' and favshifts_end='".$shind[$a]['shift_end']."' and favshifts_day='".$shind[$a]['shift_day']."' and user_id=".$users[$b]." ;";

				 //print($sql);

				 $ra=mysqli_query($conn,$sql);

				 while($row=mysqli_fetch_array($ra))

				 {$rank=$row[0];}

				 

				 $mat[$a][$b]=-1*$rank;

				 echo $mat[$a][$b].",";

			 }

			 echo '<br/>';

		 }

		  

		  

	  

	  

	  

	  $inf = 100000000000000000;

	  print $mat[1][2];

	  $h=max(array_map('count', $mat));

	  $w=$h;

	  $u=array_fill(0,$h,0);

	  $v=array_fill(0,$w,0);

	  $ind=array_fill(0,$w,-1);

	  for ($i=0;$i<$h;$i=$i+1)

	  {

		  

		  $links=array_fill(0,$w,-1);

		  $mins=array_fill(0,$w,$inf);

		  $visited=array_fill(0,$w,FALSE);

		  $markedI=$i;

		  $markedJ=-1;

		  $j=0;

		  while(True)

		  {

			  $j=-1;

			  for($j1=0;$j1<$h;$j1=$j1+1)

			  {

				  if($visited[$j1]==False)

				  {

					  $cur=$mat[$markedI][$j1]-$u[$markedI] - $v[$j1];

					  if($cur<$mins[$j1])

					  {

						$mins[$j1] = $cur;  

						$links[$j1] = $markedJ;  

					  }

					  if($j==-1 || $mins[$j1]<$mins[$j])

					  {

						  $j=$j1;

					  }

					   

				  }  

			  }

			  $delta=$mins[$j];

			  for($j1=0;$j1<$w;$j1=$j1+1)

			  {

				  if($visited[$j1]==TRUE)

				  {

					  $u[$ind[$j1]]=$u[$ind[$j1]]+$delta;

					  $v[$j1]=$v[$j1]-$delta;

					  

				  }

				  else

				  {

					  

					  $mins[$j1]=$mins[$j1]-$delta;  

				  }



			  }

			  $u[$i]= $u[$i]+$delta;

			  $visited[$j]=True;

			  $markedJ=$j;

			  $markedI =$ind[$j];

			  if ($markedI == -1)

			  {

				  break;

			  }  

		  }

		  while(True)

		  {

			  if($links[$j]!=-1)

			  {

				$ind[$j] = $ind[$links[$j]];

				$j = $links[$j];		

				  

			  }

			  else

			  {

				  break;

				  

			  } 

		  }

		  $ind[$j]=$i; 

	  }

	  $result=array();

	$sqld="delete from AssignedAt where gpid=1 and  assignedat_date>='".$date_sunday."' and assignedat_date<='".$date_saturday."';";

	$result2 = mysqli_query($conn,$sqld);

	  for($j=0;$j<$w;$j=$j+1)

	  {

		 $result[$j]=array($ind[$j], $j);

		 print("(".$shind[$result[$j][0]]['shift_day'].",".$users[$result[$j][1]].")");

		 print("<br/>");

		 



		 

		 

		 switch ($shind[$result[$j][0]]['shift_day']) {

    case 'ראשון':

        $date=$date_sunday;

        break;

    case 'שני':

        $date=$date_monday;

        break;

    case 'שלישי':

         $date=$date_tuesday;

        break;

	case 'רביעי':

         $date=$date_wednesday;

        break;

	case 'חמישי':

         $date=$date_thursday;

        break;

	case 'שישי':

         $date=$date_friday;

        break;

	case 'שבת':

         $date=$date_saturday;

        break;

	

}

		

		 $sql1 = "INSERT INTO AssignedAt VALUES('".$shind[$result[$j][0]]['shift_start']."','".$shind[$result[$j][0]]['shift_end']."','". $date."','".$shind[$result[$j][0]]['shift_day']."',1,".$users[$result[$j][1]].",0);";



							$result1 = mysqli_query($conn,$sql1);

	  }

	  

	  //table creation

	  							echo ' <table dir=rtl align="center" border="1">';



							echo '<tr><td>ראשון</td><td >שני</td><td >שלישי</td><td >רביעי</td><td >חמישי</td><td >שישי</td><td>שבת</td></tr>';



							echo '<tr>';



							



						//sunday



							echo '<td><table dir=rtl align="center">';



							$sql3="select S.shift_start,S.shift_end,A.user_id from Shift S JOIN AssignedAt A on S.shift_start=A.assignedat_start and S.shift_end=A.assignedat_end and S.shift_day=A.assignedat_day and S.gpid=A.gpid where S.shift_day='ראשון' and A.gpid=1 order by shift_start ASC;";

							



							$res=mysqli_query($conn,$sql3);



							$i=0;



							while( $r1=mysqli_fetch_array($res)){ 



							echo '<tr><td>'.$r1[0].'-'.$r1[1].'</td><td>'.$r1[2].'</td></tr>'; 



							$i=$i+1;}



							echo '</table></td>';



							



						//monday	



							echo '<td><table dir=rtl align="center">';



							$sql3="select S.shift_start,S.shift_end,A.user_id from Shift S JOIN AssignedAt A on S.shift_start=A.assignedat_start and S.shift_end=A.assignedat_end and S.shift_day=A.assignedat_day and S.gpid=A.gpid where S.shift_day='שני' and A.gpid=1 order by shift_start ASC;";



							$res=mysqli_query($conn,$sql3);



							$i=5;



							while( $r1=mysqli_fetch_array($res)){ 



							echo '<tr><td>'.$r1[0].'-'.$r1[1].'</td><td>'.$r1[2].'</td></tr>';



							$i=$i+1;}



							echo '</table></td>';



							



						//tuesday



						



						echo '<td><table dir=rtl align="center">';



							$sql3="select S.shift_start,S.shift_end,A.user_id from Shift S JOIN AssignedAt A on S.shift_start=A.assignedat_start and S.shift_end=A.assignedat_end and S.shift_day=A.assignedat_day and S.gpid=A.gpid where S.shift_day='שלישי' and A.gpid=1 order by shift_start ASC;";



							$res=mysqli_query($conn,$sql3);



							$i=10;



							while( $r1=mysqli_fetch_array($res)){ 



							echo '<tr><td>'.$r1[0].'-'.$r1[1].'</td><td>'.$r1[2].'</td></tr>';



							$i=$i+1;}



							echo '</table></td>';



						



						//wednesday



						



							echo '<td><table dir=rtl align="center">';



							$sql3="select S.shift_start,S.shift_end,A.user_id from Shift S JOIN AssignedAt A on S.shift_start=A.assignedat_start and S.shift_end=A.assignedat_end and S.shift_day=A.assignedat_day and S.gpid=A.gpid where S.shift_day='רביעי' and A.gpid=1 order by shift_start ASC;";



							$res=mysqli_query($conn,$sql3);



							$i=15;



							while( $r1=mysqli_fetch_array($res)){ 



							echo '<tr><td>'.$r1[0].'-'.$r1[1].'</td><td>'.$r1[2].'</td></tr>';



							$i=$i+1;}



							echo '</table></td>';



							



						//thursday	



							echo '<td><table dir=rtl align="center">';



							$sql3="select S.shift_start,S.shift_end,A.user_id from Shift S JOIN AssignedAt A on S.shift_start=A.assignedat_start and S.shift_end=A.assignedat_end and S.shift_day=A.assignedat_day and S.gpid=A.gpid where S.shift_day='חמישי' and A.gpid=1 order by shift_start ASC;";



							$res=mysqli_query($conn,$sql3);



							$i=20;



							while( $r1=mysqli_fetch_array($res)){ 



							echo '<tr><td>'.$r1[0].'-'.$r1[1].'</td><td>'.$r1[2].'</td></tr>';



							$i=$i+1;}



							echo '</table></td>';



							



						//friday	



							echo '<td><table dir=rtl align="center">';



							$sql3="select S.shift_start,S.shift_end,A.user_id from Shift S JOIN AssignedAt A on S.shift_start=A.assignedat_start and S.shift_end=A.assignedat_end and S.shift_day=A.assignedat_day and S.gpid=A.gpid where S.shift_day='שישי' and A.gpid=1 order by shift_start ASC;";



							$res=mysqli_query($conn,$sql3);



							$i=25;



							while( $r1=mysqli_fetch_array($res)){ 



							echo '<tr><td>'.$r1[0].'-'.$r1[1].'</td><td>'.$r1[2].'</td></tr>';

							$i=$i+1;}



							echo '</table></td>';



							



						//sautrday



						



							echo '<td><table dir=rtl align="center">';



							$sql3="select S.shift_start,S.shift_end,A.user_id from Shift S JOIN AssignedAt A on S.shift_start=A.assignedat_start and S.shift_end=A.assignedat_end and S.shift_day=A.assignedat_day and S.gpid=A.gpid where S.shift_day='שבת' and A.gpid=1 order by shift_start ASC;";



							$res=mysqli_query($conn,$sql3);



							$i=30;



							while( $r1=mysqli_fetch_array($res)){ 



							echo '<tr><td>'.$r1[0].'-'.$r1[1].'</td><td>'.$r1[2].'</td></tr>';



							$i=$i+1;}



							echo '</table></td>';







						



							echo '</tr></table>';

							

							

							

							

								  // ערך מדד

						$sql="select count(favshifts_rank) from AssignedAt A join FavoriteShifts F on F.favshifts_start=A.assignedat_start and F.favshifts_end=A.assignedat_end and F.favshifts_day=A.assignedat_day and F.gpid=A.gpid and F.user_id=A.user_id where A.gpid=1 and A.assignedat_date>='".$date_sunday."' and A.assignedat_date<='".$date_saturday."';";

						$res=mysqli_query($conn,$sql);

						while( $r1=mysqli_fetch_array($res)){

							echo ' ערך המדד של השיבוץ הוא '.($r1[0])/($k*2);

						}

	  

							



							}			

	  

	  



	  ?>

</form>
</div>

    </body>



</html>

