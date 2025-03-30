<?php
session_start();
$isLoggedIn = isset($_SESSION['user_name']);
?>

<!DOCTYPE html>
<html lang="en-UK">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Not So Fast Food • Home</title>
    <link rel="icon" href="./logo.png">
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />
</head>

<body>
    <div id="header" style="">
        <a href="./home.php">
            <img id="logo" src="./logo.png" alt="logo">
            <p class="headerTxt">Not So Fast Food</p>
        </a>
        <div id="menuButtons">
            <a href="./home.php"><button class="menuBtn activePage"><svg  xmlns="http://www.w3.org/2000/svg"  width="17"  height="17"  viewBox="0 0 24 24"  fill="currentColor"  class="icon icon-tabler icons-tabler-filled icon-tabler-home"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12.707 2.293l9 9c.63 .63 .184 1.707 -.707 1.707h-1v6a3 3 0 0 1 -3 3h-1v-7a3 3 0 0 0 -2.824 -2.995l-.176 -.005h-2a3 3 0 0 0 -3 3v7h-1a3 3 0 0 1 -3 -3v-6h-1c-.89 0 -1.337 -1.077 -.707 -1.707l9 -9a1 1 0 0 1 1.414 0m.293 11.707a1 1 0 0 1 1 1v7h-4v-7a1 1 0 0 1 .883 -.993l.117 -.007z" /></svg> Home</button></a>
            <a href="./menu.php"><button class="menuBtn"><i class="ti ti-chef-hat"></i> Menu</button></a>
            <?php if ($isLoggedIn): ?>
                <a href="./logout.php"><button class="menuBtn"><?php echo htmlspecialchars($_SESSION['user_name']); ?> <i class="ti ti-logout"></i></button></a>
            <?php else: ?>
                <a href="./login.php"><button class="menuBtn"><i class="ti ti-user"></i> Login</button></a>
            <?php endif; ?>
        </div>
    </div>
</body>
<?php if ($isLoggedIn): ?>
<h2 id="bodyHeading" style="margin-left: 200px; text-decoration: none;">Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</h2>
<?php endif; ?>
    <div id="homeDivs">
        <div class="homeDiv homeDiv1">
            <h2 id="bodyHeading">Our Locations</h2>
            <a href="https://www.google.com/maps" target="_blank">
                <img class="bodyImg" src="./Images/HEIF Image 19.jpeg" alt="Location">
                <img class="bodyImg" src="./Images/HEIF Image 20.jpeg" alt="Location">
                <img class="bodyImg" src="./Images/HEIF Image 21.jpeg" alt="Location">
                <img class="bodyImg" src="./Images/HEIF Image 22.jpeg" alt="Location">
                <p class="bodyFooter">Find us at convenient spots around the city for a delightful dining experience.<i class="ti ti-external-link"></i></p>
            </a>
        </div>
        <div class="divider"> </div>
        <div class="homeDiv homeDiv2">
            <h2 id="bodyHeading">Menu</h2>
            <a href="./menu.php"><img class="bodyImg" src="./Images/HEIF Image 23.jpeg" alt="Menu"
                    style="height: 450px; width: 450px;">
                <p class="bodyFooter">Discover our diverse selection of dishes, crafted to tantalize your taste
                    buds.<i class="ti ti-external-link"></i></p>
            </a>
        </div>
    </div>
    <div id="homeDivs">
        <div class="homeDiv homeDiv1">
            <a href="./menu.php">
                <h2 id="bodyHeading">Popular Dishes</h2>
                <img class="homeFoodImg" src="./Images/HEIF Image 8.jpeg" alt="Dish 1">
                <img class="homeFoodImg" src="./Images/HEIF Image 16.jpeg" alt="Dish 2">
                <img class="homeFoodImg" src="./Images/HEIF Image 18.jpeg" alt="Dish 3">
                <img class="homeFoodImg" src="./Images/HEIF Image 17.jpeg" alt="Dish 4">
                <img class="homeFoodImg" src="./Images/HEIF Image 5.jpeg" alt="Dish 5">
                <img class="homeFoodImg" src="./Images/HEIF Image 12.jpeg" alt="Dish 6">
                <img class="homeFoodImg" src="./Images/HEIF Image 9.jpeg" alt="Dish 7">
                <p class="bodyFooter">Discover our most popular dishes.<i class="ti ti-external-link"></i></p>
            </a>
        </div>
    </div>

    <footer>
        <p>Aditya More • 193384 • DBIT-B • <a href="./contactus.php"><button class="menuBtn">Contact Us</button></a></p>        
    </footer>
</body>

</html>