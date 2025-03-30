<?php
session_start();
$isLoggedIn = isset($_SESSION['user_name']);
?>

<!DOCTYPE html>
<html lang="en-UK">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Not So Fast Food • Contact Us</title>
    <link rel="icon" href="./logo.png">
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />
</head>

<body>
    <div id="header" style="border-bottom: none; box-shadow: 0 3px 6px #555555ac;">
        <a href="./home.php">
            <img id="logo" src="./logo.png" alt="logo">
            <p class="headerTxt">Not So Fast Food</p>
        </a>
        <div id="menuButtons">
            <a href="./home.php"><button class="menuBtn"><i class="ti ti-home"></i> Home</button></a>
            <a href="./menu.php"><button class="menuBtn"><i class="ti ti-chef-hat"></i> Menu</button></a>
            <?php if ($isLoggedIn): ?>
                <a href="./logout.php"><button class="menuBtn"><?php echo htmlspecialchars($_SESSION['user_name']); ?> <i class="ti ti-logout"></i></button></a>
            <?php else: ?>
                <a href="./login.php"><button class="menuBtn"><i class="ti ti-user"></i> Login</button></a>
            <?php endif; ?>
        </div>
    </div>
    <div id="contactDivs">
        <div class="contactDiv">
            <form id="registrationForm">
                <h2 id="bodyHeading">Feedback</h2>
                <label>Name:</label>
                <input type="text" id="name" name="name" required placeholder=" Full Name...">
                <br>
                <label>Gender:</label>
                <input type="radio" name="gender" value="Male">
                <label>Male</label>
                <input type="radio" name="gender" value="Female">
                <label>Female</label>
                <br>
                <label>Email:</label>
                <input type="email" name="userEmail" placeholder=" Email...">
                <br>
                <div style="display: flex;">
                    <label>Phone: </label>
                    <input type="text" name="phoneNumber" placeholder=" Phone Number...">
                </div>
                <br>
                <label>Branch:</label>
                <select name="branch">
                    <option disabled>--select branch---</option>
                    <option selected>Parklands</option>
                    <option>Westlands</option>
                    <option>Langata</option>
                </select>
                <br>
                <label>Your Questions or Feedback:</label>
                <br>
                <textarea rows="10" cols="50" name="feedback" placeholder=" Write your message here..."></textarea>
                <br>
                <input checked type="checkbox" name="Unit1" value="yes">
                <label>Receive promotional emails</label>
                <br>
                <div style="overflow: hidden; width: 100%;">
                    <button type="reset" id="resetBtn2" onclick="resetForm()" style="float: left;">Reset</button>
                    <button type="submit" id="submitBtn2" name="signup" style="float: right;">Register</button>
                </div>
            </form>
        </div>
        <div class="contactDivider"> </div>
        <div class="contactDiv contactDiv2">
            <section>
                <h2 id="bodyHeading">How to Order</h2>
                <ol>
                    <li>Choose your meal from the menu.</li>
                    <li>Add your items to cart.</li>
                    <li>Fill out your delivery details.</li>
                    <li>Pay online. <i>(very secure)</i></li>
                    <li>Wait for your food to arrive</li>
                </ol>
                <br>
                <h2 id="bodyHeading">Contact Us</h2>
                <ul>
                    <li>Phone: +(254)786211325</li>
                    <li>Email: aditya.more@strathmore.edu</li>
                </ul>
            </section>
        </div>
    </div>
    <footer>
        <p>Aditya More • 193384 • DBIT-B • <a href="./contactus.php"><button style="border-bottom: solid 2px white !important" class="menuBtn">Contact Us</button></a></p>
    </footer>
</body>

</html>