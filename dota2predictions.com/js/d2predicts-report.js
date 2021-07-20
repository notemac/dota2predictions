
$('.dropdown-menu').click(function (event) {
    window.location.href = './admin.php?logout';
});

// РЕПОРТ
$('.open-report12').click(function(event) {
    if ($('.report12').is(':visible')) {
        $('.report12').slideUp(200);
        $('.open-report12 svg').html('<path d="M7.41 7.84L12 12.42l4.59-4.58L18 9.25l-6 6-6-6z"></path>');
    }
    else {
        $('.report12').slideDown(200);
        $('.open-report12 svg').html('<path d="M 7.41 15.41 L 12 10.83 l 4.59 4.58 L 18 14 l -6 -6 l -6 6 Z"></path>');
    }
});
$('.open-report34').click(function (event) {
    if ($('.report34').is(':visible')) {
        $('.report34').slideUp(200);
        $('.open-report34 svg').html('<path d="M7.41 7.84L12 12.42l4.59-4.58L18 9.25l-6 6-6-6z"></path>');
    }
    else {
        $('.report34').slideDown(200);
        $('.open-report34 svg').html('<path d="M 7.41 15.41 L 12 10.83 l 4.59 4.58 L 18 14 l -6 -6 l -6 6 Z"></path>');
    }
});


// $('.report-download').click(function() {
//     alert(10);
// });