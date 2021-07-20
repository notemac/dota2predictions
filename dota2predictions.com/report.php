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

function getReport1($db)
{
    $query = "SELECT * FROM `model`";
    $result = mysqli_query($db, $query);
    if (!$result)
        die(mysqli_error($db));
    $num_rows = mysqli_num_rows($result);
    $report1 = mysqli_fetch_assoc($result); // в таблице всего одна строка
    $report1['method'] = 'Полное включение'; 
    return $report1;
}

function getReport3($db)
{
    $query = "SELECT * FROM `classification_quality`";
    $result = mysqli_query($db, $query);
    if (!$result)
        die(mysqli_error($db));
    $report3 = [];
    $all = mysqli_fetch_assoc($result);
    $all['osr'] = round(($all['tp'] + $all['tn']) * 100 / ($all['tp'] + $all['tn'] + $all['fp'] + $all['fn']), 2);
    $all['ovr'] = 100 - $all['osr'];
    $test = mysqli_fetch_assoc($result);
    $test['osr'] = round(($test['tp'] + $test['tn']) * 100 / ($test['tp'] + $test['tn'] + $test['fp'] + $test['fn']), 2);
    $test['ovr'] = 100 - $test['osr'];
    $training = mysqli_fetch_assoc($result);
    $training['osr'] = round(($training['tp'] + $training['tn']) * 100 / ($training['tp'] + $training['tn'] + $training['fp'] + $training['fn']), 2);
    $training['ovr'] = 100 - $training['osr'];
    return ['All' => $all, 'Training' => $training, 'Test' => $test];
}

function getReport2($db)
{
    $query = "SELECT * FROM `factor`";
    $result = mysqli_query($db, $query);
    if (!$result)
        die(mysqli_error($db));
    $num_rows = mysqli_num_rows($result);
    $factors = []; $rows = [];
    for ($i = 0; $i < 6; ++$i) { // 6 факторов
        // фактор состоит из 5 категорий (интервалов)
        $rows[] = mysqli_fetch_assoc($result);
        $rows[] = mysqli_fetch_assoc($result);
        $rows[] = mysqli_fetch_assoc($result);
        $rows[] = mysqli_fetch_assoc($result);
        $rows[] = mysqli_fetch_assoc($result);
        // меняем порядок факторов
        if ($i == 0) $factors['counters'] = [$rows[3], $rows[1], $rows[0], $rows[2], $rows[4]];
        else if ($i == 1) $factors['death_l25'] = [$rows[3], $rows[0], $rows[1], $rows[2], $rows[4]];
        else if ($i == 2) $factors['hwr_avg'] = [$rows[3], $rows[0], $rows[1], $rows[2], $rows[4]];
        else if ($i == 3) $factors['lm_avg'] = [$rows[3], $rows[0], $rows[1], $rows[2], $rows[4]];
        else if ($i == 4) $factors['pwinrate'] = [$rows[3], $rows[0], $rows[1], $rows[2], $rows[4]];
        else if ($i == 5) $factors['winrate6'] = [$rows[3], $rows[0], $rows[1], $rows[2], $rows[4]];
        // обнуляем rows
        $rows = [];
    }
    // Константа
    $factors['const'] = mysqli_fetch_assoc($result);
    return $factors;
}

//classification_quality

$db = db_connect();
$report1 = getReport1($db);
$report2 = getReport2($db);
$report3 = getReport3($db);
db_close($db);

include './views/report.php';
?>