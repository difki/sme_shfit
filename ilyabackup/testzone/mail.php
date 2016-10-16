
<?php
$to      = 'amirw87@gmail.com';
$subject = 'Your account have been stolen ';
$message = 'Give me your money';
$headers = 'From: YourBank' . "\r\n" .
   'X-Mailer: PHP/' . phpversion();
mail($to, $subject, $message, $headers);
?>
