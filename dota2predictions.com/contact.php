<?php
include_once 'RecaptchaModule.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $recaptcha = new RecaptchaModule();
    if ($recaptcha->isChecked()) {
        $messageSent = true;
    } else { // сработала защита капчи
        header('Location: ./contact.php');
    }
}

session_start ();
if (isset($_SESSION['authorized'])) {
    $now = time();
    if ($now > $_SESSION['expired']) { // время сессии вышло
        // Удаляем все переменные сессии.
        $_SESSION = array();
        // Если требуется уничтожить сессию, также необходимо удалить сессионные cookie.
        // Замечание: Это уничтожит сессию, а не только данные сессии!
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }
        session_destroy();
        include './views/contact-welcome.php';
    }
    else { // авторизован и время сессии не вышло
        include './views/contact.php';
    }
} 
else { // не авторизован
    include './views/contact-welcome.php';
}

?>