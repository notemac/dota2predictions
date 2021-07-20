<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./css/all-index.css">
    <link rel="stylesheet" href="./css/other-index.css">
    <link rel="stylesheet" href="./css/subscribe-body.css">
    <link rel="stylesheet" href="./js/themes/redstyle-tooltip.css">
    <title>Dota 2 Predictions</title>
    <link rel="icon" type="image/png" href="./favicon.png">
</head>

<body>
    <header>
        <div class="header-body">
            <!-- <img class="header-logo" src="./assets/dota2logo3.png" alt=""> -->
            <div class="logo-wrapper">
                <img class="d2pl" src="./assets/d7logo.png" alt="">
                <img class="d2pl-top" src="./assets/d3logo.png" alt="">
                <div class="lw-item1 white">Dota 2 <span class="beta">beta version</span></div>
                <div class="lw-item2 white">Predictions</div>
                <div class="mi-highlighter"></div>
            </div>
            <div class="menu">
                <div class='menu-item-wrapper'>
                    <a class="mi-title" href="./faq.php">FAQ</a>
                    <div class="mi-highlighter"></div>
                </div>
                <div class='menu-item-wrapper active-menu-item'>
                    <a class="mi-title" href="./subscribe.php">SUBSCRIBE</a>
                    <div class="mi-highlighter"></div>
                </div>
                <div class='menu-item-wrapper'>
                    <a class="mi-title" href="./contact.php">CONTACT US</a>
                    <div class="mi-highlighter"></div>
                </div>
                <div class='menu-item-wrapper'>
                    <div class="user-account">
                        <div>
                            <?= $_SESSION['user_name'] ?>
                        </div>
                        <div>
                            &#8227;
                        </div>
                    </div>
                    <div class="mi-highlighter"></div>
                    <div class="dropdown-wrapper">
                        <ul class="dropdown-menu">
                            <li><a href="./index.php?logout">Logout</a></li>
                            <li><a>View profile</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <main>
        <div class="subscribe-wrapper">
            <div class="subscribe-body">
                <form class="subscribe-form" action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                    <input type="hidden" name="cmd" value="_s-xclick">
                    <input type="hidden" name="hosted_button_id" value="MVMHFV9AHLWKS">
                    <input type="hidden" name="on0" value="Select a subscription plan">
                    <div class="subscribe-title"> <span class="yellow">Select</span> a Subscription Plan </div>
                    <div>
                        <select class="subscribe-select" name="os0">
                            <option value="Base"><span class="yellow">Base:</span> $1.00 USD - monthly</option>
                            <option value="Advanced">Advanced: $2.00 USD - monthly</option>
                        </select>
                    </div>
                    <div class="subscription-plan-description">
                        <span class="yellow spd-header">Base plan includes the next statistics of the team:</span> winrates, average number of deaths per match, average lost matches duration, heroes advantages, heroes winrates (+ free for the first week).
                    </div>
                    <input type="hidden" name="currency_code" value="USD">
                    <input type="submit" value="Subscribe" class="subscribe-button">
                    <input class="subscribe-image" type="image" src="./assets/mastercard.png" name="submit" alt="PayPal - The safer, easier way to pay online!">
                </form>
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
    <script src="./js/d2predicts-other.js"></script>
</body>

</html>