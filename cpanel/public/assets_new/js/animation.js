//$('.collapse').collapse()

$('#accordion').on('hidden.bs.collapse', function () {
//do something...
})

$('#accordion .accordion-toggle').click(function (e){
  var chevState = $(e.target).siblings("i.indicator").toggleClass('glyphicon-chevron-down glyphicon-chevron-up');
  $("i.indicator").not(chevState).removeClass("glyphicon-chevron-down").addClass("glyphicon-chevron-up");
});

//PAGE LOADER
$(window).load(function () {
    $("#page_loader_dim").delay(300).fadeOut(200);
});
$("a#load").click(function () {
    $("#page_loader_dim").fadeIn(80);
});
$("input#load").click(function () {
    $("#page_loader_dim").fadeIn(80);
});
$("button#load").click(function () {
    $("#page_loader_dim").fadeIn(80);
});
