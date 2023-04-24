<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width-device-width,initial-scale=1.0">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/fontawesome.css">
  <link rel="stylesheet" type="text/css" href="../CSS/recipe_list.css">
  <title>Recipes</title>
</head>

<body>
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
    $recipe_name = $row['recipe_name'];
    $ingredients = $row['ingredients'];
    $preparation_time = $row['preparation_time'];
    $cooking_time = $row['cooking_time'];
    $description = $row['description'];
    $tags = $row['tags'];
    $date_and_time = $row['date_and_time'];
    $recipe_notes = $row['recipe_notes'];
    $image_path = $row['image_path'];
    $user_id = $row['user_id'];
    echo '<div id="card-container">';
    echo '<div id="card-title">' . $recipe_name . '</div>';
    echo '<div id="recipe-image"><img src="' . $image_path . '" alt="' . $recipe_name . '"></div>'; // Add the base64-encoded image to the <img> tag
    echo '<div id="details">Prep time: <span class="detail-value">' . $preparation_time . ' </span> | Cook time: <span class="detail-value">' . $cooking_time . ' </span></div>';
    echo '<div id="details">Notes: <span class="detail-value">' . $recipe_notes . ' </span></div>';
    echo '<div id="card-items">';
    echo '<span class="card-item-title">Ingredients</span>';
    echo '<ul class="checkmark">';
    $ingredient_list = explode("\n", $ingredients);
    foreach ($ingredient_list as $ingredient) {
      echo '<li>' . $ingredient . '</li>';
    }
    echo '</ul>';
    echo '</div>';
    echo '<div id="method">';
    echo '<span class="card-item-title">Method</span>';
    echo '<ol>';
    $step_list = explode("\n", $description);
    foreach ($step_list as $step) {
      echo '<li>' . $step . '</li>';
    }
    echo '</ol>';
    echo '</div>';
    echo '<div id="card-items">';
    echo '<div class="button-container">';
    echo '<form action="add_to_shoppinglist.php" method="POST">';
    echo '<input type="hidden" name="recipe_id" value="' . $recipe_id . '">';
    echo '<button type="submit" name="add_to_list">Add to Shopping List</button>';
    echo '</form>';
    echo '<form action="add_favorites.php" method="POST">';
    echo '<input type="hidden" name="recipe_id" value="' . $recipe_id . '">';
    echo '<button type="submit" name="add_to_list">Add to Favourites</button>';
    echo '</form>';    
    echo '</div>'; 
    // Check if the currently logged-in user is the owner of the recipe
    if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $user_id) {
      // Display edit and delete options
      echo '<div id="edit-delete-container">';
      echo '<a class ="edit" href="edit_recipe.php?recipe_id=' . $recipe_id . '">Edit the Recipe</a><br>';
      echo '<a class = "delete" href="delete_recipe.php?recipe_id=' . $recipe_id . '">Delete the Recipe</a>';
      echo '</div>';
    }
      
    echo '</div>';

  // Fetch comments from the database
  $sql = "SELECT * FROM comments WHERE recipe_id = $recipe_id ORDER BY date_and_time DESC";
  $result = mysqli_query($conn, $sql);
  if ($result) {
    
  // Display comment form if the user is logged in
  if (isset($_SESSION['user_id'])) {
  echo '<h3>Comments</h3>';
    echo '<form action="add_comment.php" method="POST">';
    echo '<input type="hidden" name="recipe_id" value="' . $recipe_id . '">';
    echo '<textarea name="comment_text" placeholder="Add a comment"></textarea>';
    echo '<button type="submit" name="submit_comment">Submit</button>';
    echo '</form>';
  }
    while ($row = mysqli_fetch_assoc($result)) {
      $comment_id = $row['comment_id'];
      $comment_text = $row['comment_text'];
      $date_and_time = $row['date_and_time'];
      $user_id = $row['user_id'];
      
      // Fetch the username of the user who posted the comment
      $sql2 = "SELECT firstname FROM users WHERE user_id = $user_id";
      $result2 = mysqli_query($conn, $sql2);
      if ($result2) {
        $row2 = mysqli_fetch_assoc($result2);
        $username = $row2['firstname'];
      } else {
        $username = 'Unknown user';
      }
      date_default_timezone_set("America/New_York");
      $date_and_time = date("Y-m-d H:i:s");
      // Display the comment
      echo '<div class="comment">';
      echo '<div class="comment-header">' . $username . ' <span class="comment-date">' . $date_and_time . '</span></div>';
      echo '<div class="comment-text">' . $comment_text ;
      if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $user_id) {
        // Display delete link if the currently logged-in user is the owner of the comment
        echo '<a class = "delete_comment" href="delete_comment.php?recipe_id=' . $recipe_id . '&comment_id=' . $comment_id . '" onclick="return confirm(\'Are you sure you want to delete this recipe?\')">Delete</a>';
      }
      echo '</div>';
      echo '</div>';
    }
  }
  } else {
    echo 'No comments yet.';
  }
  
  ?>

</body>

</html>