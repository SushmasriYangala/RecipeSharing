<?php
include("connection.php");
session_start();
$confirm_code = $_GET['code'];

$sql = "SELECT user_id FROM users WHERE verify = '$confirm_code'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $user_id_db = $row['user_id'];
    $sql1 = "UPDATE users SET Verified = 1 WHERE user_id = $user_id_db";
    if (mysqli_query($conn, $sql1)) {
        header('Location: ../login.html');
        exit;
    } else {
        echo "Failed to update.";
        exit;
    }
} 
?>
