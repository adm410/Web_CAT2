<?php
session_start();
if (!isset($_SESSION['user_name'])) {
    header("Location: login.php");
    exit();
}

session_start();
$isLoggedIn = isset($_SESSION['user_name']);
?>

<!DOCTYPE html>
<html lang="en-UK">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Not So Fast Food • Welcome</title>
    <link rel="icon" href="./logo.png">
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />
</head>

<body>
    <div id="header" style="border-bottom: none; box-shadow: 0 3px 6px #555555ac;">
        <a href="./welcome.php">
            <img id="logo" src="./logo.png" alt="logo">
            <h1 id="headerTxt">Not So Fast Food</h1>
        </a>
        <div id="menuButtons">
            <a href="./"><button class="menuBtn activePage">🏠 Home</button></a>
            <a href="./menu.php"><button class="menuBtn">🍟 Menu</button></a>
            <a href="./contactus.php"><button class="menuBtn">☎️ Contact Us</button></a>
            <?php if ($isLoggedIn): ?>
                <a href="./logout.php"><button class="menuBtn"><?php echo htmlspecialchars($_SESSION['user_name']); ?> <i class="ti ti-logout"></i></button></a>
            <?php else: ?>
                <a href="./login.php"><button class="menuBtn">👤 Login</button></a>
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
                <p class="bodyFooter">Find us at convenient locations around the city for a delightful dining experience.
                    <svg class="bodyIcon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="rgb(9, 117, 219)" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-external-link">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M12 6h-6a2 2 0 0 0 -2 2v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-6" />
                        <path d="M11 13l9 -9" />
                        <path d="M15 4h5v5" />
                    </svg>
                </p>
            </a>
        </div>
        <div class="divider"> </div>
        <div class="homeDiv homeDiv2">
            <h2 id="bodyHeading">Menu</h2>
            <a href="./menu.php"><img class="bodyImg" src="./Images/HEIF Image 23.jpeg" alt="Menu"
                    style="height: 450px; width: 450px;">
                <p class="bodyFooter">Discover our diverse selection of dishes, crafted to tantalize your taste
                    buds.
                    <svg class="bodyIcon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="rgb(9, 117, 219)" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-external-link">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M12 6h-6a2 2 0 0 0 -2 2v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-6" />
                        <path d="M11 13l9 -9" />
                        <path d="M15 4h5v5" />
                    </svg>
                </p>
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
                <p class="bodyFooter">Discover our most popular dishes.
                    <svg class="bodyIcon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="rgb(9, 117, 219)" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-external-link">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M12 6h-6a2 2 0 0 0 -2 2v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-6" />
                        <path d="M11 13l9 -9" />
                        <path d="M15 4h5v5" />
                    </svg>
                </p>
            </a>
        </div>
    </div>

    <footer>
        <p>Aditya More • 193384 • DBIT-B</p>
    </footer>
</body>

</html>