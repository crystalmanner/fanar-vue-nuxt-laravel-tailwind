/* global jQuery */

window.main = (function() {
  var handleHeadMenu = function() {
    var top_scoll = 50;

    function stickyMenu() {
      $(document).scrollTop() > top_scoll,
        $(window).on("scroll", function() {
          var e = $(document).scrollTop();
          e > top_scoll
            ? ($("body").hasClass("sticky") || $("body").addClass("sticky"),
              e > top_scoll)
            : $("body").removeClass("sticky");
        });
    }

    function initStickyMenu() {
      stickyMenuSelector(),
        $(window).on("resize", function() {
          stickyMenuSelector();
        });
    }

    function stickyMenuSelector() {
      stickyMenu();
    }

    initStickyMenu();
    if ($(document).scrollTop() > top_scoll) {
      $("body").addClass("sticky");
    }
  };

  var handleMenuResponsive = function() {
    function close_menu() {
      $(".menu-grid").removeClass("active");
      $(".hamburger-menu")
        .removeClass("active")
        .addClass("unactive");
      $("body").removeClass("body-overflow");
    }
    jQuery(document).on("click", ".hamburger-menu.unactive", function() {
      $(".menu-grid").addClass("active");
      $(".hamburger-menu")
        .removeClass("unactive")
        .addClass("active");
      $("body").addClass("body-overflow");
      return false;
    });
    jQuery(document).on("click", ".hamburger-menu.active", function() {
      close_menu();
      return false;
    });
  };
  var handleModal = function() {
    if ($(".js-modal-btn").length) {
      $(".js-modal-btn").modalVideo();
    }
  };
  var dropDown = function() {
    jQuery(document).on("click", ".top-bar .drop-menu", function(e) {
      e.preventDefault();
      $(".submenu").toggleClass("active");
    });
    jQuery(document).on("click", "header, .main-wrapper", function() {
      if (!$(this).hasClass("drop-menu")) {
        $(".submenu").removeClass("active");
      }
    });
    jQuery(document).on("click", ".submenu li a", function(e) {
      e.preventDefault();
      var text = $(this).text();
      $(this)
        .parents()
        .find(".coin")
        .text(text);
    });
  };
  var searchTitleButton = function() {
    $(".search-title a").on("click", function(e) {
      e.preventDefault();
      $(this)
        .addClass("active")
        .siblings()
        .removeClass("active");
    });
  };
  var handleUploadButton = function() {
    $("#file").on("change", function(e) {
      var files = $(this)[0].files;
      if (files.length >= 2) {
        $(".file_label").text(files.length + " Files Ready To Upload");
      } else {
        var fileName = e.target.value.split("\\").pop();
        $(".file_label").text(fileName);
      }
    });
  };
  var handleRealestateSlick = function() {
    var imagesLength =
      $(".slider-nav .small-img").length >= 4
        ? 4
        : $(".slider-nav .small-img").length;
    //alert(imagesLength);
    $(".slider-for").slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      arrows: true,
      fade: true,
      asNavFor: ".slider-nav",
      rtl: $("html").attr("dir") === "ltr" ? false : true,
      prevArrow:
        '<a class="slick-prev"><i class="fas fa-chevron-right"></i></a>',
      nextArrow:
        '<a class="slick-next"><i class="fas fa-chevron-left"></i></a >'
    });
    $(".slider-nav").slick({
      slidesToShow: imagesLength,
      slidesToScroll: 1,
      asNavFor: ".slider-for",
      dots: false,
      arrows: false,
      centerMode: true,
      focusOnSelect: true,
      initialSlide: $(".slider-nav .small-img").length >= 4 ? 2 : 0,
      //infinite: true,
      rtl: $("html").attr("dir") === "ltr" ? false : true,
      responsive: [
        {
          breakpoint: 576,
          settings: {
            slidesToShow: 2
          }
        }
      ]
    });
  };
  var handleVenobox = function() {
    if ($(".venobox").length) {
      $(".venobox").venobox();
      $(document).on("click", ".venobox", function() {
        $(".venobox").venobox();
        return false;
      });
    }
  };
  var handleFotorama = function() {
    $(".fotorama").fotorama({
      maxheight: 500
    });
  };
  var labelClicked = function() {
    $(document).on("click", ".custom-filter", function(e) {
      e.preventDefault();
    });
  };

  return {
    init: function() {
      handleHeadMenu();
      handleMenuResponsive();
      handleModal();
      searchTitleButton();
      dropDown();
      handleUploadButton();
      handleRealestateSlick();
      handleVenobox();
      handleFotorama();
      labelClicked();
    }
  };
})();

jQuery(document).ready(function() {
  main.init();
});
