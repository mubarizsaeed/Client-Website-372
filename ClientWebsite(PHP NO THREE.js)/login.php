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
    session_start();
    include 'validation_functions.php';

    $type = 'mysql'; // Type of database
    $server = '192.185.2.183'; // Server the database is on
    $db = 'mubarizs_users'; // Name of the database
    $port = '3306'; // Port is usually 3306 in Cpanel
    $charset = 'utf8mb4'; // UTF-8 encoding using 4 bytes of data per char
    $username = 'mubarizs_users'; // Enter YOUR cPanel username and user here
    $password = 'Hisoka514!'; // Enter YOUR user password here

    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];
    $dsn = "$type:host=$server;dbname=$db;port=$port;charset=$charset";

    try {
        $pdo = new PDO($dsn, $username, $password, $options);
    } catch (PDOException $e) {
        throw new PDOException($e->getMessage(), $e->getCode());
    }

    if (isset($_SESSION['loggedInUser'])) {
        $loggedInUser = $_SESSION['loggedInUser'];
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

            // Check if the username already exists in the database
            $sql = "SELECT * FROM users WHERE username = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$formValues['username']]);

            if ($stmt->rowCount() > 0) {
                // Username exists, check if the password is correct
                $user = $stmt->fetch();
                if (password_verify($formValues['password'], $user['password'])) {
                    $_SESSION['loggedInUser'] = $formValues['username'];
                    $message = 'Login successful!';
                    echo '<script>document.getElementById("authForm").style.display = "none";</script>';
                    echo '<script>document.getElementById("signOutButton").style.display = "inline";</script>';
                } else {
                    $message = 'Invalid password.';
                }
            } else {
                // Username doesn't exist, insert a new user record
                $hashedPassword = password_hash($formValues['password'], PASSWORD_DEFAULT);

                $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$formValues['username'], $hashedPassword]);

                $_SESSION['loggedInUser'] = $formValues['username'];

                // Insert the default comment for the new user
                $sql = "INSERT INTO comments (comment) VALUES (?)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute(['Test if comment data is working']);

                $message = 'Registration successful! You are now logged in.';
                echo '<script>document.getElementById("authForm").style.display = "none";</script>';
                echo '<script>document.getElementById("signOutButton").style.display = "inline";</script>';
            }
        } else {
            $message = 'Please correct the following errors: ' . $errorMessage;
        }
    }

    if (isset($_SESSION['loggedInUser'])) {
        // Retrieve the comment associated with the logged-in user
        $sql = "SELECT comment FROM comments";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $comment = $stmt->fetch();

        if ($comment) {
            $comment_text = $comment['comment'];
        } else {
            $comment_text = "No comment found.";
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

        <?php if (isset($_SESSION['loggedInUser'])) : ?>
            <div class="user-comment">
                <h3>Welcome, <?php echo $_SESSION['loggedInUser']; ?>!</h3>
                <p>Your comment: <?php echo $comment_text; ?></p>
            </div>
        <?php endif; ?>
    </section>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/toggle.js"></script>
    <script src="js/login.js"></script>
    <script src="js/load-join-message.js"></script>
</body>
</html>