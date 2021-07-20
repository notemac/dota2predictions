<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="./css/style-admin.css">
    <link rel="stylesheet" href="./js/themes/redstyle-tooltip2.css">
    <title>Dota 2 Predictions - Прогнозы на матчи Dota 2</title>
    <script type="text/javascript" src="./js/MathJax/MathJax.js?config=TeX-MML-AM_CHTML"></script>
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
                <div class="navbar-item"><a href="./update-model.php">Обновление модели</a></div>
                <div class="navbar-item navbar-active-item"><a href="./what-if.php">Анализ "Что-если"</a></div>
                <div class="navbar-item"><a href="./report.php">Отчет</a></div>
            </div>
        </nav>
    </header>

    <main>
        <div class="wifw-header">ВХОДНЫЕ ПЕРЕМЕННЫЕ</div>
        <div class="wi-form-wrapper">
            <div class="wifw-row">
                <div class="wifw-item">
                    <label for="wifw-counters">COUNTERS =</label>
                    <input id="wifw-counters" autofocus class="wifw-input" type="text" maxlength="10" placeholder="Введите число">
                </div>
                <div class="wifw-item">
                    <label for="wifw-deathl25">DEATH_L25 =</label>
                    <input id="wifw-deathl25" class="wifw-input" type="text" maxlength="10" placeholder="Введите число">
                </div>
                <div class="wifw-item">
                    <label for="wifw-lmavg">LM_AVG =</label>
                    <input id="wifw-lmavg" class="wifw-input" type="text" maxlength="10" placeholder="Введите число">
                </div>
            </div>
            <div class="wifw-row">
                <div class="wifw-item">
                    <label for="wifw-winrate12">WINRATE12 =</label>
                    <input id="wifw-winrate12" class="wifw-input" type="text" maxlength="10" placeholder="Введите число">
                </div>
                <div class="wifw-item">
                    <label for="wifw-pwinrate">PWINRATE =</label>
                    <input id="wifw-pwinrate" class="wifw-input" type="text" maxlength="10" placeholder="Введите число">
                </div>
                <div class="wifw-item">
                    <label for="wifw-hwravg">HWR_AVG =</label>
                    <input id="wifw-hwravg" class="wifw-input" type="text" maxlength="10" placeholder="Введите число">
                </div>
            </div>
        </div>
        <div class="wifw-calculate">Рассчитать</div>
        <div class="wi-result-wrapper">
            <div class="wifw-header">КОЭФФИЦИЕНТЫ РЕГРЕССИИ</div>
            <div class="wifw-coef-wrapper">
                <div class="wifw-coef-row">
                    <div class="wcr-counters wcr-item"></div>
                    <div class="wcr-deathl25 wcr-item"></div>
                    <div class="wcr-lmavg wcr-item"></div>
                </div>
                <div class="wifw-coef-row">
                    <div class="wcr-winrate12 wcr-item"></div>
                    <div class="wcr-pwinrate wcr-item"></div>
                    <div class="wcr-hwravg wcr-item"></div>
                </div>
            </div>
            <div class="wifw-header">УРАВНЕНИЕ РЕГРЕССИИ</div>
            <!-- <div class="wifw-equation wifw-y">$$Y=-0,8095-1,18842+0,37435+0,33149-0,39431+0,33121-0,26284=0,12122$$</div> -->
            <div class="wifw-equation wifw-y"></div>
            <div class="wifw-header">ВЕРОЯТНОСТЬ ПОБЕДЫ</div>
            <!-- <div class="wifw-equationP wifw-p">$$P={1 \over 1+e^{-0.1212}}=0.65$$</div> -->
            <!-- НЕОБХОДИМО ВСТАВИТЬ ХОЯТ БЫ ОДНУ ФОРМУЛУ ДЛЯ ЗАПУСКА MathJax -->
            <div class="wifw-equationP wifw-p">$$123123123$$</div>
            <div class="wifw-header">СКОРИНГОВЫЙ БАЛЛ</div>
            <!-- <div class="wifw-equation wifw-score">$$SCORE=463,7657+34,2906-10,8015-9,5648+11,3771+2,1212+7,584=888,1212$$</div> -->
            <div class="wifw-equation wifw-score"></div>
        </div>
    </main>
    <script src="./js/utils.js"></script>
    <script src="./js/jquery-3.4.0.min.js"></script>
    <!--TOOLTIPS  https://atomiks.github.io/tippyjs/ -->
    <script src="./js/popper.min.js"></script>
    <script src="./js/index.all.min.js"></script>
    <!--TOOLTIPS -->
    <script type="text/javascript">
        var scorecard = <?php echo json_encode($scorecard); ?>;
    </script>
    <script src="./js/d2predicts-what-if.js"></script>
</body>

</html>