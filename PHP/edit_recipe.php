<?php
session_start();
require_once('connection.php');
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.html');
     exit();
}

// check if the recipe id is set
if(!isset($_GET['recipe_id'])) {
  header('Location: recipe_list.php');
  exit();
}

// get the recipe details
$recipe_id = $_GET['recipe_id'];
$sql = "SELECT * FROM recipes WHERE recipe_id = $recipe_id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

// check if the logged-in user is the owner of the recipe
if($row['user_id'] != $_SESSION['user_id']) {
  header('Location: recipe_list.php');
  exit();
}

// update the recipe details
// update the recipe details
if(isset($_POST['submit'])) {
    $recipe_name = mysqli_real_escape_string($conn, $_POST['recipe_name']);
    $ingredients = mysqli_real_escape_string($conn, $_POST['ingredients']);
    $preparation_time = mysqli_real_escape_string($conn, $_POST['preparation_time']);
    $cooking_time = mysqli_real_escape_string($conn, $_POST['cooking_time']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $tags = mysqli_real_escape_string($conn, $_POST['tags']);
    $recipe_notes = mysqli_real_escape_string($conn, $_POST['recipe_notes']);
    date_default_timezone_set("America/New_York");
    $date_and_time = date("Y-m-d H:i:s");
  
    // update the recipe image if a new image was uploaded
    if(isset($_FILES['image']) && $_FILES['image']['size'] > 0) {
        $image_name = $_FILES['image']['name'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_type = $_FILES['image']['type'];
        $image_size = $_FILES['image']['size'];
      
        // generate a unique file name to avoid conflicts with existing files
        $new_image_name = uniqid() . '-' . $image_name;
        $image_path = 'uploads/' . $new_image_name;
      
         // create the uploads directory if it doesn't exist
    if(!file_exists('uploads')) {
        mkdir('uploads');
      }
  
      // make sure that the uploads directory is writable by the web server
      if(!is_writable('uploads')) {
        echo "Error: The uploads directory is not writable.";
        exit();
      }
  
      // move the uploaded image to the desired directory on the server
      if(move_uploaded_file($image_tmp_name, $image_path)) {
        // update the image path in the database
        $sql = "UPDATE recipes SET recipe_name='$recipe_name', ingredients='$ingredients', preparation_time='$preparation_time', cooking_time='$cooking_time', description='$description', tags='$tags', date_and_time ='$date_and_time', recipe_notes='$recipe_notes', image_path='$image_path' WHERE recipe_id=$recipe_id";
      } else {
        echo "Error: Failed to upload image.";
        exit();
      }
    } else {
        // keep the old image path in the database
        $sql = "UPDATE recipes SET recipe_name='$recipe_name', ingredients='$ingredients', preparation_time='$preparation_time', cooking_time='$cooking_time', description='$description', tags='$tags', date_and_time ='$date_and_time', recipe_notes='$recipe_notes' WHERE recipe_id=$recipe_id";
      }
      
  
    // execute the SQL statement
    if(mysqli_query($conn, $sql)) {
      header("Location: recipe_list.php?recipe_id=$recipe_id");
      exit();
    } else {
      echo "Error: " . mysqli_error($conn);
    }
  }
  

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Recipe</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../CSS/add_recipe.css">
</head>
<body>
  <h1>Edit Recipe</h1>
  <form action="" method="POST" enctype="multipart/form-data">
    <label for="recipe_name">Recipe Name</label><br>
    <input type="text" id="recipe_name" name="recipe_name" value="<?php echo $row['recipe_name']; ?>"><br><br>
    <label for="ingredients">Ingredients</label><br>
    <textarea id="ingredients" name="ingredients"><?php echo $row['ingredients']; ?></textarea><br><br>
    <label for="preparation_time">Preparation Time</label><br>
    <input type="text" id="preparation_time" name="preparation_time" value="<?php echo $row['preparation_time']; ?>"><br><br>
    <label for="cooking_time">Cooking Time</label><br>
    <input type="text" id="cooking_time" name="cooking_time" value="<?php echo $row['cooking_time']; ?>"><br><br>
    <label for="description">Description</label><br>
    <textarea id="description" name="description"><?php echo $row['description']; ?></textarea><br><br>
    <label for="tags">Tags:</label>
    <input type="text" id="tags" name="tags" placeholder="Enter Tags" value="<?php echo $row['tags']; ?>"><br><br>
    <label for="recipe_notes">RecipeNotes:</label><br>
    <textarea id="recipe_notes" name="recipe_notes"><?php echo $row['recipe_notes']; ?></textarea><br><br>
    <input type="file" name="image" id="file">
    <div class="buttons">
    <button type="submit" name="submit" value="submit">Save</button>
    <button onclick="window.location.href='./Welcome.html'; return false;">Cancel</button>
    </div>
    </form>
    </div>
</body>
</html>