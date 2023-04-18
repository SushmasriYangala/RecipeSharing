<?php
include("connection.php");
extract($_POST);
if(isset($_POST['submit'])) {
    $recipe_name = $_POST['recipe_name'];
    $ingredients = $_POST['ingredients'];
    $preparation_time = $_POST['preparation_time'];
    $cooking_time = $_POST['cooking_time'];
    $description = $_POST['description'];
    $tags = $_POST['tags'];
    $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
    
    // Store date and time
    date_default_timezone_set("America/New_York");
    $date_and_time = date("Y-m-d H:i:s");

    // Prepare the statement
    $sql = "INSERT INTO recipe (image, recipe_name, ingredients, preparation_time, cooking_time, description, tags, date_and_time, recipe_notes) VALUES('$image', '$recipe_name','$ingredients', '$preparation_time', '$cooking_time', '$description', '$tags', '$date_and_time', '$recipe_notes')";

    if(mysqli_query($conn, $sql)){
        echo "Recipe uploaded successfully.";
      } else {
        echo "Error uploading image: " . mysqli_error($conn);
      }

}
?>