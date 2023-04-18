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
		// Connect to databa
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "recipe";
        $conn = mysqli_connect($servername, $username, $password, $dbname);

        // Check connection
        if (!$conn) {
          die("Connection failed: " . mysqli_connect_error());
        }
    
        // Retrieve data from database based on user's input
        if(isset($_POST['search'])){
            $search = $_POST['search'];
            $sql = "SELECT id, recipe_name, image FROM recipe WHERE recipe_name LIKE '%$search%'";
        }else{
            $sql = "SELECT id, recipe_name, image FROM recipe";
        }
        $result = mysqli_query($conn, $sql);
    
        // Loop through results and display recipe cards with button
        while ($row = mysqli_fetch_assoc($result)) {
          $recipe_id = $row['id'];
          $recipe_name = $row['recipe_name'];
          $image = base64_encode($row['image']); // Convert blob image to base64 string
    
          echo '<div class="recipe-card">';
          echo '<img src="data:image/jpeg;base64,'.$image.'" alt="'.$recipe_name.'">';
          echo '<h2>'.$recipe_name.'</h2>';
          echo '<form action="recipe_list.php" method="get">';
          echo '<input type="hidden" name="recipe_id" value="'.$recipe_id.'">';
          echo '<button type="submit">View Recipe List</button>';
          echo '</form>';
          echo '</div>';
        }
    
        // Close database connection
        mysqli_close($conn);
    ?>
</body>
</html>    