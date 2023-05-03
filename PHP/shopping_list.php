<!DOCTYPE html>
<html lang="en">

<head>
    <title>Shopping List</title>
    <link rel="stylesheet" href="../CSS/search.css" />
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" type="text/css" href="../CSS/back-home.css">
</head>
<body>
  <?php
require_once('home-back.php');
?>
<script>
function updateLabelStyle(checkbox) {
  var label = checkbox.nextElementSibling; // Get the label element
  if (checkbox.checked) {
    label.style.textDecoration = 'line-through'; // Add strikeout effect
  } else {
    label.style.textDecoration = 'none'; // Remove strikeout effect
  }
}
</script>
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
$query = "SELECT recipes.* FROM recipes JOIN shoppinglist ON recipes.recipe_id = shoppinglist.recipe_id WHERE shoppinglist.user_id = $user_id";
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
        echo '<form action="shoppingdisplay.php" method="get">';
        echo '<input type="hidden" name="recipe_id" value="'.$recipe_id.'">';
        echo '<button type="submit">View Shopping List</button>';
        echo '</form>';
        echo '</div>';
      }
    } else {
    echo 'You have not added any recipes to your Shopping list.';
  }
  ?>

</body>

</html>