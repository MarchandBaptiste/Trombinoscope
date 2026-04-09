document.addEventListener("DOMContentLoaded", () => {
  const menuBtn = document.querySelector(".menu-hamburger");
  const navLinks = document.querySelector(".nav-links");
  const navBar = document.querySelector(".navbar");
  const overlay = document.querySelector(".overlay");
  const btnSuivant = document.getElementById("btn-etape-suivante");
  const btnPrecedent = document.getElementById("btn-etape-precedente");
  const container = document.getElementById("container");
  const selectElement = document.getElementById("typeSelect");
  const formElement = document.getElementById("filterForm");

  selectElement.addEventListener("change", function () {
    formElement.submit();
  });

  if (menuBtn && navLinks && navBar && overlay) {
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
  }

  if (btnSuivant && btnPrecedent && container) {
    btnSuivant.addEventListener("click", () => {
      container.classList.add("right-panel-active");
    });

    btnPrecedent.addEventListener("click", () => {
      container.classList.remove("right-panel-active");
    });
  }
});

function updatePhotoLabel(input) {
  const label = document.getElementById("upload-label");
  if (input.files && input.files[0]) {
    label.textContent = "✅ " + input.files[0].name;
  }
}
