<!DOCTYPE html>
<html>
<head>
	<title>Recipe Card</title>
    <link rel="stylesheet" href="../CSS/search.css" />
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" type="text/css" href="../CSS/back-home.css">
</head>
<body>
  <?php
  
require_once('home-back.php');
?>
	<form action="" method="post">
		<input type="text" name="search" id="search" placeholder="search here....">
		<button type="submit">Search</button>
    <button type="submit" onclick="window.location.href='../add_recipe.html'; return false;">Add New Recipe</button>
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
          $sql = "SELECT r.recipe_id, r.recipe_name, r.image_path, u.username
                  FROM recipes r
                  INNER JOIN users u ON r.user_id = u.user_id
                  WHERE r.recipe_name LIKE '%$search%'";
      } else {
          $sql = "SELECT r.recipe_id, r.recipe_name, r.image_path, u.username
                  FROM recipes r
                  INNER JOIN users u ON r.user_id = u.user_id";
      }
        
        $result = mysqli_query($conn, $sql);
        if ($result) {
        // Loop through results and display recipe cards with button
        while ($row = mysqli_fetch_assoc($result)) {
          $recipe_id = $row['recipe_id'];
          $recipe_name = $row['recipe_name'];
          $image_path = $row['image_path'];
          $username = $row['username'];
  
          echo '<div class="recipe-card">';
          echo '<img src="'.$image_path.'" alt="'.$recipe_name.'">';
          echo '<h2>'.$recipe_name.'</h2>';
          echo '<h2><i class="bx bxs-user"></i>'.$username.'</h2>';
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