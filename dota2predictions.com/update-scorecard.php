
<?php

require_once './db.php';

// Возращает скоринговую карту
function getScorecard($db)
{
    $query = "SELECT name, b, score FROM `factor`";
    $result = mysqli_query($db, $query);
    if (!$result)
        die(mysqli_error($db));
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
    $scorecard['score'] = (int)$_GET['score'];
    $scorecard['odds'] = (int)$_GET['odds'];
    $scorecard['pdo'] = (int)$_GET['pdo'];
    return $scorecard;
}

function updateScorecard($db, $scorecard) {
    $sql1 = "UPDATE factor SET score='%f' WHERE name='%s'";
    $sql2 = "UPDATE model SET score='%d', odds='%d', pdo='%d' WHERE id=1";

    $f = $_GET['pdo'] / log(2);
    $offset = $_GET['score'] - $f * log($_GET['odds']);

    $query = sprintf($sql2, $scorecard['score'], $scorecard['odds'], $scorecard['pdo']);
    $result = mysqli_query($db, $query);
    if (!$result) die(mysqli_error($db));

    $scorecard['const']['score'] = round($scorecard['const']['b']*$f+$offset, 4);
    $query = sprintf($sql1, $scorecard['const']['score'], $scorecard['const']['name']);
    $result = mysqli_query($db, $query);
    if (!$result) die(mysqli_error($db));

    for($i = 0; $i < 6; ++$i) {
        for ($j = 0; $j < 5; ++$j) {
            $scorecard[$i][$j]['score'] = round($scorecard[$i][$j]['b']*$f, 4);
            $query = sprintf($sql1, $scorecard[$i][$j]['score'], $scorecard[$i][$j]['name']);
            $result = mysqli_query($db, $query);
            if (!$result) die(mysqli_error($db));
        }
    }
    return $scorecard;
}

function updateTime($db) {
    $now = time();
    //$update_time = date('d/m/Y H:i:s', $now); // 14/06/2019 17:02:36
    $update_time2 = date('Y-m-d H:i:s', $now);
    $sql = "UPDATE update_subprocess SET update_time='%s' WHERE id=1";
    $query = sprintf($sql, $update_time2);
    $result = mysqli_query($db, $query);
    if (!$result) die(mysqli_error($db));
    return $update_time2;
}

$db = db_connect();
$scorecard = getScorecard($db);
// ОБНОВЛЕНИЕ СКОРИНГОВОЙ КАРТЫ
$scorecard = updateScorecard($db, $scorecard);
$update_time = updateTime($db);
db_close($db);
sleep(2);
include './views/scorecard.php';
?>