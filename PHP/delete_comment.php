<?php
session_start();
require_once('connection.php');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.html');
    exit();
}

$recipe_id = $_GET['recipe_id'];
$sql = "SELECT * FROM comments WHERE recipe_id = $recipe_id";
$result = mysqli_query($conn, $sql);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $user_id = $row['user_id'];
    if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $user_id) {

        // Delete the records from the shoppinglist table
        $comment_id = $_GET['comment_id'];
  
        // Delete the comment with the specified comment_id
        $sql = "DELETE FROM comments WHERE comment_id = $comment_id";
        $result = mysqli_query($conn, $sql);

        // Redirect to recipe list page
        if($result) {
            header("Location: recipe_list.php?recipe_id=$recipe_id");
            exit();
          } else {
            echo "Error: " . mysqli_error($conn);
          }
    } 
}
?>
