<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>About Us - Recipe Sharing</title>
    <link rel="stylesheet" href="../CSS/aboutus.css" />
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" type="text/css" href="../CSS/back-home.css">
    </head>
  <body>
  <?php
session_start();
require_once("connection.php");

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.html');
    exit();
}
require_once('home-back.php');
?>
    <header class="header">
      <h1>About Us</h1>
    </header>

    <section class="about-section">
  <div class="container">
    <p>
      Welcome to Recipe Sharing, a platform dedicated to food enthusiasts around the world. We believe that cooking is not just about preparing food, it's 	about expressing yourself and sharing your passion with others. Our mission is to bring people together through food by providing a platform where 	anyone can share their favorite recipes, cooking tips, and experiences. Whether you're a seasoned chef or a beginner, Recipe Sharing has something for 	everyone. Our community-driven platform is designed to make it easy for you to share your recipes and discover new ones. Browse through our collection 	of recipes, which range from classic dishes to creative takes on old favorites.
    </p>
    <p>
	At Recipe Sharing, we value diversity and inclusion. We want to provide a welcoming and safe space for everyone to share their love of food. Our team 	is constantly working to improve the platform and provide new features to enhance your experience.
    </p>
    <p>
	If you have any suggestions or feedback, please don't hesitate to contact us. We are always looking for ways to improve and make Recipe Sharing the 	best it can be. Thank you for being a part of our community!
    </p>
    <div class="contact-info">
	<h3>Contact Us:</h3>
      <p>
        Phone: +1-856-328-2706 <br />
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;+1-267-570-6440 <br/>
        Email: lahariravva1999@gmail.com <br/>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;sushmasri9947@gmail.com
		   
      </p>
    </div>
  </div>
</section>
<footer class="footer">
  <div class="container">
    <p>&copy; 2023 Recipe Sharing</p>
  </div>
</footer>
</body>
</html>
