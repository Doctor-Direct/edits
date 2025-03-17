document.addEventListener("DOMContentLoaded", function () {
    // Navbar scroll effect
    window.addEventListener("scroll", function () {
        let navbar = document.querySelector(".navbar");
        navbar.classList.toggle("scrolled", window.scrollY > 50);
    });

    // Start the automatic slideshow
    startSlideShow();
});

let slideIndex = 0;
let slideTimer;

// Show slides automatically
function startSlideShow() {
    showSlides();
    slideTimer = setInterval(() => plusSlides(1), 2000); // Auto change every 2s
}

// Next/Previous controls
function plusSlides(n) {
    clearInterval(slideTimer); // Stop auto-slide on manual interaction
    slideIndex += n;
    showSlides();
    slideTimer = setInterval(() => plusSlides(1), 2000); // Restart auto-slide
}

// Thumbnail image controls
function currentSlide(n) {
    clearInterval(slideTimer);
    slideIndex = n - 1;
    showSlides();
    slideTimer = setInterval(() => plusSlides(1), 2000);
}

// Show slides with animation
function showSlides() {
    let slides = document.getElementsByClassName("mySlides");
    let dots = document.getElementsByClassName("dot");

    if (slideIndex >= slides.length) {
        slideIndex = 0;
    }
    if (slideIndex < 0) {
        slideIndex = slides.length - 1;
    }

    // Hide all slides
    for (let i = 0; i < slides.length; i++) {
        slides[i].style.opacity = "0"; // Set opacity to 0 for fade-out
        slides[i].style.display = "none";
    }
    
    // Remove "active" from all dots
    for (let i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }

    // Show current slide with fade-in effect
    slides[slideIndex].style.display = "block";
    setTimeout(() => {
        slides[slideIndex].style.opacity = "1"; // Fade in effect
    }, 50);

    dots[slideIndex].className += " active";
}


