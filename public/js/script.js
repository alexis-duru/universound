(function($){
    
    console.log('hello');

    // BUTTON DOWNLOAD VICHFILE //

    $('#upload1').on('click', function(){
        $('.vichfilebutton1')[0].click();
      });

    $('#upload2').on('click', function(){
        $('.vichfilebutton2')[0].click();
    });

    $('#upload3').on('click', function(){
        $('.vichfilebutton3')[0].click();
    });

    // SHADOW WINDOWS STREAM //

    // HEART COLOR //
    $('#i-1').click(function(){
        $(this).css('color', 'red');
    
      });

      $('.number-heart').click(function(){
        $(this).toggleClass('clicked');
      });


})(jQuery);




