function submitForm() {
    // Démarrer ou redémarrer l'animation
    startAnimation('animationVideo2');

    // Obtenir les données du formulaire
    var firstName = document.getElementById("firstName").value;
    var lastName = document.getElementById("lastName").value;
    var email = document.getElementById("email").value;
    var message = document.getElementById("message").value;

    // Valider les données du formulaire (vous pouvez ajouter plus de validation si nécessaire)

    // Envoyer les données au serveur en utilisant AJAX
    var xhr = new XMLHttpRequest();
    var formData = new FormData();
    formData.append('firstName', firstName);
    formData.append('lastName', lastName);
    formData.append('email', email);
    formData.append('message', message);

    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4) {
            if (xhr.status == 200) {
                // Gérer la réponse, si nécessaire
                alert('Message envoyé avec succès !');
            } else {
                // Gérer l'erreur, si nécessaire
                alert('Erreur lors de l\'envoi du message. Veuillez réessayer.');
            }
        }
    };

    xhr.open('POST', 'send_contact_form.php', true);
    xhr.send(formData);
}

function startAnimation(videoId) {
    var animationVideo = document.getElementById(videoId);

    if (animationVideo.paused) {
        animationVideo.play();
    } else {
        animationVideo.currentTime = 0;
    }

    animationVideo.addEventListener('ended', function () {
        animationVideo.currentTime = 0;
        animationVideo.play(); // Redémarrer l'animation après sa fin
    });
}




document.addEventListener('DOMContentLoaded', function () {
    var animationVideo = document.getElementById('animationVideo');

    animationVideo.play();

    animationVideo.addEventListener('ended', function () {
        animationVideo.currentTime = 0;
    });
});

//JS Ruben
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


//JS Arno
function appearImgGalery(link, is50_9) {
    if (is50_9) {
        document.getElementById("bigGallery").classList.add('bigGallery16-9');
    }
    else {
        document.getElementById("bigGallery").classList.add('bigGallery50-9');
    }
    document.getElementById("bigGallery").classList.add('appear');
    document.getElementById("galleryCroix").classList.add('appear');
    document.getElementById("backgroundCover").classList.add('appear');
    bigGalleryImg = document.getElementById("bigGalleryImg");
    bigGalleryImg.src = link;
    document.getElementById("body").classList.add('body');
}

function removeGalery() {
    document.getElementById("bigGallery").classList.remove('appear');
    document.getElementById("bigGallery").classList.remove('bigGallery16-9');
    document.getElementById("bigGallery").classList.remove('bigGallery50-9');
    document.getElementById("galleryCroix").classList.remove('appear');
    document.getElementById("backgroundCover").classList.remove('appear');
    document.getElementById("body").classList.remove('body');
}