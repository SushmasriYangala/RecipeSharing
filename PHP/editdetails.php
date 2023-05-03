<?php
include("connection.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $fullname = $_POST['fullname'];

    // Retrieve the user ID from the session or any other method you are using to identify the user
    $userId = $_SESSION['user_id'];

    // Check if the fields are empty
    if (empty($username) && empty($fullname)) {
        // Redirect to profile.php
        header("Location: profile.php");
        exit();
    }

   // Check if either username or fullname is provided
   if (!empty($username) || !empty($fullname)) {
    // Build the SQL query dynamically based on the provided values
    $sql = "UPDATE users SET";
    $updates = array();

    if (!empty($username)) {
        $updates[] = " username = '$username'";
    }

    if (!empty($fullname)) {
        $updates[] = " fullname = '$fullname'";
    }

    $sql .= implode(",", $updates);
    $sql .= " WHERE user_id = $userId";

    // Execute the query
    if (mysqli_query($conn, $sql)) {
        header('Location: ./profile.php');
        exit;
    } else {
        echo "Error: Failed to update values.";
        exit;
    }
} else {
    echo "Error: No values provided.";
    exit;
}
}
?>