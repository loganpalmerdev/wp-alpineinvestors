import { disableBodyScroll, enableBodyScroll } from 'body-scroll-lock'

/**
 * when scroll down => header hidden
 * when scroll up => header visible
 */
function checkHeaderVisible () {
  var scrollTop = jQuery(window).scrollTop()

  if (scrollTop > 0 && scrollTop > window.lastScrollTop) {
    if (!jQuery('header').hasClass('header-hidden')) {
      jQuery('header').addClass('header-hidden')
    }
  } else {
    if (jQuery('header').hasClass('header-hidden')) {
      jQuery('header').removeClass('header-hidden')
    }
  }

  window.lastScrollTop = scrollTop
}

jQuery(document).ready(function () {
  /**
   * when humburger button is clicked
   */
  jQuery('.header-menu-btn').click(function () {
    if (jQuery('header').hasClass('header-normal')) {
      // if header is setted by opened
      if (jQuery(this).hasClass('open')) {
        enableBodyScroll(document.querySelector('.header-menu-section .wide-container'))
        jQuery('.header-menu-section').removeAttr('style')

        jQuery(this).removeClass('open')
        jQuery('header').removeClass('open')
        jQuery('.header-right-nav').removeClass('show')
        jQuery('.header-bottom').removeClass('show')

        // remove height style
        jQuery('.header-menu-section').removeClass('header-menu-section-visible')
      } else {
        disableBodyScroll(document.querySelector('.header-menu-section .wide-container'))
        jQuery(this).addClass('open')
        jQuery('header').addClass('open')
        jQuery('.header-right-nav').addClass('show')
        jQuery('.header-bottom').addClass('show')
        jQuery('.header-menu-section').addClass('header-menu-section-visible')

        // Measure height of window
        jQuery('.header-menu-section').innerHeight(window.innerHeight)
      }
    } else {
      if (jQuery(this).hasClass('open')) {
        if (jQuery(window).width() < 1000) {
          // for mobile
          enableBodyScroll(document.querySelector('.header-menu-section .wide-container'))
          // remove height style
          jQuery('.header-menu-section').removeAttr('style')
        }

        jQuery(this).removeClass('open')
        jQuery('header').removeClass('header-sticky')
        jQuery('.header-menu-section').removeClass('header-menu-section-visible')
      } else {
        if (jQuery(window).width() < 1000) {
          // for mobile
          disableBodyScroll(document.querySelector('.header-menu-section .wide-container'))
          // Measure height of window
          jQuery('.header-menu-section').innerHeight(window.innerHeight)
        }

        jQuery(this).addClass('open')
        jQuery('header').addClass('header-sticky')
        jQuery('.header-menu-section').addClass('header-menu-section-visible')
      }
    }
  })

  // if header is not setted by open status, make the header visible/hidden animation by scroll
  if (!jQuery('header').hasClass('header-normal')) {
    jQuery(window).on('scroll', function () {
      checkHeaderVisible()
    })
  }
})
