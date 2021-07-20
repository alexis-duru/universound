(function($){
    
    console.log('hello');

    // BUTTON DOWNLOAD VICHFILE UPLOAD //

    $('#upload1').on('click', function(){
        $('.vichfilebutton1')[0].click();
      });

    $('#upload2').on('click', function(){
        $('.vichfilebutton2')[0].click();
    });

    // BUTTON DOWNLOAD VICHFILE REGISTER //

    $('#upload3').on('click', function(){
        $('.vichfilebutton3')[0].click();
    });

    // SLIDE COMMENT //

    $('#btn-slide-comment').on('click',function(){
        $('.container-comment').slideToggle();
    });

    // SHADOW WINDOWS STREAM //

    // SCROLL FX //

    // HOVER FX //

    // $('.container-track').mouseenter(function() {
    //     $(this).siblings().css("opacity","0.4","slow")
    //     var focustrack = $(this).siblings();
    //     if (!focustrack.is("opacity","0.4","slow")) {
    //         $(".container-track").css("opacity","0.75","slow");
    //         focustrack.css("opacity","0.4","slow");
    //     }
    // });
    // $('.container-track').mouseleave(function() {
    //     $(this).siblings().css("opacity","0.75","slow")
    // });



    // ----------------------------------------------- //

    // var $audio =$('.audiotrack');

    // $(audio).on('click', function() {
    //     $('.small-btn').hide();
    // });

})(jQuery);




