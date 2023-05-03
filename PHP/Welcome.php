<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/Welcome.css">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <form action="./PHP/Welcome.php">
        <header class="header">
            <h1 class="logo">Recipe Sharing</h1>
        </header>
        <nav class="sidebar close">
            <header>
                <div class="image-text">
                    <span class="image">
                    </span>

                    <div class="text logo-text">
                        <span class="name">Menu</span>
                    </div>
                </div>

                <i class='bx bx-menu-alt-right toggle'></i>
            </header>

            <div class="menu-bar">
                <div class="menu">

                    <ul class="menu-links">
                        <li class="nav-link">
                            <a href="#">
                                <i class='bx bx-home-alt icon'></i>
                                <span class="text nav-text">HOME</span>
                            </a>
                        </li>

                        <li class="nav-link">
                            <a href="./PHP/search.php">
                                <i class='bx bx-search-alt icon'></i></i>
                                <span class="text nav-text">Search</span>
                            </a>
                        </li>

                        <li class="nav-link">
                            <a href="add_recipe.html">
                                <i class='bx bx-plus icon'></i>
                                <span class="text nav-text">Add Recipe</span>
                            </a>
                        </li>

                        <li class="nav-link">
                            <a href="./PHP/category.php">
                                <i class='bx bx-collection icon'></i>
                                <span class="text nav-text">Categories</span>
                            </a>
                        </li>

                        <li class="nav-link">
                            <a href="./PHP/myrecipe.php">
                                <i class='bx bx-book icon'></i>
                                <span class="text nav-text">My Recipes</span>
                            </a>
                        </li>

                        <li class="nav-link">
                            <a href="./PHP/shopping_list.php">
                                <i class='bx bx-cart icon'></i>
                                <span class="text nav-text">Shopping List</span>
                            </a>
                        </li>

                        <li class="nav-link">
                            <a href="./PHP/favourite.php">
                                <i class='bx bx-heart icon'></i>
                                <span class="text nav-text">Favourites</span>
                            </a>
                        </li>

                        <li class="nav-link">
                            <a href="#">
                                <i class='bx bxs-contact icon'></i>
                                <span class="text nav-text">Contact Us</span>
                            </a>
                        </li>

                    </ul>
                </div>

                <div class="bottom-content">
                    <li class="">
                        <a href="./PHP/profile.php">
                            <i class='bx bx-user-circle icon'></i>
                            <span class="text nav-text">Profile</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="./PHP/logout.php">
                            <i class='bx bx-log-out-circle icon'></i>
                            <span class="text nav-text">Logout</span>
                        </a>
                    </li>

                </div>
            </div>

        </nav>

        <script src="./JS/Welcome.js"></script>
    </form>
</body>

</html>