$(document).ready(function () {
    setTimeout(function () {
        $("#cookie-banner").addClass("show");
    }, 200);
});

function acceptCookies() {
    $("#cookie-banner").removeClass("show");
    // Ajoutez ici votre logique pour accepter les cookies
}

function rejectCookies() {
    $("#cookie-banner").removeClass("show");
    // Ajoutez ici votre logique pour refuser les cookies
}