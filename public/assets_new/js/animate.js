//PAGE LOADER
$(window).load(function () {
    $('#processing').delay(900).fadeOut(400);
});
$("a#logout").click(function () {
    $("div").addClass("animated fadeOut");
});
$("input#load").click(function () {
    $("#page_loader_dim").show();
});
$("button#load").click(function () {
    $("#page_loader_dim").show();
});

//DOM

//ADV
$("input#page_loader_dim_submit").click(function(){
    $("div#login_dialog").addClass("animated fadeOut");
});

this.$('.js-loading-bar').modal({
  backdrop: 'static',
  show: false
});

$('a#load').click(function() {
  var $modal = $('.js-loading-bar'),
    $bar = $modal.find('.progress-bar');

  $modal.modal('show');
  $bar.addClass('animate');

  setTimeout(function() {
    $bar.removeClass('animate');
    $modal.modal('hide');
  }, 9999);
});

$('a#load_timed').click(function() {
  var $modal = $('.js-loading-bar'),
    $bar = $modal.find('.progress-bar');

  $modal.modal('show');
  $bar.addClass('animate');

  setTimeout(function() {
    $bar.removeClass('animate');
    $modal.modal('hide');
  }, 1000);
});

$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

$('.carousel').carousel({
  interval: 5000
}).on('slide.bs.carousel', function (e) {
  var nextH = $(e.relatedTarget).height();
  console.log(nextH)
  console.log( $(this).find('.active.item').parent() )
  $(this).find('.active.item').parent().animate({
    height: nextH
  }, 500);
});