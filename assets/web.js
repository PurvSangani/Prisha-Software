let slideIndex = 1;
showSlides(slideIndex);

// Next / Previous controls
function plusSlides(n) {
  showSlides(slideIndex += n);
}

// Dot controls
function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  let i;
  let slides = document.getElementsByClassName("mySlides");
  let dots = document.getElementsByClassName("dot");

  if (n > slides.length) { slideIndex = 1 }
  if (n < 1) { slideIndex = slides.length }

  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }

  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }

  slides[slideIndex - 1].style.display = "block";
  dots[slideIndex - 1].className += " active";
}
setInterval(function() {
  plusSlides(1);
}, 3000); // change slide every 3 seconds



const links = document.querySelectorAll(".header ul li a");

// Get current page file name
const currentPage = window.location.pathname.split("/").pop().toLowerCase();

links.forEach(link => {
    // Convert href to lowercase and remove hyphens for safety
    const linkPage = link.getAttribute("href").toLowerCase();
    if(linkPage === currentPage){
        link.classList.add("active");
    }
});
