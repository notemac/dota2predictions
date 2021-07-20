<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="./css/style-admin.css">
    <link rel="stylesheet" href="./js/themes/redstyle-tooltip2.css">
    <title>Dota 2 Predictions - Прогнозы на матчи Dota 2</title>
</head>

<body>
    <header>
        <nav>
            <div class="navbar-logo">Панель администратора
                <div class="dropdown-menu">
                    Выйти &#10006;
                </div>
            </div>
            <div class="navbar-menu">
                <div class="navbar-item navbar-active-item"><a href="./update-model.php">Обновление модели</a></div>
                <div class="navbar-item"><a href="./what-if.php">Анализ "Что-если"</a></div>
                <div class="navbar-item"><a href="./report.php">Отчет</a></div>
            </div>
        </nav>
    </header>

    <main>
        <div class="um-header um-not-active">ОБНОВЛЕНИЕ ГЕНЕРАЛЬНОЙ СОВОКУПНОСТИ</div>
        <div class="um-header umh2 um-not-active">СЭМПЛИНГ</div>
        <div class="um-sampling-wrapper">
            <div class="umsa-row"> Параметры сэмплинга </div>
            <div class="umsa-row">
                <div class="umsar-item">
                    <label for="umsar-train"><i>Size<sub>training</sub></i> =</label>
                    <input id="umsar-train" disabled class="umsar-input" type="text" maxlength="3" value="80%" placeholder="">
                    <div style="line-height: 1.75;">(24907)</div>
                </div>
                <div class="umsar-item">
                    <label for="umsar-test"><i>Size<sub>test</sub></i> =</label>
                    <input id="umsar-test" disabled class="umsar-input" type="text" maxlength="3" value="20%" placeholder="">
                    <div style="line-height: 1.75;">(6227)</div>
                </div>
                <label id="label-umsar-select" for="umsar-select"><i>Method:</i></label>
                <select disabled id="umsar-select" class="umsar-select">
                    <option value="Случайный">Случайный</option>
                    <option value="Равномерный случайный">Равномерный случайный</option>
                    <option selected value="Стратифицированный">Стратифицированный</option>
                    <option value="Последовательный">Последовательный</option>
                </select>
            </div>
            <div class="umsa-row">
                <div class="umsar-settings">Настроить</div>
                <!-- <div class="umsar-save">Обновить</div> -->
                <!-- <div class="umsar-open">Показать карту</div> -->
            </div>
        </div>
        <div class="um-header um-not-active">ОБУЧЕНИЕ МОДЕЛИ</div>
        <div class="um-header um-score-header">
            <div class="last-update-date">
                <span>Последнее обновление:</span><br>
                <span><?=$update_time?></span>
            </div>
            РАСЧЕТ СКОРИНГОВОЙ КАРТЫ
            <svg class="" viewbox="5 5 14 14">
                <path d="M 7.41 15.41 L 12 10.83 l 4.59 4.58 L 18 14 l -6 -6 l -6 6 Z"></path>
            </svg>
        </div>
        <div class="score-wrapper">
            <div class="um-score-wrapper">
                <div class="ums-row"> Параметры масштабирования </div>
                <div class="ums-row">
                    <div class="umsr-item">
                        <label for="umsr-score"><i>Score</i> =</label>
                        <input id="umsr-score" disabled class="umsr-input" type="text" maxlength="3" value="<?= $scorecard['score'] ?>" placeholder="">
                    </div>
                    <div class="umsr-item">
                        <label for="umsr-odds"><i>Odds</i> =</label>
                        <input id="umsr-odds" disabled class="umsr-input" type="text" maxlength="3" value="<?= $scorecard['odds'] ?>" placeholder="">
                    </div>
                    <div class="umsr-item">
                        <label for="umsr-pdo"><i>PDO</i> =</label>
                        <input id="umsr-pdo" disabled class="umsr-input" type="text" maxlength="3" value="<?= $scorecard['pdo'] ?>" placeholder="">
                    </div>
                    <select class="umsr-select">
                        <option selected value="none">Выбрать масштаб</option>
                        <option value="500 32 50">500 32:1 50</option>
                        <option value="600 30 20">600 30:1 20</option>
                        <option value="600 50 20">600 50:1 20</option>
                        <option value="660 72 40">660 72:1 40</option>
                    </select>
                </div>
                <div class="ums-row">
                    <div class="umsr-settings">Настроить</div>
                    <div class="umsr-save">Обновить</div>
                    <div class="umsr-open">Показать карту</div>
                </div>
            </div>
            <div class="um-score-wrapper2">
                <div class="ums-row2"> Скоринговая карта </div>
                <div class="ums-row2">
                    <div class="ums-table-wrapper">
                        <div class="umstw-header">
                            <div class="umstw-item">Фактор</div>
                            <div class="umstw-item">Балл</div>
                            <div class="umstw-item">Фактор</div>
                            <div class="umstw-item">Балл</div>
                        </div>
                        <?php for ($i = 0; $i < 3; ++$i) : ?>
                            <?php for ($j = 0; $j < 5; ++$j) : ?>
                                <div class="umstw-row">
                                    <div class="umstw-item"><?= $scorecard[$i][$j]['name'] ?></div>
                                    <div class="umstw-item"><?= $scorecard[$i][$j]['score'] ?></div>
                                    <div class="umstw-item"><?= $scorecard[$i + 3][$j]['name'] ?></div>
                                    <div class="umstw-item"><?= $scorecard[$i + 3][$j]['score'] ?></div>
                                </div>
                            <? endfor; ?>
                        <? endfor; ?>
                        <div class="umstw-row">
                            <div class="umstw-item"><?= $scorecard['const']['name'] ?></div>
                            <div class="umstw-item"><?= $scorecard['const']['score'] ?></div>
                            <div class="umstw-item"></div>
                            <div class="umstw-item"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="ums-updating-wrapper">
        </div>
    </main>
    <script src="./js/utils.js"></script>
    <script src="./js/jquery-3.4.0.min.js"></script>
    <!--TOOLTIPS  https://atomiks.github.io/tippyjs/ -->
    <script src="./js/popper.min.js"></script>
    <script src="./js/index.all.min.js"></script>
    <!--TOOLTIPS -->
    <script src="./js/d2predicts-update-model.js"></script>
</body>

</html>