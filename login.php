<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riley Creates.com</title>
    <link rel="stylesheet" href="css/stylelogin.css">
</head>
<body <?php if (isset($_COOKIE['mode']) && $_COOKIE['mode'] === 'dark-mode') echo 'class="dark-mode"'; ?>>
    <?php
    include 'validation_functions.php';
    session_start();

    if (isset($_SESSION['loggedInUser'])) {
        $loggedInUser = $_SESSION['loggedInUser'];
        echo '<h2 id="username-header">' . htmlspecialchars($loggedInUser) . '</h2>';
        echo '<script>document.getElementById("authForm").style.display = "none";</script>';
        echo '<script>document.getElementById("signOutButton").style.display = "inline";</script>';
    }

    $formValues = array(
        'username' => '',
        'password' => '',
    );

    $errorMessages = array(
        'username' => '',
        'password' => '',
    );

    $message = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $formValues['username'] = $_POST['username'];
        $formValues['password'] = $_POST['password'];

        if (!isTextValid($formValues['username'], 3, 20)) {
            $errorMessages['username'] = 'Username must be between 3 and 20 characters.';
        }

        
        $errorMessage = implode(' ', array_filter($errorMessages));

        if (empty($errorMessage)) {
            setcookie('mode', isset($_POST['mode']) ? $_POST['mode'] : '', time() + (86400 * 30), '/');
            $_SESSION['loggedInUser'] = $formValues['username'];
            $message = 'Form submitted successfully!';
            echo '<script>document.getElementById("authForm").style.display = "none";</script>';
            echo '<script>document.getElementById("signOutButton").style.display = "inline";</script>';
        } else {
            $message = 'Please correct the following errors: ' . $errorMessage;
        }
    }
    ?>

    <section class="app-section" id="designs-section">
        <header>
            <div class="logo">
                <img src="images/LogoRiley.png" alt="Logo" class="logo-image">
                <h2><a href="home.html" class="logo-text">RileyCreates</a></h2>
            </div>
            <div class="navigation">
                <a href="home.php">Home</a>
                <a href="about.php">About Me</a>
                <a href="virtual gallery.php">Virtual gallery</a>
                <a href="login.php">Login/Sign up</a>
            </div>
        </header>
        <div id="join-message-container"></div>
        <form id="authForm" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" placeholder="Username" value="<?php echo htmlspecialchars($formValues['username']); ?>">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Password">
            <button id="toggleAuthMode" type="button">Switch to Sign Up</button>
            <button id="runScriptButton" type="submit">Login</button>
            <button id="toggleModeButton" type="button">Toggle Light/Dark Mode</button>
            <button id="signOutButton" type="button" onclick="location.href='signout.php'" style="display: none;">Sign Out</button>
        </form>
        <?php if (!empty($message)) : ?>
            <div class="message <?php echo (empty($errorMessage)) ? 'success' : 'error'; ?>">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>
    </section>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/toggle.js"></script>
    <script src="js/login.js"></script>
    <script src="js/load-join-message.js"></script>
</body>
</html>