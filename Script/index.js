// Déclarez la fonction en dehors de la fonction anonyme
function startAnimation(videoId) {
    var animationVideo = document.getElementById(videoId);

    if (animationVideo.paused) {
        animationVideo.play();
    } else {
        animationVideo.currentTime = 0;
    }

    animationVideo.addEventListener('ended', function () {
        animationVideo.currentTime = 0;
        animationVideo.pause();
    });
}