<?php // СКРИПТ ПРОГНОЗИРОВАНИЯ

require_once './db.php';

// Извлечь все матчи указанной команды
// @param String $team_id
function getMatches($db, $team_id, $period)
{
    //(date>'2018-08-06')
    if ($period == 'All time')
        $query = sprintf("SELECT * FROM `match` WHERE (winner='%s' OR loser='%s') ORDER BY date DESC", $team_id, $team_id);
    else if ($period == '12 months')
        $query = sprintf( "SELECT * FROM `match` WHERE ((winner='%s' OR loser='%s') AND date>'2018-02-05') ORDER BY date DESC", $team_id, $team_id);
    else if ($period == '6 months')
        $query = sprintf("SELECT * FROM `match` WHERE ((winner='%s' OR loser='%s') AND date>'2018-08-05') ORDER BY date DESC", $team_id, $team_id);
    else
        $query = sprintf("SELECT * FROM `match` WHERE ((winner='%s' OR loser='%s') AND date>'2018-02-05') ORDER BY date DESC", $team_id, $team_id);
    $result = mysqli_query($db, $query);
    if (!$result)
        die(mysqli_error($db));
    $num_rows = mysqli_num_rows($result);
    $matches = array();
    for ($i = 0; $i < $num_rows; $i++) {
        $matches[$i] = mysqli_fetch_assoc($result);
    }
    return $matches;
}

// COUNTERS
// @params $radiant_heroes, $dire_heroes - массивы с именами героев 
function getCounters($db, $radiant_heroes, $dire_heroes)
{
    // Извлекаем строки из таблицы `counter`
    $query = "SELECT h1, h2, disadvantage FROM `counter`";
    $result = mysqli_query($db, $query);
    if (!$result)
        die(mysqli_error($db));
    $num_rows = mysqli_num_rows($result);
    $counter_rows = array();
    for ($i = 0; $i < $num_rows; $i++) {
        $counter_rows[$i] = mysqli_fetch_assoc($result);
    }
    // Извлекаем список имен героев
    $query = "SELECT name1 FROM `hero`";
    $result = mysqli_query($db, $query);
    if (!$result)
        die(mysqli_error($db));
    $num_rows = mysqli_num_rows($result);
    $heroes = array();
    for ($i = 0; $i < $num_rows; $i++) {
        $heroes[$i] = mysqli_fetch_assoc($result);
    }
    // Сохраняем данные об эффективности героев в массив
    $counters = array();
    foreach ($heroes as $hero) {
        $counters[$hero['name1']] = array();
    }
    foreach ($counter_rows as $counter) {
        $counters[$counter['h1']][$counter['h2']] = $counter['disadvantage'];
    }
    // COUNTERS
    $COUNTERS = array();
    foreach ($radiant_heroes as $rh) {
        $COUNTERS[$rh] = array();
        foreach ($dire_heroes as $dh) {
            $COUNTERS[$rh][] = $counters[$rh][$dh];
        }
        $COUNTERS[$rh][] = array_sum($COUNTERS[$rh]) / 5; // добавляем в конец строки среднее значение по этой строке 
    }
    return $COUNTERS;
}

// VERSUS WINRATE
function getVersusWinrate($radiant_id, $dire_id, $matches)
{
    //$wins = array('radiant' => 1, 'dire' => 1); // (кол-во побед Radiant, кол-во побед Dire)
    $wins = ['radiant' => 0, 'dire' => 0]; // (кол-во побед Radiant, кол-во побед Dire)
    $count = 0; // кол-во матчей (из последних 10 матчей)
    // последние 10 матчей команд между собой
    $last_matches = [];
    foreach ($matches as $match) {
        if (($match['winner'] == $radiant_id) && ($match['loser'] == $dire_id)) {
            $wins['radiant'] += 1;
            // сохраняем 10 последних матчей
            if ($count < 10) {
                $last_matches[$count] = [];
                $last_matches[$count]['radiant_win'] = true;
                $last_matches[$count]['date'] = explode(' ', $match['date'])[0]; // 2016-05-01 00:51:00
                $last_matches[$count]['duration'] = ($match['duration'][1] == '0') // 00:23:51
                    ? substr($match['duration'], 3) // 23:51
                    : substr($match['duration'], 1); // 1:23:51
                $last_matches[$count]['r1'] = $match['wh1'];
                $last_matches[$count]['r2'] = $match['wh2'];
                $last_matches[$count]['r3'] = $match['wh3'];
                $last_matches[$count]['r4'] = $match['wh4'];
                $last_matches[$count]['r5'] = $match['wh5'];
                $last_matches[$count]['d1'] = $match['lh1'];
                $last_matches[$count]['d2'] = $match['lh2'];
                $last_matches[$count]['d3'] = $match['lh3'];
                $last_matches[$count]['d4'] = $match['lh4'];
                $last_matches[$count]['d5'] = $match['lh5'];
                $last_matches[$count]['rkills'] = $match['wkills'];
                $last_matches[$count]['dkills'] = $match['lkills'];
                $last_matches[$count]['match_id'] = $match['id'];
                $count += 1;
            }
        } else if (($match['winner'] == $dire_id) && ($match['loser'] == $radiant_id)) {
            $wins['dire'] += 1;
            // сохраняем 10 последних матчей
            if ($count < 10) {
                $last_matches[$count] = [];
                $last_matches[$count]['radiant_win'] = false;
                $last_matches[$count]['date'] = explode(' ', $match['date'])[0]; // 2016-05-01 00:51:00
                $last_matches[$count]['duration'] = ($match['duration'][1] == '0') // 00:23:51
                    ? substr($match['duration'], 3) // 23:51
                    : substr($match['duration'], 1); // 1:23:51
                $last_matches[$count]['d1'] = $match['wh1'];
                $last_matches[$count]['d2'] = $match['wh2'];
                $last_matches[$count]['d3'] = $match['wh3'];
                $last_matches[$count]['d4'] = $match['wh4'];
                $last_matches[$count]['d5'] = $match['wh5'];
                $last_matches[$count]['r1'] = $match['lh1'];
                $last_matches[$count]['r2'] = $match['lh2'];
                $last_matches[$count]['r3'] = $match['lh3'];
                $last_matches[$count]['r4'] = $match['lh4'];
                $last_matches[$count]['r5'] = $match['lh5'];
                $last_matches[$count]['dkills'] = $match['wkills'];
                $last_matches[$count]['rkills'] = $match['lkills'];
                $last_matches[$count]['match_id'] = $match['id'];
                $count += 1;
            }
        }
    }
    $radiant_winrate = 0.0;  $dire_winrate = 0.0;
    $num_matches = array_sum($wins);
    if ($num_matches != 0) {
        $radiant_winrate = round($wins['radiant'] * 100 / $num_matches, 1, PHP_ROUND_HALF_UP);
        $dire_winrate = 100.0 - $radiant_winrate;
    }
    return ['radiant_winrate' => $radiant_winrate, 'dire_winrate' => $dire_winrate, 'last-matches' => $last_matches,
        'wins' => ['radiant' => $wins['radiant'], 'dire' => $wins['dire'], 'all' => $wins['radiant'] + $wins['dire']]];
}

// WINRATE X MONTHS, AVERAGE LOST MATCH DURATION, HERO WINRATE, VERSUS HERO WINRATE, MATCHES with DEATH LESS 25
function get($team_id, $team_heroes, $matches, $opponent_heroes)
{
    $MAX_DATE = "2019-02-06 03:10:37";
    $winrate6 = ['win' => 1, 'lose' => 1]; // (кол-во побед, кол-во поражений)
    $lost_matches_duration = 0;
    $lost_matches_count = 0;
    $hwinrate = array();
    $vwinrate = array();
    $death_l25 = [1, 2]; // [кол-во матчей с числом смертей <= 25, кол-во всех матчей]
    foreach ($team_heroes as $h) {
        $hwinrate[$h] = ['win' => 1, 'lose' => 1]; // [кол-во побед за героя, кол-во поражений за героя]
    }
    foreach ($opponent_heroes as $h) {
        $vwinrate[$h] = ['win' => 1, 'lose' => 1]; // [кол-во побед против героя, кол-во поражений против героя]
    }
    foreach ($matches as $match) {
        // WINRATE 6 MONTHS
        //$interval = date_diff(new DateTime($match['date']), new DateTime($MAX_DATE));
        // if ($interval->days <= 183) { // если матч сыгран не более 6 месяцев наад (183 дней)
        //     ($match['winner'] == $team_id) ? ($winrate6['win'] += 1) : ($winrate6['lose'] += 1);
        // }
        ($match['winner'] == $team_id) ? ($winrate6['win'] += 1) : ($winrate6['lose'] += 1);
        if ($match['loser'] == $team_id) {
            // AVERAGE LOST MATCH DURATION
            $lost_matches_duration += strtotime($match['duration']) - strtotime('00:00:00'); // прдолжительность матчей в секундах
            $lost_matches_count += 1;
            // HERO WINRATE, VERSUS HERO WINRATE
            $lheroes = [$match['lh1'], $match['lh2'], $match['lh3'], $match['lh4'], $match['lh5']];
            foreach ($team_heroes as $h) {
                if (in_array($h, $lheroes))
                    $hwinrate[$h]['lose'] += 1;
            }
            $wheroes = [$match['wh1'], $match['wh2'], $match['wh3'], $match['wh4'], $match['wh5']];
            foreach ($opponent_heroes as $h) {
                if (in_array($h, $wheroes))
                    $vwinrate[$h]['lose'] += 1;
            }
            if ($match['wkills'] <= 25) $death_l25[0] += 1;
        } else { // ($match['winner'] == $team_id)
            // HERO WINRATE, VERSUS HERO WINRATE
            $wheroes = [$match['wh1'], $match['wh2'], $match['wh3'], $match['wh4'], $match['wh5']];
            foreach ($team_heroes as $h) {
                if (in_array($h, $wheroes))
                    $hwinrate[$h]['win'] += 1;
            }
            $lheroes = [$match['lh1'], $match['lh2'], $match['lh3'], $match['lh4'], $match['lh5']];
            foreach ($opponent_heroes as $h) {
                if (in_array($h, $lheroes))
                    $vwinrate[$h]['win'] += 1;
            }
            if ($match['lkills'] <= 25) $death_l25[0] += 1;
        }
        $death_l25[1] += 1;
    }
    // WINRATE 6 MONTHS
    $num_matches = array_sum($winrate6);
    $winrate6 = [
        'winrate' => round(($winrate6['win'] * 100 / $num_matches), 1, PHP_ROUND_HALF_UP),
        'win' => $winrate6['win'], 'all' => $num_matches
    ];
    // AVERAGE LOST MATCH DURATION
    $lm_avg = round($lost_matches_duration / $lost_matches_count, 0, PHP_ROUND_HALF_UP);
    // HERO WINRATE
    $avg_winrate = 0.0;
    foreach ($team_heroes as $h) {
        $hwinrate[$h]['winrate'] = $hwinrate[$h]['win'] * 100 / ($hwinrate[$h]['win'] + $hwinrate[$h]['lose']); // винрейт за героя
        $hwinrate[$h]['all'] = $hwinrate[$h]['win'] + $hwinrate[$h]['lose']; // общее кол-во матчей за героя
        $avg_winrate += $hwinrate[$h]['winrate'];
    }
    $hwinrate['avg_winrate'] = $avg_winrate / 5;
    $avg_winrate = 0.0;
    // VERSUS HERO WINRATE
    foreach ($opponent_heroes as $h) {
        $vwinrate[$h]['winrate'] = $vwinrate[$h]['win'] * 100 / ($vwinrate[$h]['win'] + $vwinrate[$h]['lose']); // винрейт против героея
        $vwinrate[$h]['all'] = $vwinrate[$h]['win'] + $vwinrate[$h]['lose']; // общее кол-во матчей против героя
        $avg_winrate += $vwinrate[$h]['winrate'];
    }
    $vwinrate['avg_winrate'] = $avg_winrate / 5;
    // MATCHES with DEATH LESS 25
    $death_l25[2] = $death_l25[0] * 100 / $death_l25[1];
    return ['winrate6' => $winrate6, 'lm_avg' => $lm_avg, 'hwinrate' => $hwinrate, 'vwinrate' => $vwinrate, 'death_l25' => $death_l25];
}

// Возращает скоринговую карту
function getScorecard($db)
{
    $query = "SELECT score FROM `factor`";
    $result = mysqli_query($db, $query);
    if (!$result)
        die(mysqli_error($db));
    $scorecard = [];
    $rows = [];
    for ($i = 0; $i < 6; ++$i) { // 6 факторов
        // фактор состоит из 5 категорий (интервалов)
        $rows[] = mysqli_fetch_assoc($result)['score'];
        $rows[] = mysqli_fetch_assoc($result)['score'];
        $rows[] = mysqli_fetch_assoc($result)['score'];
        $rows[] = mysqli_fetch_assoc($result)['score'];
        $rows[] = mysqli_fetch_assoc($result)['score'];
        // меняем порядок факторов
        if ($i == 0) $scorecard['counters'] = [$rows[3], $rows[1], $rows[0], $rows[2], $rows[4]];
        else if ($i == 1) $scorecard['death_l25'] = [$rows[3], $rows[0], $rows[1], $rows[2], $rows[4]];
        else if ($i == 2) $scorecard['hwr_avg'] = [$rows[3], $rows[0], $rows[1], $rows[2], $rows[4]];
        else if ($i == 3) $scorecard['lm_avg'] = [$rows[3], $rows[0], $rows[1], $rows[2], $rows[4]];
        else if ($i == 4) $scorecard['pwinrate'] = [$rows[3], $rows[0], $rows[1], $rows[2], $rows[4]];
        else if ($i == 5) $scorecard['winrate6'] = [$rows[3], $rows[0], $rows[1], $rows[2], $rows[4]];
        // обнуляем rows
        $rows = [];
    }
    // Константа
    $scorecard['const'] = mysqli_fetch_assoc($result)['score'];
    return $scorecard;
}


// Возвращаются баллы
function getScore($factors, $scorecard) {
    // Отношение шансов
    /*$o_counters = function ($value) {
        // if ($value < -0.4059) return -2.05313;
        if ($value <= -0.4059) return 5.66777;
        // if (($value >= -0.4059) && ($value < -0.08118)) return -0.76305;
        if (($value > -0.4059) && ($value < -0.08118)) return 2.06428;
        if (($value >= -0.08118) && ($value <= 0.08118)) return 1;
        // if (($value >= 0.08118) && ($value < 0.4059)) return 0.72478;
        if (($value > 0.08118) && ($value < 0.4059)) return 0.48443;
        // if ($value >= 0.4059) return 2.01389;
        if ($value >= 0.4059) return 0.17644;
    };
    $o_deathl25 = function ($value) {
        if ($value < -10) return 0.71785;
        if (($value >= -10) && ($value < -2)) return 1;
        if (($value >= -2) && ($value < 3)) return 1.28834;
        if (($value >= 3) && ($value < 11)) return 1.60108;
        if ($value >= 11) return 2.2562;
    };
    $o_lmavg = function ($value) {
        if ($value < -174) return 0.8463;
        if (($value >= -174) && ($value < -50)) return 1;
        if (($value >= -50) && ($value < 43)) return 1.14604;
        if (($value >= 43) && ($value < 167)) return 1.23775;
        if ($value >= 167) return 1.48334;
    };
    $o_winrate6 = function ($value) {
        if ($value < -12) return 0.68773;
        if (($value >= -12) && ($value < -3)) return 1;
        if (($value >= -3) && ($value < 4)) return 1.12228;
        if (($value >= 4) && ($value < 13)) return 1.26686;
        if ($value >= 13) return 1.87245;
    };
    $o_pwinrate = function ($value) {
        if ($value < 35) return 0.45339;
        if (($value >= 35) && ($value < 45)) return 1;
        if (($value >= 45) && ($value < 55)) return 1.22486;
        if (($value >= 55) && ($value < 65)) return 1.51303;
        if ($value >= 65) return 3.28189;
    };
    $o_hwravg = function ($value) {
        if ($value < -17.7733) return 0.67236;
        if (($value >= -17.7733) && ($value < -3.9496)) return 1;
        if (($value >= -3.9496) && ($value < 3.9496)) return 1.16108;
        if (($value >= 3.9496) && ($value < 17.7733)) return 1.30062;
        if ($value >= 17.7732) return 1.97318;
    };*/
    // Скоринговые баллы
    $o_counters = function ($value, $scorecard) {
        // if ($value < -0.4059) return -59.2408;
        if ($value <= -0.4059) return $scorecard['counters'][0];
        // if (($value >= -0.4059) && ($value < -0.08118)) return -22.0170;
        if (($value > -0.4059) && ($value < -0.08118)) return $scorecard['counters'][1];
        if (($value >= -0.08118) && ($value <= 0.08118)) return $scorecard['counters'][2];
        // if (($value >= 0.08118) && ($value < 0.4059)) return 20.9127;
        if (($value > 0.08118) && ($value < 0.4059)) return $scorecard['counters'][3];
        // if ($value >= 0.4059) return 58.1086;
        if ($value >= 0.4059) return $scorecard['counters'][4];
    };
    $o_deathl25 = function ($value, $scorecard) {
        if ($value < -10) return $scorecard['death_l25'][0];
        if (($value >= -10) && ($value < -2)) return $scorecard['death_l25'][1];
        if (($value >= -2) && ($value < 3)) return $scorecard['death_l25'][2];
        if (($value >= 3) && ($value < 11)) return $scorecard['death_l25'][3];
        if ($value >= 11) return $scorecard['death_l25'][4];
    };
    $o_lmavg = function ($value, $scorecard) {
        if ($value < -174) return $scorecard['lm_avg'][0];
        if (($value >= -174) && ($value < -50)) return $scorecard['lm_avg'][1];
        if (($value >= -50) && ($value < 43)) return $scorecard['lm_avg'][2];
        if (($value >= 43) && ($value < 167)) return $scorecard['lm_avg'][3];
        if ($value >= 167) return $scorecard['lm_avg'][4];
    };
    $o_winrate6 = function ($value, $scorecard) {
        if ($value < -12) return $scorecard['winrate6'][0];
        if (($value >= -12) && ($value < -3)) return $scorecard['winrate6'][1];
        if (($value >= -3) && ($value < 4)) return $scorecard['winrate6'][2];
        if (($value >= 4) && ($value < 13)) return $scorecard['winrate6'][3];
        if ($value >= 13) return $scorecard['winrate6'][4];
    };
    $o_pwinrate = function ($value, $scorecard) {
        if ($value < 35) return $scorecard['pwinrate'][0];
        if (($value >= 35) && ($value < 45)) return $scorecard['pwinrate'][1];
        if (($value >= 45) && ($value < 55)) return $scorecard['pwinrate'][2];
        if (($value >= 55) && ($value < 65)) return $scorecard['pwinrate'][3];
        if ($value >= 65) return $scorecard['pwinrate'][4];
    };
    $o_hwravg = function ($value, $scorecard) {
        if ($value < -17.7733) return $scorecard['hwr_avg'][0];
        if (($value >= -17.7733) && ($value < -3.9496)) return $scorecard['hwr_avg'][1];
        if (($value >= -3.9496) && ($value < 3.9496)) return $scorecard['hwr_avg'][2];
        if (($value >= 3.9496) && ($value < 17.7733)) return $scorecard['hwr_avg'][3];
        if ($value >= 17.7732) return $scorecard['hwr_avg'][4];
    };
    $odds_info = [];
    $odds_info['winrate6'] = ['tag' => 'WR', 'radiant' => $o_winrate6($factors['winrate6'], $scorecard), 'dire' => $o_winrate6(-$factors['winrate6'], $scorecard)];
    if (($factors['pwinrate']['radiant'] == 0.0) && ($factors['pwinrate']['dire'] == 0.0)) // в таком случае шансы 50:50
        //$odds_info['pwinrate'] = ['tag' => 'VWR', 'radiant' => 1, 'dire' => 1];
        $odds_info['pwinrate'] = ['tag' => 'VWR', 'radiant' => $o_pwinrate($factors['pwinrate']['radiant'], $scorecard), 'dire' => $o_pwinrate($factors['pwinrate']['dire'], $scorecard)];
    else
        $odds_info['pwinrate'] = ['tag' => 'VWR', 'radiant' => $o_pwinrate($factors['pwinrate']['radiant'], $scorecard), 'dire' => $o_pwinrate($factors['pwinrate']['dire'], $scorecard)];
    $odds_info['death_l25'] = ['tag' => 'MWLT25D', 'radiant' => $o_deathl25($factors['death_l25'], $scorecard), 'dire' => $o_deathl25(-$factors['death_l25'], $scorecard)];
    $odds_info['lm_avg'] = ['tag' => 'ALMD', 'radiant' => $o_lmavg($factors['lm_avg'], $scorecard), 'dire' => $o_lmavg(-$factors['lm_avg'], $scorecard)];
    $odds_info['counters'] = ['tag' => 'HD', 'radiant' => $o_counters($factors['counters'], $scorecard), 'dire' => $o_counters(-$factors['counters'], $scorecard)];
    $odds_info['hwr_avg'] = ['tag' => 'HWR', 'radiant' => $o_hwravg($factors['hwr_avg'], $scorecard), 'dire' => $o_hwravg(-$factors['hwr_avg'], $scorecard)];
    $odds_info['radiant'] = $scorecard['const']; $odds_info['dire'] = $scorecard['const'];
    // foreach ($factors as $name => $value) {
    //     if ($odds_info[$name]['radiant'] > $odds_info[$name]['dire'])
    //         $odds_info['radiant'] += round($odds_info[$name]['radiant'], 3);
    //     else if ($odds_info[$name]['dire'] > $odds_info[$name]['radiant'])
    //         $odds_info['dire'] += round($odds_info[$name]['dire'], 3);
    // }
    foreach ($factors as $name => $value) {
        $odds_info['radiant'] += round($odds_info[$name]['radiant'], 3);
        $odds_info['dire'] += round($odds_info[$name]['dire'], 3);
    }
    return $odds_info;
}

function getFactors($counters, $versus_winrate, $winrate6, $lm_avg, $death_l25, $hwinrate, $vwinrate) {
    $factors = [];
    // COUNTERS
    $factors['counters'] = 0.0;
    foreach($counters as $c) {
        $factors['counters'] += $c[5];
    }
    //$factors['counters'] = round($factors['counters'] / 5, 4);
    $factors['counters'] = $factors['counters'] / 5;
    //$factors['counters'] = 0.04;
    //$factors['counters'] = -1.0071;
    //$factors['counters'] = -0.3677;
    // PWINRATE
    //$factors['pwinrate'] = round($versus_winrate['radiant_winrate']);
    $factors['pwinrate'] = ['radiant' => $versus_winrate['radiant_winrate'], 'dire' => $versus_winrate['dire_winrate']];
    //$factors['pwinrate'] = 70;
    // WINRATE6
    //$factors['winrate6'] = round($winrate6['radiant']['winrate'] - $winrate6['dire']['winrate']);
    $factors['winrate6'] = $winrate6['radiant']['winrate'] - $winrate6['dire']['winrate'];
    //$factors['winrate6'] = 15;
    // HWR_AVG
    //$factors['hwr_avg'] = round((($hwinrate['radiant']['avg_winrate'] - $hwinrate['dire']['avg_winrate']) + ($vwinrate['radiant']['avg_winrate'] - $vwinrate['dire']['avg_winrate']))/2, 4);
    $factors['hwr_avg'] = (($hwinrate['radiant']['avg_winrate'] - $hwinrate['dire']['avg_winrate']) + ($vwinrate['radiant']['avg_winrate'] - $vwinrate['dire']['avg_winrate'])) / 2;
    //$factors['hwr_avg'] = 18;
    // DEATH_L25
    //$factors['death_l25'] = round($death_l25['radiant'][2] - $death_l25['dire'][2]);
    $factors['death_l25'] = $death_l25['radiant'][2] - $death_l25['dire'][2];
    //$factors['death_l25'] = 12;
    // LM_AVG
    $factors['lm_avg'] = $lm_avg['radiant'] - $lm_avg['dire'];
    //$factors['lm_avg'] = 180;
    return $factors;
}

function getProbability($factors) {
    // Коэффициенты регрессии ИСХОДНЫЕ
    // $c_counters = function($value)  {
    //     if ($value < -0.4059) return -2.05313;
    //     if (($value >= -0.4059) && ($value < -0.08118)) return -0.76305;
    //     if (($value >= -0.08118) && ($value < 0.08118)) return 0;
    //     if (($value >= 0.08118) && ($value < 0.4059)) return 0.72478;
    //     if ($value >= 0.4059) return 2.01389;
    // };
    // Коэффициенты регрессии СКОРРЕКТИРОВАННЫЕ
    /* Знаки поменяны местами для того, чтобы отриацательные значения эффективности 
    соответсвовали превосходству в силе одного героя над другим */
    $c_counters = function ($value) {
        // if ($value < -0.4059) return -2.05313;
        if ($value <= -0.4059) return 1.55313;
        // if (($value >= -0.4059) && ($value < -0.08118)) return -0.76305;
        if (($value > -0.4059) && ($value < -0.08118)) return 0.72478;
        if (($value >= -0.08118) && ($value <= 0.08118)) return 0;
        // if (($value >= 0.08118) && ($value < 0.4059)) return 0.72478;
        if (($value > 0.08118) && ($value < 0.4059)) return -0.72478;
        // if ($value >= 0.4059) return 2.01389;
        if ($value >= 0.4059) return -1.55313;
    };
    $c_deathl25 = function ($value)  {
        if ($value < -10) return -0.33149;
        if (($value >= -10) && ($value < -2)) return 0;
        if (($value >= -2) && ($value < 3)) return 0.25335;
        if (($value >= 3) && ($value < 11)) return 0.47068;
        if ($value >= 11) return 0.81368;
    };
    $c_lmavg = function ($value)  {
        if ($value < -174) return -0.16688;
        if (($value >= -174) && ($value < -50)) return 0;
        if (($value >= -50) && ($value < 43)) return 0.13631;
        if (($value >= 43) && ($value < 167)) return 0.21329;
        if ($value >= 167) return 0.3943;
    };
    $c_winrate12 = function ($value)  {
        if ($value < -12) return -0.37435;
        if (($value >= -12) && ($value < -3)) return 0;
        if (($value >= -3) && ($value < 4)) return 0.1159;
        if (($value >= 4) && ($value < 13)) return 0.23654;
        if ($value >= 13) return 0.62725;
    };
    $c_pwinrate = function ($value)  {
        if ($value < 35) return -0.79101;
        if (($value >= 35) && ($value < 45)) return 0;
        if (($value >= 45) && ($value < 55)) return 0.20282;
        if (($value >= 55) && ($value < 65)) return 0.41411;
        if ($value >= 65) return 1.18842;
    };
    $c_hwravg = function ($value)  {
        if ($value < -17.7733) return -0.39697;
        if (($value >= -17.7733) && ($value < -3.9496)) return 0;
        if (($value >= -3.9496) && ($value < 3.9496)) return 0.14935;
        if (($value >= 3.9496) && ($value < 17.7733)) return 0.26284;
        if ($value >= 17.7732) return 0.67965;
    };
    $counters = $c_counters($factors['counters']);
    $death_l25 = $c_deathl25($factors['death_l25']);
    $lm_avg = $c_lmavg($factors['lm_avg']);
    $winrate12 = $c_winrate12($factors['winrate6']);
    $pwinrate = 0.0; // Если команды не сыграли между собой ни одного матча, то шансы 50:50 и коэффициент регрессии равен 0.
    if (($factors['pwinrate']['radiant'] != 0.0) || ($factors['pwinrate']['dire'] != 0.0))
        $pwinrate = $c_pwinrate($factors['pwinrate']['radiant']);
    $hwr_avg = $c_hwravg($factors['hwr_avg']);
    // echo $counters;
    // echo '<br>';
    // echo $death_l25;
    // echo '<br>';
    // echo $lm_avg;
    // echo '<br>';
    // echo $winrate6;
    // echo '<br>';
    // echo $pwinrate;
    // echo '<br>';
    // echo $hwr_avg;
    // echo '<br>';
    $y = -0.8095 + $counters + $death_l25 + $lm_avg + $winrate12 + $pwinrate + $hwr_avg;
    $p = 1/(1+exp(-$y));
    return $p*100; // переводим в проценты
}


function getProbabilityDIRE($factors)
{
    $c_counters = function ($value) {
        // if ($value < -0.4059) return -2.05313;
        if ($value <= -0.4059) return 1.55313;
        // if (($value >= -0.4059) && ($value < -0.08118)) return -0.76305;
        if (($value > -0.4059) && ($value < -0.08118)) return 0.72478;
        if (($value >= -0.08118) && ($value <= 0.08118)) return 0;
        // if (($value >= 0.08118) && ($value < 0.4059)) return 0.72478;
        if (($value > 0.08118) && ($value < 0.4059)) return -0.72478;
        // if ($value >= 0.4059) return 2.01389;
        if ($value >= 0.4059) return -1.55313;
    };
    $c_deathl25 = function ($value) {
        if ($value < -10) return -0.33149;
        if (($value >= -10) && ($value < -2)) return 0;
        if (($value >= -2) && ($value < 3)) return 0.25335;
        if (($value >= 3) && ($value < 11)) return 0.47068;
        if ($value >= 11) return 0.81368;
    };
    $c_lmavg = function ($value) {
        if ($value < -174) return -0.16688;
        if (($value >= -174) && ($value < -50)) return 0;
        if (($value >= -50) && ($value < 43)) return 0.13631;
        if (($value >= 43) && ($value < 167)) return 0.21329;
        if ($value >= 167) return 0.3943;
    };
    $c_winrate12 = function ($value) {
        if ($value < -12) return -0.37435;
        if (($value >= -12) && ($value < -3)) return 0;
        if (($value >= -3) && ($value < 4)) return 0.1159;
        if (($value >= 4) && ($value < 13)) return 0.23654;
        if ($value >= 13) return 0.62725;
    };
    $c_pwinrate = function ($value) {
        if ($value < 35) return -0.79101;
        if (($value >= 35) && ($value < 45)) return 0;
        if (($value >= 45) && ($value < 55)) return 0.20282;
        if (($value >= 55) && ($value < 65)) return 0.41411;
        if ($value >= 65) return 1.18842;
    };
    $c_hwravg = function ($value) {
        if ($value < -17.7733) return -0.39697;
        if (($value >= -17.7733) && ($value < -3.9496)) return 0;
        if (($value >= -3.9496) && ($value < 3.9496)) return 0.14935;
        if (($value >= 3.9496) && ($value < 17.7733)) return 0.26284;
        if ($value >= 17.7732) return 0.67965;
    };
    $counters = $c_counters(-$factors['counters']);
    $death_l25 = $c_deathl25(-$factors['death_l25']);
    $lm_avg = $c_lmavg(-$factors['lm_avg']);
    $winrate12 = $c_winrate12(-$factors['winrate6']);
    $pwinrate = 0.0; // Если команды не сыграли между собой ни одного матча, то шансы 50:50 и коэффициент регрессии равен 0.
    if (($factors['pwinrate']['radiant'] != 0.0) || ($factors['pwinrate']['dire'] != 0.0))
        $pwinrate = $c_pwinrate($factors['pwinrate']['dire']);
    $hwr_avg = $c_hwravg(-$factors['hwr_avg']);
    $y = -0.8095 + $counters + $death_l25 + $lm_avg + $winrate12 + $pwinrate + $hwr_avg;
    $p = 1 / (1 + exp(-$y));
    return $p * 100; // переводим в проценты
}

$db = db_connect();
$radiant_matches = getMatches($db, $_GET['radiant_id'], $_GET['period']);
$dire_matches = getMatches($db, $_GET['dire_id'], $_GET['period']);
$counters = getCounters($db, $_GET['radiant_heroes'], $_GET['dire_heroes']);
$scorecard = getScorecard($db);
db_close($db);
$versus_winrate = getVersusWinrate($_GET['radiant_id'], $_GET['dire_id'], $radiant_matches);
$radiant_result = get($_GET['radiant_id'], $_GET['radiant_heroes'], $radiant_matches, $_GET['dire_heroes']);
$dire_result = get($_GET['dire_id'], $_GET['dire_heroes'], $dire_matches, $_GET['radiant_heroes']);
$winrate6 = []; $lm_avg = []; $hwinrate = []; $vwinrate = []; $death_l25 = []; $win_probability = [];
$winrate6['radiant'] = $radiant_result['winrate6'];
$winrate6['dire'] = $dire_result['winrate6'];
$lm_avg['radiant'] = $radiant_result['lm_avg'];
$lm_avg['dire'] = $dire_result['lm_avg'];
$hwinrate['radiant'] = $radiant_result['hwinrate'];
$hwinrate['dire'] = $dire_result['hwinrate'];
$vwinrate['radiant'] = $radiant_result['vwinrate'];
$vwinrate['dire'] = $dire_result['vwinrate'];
$death_l25['radiant'] = $radiant_result['death_l25'];
$death_l25['dire'] = $dire_result['death_l25'];
$factors = getFactors($counters, $versus_winrate, $winrate6, $lm_avg, $death_l25, $hwinrate, $vwinrate);
/* Если вероятность большее 90%, отнимаем 15%. Во-первых, модель не тестировалась в реальных
условиях, во-вторых, вероятность 90% и больше - это слишком большая вероятность. */
$win_probability['radiant'] = round(getProbability($factors), 1);
// echo $win_probability['radiant'];
// echo '<br>';
if ($win_probability['radiant'] >= 95.0)
    $win_probability['radiant'] -= 20.0;
else if ($win_probability['radiant'] >= 90.0)
    $win_probability['radiant'] -= 15.0;
else if ($win_probability['radiant'] >= 85.0)
    $win_probability['radiant'] -= 10.0;
else if ($win_probability['radiant'] >= 80.0)
    $win_probability['radiant'] -= 5.0;
if ($win_probability['radiant'] <= 5.0)
    $win_probability['radiant'] += 20.0;
else if ($win_probability['radiant'] <= 10.0)
    $win_probability['radiant'] += 15.0;
else if ($win_probability['radiant'] <= 15.0)
    $win_probability['radiant'] += 10.0;
else if ($win_probability['radiant'] <= 20.0)
    $win_probability['radiant'] += 5.0;

$win_probability['dire'] = 100 - $win_probability['radiant'];
/* Считаем вероятность как для Radiant, так и для Dire, а затем выбираем наибольшее значение для проигравшего*/
$dire_probability = round(getProbabilityDIRE($factors), 1);
if (($win_probability['radiant'] < 50.0) && ($dire_probability < 50.0)) {
    while (($win_probability['radiant'] + $dire_probability) < 100) {
        $win_probability['radiant'] += 1;
        $dire_probability += 1; 
    }
}
if ($win_probability['radiant'] > $win_probability['dire']) {
    if ($dire_probability > $win_probability['dire']) {
        $win_probability['dire'] = $dire_probability;
        $win_probability['radiant'] = 100 - $dire_probability;
    }
}
else if ($win_probability['dire'] > $win_probability['radiant']) {
    if ($dire_probability < $win_probability['dire']) {
        $win_probability['dire'] = $dire_probability;
        $win_probability['radiant'] = 100 - $dire_probability;
    }
}
$odds_info = getScore($factors, $scorecard);
$period = $_GET['period'];
//var_dump($odds_info);
// var_dump($factors);
// echo '<br>';
// echo $p;
// $ret = array_map(null, $arr1, $arr2);
//sleep(2);

include './views/prediction.php'

?>