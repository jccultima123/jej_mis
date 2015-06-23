//PAGE LOADER
$(window).load(function () {
    $("#page_loader").delay(300).fadeOut(200);
});
$("a").click(function () {
    $("#page_loader").show();
});
$("input#page_loader_submit").click(function () {
    $("#page_loader").show();
});