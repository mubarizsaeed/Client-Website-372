<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RileyCreates.com</title>
    <link rel="stylesheet" href="css/stylevirtual.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
</head>
<body <?php if (isset($_COOKIE['mode']) && $_COOKIE['mode'] === 'dark-mode') echo 'class="dark-mode"'; ?>>
    <?php
    session_start();

    $loggedInUser = isset($_SESSION['loggedInUser']) ? $_SESSION['loggedInUser'] : '';
    $isLoggedIn = !empty($loggedInUser);
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
                <a href="login.php" <?php if ($isLoggedIn) echo 'style="display: none;"'; ?>>Login/Sign up</a>
            <span <?php if (!$isLoggedIn) echo 'style="display: none;"'; ?>>
                <?php echo htmlspecialchars($loggedInUser); ?>
                <a href="signout.php">Sign Out</a>
            </span>
            </div>
        </header>

        <div id="threejs-container"></div>

        <div id="gallery-grid"></div>
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/three@0.128.0/examples/js/controls/PointerLockControls.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/three@0.128.0/examples/js/loaders/GLTFLoader.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/three@0.128.0/examples/js/loaders/RGBELoader.js"></script>
    <script src="js/three_js_virtual.js"></script>
    <script src="js/toggle.js"></script>
    <script src="js/gallery.js"></script>
    <script src="js/storage.js"></script>
</body>

</html>