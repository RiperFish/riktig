import "../css/style.css";

document.querySelectorAll(".accordion-toggle").forEach((button) => {
  if (!button) return;
  button.addEventListener("click", () => {
    document.querySelectorAll(".accordion-content").forEach((c) => {
      c.classList.add("max-h-0");
      c.classList.remove("max-h-[500px]");
      //previousElementSibling
      //.querySelector(".indicator").classList.remove("rotate-180");
    });

    const content = button.nextElementSibling;
    const isOpen = content.classList.contains("max-h-0");

    if (isOpen) {
      content.classList.remove("max-h-0");
      content.classList.add("max-h-[500px]");
      button.querySelector(".indicator").classList.add("rotate-180");
      //Collapse all if you want single open
    } else {
      content.classList.remove("max-h-[500px]");
      content.classList.add("max-h-0");
      button.querySelector(".indicator").classList.remove("rotate-180");
    }
  });
});

jQuery(document).ready(function ($) {
  const header = document.querySelector("header");
  const icon = document.querySelector(".mobile-menu-btn");
  if (!icon) return;
  const mobileMenu = document.querySelector("header #menu");
  icon.addEventListener("click", (event) => {
    icon.classList.toggle("open");
    mobileMenu.classList.toggle("open");
    header.classList.toggle("menu-opened");
    //document.body.classList.toggle("no-scroll");
  });

  const buttons = document.querySelectorAll(".btn");

  buttons.forEach((btn) => {
    btn.addEventListener("click", () => {
      btn.classList.add("clicked");

      // Optional: remove class after short delay
      setTimeout(() => {
        btn.classList.remove("clicked");
      }, 200);
    });
  });

  let ajaxUrl = "";
  if (devMode == "staging") {
    ajaxUrl = ajaxurl;
  } else {
    ajaxUrl = my_ajax_object.ajax_url;
  }

  let emailObject = {
    clientInfos: [],
    itemsData: [],
    address: [],
    volume: [],
  };

  /*  window.addEventListener("scroll", () => {
    const header = document.querySelector("header .header-content");
    if (window.scrollY > 20) {
      header.classList.add("shrink");
    } else {
      header.classList.remove("shrink");
    }
  }); */
  window.onscroll = function () {
    scrollFunction();
  };

  function scrollFunction() {
    window.requestAnimationFrame(() => {
      const header = document.querySelector("header .header-content");
      const scrollTop = window.scrollY || document.documentElement.scrollTop;
      if (
        document.body.scrollTop > 50 ||
        document.documentElement.scrollTop > 50
      ) {
        header.classList.add("shrink");
      } else {
        header.classList.remove("shrink");
      }
    });
  }
});
