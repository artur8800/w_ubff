module.exports = function () {

  let $button = $('.burger__menu');
  let $mainNavigation = $('.header__navigation');
  let activeClass = 'menu-active';


  $button.on('click', function (event) {
    $(this)
      .toggleClass(activeClass);

    $mainNavigation.animate({
      height: ['toggle', 'swing']
    }, 225, "easein");

    // $('body')
    //   .toggleClass("overflow-hidden");
  });


  $(window).on('resize', function (event) {
    if (!$button.hasClass(activeClass) && $mainNavigation.attr('style')) {
      $mainNavigation.removeAttr('style')
    }
  });

};