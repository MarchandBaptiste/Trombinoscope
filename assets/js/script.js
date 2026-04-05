const menuBtn = document.querySelector(".menu-hamburger");
const navLinks = document.querySelector(".nav-links");
const navBar = document.querySelector(".navbar");
const overlay = document.querySelector(".overlay");

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