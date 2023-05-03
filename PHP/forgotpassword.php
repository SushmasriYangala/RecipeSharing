<?php
include("connection.php");
extract($_POST);
  $email = $_POST['email'];

  $checkQuery = "SELECT * FROM users WHERE email = '$email'";
  $checkResult = mysqli_query($conn, $checkQuery);

  $host ="localhost";
  $site ="Recipe";
  $confirmsite="/Practice/PHP/checkPasswordEmail.php";
  $myemail = "sushamsri9947@gmail.com";
  // Put together the confirmation ID:
  $now = time();
  $confirmcode = sha1("confirmation" . $now . $_POST['email']);
  if (mysqli_num_rows($checkResult) > 0) {
    $row = mysqli_fetch_assoc($checkResult);
    $user_id = $row['user_id']; 
    $sql = "INSERT INTO PasswordRecover (user_id, email,confirmcode)
            VALUES ('$user_id','$email','$confirmcode')";
            echo "A confirmation code has been sent. Please check your email!";

    if (mysqli_query($conn, $sql)) {
      echo "send";
    } else {
      echo "no";
    }
  }
  // put together the email:
$to      = $_POST['email'];
$subject = "$site: Verify Your New Account";
$headers = "From: $myemail \r\n" .
           "Reply-To: $myemail \r\n" .
           'X-Mailer: PHP/' . phpversion() ;
$message = "Welcome to $site!\r\n\r\n" .
           "To confirm your username, please click this link:\r\n\r\n" .
           "http://$host$confirmsite?code=$confirmcode \r\n" .
           "(If you did not register at $site, \r\n" .
           "just ignore this message.)\r\n";

mail($to, $subject, $message, $headers);

  mysqli_close($conn);
?>
