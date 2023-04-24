<?php
// start session
session_start();
require_once("connection.php");
// check if user is logged in
if (!isset($_SESSION['user_id'])) {
  // redirect to login page
  header('Location: login.php');
  exit();
}

// get recipe id
$recipe_id = $_POST['recipe_id'];

// get user id from session
$user_id = $_SESSION['user_id'];

// check if recipe is already in favorites
$query = "SELECT * FROM favorites WHERE user_id = $user_id AND recipe_id = $recipe_id";
$result = mysqli_query($conn, $query);
if (!$result) {
  // Query error
  die("Error: " . mysqli_error($conn));
}

if (mysqli_num_rows($result) > 0) {
  // Recipe is already in favorites
  header('Location: favourite.php');
  exit();
}

// add recipe to favorites
$query = "INSERT INTO favorites (user_id, recipe_id) VALUES ($user_id, $recipe_id)";
$result = mysqli_query($conn, $query);
if ($result) {
  echo 'Recipe has been added to your favorites list.';
} else {
  echo 'Error adding recipe to favorites.';
}
header('Location: favourite.php');
?>