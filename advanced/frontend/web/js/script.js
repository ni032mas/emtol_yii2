$(document).ready(function(){
    $('.item-background-carousel').css('height', $(window).height()-50);
});
$(window).resize(function() {
    $('.item-background-carousel').css('height', $(window).height()-50);
});