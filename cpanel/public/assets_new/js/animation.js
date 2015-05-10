//PAGE LOADER
$(window).load(function () {
    $("#page_loader_dim").delay(300).fadeOut(200);
});
$("a#load").click(function () {
    $("#page_loader_dim").fadeIn(80);
});
$("input").click(function () {
    $("#page_loader_dim").fadeIn(80);
});