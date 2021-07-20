<?php
session_start();
if (isset($_SESSION['authorized'])) {
    $now = time();
    // Закончилась сессия или logout?
    if ((isset($_GET['logout'])) || ($now > $_SESSION['expired'])) {
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
        include './views/welcome.php';
    }
    else {
        include './views/index.php';
    }
}
else {
    include './views/welcome.php';
}
?>