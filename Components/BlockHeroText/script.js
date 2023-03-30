jQuery(document).ready(function () {
  jQuery('.block-hero-text-link a').click(function () {
    var targetID = jQuery(this).attr('href')

    jQuery('html, body').animate({
      scrollTop: jQuery(targetID).position().top
    }, 500)

    return false
  })

  if (jQuery('.block-hero-text-link').length > 0) {
    // calculate the init postion of navigation

    jQuery(window).scroll(function () {
      var titleTop = jQuery('.block-hero-text-title').offset().top + jQuery('.block-hero-text-title').outerHeight() - 90
      if (jQuery(window).scrollTop() > titleTop) {
        jQuery('.block-hero-text-link').addClass('fixed')
      } else {
        jQuery('.block-hero-text-link').removeClass('fixed')
      }
    })
  }
})
