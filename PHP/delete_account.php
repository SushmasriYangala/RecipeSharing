<?php
session_start();
require_once('connection.php');
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.html');
    exit();
}

// Retrieve user_id of the user who is deleting their account
$user_id = $_SESSION['user_id'];
$comments_user_id = $_SESSION['user_id'];

// Delete the records from the shoppinglist table where the user_id matches the user_id being deleted
$sql = "DELETE FROM shoppinglist WHERE user_id = $user_id";
if ($conn->query($sql) === TRUE) {
    echo "Shopping list records deleted successfully";
} else {
    echo "Error deleting shopping list records: " . mysqli_error($conn);
}

// Delete the records from the favorites table where the user_id matches the user_id being deleted
$sql = "DELETE FROM favorites WHERE user_id = $user_id";
if ($conn->query($sql) === TRUE) {
    echo "Favorites list records deleted successfully";
} else {
    echo "Error deleting favorites list records: " . mysqli_error($conn);
}

// Update the comments table to replace the first name with "Deleted" for the user being deleted
$sql = "UPDATE comments SET user_id = NULL, username = 'Deleted' WHERE user_id = $user_id";
if ($conn->query($sql) === TRUE) {
    echo "Comments updated successfully";
} else {
    echo "Error updating comments: " . mysqli_error($conn);
}

// Delete the comments associated with the recipes being deleted
$sql = "DELETE FROM comments WHERE recipe_id IN (SELECT recipe_id FROM recipes WHERE user_id = $user_id)";
if ($conn->query($sql) === TRUE) {
    echo "Comments deleted successfully";
} else {
    echo "Error deleting comments: " . mysqli_error($conn);
}
// Delete the records from the recipes table where the user_id matches the user_id being deleted
$sql = "DELETE FROM recipes WHERE user_id = $user_id";
if ($conn->query($sql) === TRUE) {
    echo "Recipes deleted successfully";
} else {
    echo "Error deleting recipes: " . mysqli_error($conn);
}

// Delete the user account
$sql = "DELETE FROM users WHERE user_id = $user_id";
if ($conn->query($sql) === TRUE) {
    echo "User account deleted successfully";
} else {
    echo "Error deleting user account: " . mysqli_error($conn);
}

// Unset all of the session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to the login page
header("location: ../login.html");
exit;
?>
