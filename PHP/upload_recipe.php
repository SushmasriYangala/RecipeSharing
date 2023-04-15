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
    $recipe_notes = $_POST['recipe_notes'];

    
    if (isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {
        $allowedTypes = ["image/jpeg", "image/png", "image/gif"];
        $allowedSize = 500000; // 500KB
        
        // Check file type and size
        $fileType = $_FILES["file"]["type"];
        $fileSize = $_FILES["file"]["size"];
        if (in_array($fileType, $allowedTypes) && $fileSize <= $allowedSize) {
            // Create directory if it doesn't exist
            if (!file_exists("../uploads")) {
                mkdir("../uploads");
            }
            
            // Generate unique filename and move file to uploads directory
            $fileName = uniqid() . "_" . $_FILES["file"]["name"];
            $filePath = "../uploads/" . $fileName;
            move_uploaded_file($_FILES["file"]["tmp_name"], $filePath);
            
            echo "File uploaded successfully!";
        } else {
            echo "Invalid file type or size.";
        }
    } else {
        echo "Error uploading file.";
    }
        
    // Store date and time
    date_default_timezone_set("America/New_York");
    $date_and_time = date("Y-m-d H:i:s");

    // Prepare the statement
    $stmt = mysqli_prepare($conn, "INSERT INTO recipe_details (recipe_name, ingredients, preparation_time, cooking_time, description, tags, date_and_time, recipe_notes) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    
    // Bind parameters to the statement
    mysqli_stmt_bind_param($stmt, "ssssssss", $recipe_name, $ingredients, $preparation_time, $cooking_time, $description, $tags, $date_and_time, $recipe_notes);
    
    // Execute the statement
    if(mysqli_stmt_execute($stmt)) {
        echo "Recipe uploaded successfully!";
    } else {
        echo "Error uploading recipe: " . mysqli_error($conn);
    }

    // Close the statement and connection
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>
