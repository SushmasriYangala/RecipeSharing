<!DOCTYPE html>
<html>
<head>
	<title>Recipe Card</title>
    <link rel="stylesheet" href="../CSS/search.css" />
</head>
<body>
<?php
// start session
session_start();
    require_once('connection.php');
    if (!isset($_SESSION['user_id'])) {
        header('Location: ../login.html');
         exit();
    }
  
  // Get user id from session
  $user_id = $_SESSION['user_id'];

  // Get user's favorite recipes
  $query = "SELECT recipes.* FROM recipes JOIN favorites ON recipes.recipe_id = favorites.recipe_id WHERE favorites.user_id = $user_id";
  $result = mysqli_query($conn, $query);
  if(!$result) {
    // Query error
    die("Error: " . mysqli_error($conn));
  }
  
  if(mysqli_num_rows($result) > 0) {
    // Display favorite recipes
    while($row = mysqli_fetch_assoc($result)) {
      $recipe_id = $row['recipe_id'];
        $recipe_name = $row['recipe_name'];
        $image_path = $row['image_path']; // Convert blob image to base64 string
      
        echo '<div class="recipe-card">';
        echo '<img src="'.$image_path.'" alt="'.$recipe_name.'">';
        echo '<h2>'.$recipe_name.'</h2>';
        echo '<form action="recipe_list.php" method="get">';
        echo '<input type="hidden" name="recipe_id" value="'.$recipe_id.'">';
        echo '<button type="submit">View Recipe List</button>';
        echo '</form>';
        echo '</div>';
      }
    } else {
    echo 'You have not added any recipes to your favorites list.';
  }
  ?>
  </body>
  </html>
