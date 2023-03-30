jQuery(document).ready(function () {
  /**
     * when mouse is hover on 3 images, change the main houver image move the front(to add bigger zindex)
     */
  jQuery('.c-big-three-images-link__item').mouseenter(function () {
    var maxZIndex = 0

    jQuery('.c-big-three-images-link__item').each(function (index, elem) {
      var elemZIndex = parseInt(jQuery(elem).css('zIndex'))
      maxZIndex = maxZIndex > elemZIndex ? maxZIndex : elemZIndex
    })

    // always add second larger z index to image-3
    jQuery('.c-big-three-images-link__item-3').css('zIndex', maxZIndex + 1)
    jQuery(this).css('zIndex', maxZIndex + 2)
  })
})
