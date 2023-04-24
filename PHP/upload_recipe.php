<?php
session_start();
// check if the user is logged in
if(!isset($_SESSION['user_id'])) {
  header('Location: ../login.html');
  exit();
}

include("connection.php");

// get the user id from the session
$user_id = $_SESSION['user_id'];

// check if the form is submitted
if(isset($_POST['submit'])) {
  $recipe_name = $_POST['recipe_name'];
  $ingredients = $_POST['ingredients'];
  $preparation_time = $_POST['preparation_time'];
  $cooking_time = $_POST['cooking_time'];
  $description = $_POST['description'];
  $tags = $_POST['tags'];
  $recipe_notes = $_POST['recipe_notes'];

  // store date and time
  date_default_timezone_set("America/New_York");
  $date_and_time = date("Y-m-d H:i:s");

  // Check if an image was uploaded
  if(isset($_FILES['image'])) {
    $image_name = $_FILES['image']['name'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_size = $_FILES['image']['size'];
    $image_error = $_FILES['image']['error'];
    $image_ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));

    $allowed_exts = array('jpg', 'jpeg', 'png', 'gif');

    // Check if the file is a valid image
    if(in_array($image_ext, $allowed_exts)) {
      // Check if there was no error uploading the image
      if($image_error === 0) {
        // Generate a unique file name for the image
        $image_new_name = uniqid('', true) . "." . $image_ext;
        $image_dest_path = "../uploads/" . $image_new_name;

        // Move the image to the file system
        if(move_uploaded_file($image_tmp_name, $image_dest_path)) {
          // prepare the SQL statement
          $stmt = mysqli_prepare($conn, "INSERT INTO recipes (user_id, image_path, recipe_name, ingredients, preparation_time, cooking_time, description, tags, date_and_time, recipe_notes) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
          mysqli_stmt_bind_param($stmt, "isssssssss", $user_id, $image_dest_path, $recipe_name, $ingredients, $preparation_time, $cooking_time, $description, $tags, $date_and_time, $recipe_notes);

          if(mysqli_stmt_execute($stmt)){
            header("Location: ../Welcome.html");
            exit();
          } else {
            echo "Error uploading recipe: " . mysqli_stmt_error($stmt);
          }

          mysqli_stmt_close($stmt);
        } else {
          echo "Error moving image to file system.";
        }
      } else {
        echo "Error uploading image: " . $image_error;
      }
    } else {
      echo "Invalid file type. Only JPG, JPEG, PNG, and GIF files are allowed.";
    }
  } else {
    echo "No image was uploaded.";
  }
}
?>
