<?php
include("connection.php");
extract($_POST);

if (isset($_POST['signin'])) {
  $username = $_POST['username'];
  $fullname = $_POST['fullname'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $password_hash = password_hash($password, PASSWORD_DEFAULT);

  $checkQuery = "SELECT email FROM users WHERE email = '$email'";
  $checkResult = mysqli_query($conn, $checkQuery);

  $host ="localhost";
  $site ="Recipe";
  $confirmsite="/RecipeSharing/PHP/verifyemail.php";
  $myemail = "sushamsri9947@gmail.com";
  // Put together the confirmation ID:
  $now = time();
  $confirmcode = sha1("confirmation" . $now . $_POST['email']);
  if (mysqli_num_rows($checkResult) > 0) {
    // User already registered
    if (!$passwordsMatch) {
      echo "<script>window.location.href='./signin.html';</script>";
      exit;
    }
   } else {
    $sql = "INSERT INTO users (username, fullname, email, password_hash,verify)
            VALUES ('$username', '$fullname', '$email', '$password_hash','$confirmcode')";
            echo "A confirmation code has been sent. Please check your email!";

    if (mysqli_query($conn, $sql)) {
      echo "inserted";
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
}
?>
