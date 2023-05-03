<!DOCTYPE html>
<html>
    <head>
        <title>Categories</title>
        <link rel="stylesheet" href="../CSS/category.css">
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
    ?>
        <form action="category_list.php" method="POST">
            <div class="recipe-card">
                <img src="../categories/indianfood.jpg" alt="'.$recipe_name.'">
                    <input type="hidden" name="recipe_id" value="'.$recipe_id.'">
                    <button type="submit" name="tags" value="indian">Indian</button>
            </div>
            <div class="recipe-card">
                <img src="../categories/soup.jpg" alt="'.$recipe_name.'">
                    <input type="hidden" name="recipe_id" value="'.$recipe_id.'">
                    <button type="submit" name="tags" value="soup">Soup</button>
            </div>
            <div class="recipe-card">
                <img src="../categories/Cookies.jpg" alt="'.$recipe_name.'">
                    <input type="hidden" name="recipe_id" value="'.$recipe_id.'">
                    <button type="submit" name="tags" value="cookie">Cookie</button>
            </div>
            <div class="recipe-card">
                <img src="../categories/pizza.jpg" alt="'.$recipe_name.'">
                    <input type="hidden" name="recipe_id" value="'.$recipe_id.'">
                    <button type="submit" name="tags" value="pizza">Pizza</button>
            </div>
            <div class="recipe-card">
                <img src="../categories/pasta.jpg" alt="'.$recipe_name.'">
                    <input type="hidden" name="recipe_id" value="'.$recipe_id.'">
                    <button type="submit" name="tags" value="pasta">Pasta</button>
            </div>
            <div class="recipe-card">
                <img src="../categories/icecream.jpg" alt="'.$recipe_name.'">
                    <input type="hidden" name="recipe_id" value="'.$recipe_id.'">
                    <button type="submit" name="tags" value="icecream">IceCream</button>
            </div>
            <div class="recipe-card">
                <img src="../categories/cake.jpg" alt="'.$recipe_name.'">
                    <input type="hidden" name="recipe_id" value="'.$recipe_id.'">
                    <button type="submit" name="tags" value="cake">Cake</button>
            </div>
            <div class="recipe-card">
                <img src="../categories/drinks.jpg" alt="'.$recipe_name.'">
                    <input type="hidden" name="recipe_id" value="'.$recipe_id.'">
                    <button type="submit" name="tags" value="drinks">Drinks</button>
            </div>

            <div class="recipe-card">
                <img src="../categories/chicken.jpg" alt="'.$recipe_name.'">
                    <input type="hidden" name="recipe_id" value="'.$recipe_id.'">
                    <button type="submit" name="tags" value="chicken">Chicken</button>
            </div>
            <div class="recipe-card">
                <img src="../categories/Sandwich.jpg" alt="'.$recipe_name.'">
                    <input type="hidden" name="recipe_id" value="'.$recipe_id.'">
                    <button type="submit" name="tags" value="sandwich">Sandwich</button>
            </div>
            <div class="recipe-card">
                <img src="../categories/roti.jpg" alt="'.$recipe_name.'">
                    <input type="hidden" name="recipe_id" value="'.$recipe_id.'">
                    <button type="submit" name="tags" value="roti">Roti</button>
            </div>
            <div class="recipe-card">
                <img src="../categories/smoothies.jpg" alt="'.$recipe_name.'">
                    <input type="hidden" name="recipe_id" value="'.$recipe_id.'">
                    <button type="submit" name="tags" value="smoothies">Smoothies</button>
            </div>
            <div class="recipe-card">
                <img src="../categories/vegetarian.jpg" alt="'.$recipe_name.'">
                    <input type="hidden" name="recipe_id" value="'.$recipe_id.'">
                    <button type="submit" name="tags" value="vegetarian">Vegetarian</button>
            </div>
        </form>
    </body>
</html>