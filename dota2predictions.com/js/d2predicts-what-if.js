// АНАЛИЗ ЧТО-ЕСЛИ
// Создаем tooltip
tippy($('.wifw-calculate').get(0), {
    trigger: "manual", // Only trigger the tippy programmatically
    content: "Допускается ввод только числовых значений. Значения должны быть заданы для всех переменных!",
    placement: 'right',
    arrow: true,
    arrowType: 'round',
    // animateFill: false,
    size: "large",
    maxWidth: 330,
    offset: "0 10",
    theme: "redstyle" // <link rel="stylesheet" href="./js/themes/redstyle-tooltip.css">
});

$('.dropdown-menu').click(function (event) {
    window.location.href = './admin.php?logout';
});

$('.wifw-calculate').click(function (event) {
    // Коэффициенты регрессии
    c_counters = (value) => {
        if (value <= -0.4059) return 1.55313;
        if ((value > -0.4059) && (value < -0.08118)) return 0.72478;
        if ((value >= -0.08118) && (value <= 0.08118)) return 0;
        if ((value > 0.08118) && (value < 0.4059)) return -0.72478;
        if (value >= 0.4059) return -1.55313;
    };
    c_deathl25 = (value) => {
        if (value < -10) return -0.33149;
        if ((value >= -10) && (value < -2)) return 0;
        if ((value >= -2) && (value < 3)) return 0.25335;
        if ((value >= 3) && (value < 11)) return 0.47068;
        if (value >= 11) return 0.81368;
    };
    c_lmavg = (value) => {
        if (value < -174) return -0.16688;
        if ((value >= -174) && (value < -50)) return 0;
        if ((value >= -50) && (value < 43)) return 0.13631;
        if ((value >= 43) && (value < 167)) return 0.21329;
        if (value >= 167) return 0.3943;
    };
    c_winrate12 = (value) => {
        if (value < -12) return -0.37435;
        if ((value >= -12) && (value < -3)) return 0;
        if ((value >= -3) && (value < 4)) return 0.1159;
        if ((value >= 4) && (value < 13)) return 0.23654;
        if (value >= 13) return 0.62725;
    };
    c_pwinrate = (value) => {
        if (value < 35) return -0.79101;
        if ((value >= 35) && (value < 45)) return 0;
        if ((value >= 45) && (value < 55)) return 0.20282;
        if ((value >= 55) && (value < 65)) return 0.41411;
        if (value >= 65) return 1.18842;
    };
    c_hwravg = (value) => {
        if (value < -17.7733) return -0.39697;
        if ((value >= -17.7733) && (value < -3.9496)) return 0;
        if ((value >= -3.9496) && (value < 3.9496)) return 0.14935;
        if ((value >= 3.9496) && (value < 17.7733)) return 0.26284;
        if (value >= 17.7732) return 0.67965;
    };
    // Скоринговые баллы
    s_counters = (value) => {
        if (value <= -0.4059) return parseFloat(scorecard['counters'][0]);
        if ((value > -0.4059) && (value < -0.08118)) return parseFloat(scorecard['counters'][1]);
        if ((value >= -0.08118) && (value <= 0.08118)) return parseFloat(scorecard['counters'][2]);
        if ((value > 0.08118) && (value < 0.4059)) return parseFloat(scorecard['counters'][3]);
        if (value >= 0.4059) return parseFloat(scorecard['counters'][4]);
    };
    s_deathl25 = (value) => {
        if (value < -10) return parseFloat(scorecard['death_l25'][0]);
        if ((value >= -10) && (value < -2)) return parseFloat(scorecard['death_l25'][1]);
        if ((value >= -2) && (value < 3)) return parseFloat(scorecard['death_l25'][2]);
        if ((value >= 3) && (value < 11)) return parseFloat(scorecard['death_l25'][3]);
        if (value >= 11) return parseFloat(scorecard['death_l25'][4]);
    };
    s_lmavg = (value) => {
        if (value < -174) return parseFloat(scorecard['lm_avg'][0]);
        if ((value >= -174) && (value < -50)) return parseFloat(scorecard['lm_avg'][1]);
        if ((value >= -50) && (value < 43)) return parseFloat(scorecard['lm_avg'][2]);
        if ((value >= 43) && (value < 167)) return parseFloat(scorecard['lm_avg'][3]);
        if (value >= 167) return parseFloat(scorecard['lm_avg'][4]);
    };
    s_winrate12 = (value) => {
        if (value < -12) return parseFloat(scorecard['winrate12'][0]);
        if ((value >= -12) && (value < -3)) return parseFloat(scorecard['winrate12'][1]);
        if ((value >= -3) && (value < 4)) return parseFloat(scorecard['winrate12'][2]);
        if ((value >= 4) && (value < 13)) return parseFloat(scorecard['winrate12'][3]);
        if (value >= 13) return parseFloat(scorecard['winrate12'][4]);
    };
    s_pwinrate = (value) => {
        if (value < 35) return parseFloat(scorecard['pwinrate'][0]);
        if ((value >= 35) && (value < 45)) return parseFloat(scorecard['pwinrate'][1]);
        if ((value >= 45) && (value < 55)) return parseFloat(scorecard['pwinrate'][2]);
        if ((value >= 55) && (value < 65)) return parseFloat(scorecard['pwinrate'][3]);
        if (value >= 65) return parseFloat(scorecard['pwinrate'][4]);
    };
    s_hwravg = (value) => {
        if (value < -17.7733) return parseFloat(scorecard['hwr_avg'][0]);
        if ((value >= -17.7733) && (value < -3.9496)) return parseFloat(scorecard['hwr_avg'][1]);
        if ((value >= -3.9496) && (value < 3.9496)) return parseFloat(scorecard['hwr_avg'][2]);
        if ((value >= 3.9496) && (value < 17.7733)) return parseFloat(scorecard['hwr_avg'][3]);
        if (value >= 17.7732) return parseFloat(scorecard['hwr_avg'][4]);
    };
    //Входные переменные
    counters = parseFloat($('#wifw-counters').val());
    deathl25 = parseFloat($('#wifw-deathl25').val());
    lmavg = parseFloat($('#wifw-lmavg').val());
    winrate12 = parseFloat($('#wifw-winrate12').val());
    pwinrate = parseFloat($('#wifw-pwinrate').val());
    hwravg = parseFloat($('#wifw-hwravg').val());
    // Проверка введенных значений
    if (!isFinite(counters) || !isFinite(deathl25) || !isFinite(lmavg) || !isFinite(winrate12) || !isFinite(pwinrate) || !isFinite(hwravg)) {
        $('.wifw-calculate').get(0)._tippy.show(); // Показываем сообщение
        return;
    }
    // Скоринговые баллы
    scounters = s_counters(counters);
    sdeathl25 = s_deathl25(deathl25);
    slmavg = s_lmavg(lmavg);
    swinrate12 = s_winrate12(winrate12);
    spwinrate = s_pwinrate(pwinrate);
    shwravg = s_hwravg(hwravg);
    s_const = parseFloat(scorecard['const']);
    // Коэффициенты регрессии
    counters = c_counters(counters);
    deathl25 = c_deathl25(deathl25);
    lmavg = c_lmavg(lmavg);
    winrate12 = c_winrate12(winrate12);
    pwinrate = c_pwinrate(pwinrate);
    hwravg = c_hwravg(hwravg);
    $('.wcr-counters').html('COUNTERS = ' + counters.toString().replace('-', '– '));
    $('.wcr-deathl25').html('DEATH_L25 = ' + deathl25.toString().replace('-', '– '));
    $('.wcr-lmavg').html('LM_AVG = ' + lmavg.toString().replace('-', '– '));
    $('.wcr-winrate12').html('WINRATE12 = ' + winrate12.toString().replace('-', '– '));
    $('.wcr-pwinrate').html('PWINRATE = ' + pwinrate.toString().replace('-', '– '));
    $('.wcr-hwravg').html('HWR_AVG = ' + hwravg.toString().replace('-', '– '));
    // Уравнение регрессии
    let text = 'Y = – 0.8095';
    let factors = [counters, deathl25, lmavg, winrate12, pwinrate, hwravg];
    for (let i = 0; i < 6; ++i) {
        if (factors[i] < 0)
            text += ' – ' + (-factors[i]).toString();
        else
            text += ' + ' + factors[i].toString();
    }
    let y = Math.round10(-0.8095 + counters + deathl25 + lmavg + winrate12 + pwinrate + hwravg, -4);
    text += ' = ' + y.toString().replace('-', '– ');
    $('.wifw-y').html(text);
    // Modifying Math on the Page http://docs.mathjax.org/en/latest/advanced/typeset.html
    // Обновление математической формулы
    // MathJax.Hub.Queue(["Typeset",MathJax.Hub,".wifw-y"]);
    // Вероятность победы
    let p = Math.round10(1 / (1 + Math.pow(Math.E, -y)), -4);
    $('.wifw-p').html(`$$P={1 \\over 1+e^{${-y}}}=${p}$$`);
    MathJax.Hub.Queue(["Typeset", MathJax.Hub, ".wifw-p"]);
    // Скоринговый балл
    text = 'SCORE = ' + s_const.toString();
    factors = [scounters, sdeathl25, slmavg, swinrate12, spwinrate, shwravg];
    for (let i = 0; i < 6; ++i) {
        if (factors[i] < 0)
            text += ' – ' + (-factors[i]).toString();
        else
            text += ' + ' + factors[i].toString();
    }
    let score = Math.round10(463.7657 + scounters + sdeathl25 + slmavg + swinrate12 + spwinrate + shwravg, -4);
    text += ' = ' + score.toString()
    $('.wifw-score').html(text);
    // MathJax.Hub.Queue(["Typeset",MathJax.Hub,".wifw-score"]);
    $('.wi-result-wrapper').slideDown(200, () => {
        $('html, body').animate({ scrollTop: $("main").offset().top }, 200);
    });
});