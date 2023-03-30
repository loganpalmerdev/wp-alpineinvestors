import { disableBodyScroll, enableBodyScroll } from 'body-scroll-lock'

/**
 * when the single update card is clicked on update list, the single update detail popup will display
 * @param postId : selected single update id
 * @param nextURL : selected single update permalink
 */
function addPopupOpenEventForUpdateClick (postId, nextURL) {
  jQuery('.jsUpdatesSearchLoadSpinner').removeClass('hide')

  const nonce = jQuery('.jsUpdatesSearchPopup').attr('data-nonce')

  const nextState = { postId: postId }

  jQuery.ajax({
    type: 'post',
    dataType: 'json',
    url: window.FlyntData.ajaxurl,
    data: {
      action: 'get_single_update',
      nonce: nonce,
      postId: postId
    },
    success: function (response) {
      jQuery('.jsSingleUpdatePopupContentInner').html(response.single_update_html)

      jQuery('.jsUpdatesSearchLoadSpinner').addClass('hide')

      jQuery('header').removeClass('header-hidden')
      jQuery('.header-menu-btn').addClass('hidden')
      jQuery('.jsUpdatesSearchSinglePopupCloseBtn').addClass('open')
      disableBodyScroll(document.querySelector('.jsUpdatesSearchSinglePopupContent'))

      jQuery('.jsUpdatesSearchPopup').addClass('c-search__single__popup-visible')

      // This will create a new entry in the browser's history, without reloading
      window.history.pushState(nextState, null, nextURL)

      // This will replace the current entry in the browser's history, without reloading
      // window.history.replaceState(nextState, null, nextURL);
    }
  })

  return false
}

function closeUpdateStoryPopup () {
  enableBodyScroll(document.querySelector('.jsUpdatesSearchSinglePopupContent'))

  jQuery('.jsUpdatesSearchPopup').removeClass('c-search__single__popup-visible')
  jQuery('.header-menu-btn').removeClass('hidden')
  jQuery('.jsUpdatesSearchSinglePopupCloseBtn').removeClass('open')
  jQuery('header').addClass('header-hidden')

  jQuery('.jsUpdatesSearchSinglePopupContent').scrollTop(0)

  const nextURL = jQuery('.jsUpdatesSearchSinglePopupCloseBtn').attr('data-current-page-url')
  const nextState = { additionalInformation: 'Updated the URL with JS' }

  // This will create a new entry in the browser's history, without reloading
  window.history.pushState(nextState, null, nextURL)

  // This will replace the current entry in the browser's history, without reloading
  // window.history.replaceState(nextState, null, nextURL);
}

jQuery(document).ready(function () {
  jQuery('.c-update__dropdown-value-txt').click(function () {
    var listElem = jQuery('.c-update__dropdown-list', jQuery(this).parent())

    if (jQuery(listElem).hasClass('hide')) {
      jQuery(listElem).removeClass('hide')
      jQuery(this).addClass('open')
    } else {
      jQuery(listElem).addClass('hide')
      jQuery(this).removeClass('open')
    }
  })

  jQuery('.jsUpdatesSearchSinglePopupCloseBtn').click(function () {
    closeUpdateStoryPopup()
  })

  // when out side of single update popup content is clicked, close popup
  jQuery('.jsUpdatesSearchPopup').click(function () {
    closeUpdateStoryPopup()
  })

  // click event of popup inner click is stop for outside click popup
  jQuery('.jsUpdatesSearchSinglePopupWrapper').click(function (event) {
    event.stopPropagation()
  })

  // if this is a single update page
  if (jQuery('.jsUpdatesSearchPopup').attr('data-is-single-update') === 'yes') {
    jQuery('header').removeClass('header-hidden')
    jQuery('.header-menu-btn').addClass('hidden')
    jQuery('.jsUpdatesSearchSinglePopupCloseBtn').addClass('open')
    disableBodyScroll(document.querySelector('.jsUpdatesSearchSinglePopupContent'))

    jQuery('.jsUpdatesSearchPopup').addClass('c-search__single__popup-visible')
  }

  jQuery('.jsSearchUpdateItem a').click(function () {
    const postId = jQuery(this).attr('data-post-id')
    const nextURL = jQuery(this).attr('href')

    addPopupOpenEventForUpdateClick(postId, nextURL)

    return false
  })

  jQuery('.c-update__dropdown-item').click(function () {
    var selectedText = jQuery(this).text()
    var selectedValue = parseInt(jQuery(this).attr('data-term-id'))

    jQuery('.c-update__dropdown-value-txt').text(selectedText)
    jQuery('.c-update__dropdown-item').removeClass('active')
    jQuery(this).addClass('active')

    jQuery('.c-update__dropdown-value-txt').trigger('click')

    if (selectedValue === 0) {
      // when all is selected
      jQuery('.jsSearchUpdateItem').removeClass('hide')
    } else {
      jQuery('.jsSearchUpdateItem').addClass('hide')
      jQuery('.jsSearchUpdateItem.uc' + selectedValue).removeClass('hide')
    }
  })
})
