<?php
include("connection.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmpassword'];

    // Validate password and confirm password
    if ($password != $confirmPassword) {
        echo "Error: Passwords do not match.";
        exit;
    }

    // Retrieve the user ID from the session or any other method you are using to identify the user
    $userId = $_SESSION['user_id'];

    // Hash the password for security
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Update the user's password in the database
    $sql = "UPDATE users SET password_hash = '$hashedPassword' WHERE user_id = $userId";
    if (mysqli_query($conn, $sql)) {
        header('Location: ../login.html');
        exit;
    } else {
        header('Location: ../changepassword.html');
        exit;
    }
}
?>
