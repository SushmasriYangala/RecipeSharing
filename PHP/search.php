<!DOCTYPE html>
<html>
<head>
	<title>Recipe Card</title>
    <link rel="stylesheet" href="../CSS/search.css" />
</head>
<body>
	<form action="" method="post">
		<input type="text" name="search" id="search" placeholder="search here....">
		<button type="submit">Search</button>
	</form>
	<?php
   session_start();
require_once("connection.php");
   // Check if user is logged in
   if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.html');
     exit();
   }
		    
        // Retrieve data from database based on user's input
        if(isset($_POST['search'])){
            $search = $_POST['search'];
            $sql = "SELECT recipe_id, recipe_name, image_path FROM recipes WHERE recipe_name LIKE '%$search%'";
        }else{
            $sql = "SELECT recipe_id, recipe_name, image_path FROM recipes";
        }
        $result = mysqli_query($conn, $sql);
        if ($result) {
        // Loop through results and display recipe cards with button
        while ($row = mysqli_fetch_assoc($result)) {
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
        echo "Error: " . mysqli_error($conn);
      }
        // Close database connection
        mysqli_close($conn);
    ?>
</body>
</html>    