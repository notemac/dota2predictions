<?php
session_start();
if (isset($_SESSION['authorized'])) {
    $now = time();
    // Закончилась сессия?
    if ($now > $_SESSION['expired']) {
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
        header('Location: ./index.php');
        exit;
    } else if (!$_SESSION['is_admin']) {
        header('Location: ./index.php');
    }
} else { // если не авторизованы
    header('Location: ./index.php');
    exit;
}

require_once './db.php';

// Возращает скоринговую карту
function getScorecard($db)
{
    $query = "SELECT name, score FROM `factor`";
    $result = mysqli_query($db, $query);
    if (!$result)
        die(mysqli_error($db));
    $num_rows = mysqli_num_rows($result);
    $scorecard = [];
    $rows = [];
    for ($i = 0; $i < 6; ++$i) { // 6 факторов
        // фактор состоит из 5 категорий (интервалов)
        $rows[] = mysqli_fetch_assoc($result);
        $rows[] = mysqli_fetch_assoc($result);
        $rows[] = mysqli_fetch_assoc($result);
        $rows[] = mysqli_fetch_assoc($result);
        $rows[] = mysqli_fetch_assoc($result);
        // меняем порядок факторов
        if ($i == 0) $scorecard[$i] = [$rows[3], $rows[1], $rows[0], $rows[2], $rows[4]];
        else $scorecard[$i] = [$rows[3], $rows[0], $rows[1], $rows[2], $rows[4]];
        // обнуляем rows
        $rows = [];
    }
    // Константа
    $scorecard['const'] = mysqli_fetch_assoc($result);
    // Параметры машстабирования
    $query = "SELECT score, odds, pdo FROM `model`";
    $result = mysqli_query($db, $query);
    if (!$result)
        die(mysqli_error($db));
    $row = mysqli_fetch_assoc($result);
    $scorecard['score'] = $row['score'];
    $scorecard['odds'] = $row['odds'];
    $scorecard['pdo'] = $row['pdo'];
    return $scorecard;
}

function getUpdateTime($db) {
    $query = "SELECT update_time FROM update_subprocess WHERE id=1";
    $result = mysqli_query($db, $query);
    if (!$result)
        die(mysqli_error($db));
    return mysqli_fetch_assoc($result)['update_time'];
}

$db = db_connect();
$scorecard = getScorecard($db);
$update_time = getUpdateTime($db);
db_close($db);
//$update_time = date('d/m/Y H:i'); // 14/06/2019 17:02
include './views/update-model.php';
?>