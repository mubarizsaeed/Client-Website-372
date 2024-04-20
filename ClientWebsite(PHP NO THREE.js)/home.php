<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riley Creates.com</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body <?php if (isset($_COOKIE['mode']) && $_COOKIE['mode'] === 'dark-mode') echo 'class="dark-mode"'; ?>>
    <?php
    session_start();

    $loggedInUser = isset($_SESSION['loggedInUser']) ? $_SESSION['loggedInUser'] : '';
    $isLoggedIn = !empty($loggedInUser);
    ?>

    <header>
        <div class="logo">
            <img src="images/LogoRiley.png" alt="Logo" class="logo-image">
            <h2><a href="home.php" class="logo-text">RileyCreates</a></h2>
        </div>
        <div class="navigation">
            <a href="home.php">Home</a>
            <a href="about.php">About Me</a>
            <a href="virtual gallery.php">Virtual Gallery</a>
            <a href="login.php" <?php if ($isLoggedIn) echo 'style="display: none;"'; ?>>Login/Sign up</a>
            <span <?php if (!$isLoggedIn) echo 'style="display: none;"'; ?>>
                <?php echo htmlspecialchars($loggedInUser); ?>
                <a href="signout.php">Sign Out</a>
            </span>

        </div>
    </header>
        
        <div class="container">
            <div class="search-box">
                <i class="bx bx-search"></i>
                <input type="text" placeholder="Search..." id="searchInput">
            </div>
            <div class="images">
                <!-- images loaded dynamically using ajax  -->
            </div>
        </div>



        
        
        
        

        
    </section>  
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/jquery.min.js"><\/script>')</script>   
    <script src="js/load-images.js"></script>
    <script src="js/toggle.js"></script>
    <script src="js/search.js"></script> 
    <script src="js/expand.js"></script>
    <script src="js/ToggleSound.js"></script>
    <script src="js/storage.js"></script>
    <script>
        function toggleMobileNavigation() {
            var navigation = document.querySelector('.navigation');
            if (navigation.style.display === 'none' || navigation.style.display === '') {
                navigation.style.display = 'flex';
            } else {
                navigation.style.display = 'none';
            }
        }
    </script>

    
</body>

</html>
