<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="./css/style-admin.css">
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
                <div class="navbar-item"><a href="./update-model.php">Обновление модели</a></div>
                <div class="navbar-item"><a href="./what-if.php">Анализ "Что-если"</a></div>
                <div class="navbar-item navbar-active-item"><a href="./report.php">Отчет</a></div>
            </div>
        </nav>
    </header>
    <div class="report-wrapper">
        <div style="widht: 100%; height: 2px; background-color: #053c4b; margin-top: 17px;"></div>
        <div class="open-report12">
            ЛОГ-РЕГРЕССИЯ &laquo;ФИНАЛЬНАЯ&raquo;
            <svg class="" viewbox="5 5 14 14">
                <path d="M 7.41 15.41 L 12 10.83 l 4.59 4.58 L 18 14 l -6 -6 l -6 6 Z"></path>
            </svg>
        </div>
        <div class="report12">
            <div class="report1-wrapper">
                <div class="report1-header">
                    <div class="r1h-row">
                        <div class="r1hr-item">
                            <div style="margin-top: 2px;">-2 Log Likelihood</div>
                        </div>
                        <div class="r1hr-item">Хи-квадрат</div>
                        <div class="r1hr-item">df</div>
                        <div class="r1hr-item">R<sup>2</sup> МакФаддена</div>
                        <div class="r1hr-item">Значимость</div>
                        <div class="r1hr-item">
                            <div style="margin-top: 2px;">Метод отбора переменных</div>
                        </div>
                        <div class="r1hr-item">Score</div>
                        <div class="r1hr-item">Odds</div>
                        <div class="r1hr-item">PDO</div>
                    </div>
                </div>
                <div class="report1-body">
                    <div class="r1b-row">
                        <div class="r1br-item"><?= $report1['likelihood'] ?></div>
                        <div class="r1br-item"><?= $report1['chi2'] ?></div>
                        <div class="r1br-item"><?= $report1['df'] ?></div>
                        <div class="r1br-item"><?= $report1['r2mcfadden'] ?></div>
                        <div class="r1br-item"><?= $report1['p'] ?></div>
                        <div class="r1br-item"><?= $report1['method'] ?></div>
                        <div class="r1br-item"><?= $report1['score'] ?></div>
                        <div class="r1br-item"><?= $report1['odds'] ?></div>
                        <div class="r1br-item"><?= $report1['pdo'] ?></div>
                    </div>
                </div>
            </div>
            <div class="report2-wrapper">
                <div class="report2-header">
                    <div class="r2h-row">
                        <div class="r2hr-item">Фактор</div>
                        <div class="r2hr-item">Коэффициент</div>
                        <div class="r2hr-item">
                            <div style="margin-top: 21px;">
                                Стандратная ошибка
                            </div>
                        </div>
                        <div class="r2hr-item">
                            <div style="margin-top: 21px;">
                                Коэффициент Вальда
                            </div>
                        </div>
                        <div class="r2hr-item">Значимость</div>
                        <div class="r2hr-item">
                            <div style="margin-top: 21px;">
                                Отношение шансов
                            </div>
                        </div>
                        <div class="r2hr-item">
                            <div class="r2hri7-head">
                                95% доверительный интервал отношения шансов
                            </div>
                            <div class="r2hri7-tail">
                                <div class="r2hri7t-item">Мин</div>
                                <div class="r2hri7t-item">Макс</div>
                            </div>
                        </div>
                        <div class="r2hr-item r2hr-item8">Балл</div>
                    </div>
                </div>
                <div class="report2-body">
                    <?php foreach ($report2 as $name => $factor) : ?>
                        <?php if ($name == 'const') : ?>
                            <div class="r2b-row">
                                <div class="r2br-item">&nbsp;<?= $factor['name'] ?></div>
                                <div class="r2br-item"><?= $factor['b'] ?></div>
                                <div class="r2br-item">-</div>
                                <div class="r2br-item">-</div>
                                <div class="r2br-item">-</div>
                                <div class="r2br-item">-</div>
                                <div class="r2br-item">-</div>
                                <div class="r2br-item">-</div>
                                <div class="r2br-item"><?= $factor['score'] ?></div>
                            </div>
                        <?php else : ?>
                            <?php foreach ($factor as $values) : ?>
                                <div class="r2b-row">
                                    <div class="r2br-item">&nbsp;<?= $values['name'] ?></div>
                                    <div class="r2br-item"><?= $values['b'] ?></div>
                                    <div class="r2br-item"><?= $values['e'] ?></div>
                                    <div class="r2br-item"><?= ($values['wald'] == null) ? '-' : $values['wald']  ?></div>
                                    <div class="r2br-item"><?= ($values['p'] == null) ? '-' : $values['p']  ?></div>
                                    <div class="r2br-item"><?= $values['or'] ?></div>
                                    <div class="r2br-item"><?= $values['ci_min'] ?></div>
                                    <div class="r2br-item"><?= $values['ci_max'] ?></div>
                                    <div class="r2br-item"><?= $values['score'] ?></div>
                                </div>
                            <? endforeach; ?>
                        <?php endif; ?>
                    <? endforeach; ?>
                </div>
            </div>
        </div>
        <div class="open-report34">
            КАЧЕСТВО КЛАССИФИКАЦИИ
            <svg class="" viewbox="5 5 14 14">
                <path d="M 7.41 15.41 L 12 10.83 l 4.59 4.58 L 18 14 l -6 -6 l -6 6 Z"></path>
            </svg>
        </div>
        <div class="report34">
            <div class="report4-wrapper">
                <div class="r4w-row">
                    <div class="r4w-item">AUC<sub>training</sub></div>
                    <div class="r4w-item">AUC<sub>test</sub></div>
                    <div class="r4w-item">GINI<sub>training</sub></div>
                    <div class="r4w-item">GINI<sub>test</sub></div>
                    <div class="r4w-item">KS<sub>training</sub></div>
                    <div class="r4w-item">KS<sub>test</sub></div>
                    <div class="r4w-item">OSR<sub>all</sub>,%</div>
                    <div class="r4w-item">OVR<sub>all</sub>,%</div>
                    <div class="r4w-item">OSR<sub>training</sub>,%</div>
                    <div class="r4w-item">OVR<sub>training</sub>,%</div>
                    <div class="r4w-item">OSR<sub>test</sub>,%</div>
                    <div class="r4w-item">OVR<sub>test</sub>,%</div>
                </div>
                <div class="r4w-row">
                    <div class="r4w-item"><?= $report3['Training']['auc'] ?></div>
                    <div class="r4w-item"><?= $report3['Test']['auc'] ?></div>
                    <div class="r4w-item"><?= $report3['Training']['gini'] ?></div>
                    <div class="r4w-item"><?= $report3['Test']['gini'] ?></div>
                    <div class="r4w-item"><?= $report3['Training']['ks'] ?></div>
                    <div class="r4w-item"><?= $report3['Test']['ks'] ?></div>
                    <div class="r4w-item"><?= $report3['All']['osr'] ?></div>
                    <div class="r4w-item"><?= $report3['All']['ovr'] ?></div>
                    <div class="r4w-item"><?= $report3['Training']['osr'] ?></div>
                    <div class="r4w-item"><?= $report3['Training']['ovr'] ?></div>
                    <div class="r4w-item"><?= $report3['Test']['osr'] ?></div>
                    <div class="r4w-item"><?= $report3['Test']['ovr'] ?></div>
                </div>
            </div>
            <div class="report3-wrapper">
                <?php foreach ($report3 as $set => $values) : ?>
                    <div class="r3-table">
                        <div class="r3w-row">
                            <div class="r3w-item"><?= $set ?></div>
                            <div class="r3w-item">Классифицировано</div>
                        </div>
                        <div class="r3w-row">
                            <div class="r3w-item">Фактически</div>
                            <div class="r3w-item">False</div>
                            <div class="r3w-item">True</div>
                            <div class="r3w-item">Итого</div>
                        </div>
                        <div class="r3w-row">
                            <div class="r3w-item">False</div>
                            <div class="r3w-item"><?= $values['tn'] ?> (<i>TN</i>)</div>
                            <div class="r3w-item"><?= $values['fp'] ?> (<i>FP</i>)</div>
                            <div class="r3w-item"><?= ($values['tn'] + $values['fp']) ?></div>
                        </div>
                        <div class="r3w-row">
                            <div class="r3w-item">True</div>
                            <div class="r3w-item"><?= $values['fn'] ?> (<i>FN</i>)</div>
                            <div class="r3w-item"><?= $values['tp'] ?> (<i>TP</i>)</div>
                            <div class="r3w-item"><?= ($values['fn'] + $values['tp']) ?></div>
                        </div>
                        <div class="r3w-row">
                            <div class="r3w-item">Итого</div>
                            <div class="r3w-item"><?= ($values['tn'] + $values['fn']) ?></div>
                            <div class="r3w-item"><?= ($values['fp'] + $values['tp']) ?></div>
                            <div class="r3w-item"><?= ($values['tn'] + $values['fp'] + $values['fn'] + $values['tp']) ?></div>
                        </div>
                    </div>
                <? endforeach; ?>
            </div>
        </div>
        <div style="widht: 100%; height: 2px; background-color: #053c4b; margin-top: 17px;"></div>
        <div class="report-download"><a href="./download-report.php">Выгрузить отчет</a></div>
    </div>
    <script src="./js/jquery-3.4.0.min.js"></script>
    <script src="./js/d2predicts-report.js"></script>
</body>

</html>