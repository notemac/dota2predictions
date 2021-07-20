// https://jquery.com/
// https://github.com/jcuenod/imgCheckbox/

// var anchor = document.querySelector('a');
// anchor.setAttribute('download', 'example.html');
// anchor.setAttribute('href', `data:text/html;charset=UTF-8,${$('html').html()}`);

//https://github.com/eligrey/FileSaver.js

// Создаем tooltip
tippy($('.umsr-save').get(0), {
    trigger: "manual", // Only trigger the tippy programmatically
    content: "Допускается ввод только числовых значений в диапазоне от 10 до 900. Значения должны быть заданы для всех параметров!",
    placement: 'right',
    arrow: true,
    arrowType: 'round',
    // animateFill: false,
    size: "large",
    maxWidth: 370,
    offset: "0 10",
    theme: "redstyle" // <link rel="stylesheet" href="./js/themes/redstyle-tooltip.css">
});

$('.dropdown-menu').click(function (event) {
    window.location.href = './admin.php?logout';
});

// ОБНОВЛЕНИЕ МОДЕЛИ
let temp_score = {};
// Настроить
$(document).on('click', '.umsr-settings', function () {
    if ($('.umsr-settings').text() == 'Настроить') {
        // Сохраняем начальные значения
        temp_score['umsr-score'] = $('#umsr-score').val();
        temp_score['umsr-odds'] = $('#umsr-odds').val();
        temp_score['umsr-pdo'] = $('#umsr-pdo').val();
        $('.umsr-settings').text('Отменить');
        $('.umsr-save').show();
        $('.umsr-input').css('background-color', 'rgb(15, 22, 29)');
        $('.umsr-input').css('text-align', 'center');
        $('.umsr-input').prop("disabled", false);
        $('#umsr-score').focus();
        $('.umsr-select').show();
    }
    else { // Отменить
        $('.umsr-settings').text('Настроить');
        $('#umsr-score').val(temp_score['umsr-score']);
        $('#umsr-odds').val(temp_score['umsr-odds']);
        $('#umsr-pdo').val(temp_score['umsr-pdo']);
        $('.umsr-save').hide();
        $('.umsr-input').css('background-color', 'rgb(28, 36, 45)');
        $('.umsr-input').css('text-align', 'left');
        $('.umsr-input').prop("disabled", true);
        $('.umsr-select').hide();
        $('.umsr-select').val('none').change();
    }
})

// Обновить
$(document).on('click', '.umsr-save', function(event) {
    let score = parseFloat($('#umsr-score').val());
    let odds = parseFloat($('#umsr-odds').val());
    let pdo = parseFloat($('#umsr-pdo').val());
    if (!isFinite(score) || !isFinite(odds) || !isFinite(pdo) || score < 10 || score > 900
            || odds < 10 || odds > 900 || pdo < 10 || pdo > 900) {
        $('.umsr-save').get(0)._tippy.show(); // Показываем сообщение
        return;
    }
    $('.umsr-save').get(0)._tippy.destroy();
    $('.score-wrapper').hide(0);
    let content = `<div class="umsuw-item1">Обновление...</div>
        <div class="windows8">
            <div class="wBall" id="wBall_1">
                <div class="wInnerBall"></div>
            </div>
            <div class="wBall" id="wBall_2">
                <div class="wInnerBall"></div>
            </div>
            <div class="wBall" id="wBall_3">
                <div class="wInnerBall"></div>
            </div>
            <div class="wBall" id="wBall_4">
                <div class="wInnerBall"></div>
            </div>
            <div class="wBall" id="wBall_5">
                <div class="wInnerBall"></div>
            </div>
        </div>`
    $('.ums-updating-wrapper').html(content);
    $('.ums-updating-wrapper').css('display', 'flex');
    $('.um-score-header').addClass('orange');
    $('.um-score-header svg').hide(0);
    $.ajax({
        url: './update-scorecard.php',
        timeout: 5000, // 5 секунд на ожидание ответа от сервера
        data: {'score': score, 'odds': odds, 'pdo': pdo},
        dataType: 'html',
        error: function (jqXHR, textStatus, errorThrown) {
            let content = `<div>Что-то пошло не так... Возможно скоринговая карта все-таки была обновлена. <a href="./update-model.php">Перезагрузите</a> страницу, чтобы узнать.</div>`;
            $('.ums-updating-wrapper').html(content);
        },
        success: function (data, texStatus, jqXHR) {
            $('.um-score-header').removeClass('orange');
            $('.um-score-header svg').show(0);
            $('.ums-updating-wrapper').html('');
            $('.ums-updating-wrapper').hide(0);
            $('.score-wrapper').html(data);
            $('.score-wrapper').slideDown(200);
            tippy($('.umsr-save').get(0), {
                trigger: "manual", // Only trigger the tippy programmatically
                content: "Допускается ввод только числовых значений в диапазоне от 10 до 900. Значения должны быть заданы для всех параметров!",
                placement: 'right',
                arrow: true,
                arrowType: 'round',
                // animateFill: false,
                size: "large",
                maxWidth: 370,
                offset: "0 10",
                theme: "redstyle" // <link rel="stylesheet" href="./js/themes/redstyle-tooltip.css">
            });
        }
    });
});


// Показать карту
$(document).on('click', '.umsr-open', function () {
    if ($('.umsr-open').text() == 'Показать карту') {
        $('.um-score-wrapper2').slideDown(200, () => {
            $('html, body').animate({ scrollTop: $(".um-score-wrapper").offset().top + 2 }, 200);
        });
        $('.umsr-open').text('Скрыть карту');
    }
    else {
        $('.um-score-wrapper2').slideUp(200);
        $('.umsr-open').text('Показать карту');
    }
})

//$('.umsr-select').on('change',
$(document).on('change', '.umsr-select', function (e) {
    let option = $(this).val();
    if (option != 'none') {
        let params = option.split(' ');
        $('#umsr-score').val(params[0]);
        $('#umsr-odds').val(params[1]);
        $('#umsr-pdo').val(params[2]);
    }
});


$('.um-score-header').click(function (event) {
    if ($('.ums-updating-wrapper').is(':visible')) {
        return;
    }
    if ($('.score-wrapper').is(':visible')) {
        $('.score-wrapper').slideUp(200);
        $('.um-score-header svg').html('<path d="M7.41 7.84L12 12.42l4.59-4.58L18 9.25l-6 6-6-6z"></path>');
    }
    else {
        $('.score-wrapper').slideDown(200);
        $('.um-score-header svg').html('<path d="M 7.41 15.41 L 12 10.83 l 4.59 4.58 L 18 14 l -6 -6 l -6 6 Z"></path>');
    }
});


// #region СЭМПЛИНГ
/* let UM_SAMPLING = {};
// Настроить
$('.umsar-settings').click(function(event) {
    if ($('.umsar-settings').text() == 'Настроить') {
        // Сохраняем начальные значения
        UM_SAMPLING['umsar-train'] = $('#umsar-train').val();
        UM_SAMPLING['umsar-test'] = $('#umsar-test').val();  
        $('.umsar-settings').text('Отменить');
        $('.umsar-save').show();
        $('.umsar-input').css('background-color', 'rgb(15, 22, 29)');
        $('.umsar-input').prop("disabled", false);
        $('#umsar-train').focus();
        $('.umsar-select').prop("disabled", false);
    }
    else { // Отменить
        $('.umsar-settings').text('Настроить');
        $('#umsar-train').val(UM_SAMPLING['umsar-train']);
        $('#umsar-test').val(UM_SAMPLING['umsar-test']);
        $('.umsar-save').hide();
        $('.umsar-input').css('background-color', 'rgb(28, 36, 45)');
        $('.umsar-input').prop("disabled", true);
        $('.umsar-select').prop("disabled", true);
        $('.umsar-select').val('Стратифицированный').change();
    }
}); */
// #endregion


