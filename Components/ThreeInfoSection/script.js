jQuery(document).ready(function () {
  /**
     * when mouse is hover on 2 images, change the main houver image move the front(to add bigger zindex)
     */
  jQuery('.jsThreeInfoLeftImage').mouseenter(function () {
    var maxZIndex = 0

    jQuery('.jsThreeInfoLeftImage').each(function (index, elem) {
      var elemZIndex = parseInt(jQuery(elem).css('zIndex'))
      maxZIndex = maxZIndex > elemZIndex ? maxZIndex : elemZIndex
    })

    jQuery(this).css('zIndex', maxZIndex + 1)
  })
})
