<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width-device-width,initial-scale=1.0">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/fontawesome.css">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" type="text/css" href="../CSS/recipe_list.css">
  <link rel="stylesheet" type="text/css" href="../CSS/back-home.css">
  <title>Recipes</title>
</head>

<body>

  <?php
  session_start();
  require_once('connection.php');
  require_once('home-back.php');
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
    $recipe_user_id = $row['user_id'];
    // Retrieve the user's first name from the users table
  $user_sql = "SELECT username FROM users WHERE user_id = $recipe_user_id";
  $user_result = mysqli_query($conn, $user_sql);
  if ($user_result && mysqli_num_rows($user_result) > 0) {
    $user_row = mysqli_fetch_assoc($user_result);
    $username = $user_row['username'];
  }
    echo '<div id="card-container">';
    echo '<div id="card-title">' . $recipe_name . '</div>';
    echo '<div id="recipe-image"><img src="' . $image_path . '" alt="' . $recipe_name . '"></div>'; // Add the base64-encoded image to the <img> tag
    echo '<div id="card-title-time"> <i class="bx bxs-user"></i>Uploaded by:  <span class="detail-value-time">' . $username . '</div>';
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
    echo '<div id="card-title-time">Date and Time of Upload:  <span class="detail-value-time">' . $date_and_time . '</span></div>';
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
    if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $recipe_user_id) {
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
      $comment_user_id = $row['user_id'];
      $username = $row['username'];
      $recipes = $row['recipe_id'];

      // Display the comment
      echo '<div class="comment">';
      echo '<div class="comment-header">' . $username . ' <span class="comment-date">' . $date_and_time . '</span></div>';
      echo '<div class="comment-text">' . $comment_text ;
      if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $comment_user_id || $_SESSION['user_id'] == $recipe_user_id) {
        // Display delete link if the currently logged-in user is the owner of the comment
        echo '<form action="" method="POST">';
        echo '<input type="hidden" name="comment_id" value="' . $comment_id . '">'; 
        echo '<a class = "delete_comment" href="delete_comment.php?recipe_id=' . $recipe_id . '&comment_id=' . $comment_id . '" onclick="return confirm(\'Are you sure you want to delete this recipe?\')">Delete</a>';
        echo '</form>';
      }
      echo '</div>';
      echo '</div>';
    }
  }
  } else {
    echo 'No comments yet.';
  }
  
  ?>
<!-- Copy link button -->
<button onclick="copyToClipboard()"><i class='bx bx-copy-alt' ></i>Copy link</button>

<!-- Social media shareable link -->
<a class ="edit" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode('https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>" target="_blank"><i class='bx bxl-facebook-circle' ></i>Share on Facebook</a>
<a class ="edit" href="https://twitter.com/intent/tweet?url=<?php echo urlencode('https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>" target="_blank"><i class='bx bxl-twitter'></i>Share on Twitter</a>
<a class ="edit" href="https://www.instagram.com/?url=<?php echo urlencode('https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>" target="_blank"><i class='bx bxl-instagram' ></i>Share on Instagram</a>



<script>
  function copyToClipboard() {
    var text = window.location.href;
    navigator.clipboard.writeText(text).then(function() {
      alert("Link copied to clipboard");
    }, function() {
      alert("Failed to copy link");
    });
  }
</script>

</body>

</html>