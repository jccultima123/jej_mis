//PAGE LOADER
$(window).load(function () {
    $("#page_loader").delay(1200).fadeOut(300);
    $("#page_loader_alt").delay(100).fadeOut(300);
});
$(".loading").click(function () {
    $(".loading").css("display", "block");
});