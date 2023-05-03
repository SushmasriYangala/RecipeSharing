<!DOCTYPE html>
<html lang="en">

<head>
    <title>Shopping List</title>
    <link rel="stylesheet" href="../CSS/shoppingdisplay.css" />
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

  // Retrieve recipe details based on recipe_id
  $recipe_id = $_GET['recipe_id'];
  $sql = "SELECT recipes.* FROM recipes JOIN shoppinglist ON recipes.recipe_id = shoppinglist.recipe_id WHERE shoppinglist.recipe_id = $recipe_id";
    $result = mysqli_query($conn, $sql);

  // Display recipe details
  if ($row = mysqli_fetch_assoc($result)) {
    $recipe_name = $row['recipe_name'];
    $ingredients = $row['ingredients'];
    $image_path = $row['image_path'];

    echo '<h1>'.$recipe_name.'</h1>';
  
    echo '<div class="recipe-card">';
    echo '<img src="'.$image_path.'" alt="'.$recipe_name.'">';
  
    // Split ingredients by comma and create checkbox for each ingredient
    $ingredient_array = explode("\n", $ingredients);
    echo '<p><strong>Ingredients:</strong><br>';
    foreach ($ingredient_array as $ingredient) {
      $ingredient = trim($ingredient); // Remove any whitespace
      $checked = ''; // Initialize checkbox as unchecked
      if (in_array($ingredient, $_POST['ingredients'] ?? [])) {
        // If the ingredient was previously checked, set the "checked" attribute
        $checked = 'checked';
      }
      echo '<input type="checkbox" id="my-checkbox" name="ingredients[]" value="'.htmlspecialchars($ingredient).'" '.$checked.' onchange="updateLabelStyle(this)"><label id="my-label">'.$ingredient.'</label><br>';
    }
    echo '</p>';
    echo '</div>';
  }
// Close database connection
mysqli_close($conn);
?>

</body>

</html>