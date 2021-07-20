// https://jquery.com/
// https://github.com/jcuenod/imgCheckbox/

// Создаем tooltip
tippy($('.predict-button').get(0), {
    trigger: "manual", // Only trigger the tippy programmatically
    content: "You need to select teams and heroes before predicting!",
    placement: 'right',
    arrow: true,
    arrowType: 'round',
    // animateFill: false,
    size: "large",
    maxWidth: 250,
    offset: "0 10",
    theme: "redstyle" // <link rel="stylesheet" href="./js/themes/redstyle-tooltip.css">
})

$('.logo-wrapper').click(function (event) {
    window.location.href = './index.php';
});

// ВЫБОР КОМАНД
var radiantTeam = undefined;
var direTeam = undefined;
var isRadiant = undefined; // выбирается команда сил света?


$(".teams-info-item:nth-child(odd)").hover(
    function () {
        $(this).css('border', '1px solid #BCFB08');
    }, function () {
        // Если выбрана команда
        if ($(this).html().length > 12)
            $(this).css('border', 'none');
        else {
            $(this).css('border', '1px solid rgb(89, 103, 117)');
        }
    }
);

$(document).on('click', '.open-last-matches', function() {
    let instance = $('.open-last-matches').get(0)._tippy;
    if ($('.last-matches-wrapper').is(':visible')) {
        instance.setContent('<span style="font-family: "DINPro-Regular", sans-serif;">Show last 10 matches</span>');
        $('.last-matches-wrapper').slideUp(300);
        $('.open-last-matches-svg').html('<path d="M7.41 7.84L12 12.42l4.59-4.58L18 9.25l-6 6-6-6z"></path>');
    }
    else {
        instance.setContent('<span style="font-family: "DINPro-Regular", sans-serif;">Hide</span>');
        $('.last-matches-wrapper').slideDown(300);
        $('.open-last-matches-svg').html('<path d="M 7.41 15.41 L 12 10.83 l 4.59 4.58 L 18 14 l -6 -6 l -6 6 Z"></path>');
        $('html, body').animate({ scrollTop: $(".winrate-wrapper").offset().top - 70 }, 300);
    }
})

$(document).on('click', '.open-more-info', function () {
    let instance = $('.open-more-info').get(0)._tippy;
    if ($('.more-wrapper').is(':visible')) {
        instance.setContent('<span style="font-family: "DINPro-Regular", sans-serif;">Show more info</span>');
        $('.more-wrapper').slideUp(300);
        $('.open-more-info-svg').html('<path d="M7.41 7.84L12 12.42l4.59-4.58L18 9.25l-6 6-6-6z"></path>');
    }
    else {
        instance.setContent('<span style="font-family: "DINPro-Regular", sans-serif;">Hide</span>');
        $('.more-wrapper').slideDown(300);
        $('.open-more-info-svg').html('<path d="M 7.41 15.41 L 12 10.83 l 4.59 4.58 L 18 14 l -6 -6 l -6 6 Z"></path>');
        $('html, body').animate({ scrollTop: $(".win-probability-wrapper").offset().top - 70 }, 300);
    }
})

$('#radiant, #dire').click(function(event) {
    if ($(this)[0].id == 'radiant') {
        if (direTeam != undefined) direTeam.deselect();
        if (radiantTeam != undefined) radiantTeam.select();
        if (isRadiant == undefined) { // показываем список команд
            isRadiant = true;
            // $('.teams-icons').css('display', 'flex');
            $('.teams-icons-wrapper').slideDown(200);
        }
        else if (isRadiant) { // скрываем список команд
            isRadiant = undefined;
            // $('.teams-icons').css('display', 'none');
            $('.teams-icons-wrapper').slideUp(200);
        }
        else {
            isRadiant = true;
        }
    } 
    else { // dire
        if (radiantTeam != undefined) radiantTeam.deselect();
        if (direTeam != undefined) direTeam.select();
        if (isRadiant == undefined) { // показываем список команд
            isRadiant = false;
            // $('.teams-icons').css('display', 'flex');
            $('.teams-icons-wrapper').slideDown(200);
        }
        else if (!isRadiant) { // скрываем список команд
            isRadiant = undefined;
            // $('.teams-icons').css('display', 'none');
            $('.teams-icons-wrapper').slideUp(200);
        }
        else {
            isRadiant = false;
        }
    }
});

$("img.checkableTeam").imgCheckbox({
    "graySelected": false, "scaleSelected": false, "styles": {
        "span.imgCheckbox.imgChked img": {
            // This property will overwrite the default grayscaling, we need to add it back in
            "border": "none"
        }
    },
onclick: function(selectedItem) {
    if (isRadiant) {
        if ((direTeam != undefined) && (direTeam.children()[0].name == selectedItem.children()[0].name)) {
            $('#dire').html('Dire Team');
            direTeam = undefined;
            $('#dire').css('border', '1px solid rgb(72, 84, 95)');
        }
        // если еще ни одна команда не выбрана
        if (radiantTeam == undefined) {
            radiantTeam = selectedItem;
            let name = radiantTeam.children()[0].name;
            let src = radiantTeam.children()[0].src;
            let alt = radiantTeam.children()[0].alt;
            $('#radiant').html(`<img name="${name}" alt="${alt}" src="${src}"><div style="font-size: 21px; margin-top: 10px;">${name}</div>`);
            // скрываем список команд
            isRadiant = undefined;
            // $('.teams-icons').css('display', 'none');
            $('.teams-icons-wrapper').slideUp(200);
            $('#radiant').css('border', 'none');
        } // если отменили текущий выбор
        else if (radiantTeam.children()[0].name == selectedItem.children()[0].name) {
            $('#radiant').css('border', '1px solid rgb(72, 84, 95)');
            radiantTeam = undefined;
            $('#radiant').html('Radiant Team');
        } // выбрали другую команду
        else {
            $('#radiant').css('border', 'none');
            radiantTeam.deselect();
            radiantTeam = selectedItem;
            let name = radiantTeam.children()[0].name;
            let src = radiantTeam.children()[0].src;
            let alt = radiantTeam.children()[0].alt;
            $('#radiant').html(`<img name="${name}" alt="${alt}" src="${src}"><div style="font-size: 21px; margin-top: 10px;">${name}</div>`);
            // скрываем список команд
            isRadiant = undefined;
            // $('.teams-icons').css('display', 'none');
            $('.teams-icons-wrapper').slideUp(200);
        }
    } // dire
    else {
        if ((radiantTeam != undefined) && (radiantTeam.children()[0].name == selectedItem.children()[0].name)) {
            $('#radiant').html('Radiant Team');
            radiantTeam = undefined;
            $('#radiant').css('border', '1px solid rgb(89, 103, 117)');
        }
        // если еще ни одна команда не выбрана
        if (direTeam == undefined) {
            direTeam = selectedItem;
            let name = direTeam.children()[0].name;
            let src = direTeam.children()[0].src;
            let alt = direTeam.children()[0].alt;
            $('#dire').html(`<img name="${name}" alt="${alt}" src="${src}"><div style="font-size: 21px; margin-top: 10px;">${name}</div>`);
            // скрываем список команд
            isRadiant = undefined;
            // $('.teams-icons').css('display', 'none');
            $('.teams-icons-wrapper').slideUp(200);
            $('html, body').animate({ scrollTop: 0 }, 200);
            $('#dire').css('border', 'none');
        } // если отменили текущий выбор
        else if (direTeam.children()[0].name == selectedItem.children()[0].name) {
            $('#dire').css('border', '1px solid rgb(89, 103, 117)');
            direTeam = undefined;
            $('#dire').html('Dire Team');
        } // выбрали другую команду
        else {
            $('#dire').css('border', 'none');
            direTeam.deselect();
            direTeam = selectedItem;
            let name = direTeam.children()[0].name;
            let src = direTeam.children()[0].src;
            let alt = direTeam.children()[0].alt;
            $('#dire').html(`<img name="${name}" alt="${alt}" src="${src}"><div style="font-size: 21px; margin-top: 10px;">${name}</div>`);
            // скрываем список команд
            isRadiant = undefined;
            // $('.teams-icons').css('display', 'none');
            $('.teams-icons-wrapper').slideUp(200);
            $('html, body').animate({ scrollTop: 0 }, 200);
        }
    }
} });



// ВЫБОР ГЕРОЕВ
var radiantHeroes = [];
var direHeroes = [];
var isRadiant2 = undefined; // выбираются герои сил света?

$('#radiant-heroes, #dire-heroes').click(function(event) {
    if ($(this)[0].id == 'radiant-heroes') {
        direHeroes.forEach(hero => {if (hero != undefined) hero.deselect()});
        radiantHeroes.forEach(hero => {if (hero != undefined) hero.select()});
        if (isRadiant2 == undefined) { // показываем список гереов
            isRadiant2 = true;
            // $('.heroes-icons').css('display', 'flex');
            $('.heroes-icons-wrapper').slideDown(300);
            $('html, body').animate({ scrollTop: $(".heroes-icons").offset().top - 85}, 300);
        }
        else if (isRadiant2) { // скрываем список героев
            isRadiant2 = undefined;
            // $('.heroes-icons').css('display', 'none');
            $('.heroes-icons-wrapper').slideUp(300);
        }
        else isRadiant2 = true;
    } 
    else { // dire-heroes
        radiantHeroes.forEach(hero => {if (hero != undefined) hero.deselect()});
        direHeroes.forEach(hero => {if (hero != undefined) hero.select()});
        if (isRadiant2 == undefined) { // показываем список героев
            isRadiant2 = false;
            // $('.heroes-icons').css('display', 'flex');
            $('.heroes-icons-wrapper').slideDown(300);
            $('html, body').animate({ scrollTop: $(".heroes-icons").offset().top - 85}, 300);
        }
        else if (!isRadiant2) { // скрываем список героев
            isRadiant2 = undefined;
            // $('.heroes-icons').css('display', 'none');
            $('.heroes-icons-wrapper').slideUp(300);
        }
        else isRadiant2 = false;
    }
});
// this - только что выбранный герой, heroes - массив выбранных до этого момента героев,
// hero - один из героев из массива heroes
function isPickedHero(hero, index, heroes) {
    if (hero == undefined) return false;
    return (hero.children()[0].name == this.children()[0].name);
}
$("img.checkableHero").imgCheckbox({ "graySelected": false, "scaleSelected": false, "styles": {
    "span.imgCheckbox.imgChked img": {
        // This property will overwrite the default grayscaling, we need to add it back in
        "border": "none"
    }
},
onclick: function(selectedHero) {
    let name = selectedHero.children()[0].name;
    if (isRadiant2) {
        // если решили отменить выбор какого-то героя
        let index = radiantHeroes.findIndex(isPickedHero, selectedHero);
        if (index != -1)
        {
            $(`#h${index + 1}`).html('');
            // let hero = document.getElementById(`h${index+1}`);
            // hero.name = 'null';
            // hero.src = './assets/heroes/placeholder.png';
            radiantHeroes[index] = undefined;
        } // выбрали еще одного героя
        else {
            for (let i = 0; i < 5; ++i) {
                if (radiantHeroes[i] == undefined) {
                    //// если выбрали героя dire
                    let index = direHeroes.findIndex(isPickedHero, selectedHero);
                    if (index != -1) {
                        $(`#h${index + 6}`).html('');
                        // let hero = document.getElementById(`h${index+6}`);
                        // hero.name = 'null';
                        // hero.src = './assets/heroes/placeholder.png';
                        direHeroes[index] = undefined;
                    }
                    ////
                    $(`#h${i + 1}`).html(`<img style="border-radius: 10px;" id="h${i + 1}" width="112px" height="63px" name="${name}" src="./assets/heroes/${name}.png">`);
                    // let hero = document.getElementById(`h${i+1}`);
                    // hero.name = name;
                    // hero.src = `./assets/heroes/${name}.png`;
                    radiantHeroes[i] = selectedHero;
                    for (let i = 0; i < 5; ++i) {
                        if (radiantHeroes[i] == undefined)
                            return;
                    }
                    // выбрали 5-го героя?
                    isRadiant2 = undefined;
                    // $('.heroes-icons').css('display', 'none');
                    $('.heroes-icons-wrapper').slideUp(300);
                    $('html, body').animate({ scrollTop: 0 },300);
                    // $('.heroes-icons').css('display', 'none');
                    // $('.heroes-icons').hide();
                    return;
                }
            }
            // иначе 5 героев уже выбраны
            selectedHero.deselect();
        }
    } // dire-heroes
    else {
        // если решили отменить выбор какого-то героя
        let index = direHeroes.findIndex(isPickedHero, selectedHero);
        if (index != -1)
        {
            $(`#h${index + 6}`).html('');
            // let hero = document.getElementById(`h${index+6}`);
            // hero.name = 'null';
            // hero.src = './assets/heroes/placeholder.png';
            direHeroes[index] = undefined;
        } // выбрали еще одного героя
        else {
            for (let i = 0; i < 5; ++i) {
                if (direHeroes[i] == undefined) {
                    //// если выбрали героя radiant
                    let index = radiantHeroes.findIndex(isPickedHero, selectedHero);
                    if (index != -1) {
                        $(`#h${index + 1}`).html('');
                        // let hero = document.getElementById(`h${index+1}`);
                        // hero.name = 'null';
                        // hero.src = './assets/heroes/placeholder.png';
                        radiantHeroes[index] = undefined;
                    }
                    ////
                    $(`#h${i + 6}`).html(`<img style="border-radius: 10px;" id="h${i + 6}" width="112px" height="63px" name="${name}" src="./assets/heroes/${name}.png">`);
                    // let hero = document.getElementById(`h${i+6}`);
                    // hero.name = name;
                    // hero.src = `./assets/heroes/${name}.png`;
                    direHeroes[i] = selectedHero;
                    for (let i = 0; i < 5; ++i) {
                        if (direHeroes[i] == undefined)
                            return;
                    }
                    // выбрали 5-го героя?
                    isRadiant2 = undefined;
                    // $('.heroes-icons').css('display', 'none');
                    $('.heroes-icons-wrapper').slideUp(300);
                    $('html, body').animate({ scrollTop: 0 }, 300);
                    return;
                }
            }
            // иначе 5 героев уже выбраны
            selectedHero.deselect();
        }
    }
}});


// @param prev - previous request data
// @param now - current request data
function checkEquaPredictionlRequest(prev, now) {
    if ((prev['radiant_team'] != now['radiant_team']) || (prev['dire_team'] != now['dire_team']) ||
            (prev['radiant_id'] != now['radiant_id']) || (prev['dire_id'] != now['dire_id']))
        return false;   
    for (let i = 0; i < 5; ++i) {
        if (prev['radiant_heroes'][i] != now['radiant_heroes'][i]) return false;
        if (prev['dire_heroes'][i] != now['dire_heroes'][i]) return false;
    }
    return true;
}
// Переменная, содержащие данные предыдущего запроса
let prevSendData = {};
// Запуск прогнозирвания
$(document).on('change', '.wp-select', function (e) {
    let option = $(this).val(); // All time, 12 months, 6 months
    //Подготавливаем данные для отправки
    let teams = $('.teams-info img');
    let heroes = $('#heroes-info img');
    /****  Не все команды и герои выбраны?*/
    if ((teams.length < 2) || (heroes.length < 10)) {
        // ЗДЕСЬ Tooltips почему-то не работают ???!!!!
        return;
    }/**** */
    let rheroes = [], dheroes = [];
    for (let i = 0, j = 5; i < 5; ++i, ++j) {
        rheroes[i] = heroes.get(i).name;
        dheroes[i] = heroes.get(j).name;
    }
    let sendData = {
        radiant_name: teams.get(0).name, radiant_id: teams.get(0).alt,
        dire_name: teams.get(1).name, dire_id: teams.get(1).alt,
        radiant_heroes: rheroes, dire_heroes: dheroes,
        period: option
    };
    /** Пытаемся повторить предыдущий запрос?*/
    // if (checkEquaPredictionlRequest(prevSendData, sendData)) {
    //     $('html, body').animate({ scrollTop: $(".prediction-wrapper").offset().top - 100 }, 300);
    //     return;
    // } 
    /** */
    /**** Удаляем Tooltips перед отправкой AJAX-запроса*/
    $('.predict-button').get(0)._tippy.destroy();
    let elems = $('.open-last-matches');
    if (elems.length > 0) elems.get(0)._tippy.destroy();
    elems = $('.open-more-info');
    if (elems.length > 0) elems.get(0)._tippy.destroy();
    /**** */
    prevSendData = sendData;
    // Запускаем анимацию
    $('.prediction-wrapper').hide(0);
    let content = `<div class="predicting">Predicting...</div>
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
        </div>`;
    $('.predict-button-wrapper').html(content);
    /* ЗАПРОС  AJAX */
    $.ajax({
        url: './predict.php',
        timeout: 5000, // 5 секунд на ожидание ответа от сервера
        data: sendData,
        dataType: 'html',
        error: function (jqXHR, textStatus, errorThrown) {
            let content = `<div class="went-wrong">&#9785;&#160;&#160;Sorry, something went wrong. Please <a href="./index.php">reload</a> the page.</div>`;
            $('.predict-button-wrapper').html(content);
        },
        success: function (data, texStatus, jqXHR) {
            $('.predict-button-wrapper').html('<div class="predict-button">PREDICT</div>');
            $('.prediction-wrapper').html(data);
            $('.prediction-wrapper').show(0);
            $('html, body').animate({ scrollTop: $(".prediction-wrapper").offset().top - 100 }, 300);
            // Создаем Tooltips

            tippy($('.predict-button').get(0), {
                trigger: "manual", // Only trigger the tippy programmatically
                content: "You need to select teams and heroes before predicting!",
                placement: 'right',
                arrow: true,
                arrowType: 'round',
                // animateFill: false,
                size: "large",
                maxWidth: 250,
                offset: "0 10",
                theme: "redstyle"
            });
            tippy($('.open-last-matches').get(0), {
                content: '<span style="font-family: "DINPro-Regular", sans-serif;">Show last 10 matches</span>',
                arrow: true,
                arrowType: 'round',
                offset: "0 1"
            });
            tippy($('.open-more-info').get(0), {
                content: '<span style="font-family: "DINPro-Regular", sans-serif;">Show more info</span>',
                arrow: true,
                arrowType: 'round',
                offset: "0 1"
            });
            $(".more-wrapper").hover(
                function () {
                    $('.more-info-tooltip').css('opacity', '1');
                }, function () {
                    $('.more-info-tooltip').css('opacity', '0');
                }
            );
            $(".more-row:nth-child(2)").hover(
                function () {
                    $('.more-info-tooltip-hd').css('opacity', '1');
                }, function () {
                    $('.more-info-tooltip-hd').css('opacity', '0');
                }
            );
            $(".more-row:nth-child(3)").hover(
                function () {
                    $('.more-info-tooltip-vwr').css('opacity', '1');
                }, function () {
                    $('.more-info-tooltip-vwr').css('opacity', '0');
                }
            );
            $(".more-row:nth-child(4)").hover(
                function () {
                    $('.more-info-tooltip-wr6m').css('opacity', '1');
                }, function () {
                    $('.more-info-tooltip-wr6m').css('opacity', '0');
                }
            );
            $(".more-row:nth-child(5)").hover(
                function () {
                    $('.more-info-tooltip-hwr').css('opacity', '1');
                }, function () {
                    $('.more-info-tooltip-hwr').css('opacity', '0');
                }
            );
            $(".more-row:nth-child(6)").hover(
                function () {
                    $('.more-info-tooltip-mwlt25d').css('opacity', '1');
                }, function () {
                    $('.more-info-tooltip-mwlt25d').css('opacity', '0');
                }
            );
            $(".more-row:nth-child(7)").hover(
                function () {
                    $('.more-info-tooltip-almd').css('opacity', '1');
                }, function () {
                    $('.more-info-tooltip-almd').css('opacity', '0');
                }
            );
            $(".win-probability").hover(
                function () {
                    $('.win-probability .prediction-item-header').css('background-color', 'transparent');
                    $('.win-probability').css('background-color', 'rgba(0, 0, 0, 0.391)');
                }, function () {
                    $('.win-probability').css('background-color', 'transparent');
                    $('.win-probability .prediction-item-header').css('background-color', '#00132293');
                }
            );
            $(".more-body").hover(
                function () {
                    $('.win-probability .prediction-item-header').css('background-color', 'transparent');
                    $('.win-probability').css('background-color', 'rgba(0, 0, 0, 0.391)');
                }, function () {
                    $('.win-probability').css('background-color', 'transparent');
                    $('.win-probability .prediction-item-header').css('background-color', '#00132293');
                }
            );
            $(".hero-counters-wrapper").hover(
                function () {
                    $('.hero-counters-wrapper .prediction-item-header').css('background-color', 'rgba(0, 0, 0, 0.391)');
                }, function () {
                    $('.hero-counters-wrapper .prediction-item-header').css('background-color', 'transparent');
                }
            );
            $(".hero-winrate-wrapper").hover(
                function () {
                    $('.hero-winrate-wrapper .prediction-item-header').css('background-color', 'rgba(0, 0, 0, 0.391)');
                }, function () {
                    $('.hero-winrate-wrapper .prediction-item-header').css('background-color', 'transparent');
                }
            );
            $(".versus-hero-winrate-wrapper").hover(
                function () {
                    $('.versus-hero-winrate-wrapper .prediction-item-header').css('background-color', 'rgba(0, 0, 0, 0.391)');
                }, function () {
                    $('.versus-hero-winrate-wrapper .prediction-item-header').css('background-color', 'transparent');
                }
            );
            $(".winrate-winrate6").hover(
                function () {
                    $('.winrate-winrate6 .prediction-item-header').css('background-color', 'transparent');
                    $('.winrate-winrate6').css('background-color', 'rgba(0, 0, 0, 0.391)');
                }, function () {
                    $('.winrate-winrate6').css('background-color', 'transparent');
                    $('.winrate-winrate6 .prediction-item-header').css('background-color', '#00132293');
                }
            );
            $(".versus-winrate-wrapper").hover(
                function () {
                    $('.versus-winrate .prediction-item-header').css('background-color', 'transparent');
                    $('.versus-winrate').css('background-color', 'rgba(0, 0, 0, 0.391)');
                }, function () {
                    $('.versus-winrate').css('background-color', 'transparent');
                    $('.versus-winrate .prediction-item-header').css('background-color', '#00132293');
                }
            );
            $(".last-matches").hover(
                function () {
                    $('.versus-winrate .prediction-item-header').css('background-color', 'transparent');
                    $('.versus-winrate').css('background-color', 'rgba(0, 0, 0, 0.391)');
                }, function () {
                    $('.versus-winrate').css('background-color', 'transparent');
                    $('.versus-winrate .prediction-item-header').css('background-color', '#00132293');
                }
            );
            $(".deathes-per-match").hover(
                function () {
                    $('.deathes-per-match .prediction-item-header').css('background-color', 'transparent');
                    $('.deathes-per-match').css('background-color', 'rgba(0, 0, 0, 0.391)');
                }, function () {
                    $('.deathes-per-match').css('background-color', 'transparent');
                    $('.deathes-per-match .prediction-item-header').css('background-color', '#00132293');
                }
            );
            $(".lost-match-duration").hover(
                function () {
                    $('.lost-match-duration .prediction-item-header').css('background-color', 'transparent');
                    $('.lost-match-duration').css('background-color', 'rgba(0, 0, 0, 0.391)');
                }, function () {
                    $('.lost-match-duration').css('background-color', 'transparent');
                    $('.lost-match-duration .prediction-item-header').css('background-color', '#00132293');
                }
            );
        }
    });
});
$(document).on('click', '.predict-button', function(event) {
    //Подготавливаем данные для отправки
    let teams = $('.teams-info img');
    let heroes = $('#heroes-info img');
    /****  Не все команды и герои выбраны?*/
    if ((teams.length < 2) || (heroes.length < 10)) {
        $('.predict-button').get(0)._tippy.show(); // Показываем сообщение
        return;
    }/**** */
    let rheroes = [], dheroes = [];
    for(let i = 0, j = 5; i < 5; ++i, ++j) {
        rheroes[i] =  heroes.get(i).name;
        dheroes[i] = heroes.get(j).name;
    }
    let sendData = {
        radiant_name: teams.get(0).name, radiant_id: teams.get(0).alt,
        dire_name: teams.get(1).name, dire_id: teams.get(1).alt,
        radiant_heroes: rheroes, dire_heroes: dheroes,
        period: '12 months'
    };
    /** Пытаемся повторить предыдущий запрос?*/
    if (checkEquaPredictionlRequest(prevSendData, sendData)) {
        $('html, body').animate({ scrollTop: $(".prediction-wrapper").offset().top - 100 }, 300);
        return;
    } /** */
    /**** Удаляем Tooltips перед отправкой AJAX-запроса*/
    $('.predict-button').get(0)._tippy.destroy();
    let elems = $('.open-last-matches');
    if (elems.length > 0) elems.get(0)._tippy.destroy();
    elems = $('.open-more-info');
    if (elems.length > 0) elems.get(0)._tippy.destroy();
    /**** */
    prevSendData = sendData;
    // Запускаем анимацию
    $('.prediction-wrapper').hide(0);
    let content = `<div class="predicting">Predicting...</div>
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
        </div>`;
    $('.predict-button-wrapper').html(content);
    /* ЗАПРОС  AJAX */
    $.ajax({
        url: './predict.php',
        timeout: 5000, // 5 секунд на ожидание ответа от сервера
        data: sendData,
        dataType: 'html',
        error: function (jqXHR, textStatus, errorThrown) {
            let content = `<div class="went-wrong">&#9785;&#160;&#160;Sorry, something went wrong. Please <a href="./index.php">reload</a> the page.</div>`;
            $('.predict-button-wrapper').html(content);
        },
        success: function(data, texStatus, jqXHR) {
            $('.predict-button-wrapper').html('<div class="predict-button">PREDICT</div>');
            $('.prediction-wrapper').html(data);
            $('.prediction-wrapper').show(0);
            $('html, body').animate({ scrollTop: $(".prediction-wrapper").offset().top - 100 }, 300);
            // Создаем Tooltips
            tippy($('.predict-button').get(0), {
                trigger: "manual", // Only trigger the tippy programmatically
                content: "You need to select teams and heroes before predicting!",
                placement: 'right',
                arrow: true,
                arrowType: 'round',
                // animateFill: false,
                size: "large",
                maxWidth: 250,
                offset: "0 10",
                theme: "redstyle"
            })
            tippy($('.open-last-matches').get(0), {
                content: '<span style="font-family: "DINPro-Regular", sans-serif;">Show last 10 matches</span>',
                arrow: true,
                arrowType: 'round',
                offset: "0 1"
            });
            tippy($('.open-more-info').get(0), {
                content: '<span style="font-family: "DINPro-Regular", sans-serif;">Show more info</span>',
                arrow: true,
                arrowType: 'round',
                offset: "0 1"
            });
            $(".more-wrapper").hover(
                function () {
                    $('.more-info-tooltip').css('opacity', '1');
                }, function () {
                    $('.more-info-tooltip').css('opacity', '0');
                }
            );
            $(".more-row:nth-child(2)").hover(
                function () {
                    $('.more-info-tooltip-hd').css('opacity', '1');
                }, function () {
                    $('.more-info-tooltip-hd').css('opacity', '0');
                }
            );
            $(".more-row:nth-child(3)").hover(
                function () {
                    $('.more-info-tooltip-vwr').css('opacity', '1');
                }, function () {
                    $('.more-info-tooltip-vwr').css('opacity', '0');
                }
            );
            $(".more-row:nth-child(4)").hover(
                function () {
                    $('.more-info-tooltip-wr6m').css('opacity', '1');
                }, function () {
                    $('.more-info-tooltip-wr6m').css('opacity', '0');
                }
            );
            $(".more-row:nth-child(5)").hover(
                function () {
                    $('.more-info-tooltip-hwr').css('opacity', '1');
                }, function () {
                    $('.more-info-tooltip-hwr').css('opacity', '0');
                }
            );
            $(".more-row:nth-child(6)").hover(
                function () {
                    $('.more-info-tooltip-mwlt25d').css('opacity', '1');
                }, function () {
                    $('.more-info-tooltip-mwlt25d').css('opacity', '0');
                }
            );
            $(".more-row:nth-child(7)").hover(
                function () {
                    $('.more-info-tooltip-almd').css('opacity', '1');
                }, function () {
                    $('.more-info-tooltip-almd').css('opacity', '0');
                }
            );
            $(".win-probability").hover(
                function () {
                    $('.win-probability .prediction-item-header').css('background-color', 'transparent');
                    $('.win-probability').css('background-color', 'rgba(0, 0, 0, 0.391)');
                }, function () {
                    $('.win-probability').css('background-color', 'transparent');
                    $('.win-probability .prediction-item-header').css('background-color', '#00132293');
                }
            );
            $(".more-body").hover(
                function () {
                    $('.win-probability .prediction-item-header').css('background-color', 'transparent');
                    $('.win-probability').css('background-color', 'rgba(0, 0, 0, 0.391)');
                }, function () {
                    $('.win-probability').css('background-color', 'transparent');
                    $('.win-probability .prediction-item-header').css('background-color', '#00132293');
                }
            );
            $(".hero-counters-wrapper").hover(
                function () {
                    $('.hero-counters-wrapper .prediction-item-header').css('background-color', 'rgba(0, 0, 0, 0.391)');
                }, function () {
                    $('.hero-counters-wrapper .prediction-item-header').css('background-color', 'transparent');
                }
            );
            $(".hero-winrate-wrapper").hover(
                function () {
                    $('.hero-winrate-wrapper .prediction-item-header').css('background-color', 'rgba(0, 0, 0, 0.391)');
                }, function () {
                    $('.hero-winrate-wrapper .prediction-item-header').css('background-color', 'transparent');
                }
            );
            $(".versus-hero-winrate-wrapper").hover(
                function () {
                    $('.versus-hero-winrate-wrapper .prediction-item-header').css('background-color', 'rgba(0, 0, 0, 0.391)');
                }, function () {
                    $('.versus-hero-winrate-wrapper .prediction-item-header').css('background-color', 'transparent');
                }
            );
            $(".winrate-winrate6").hover(
                function () {
                    $('.winrate-winrate6 .prediction-item-header').css('background-color', 'transparent');
                    $('.winrate-winrate6').css('background-color', 'rgba(0, 0, 0, 0.391)');
                }, function () {
                    $('.winrate-winrate6').css('background-color', 'transparent');
                    $('.winrate-winrate6 .prediction-item-header').css('background-color', '#00132293');
                }
            );
            $(".versus-winrate-wrapper").hover(
                function () {
                    $('.versus-winrate .prediction-item-header').css('background-color', 'transparent');
                    $('.versus-winrate').css('background-color', 'rgba(0, 0, 0, 0.391)');
                }, function () {
                    $('.versus-winrate').css('background-color', 'transparent');
                    $('.versus-winrate .prediction-item-header').css('background-color', '#00132293');
                }
            );
            $(".last-matches").hover(
                function () {
                    $('.versus-winrate .prediction-item-header').css('background-color', 'transparent');
                    $('.versus-winrate').css('background-color', 'rgba(0, 0, 0, 0.391)');
                }, function () {
                    $('.versus-winrate').css('background-color', 'transparent');
                    $('.versus-winrate .prediction-item-header').css('background-color', '#00132293');
                }
            );
            $(".deathes-per-match").hover(
                function () {
                    $('.deathes-per-match .prediction-item-header').css('background-color', 'transparent');
                    $('.deathes-per-match').css('background-color', 'rgba(0, 0, 0, 0.391)');
                }, function () {
                    $('.deathes-per-match').css('background-color', 'transparent');
                    $('.deathes-per-match .prediction-item-header').css('background-color', '#00132293');
                }
            );
            $(".lost-match-duration").hover(
                function () {
                    $('.lost-match-duration .prediction-item-header').css('background-color', 'transparent');
                    $('.lost-match-duration').css('background-color', 'rgba(0, 0, 0, 0.391)');
                }, function () {
                    $('.lost-match-duration').css('background-color', 'transparent');
                    $('.lost-match-duration .prediction-item-header').css('background-color', '#00132293');
                }
            );
        }
    });
    // $('.prediction-wrapper').css('display', 'flex');
    // $('main').css('height', '10000px');
});


// https://github.com/notemac/got_top
// Вернуться в начало Go up
$(function () {
    $.fn.scrollToTop = function () {
        // if ($(window).scrollTop() >= "100") $(this).fadeIn("slow")
        var scrollDiv = $(this);
        $(window).scroll(function () {
            ($(window).scrollTop() >= "545") ? $(scrollDiv).fadeIn("slow") : $(scrollDiv).fadeOut("slow");
        });
        $(this).click(function () {
            $("html, body").animate({ scrollTop: 0 }, "slow")
        })
    }
});

$(function () {
    $(".go-up").scrollToTop();
});


// Иконка Steam Sign in
// $('.steam-signin').click(function(event) {
//     $('#ss1').animate({ opacity: 'hide' }, 2000, () => { $('#test').css('position', 'relative');});
//     setTimeout(
//         function () {
//             $('#ss1').stop(true, true);
//             //do something special
//         }, 1000);
//     // $('.steam-signin').animate({ opacity: 'show' }, 400);
//     // $('main').css('height', '10000px');
// });

// $(".steam-signin-logo").hover(
//     function () {
//         $('#ssl').animate({ opacity: 'hide' }, 250, () => { $('#ssl-hover').css('position', 'relative'); });
//     }, function () {
//         $('#ssl').stop(true);
//         $('#ssl').animate({ opacity: 'show' }, 0);
//         $('#ssl-hover').css('position', 'absolute');
//     }
//     // setTimeout(
//     //     function () {
//     //         //do something special
//     //     }, 5000);
// );

