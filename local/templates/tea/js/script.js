function testWebP(callback) {

    var webP = new Image();
    webP.onload = webP.onerror = function () {
    callback(webP.height == 2);
    };
    webP.src = "data:image/webp;base64,UklGRjoAAABXRUJQVlA4IC4AAACyAgCdASoCAAIALmk0mk0iIiIiIgBoSygABc6WWgAA/veff/0PP8bA//LwYAAA";
    }
    
    testWebP(function (support) {
    
    if (support == true) {
    document.querySelector('body').classList.add('webp');
    }else{
    document.querySelector('body').classList.add('no-webp');
    }
});

jQuery(document).ready(function(){
    $(".main-slider-js").slick({
        appendArrows: $('#slider-controls-js'),
        dots: false,
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        prevArrow: '<button type="button" data-role="none" class="slick-prev" aria-label="Previous" tabindex="0" role="button"><span class="icon-arrow-slider"></span></button>',
        nextArrow: '<button type="button" data-role="none" class="slick-next" aria-label="Next" tabindex="0" role="button"><span class="icon-arrow-slider"></span></button>',
        speed: 800,
        autoplay: true,
        autoplaySpeed: 5000,
        responsive: [
            {
              breakpoint: 992,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                adaptiveHeight: true,
                arrows: false,
                dots: true,
              }
            },
            {
                breakpoint: 767,
                settings: {
                  slidesToShow: 1,
                  slidesToScroll: 1,
                  adaptiveHeight: true,
                  arrows: false,
                  dots: true,
                  autoplay: false,
                }
              }
          ]
    });

    $(".gallery-js").slick({
        dots: true,
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        prevArrow: '<button type="button" data-role="none" class="slick-prev" aria-label="Previous" tabindex="0" role="button"><span class="icon-arrow-slider"></span></button>',
        nextArrow: '<button type="button" data-role="none" class="slick-next" aria-label="Next" tabindex="0" role="button"><span class="icon-arrow-slider"></span></button>',
        speed: 800,
        responsive: [
            {
              breakpoint: 767,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: false,
                dots: true,
              }
            }
        ]
    });

    $('.select-b__heading').on('click', function() {
        if($(this).hasClass('active')){
            $('.select-b').removeClass('open');
            $('.select-b__heading').removeClass('active');
            $(this).removeClass('active');
        }
        else{
            $('.select-b').removeClass('open');
            $('.select-b__heading').removeClass('active');
            $(this).parent().toggleClass('open');
            $(this).addClass('active');
        }
    })
    $('.select-b__item').on('click', function() {
        $('.select-b__item').removeClass('current');
        var value = $(this).text();
        $(this).addClass('current');
        $(this).parent().parent().parent().find('.select-b__name').text(value);
        $(this).parent().parent().parent().removeClass('open');
        $('.select-b__heading').removeClass('active');
    })

    $('.more-link-js').on('click', function() {
        if ($(this).hasClass('active')) {
            $('.more-text').slideDown(300);
            $(this).removeClass('active');
            $(this).text('Свернуть текст');
        }
        else{
            $('.more-text').slideUp(300);
            $(this).addClass('active');
            $(this).text('Показать весь текст');
        }
    })

    $('.tabs-card').on('click', 'li:not(.current)', function() {
        $(this).addClass('current').siblings().removeClass('current')
            .parents('.card-page__tabs').find('.tabs-box').eq($(this).index()).fadeIn(150).siblings('.tabs-box').hide();
        })

    $(document).on("click",".counter__minus",function (){    
        if ($(this).siblings(".counter__input").val() == 1) return;
        
        var id = $(this).attr("id");
        var val = parseInt($(this).siblings(".counter__input").val()) - 1;
        
        $(this).siblings(".counter__input").val(val);
        $(this).siblings(".counter__input").change();
    });
    
    $(document).on("click",".counter__plus",function (){
        var id = $(this).attr("id");
        var val = parseInt($(this).siblings(".counter__input").val()) + 1;
        $(this).siblings(".counter__input").val(val);
        $(this).siblings(".counter__input").change();
    });

    $('.menu-open-js').on('click', function() {
        $(this).toggleClass('active');
        $('#nav-top').toggleClass('open');
        $('.nav-shadow').toggleClass('open');
        $('html').toggleClass('mobile');
    })

});

window.addEventListener("DOMContentLoaded", function() {
    [].forEach.call( document.querySelectorAll('.phone'), function(input) {
    var keyCode;
    function mask(event) {
        event.keyCode && (keyCode = event.keyCode);
        var pos = this.selectionStart;
        if (pos < 3) event.preventDefault();
        var matrix = "+7 (___) ___-__-__",
            i = 0,
            def = matrix.replace(/\D/g, ""),
            val = this.value.replace(/\D/g, ""),
            new_value = matrix.replace(/[_\d]/g, function(a) {
                return i < val.length ? val.charAt(i++) || def.charAt(i) : a
            });
        i = new_value.indexOf("_");
        if (i != -1) {
            i < 5 && (i = 4);
            new_value = new_value.slice(0, i)
        }
        var reg = matrix.substr(0, this.value.length).replace(/_+/g,
            function(a) {
                return "\\d{1," + a.length + "}"
            }).replace(/[+()]/g, "\\$&");
        reg = new RegExp("^" + reg + "$");
        if (!reg.test(this.value) || this.value.length < 5 || keyCode > 47 && keyCode < 58) this.value = new_value;
        if (event.type == "blur" && this.value.length < 5)  this.value = ""
    }

    input.addEventListener("input", mask, false);
    input.addEventListener("focus", mask, false);
    input.addEventListener("blur", mask, false);
    input.addEventListener("keydown", mask, false)

  });

});

	var swiper = new Swiper(".productsSwiper", {
        direction: "vertical",
        slidesPerView: "auto",
        freeMode: true,
        scrollbar: {
          el: ".swiper-scrollbar",
        },
        mousewheel: true,
      });

