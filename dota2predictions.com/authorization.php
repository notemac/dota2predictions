<?php
// АВТОРИЗАЦИЯ с помощью Steam OpenID
require './lightopenid/openid.php';

session_start();

$steamkey = 'XXX';
$return_url = 'dota2predictions.com'; // (localhost) возращаемся на главную страницу после авторизации
$admin_steamid = '76561198147168434';

try {
    $openid = new LightOpenID($return_url);
    if (!$openid->mode) {
        $openid->identity = 'https://steamcommunity.com/openid/'; //http
        header('Location: '.$openid->authUrl());
    } elseif ($openid->mode == 'cancel') {
        echo 'User has canceled authentication';
    } else {
        if ($openid->validate()) { // Если успешно авторизовались
            $steamid = explode('/', $openid->identity)[5]; // 'http://steamcommunity.com/openid/id/steamid'
            $url = "https://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key={$steamkey}&steamids={$steamid}";//http
            $json_object = file_get_contents($url);
            $json_decoded = json_decode($json_object);
            $user_name = $json_decoded->response->players[0]->personaname;
            $_SESSION['authorized'] = true;
            $_SESSION['user_steamid'] = $steamid;
            $_SESSION['user_name'] = $user_name;
            $_SESSION['is_admin'] = ($steamid == $admin_steamid) ? true : false;
            // Ending a session in 20 minutes from the starting time
            $_SESSION['expired'] = time() + 60 * 20;
            // Авторизация в админ панель?
            if (isset($_GET['admin']) && $_SESSION['is_admin']) header('Location: ./admin.php');
            else header('Location: ./index.php');
        } else {
            echo 'User is not logged in.';
        }
    }
} catch (ErrorException $e) {
    echo $e->getMessage();
}

// include './views/index.php';
