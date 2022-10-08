"use strict";
$(document).ready(function () {
  //Product Zoom
  $(".product_details_img img").imagezoomsl({
    scrollspeedanimate: 10,
  });
  //Select box
  $(".niceSelect").niceSelect();
  //Image Select
  $(".imgSelectBox").ddslick({
    width: 300,
    imagePosition: "left",
  });
  $(".imgSelectBox1").ddslick({
    width: 300,
    imagePosition: "left",
  });
  //Input Tel Internationl
  $("#telephone,#telephoneEdit,#profileTelephone").intlTelInput({
    separateDialCode: true,
    autoPlaceholder: "aggressive",
    utilsScript: "assets/plugins/js/utils.js",
  });

  //Custom Select box
  $("div.selectBox").each(function () {
    $(this)
      .children("span.selected")
      .html(
        $(this)
          .children("div.selectOptions")
          .children("span.selectOption:first")
          .html()
      );
    $(this).attr(
      "value",
      $(this)
        .children("div.selectOptions")
        .children("span.selectOption:first")
        .attr("value")
    );

    $(this)
      .children("span.selected,span.selectArrow")
      .click(function () {
        if (
          $(this).parent().children("div.selectOptions").css("display") ==
          "none"
        ) {
          $(this)
            .parent()
            .children("div.selectOptions")
            .css("display", "block");
        } else {
          $(this).parent().children("div.selectOptions").css("display", "none");
        }
      });

    $(this)
      .find("span.selectOption")
      .click(function () {
        $(this).parent().css("display", "none");
        $(this).closest("div.selectBox").attr("value", $(this).attr("value"));
        $(this).parent().siblings("span.selected").html($(this).html());
      });
  });

  //About Value Gallery
  $(".about_value_img").magnificPopup({
    type: "image",
    gallery: {
      enabled: true,
    },
  });

  //Multistep Form
  $(function () {
    //jQuery time
    var current_fs, next_fs, previous_fs; //fieldsets
    var left, opacity, scale; //fieldset properties which we will animate
    var animating; //flag to prevent quick multi-click glitches

    $(".next").click(function () {
      if (animating) return false;
      animating = true;

      current_fs = $(this).parent();
      next_fs = $(this).parent().next();

      //activate next step on progressbar using the index of next_fs
      $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

      //show the next fieldset
      next_fs.show();
      //hide the current fieldset with style
      current_fs.animate(
        { opacity: 0 },
        {
          step: function (now, mx) {
            //as the opacity of current_fs reduces to 0 - stored in "now"
            //1. scale current_fs down to 80%
            scale = 1 - (1 - now) * 0.2;
            //2. bring next_fs from the right(50%)
            left = now * 50 + "%";
            //3. increase opacity of next_fs to 1 as it moves in
            opacity = 1 - now;
            current_fs.css({ transform: "scale(" + scale + ")" });
            next_fs.css({ left: left, opacity: opacity });
          },
          duration: 800,
          complete: function () {
            current_fs.hide();
            animating = false;
          },
          //this comes from the custom easing plugin
          easing: "easeInOutBack",
        }
      );
    });

    $(".previous").click(function () {
      if (animating) return false;
      animating = true;

      current_fs = $(this).parent();
      previous_fs = $(this).parent().prev();

      //de-activate current step on progressbar
      $("#progressbar li")
        .eq($("fieldset").index(current_fs))
        .removeClass("active");

      //show the previous fieldset
      previous_fs.show();
      //hide the current fieldset with style
      current_fs.animate(
        { opacity: 0 },
        {
          step: function (now, mx) {
            //as the opacity of current_fs reduces to 0 - stored in "now"
            //1. scale previous_fs from 80% to 100%
            scale = 0.8 + (1 - now) * 0.2;
            //2. take current_fs to the right(50%) - from 0%
            left = (1 - now) * 50 + "%";
            //3. increase opacity of previous_fs to 1 as it moves in
            opacity = 1 - now;
            current_fs.css({ left: left });
            previous_fs.css({
              transform: "scale(" + scale + ")",
              opacity: opacity,
            });
          },
          duration: 800,
          complete: function () {
            current_fs.hide();
            animating = false;
          },
          //this comes from the custom easing plugin
          easing: "easeInOutBack",
        }
      );
    });

    $(".submit").click(function () {
      return false;
    });
  });

  //Event Countdown
  $(".event_countdown1").attr("data-date", dateText);
});
//Add Class
function displayItem(addID, addClass, ovlerlayID) {
  let addDiv = document.querySelector(`#${addID}`);
  let ovlerlayDiv = document.querySelector(`#${ovlerlayID}`);
  addDiv.classList.toggle(addClass);
  ovlerlayDiv.style.cssText = "  display: block;";
}
//Remove Class
function removeDisplayItem(removeID, removeClass, ovlerlayID) {
  let addDiv = document.querySelector(`#${removeID}`);
  let ovlerlayDiv = document.querySelector(`#${ovlerlayID}`);
  addDiv.classList.toggle(removeClass);
  ovlerlayDiv.style.cssText = "  display: none;";
}

//OutSide Scroll Hidden
function scrollOutsideHidden() {
  let htmlTag = document.querySelector("html");
  htmlTag.style.cssText = "overflow:hidden;";
}
//OutSide Scroll Scroll
function scrollOutsideScroll() {
  let htmlTag = document.querySelector("html");
  htmlTag.style.cssText = "overflow:auto;";
}

//Header

//Sticky Navbar
function stickyHeader(stickyTag, stickyClass, scrollHeight = 0) {
  let stickyWrapper = document.querySelector(`#${stickyTag}`);
  stickyWrapper.classList.toggle(stickyClass, scrollY > scrollHeight);
}
let headerWrapper = document.querySelector("#headerWrapper");
if (headerWrapper) {
  window.addEventListener("scroll", () => {
    stickyHeader("headerWrapper", "navbar_fixed");
  });
}

//Product Topbar
let productTopbar = document.querySelector("#productTopbar");
if (productTopbar) {
  window.addEventListener("scroll", () => {
    stickyHeader("productTopbar", "prodcut_topbar_fixed", 300);
  });
}

//Career Header
let careerButtonOpen = document.querySelector("#careerButtonOpen");
let careerButtonClose = document.querySelector("#careerButtonClose");
let careerMenuList = document.querySelector("#careerMenuList");
let careerOverlay = document.querySelector("#careerOverlay");
if (careerButtonOpen) {
  careerButtonOpen.addEventListener("click", () => {
    displayItem("careerMenuList", "career_active", "careerOverlay");
  });
}
if (careerButtonClose) {
  careerButtonClose.addEventListener("click", () => {
    removeDisplayItem("careerMenuList", "career_active", "careerOverlay");
  });
}
if (careerOverlay) {
  careerOverlay.addEventListener("click", () => {
    removeDisplayItem("careerMenuList", "career_active", "careerOverlay");
  });
}

//Search For Mobile
let suggestSearchForm = document.querySelectorAll("#suggestSearchForm");
if (suggestSearchForm) {
  for (let x of suggestSearchForm) {
    x.addEventListener("click", () => {
      x.classList.toggle("suggestActive");
    });
  }
}

//Cart Button
let cartDesktop = document.querySelector("#cartDesktop");
let cartButtonDesk = document.querySelector("#cartButtonDesk");
let cartMobile = document.querySelector("#cartMobile");
let cartButtonMobile = document.querySelector("#cartButtonMobile");

if (cartButtonDesk) {
  cartButtonDesk.addEventListener("click", () => {
    cartDesktop.classList.add("cart_dropdown_active");
  });

  if (window.innerWidth >= 1200) {
    cartButtonDesk.addEventListener("mouseenter", () => {
      cartDesktop.classList.add("cart_dropdown_active");
    });
    cartButtonDesk.addEventListener("mouseleave", () => {
      cartDesktop.classList.remove("cart_dropdown_active");
    });
  }
  outSideDetect(
    "cartButtonDesk",
    "cartDesktop",
    "cartDesktop",
    "cart_dropdown_active"
  );
}

if (cartButtonMobile) {
  cartButtonMobile.addEventListener("click", () => {
    cartMobile.classList.toggle("cart_dropdown_active");
  });

  outSideDetect(
    "cartButtonMobile",
    "cartMobile",
    "cartMobile",
    "cart_dropdown_active"
  );
}
//Country Select Box
let countryDesk = document.querySelector("#countryDesk");
let countryButtonDesk = document.querySelector("#countryButtonDesk");
let countryMobile = document.querySelector("#countryMobile");
let countryButtonMobile = document.querySelector("#countryButtonMobile");

if (countryButtonDesk) {
  countryButtonDesk.addEventListener("click", () => {
    countryDesk.classList.add("cart_dropdown_active");
  });

  if (window.innerWidth >= 1200) {
    countryButtonDesk.addEventListener("mouseenter", () => {
      countryDesk.classList.add("cart_dropdown_active");
    });
    countryButtonDesk.addEventListener("mouseleave", () => {
      countryDesk.classList.remove("cart_dropdown_active");
    });
  }
  outSideDetect(
    "countryButtonDesk",
    "countryDesk",
    "countryDesk",
    "cart_dropdown_active"
  );
}

if (countryButtonMobile) {
  countryButtonMobile.addEventListener("click", () => {
    countryMobile.classList.add("cart_dropdown_active");
  });

  outSideDetect(
    "countryButtonMobile",
    "countryMobile",
    "countryMobile",
    "cart_dropdown_active"
  );
}

//Pro Dropdwon
let proButtonDesk = document.querySelector("#proButtonDesk");
let proDropdwonDeskArea = document.querySelector("#proDropdwonDeskArea");
let proButtonMobile = document.querySelector("#proButtonMobile");
let proDropdwonMobileArea = document.querySelector("#proDropdwonMobileArea");
if (proButtonDesk) {
  proButtonDesk.addEventListener("click", () => {
    proDropdwonDeskArea.classList.add("cart_dropdown_active");
  });

  if (window.innerWidth >= 1200) {
    proButtonDesk.addEventListener("mouseenter", () => {
      proDropdwonDeskArea.classList.add("cart_dropdown_active");
    });
    proButtonDesk.addEventListener("mouseleave", () => {
      proDropdwonDeskArea.classList.remove("cart_dropdown_active");
    });
  }
  outSideDetect(
    "proButtonDesk",
    "proDropdwonDeskArea",
    "proDropdwonDeskArea",
    "cart_dropdown_active"
  );
}

if (proButtonMobile) {
  proButtonMobile.addEventListener("click", () => {
    proDropdwonMobileArea.classList.add("cart_dropdown_active");
  });

  outSideDetect(
    "proButtonMobile",
    "proDropdwonMobileArea",
    "proDropdwonMobileArea",
    "cart_dropdown_active"
  );
}
//Profile Icon
let profileIcon = document.querySelector("#profileIconMobile");
let profileIconDesktop = document.querySelector("#profileIconDesktop");
let profileDropdownArea = document.querySelector("#profileDropdownAreaMobile");
let profileDropdownAreaDesktop = document.querySelector(
  "#profileDropdownAreaDesktop"
);
if (profileIcon) {
  profileIcon.addEventListener("click", () => {
    profileDropdownArea.classList.add("profile_dropdown_active");
  });

  outSideDetect(
    "profileIconMobile",
    "profileDropdownAreaMobile",
    "profileDropdownAreaMobile",
    "profile_dropdown_active"
  );
}
if (profileIconDesktop) {
  profileIconDesktop.addEventListener("click", () => {
    profileDropdownAreaDesktop.classList.toggle("profile_dropdown_active");
  });
  if (window.innerWidth >= 1200) {
    profileIconDesktop.addEventListener("mouseenter", () => {
      profileDropdownAreaDesktop.classList.add("profile_dropdown_active");
    });
    profileIconDesktop.addEventListener("mouseleave", () => {
      profileDropdownAreaDesktop.classList.remove("profile_dropdown_active");
    });
  }
  outSideDetect(
    "profileIconDesktop",
    "profileDropdownAreaDesktop",
    "profileDropdownAreaDesktop",
    "profile_dropdown_active"
  );
}
//Preloader
let preLoader = document.querySelector("#preLoader");
if (preLoader) {
  window.addEventListener("load", () => {
    preLoader.style.cssText = "display:none;";
  });
}
//Modal
let modalClickButton1 = document.querySelector("#modalClickButton1");
let modalID1 = document.querySelector("#modalID1");
let modalClose1 = document.querySelector("#modalClose1");
let modalClickButton2 = document.querySelector("#modalClickButton2");
let modalID2 = document.querySelector("#modalID2");
let modalClose2 = document.querySelector("#modalClose2");
function modalShow(modalid, modaloverlay) {
  let modalID = document.querySelector(`#${modalid}`);
  let modalOverlayID = document.querySelector(`#${modaloverlay}`);
  modalID.classList.add("modal_active");
  modalOverlayID.style.cssText = "display:block";
}
function modalHide(modalid, modaloverlay) {
  let modalID = document.querySelector(`#${modalid}`);
  let modalOverlayID = document.querySelector(`#${modaloverlay}`);
  modalID.classList.remove("modal_active");
  modalOverlayID.style.cssText = "display:none";
}

if (modalClickButton1) {
  modalClickButton1.addEventListener("click", () => {
    modalShow("modalID1", "modalOverlay1");
  });
}
if (modalClose1) {
  modalClose1.addEventListener("click", () => {
    modalHide("modalID1", "modalOverlay1");
  });
}

if (modalClickButton2) {
  modalClickButton2.addEventListener("click", () => {
    modalShow("modalID2", "modalOverlay2");
  });
}
if (modalClose2) {
  modalClose2.addEventListener("click", () => {
    modalHide("modalID2", "modalOverlay2");
  });
}

//For Each Loop Function
function forEachLoop(addClass, selector, activeClass) {
  let selectItems = document.querySelectorAll(selector);
  addClass.addEventListener("click", (e) => {
    selectItems.forEach((removeClass) => {
      removeClass.classList.remove(activeClass);
    });
    addClass.classList.add(activeClass);
  });
}

//Topbar Slider
var swiper = new Swiper(".top_banner_wrapper .swiper", {
  speed: 1050,
  effect: "fade",
  autoplay: {
    delay: 5000,
  },
});

//Hero Slider
let swiperHero = new Swiper(".hero_slider_area .swiper", {
  // Default parameters
  speed: 1050,
  keyboard: {
    enabled: true,
    onlyInViewport: true,
  },
  autoplay: {
    delay: 5000,
  },
  navigation: {
    nextEl: ".hero_next_icon",
    prevEl: ".hero_prev_icon",
  },
  pagination: {
    el: ".hero_slider_pagination",
    clickable: true,
  },
});

function featuresProduct(sliderDiv, sliderNext, sliderPrev) {
  //New Arrival  Slider
  let swiperNewArrival = new Swiper(`${sliderDiv} .swiper`, {
    // Default parameters
    slidesPerView: 2,
    slidesPerGroup: 2,
    spaceBetween: 12,
    speed: 1050,
    keyboard: {
      enabled: true,
      onlyInViewport: true,
    },
    // Responsive breakpoints
    breakpoints: {
      // when window width is >= 320px
      576: {
        slidesPerView: 3,
        slidesPerGroup: 3,
        spaceBetween: 15,
      },

      767: {
        slidesPerView: 2,
        slidesPerGroup: 2,
        spaceBetween: 15,
      },
      992: {
        slidesPerView: 3,
        slidesPerGroup: 3,
        spaceBetween: 15,
      },
    },
    navigation: {
      nextEl: sliderNext,
      prevEl: sliderPrev,
    },
  });
}

featuresProduct(
  "#newArrivalSlider",
  ".new_arrival_next_arrow",
  ".new_arrival_prev_arrow"
);
featuresProduct(
  "#topRankingSlider",
  ".top_ranking_next_arrow",
  ".top_ranking_prev_arrow"
);
featuresProduct(
  "#protectiveSlider",
  ".protective_next_arrow",
  ".protective_prev_arrow"
);
featuresProduct(
  "#dropshippingSlider",
  ".dropshipping_next_arrow",
  ".dropshipping_prev_arrow"
);
featuresProduct(
  "#originalSlider",
  ".original_next_arrow",
  ".original_prev_arrow"
);
featuresProduct(
  "#trueViewSlider",
  ".true_view_next_arrow",
  ".true_view_prev_arrow"
);

// Proudct Slider
function productSlider(
  sliderDiv,
  sliderNext,
  sliderPrev,
  slidesPerViewDefault = 1,
  slidesPerGroupDefault = 1,
  spaceBetweenDefault = 10,
  breakPoints = {
    // when window width is >= 320px
    576: {
      slidesPerView: 2,
      slidesPerGroup: 2,
      spaceBetween: 20,
    },
    // when window width is >= 480px
    767: {
      slidesPerView: 3,
      slidesPerGroup: 3,
      spaceBetween: 20,
    },
    // when window width is >= 992px
    992: {
      slidesPerView: 4,
      slidesPerGroup: 4,
      spaceBetween: 24,
    },
  }
) {
  let swiperSlider = new Swiper(`${sliderDiv} .swiper`, {
    // Default parameters
    slidesPerView: slidesPerViewDefault,
    slidesPerGroup: slidesPerGroupDefault,
    spaceBetween: spaceBetweenDefault,
    speed: 1050,
    keyboard: {
      enabled: true,
      onlyInViewport: true,
    },
    // Responsive breakpoints
    breakpoints: breakPoints,
    navigation: {
      nextEl: sliderNext,
      prevEl: sliderPrev,
    },
  });
}
//Best Selling  Slider
productSlider(
  ".best_selling_slider_area",
  ".best_slider_next_arrow",
  ".best_slider_prev_arrow",
  1,
  1,
  10,
  {
    // when window width is >= 320px
    576: {
      slidesPerView: 2,
      slidesPerGroup: 2,
      spaceBetween: 20,
    },
    // when window width is >= 480px
    767: {
      slidesPerView: 3,
      slidesPerGroup: 3,
      spaceBetween: 20,
    },
    // when window width is >= 992px
    992: {
      slidesPerView: 4,
      slidesPerGroup: 4,
      spaceBetween: 20,
    },
    // when window width is >= 992px
    1200: {
      slidesPerView: 5,
      slidesPerGroup: 5,
      spaceBetween: 18,
    },
  }
);
// Product Details Slider
productSlider(
  ".popular_product_slider_area",
  ".popular_slider_next_arrow",
  ".popular_slider_prev_arrow"
);
//Deal of The Day Slider
productSlider(
  ".deals_day_product_slider_area",
  ".deals_of_day_slider_next_arrow",
  ".deals_of_day_slider_prev_arrow",
  1,
  1,
  10,
  {
    // when window width is >= 320px
    576: {
      slidesPerView: 2,
      slidesPerGroup: 2,
      spaceBetween: 20,
    },
    // when window width is >= 480px
    767: {
      slidesPerView: 3,
      slidesPerGroup: 3,
      spaceBetween: 20,
    },

    // when window width is >= 1200px
    1200: {
      slidesPerView: 4,
      slidesPerGroup: 4,
      spaceBetween: 24,
    },
  }
);
//Recommed Product Slider
productSlider(
  ".recommend_sellar_product_slider_area",
  ".recommed_sellar_slider_next_arrow",
  ".recommed_sellar_slider_prev_arrow"
);
//Popular Sellar Product Slider
productSlider(
  ".popular_sellar_product_slider_area",
  ".popular_sellar_slider_next_arrow",
  ".popular_sellar_slider_prev_arrow"
);

//Apparel Slider
productSlider(
  ".apparel",
  ".apparel-swiper-button-next",
  ".apparel-swiper-button-prev",
  1,
  1,
  10,
  {
    576: {
      slidesPerView: 2,
      slidesPerGroup: 2,
    },

    768: {
      slidesPerView: 1,
      slidesPerGroup: 1,
    },

    992: {
      slidesPerView: 2,
      slidesPerGroup: 2,
    },
    // when window width is >= 1200px
    1200: {
      slidesPerView: 4,
      slidesPerGroup: 4,
    },
  }
);
// Vehicles Slider
productSlider(
  ".vehicles",
  ".vehicles-swiper-button-next",
  ".vehicles-swiper-button-prev",
  1,
  1,
  10,
  {
    576: {
      slidesPerView: 2,
      slidesPerGroup: 2,
    },

    768: {
      slidesPerView: 1,
      slidesPerGroup: 1,
    },

    992: {
      slidesPerView: 2,
      slidesPerGroup: 2,
    },
    // when window width is >= 1200px
    1200: {
      slidesPerView: 3,
      slidesPerGroup: 3,
    },
  }
);
// Vehicles1 Slider
productSlider(
  ".vehicles1",
  ".vehicles1-swiper-button-next",
  ".vehicles1-swiper-button-prev",
  1,
  1,
  10,
  {
    576: {
      slidesPerView: 2,
      slidesPerGroup: 2,
    },

    768: {
      slidesPerView: 1,
      slidesPerGroup: 1,
    },

    992: {
      slidesPerView: 2,
      slidesPerGroup: 2,
    },
    // when window width is >= 1200px
    1200: {
      slidesPerView: 4,
      slidesPerGroup: 4,
    },
  }
);
// Vehicles2 Slider
productSlider(
  ".vehicles2",
  ".vehicles2-swiper-button-next",
  ".vehicles2-swiper-button-prev",
  1,
  1,
  10,
  {
    576: {
      slidesPerView: 2,
      slidesPerGroup: 2,
    },

    768: {
      slidesPerView: 1,
      slidesPerGroup: 1,
    },

    992: {
      slidesPerView: 2,
      slidesPerGroup: 2,
    },
    // when window width is >= 1200px
    1200: {
      slidesPerView: 4,
      slidesPerGroup: 4,
    },
  }
);

//Customer Electronics Slider
productSlider(
  ".customer-electronics",
  ".customer-electronics-swiper-button-next",
  ".customer-electronics-swiper-button-prev",
  1,
  1,
  10,
  {
    576: {
      slidesPerView: 2,
      slidesPerGroup: 2,
    },

    768: {
      slidesPerView: 1,
      slidesPerGroup: 1,
    },

    992: {
      slidesPerView: 2,
      slidesPerGroup: 2,
    },
    // when window width is >= 1200px
    1200: {
      slidesPerView: 4,
      slidesPerGroup: 4,
    },
  }
);

function paginationSlider(
  sliderDiv,
  paginationDiv,

  slidesPerViewDefault = 2,
  slidesPerGroupDefault = 2,
  spaceBetweenDefault = 10,
  breakPoints = {
    // when window width is >= 320px
    576: {
      slidesPerView: 2,
      slidesPerGroup: 2,
      spaceBetween: 20,
    },
    // when window width is >= 480px
    767: {
      slidesPerView: 3,
      slidesPerGroup: 3,
      spaceBetween: 20,
    },
    // when window width is >= 992px
    992: {
      slidesPerView: 4,
      slidesPerGroup: 4,
      spaceBetween: 24,
    },
  }
) {
  let swiperSlider = new Swiper(`${sliderDiv} .swiper`, {
    // Default parameters
    slidesPerView: slidesPerViewDefault,
    slidesPerGroup: slidesPerGroupDefault,
    spaceBetween: spaceBetweenDefault,
    speed: 1050,
    keyboard: {
      enabled: true,
      onlyInViewport: true,
    },
    // Responsive breakpoints
    breakpoints: breakPoints,
    pagination: {
      el: paginationDiv,
      clickable: true,
    },
  });
}

//Partners Slider
paginationSlider(".partner_slider_area", ".partner_pagination");
//Sellar Profile Slider
let swiperSellarProfile = new Swiper(".sellar_profile_photo_area .swiper", {
  // Default parameters
  slidesPerView: 1,
  slidesPerGroup: 1,
  spaceBetween: 10,
  speed: 1050,
  keyboard: {
    enabled: true,
    onlyInViewport: true,
  },
  // Responsive breakpoints
  breakpoints: {
    // when window width is >= 320px
    576: {
      slidesPerView: 2,
      slidesPerGroup: 2,
      spaceBetween: 20,
    },
    // when window width is >= 480px
    767: {
      slidesPerView: 3,
      slidesPerGroup: 3,
      spaceBetween: 15,
    },
    // when window width is >= 992px
    992: {
      slidesPerView: 3,
      slidesPerGroup: 3,
      spaceBetween: 20,
    },
  },
  navigation: {
    nextEl: ".sellar_prfile_next_icon",
    prevEl: ".sellar_prfile_prev_icon",
  },
});

//Report Slider
let swiperReport = new Swiper(".repot_slider_area .swiper", {
  // Default parameters
  slidesPerView: 1,
  slidesPerGroup: 1,
  spaceBetween: 10,
  speed: 1050,
  keyboard: {
    enabled: true,
    onlyInViewport: true,
  },
  // Responsive breakpoints
  breakpoints: {
    // when window width is >= 992px
    768: {
      slidesPerView: 2,
      slidesPerGroup: 2,
      spaceBetween: 30,
    },
  },
  navigation: {
    nextEl: ".report_slider_next",
    prevEl: ".report_slider_prev",
  },
});
//Report TAb Slider
let swiperReportTab = new Swiper(".report_tab_slider_area .swiper", {
  // Default parameters
  slidesPerView: 1,
  slidesPerGroup: 1,
  spaceBetween: 10,
  speed: 1050,
  keyboard: {
    enabled: true,
    onlyInViewport: true,
  },
  // Responsive breakpoints
  breakpoints: {
    576: {
      slidesPerView: 2,
      slidesPerGroup: 2,
      spaceBetween: 20,
    },
    992: {
      slidesPerView: 3,
      slidesPerGroup: 3,
      spaceBetween: 20,
    },
    // when window width is >= 1200px
    1200: {
      slidesPerView: 4,
      slidesPerGroup: 4,
      spaceBetween: 24,
    },
  },
  navigation: {
    nextEl: ".report_tab_slider_next",
    prevEl: ".report_tab_slider_prev",
  },
});

function swiperTabAutoSlider(
  sliderDiv,
  sliderNext = "",
  sliderPrev = "",
  slidesPerViewDefault = "auto",
  slidesPerGroupDefault = true,
  spaceBetweenDefault = 15,
  breakpoints = {
    992: {
      spaceBetween: 25,
    },
  }
) {
  let swiperMobileButtonTab = new Swiper(`${sliderDiv} .swiper`, {
    // Default parameters
    slidesPerView: slidesPerViewDefault,
    slidesPerGroupAuto: slidesPerGroupDefault,
    spaceBetween: spaceBetweenDefault,
    speed: 1050,
    // Responsive breakpoints
    breakpoints: breakpoints,
    navigation: {
      nextEl: sliderNext,
      prevEl: sliderPrev,
    },
    keyboard: {
      enabled: true,
      onlyInViewport: true,
    },
  });
}
//Mobile Button Tab Slider
swiperTabAutoSlider(".mobile_slider_button_area");

//Mobile  Tab Slider
swiperTabAutoSlider(
  ".mobile_slider_tab_area",
  ".header_tab_next_icon",
  ".header_tab_prev_icon"
);
//Big Deals Tab Button Slider
swiperTabAutoSlider(".big_deals_slider_btn");
//Big Deals Tab Slider
swiperTabAutoSlider(".big_deals_slider_area");
//Compare Product Slider
swiperTabAutoSlider(".compare_product_slider_area");
//Category Slider
swiperTabAutoSlider(".category_bottom_slider_area");
//Product Gallery Slider
let galleryThumbs = new Swiper(".product_gallery_slider_area .gallery-thumbs", {
  spaceBetween: 10,
  slidesPerView: 5,
  freeMode: true,
  watchSlidesProgress: true,
});

var galleryTop = new Swiper(".product_gallery_slider_area .gallery-top", {
  navigation: {
    nextEl: ".product_gallery_next_arrow",
    prevEl: ".product_gallery_prev_arrow",
  },
  thumbs: {
    swiper: galleryThumbs,
  },
});

//Blog Slider
let swiperBlog = new Swiper(".top_blog_slider_area .swiper", {
  // Default parameters
  slidesPerView: 1,
  slidesPerGroup: 1,
  spaceBetween: 10,
  speed: 1050,
  keyboard: {
    enabled: true,
    onlyInViewport: true,
  },
  // Responsive breakpoints
  breakpoints: {
    // when window width is >= 320px
    576: {
      slidesPerView: 2,
      slidesPerGroup: 2,
      spaceBetween: 20,
    },
    // when window width is >= 480px
    767: {
      slidesPerView: 3,
      slidesPerGroup: 3,
      spaceBetween: 20,
    },
    // when window width is >= 992px
    992: {
      slidesPerView: 3,
      slidesPerGroup: 3,
      spaceBetween: 37,
    },
  },
  navigation: {
    nextEl: ".top_blog_next_arrow",
    prevEl: ".top_blog_prev_arrow",
  },
});
//Category Tab
function openTab(evt, id) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tab_item");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(
      " tabActiveButton",
      ""
    );
  }
  document.getElementById(id).style.display = "block";
  evt.currentTarget.className += " tabActiveButton";
}
function openTab2(evt, id) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tab_item2");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks2");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(
      " tabActiveButton",
      ""
    );
  }
  document.getElementById(id).style.display = "block";
  evt.currentTarget.className += " tabActiveButton";
}
function openTab3(evt, id) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tab_item3");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks3");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(
      " tabActiveButton",
      ""
    );
  }
  document.getElementById(id).style.display = "block";
  evt.currentTarget.className += " tabActiveButton";
}

// Get the element with id="defaultOpen" and click on it
if (document.getElementById("defaultOpen")) {
  document.getElementById("defaultOpen").click();
}
if (document.getElementById("defaultOpen2")) {
  document.getElementById("defaultOpen2").click();
}
if (document.getElementById("defaultOpen3")) {
  document.getElementById("defaultOpen3").click();
}

//Porduct Gallery
let bookmarkHeart = document.getElementById("bookmarkHeart");
if (bookmarkHeart) {
  bookmarkHeart.addEventListener("click", () => {
    bookmarkHeart.classList.toggle("bookmarked");
  });
}
//Color Product
let colorProductList = document.querySelectorAll("#colorProductList li");
colorProductList.forEach((color) => {
  color.addEventListener("click", () => {
    colorProductList.forEach((removeClass) => {
      removeClass.classList.remove("color_product_selected");
    });
    color.classList.add("color_product_selected");
  });
});
//Size Product
let productSizeList = document.querySelectorAll("#productSizeList li");
productSizeList.forEach((color) => {
  color.addEventListener("click", () => {
    productSizeList.forEach((removeClass) => {
      removeClass.classList.remove("product_size_selected");
    });
    color.classList.add("product_size_selected");
  });
});

//Product Increment Decrement
let plusButton = document.querySelector("#plusButton");
let minusButton = document.querySelector("#minusButton");
let productValue = document.querySelector("#productValue");
let productIncDecreButton = document.querySelectorAll(".inc_dec_button");
//Active color
productIncDecreButton.forEach((addClass) => {
  forEachLoop(addClass, ".inc_dec_button", "inc_decr_active");
});
if (productValue) {
  productValue.value = 0;
}

if (plusButton) {
  plusButton.addEventListener("click", () => {
    productValue.value = parseInt(productValue.value) + 1;
  });
}
if (minusButton) {
  minusButton.addEventListener("click", () => {
    if (productValue.value > 0) {
      productValue.value = parseInt(productValue.value) - 1;
    }
  });
}

//Quotation  Increment Decrement
let qtyPlusButton = document.querySelector("#qtyPlusButton");
let qtyMinusButton = document.querySelector("#qtyMinusButton");
let qtyProductValue = document.querySelector("#qtyProductValue");

if (qtyProductValue) {
  qtyProductValue.value = 0;
}

if (qtyPlusButton) {
  qtyPlusButton.addEventListener("click", () => {
    qtyProductValue.value = parseInt(qtyProductValue.value) + 1;
  });
}
if (qtyMinusButton) {
  qtyMinusButton.addEventListener("click", () => {
    if (qtyProductValue.value > 0) {
      qtyProductValue.value = parseInt(qtyProductValue.value) - 1;
    }
  });
}

//Password Visibility
//01.Login
let inputPassword1 = document.querySelector("#password_input1");
if (inputPassword1) {
  inputPassword1.addEventListener("click", () => {
    passwordVisibility(
      "password_input1",
      "password_eye_icon_area1",
      "eyeOpen1",
      "eyeClose1"
    );
  });
}
let inputPassword2 = document.querySelector("#password_input2");
if (inputPassword2) {
  inputPassword2.addEventListener("click", () => {
    passwordVisibility(
      "password_input2",
      "password_eye_icon_area2",
      "eyeOpen2",
      "eyeClose2"
    );
  });
}
let inputPassword3 = document.querySelector("#password_input3");
if (inputPassword3) {
  inputPassword3.addEventListener("click", () => {
    passwordVisibility(
      "password_input3",
      "password_eye_icon_area3",
      "eyeOpen3",
      "eyeClose3"
    );
  });
}

function passwordVisibility(inputId, eyeIconArea, eyeOpen, eyeClose) {
  let passwordInput = document.getElementById(inputId);
  let passwordIconArea = document.getElementById(eyeIconArea);
  let eyeOpenIcon = document.getElementById(eyeOpen);
  let eyeCloseIcon = document.getElementById(eyeClose);
  passwordIconArea.style.cssText = "display:inline";
  eyeOpenIcon.addEventListener("click", () => {
    if (passwordInput.type === "password") {
      passwordInput.type = "text";
    }
    eyeOpenIcon.style.cssText = "display:none";
    eyeCloseIcon.style.cssText = "display:inline";
  });
  eyeCloseIcon.addEventListener("click", () => {
    if (passwordInput.type === "text") {
      passwordInput.type = "password";
    }
    eyeCloseIcon.style.cssText = "display:none";
    eyeOpenIcon.style.cssText = "display:inline";
  });
}

//Category Product
let mobileProductCategoryIcon = document.querySelector(
  "#mobileProductCategoryIcon"
);
let mobileCategoryCloseIcon = document.querySelector(
  "#mobileCategoryCloseIcon"
);
let categoryListArea = document.querySelector("#categoryListArea");
let categoryOverlay = document.querySelector("#categoryOverlay");
if (mobileProductCategoryIcon) {
  mobileProductCategoryIcon.addEventListener("click", () => {
    categoryListArea.classList.add("category_active");
    categoryOverlay.style.cssText = "   display: block;";
    scrollOutsideHidden();
  });
}
if (mobileCategoryCloseIcon) {
  mobileCategoryCloseIcon.addEventListener("click", () => {
    categoryListArea.classList.remove("category_active");
    categoryOverlay.style.cssText = "   display: none;";
    scrollOutsideScroll();
  });
}
if (categoryOverlay) {
  categoryOverlay.addEventListener("click", () => {
    categoryListArea.classList.remove("category_active");
    categoryOverlay.style.cssText = "   display: none;";
    scrollOutsideScroll();
  });
}

//Check Input
let checkboxes = document.querySelectorAll("#cartInputChecked");
let cartInputSelectAll = document.querySelector("#cartInputSelectAll");
if (cartInputSelectAll) {
  cartInputSelectAll.addEventListener("change", (e) => {
    checkAll(e.target);
  });
}

function checkAll(myCheckbox) {
  if (myCheckbox.checked == true) {
    checkboxes.forEach(function (checkbox) {
      checkbox.checked = true;
    });
  } else {
    checkboxes.forEach(function (checkbox) {
      checkbox.checked = false;
    });
  }
}

// cart Product Increment Decreament
let cartPlusButton = document.querySelectorAll("#cartPlusButton");
let cartMinusButton = document.querySelectorAll("#cartMinusButton");
let productCount = document.querySelectorAll("#cartProductValue");
let count;

//Show count number initial
for (let x of productCount) {
  x.value = 1;
}

//Increament Button
for (let x of cartPlusButton) {
  x.addEventListener("click", (e) => {
    let buttonPlus = e.target;
    let countValue = buttonPlus.parentElement.children[1].children[0];
    let updateValue = parseInt(countValue.value) + 1;
    countValue.value = updateValue;
  });
}
//Decreament Button
for (let x of cartMinusButton) {
  x.addEventListener("click", (e) => {
    let buttonPlus = e.target;
    let countValue = buttonPlus.parentElement.children[1];
    let updateValue = parseInt(countValue.value) - 1;
    if (updateValue > 0) {
      countValue.value = updateValue;
    }
  });
}

//Profile Sidebar
let profileSidebarArea = document.querySelector("#profileSidebarArea");
let profileSidebarIcon = document.querySelector("#profileSidebarIcon");
let sidebarOverlay = document.querySelector("#sidebarOverlay");
if (profileSidebarIcon) {
  profileSidebarIcon.addEventListener("click", () => {
    profileSidebarArea.classList.add("profile_sidebar_active");
    sidebarOverlay.style.cssText = "display:block";
    scrollOutsideHidden();
  });
}
if (sidebarOverlay) {
  sidebarOverlay.addEventListener("click", () => {
    profileSidebarArea.classList.remove("profile_sidebar_active");
    sidebarOverlay.style.cssText = "display:none";
    scrollOutsideScroll();
  });
}
//Profile Update
let editProfileButton = document.querySelector("#changeProfileButton");
let saveChangeButton = document.querySelector("#saveChangeButton");
let discardButton = document.querySelector("#discardChangeButton");
let profileFormArea = document.querySelectorAll("#profileAccountArea input ");

function updteProfile() {
  for (let x of profileFormArea) {
    x.disabled = false;
  }
}
function updteProfileDisabled() {
  for (let x of profileFormArea) {
    x.disabled = true;
  }
}

if (editProfileButton) {
  editProfileButton.addEventListener("click", () => {
    updteProfile();
    editProfileButton.style.cssText = "display:none;";
    saveChangeButton.style.cssText = "display:block;";
    discardButton.style.cssText = "display:block;";
  });
}
if (discardButton) {
  discardButton.addEventListener("click", () => {
    updteProfileDisabled();
    editProfileButton.style.cssText = "display:block;";
    saveChangeButton.style.cssText = "display:none;";
    discardButton.style.cssText = "display:none;";
  });
}

//Order Dropdown
let orderMoreButton = document.querySelectorAll("#orderMoreButton");
for (let x of orderMoreButton) {
  x.addEventListener("click", (e) => {
    let orderDiv = e.target.parentElement.parentElement;
    orderDiv.classList.add("order_dropdwon_active");
    let overlayDropdown = e.target.parentElement.parentElement.children[2];
    scrollOutsideHidden();

    if (overlayDropdown) {
      overlayDropdown.addEventListener("click", () => {
        orderDiv.classList.remove("order_dropdwon_active");
        scrollOutsideScroll();
      });
    }
  });
}

//Delete Alert
let deleteFoodList = document.querySelectorAll("#deleteAddress");
for (let x of deleteFoodList) {
  x.addEventListener("click", () => {
    Swal.fire({
      title: "Are you sure?",
      text: "You won't be able to revert this!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!",
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.fire("Deleted!", "Your file has been deleted.", "success");
      }
    });
  });
}

//Follow Button
let followButton = document.querySelector("#followButton");
if (followButton) {
  followButton.addEventListener("click", () => {
    followButton.classList.toggle("follow_active");
  });
}

//Cart Heart Icon
let cartHeartIcon = document.querySelector("#cartHeartIcon");
if (cartHeartIcon) {
  cartHeartIcon.addEventListener("click", () => {
    cartHeartIcon.classList.toggle("cart_active");
  });
}

//Video Auto Play
var modalVideo1 = document.getElementById("videoItem1");
var videoClose1 = document.getElementById("modalClose1");
var videoItemButton1 = document.getElementById("modalClickButton1");

if (videoClose1) {
  videoClose1.addEventListener("click", () => {
    if (modalVideo1.play()) {
      modalVideo1.pause();
    }
  });
}
if (videoItemButton1) {
  videoItemButton1.addEventListener("click", () => {
    if (modalVideo1.pause()) {
      modalVideo1.play();
    } else {
      modalVideo1.play();
    }
  });
}

//Counter
let visibilityIds = [
  "#counters_1",
  "#counters_2",
  "#counters_3",
  "#counters_4",
  "#counters_5",
];
// default counter class
let counterClass = ".counter";
// default animation speed
let defaultSpeed = 3000;

//Nice Select
document.addEventListener("DOMContentLoaded", function (event) {
  document
    .querySelectorAll("#selectCountry")
    .forEach((element) => new NiceCountryInput(element).init());
});

//Order Step List
let orderStepList = document.querySelectorAll("#orderStepList .active_step");
let stepContentCard = document.querySelectorAll("#stepContentCard");
// let processStep = document.querySelector("#processStep");
let orderStepLength = orderStepList.length - 1;
let stepContentCardLength = stepContentCard.length - 1;
if (orderStepLength == 0) {
  stepContentCard[0].style.cssText = "display:block";
} else if (orderStepLength == 1) {
  stepContentCard[1].style.cssText = "display:block";
} else if (orderStepLength == 2) {
  stepContentCard[2].style.cssText = "display:block";
} else if (orderStepLength == 3) {
  stepContentCard[3].style.cssText = "display:block";
}

//Deals Cart
let dealsCartButton = document.querySelectorAll("#dealsCartButton");
for (let x of dealsCartButton) {
  x.addEventListener("click", () => {
    x.classList.toggle("dealsBookarkActive");
  });
}

//Ratting Select
if (document.querySelector("#rattingSelect")) {
  let rattingSelect = new Selectr("#rattingSelect", {
    placeholder: "select size",
  });
}
if (document.querySelector("#categorySelect")) {
  let categorySelect = new Selectr("#categorySelect", {
    placeholder: "select Category",
  });
}
if (document.querySelector("#brandSelect")) {
  let brandSelect = new Selectr("#brandSelect", {
    placeholder: "select Brand",
  });
}

//Payment Option
let paymentMethodArea = document.querySelectorAll(
  "#paymentMethodArea .checkbox_payment_form_area"
);
paymentMethodArea.forEach((item) => {
  item.addEventListener("click", () => {
    paymentMethodArea.forEach((removeClass) => {
      removeClass.classList.remove("payment_option_active");
    });
    item.classList.add("payment_option_active");
  });
});

//Outside Click Detect
function outSideDetect(
  clickId,
  dropdownId,
  dropdownRemoveId,
  dropdownRemoveClass
) {
  document.addEventListener("click", function (event) {
    let clickDiv = document.querySelector(`#${clickId}`);
    let dropdownDiv = document.querySelector(`#${dropdownId}`);
    let dropdownRemoveDiv = document.querySelector(`#${dropdownRemoveId}`);
    let isClickInside = clickDiv.contains(event.target);
    let isClickOutside = dropdownDiv.contains(event.target);
    if (!isClickInside && !isClickOutside) {
      dropdownRemoveDiv.classList.remove(dropdownRemoveClass);
    }
  });
}

//Creadit Card Form
function creditNumber(selector, blokPattern = [4, 4, 4, 4]) {
  var cleave = new Cleave(selector, {
    blocks: blokPattern,
  });
}
if (document.querySelector("#visaInput")) {
  creditNumber("#visaInput");
}
if (document.querySelector("#visaInput")) {
  creditNumber("#masterInput");
}

function creaditDate(selector, blokPattern = ["m", "Y"]) {
  var cleaveDate = new Cleave(selector, {
    date: true,
    datePattern: blokPattern,
  });
}
if (document.querySelector("#visaDate")) {
  creaditDate("#visaDate");
}

if (document.querySelector("#masterDate")) {
  creaditDate("#masterDate");
}

if (document.querySelector("#bankDate")) {
  creaditDate("#bankDate");
}

// Compare Product
let compareCheckbox = document.querySelector("#compareCheckbox");

function highlightShow(
  methodADDRemove,
  selectorDiv = "#compareTable tr",
  attributeName = "highlightRow",
  activeClass = "highlightActive"
) {
  let hightlightRow = document.querySelectorAll(selectorDiv);

  for (const x of hightlightRow) {
    if (x.hasAttribute(attributeName)) {
      methodADDRemove
        ? x.classList.add(activeClass)
        : x.classList.remove(activeClass);
    }
  }
}
if (compareCheckbox) {
  compareCheckbox.addEventListener("click", () => {
    if (compareCheckbox.checked) {
      highlightShow(true);
    } else {
      highlightShow(false);
    }
  });
}

//Skeleton Animation
let skeletonSingleText = document.querySelectorAll(".skeleton_single_text");

function removeSkeletonClass(selector) {
  let skeletonSingleDiv = document.querySelectorAll(selector);
  window.addEventListener("load", () => {
    skeletonSingleDiv.forEach((item) => {
      item.classList.remove("skeleton_single_text");
    });
  });
}
if (skeletonSingleText) {
  removeSkeletonClass(".skeleton_single_text");
}

// ScrollToUp
let scroll = document.querySelector("#scrollTop");
function scrollUp() {
  window.scrollTo({
    top: 0,
    behavior: "smooth",
  });
}
if (scroll) {
  window.addEventListener("scroll", function () {
    scroll.classList.toggle("scroll_active", window.scrollY > 500);
  });
  scroll.addEventListener("click", () => {
    scrollUp();
  });
}
