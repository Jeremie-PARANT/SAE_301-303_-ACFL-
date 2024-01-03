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