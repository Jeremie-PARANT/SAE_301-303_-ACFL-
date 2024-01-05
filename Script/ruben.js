
$(document).ready(function () {
    setTimeout(function () {
        $("#cookie-banner").addClass("show");
    }, 200);
    
});

function acceptCookies() {
    $("#cookie-banner").removeClass("show");
    cookie = document.getElementById('cookie-banner');
    cookie.classList.add("visibility"); 
    // Ajoutez ici votre logique pour accepter les cookies
}

function rejectCookies() {
    $("#cookie-banner").removeClass("show");
    cookie = document.getElementById('cookie-banner');
    cookie.classList.add("visibility"); 
    // Ajoutez ici votre logique pour refuser les cookies
}