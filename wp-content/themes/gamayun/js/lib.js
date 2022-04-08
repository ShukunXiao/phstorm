// Open and close sidebar
(function ($) {
  // jQuery element variables
  var $hamburgerMenuBtn,
    $slideNav,
    $closeBtn;
  // focus management variables
  var $focusableInNav,
    $firstFocusableElement,
    $lastFocusableElement;
  $(document).ready(function () {
    $hamburgerMenuBtn = $("#open-sidebar"),
      $slideNav = $("#mySidebar"),
      $closeBtn = $("#close-sidebar"),
      $focusableInNav = $('#mySidebar button, #mySidebar [href], #mySidebar input, #mySidebar select, #mySidebar textarea, #mySidebar [tabindex]:not([tabindex="-1"])');
    if ($focusableInNav.length) {
      $firstFocusableElement = $focusableInNav.first();
      $lastFocusableElement = $focusableInNav.last();
    addEventListeners();
    }
  });

  function addEventListeners() {
    $hamburgerMenuBtn.click(openNav);
    $closeBtn.click(closeNav);
    $slideNav.on("keyup", closeNav);
    $firstFocusableElement.on("keydown", moveFocusToBottom);
    $lastFocusableElement.on("keydown", moveFocusToTop);
  }

  function openNav() {
    $slideNav.show();
    $firstFocusableElement.focus();
  }

  function closeNav(e) {
    if (e.type === "keyup" && e.key !== "Escape") {
      return;
    }
    $slideNav.hide();
    $hamburgerMenuBtn.focus();
  }

  function moveFocusToTop(e) {
    if (e.key === "Tab" && !e.shiftKey) {
      e.preventDefault();
      $firstFocusableElement.focus();
    }
  }

  function moveFocusToBottom(e) {
    if (e.key === "Tab" && e.shiftKey) {
      e.preventDefault();
      $lastFocusableElement.focus();
    }
  }
})(jQuery);

(function ($) {
  document.addEventListener('DOMContentLoaded', function () {
    var style = getComputedStyle(document.querySelector('.w3-theme-d5'));
    document.documentElement.style.setProperty('--menu-background-color', style.backgroundColor);
    document.documentElement.style.setProperty('--menu-link-color', style.color);

    $(".widget_search .search-submit").prop('value', '\ue986');

  }, false);
})(jQuery);

document.addEventListener('DOMContentLoaded', function () {
  mybutton = document.getElementById("myBtn");
  window.addEventListener('scroll', scrollFunction, false);
}, false);

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}