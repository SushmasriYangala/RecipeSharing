-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2023 at 03:22 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `recipesharing`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `recipe_id` int(11) NOT NULL,
  `comment_text` text NOT NULL,
  `date_and_time` datetime NOT NULL,
  `username` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `user_id`, `recipe_id`, `comment_text`, `date_and_time`, `username`) VALUES
(10, 2, 1, 'good', '2023-05-02 18:42:27', 'Yangala1999'),
(12, 5, 8, 'Nice', '2023-05-02 18:45:47', 'sushma'),
(13, 5, 1, 'Nice', '2023-05-02 18:51:29', 'sushma');

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `recipe_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `favorites`
--

INSERT INTO `favorites` (`id`, `user_id`, `recipe_id`, `created_at`) VALUES
(1, 2, 5, '2023-05-02 21:34:42');

-- --------------------------------------------------------

--
-- Table structure for table `passwordrecover`
--

CREATE TABLE `passwordrecover` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `confirmcode` varchar(255) NOT NULL,
  `Verified` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `recipes`
--

CREATE TABLE `recipes` (
  `recipe_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `recipe_name` varchar(255) NOT NULL,
  `ingredients` text NOT NULL,
  `preparation_time` varchar(20) NOT NULL,
  `cooking_time` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `tags` varchar(255) DEFAULT NULL,
  `date_and_time` datetime NOT NULL,
  `recipe_notes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recipes`
--

INSERT INTO `recipes` (`recipe_id`, `user_id`, `image_path`, `recipe_name`, `ingredients`, `preparation_time`, `cooking_time`, `description`, `tags`, `date_and_time`, `recipe_notes`) VALUES
(1, 2, '../uploads/64517f8ed6def5.67265560.jpg', 'Bullet Naan', '2 cups all-purpose flour\r\n1/2 teaspoon baking powder\r\n1/2 teaspoon salt\r\n1/2 teaspoon red chili powder (adjust according to your spice preference)\r\n1/2 teaspoon cumin seeds\r\n1/4 teaspoon turmeric powder\r\n1/4 teaspoon garam masala\r\n1/4 cup plain yogurt\r\n1/4 cup milk\r\n2 tablespoons vegetable oil\r\n2 tablespoons chopped cilantro (coriander leaves)\r\n2-3 green chilies, finely chopped\r\n', '15 minutes', '20 minutes', 'In a large mixing bowl, combine the all-purpose flour, baking powder, salt, red chili powder, cumin seeds, turmeric powder, and garam masala. Mix well to ensure the spices are evenly distributed.\r\nAdd the plain yogurt, milk, and vegetable oil to the dry ingredients. Mix everything together to form a soft dough.\r\nKnead the dough for about 5 minutes until it becomes smooth and pliable. You can sprinkle some flour on the surface to prevent sticking.\r\nCover the dough with a damp cloth and let it rest for about 10 minutes.\r\nPreheat a tawa (griddle) or a non-stick pan over medium heat.\r\nDivide the dough into small portions and roll each portion into a round shape of about 1/4 inch thickness. You can use a rolling pin and some flour for dusting.\r\nPlace the rolled naan on the preheated tawa or pan. Cook for about a minute until you see bubbles forming on the surface.\r\nFlip the naan and cook the other side for another minute. You can press gently with a spatula to ensure even cooking.\r\nBrush the cooked naan with a little ghee or butter for added flavor and moisture.\r\nRepeat the process with the remaining dough portions.\r\nSprinkle the chopped cilantro and green chilies over the hot naan and serve immediately.', 'indian, vegetarian, roti', '2023-05-02 17:24:30', 'You can adjust the spice level by increasing or decreasing the amount of red chili powder and green chilies.\r\nBullet Naan pairs well with spicy curries or can be enjoyed on its own as a tasty snack.\r\nYou can experiment with adding other spices or herbs to customize the flavor of your naan.'),
(2, 2, '../uploads/645180360ab059.33265842.jpg', 'Chicken Biriyani', '2 cups basmati rice\r\n1 kg chicken, cut into pieces\r\n2 onions, thinly sliced\r\n4 tomatoes, finely chopped\r\n4 green chilies, slit lengthwise\r\n1/2 cup plain yogurt\r\n2 tablespoons ginger-garlic paste\r\n1 teaspoon turmeric powder\r\n2 teaspoons red chili powder\r\n1 teaspoon garam masala powder\r\n1 teaspoon cumin seeds\r\n4 cloves\r\n4 green cardamom pods\r\n2 cinnamon sticks\r\nA pinch of saffron strands (optional)\r\n1/4 cup warm milk (optional)\r\nFresh coriander leaves, chopped\r\nFresh mint leaves, chopped\r\nGhee or cooking oil\r\nSalt to taste', ' 30 minutes', '1 hour 30 minutes', 'Wash the basmati rice thoroughly and soak it in water for 30 minutes. Drain the water and set the rice aside.\r\nHeat ghee or cooking oil in a large, heavy-bottomed pan or Dutch oven over medium heat. Add the cumin seeds, cloves, cardamom pods, and cinnamon sticks. Saut? for a minute until they release their aroma.\r\nAdd the sliced onions and saut? until they turn golden brown. Remove half of the onions from the pan and set them aside for garnishing.\r\nTo the remaining onions in the pan, add the ginger-garlic paste and green chilies. Saut? for a few minutes until the raw smell disappears.\r\nAdd the chicken pieces to the pan and cook until they are browned on all sides. Stir in the turmeric powder, red chili powder, and salt. Mix well.\r\nAdd the chopped tomatoes and cook until they are soft and mushy. Then, add the yogurt and mix everything together.\r\nCover the pan and let the chicken cook on low heat until it is tender and fully cooked. This will take about 30-40 minutes. Stir occasionally to prevent sticking.\r\nMeanwhile, in a separate pot, bring water to a boil and add the soaked and drained rice. Cook the rice until it is 70-80% cooked. Drain the rice and set it aside.\r\nOnce the chicken is cooked, layer the partially cooked rice on top of the chicken in the pan. Sprinkle the garam masala powder, chopped coriander leaves, and mint leaves over the rice. If using saffron, dissolve it in warm milk and drizzle it over the rice.\r\nCover the pan with a tight-fitting lid and cook on low heat for another 20-30 minutes until the rice is fully cooked and aromatic.\r\nRemove from heat and let it sit, covered, for a few minutes.\r\nGarnish with the reserved fried onions before serving. Serve hot with raita (yogurt sauce) or a side salad.', 'indian, chicken', '2023-05-02 17:27:18', 'You can adjust the spice levels according to your taste preferences by increasing or reducing the amount of chili powder and green chilies.\r\nFor a richer flavor, you can add a tablespoon of melted ghee on top of the rice before covering the pan.\r\nYou can add vegetables like carrots, peas, or potatoes along with the chicken to make a vegetable biryani.'),
(3, 2, '../uploads/645180a8c786d1.38681889.jpg', 'Oreo Icecream', '2 cups heavy cream\r\n1 cup whole milk\r\n3/4 cup granulated sugar\r\n1 tablespoon vanilla extract\r\n1 cup crushed Oreo cookies (about 10-12 cookies)\r\n1/2 cup Oreo cookie crumbs, for topping (optional)', '15 minutes', 'There is no cooking time for this recipe', 'In a mixing bowl, combine the heavy cream, whole milk, sugar, and vanilla extract. Stir well until the sugar is completely dissolved.\r\n\r\nPour the mixture into an ice cream maker and churn according to the manufacturer\'s instructions. This usually takes about 20 minutes or until the ice cream reaches a soft-serve consistency.\r\n\r\nWhile the ice cream is churning, crush the Oreo cookies by placing them in a sealed plastic bag and using a rolling pin or your hands to break them into small pieces.\r\n\r\nOnce the ice cream is ready, add the crushed Oreo cookies to the churned ice cream. Stir gently to distribute the cookie pieces evenly.\r\n\r\nTransfer the Oreo ice cream to a lidded container, layering it with additional Oreo cookie crumbs if desired. Press a piece of parchment paper directly onto the surface of the ice cream to prevent ice crystals from forming.\r\n\r\nFreeze the ice cream for at least 4 hours or until it is firm and scoopable.\r\n\r\nWhen ready to serve, scoop the Oreo ice cream into bowls or cones. You can garnish with additional Oreo cookie crumbs for added crunch and visual appeal.', 'icecream', '2023-05-02 17:29:12', 'Make sure the heavy cream is very cold before using it, as it will whip up better and create a smoother texture.\r\nFeel free to adjust the amount of sugar according to your taste preference. You can reduce or increase the sugar based on how sweet you like your ice cream.'),
(4, 2, '../uploads/64518179564604.99484197.jpg', 'Pasta', '8 ounces (225g) spaghetti noodles\r\n1 tablespoon olive oil\r\n1 onion, finely chopped\r\n2 cloves of garlic, minced\r\n1 carrot, finely diced\r\n1 celery stalk, finely diced\r\n8 ounces (225g) ground beef\r\n1 can (14 ounces/400g) crushed tomatoes\r\n2 tablespoons tomato paste\r\n1 teaspoon dried oregano\r\n1 teaspoon dried basil\r\nSalt and pepper to taste\r\nGrated Parmesan cheese (optional, for garnish)\r\nFresh basil leaves (optional, for garnish)', ' 10 minutes', '30 minutes', 'Before you start cooking, bring a large pot of salted water to a boil for the spaghetti noodles.\r\nIn a separate pan, heat the olive oil over medium heat. Add the chopped onion and minced garlic, and saut? until they become translucent and fragrant.\r\nAdd the diced carrot and celery to the pan, and continue cooking for a few more minutes until they soften.\r\nIncrease the heat to medium-high and add the ground beef to the pan. Cook until it\'s browned and cooked through, breaking it up with a spatula as you go.\r\nStir in the crushed tomatoes, tomato paste, dried oregano, and dried basil. Reduce the heat to low, cover, and simmer the sauce for about 20 minutes to allow the flavors to meld together.\r\nWhile the sauce simmers, cook the spaghetti noodles according to the package instructions until al dente. Drain the noodles and set them aside.\r\nOnce the sauce is ready, season with salt and pepper to taste. You can also adjust the consistency of the sauce by adding a little pasta cooking water if desired.\r\nServe the spaghetti Bolognese by placing a portion of noodles on each plate and topping them with a generous amount of the meat sauce.\r\nGarnish with grated Parmesan cheese and fresh basil leaves if desired.', 'pasta', '2023-05-02 17:32:41', 'Delicious and hearty pasta dish that is loved by many. It features a rich tomato-based meat sauce served over spaghetti noodles. This recipe is a simple and satisfying version of the traditional Bolognese sauce.'),
(5, 2, '../uploads/6451ab1385c5e-tomato.jpg', 'Tomato Soup', '2 tablespoons olive oil\r\n1 medium onion, chopped\r\n2 cloves garlic, minced\r\n2 cans (14 ounces each) diced tomatoes\r\n1 can (14 ounces) tomato sauce\r\n1 cup vegetable or chicken broth\r\n1 teaspoon sugar\r\n1 teaspoon dried basil\r\n1 teaspoon dried oregano\r\n1/2 teaspoon salt (or to taste)\r\n1/4 teaspoon black pepper\r\n1/4 cup heavy cream (optional, for a creamy soup)\r\nFresh basil or parsley, for garnish', ' 10 minutes', '30 minutes', 'In a large pot, heat the olive oil over medium heat. Add the chopped onion and minced garlic, and saut? until they become soft and fragrant.\r\nAdd the diced tomatoes, tomato sauce, vegetable or chicken broth, sugar, basil, oregano, salt, and black pepper to the pot. Stir well to combine.\r\nBring the mixture to a boil, then reduce the heat to low and let it simmer for about 20-25 minutes, allowing the flavors to meld together.\r\nIf you prefer a creamy soup, add the heavy cream to the pot and stir until well incorporated. Cook for an additional 2-3 minutes.\r\nRemove the pot from the heat and let it cool slightly. Using an immersion blender or regular blender, puree the soup until smooth (optional step).\r\nReturn the pot to the heat and simmer for a few more minutes to heat through.\r\nLadle the tomato soup into bowls and garnish with fresh basil or parsley.\r\nServe hot and enjoy!', 'soup', '2023-05-02 20:30:11', 'If you prefer a smoother soup, you can use an immersion blender or regular blender to puree the soup before adding the cream.\r\nFeel free to adjust the seasonings according to your taste. You can add more basil, oregano, or other herbs and spices to enhance the flavor.\r\nFor a vegan version, use vegetable broth and skip the heavy cream. You can also substitute coconut milk or almond milk for a creamy texture.'),
(8, 5, '../uploads/645192889da400.11873079.jpg', 'Strawberry smoothie', '2 cups fresh strawberries, hulled and sliced\r\n1 cup milk (dairy or non-dairy alternative like almond milk or coconut milk)\r\n1 banana, peeled and sliced\r\n1 tablespoon honey or maple syrup (optional, for added sweetness)\r\n1/2 cup plain yogurt or Greek yogurt\r\nIce cubes (optional, for a chilled smoothie)', ' 10 minutes', 'There is no cooking time for this recipe', 'Wash the strawberries thoroughly and remove the stems. Slice them into smaller pieces.\r\nIn a blender, add the sliced strawberries, banana, milk, yogurt, and honey or maple syrup (if using).\r\nBlend on high speed until all the ingredients are well combined and the mixture is smooth.\r\nTaste the smoothie and adjust the sweetness if needed by adding more honey or maple syrup.\r\nIf you prefer a thicker consistency, add a handful of ice cubes and blend again until smooth.\r\nPour the strawberry smoothie into glasses and serve immediately.', 'smoothies', '2023-05-02 18:45:28', 'For a thicker smoothie, you can add a handful of ice cubes to the blender along with the other ingredients.\r\nIf you prefer a sweeter smoothie, you can adjust the sweetness by adding more honey or maple syrup.\r\nFeel free to customize your smoothie by adding other fruits like blueberries or raspberries.\r\nIf you don\'t have fresh strawberries, you can use frozen strawberries instead. Just thaw them slightly before blending.');

-- --------------------------------------------------------

--
-- Table structure for table `shoppinglist`
--

CREATE TABLE `shoppinglist` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `recipe_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shoppinglist`
--

INSERT INTO `shoppinglist` (`id`, `user_id`, `recipe_id`, `created_at`) VALUES
(1, 2, 1, '2023-05-02 21:34:31'),
(2, 2, 5, '2023-05-02 21:36:51');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `verify` varchar(255) NOT NULL,
  `Verified` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `fullname`, `email`, `password_hash`, `verify`, `Verified`) VALUES
(2, 'Yangala1999', 'SushmasriYangala', 'sushmasri9947@gmail.com', '$2y$10$JWAmabIRO2ZGIeygalKL6uzn5N9Tdddf7eYPcriJsFsDBxHAjFUYi', '0f50b651e6ed30470137ca7cf2fc4222719c8c29', 1),
(5, 'sushmasri_1999', 'Sushmasri', 'sushmasri090407@gmail.com', '$2y$10$43uO9d/bwxtOo2tdI10TJeBKdfwoYrAnVTYjtiAFdEgEjI7mnfd2.', 'f7cd6b46ef441fb2b62597fd376e5ebf0e676784', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `recipe_id` (`recipe_id`);

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `recipe_id` (`recipe_id`);

--
-- Indexes for table `passwordrecover`
--
ALTER TABLE `passwordrecover`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`recipe_id`);

--
-- Indexes for table `shoppinglist`
--
ALTER TABLE `shoppinglist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `recipe_id` (`recipe_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `passwordrecover`
--
ALTER TABLE `passwordrecover`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `recipes`
--
ALTER TABLE `recipes`
  MODIFY `recipe_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `shoppinglist`
--
ALTER TABLE `shoppinglist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`recipe_id`);

--
-- Constraints for table `shoppinglist`
--
ALTER TABLE `shoppinglist`
  ADD CONSTRAINT `Shoppinglist_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `Shoppinglist_ibfk_2` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`recipe_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
