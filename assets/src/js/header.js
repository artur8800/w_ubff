module.exports = function () {

  let $button = $('.burger__menu');
  let $mainNavigation = $('.header__navigation');
  let activeClass = 'menu-active';


  $button.on('click', function (event) {
    $(this)
      .toggleClass(activeClass);
    $('body')
      .toggleClass("overflow-hidden");

    $mainNavigation.animate({
      height: 'toggle'
    });
  });


  $(window).on('resize', function (event) {
    if (!$button.hasClass(activeClass) && $mainNavigation.attr('style')) {
      $mainNavigation.removeAttr('style')
    }
  });

};