<?php
//РАБОТА С БД
define('MYSQL_SERVER', 'localhost');
define('MYSQL_USER', 'root');
define('MYSQL_PASSWORD', '');
define('MYSQL_DB', 'dota2predictions');

function db_connect() {
    $link = mysqli_connect(MYSQL_SERVER, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB);
    if (!$link) die("Error: ".mysqli_error($link));
    if (!mysqli_set_charset($link, 'utf8')) { 
        echo("Error: ".mysqli_error($link)); 
    }
    return $link;
}

function db_close($db) {
    mysqli_close($db);
}
// function is_admin($link, $login, $password) {
//     $query = sprintf("SELECT * FROM user WHERE login='%s' AND password='%s'", $login, $password);
//     $result = mysqli_query($link, $query);
//     if (!$result) die(mysqli_error($link));   
//     return ($result->num_rows > 0) ? true : false;
// }
