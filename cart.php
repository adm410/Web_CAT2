<?php
session_start();
$isLoggedIn = isset($_SESSION['user_name']);
?>

<!DOCTYPE html>
<html lang="en-UK">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Not So Fast Food • Cart</title>
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
            <a href="./home.php"><button class="menuBtn"><i class="ti ti-home-filled"></i> Home</button></a>
            <a href="./menu.php"><button class="menuBtn"><i class="ti ti-chef-hat"></i> Menu</button></a>
            <?php if ($isLoggedIn): ?>
                <a href="./logout.php"><button class="menuBtn"><?php echo htmlspecialchars($_SESSION['user_name']); ?> <i class="ti ti-logout"></i></button></a>
            <?php else: ?>
                <a href="./login.php"><button class="menuBtn"><i class="ti ti-user"></i> Login</button></a>
            <?php endif; ?>
        </div>
    </div>
    <h2 id="bodyHeading" style="margin-left: 220px;">Cart</h2>
    <div id="divMenu" class="foodMenu">
        <table>
            <tr>
                <th>No.</th>
                <th>Image</th>
                <th>Item</th>
                <th>Quantity</th>
                <th> </th>
            </tr>

            <tr>
                <td class="cartNo">1.</td>
                <td><img class="foodImg" src="./Images/HEIF Image 16.jpeg" alt="Dish 1"></td>
                <td class="cartTitle">Burger</td>
                <td>1</td>
                <td>
                    <button id="resetBtn" class="removeBtn">Remove</button>
                </td>
                </td>
            </tr>
        </table>
        <hr>
        <div id="tableFooter">
            <div>1 Item(s)</div>
        </div>
    </div>
    <footer>
        <p>Aditya More • 193384 • DBIT-B • <a href="./contactus.php"><button class="menuBtn">Contact Us</button></a></p>
    </footer>
</body>


</html>