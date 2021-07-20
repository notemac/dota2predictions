
$('.logo-wrapper').click(function (event) {
    window.location.href = './index.php';
});

// Выбор подписки (subscribe-welcome.php)
$(".subscribe-select").change(function () {
    if ($(this).val() == 'Base') {
        $('.subscription-plan-description').html('<span class="yellow spd-header">Base plan includes the next statistics of the team:</span> winrates, average number of deaths per match, average lost matches duration, heroes advantages, heroes winrates (+ free for the first week).');
    }
    else {
        $('.subscription-plan-description').html('<span class="yellow spd-header">Advanced plan includes the next statistics of the team:</span> team roster, participation in tournaments, winrates, average number of deaths/kills per match, average lost/win matches duration, average first blood time, heroes advantages, heroes winrates and much more (+ free for the first week).');
    }
});

$('.submit-dialog-close').click(function () { $('.submit-dialog').get(0).close(); })

// FAQ
let lastIndex = -1;
$(document).ready(function () {
    $(`.faq-question-wrapper`).click(function () {
        let faq = $(`.faq-question-wrapper`);
        let n = $(`.faq-question-wrapper`).length;
        let index = $(this).index();
        if (index == 6) {
            if ($(this).css('border-radius') != '0px')
                $(this).css('border-radius', '0px');
            else
                $(this).css('border-radius', '0px 0px .625rem .625rem');
        }
        $(this).css('background-color', 'rgb(0, 19, 34)');
        $(this).css('font-family', "'DINPro-Medium', sans-serif");
        $(this).css('color', '#BCFB08');
        $($(this).get(0).children[1]).css('fill', '#BCFB08');
        if (lastIndex == index) {
            $(this).children('svg').html('<path d="M7.41 7.84L12 12.42l4.59-4.58L18 9.25l-6 6-6-6z"></path>');
            $(this).css('background-color', '#001322ad');
            $(this).css('color', 'whitesmoke');
            $(this).children('svg').css('fill', 'whitesmoke');
            $(this).css('font-family', "'DINPro-Regular', sans-serif");
            lastIndex = -1;
        }
        else {
            $(this).children('svg').html('<path d="M 7.41 15.41 L 12 10.83 l 4.59 4.58 L 18 14 l -6 -6 l -6 6 Z"></path>');
            lastIndex = index;
        }
        $(this).next().toggle('fast');
        for (let i = 0; i < n; ++i) {
            if (faq[i] != $(this)[0]) {
                $(faq[i]).next().hide('fast');
                $(faq[i]).css('background-color', '#001322ad');
                $(faq[i]).css('color', 'whitesmoke');
                $(faq[i]).children('svg').css('fill', 'whitesmoke');
                $(faq[i]).css('font-family', "'DINPro-Regular', sans-serif");
                $(faq[i]).children('svg').html('<path d="M7.41 7.84L12 12.42l4.59-4.58L18 9.25l-6 6-6-6z"></path>');
                if ($(faq[i]).index() == 6) {
                    $(faq[i]).css('border-radius', '0px 0px .625rem .625rem');
                }
            }
        }
        return false;
    });
});