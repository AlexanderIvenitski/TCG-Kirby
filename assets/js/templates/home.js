/* accordion */

var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function () {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight) {
      panel.style.maxHeight = null;
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
    }
  });
}

/* swiper */

const swiper = new Swiper(".swiper", {
  // Optional parameters
  direction: "horizontal",
  loop: true,

  // If we need pagination
  /* 
  pagination: {
     el: ".swiper-pagination",
   },
  
  */

  // Navigation arrows
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },

  // And if we need scrollbar
  scrollbar: {
    el: ".swiper-scrollbar",
    draggable: true,
  },
  speed: 400,
  spaceBetween: 10,
  autoplay: {
    delay: 4000,
  },
  slidesPerView: "auto",
  breakpoints: {},
  grabCursor: true,
  keyboard: {
    enabled: true,
    onlyInViewport: true,
  },
});

/* Menu */

function closeSidebar() {
  document.getElementById("menu-toggle").checked = false;
}
