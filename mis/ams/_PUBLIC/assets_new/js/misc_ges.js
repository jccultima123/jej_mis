/**
$(document).ready(function () {
    var menu = $('#header');
    var origOffsetY = menu.offset().top;
    function scroll() {
        if ($(window).scrollTop() >= origOffsetY) {
            $('#header').addClass('navbar-fixed-top');
        } else {
            $('#header').removeClass('navbar-fixed-top');
        }
    }
    document.onscroll = scroll;
});
**/

$("a.close").click(function () {
    $("div#feedback").close();
});