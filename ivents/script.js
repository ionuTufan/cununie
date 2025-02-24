// Schimbarea automată a imaginilor din product-cta
const images = [
    "./gallery/5.png",
    "./gallery/9.png",
    "./gallery/12.png",
    "./gallery/20.png",
    "./gallery/22.png",
    "./gallery/27.png",
    "./gallery/28.png",
    "./gallery/34.png",
    "./gallery/39.png",
    "./gallery/50.png",
    "./gallery/53.png",
    "./gallery/54.png",
    "./gallery/55.png"
];

let currentIndex = 0;
const productCta = document.querySelector(".product-cta");
const showButton = document.querySelector(".show");

function changeBackground() {
    currentIndex = (currentIndex + 1) % images.length;
    productCta.style.backgroundImage = `url('${images[currentIndex]}')`;
}

// Schimbă imaginea la click pe butonul "Show"
if (showButton) {
    showButton.addEventListener("click", changeBackground);
}

// Slider automat cu progress bar
const progressBar = document.querySelector(".progress");
const slides = document.querySelectorAll(".slider li");
let slideIndex = 0;

function nextSlide() {
    slides[slideIndex].classList.remove("visible"); // Ascunde slide-ul curent
    slideIndex = (slideIndex + 1) % slides.length; // Trecem la următorul
    slides[slideIndex].classList.add("visible"); // Afișăm noul slide

    // Resetăm animația barei de progres
    progressBar.style.animation = "none";
    setTimeout(() => {
        progressBar.style.animation = "progress 6s linear forwards";
    }, 50);
}

// Inițializăm primul progress bar
setTimeout(nextSlide, 6000);
setInterval(nextSlide, 6000); // La fiecare 6 secunde schimbă slide-ul

// Efect de blur la header când facem scroll
const header = document.querySelector("header");
window.addEventListener("scroll", () => {
    if (window.scrollY > 0) {
        header.classList.add("blur");
    } else {
        header.classList.remove("blur");
    }
});

// Dezactivează scroll-ul când meniul mobil este deschis
const menuToggle = document.querySelector(".mobile-nav input[type='checkbox']");
menuToggle.addEventListener("click", () => {
    document.documentElement.style.overflow = menuToggle.checked ? "hidden" : "visible";
});


