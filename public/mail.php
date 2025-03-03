<html>
   
   <head>
      <title>Sending HTML email using PHP</title>
   </head>
   
   <body>
      
      <?php
    $to      = 'swap.taranjit@gmail.com';
    $subject = 'the subject';
    $message = 'hello';
    $headers = 'From: website@peterpharoah.com'       . "\r\n" .
                 'Reply-To: swap.taranjit@gmail.com' . "\r\n" .
                 'X-Mailer: PHP/' . phpversion();

    mail($to, $subject, $message, $headers);
?>

      
   </body>
</html>