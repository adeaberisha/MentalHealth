//SLIDERI I PARE
let i = 0;
let imgArray = ['slider5-02.jpg','slider2-02.jpg','slider3-02.jpg','slider4-02.jpg','slider1-02.jpg','slider6-02.jpg'];


function changeImg(){
let slideshowImg = document.getElementById('slideshow');
slideshowImg.onload = function(){
slideshowImg.height = 600; // height per fotot

let screenWidth =  window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
slideshowImg.width = screenWidth; // width per fotot

};

slideshowImg.src = imgArray[i];

}

function nextImg() {
    if (i < imgArray.length - 1) {
        i++;
    } else {
        i = 0;
    }
    changeImg();
}

function prevImg() {
    if (i > 0) {
        i--;
    } else {
        i = imgArray.length - 1;
    }
    changeImg();
}

function startSlider() {
    setInterval(nextImg, 4000); //Ndryshoje fotografine cdo 4 sekonda
}

document.addEventListener("DOMContentLoaded", function() {
    changeImg(); //Tregoje fotografine e pare
    startSlider(); //Filloje sliderin automatik
});

window.addEventListener('resize',function(){
    changeImg();
});

/*SLIDER I DYTE (ME LIBRA)*/
let currentIndex = 0;

function changeSlide(direction) {
const slides = document.querySelector('.slider');
const totalSlides = document.querySelectorAll('.slide').length;

currentIndex += direction;

if (currentIndex < 0) {
    currentIndex = totalSlides - 1;
} else if (currentIndex >= totalSlides) {
    currentIndex = 0;
}

const translateValue = -currentIndex * 100 + '%';
slides.style.transform = 'translateX(' + translateValue + ')';

}

