<div class="win-probability-wrapper">
    <select class="wp-select">
        <option <?php if ($period == 'All time') echo 'selected' ?> value="All time">All time</option>
        <option <?php if ($period == '12 months') echo 'selected' ?> value="12 months">12 months</option>
        <option <?php if ($period == '6 months') echo 'selected' ?> value="6 months">6 months</option>
    </select>
    <div class="win-probability">
        <div class="prediction-item-header">
            <div class="pih">
                <span class="white">WIN</span> PROBABILITY
            </div>
        </div>
        <div class="win-probability-body-wrapper">
            <div class="win-probability-body">
                <div class="wpb-radiant">
                    <div class="trophy" style="visibility: <?php echo ($win_probability['radiant'] > $win_probability['dire']) ? 'visible' : 'hidden' ?>;"> <img width=" 23px" height="21px" src="./assets/trophy2.png"> </div>
                    <div class="<?php echo ($win_probability['radiant'] > $win_probability['dire']) ? 'green' : 'red' ?>"> <?= $win_probability['radiant'] ?>% </div>
                </div>
                <div class="open-more-info">
                    more<br>info
                    <svg class="open-more-info-svg" viewbox="5 5 14 14">
                        <path d="M7.41 7.84L12 12.42l4.59-4.58L18 9.25l-6 6-6-6z"></path>
                    </svg>
                </div>
                <div class="wpb-dire">
                    <div class="<?php echo ($win_probability['dire'] > $win_probability['radiant']) ? 'green' : 'red' ?>"> <?= $win_probability['dire'] ?>% </div>
                    <div class="trophy" style="visibility: <?php echo ($win_probability['dire'] > $win_probability['radiant']) ? 'visible' : 'hidden' ?>;"> <img width="23px" height="21px" src="./assets/trophy2.png"> </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="more-wrapper">
    <div class="more-info-tooltip">The factor is the input variable for the statistical model used on which the prediction is based. Factor values are listed in the "Value" column. To see more information about the factor, move the mouse cursor over a row of a table. The "Score" column contains points ​​that show how much the chances of winning for one of the teams increase with a given factor value. The more points the more chances of winning. If the points are negative then the chances of winning are reduced with a given factor value.</div>
    <div class="more-info-tooltip-hd">"HD" is the average value of the disadvantage of the heroes of the Radiant team versus the heroes of the Dire team.</div>
    <div class="more-info-tooltip-vwr">"VWR" is the win rate of the Radiant team versus the Dire team.</div>
    <div class="more-info-tooltip-wr6m">"WR" is the difference between the Radiant team's win rate and the Dire team's win rate.</div>
    <div class="more-info-tooltip-hwr">"HWR" is the average value between the difference in win rates for the heroes of the Radiant team and the Dire team and the difference in win rates versus the heroes of each other.</div>
    <div class="more-info-tooltip-mwlt25d">"MWLT25D" is the difference between the proportion of matches with less than 25 deaths by the Radiant team and the Dire team.</div>
    <div class="more-info-tooltip-almd">"ALMD" is the difference between the average duration of lost matches by the Radiant team and the Dire team.</div>
    <div class="delim"></div>
    <div class="more-body">
        <div class="more-row">
            <div class="more-item ">Factor</div>
            <div class="more-item ">Value</div>
            <div class="more-item odds-wrapper">
                <div class="odds-wrapper-header">Score</div>
                <div class="odds-wrapper-body">
                    <div class="more-item "><?= $_GET['radiant_name'] ?></div>
                    <div class="more-item "><?= $_GET['dire_name'] ?></div>
                </div>
            </div>
        </div>
        <?php foreach ($factors as $name => $value) : ?>
            <div class="more-row">
                <div class="more-item "><?= $odds_info[$name]['tag'] ?></div>
                <?php if ($name != 'pwinrate') : ?>
                    <div class="more-item "><?= round($value, 3) ?></div>
                <?php else : ?>
                    <div class="more-item"><?= round($value['radiant'], 3) ?></div>
                <?php endif; ?>
                <?php
                if ($odds_info[$name]['radiant'] > $odds_info[$name]['dire']) {
                    echo '<div class="more-item green">+ ' . round($odds_info[$name]['radiant'], 3) . '</div>';
                    if (round($odds_info[$name]['dire'], 3) < 0.0)
                        echo '<div class="more-item red">- ' . -round($odds_info[$name]['dire'], 3) . '</div>';
                    else if (round($odds_info[$name]['dire'], 3) > 0.0)
                        echo '<div class="more-item green">+ ' . round($odds_info[$name]['dire'], 3) . '</div>';
                    else echo '<div class="more-item red">' . round($odds_info[$name]['dire'], 3) . '</div>';
                } else if ($odds_info[$name]['dire'] > $odds_info[$name]['radiant']) {
                    if (round($odds_info[$name]['radiant'], 3) < 0.0)
                        echo '<div class="more-item red">- ' . -round($odds_info[$name]['radiant'], 3) . '</div>';
                    else if (round($odds_info[$name]['radiant'], 3) > 0.0)
                        echo '<div class="more-item green">+ ' . round($odds_info[$name]['radiant'], 3) . '</div>';
                    else echo '<div class="more-item red">' . round($odds_info[$name]['radiant'], 3) . '</div>';
                    echo '<div class="more-item green">+ ' . round($odds_info[$name]['dire'], 3) . '</div>';
                } else if ((round($odds_info[$name]['radiant'], 3) < 0.0) && (round($odds_info[$name]['dire'], 3) < 0.0)) {
                    echo '<div class="more-item red">' . round($odds_info[$name]['radiant'], 3) . '</div>';
                    echo '<div class="more-item red">' . round($odds_info[$name]['dire'], 3) . '</div>';
                } else if (round($odds_info[$name]['radiant'], 3) == 0.0) {
                    echo '<div class="more-item green">' . round($odds_info[$name]['radiant'], 3) . '</div>';
                    echo '<div class="more-item green">' . round($odds_info[$name]['dire'], 3) . '</div>';
                } else {
                    echo '<div class="more-item green">+ ' . round($odds_info[$name]['radiant'], 3) . '</div>';
                    echo '<div class="more-item green">+ ' . round($odds_info[$name]['dire'], 3) . '</div>';
                }
                ?>
            </div>
        <?php endforeach; ?>
        <div class="more-row">
            <div class="more-item">In total (+offset):</div>
            <div class="more-item <?php echo (round($odds_info['radiant'], 3) > round($odds_info['dire'], 3) ? 'green' : 'red') ?>"><?= round($odds_info['radiant'], 3) ?>
            </div>
            <div class="more-item <?php echo (round($odds_info['dire'], 3) > round($odds_info['radiant'], 3) ? 'green' : 'red') ?>"><?= round($odds_info['dire'], 3) ?>
            </div>
        </div>
    </div>
</div>
<div class="winrate-wrapper">
    <span data-tooltip="We assume that the higher the teams's win rate and the teams's win rate versus opposing team, the better the chances of winning."></span>
    <div class="winrate-winrate6">
        <div class="prediction-item-header">
            <div class="pih">WIN RATE</div>
        </div>
        <div class="winrate-winrate6-body">
            <div class="vwb-text">
                <div class="vwb-radiant">
                    <?php if ($winrate6['radiant']['winrate'] > $winrate6['dire']['winrate']) : ?>
                        <span class="star"></span>
                    <?php endif; ?>
                    <?= $winrate6['radiant']['winrate'] ?>% (<?= $winrate6['radiant']['win'] ?> of <?= $winrate6['radiant']['all'] ?>)
                </div>
                <div class="vwb-dire ">
                    <?= $winrate6['dire']['winrate'] ?>% (<?= $winrate6['dire']['win'] ?> of <?= $winrate6['dire']['all'] ?>)
                    <?php if ($winrate6['dire']['winrate'] > $winrate6['radiant']['winrate']) : ?>
                        <span class="star"></span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="versus-winrate-wrapper">
        <div class="versus-winrate">
            <div class="prediction-item-header">
                <div class="pih">VERSUS WIN RATE</div>
            </div>
            <div class="versus-winrate-body">
                <div class="vwb-text">
                    <div class="vwb-radiant">
                        <?php if ($versus_winrate['radiant_winrate'] > $versus_winrate['dire_winrate']) : ?>
                            <span class="star"></span>
                        <?php endif; ?>
                        <?= $versus_winrate['radiant_winrate'] ?>% (<?= $versus_winrate['wins']['radiant'] ?> of <?= $versus_winrate['wins']['all'] ?>)
                    </div>
                    <div class="open-last-matches">
                        last
                        <svg class="open-last-matches-svg" viewbox="5 5 14 14">
                            <path d="M7.41 7.84L12 12.42l4.59-4.58L18 9.25l-6 6-6-6z"></path>
                        </svg>
                        matches
                    </div>
                    <div class="vwb-dire ">
                        <?= $versus_winrate['dire_winrate'] ?>% (<?= $versus_winrate['wins']['dire'] ?> of <?= $versus_winrate['wins']['all'] ?>)
                        <?php if ($versus_winrate['dire_winrate'] > $versus_winrate['radiant_winrate']) : ?>
                            <span class="star"></span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="last-matches-wrapper">
    <div class="delim"></div>
    <div class="last-matches">
        <div class="lmatch">
            <div class="match-item mdate">Date</div>
            <div class="match-item mduration">Duration</div>
            <div class="match-item mradiant"><?= $_GET['radiant_name'] ?>'s Heroes</div>
            <div class="match-item mresult">Result</div>
            <div class="match-item mdire"><?= $_GET['dire_name'] ?>'s Heroes</div>
            <div class="match-item mdetails"></div>
        </div>
        <?php foreach ($versus_winrate['last-matches'] as $match) : ?>
            <div class="lmatch">
                <div class="match-item mdate"><?= $match['date'] ?></div>
                <div class="match-item mduration"><?= $match['duration'] ?></div>
                <div class="match-item mheroes mradiant">
                    <img class="mhero" src="./assets/heroes/<?= $match['r1'] ?>.png">
                    <img class="mhero" src="./assets/heroes/<?= $match['r2'] ?>.png">
                    <img class="mhero" src="./assets/heroes/<?= $match['r3'] ?>.png">
                    <img class="mhero" src="./assets/heroes/<?= $match['r4'] ?>.png">
                    <img class="mhero" src="./assets/heroes/<?= $match['r5'] ?>.png">
                </div>
                <div class="match-item mresult">
                    <span class="<?php echo ($match['radiant_win']) ? 'green' : 'red' ?>"><?= $match['rkills'] ?></span>
                    <span class="green">-</span>
                    <span class="<?php echo ($match['radiant_win']) ? 'red' : 'green' ?>"><?= $match['dkills'] ?></span>
                </div>
                <div class="match-item mheroes mdire">
                    <img class="mhero" src="./assets/heroes/<?= $match['d1'] ?>.png">
                    <img class="mhero" src="./assets/heroes/<?= $match['d2'] ?>.png">
                    <img class="mhero" src="./assets/heroes/<?= $match['d3'] ?>.png">
                    <img class="mhero" src="./assets/heroes/<?= $match['d4'] ?>.png">
                    <img class="mhero" src="./assets/heroes/<?= $match['d5'] ?>.png">
                </div>
                <div class="match-item mdetails"><a href="https://www.dotabuff.com/matches/<?= $match['match_id'] ?>" target="_blank">details</a></div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<div class="deaths-lost-match">
    <span data-tooltip='We assume that the lower the proportion of matches with the number of deaths less than 25 and the longer the average duration of lost matches, the better the chances of winning.'></span>
    <div class="deathes-per-match">
        <div class="deathes-per-match-wrapper">
            <div class="prediction-item-header">
                <div class="pih">MATCHES WITH LESS THAN 25 DEATHS</div>
            </div>
            <div class="deathes-per-match-body">
                <div class="dpm-text">
                    <div class="dpm-radiant">
                        <?php if (round($death_l25['radiant'][2], 1) > round($death_l25['dire'][2], 1)) echo '<span class="star"></span>'  ?>
                        <?= round($death_l25['radiant'][2], 1) ?>% (<?= $death_l25['radiant'][0] ?> of <?= $death_l25['radiant'][1] ?>)
                    </div>
                    <div class="dpm-dire ">
                        <?= round($death_l25['dire'][2], 1) ?>% (<?= $death_l25['dire'][0] ?> of <?= $death_l25['dire'][1] ?>)
                        <?php if (round($death_l25['dire'][2], 1) > round($death_l25['radiant'][2], 1)) echo '<span class="star"></span>'  ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="lost-match-duration">
        <div class="lost-match-duration-wrapper">
            <div class="prediction-item-header">
                <div class="pih">AVERAGE LOST MATCH DURATION</div>
            </div>
            <div class="lost-match-duration-body">
                <div class="vwb-text">
                    <div class="vwb-radiant">
                        <?php if ($lm_avg['radiant'] > $lm_avg['dire']) : ?>
                            <span class="star"></span>
                        <?php endif; ?>
                        <?php
                        $min = (int)($lm_avg['radiant'] / 60);
                        $sec = $lm_avg['radiant'] - $min * 60;
                        echo "{$min} min {$sec} sec";
                        ?>
                    </div>
                    <div class="vwb-dire ">
                        <?php
                        $min = (int)($lm_avg['dire'] / 60);
                        $sec = $lm_avg['dire'] - $min * 60;
                        echo "{$min} min {$sec} sec";
                        ?>
                        <?php if ($lm_avg['dire'] > $lm_avg['radiant']) : ?>
                            <span class="star"></span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="hero-counters">
    <span data-tooltip="Disadvantage measures the matchup between two heroes regardless of their normal win rate. It is calculated by establishing their win rates both in and outside of the matchup and comparing the difference against a base win rate. The calculation is based on data from millions of public matches for the last year. For example, the value &quot;-3&quot; means that one hero is about 3 times &quot;stronger&quot; than another hero. We assume that the greater the teams's average advantage of all the heroes, the better the chances of winning."></span>
    <div class="hero-counters-wrapper">
        <div class="prediction-item-header">
            <div class="pih">HERO DISADVANTAGE</div>
        </div>
        <div class="hero-counters-body">
            <div class="hcb-row">
                <div class="hcb-item"></div>
                <?php foreach ($_GET['dire_heroes'] as $hero) : ?>
                    <div class="hcb-item"><img class="hcb-hero" src="./assets/heroes/<?= $hero ?>.png"></div>
                <?php endforeach; ?>
                <div class="hcb-item">AVERAGE</div>
            </div>
            <?php foreach ($_GET['radiant_heroes'] as $hero) : ?>
                <div class="hcb-row">
                    <div class="hcb-item"><img class="hcb-hero" src="./assets/heroes/<?= $hero ?>.png"></div>
                    <div class="hcb-item"><?= round($counters[$hero][0], 3) ?></div>
                    <div class="hcb-item"><?= round($counters[$hero][1], 3) ?></div>
                    <div class="hcb-item"><?= round($counters[$hero][2], 3) ?></div>
                    <div class="hcb-item"><?= round($counters[$hero][3], 3) ?></div>
                    <div class="hcb-item"><?= round($counters[$hero][4], 3) ?></div>
                    <div class="hcb-item">
                        <?= round($counters[$hero][5], 3) ?>
                        <?php if ($counters[$hero][5] < 0.0) echo '<span class="star"></span>' ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<div class="hero-winrate">
    <span data-tooltip="We assume that the higher the teams's average win rate of all the heroes, the better the chances of winning."></span>
    <div class="hero-winrate-wrapper">
        <div class="prediction-item-header">
            <div class="pih">HERO WIN RATE</div>
        </div>
        <div class="hero-winrate-body">
            <?php for ($i = 0; $i < 5; ++$i) : ?>
                <div class="hwb-row">
                    <div class="hwb-radiant">
                        <div class="hwb-hero-slot"><img id="hwb-h1" class="hwb-hero" src="./assets/heroes/<?= $_GET['radiant_heroes'][$i] ?>.png"></div>
                        <div class="hwb-item2">
                            <div class="item2-text">
                                <?= round($hwinrate['radiant'][$_GET['radiant_heroes'][$i]]['winrate'], 1) ?>% (<?= $hwinrate['radiant'][$_GET['radiant_heroes'][$i]]['win'] ?>-<?= $hwinrate['radiant'][$_GET['radiant_heroes'][$i]]['lose'] ?>)
                            </div>
                            <div class="item2-progress">
                                <?php $width1 = round(160 * round($hwinrate['radiant'][$_GET['radiant_heroes'][$i]]['winrate'], 1) / 100); ?>
                                <?php $width2 = 160 - $width1; ?>
                                <div style="width: <?= $width1 ?>px;"></div>
                                <div style="width: <?= $width2 ?>px;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="hwb-dire">
                        <div class="hwb-item2">
                            <div class="item2-text">
                                <?= round($hwinrate['dire'][$_GET['dire_heroes'][$i]]['winrate'], 1) ?>% (<?= $hwinrate['dire'][$_GET['dire_heroes'][$i]]['win'] ?>-<?= $hwinrate['dire'][$_GET['dire_heroes'][$i]]['lose'] ?>)
                            </div>
                            <div class="item2-progress">
                                <?php $width1 = round(160 * round($hwinrate['dire'][$_GET['dire_heroes'][$i]]['winrate'], 1) / 100); ?>
                                <?php $width2 = 160 - $width1; ?>
                                <div style="width: <?= $width1 ?>px;"></div>
                                <div style="width: <?= $width2 ?>px;"></div>
                            </div>
                        </div>
                        <div class="hwb-hero-slot"><img id="hwb-h6" class="hwb-hero" src="./assets/heroes/<?= $_GET['dire_heroes'][$i] ?>.png"></div>
                    </div>
                </div>
            <?php endfor; ?>
            <div class="hwb-row">
                <div class="item-last-text">
                    <div class="hwb-item">
                        <?php if (round($hwinrate['radiant']['avg_winrate'], 1) > round($hwinrate['dire']['avg_winrate'], 1)) echo '<span class="star"></span>' ?>
                        <?= round($hwinrate['radiant']['avg_winrate'], 1) ?>%
                    </div>
                    <div class="hwb-item">AVERAGE</div>
                    <div class="hwb-item">
                        <?= round($hwinrate['dire']['avg_winrate'], 1) ?>%
                        <?php if (round($hwinrate['dire']['avg_winrate'], 1) > round($hwinrate['radiant']['avg_winrate'], 1)) echo '<span class="star"></span>' ?>
                    </div>
                </div>
                <div class="item-last-progress">
                    <?php
                    // находим ширину элементов ".item-last-progress div" через пропорцию: rw/dw = x/y (x+y=294),
                    // где rw - average radiant winrate, dw - average dire winrate, x - ширина radiant div, y - ширина dire div, 294 - длина ".item-last-progress"
                    $y = (int)((round($hwinrate['dire']['avg_winrate'], 1) * 294) / (round($hwinrate['dire']['avg_winrate'], 1) + round($hwinrate['radiant']['avg_winrate'], 1)));
                    $x = 294 - $y;
                    ?>
                    <div style="width: <?= $x ?>px; background-color: <?php echo (round($hwinrate['radiant']['avg_winrate'], 1) > round($hwinrate['dire']['avg_winrate'], 1)) ? 'rgba(55, 246, 55, 0.76)' : 'rgb(248, 24, 24);' ?>;"></div>
                    <div style="width: <?= $y ?>px; background-color: <?php echo (round($hwinrate['dire']['avg_winrate'], 1) > round($hwinrate['radiant']['avg_winrate'], 1)) ? 'rgba(55, 246, 55, 0.76)' : 'rgb(248, 24, 24);' ?>;"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="versus-hero-winrate">
    <span data-tooltip="We assume that the higher the teams's average win rate versus all the heroes of opposing team, the better the chances of winning."></span>
    <div class="versus-hero-winrate-wrapper">
        <div class="prediction-item-header">
            <div class="pih"> VERSUS HERO WIN RATE</div>
        </div>
        <div class="versus-hero-winrate-body">
            <?php for ($i = 0; $i < 5; ++$i) : ?>
                <div class="hwb-row">
                    <div class="hwb-radiant">
                        <div class="hwb-hero-slot"><img id="hwb-h1" class="hwb-hero" src="./assets/heroes/<?= $_GET['dire_heroes'][$i] ?>.png"></div>
                        <div class="hwb-item2">
                            <div class="item2-text">
                                <?= round($vwinrate['radiant'][$_GET['dire_heroes'][$i]]['winrate'], 1) ?>% (<?= $vwinrate['radiant'][$_GET['dire_heroes'][$i]]['win'] ?>-<?= $vwinrate['radiant'][$_GET['dire_heroes'][$i]]['lose'] ?>)
                            </div>
                            <div class="item2-progress">
                                <?php $width1 = round(160 * round($vwinrate['radiant'][$_GET['dire_heroes'][$i]]['winrate'], 1) / 100); ?>
                                <?php $width2 = 160 - $width1; ?>
                                <div style="width: <?= $width1 ?>px;"></div>
                                <div style="width: <?= $width2 ?>px;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="hwb-dire">
                        <div class="hwb-item2">
                            <div class="item2-text">
                                <?= round($vwinrate['dire'][$_GET['radiant_heroes'][$i]]['winrate'], 1) ?>% (<?= $vwinrate['dire'][$_GET['radiant_heroes'][$i]]['win'] ?>-<?= $vwinrate['dire'][$_GET['radiant_heroes'][$i]]['lose'] ?>)
                            </div>
                            <div class="item2-progress">
                                <?php $width1 = round(160 * round($vwinrate['dire'][$_GET['radiant_heroes'][$i]]['winrate'], 1) / 100); ?>
                                <?php $width2 = 160 - $width1; ?>
                                <div style="width: <?= $width1 ?>px;"></div>
                                <div style="width: <?= $width2 ?>px;"></div>
                            </div>
                        </div>
                        <div class="hwb-hero-slot"><img id="hwb-h6" class="hwb-hero" src="./assets/heroes/<?= $_GET['radiant_heroes'][$i] ?>.png"></div>
                    </div>
                </div>
            <?php endfor; ?>
            <div class="vhwb-row">
                <div class="item-last-text">
                    <div class="hwb-item">
                        <?php if (round($vwinrate['radiant']['avg_winrate'], 1) > round($vwinrate['dire']['avg_winrate'], 1)) echo '<span class="star"></span>' ?>
                        <?= round($vwinrate['radiant']['avg_winrate'], 1) ?>%
                    </div>
                    <div class="hwb-item">AVERAGE</div>
                    <div class="hwb-item">
                        <?= round($vwinrate['dire']['avg_winrate'], 1) ?>%
                        <?php if (round($vwinrate['dire']['avg_winrate'], 1) > round($vwinrate['radiant']['avg_winrate'], 1)) echo '<span class="star"></span>' ?>
                    </div>
                </div>
                <div class="item-last-progress">
                    <?php
                    // находим ширину элементов ".item-last-progress div" через пропорцию: rw/dw = x/y (x+y=294),
                    // где rw - average radiant winrate, dw - average dire winrate, x - ширина radiant div, y - ширина dire div, 294 - длина ".item-last-progress"
                    $y = (int)((round($vwinrate['dire']['avg_winrate'], 1) * 294) / (round($vwinrate['dire']['avg_winrate'], 1) + round($vwinrate['radiant']['avg_winrate'], 1)));
                    $x = 294 - $y;
                    ?>
                    <div style="width: <?= $x ?>px; background-color: <?php echo (round($vwinrate['radiant']['avg_winrate'], 1) > round($vwinrate['dire']['avg_winrate'], 1)) ? 'rgba(55, 246, 55, 0.76)' : 'rgb(248, 24, 24);' ?>;"></div>
                    <div style="width: <?= $y ?>px; background-color: <?php echo (round($vwinrate['dire']['avg_winrate'], 1) > round($vwinrate['radiant']['avg_winrate'], 1)) ? 'rgba(55, 246, 55, 0.76)' : 'rgb(248, 24, 24);' ?>;"></div>
                </div>
            </div>
        </div>
    </div>
</div>