jQuery(document).ready(function () {
  jQuery('.c-block-video-text__image').click(function () {
    var videoIFrameElem = jQuery('.jsBlockVideoTextHidden').html()
    jQuery('.jsBlockVideoTextPopupVideoWrapper').html(videoIFrameElem)

    jQuery('.c-block-video-text-popup').removeClass('hide')

    var videoURL = jQuery('.jsBlockVideoTextPopupVideoWrapper iframe').attr('data-src')
    jQuery('.jsBlockVideoTextPopupVideoWrapper iframe').attr('src', videoURL)
    jQuery('.jsBlockVideoTextPopupVideoWrapper iframe').one('load', function () {
      console.log('loaded')
    })
  })

  jQuery('.c-block-video-text-popup, .c-block-video-text-popup__close-btn').click(function () {
    jQuery('.c-block-video-text-popup').addClass('hide')
    jQuery('.jsBlockVideoTextPopupVideoWrapper').html('')
  })
})
