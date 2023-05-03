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
<?php
    session_start();
    require_once('connection.php');
    if (!isset($_SESSION['user_id'])) {
        header('Location: ../login.html');
         exit();
    }
    if(isset($_POST['tags'])) {
        $category = $_POST['tags'];
        $sql = "SELECT * FROM recipes WHERE tags LIKE '%$category%'";
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
      } 
    }
        // Close database connection
        mysqli_close($conn);
    ?>
    </body>
</html>