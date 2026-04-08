const menuBtn = document.querySelector(".menu-hamburger");
const navLinks = document.querySelector(".nav-links");
const navBar = document.querySelector(".navbar");
const overlay = document.querySelector(".overlay");
const selectElement = document.getElementById('typeSelect');
const formElement = document.getElementById('filterForm');

menuBtn.addEventListener("click", () => {
  navLinks.classList.toggle("open");
  navBar.classList.toggle("open");
  overlay.classList.toggle("active");
  
  if (navLinks.classList.contains("open")) {
    menuBtn.src = "/assets/images/icon-close.svg";
  } else {
    menuBtn.src = "/assets/images/icon-hamburger.svg";
  }
});

selectElement.addEventListener('change', function() {
    formElement.submit();
});