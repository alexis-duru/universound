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

// METHODE PLAY / PAUSE //

document.addEventListener('play', function(e){
    var audios = document.getElementsByTagName('audio');
    for(var i = 0, len = audios.length; i < len;i++){
        if(audios[i] != e.target){
            audios[i].pause();
        }
    }
}, true);

// AJAX LIKE //

// console.log("ok");
    
// function onClickBtnLike(e){
    
//     const likeCount = document.querySelector(".likes-count");
//     const removeMe = document.getElementById('removeMe');
    
//     e.preventDefault();
//     const likeBtn = this.getAttribute('value');
//     const likeUrl = this.href;
//     const likeSelector = this;
    

//     console.log(likeBtn);
//     console.log(likeUrl);

//     fetch(likeUrl + "?ajax=1", {
//         headers: {
//             "X-Requested-With": "XMLHttpRequest"
//         }
//     }).then(response => 
//         response.json()
//     ).then(data => {
        
//         console.log(data.liked)
//         likeSelector.classList.toggle("red")
//         if(data.liked){
//             likeSelector.firstChild.classList.replace('far','fas');
//         }else{
//             likeSelector.firstChild.classList.replace('fas','far');
//         }
//         if(likeCount){
//             likeCount.textContent = data.likes + " x  "
//         }
//         if(removeMe){
//             likeSelector.closest('#removeMe').remove();
//         }
      
//     }).catch(e => alert(e));
// }

// document.querySelectorAll('a.likeBtn').forEach(function (link){
//     link.addEventListener("click", onClickBtnLike); 
// })


