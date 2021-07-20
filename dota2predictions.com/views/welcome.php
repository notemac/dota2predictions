<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./css/welcome.css">
    <!-- Общие стили для всех страниц неавторизованного пользователя-->
    <link rel="stylesheet" href="./css/welcome-all.css">
    <title>Dota 2 Predictions</title>
    <link rel="icon" type="image/png" href="./favicon.png">
</head>

<body>
    <header>
        <div class="header-body">
            <!-- <img class="header-logo" src="./assets/dota2logo3.png" alt=""> -->
            <div class="logo-wrapper active-menu-item">
                <img class="d2pl-top" src="./assets/d7logo.png" alt="">
                <div class="lw-item1 yellow">Dota 2 <span class="beta">beta version</span></div>
                <div class="lw-item2 yellow">Predictions</div>
                <div class="mi-highlighter"></div>
            </div>
            <div class="menu">
                <div class='menu-item-wrapper'>
                    <a class="mi-title" href="./faq.php">FAQ</a>
                    <div class="mi-highlighter"></div>
                </div>
                <div class='menu-item-wrapper'>
                    <a class="mi-title" href="./subscribe.php">SUBSCRIBE</a>
                    <div class="mi-highlighter"></div>
                </div>
                <div class='menu-item-wrapper'>
                    <a class="mi-title" href="./contact.php">CONTACT US</a>
                    <div class="mi-highlighter"></div>
                </div>
                <div class='menu-item-wrapper'>
                    <div class="steam-signin-logo">
                        <img class="ssl" src="./assets/steam2.png" alt="">
                        <img class="ssl-top" src="./assets/steam1.png" alt="">
                    </div>
                    <div class="mi-highlighter"></div>
                </div>
            </div>
        </div>
    </header>
    <main>
        <div class="welcome-wrapper">
            <div class="welcome-body">
                <div class="ww-header">
                    <span class="yellow">DOTA 2</span> PREDICTIONS
                </div>
                <div>
                    We offer <span class="yellow">statistical tool</span> that predicts the winners of Dota 2 matches
                </div>
                <div class="ww-footer">
                    <div><img class="sign-in-steam-icon" src="./assets/steam.png" alt=""></div>
                    <div><span class="yellow" style="font-family: 'DINPro-Medium', sans-serif;">Sign in</span> to continue</div>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <div class="footer-body">
            &copy; Dota2Predictions&trade;, 2019.
        </div>
    </footer>
    <script>
        // ZOOOOOOOOOOOM 90%
        document.body.style.zoom = "90%";
    </script>
    <script src="./js/jquery-3.4.0.min.js"></script>
    <script src="./js/d2predicts-welcome.js"></script>
</body>

</html>