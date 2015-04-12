// PAGE LOADER
$(window).load(function () {
    // Animate loader off screen
    $(".se-pre-con").fadeOut("slow");
    ;
});

// SHOW HIDE BUTTON
$(document).ready(function(){
    $(".toggle").click(function(){
        $("#exp").toggle();
    });
});