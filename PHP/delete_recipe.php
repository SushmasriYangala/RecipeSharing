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
    } else {
        echo "Error deleting shopping list records: " .  mysqli_error($conn);
    }

    // Delete the records from the shoppinglist table
    $sql = "DELETE FROM favorites WHERE recipe_id = $recipe_id";
    if ($conn->query($sql) === TRUE) {
        echo "favorites list records deleted successfully";
    } else {
        echo "Error deleting favorites list records: " . mysqli_error($conn);
    }

    // Delete the records from the shoppinglist table
    $sql = "DELETE FROM comments WHERE recipe_id = $recipe_id";
    if ($conn->query($sql) === TRUE) {
        echo "comments list records deleted successfully";
    } else {
        echo "Error deleting comments list records: " . mysqli_error($conn);
    }
    
    // Delete the record from the recipes table
    $sql = "DELETE FROM recipes WHERE recipe_id = $recipe_id";
    if ($conn->query($sql) === TRUE) {
        echo "Recipe deleted successfully";

        // Delete the image file from the file system
        $image_path = $row['image_path'];
        if (file_exists($image_path)) {
          if (unlink($image_path)) {
            echo "Recipe image deleted successfully";
          } else {
            echo "Error deleting recipe image";
          }
        }
        // Redirect to the search page after the deletion is completed
        header("Location: search.php");
        exit();
    } else {
        echo "Error deleting recipe: " . mysqli_error($conn);
    }
  } else {
    // If the currently logged-in user is not the owner of the recipe, redirect to the homepage
    header("Location: search.php");
    exit();
  }
}
?>
