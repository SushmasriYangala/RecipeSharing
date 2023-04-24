<?php
session_start();
require_once('connection.php');

if (!isset($_SESSION['user_id'])) {
  header('Location: ../login.html');
  exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $recipe_id = $_POST['recipe_id'];
  $comment_text = $_POST['comment_text'];

  // Sanitize the comment text
  $comment_text = mysqli_real_escape_string($conn, $comment_text);

  // Insert the new comment into the database
  $user_id = $_SESSION['user_id'];
  $date_and_time = date('Y-m-d H:i:s');
  $sql = "INSERT INTO comments (recipe_id, user_id, comment_text, date_and_time) VALUES ($recipe_id, $user_id, '$comment_text', '$date_and_time')";
  $result = mysqli_query($conn, $sql);
  if (!$result) {
    die('Error: ' . mysqli_error($conn));
  }

  // Redirect to the recipe page with the comment section refreshed
  header("Location: recipe_list.php?recipe_id=$recipe_id");
  exit();
}
?>
