<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./css/all-index.css">
    <link rel="stylesheet" href="./css/other-index.css">
    <link rel="stylesheet" href="./css/contact-body.css">
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
                <div class='menu-item-wrapper'>
                    <a class="mi-title" href="./subscribe.php">SUBSCRIBE</a>
                    <div class="mi-highlighter"></div>
                </div>
                <div class='menu-item-wrapper active-menu-item'>
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
        <div class="contact-wrapper">
            <div class="contact-body">
                <div class="cw-title">
                    <span class="yellow">Contact</span> Us
                </div>
                <form class="contact-form" method="POST" action="./contact.php">
                    <label for="email"><span class="yellow">Email*</span></label>
                    <div class="cf-header">
                        <input class="contact-input ci-email" placeholder="Your email..." type="email" name="email" maxlength="40" autofocus required autocomplete="off">
                        <button type="submit" class="submit-contact">Submit</button>
                    </div>
                    <label for="subject"><span class="yellow">Subject*</span></label>
                    <input class="contact-input ci-subject" type="text" placeholder="Message subject..." name="subject" maxlength="100" required autocomplete="off">
                    <label for="message"><span class="yellow">Message*</span></label>
                    <textarea class="contact-input ci-message" placeholder="Your message..." type="text" name="message" value="" rows="8" maxlength="1000" required autocomplete="off"></textarea>
                    <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response" />
                </form>
            </div>
        </div>
        <dialog class="submit-dialog">
            <div class="submit-dialog-body">
                </span> <button class="submit-dialog-close">&#10006;</button>
                <span class="yellow">Message sent.<br><span class="white">We will reply to your message as soon as possible!</span>
            </div>
        </dialog>
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
    <script src='https://www.google.com/recaptcha/api.js?explicit&hl=en&render=<?php echo RecaptchaModule::SITE_KEY; ?>'></script>
    <!--    reCaptcha V3 script  start   -->
    <script>
        grecaptcha.ready(function() {
            grecaptcha.execute('<?php echo RecaptchaModule::SITE_KEY; ?>', {
                    action: 'homepage'
                })
                .then(function(token) {
                    // console.log(token);
                    document.getElementById('g-recaptcha-response').value = token;
                });
        }); <
        ? php
        if (isset($messageSent)) {
            echo '$(".submit-dialog").get(0).showModal();'; // Показываем диалог
            unset($messageSent); // На всякий случай удаляем переменную
        } ? >
    </script>
    <!--    reCaptcha V3 script  end     -->
</body>

</html>