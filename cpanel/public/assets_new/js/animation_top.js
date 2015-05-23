//PAGE LOADER
$(window).load(function () {
    $("#page_loader").delay(300).fadeOut(200);
});
$("input#page_loader_submit").click(function () {
    $("div#login_body").css("display", "none");
});
$("input#page_loader_submit").click(function () {
    $("#page_loader_2").show();
});

$("a#load_dark").click(function () {
    $("#page_loader").show();
});
$("input#login").click(function () {
    $("#page_loader_2").show();
});
$("input#submit").click(function () {
    $("#page_loader").show();
});