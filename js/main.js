$(function() {
    $('.globe').on('click', function() {
        $('.icons').slideToggle();
    })
})

/*

$(function() { 
if (window.matchMedia("(max-width: 767px)").matches){ 
$('.nav li').hover(function() { 
$(this).children('ul').stop(false, true).fadeIn(300); 
$(this).children('a').addClass('selected'); 
}, 
function() { 
$(this).children('ul').stop(false, true).fadeOut(300); 
$(this).children('a').removeClass('selected'); 
}); 
}; 
});

*/