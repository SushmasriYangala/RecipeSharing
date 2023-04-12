<?php
include("connection.php");
extract($_POST);
if(isset($_POST['login']))
{
$email = $_POST['email'];
$password = $_POST['password'];
$sql = "SELECT * FROM users WHERE email='$email'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
if (password_verify($password, $row['password_hash'])) {
  $_SESSION['user'] = $row['username'];
  header('Location: ../Welcome.html');
  exit;
} else {
  header('Location: ../login.html');
  exit;
}
}
?>
