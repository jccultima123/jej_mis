//PAGE LOADER
$(window).load(function () {
    $("#page_loader").delay(300).fadeOut(200);
});
$("input#page_loader_submit").click(function () {
    $("#page_loader").show();
});

$("a#load_dark").click(function () {
    $("#page_loader").show();
});
$("input#login").click(function () {
    $("#page_loader").show();
});
$("input#submit").click(function () {
    $("#page_loader").show();
});