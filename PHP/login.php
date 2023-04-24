<?php
session_start();
require_once("connection.php");
if (isset($_POST['login'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];

  $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password_hash'])) {
      $_SESSION['user_id'] = $row['user_id'];
      header('Location: ../Welcome.html');
      exit;
    }
  }
  header('Location: ../login.html');
  exit;
}
?>
