
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

// Retrieve image data from database
$sql = "SELECT image FROM recipes WHERE recipe_id = 1"; // Change the recipe_id to the ID of the image you want to check
$result = mysqli_query($conn, $sql);

if ($result) {
    // Get the image data as a string
    $row = mysqli_fetch_assoc($result);
    $image_data = $row['image'];
    
    // Decode the image data using base64
    $decoded_data = base64_decode($image_data);
    
    // Save the decoded data to a file with the correct image extension
    $file_path = 'image.jpeg'; // Change the file name and extension to match the actual image type
    file_put_contents($file_path, $decoded_data);
    
    // Check if the file is a valid image
    if (getimagesize($file_path)) {
        echo "The image is not corrupted.";
    } else {
        echo "The image is corrupted or in an unsupported format.";
    }
} else {
    echo "Error: " . mysqli_error($conn);
}

// Close database connection
mysqli_close($conn);
?>