<?php
session_start();
require_once('connection.php');
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.html');
     exit();
}

// Retrieve recipe details based on recipe_id
$recipe_id = $_GET['recipe_id'];
$sql = "SELECT * FROM recipes WHERE recipe_id = $recipe_id";
$result = mysqli_query($conn, $sql);

if ($result) {
  $row = mysqli_fetch_assoc($result);
  $user_id = $row['user_id'];

  // Check if the currently logged-in user is the owner of the recipe
  if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $user_id) {

    // Delete the records from the shoppinglist table
    $sql = "DELETE FROM shoppinglist WHERE recipe_id = $recipe_id";
    if ($conn->query($sql) === TRUE) {
        echo "Shopping list records deleted successfully";
        header("Location: shoppingdisplay.php?recipe_id=$recipe_id");
        exit();
    } else {
        echo "Error deleting shopping list records: " .  mysqli_error($conn);
    }

    } else {
    // If the currently logged-in user is not the owner of the recipe, redirect to the homepage
    header("Location: search.php");
    exit();
  }
}
?>
