'use strict';

new WOW().init();

function countNumber(item) {
  var text = item.innerHTML;
  var itemArr = text.split('');
  var max = 40;
  var k = 0;
  var intervalNumber = setInterval(function () {
    var textNew = '';
    for (var i = 0; i < itemArr.length; i++) {
      var currentSymbol = '';
      var letter = itemArr[i];
      if (letter.match(/\d/)) {
        currentSymbol = parseInt(Math.random() * 10);
      } else {
        currentSymbol = letter;
      }
      textNew += currentSymbol;
    }
    item.innerHTML = textNew;
    k++;
    if (k === max) {
      item.innerHTML = text;
      clearInterval(intervalNumber);
    }
  }, 50);
}

document.addEventListener("DOMContentLoaded", function () {
  var numbers = [].slice.call(document.querySelectorAll('.js-number'));

  if ("IntersectionObserver" in window) {
    var numberObserver = new IntersectionObserver(function (entries, observer) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          var item = entry.target;
          countNumber(item);
        }
      });
    });

    numbers.forEach(function (number) {
      numberObserver.observe(number);
    });
  }

  var wows = [].slice.call(document.querySelectorAll('.wow'));

  if ("IntersectionObserver" in window) {
    var wowObserver = new IntersectionObserver(function (entries, observer) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          var item = entry.target;
          new WOW().init();
          item.classList.remove('undefined');
        }
      });
    });

    wows.forEach(function (wow) {
      wowObserver.observe(wow);
    });
  }
});

if ($('.reviews__slider').length > 0) {
  $('.reviews__slider').slick({
    slidesToShow: 3,
    prevArrow: '<button class="reviews__btn reviews__prev"><img src="/images/icons/arrow-left.png" alt=""></button>',
    nextArrow: '<button class="reviews__btn reviews__next"><img src="/images/icons/arrow-right.png" alt=""></button>',
    responsive: [{
      breakpoint: 992,
      settings: {
        slidesToShow: 2
      }
    }, {
      breakpoint: 768,
      settings: {
        slidesToShow: 1
      }
    }]
  });
}



$(document).ready(function () {
    $(".header__nav-item").on('click',function (e) {
        e.preventDefault();

        var elementClick = $(this).attr("href");
        var destination = $(elementClick).offset().top;

            $('body,html').animate({ scrollTop: destination }, 1100); //1100 - скорость


    });
});
//# sourceMappingURL=script.js.map
