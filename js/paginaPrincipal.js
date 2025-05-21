document.getElementById('open_btn').addEventListener('click', function () {
    document.getElementById('sidebar').classList.toggle('open-sidebar');
    document.getElementById('user_avatar').classList.toggle('user');
});

document.addEventListener('keypress', function(e){
    if(e.key == 'm' || e.key == 'M') document.getElementById('sidebar').classList.toggle('open-sidebar');
})

// document.getElementById('user').addEventListener('click', function(){
//     document.getElementById('popupAcount').classList.toggle('popupAcountClosed');


// })

document.addEventListener('click', function(e){
    var el = e.target
    console.log(el)
    if(el.classList == 'user' || el.classList == 'item-description' || el.classList == 'fa-solid fa-angle-down'){
        document.getElementById('popupAcount').classList.toggle('popupAcountClosed');
    }else{
        document.getElementById('popupAcount').classList.add('popupAcountClosed');
    }


})