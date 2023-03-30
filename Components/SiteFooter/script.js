function setFixedFooterOpacity () {
  // get fixed footer section scroll top

  jQuery(window).on('scroll', function () {
    if (jQuery(window).width() > 1000) {
      // run footer animation if window width is greater than 1000px
      var scrollTop = jQuery(window).scrollTop()
      var windowHeight = jQuery(window).height()
      var contentWrapperEndDetectTop = jQuery('#content-wrapper-end-detect').position().top
      var diff = scrollTop + windowHeight - contentWrapperEndDetectTop

      if (diff > 0) {
        var footerSectionHeight = jQuery('#footer-section').outerHeight()
        var opacity = diff / footerSectionHeight

        if (opacity > 0.75) {
          opacity = 1
        }

        jQuery('#footer-section').css('opacity', opacity)
      } else {
        jQuery('#footer-section').css('opacity', 0)
      }
    }
  })
}

function calcFooterHeightForAnimation () {
  if (jQuery(window).width() > 1000) {
    // calc footer height for footer animation, if browser width is greater than 1000px
    var footerSectionHeight = jQuery('#footer-section').outerHeight()

    // add same margin bottom like footer height
    jQuery('#content-wrapper').css('margin-bottom', footerSectionHeight + 'px')

    setFixedFooterOpacity()
  } else {
    // remove margin bottom
    jQuery('#content-wrapper').removeAttr('style')
  }
}

jQuery(window).on('load', function () {
  if (jQuery('#footer-section').hasClass('footer-fixed')) {
    calcFooterHeightForAnimation()

    jQuery(window).on('resize', function () {
      calcFooterHeightForAnimation()
    })
  }
})
