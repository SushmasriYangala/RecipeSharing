<?php
session_start();
require_once('connection.php');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
  header('Location: ../login.html');
  exit();
}

// Get the comment ID and recipe ID
$comment_user_id = $_GET['comment_id'];
$recipe_user_id = $_GET['recipe_id'];

// Check if the logged-in user is the owner of the comment
$sql = "SELECT user_id FROM comments WHERE comment_id = '$comment_user_id'";
$result = mysqli_query($conn, $sql);

// Delete the comment
$sql = "DELETE FROM comments WHERE comment_id = '$comment_user_id' AND recipe_id = '$recipe_user_id'";
$result = mysqli_query($conn, $sql);

// Redirect back to the recipe page
header("Location: recipe_list.php?recipe_id=$recipe_user_id");
exit();
