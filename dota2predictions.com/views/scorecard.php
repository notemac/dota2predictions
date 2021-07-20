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
<script>
    $('.last-update-date span:last-child').html('<?= $update_time ?>');
</script>