<!DOCTYPE html>
<html>
<head>
  <title>Recipe Details</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./CSS/recipe_list.css" />
</head>
<body>
<?php
// Connect to database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "recipe";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Retrieve recipe details based on recipe_id
$recipe_id = $_GET['recipe_id'];
$sql = "SELECT * FROM recipe WHERE id = $recipe_id";
$result = mysqli_query($conn, $sql);

// Display recipe details
if (mysqli_num_rows($result) > 0) {
  $row = mysqli_fetch_assoc($result);
  $recipe_name = $row['recipe_name'];
  $ingredients = $row['ingredients'];
  $preparation_time = $row['preparation_time'];
  $cooking_time = $row['cooking_time'];
  $description = $row['description'];
  $tags = $row['tags'];
  $date_and_time = $row['date_and_time'];
  $recipe_notes = $row['recipe_notes'];
  $image = base64_encode($row['image']);

  echo '<h1>'.$recipe_name.'</h1>';

  echo '<div class="recipe-card">';
  echo '<img src="data:image/jpeg;base64,'.$image.'" alt="'.$recipe_name.'">';

  // Split ingredients by comma and create checkbox for each ingredient
  $ingredient_array = explode(",", $ingredients);
  echo '<p><strong>Ingredients:</strong><br>';
  foreach ($ingredient_array as $ingredient) {
    $ingredient = trim($ingredient); // Remove any whitespace
    $checked = ''; // Initialize checkbox as unchecked
    if (in_array($ingredient, $_POST['ingredients'] ?? [])) {
      // If the ingredient was previously checked, set the "checked" attribute
      $checked = 'checked';
    }
    echo '<input type="checkbox" name="ingredients[]" value="'.htmlspecialchars($ingredient).'" '.$checked.' onchange="updateLabelStyle(this)"><label>'.$ingredient.'</label><br>';
  }
  echo '</p>';

  echo '<p><strong>Preparation Time:</strong> '.$preparation_time.'</p>';
  echo '<p><strong>Cooking Time:</strong> '.$cooking_time.'</p>';
  echo '<p><strong>Description:</strong><br>'.$description.'</p>';
  echo '<p><strong>Tags:</strong> '.$tags.'</p>';
  echo '<p><strong>Date and Time:</strong> '.$date_and_time.'</p>';
  echo '<p><strong>Recipe Notes:</strong><br>'.$recipe_notes.'</p>';
} else {
  echo '<p>Recipe not found.</p>';
}

// Close database connection
mysqli_close($conn);
?>
<div class="recipe-details">
  <!-- Recipe details here -->
</div>

</body>
</html>

