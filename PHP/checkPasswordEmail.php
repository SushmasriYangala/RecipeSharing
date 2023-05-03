<?php
include("connection.php");
session_start();
$confirm_code = $_GET['code'];

$sql = "SELECT PasswordRecover.user_id, PasswordRecover.Verified FROM PasswordRecover JOIN users USING(user_id) WHERE confirmcode = '$confirm_code'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $user_id_db = $row['user_id'];
    $verified = $row['Verified'];
    $_SESSION['user_id'] = $user_id_db;
    $_SESSION['verified'] = $verified;

    $sql1 = "UPDATE PasswordRecover SET Verified = 1 WHERE user_id = $user_id_db";
    if (mysqli_query($conn, $sql1)) {
        header("Location: ../changepassword.html");
        exit();
    } else {
        echo "Failed to update.";
        exit;
    }
} else {
    echo "No matching record found.";
    exit;
}
?>
