<?php
session_start();
include "connectdb.php"; // Include your database connection file

// Define variables for success or error messages
$loginError = $signupError = $signupSuccess = "";

// Handle Login Form Submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $query = "SELECT * FROM user WHERE email = ?";
    $stmt = $connect->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['user_password'])) {
            $_SESSION['user_name'] = $user['user_name'];
            $_SESSION['user_id'] = $user['user_id'];
            header("Location: home.php"); // Redirect to welcome page
            exit();
        } else {
            $loginError = "Invalid password!";
        }
    } else {
        $loginError = "User not found!";
    }

    $stmt->close();
}

// Handle Sign-Up Form Submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['signup'])) {
    $user_name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $age = trim($_POST['age']);
    $user_password = password_hash(trim($_POST['password']), PASSWORD_BCRYPT);

    $query = "INSERT INTO user(user_name, email, age, user_password) VALUES(?, ?, ?, ?)";
    $stmt = $connect->prepare($query);
    $stmt->bind_param("ssis", $user_name, $email, $age, $user_password);
    $execute = $stmt->execute();

    if ($execute) {
        $signupSuccess = "User registered successfully!";
    } else {
        $signupError = "Error: " . $stmt->error;
    }

    $stmt->close();
}

$connect->close();
?>
<!DOCTYPE html>
<html lang="en-UK">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Not So Fast Food • Login</title>
    <link rel="icon" href="./logo.png">
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />
</head>

<body style="background-color: rgb(249, 249, 249);">
    <div id="header" style="border-bottom: none; box-shadow: 0 3px 6px #555555ac;">
        <a href="./home.php">
            <img id="logo" src="./logo.png" alt="logo">
            <p class="headerTxt">Not So Fast Food</p>
        </a>
        <div id="menuButtons">
        <a href="./home.php"><button class="menuBtn"><i class="ti ti-home"></i> Home</button></a>
        <a href="./menu.php"><button class="menuBtn"><i class="ti ti-chef-hat"></i> Menu</button></a>
        <a href="./login.php"><button class="menuBtn activePage"><i class="ti ti-user-filled"></i> Login</button></a>
        </div>
    </div>

    <main class="auth-container">
        <div class="auth-box" style="background-color: white !important;">
            <div class="auth-form">
                <div class="tabs">
                    <button class="tab-btn active" onclick="showForm('login')">Login</button>
                    <button class="tab-btn" onclick="showForm('signup')">Sign Up</button>
                </div>

                <!-- Login Form -->
                <form id="login-form" method="post" action="login.php">
                    <label>Email <i class="ti ti-mail-filled"></i></label>
                    <input type="email" name="email" id="email" placeholder="Email" required>
                    <label>Password <i class="ti ti-lock-filled"></i></label>
                    <input type="password" name="password" id="password" placeholder="Password" required>
                    <button type="submit" id="submitBtn" name="login"
                        style="padding: 8px; font-size: 16px; width: 100% !important; font-weight: bold;">Login</button>
                </form>
                <?php if ($loginError) { echo "<p style='color: red; text-align: center;'>$loginError</p>"; } ?>

                <!-- Sign Up Form -->
                <form id="signup-form" method="post" style="display: none;" action="login.php">
                    <label>Full Name <i class="ti ti-user-filled"></i></label>
                    <input type="text" name="name" placeholder="Name" required style="text-transform: capitalize;">
                    <label>Email <i class="ti ti-mail-filled"></i></label>
                    <input type="email" name="email" placeholder="Email" required>
                    <label>Age <i class="ti ti-calendar-filled"></i></i></label>
                    <input type="number" name="age" placeholder="Age" min="1" max="99" required>
                    <label>Password <i class="ti ti-lock-filled"></i></label>
                    <input type="password" name="password" placeholder="Password" required>
                    <div style="overflow: hidden; width: 107%;">
                        <button type="reset" id="resetBtn2" onclick="resetForm()" style="float: left;">Reset</button>
                        <button type="submit" id="submitBtn2" name="signup" style="float: right;">Register</button>
                    </div>
                </form>
                <?php if ($signupError) { echo "<p style='color: red; text-align: center;'>$signupError</p>"; } ?>
                <?php if ($signupSuccess) { echo "<p style='color: green; text-align: center;'>$signupSuccess</p>"; } ?>
            </div>
        </div>
    </main>

    <footer>
        <p>Aditya More • 193384 • DBIT-B • <a href="./contactus.php"><button class="menuBtn">Contact Us</button></a></p>
    </footer>

    <script>
        function showForm(formType) {
            document.getElementById("login-form").style.display = formType === 'login' ? "block" : "none";
            document.getElementById("signup-form").style.display = formType === 'signup' ? "block" : "none";

            document.querySelector(".tab-btn.active").classList.remove("active");
            document.querySelector(`[onclick="showForm('${formType}')"]`).classList.add("active");
        }

        function resetForm() {
            document.getElementById("loginError").textContent = "";
            document.getElementById("signupError").textContent = "";
            document.getElementById("signupSuccess").textContent = "";
        }
    </script>
    <style>
        label i {
            color: var(--blue);
        }
    </style>
</body>

</html>
