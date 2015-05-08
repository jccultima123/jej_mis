//PAGE LOADER
$(window).load(function () {
    $("#page_loader_alt").fadeOut(200);
});
$("a#load").click(function () {
    $("#page_loader_alt").show();
});
$("input#page_loader_submit").click(function () {
    $("#page_loader_alt").show();
});