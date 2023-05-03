<!DOCTYPE html>
<html>
<head>
  <title>Profile Page</title>
  
  <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" type="text/css" href="../CSS/back-home.css">
  <link rel="stylesheet" type="text/css" href="../CSS/profile.css">
</head>
<body> 
<?php
session_start();
require_once("connection.php");

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.html');
    exit();
}
require_once('home-back.php');
?>
	<header>
		<h1>My Profile</h1>
	</header>

	<section>
		<h2>Profile Information</h2>
    <?php
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT * FROM users WHERE user_id = $user_id";
  $result = mysqli_query($conn, $sql);
  if ($result) {
    $row = mysqli_fetch_assoc($result);
    $username = $row['username'];
    $email = $row['email'];
  }
    ?>
		<p><strong>Username:</strong><?php echo  $username; ?></p>
		<p><strong>Email:</strong><?php echo  $email; ?></p>
		<div class="buttons-wrapper">
			<button onclick="window.location.href='../editdetails.html'; return false;">Edit Username</button>
			<button onclick="window.location.href='../updatepassword.html'; return false;">Update Password</button>
			<button class="delete-account" onclick="window.location.href='./delete_account.php'; return false;">Delete Account</button>
		</div>
	</section>

	<footer>
		<p>&copy; 2023 Recipe Sharing</p>
	</footer>
</body>
</html>