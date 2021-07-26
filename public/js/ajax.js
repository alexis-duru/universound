
// AJAX LIKE //

// console.log("ok");



// let likeClick = (e) => {
//     let link = e.target.closest('a').getAttribute('href')
//     let countBtn = e.target.closest('button');
//     console.log(e.target.tagName)
//     if(e.target.tagName == 'A'){
//         let countBtn = e.target.firstChild;
//         let link = e.target.getAttribute('href');
//     }
//     // const countBtn = document.querySelector("button.small-btn");
//     const icon = countBtn.firstChild;
//     const count = icon.nextElementSibling;
//     // console.log(e.target.closest('button'))
//     e.preventDefault();
    
    
//     fetch(link + "?ajax=1", {
//         headers: {
//             "X-Requested-With": "XMLHttpRequest"
//         }}).then(response => 
//             response.json()
//         ).then(data => {
            
//             if(data.liked){
//                 icon.classList.replace('fa-heart','fa-heart-broken');
//                 icon.id = 'i-1-broke'
//                 count.textContent -- ;
//             }else{
//                 icon.classList.replace('fa-heart-broken','fa-heart');
//                 icon.id = 'i-1';
//                 count.textContent++;
//             }
//         })

// }

// document.querySelectorAll('a.small-btn-white').forEach((link) => {
//     link.addEventListener("click", likeClick);
// })








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

