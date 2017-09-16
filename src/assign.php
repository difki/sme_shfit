<?php

	

	include('menu.php');
	include('strings.php');
	include('pagebase.php');

?>

  <head>



    <meta charset="UTF-8">



    <title>Add Shifts</title>



 <!--   <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>

<link rel="stylesheet" href="css/normalize.css"> 

  <link rel="stylesheet" href="css/style.css"> -->

  <link rel="stylesheet" href="css/tab.css" type="text/css"> 

  

  </head>

    <body>
		

	<form method="post">

	  <?php
		$conn = new mysqli($sql_servername, $sql_username, $sql_password, $sql_dbname);
		$conn->query("SET character_set_client=utf8");
		$conn->query("SET character_set_connection=utf8");
		$conn->query("SET character_set_database=utf8");
		$conn->query("SET character_set_results=utf8");
		$conn->query("SET character_set_server=utf8");
		
		session_start();
		$this_week = strtotime('last Sunday');
		$thissunday = date("Y-m-d", strtotime('sunday', $this_week));
		$thissau = date("Y-m-d", strtotime('saturday', $this_week));
		$emda3= $_SESSION["global_gpid"];
		$flag=0;
		if($_SESSION["global_role"]!='אחראי עמדה')
		{
		$flag=1;

		echo '<select name="emda">';
		$sql4 = "select guardpost_id,guardpost_name from GuardPost;";
		$x2=mysqli_query($conn,$sql4);
		while($row4 = mysqli_fetch_array($x2))
			{
				echo '<option value="'.$row4['guardpost_id'].'">'.$row4['guardpost_name'].'</option>';
			}
		echo '</select>';
		echo '<br/><br/> <center><button type="submit" class="login login-submit" name="submit2">בחר עמדה</button></center><br/>';
		if (isset($_POST["submit2"]))
		{
		$emda3=$_POST['emda'];
		$_SESSION["global_assignem"]=$_POST['emda'];
		$flag=0;
		}
		}
	  if($flag==0)
	  {
	  $sql="select distinct A.id,A.Fname,A.Lname,F.user_id,F.favsupdate>='".$thissunday."' and F.favsupdate<='".$thissau."' from ApprovedUser A join Fairness F on A.id=F.user_id where A.gpid=".$emda3.";";
	  $b=mysqli_query($conn,$sql);
	  echo '<table class="tftable"><tr><th>שם הסייר</th><th>האם הגיש סידור?</th></tr>';
	  while($row=mysqli_fetch_array($b))
	  {
		  if($row[4]==0)
			  echo '<tr><td>'.$row[1].' '.$row[2].'</td><td bgcolor="red">לא הגיש</td>';
		  else
			  echo '<tr><td>'.$row[1].' '.$row[2].'</td><td bgcolor=" green">הגיש</td>';
		  echo '<tr/>';
		  
	  }
	  echo '</table>';
	  }
	  echo '<br/><br/> <center><button type="submit" class="login login-submit" name="submit">צור שיבוץ</button></center><br/>';

	  if (isset($_POST["submit"])){
		if($_SESSION["global_role"]!='אחראי עמדה')
			{
				$emda3=$_SESSION["global_assignem"];
			}
			else
			{
				$emda3=$_SESSION["global_gpid"];
			}
			$next_week = strtotime('next Sunday');
			
			$date_monday = date("Y-m-d", strtotime('monday', $next_week));
			$date_tuesday = date("Y-m-d", strtotime('tuesday', $next_week));
			$date_wednesday = date("Y-m-d", strtotime('wednesday', $next_week));
			$date_thursday = date("Y-m-d", strtotime('thursday', $next_week));
			$date_friday = date("Y-m-d", strtotime('friday', $next_week));
			$date_saturday = date("Y-m-d", strtotime('saturday', $next_week));
			$date_sunday = date("Y-m-d", strtotime('sunday', $next_week));
			
	  $sql="select * from Shift where gpid=".$emda3." and shift_day='ראשון' order by ord;";
	  $su=mysqli_query($conn,$sql);

	  $sql="select * from Shift where gpid=".$emda3." and shift_day='שני' order by ord;";

	  $mo=mysqli_query($conn,$sql);

	  $sql="select * from Shift where gpid=".$emda3." and shift_day='שלישי' order by ord;";

	  $tu=mysqli_query($conn,$sql);

	  $sql="select * from Shift where gpid=".$emda3." and shift_day='רביעי' order by ord;";

	  $we=mysqli_query($conn,$sql);

	  $sql="select * from Shift where gpid=".$emda3." and shift_day='חמישי' order by ord;";

	  $th=mysqli_query($conn,$sql);

	  $sql="select * from Shift where gpid=".$emda3." and shift_day='שישי' order by ord;";

	  $fr=mysqli_query($conn,$sql);

	  $sql="select * from Shift where gpid=".$emda3." and shift_day='שבת' order by ord;";

	  $sa=mysqli_query($conn,$sql);

	  $sql="select count(*) from Shift where gpid=".$emda3." and shift_day='ראשון' order by ord;";

	  $nsu=mysqli_query($conn,$sql);

	  $sql="select count(*) from Shift where gpid=".$emda3." and shift_day='שני' order by ord;";

	  $nmo=mysqli_query($conn,$sql);

	  $sql="select count(*) from Shift where gpid=".$emda3." and shift_day='שלישי' order by ord;";

	  $ntu=mysqli_query($conn,$sql);

	  $sql="select count(*) from Shift where gpid=".$emda3." and shift_day='רביעי' order by ord;";

	  $nwe=mysqli_query($conn,$sql);

	  $sql="select count(*) from Shift where gpid=".$emda3." and shift_day='חמישי' order by ord;";

	  $nth=mysqli_query($conn,$sql);

	  $sql="select count(*) from Shift where gpid=".$emda3." and shift_day='שישי' order by ord;";

	  $nfr=mysqli_query($conn,$sql);

	  $sql="select count(*) from Shift where gpid=".$emda3." and shift_day='שבת' order by ord;";

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
	  // reset fairness in case max fairness for this guard post is past certain value (50 currently)
	  $s="select max(fairness) from FavoriteShifts A2 JOIN Fairness F2 on A2.user_id=F2.user_id where A2.gpid=".$emda3.";";
	  $u1=mysqli_query($conn,$s);
	  while($row=mysqli_fetch_array($u1))
	  {
		 if ($row[0]>=50)
		 {
			$s2="UPDATE Fairness F JOIN ApprovedUser A on F.user_id=A.id SET F.fairness = 0 WHERE A.gpid=".$emda3.";";
			$u2=mysqli_query($conn,$s2);
		 }
	  }
		 $s="select count(distinct user_id) from FavoriteShifts where gpid=".$emda3." order by user_id;";
		 $u1=mysqli_query($conn,$s);
		 while($row=mysqli_fetch_array($u1))
		 {
			if ($row[0]<3)
			{
				echo '<center>';
				exit("לא ניתן להרכיב שיבוץ שכן פחות מ 3 סיירים הגישו העדפות");
				echo '</center>';
				
			}
		 }
		 
		 $sql="select distinct user_id from FavoriteShifts where gpid=".$emda3." order by user_id;"; 
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
			$sql="select distinct F.user_id from FavoriteShifts F Join Fairness FA on F.user_id=FA.user_id where F.gpid=".$emda3." and FA.shiftasked>=".$a." order by F.user_id;";
			$u1=mysqli_query($conn,$sql);
			$sql2="select count(distinct F.user_id) from FavoriteShifts F Join Fairness FA on F.user_id=FA.user_id where F.gpid=".$emda3." and FA.shiftasked>=".$a." order by F.user_id;";
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
				$s="select distinct A.user_id,fairness from FavoriteShifts A JOIN Fairness F on A.user_id=F.user_id  where F.shiftasked>=".$a." and F.fairness=(select min(fairness) from FavoriteShifts A2 JOIN Fairness F2 on A2.user_id=F2.user_id where F2.shiftasked>=".$a." and A.gpid=".$emda3."); ";
			else
				$s="select distinct A.user_id,fairness from FavoriteShifts A JOIN Fairness F on A.user_id=F.user_id where F.fairness=(select min(fairness) from FavoriteShifts A2 JOIN Fairness F2 on A2.user_id=F2.user_id where A.gpid=".$emda3."); ";

			$u1=mysqli_query($conn,$s);
			while($row=mysqli_fetch_array($u1))

			{
				//echo $row['user_id'];
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
		 $inf = 10000;
		 for($a=0;$a<$k;$a=$a+1)

		 {
			
			$mat[$a]=array();

			 for($b=0;$b<$k;$b=$b+1)

			 {
				 
				$sql="select favshifts_rank from FavoriteShifts where gpid=".$emda3." and favshifts_start='".$shind[$b]['shift_start']."' and favshifts_end='".$shind[$b]['shift_end']."' and favshifts_day='".$shind[$b]['shift_day']."' and user_id=".$users[$a]." ;";
				 $ra=mysqli_query($conn,$sql);
				 while($row=mysqli_fetch_array($ra))

				 {$rank=$row[0];}

				 
				if($rank!=0)
					$mat[$a][$b]=-1*$rank;
				else
					$mat[$a][$b]=$inf;
				    //echo $mat[$a][$b].",";
			 }
			 //echo '<br/>';
		 }
	  //print $mat[1][2];

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
	$sqld="delete from AssignedAt where gpid=".$emda3." and  assignedat_date>='".$date_sunday."' and assignedat_date<='".$date_saturday."';";
	$result2 = mysqli_query($conn,$sqld);
	   $result=array();
	  for($j=0;$j<$w;$j=$j+1)
	  {
		 $result[$j]=array($ind[$j], $j);
		 //print("(".$shind[$result[$j][1]]['shift_day'].",".$users[$result[$j][0]].")");
		 //print("<br/>");
		 switch ($shind[$result[$j][1]]['shift_day']) {
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
		 $sql1 = "INSERT INTO AssignedAt VALUES('".$shind[$result[$j][1]]['shift_start']."','".$shind[$result[$j][1]]['shift_end']."','". $date."','".$shind[$result[$j][1]]['shift_day']."',".$emda3.",".$users[$result[$j][0]].",0);";
		$result1 = mysqli_query($conn,$sql1);
		//echo $sql1;
		//echo '<br/>';
	  }
	  	  function check($shift,$i,$origin,$id,$conn,$emda3) 
		  {
			$next_week = strtotime('next Sunday');  
			$date_monday = date("Y-m-d", strtotime('monday', $next_week));
			$date_tuesday = date("Y-m-d", strtotime('tuesday', $next_week));
			$date_wednesday = date("Y-m-d", strtotime('wednesday', $next_week));
			$date_thursday = date("Y-m-d", strtotime('thursday', $next_week));
			$date_friday = date("Y-m-d", strtotime('friday', $next_week));
			$date_saturday = date("Y-m-d", strtotime('saturday', $next_week));
			$date_sunday = date("Y-m-d", strtotime('sunday', $next_week));
			  if($i!=0 and abs($i-$origin)!=1)
			  {
				$sql="select user_id from AssignedAt where assignedat_start='".$shift[$i-1]['shift_start']."' and assignedat_end='".$shift[$i-1]['shift_end']."' and assignedat_day='".$shift[$i-1]['shift_day']."' and gpid=".$emda3." and assignedat_date>='".$date_sunday."' and assignedat_date<='".$date_saturday."';";
				$res = mysqli_query($conn,$sql);
				while($row=mysqli_fetch_array($res))
				$r1=$row[0];
				$sql2="select user_id from AssignedAt where assignedat_start='".$shift[$i]['shift_start']."' and assignedat_end='".$shift[$i]['shift_end']."' and assignedat_day='".$shift[$i]['shift_day']."' and  gpid=".$emda3." and assignedat_date>='".$date_sunday."' and assignedat_date<='".$date_saturday."';";
				$res2 = mysqli_query($conn,$sql2);
				while($row=mysqli_fetch_array($res2))
				$r2=$row[0];
				$sql3="select user_id from AssignedAt where assignedat_start='".$shift[$i+1]['shift_start']."' and assignedat_end='".$shift[$i+1]['shift_end']."' and assignedat_day='".$shift[$i+1]['shift_day']."' and  gpid=".$emda3." and assignedat_date>='".$date_sunday."' and assignedat_date<='".$date_saturday."';";
				$res3 = mysqli_query($conn,$sql3);
				while($row=mysqli_fetch_array($res3))
				$r3=$row[0];
			
				if($id!=$r1 and $id!=$r2 and $id!=$r3)
					return true;
				
				else
					return false;
			  }
			  else
			  {
				  
				  // להוסיף בדיקה לגבי המשמרת של שבת שאין רצף בין שבת לראשון
				if($i==0 or $i-$origin==1)
				{
				
				$sql2="select user_id from AssignedAt where assignedat_start='".$shift[$i]['shift_start']."' and assignedat_end='".$shift[$i]['shift_end']."' and assignedat_day='".$shift[$i]['shift_day']."' and  gpid=".$emda3." and assignedat_date>='".$date_sunday."'  and assignedat_date<='".$date_saturday."';";
				$res2 = mysqli_query($conn,$sql2);
				while($row=mysqli_fetch_array($res2))
				$r2=$row[0];
				$sql3="select user_id from AssignedAt where assignedat_start='".$shift[$i+1]['shift_start']."' and assignedat_end='".$shift[$i+1]['shift_end']."' and assignedat_day='".$shift[$i+1]['shift_day']."' and  gpid=".$emda3." and assignedat_date>='".$date_sunday."' and assignedat_date<='".$date_saturday."';";
				$res3 = mysqli_query($conn,$sql3);
				while($row=mysqli_fetch_array($res3))
				$r3=$row[0];
				if($id!=$r2 and $id!=$r3)
					return true;
				else
					return false;
				}
				
				else
				{
				$sql="select user_id from AssignedAt where assignedat_start='".$shift[$i-1]['shift_start']."' and assignedat_end='".$shift[$i-1]['shift_end']."' and assignedat_day='".$shift[$i-1]['shift_day']."' and  gpid=".$emda3." and assignedat_date>='".$date_sunday."' and assignedat_date<='".$date_saturday."';";
				$res = mysqli_query($conn,$sql);
				while($row=mysqli_fetch_array($res))
				$r1=$row[0];
				$sql2="select user_id from AssignedAt where assignedat_start='".$shift[$i]['shift_start']."' and assignedat_end='".$shift[$i]['shift_end']."' and assignedat_day='".$shift[$i]['shift_day']."' and  gpid=".$emda3." and assignedat_date>='".$date_sunday."' and assignedat_date<='".$date_saturday."';";
				$res2 = mysqli_query($conn,$sql2);
				while($row=mysqli_fetch_array($res2))
				$r2=$row[0];
				if($id!=$r1 and $id!=$r2)
					return true;
				
				else
					return false;
					
					
				}
				  
			  }
			}
	  		// changes in the assignment
	function dupdec($users,$result,$mat,$w,$conn,$shind,$inf,$emda3){
	for($n=0;$n<$w-1;$n=$n+1)
	{
	 for($z=0;$z<=6;$z=$z+1)
	 {
	  for($i=0;$i<$w-1;$i=$i+1)
	  {

		  if($users[$result[$i][0]]==$users[$result[$i+1][0]])
		  {		
			  $sat=-1*$mat[$result[$i+1][0]][$result[$i+1][1]];
			  $id=$users[$result[$i+1][0]];
			  for($p=0;$p<$w;$p=$p+1)
			  {
				  $newid=$users[$result[$p][0]];
				  $newsat=-1*$mat[$result[$p][0]][$result[$p][1]];
				  
				  if($sat+$newsat==(-1)*$mat[$result[$i+1][0]][$p]+(-1)*$mat[$result[$p][0]][$i+1]+$z and $mat[$result[$i+1][0]][$p]!=$inf and $mat[$result[$p][0]][$i+1]!=$inf )
				  {	  
					  $val=check($shind,$p,$i+1,$id,$conn,$emda3);
					  $val2=check($shind,$i+1,$p,$newid,$conn,$emda3);
					  if($val==true and $val2==true)
					  {	  
						  $temp=$result[$i+1][0];
						  $result[$i+1][0]=$result[$p][0];
						  $result[$p][0]=$temp;
						  $sql3="UPDATE AssignedAt set user_id=".$newid." where assignedat_start='".$shind[$i+1]['shift_start']."' and assignedat_end='".$shind[$i+1]['shift_end']."' and assignedat_day='".$shind[$i+1]['shift_day']."' and  gpid=".$emda3." and assignedat_date>='".$date_sunday."' and assignedat_date<='".$date_saturday."';";
						  $res = mysqli_query($conn,$sql3);
						  $sql3="UPDATE AssignedAt set user_id=".$id." where assignedat_start='".$shind[$p]['shift_start']."' and assignedat_end='".$shind[$p]['shift_end']."' and assignedat_day='".$shind[$p]['shift_day']."' and  gpid=".$emda3." and assignedat_date>='".$date_sunday."' and assignedat_date<='".$date_saturday."';";
						  $res = mysqli_query($conn,$sql3);
					  }//end of if
					  
					  
				  }//end of if
			  }//end of for
			  
			  
			  
		  }//end of if
		  
		  
	  }//end of for
	  
	 }// end of for
	}//end of for
	
	// round 2
	
	for($n=0;$n<$w-1;$n=$n+1)
	{
	 for($z=0;$z<=6;$z=$z+1)
	 {
	  for($i=0;$i<$w-1;$i=$i+1)
	  {

		  if($users[$result[$i][0]]==$users[$result[$i+1][0]])
		  {		
			  $sat=-1*$mat[$result[$i][0]][$result[$i][1]];
			  $id=$users[$result[$i][0]];
			  for($p=0;$p<$w;$p=$p+1)
			  {
				  $newid=$users[$result[$p][0]];
				  $newsat=-1*$mat[$result[$p][0]][$result[$p][1]];
				  
				  if($sat+$newsat==(-1)*$mat[$result[$i][0]][$p]+(-1)*$mat[$result[$p][0]][$i]+$z and $mat[$result[$i][0]][$p]!=$inf and $mat[$result[$p][0]][$i]!=$inf )
				  {	  
					  $val=check($shind,$p,$i,$id,$conn,$emda3);
					  $val2=check($shind,$i,$p,$newid,$conn,$emda3);
					  if($val==true and $val2==true)
					  {	  $temp=$result[$i][0];
						  $result[$i][0]=$result[$p][0];
						  $result[$p][0]=$temp;
						  $sql3="UPDATE AssignedAt set user_id=".$newid." where assignedat_start='".$shind[$i]['shift_start']."' and assignedat_end='".$shind[$i]['shift_end']."' and assignedat_day='".$shind[$i]['shift_day']."' and  gpid=".$emda3." and assignedat_date>='".$date_sunday."' and assignedat_date<='".$date_saturday."';";
						  $res = mysqli_query($conn,$sql3);
						  $sql3="UPDATE AssignedAt set user_id=".$id." where assignedat_start='".$shind[$p]['shift_start']."' and assignedat_end='".$shind[$p]['shift_end']."' and assignedat_day='".$shind[$p]['shift_day']."' and  gpid=".$emda3." and assignedat_date>='".$date_sunday."' and assignedat_date<='".$date_saturday."';";
						  $res = mysqli_query($conn,$sql3);
					  }//end of if
					  
					  
				  }//end of if
			  }//end of for
			  
			  
			  
		  }//end of if
		  
		  
	  }//end of for
	  
	 }// end of for
	}//end of for
	}//end of function

		dupdec($users,$result,$mat,$w,$conn,$shind,$inf,$emda3);

		
		function checkdup($result,$users,$w)
		{
			for($i=0;$i<$w-1;$i=$i+1){
				if($users[$result[$i][0]]==$users[$result[$i+1][0]])
					return TRUE;
			}
			return FALSE;
		}
		
		
	
		function listcreate($result,$conn,$mat,$users,$inf,$w)
		{
			$ar=array();
		for($n=0;$n<$w;$n=$n+1)
		{
			for($z=$n+1;$z<$w;$z=$z+1)
			{
				if($mat[$result[$n][0]][$z]!=$inf and $mat[$result[$z][0]][$n]!=$inf)
				{   
					$newres=$result;
					$temp=$newres[$n][0];
					$newres[$n][0]=$newres[$z][0];
				    $newres[$z][0]=$temp;
					$ar[sizeof($ar)]=$newres;

				}
			}
		}
			return $ar;
		}
		if(checkdup($result,$users,$w)==TRUE)
		{
		
			for($r=1;$r<=3;$r=$r+1)
			{
				for($e=0;$e<70;$e=$e+1)
				{
					$newres=$result;
					for($l=1;$l<=$r;$l=$l+1)
						{
							$li=listcreate($newres,$conn,$mat,$users,$inf,$w);
							$ran=rand(0 , sizeof($li)-1);
							$newres=$li[$ran];
						}

						dupdec($users,$newres,$mat,$w,$conn,$shind,$inf,$emda3);
						if(checkdup($newres,$users,$w)==FALSE)
						{
							$result=$newres;
							break(2);
						}
				}
			}
			if(checkdup($result,$users,$w)==FALSE)
			{
				$sqld="delete from AssignedAt where gpid=".$emda3." and  assignedat_date>='".$date_sunday."' and assignedat_date<='".$date_saturday."';";
				$result2 = mysqli_query($conn,$sqld);
				for($j=0;$j<$w;$j=$j+1)
				{
				switch ($shind[$result[$j][1]]['shift_day']) 
					{
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
						 $sql1 = "INSERT INTO AssignedAt VALUES('".$shind[$result[$j][1]]['shift_start']."','".$shind[$result[$j][1]]['shift_end']."','". $date."','".$shind[$result[$j][1]]['shift_day']."',".$emda3.",".$users[$result[$j][0]].",0);";
						 $result1 = mysqli_query($conn,$sql1);

				}
				
			}
		}
			echo "<script type='text/javascript'>alert('השיבוץ נוצר בהצלחה')</script>";
			if(checkdup($result,$users,$w)==TRUE)
			{
				echo "<script type='text/javascript'>alert('בשיבוץ שנוצר נותרו כפילויות כנראה בעקבות מיעוט סיירים שהזין העדפות או אילוצי העדפות קשיחים מדי, ניתן לנסות ליצור שיבוץ חדש או לפנות לשיבוץ ידני כדי לפתור בעיה זו')</script>";
			}
			$err=0;
			for($p=0;$p<$w;$p=$p+1)
				{
				  $sat=$mat[$result[$p][0]][$result[$p][1]];
				  if ($sat==$inf)
				  {
					$err=1;
				  }
				}
			if ($err==1)
			{
				echo "<script type='text/javascript'>alert('בשיבוץ שנוצר קיים סייר ששובץ במשמרת אותה אינה יכול לבצע, כנראה בעקבות קשיחות אילוצים. ניתן להמשיך לשיבוץ ידני ולפתור בעיה זו או לנסות ליצור שיבוץ חדש')</script>";
			}
// להוסיף בדיקה לגבי המשמרת של שבת שאין רצף בין שבת לראשון
			$week=array(
					1  => "ראשון",
					2  => "שני",
					3  => "שלישי",
					4  => "רביעי",
					5  => "חמישי",
					6  => "שישי",
					7  => "שבת",
			)	;
	  
	  

	  //table creation
	  					echo ' <table class="tftable" align="center" border="1">';
						echo '<tr><th>ראשון</th><th >שני</th><th >שלישי</th><th >רביעי</th><th >חמישי</th><th >שישי</th><th>שבת</th></tr>';
						echo '<tr>';
						foreach ($week as $day){
						
								echo '<td><table align="center">';
								$sql3="select S.shift_start,S.shift_end,A.user_id,AP.Fname,AP.Lname from Shift S JOIN AssignedAt A on S.shift_start=A.assignedat_start and S.shift_end=A.assignedat_end and S.shift_day=A.assignedat_day and S.gpid=A.gpid JOIN ApprovedUser AP on AP.id=A.user_id where S.shift_day='".$day."' and A.assignedat_date>='".$date_sunday."' and A.assignedat_date<='".$date_saturday."'  and A.gpid=".$emda3." order by ord ASC;";
								$res=mysqli_query($conn,$sql3);
								$i=0;
								while( $r1=mysqli_fetch_array($res)){ 
									echo '<tr><td>'.$r1[0].'-'.$r1[1].'</td><td>'.$r1[3].' '.$r1[4].'</td></tr>';
									$i=$i+1;}
								echo '</table></td>';
						}

						echo '</tr></table>';
							


							
						// ערך מדד
						//$sum=0;
						//foreach($result as $x)
							//$sum=$sum+(-1)*$mat[$x[0]][$x[1]];	
								
						echo ' ערך המדד של השיבוץ הוא ';
							echo $sum;
						}								
	  ?>

</form>
<?php include('bottom.php'); ?>

    </body>
</html>