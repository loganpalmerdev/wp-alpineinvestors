import { disableBodyScroll, enableBodyScroll } from 'body-scroll-lock'

/**
 * get the selected options string
 */
function getStoriesFilterOptionsLabel () {
  var str = ''

  var selectedStoryTypeVal = jQuery('[name="story-type-term"]:checked').val()
  if (selectedStoryTypeVal !== '-1') {
    // if story type is not ALL, get the label
    str = jQuery('[name="story-type-term"]:checked').parent().text()
  } else {
    str = 'All'
  }

  str += ', '

  var selectedStorySectorVal = jQuery('[name="story-sector-term"]:checked').val()
  if (selectedStorySectorVal !== '-1') {
    // if story sector is not ALL, get the label
    str += jQuery('[name="story-sector-term"]:checked').parent().text()
  } else {
    str += 'All'
  }

  str = str === 'All, All' ? 'All' : str

  if (str !== '') {
    str = 'FILTER : <span>' + str + '</span>'
  }

  jQuery('.jsStoriesLoadBtn').attr('data-story-type', selectedStoryTypeVal).attr('data-story-sector', selectedStorySectorVal).attr('data-story-search-key', '')

  return str
}

function resetStoriesFilterOptionsVal () {
  jQuery('[name="story-type-term"][value=-1]').prop('checked', true)
  jQuery('[name="story-sector-term"][value=-1]').prop('checked', true)
}

function setStoriesSearchKeyLabel (str) {
  // display Search Key
  if (str === '') {
    jQuery('.jsStoriesSearchKeyRow').addClass('hidden')
  } else {
    jQuery('.jsStoriesSearchKey h2').html(str)
    jQuery('.jsStoriesSearchKeyRow').removeClass('hidden')

    // display clear button
    jQuery('.jsStoriesSearchFilterResetBtn').removeClass('hidden')
  }
}

function displayStoriesInit () {
  var postsPerPage = jQuery('.jsStoriesLoadBtn').attr('data-posts-per-page')
  var nonce = jQuery('.jsStoriesLoadBtn').attr('data-nonce')
  var storyType = jQuery('.jsStoriesLoadBtn').attr('data-story-type')
  var storySector = jQuery('.jsStoriesLoadBtn').attr('data-story-sector')
  var storySearchKey = jQuery('.jsStoriesLoadBtn').attr('data-story-search-key')

  jQuery('.jsStoriesSearchLoadSpinner').removeClass('hide')

  jQuery.ajax({
    type: 'post',
    dataType: 'json',
    url: window.FlyntData.ajaxurl,
    data: {
      action: 'get_stories',
      nonce: nonce,
      page: 1,
      postsPerPage: postsPerPage,
      storyType: storyType,
      storySector: storySector,
      storySearchKey: storySearchKey
    },
    success: function (response) {
      const newListElems = jQuery(response.stories_html)

      jQuery('.jsSearchStoryRow').html(newListElems)

      jQuery('a', newListElems).click(function () {
        const postId = jQuery(this).attr('data-post-id')
        const nextURL = jQuery(this).attr('href')

        addPopupOpenEventForStoryClick(postId, nextURL)

        return false
      })

      jQuery('.jsStoriesLoadBtn').attr('data-page-counts', response.page_counts)
      jQuery('.jsStoriesLoadBtn').attr('data-page', 1)

      if (response.page_counts > 1) {
        jQuery('.jsStoriesLoadBtn').removeClass('hide')
      } else {
        jQuery('.jsStoriesLoadBtn').addClass('hide')
      }

      jQuery('.jsStoriesSearchLoadSpinner').addClass('hide')
    }
  })
}

function closeSingleStoryPopup () {
  enableBodyScroll(document.querySelector('.jsStoriesSearchSinglePopupContent'))

  jQuery('.jsStoriesSearchPopup').removeClass('c-search__single__popup-visible')
  jQuery('.header-menu-btn').removeClass('hidden')
  jQuery('.jsStoriesSearchSinglePopupCloseBtn').removeClass('open')
  jQuery('header').addClass('header-hidden')

  jQuery('.jsStoriesSearchSinglePopupContent').scrollTop(0)

  const nextURL = jQuery('.jsStoriesSearchSinglePopupCloseBtn').attr('data-current-page-url')
  const nextState = { additionalInformation: 'Updated the URL with JS' }

  // This will create a new entry in the browser's history, without reloading
  window.history.pushState(nextState, null, nextURL)

  // This will replace the current entry in the browser's history, without reloading
  // window.history.replaceState(nextState, null, nextURL);
}

/**
 * when the single story card is clicked on story list, the single story detail popup will display
 * @param postId : selected single story id
 * @param nextURL : selected single story permalink
 */
function addPopupOpenEventForStoryClick (postId, nextURL) {
  jQuery('.jsStoriesSearchLoadSpinner').removeClass('hide')

  const nonce = jQuery('.jsStoriesSearchPopup').attr('data-nonce')

  const nextState = { postId: postId }

  jQuery.ajax({
    type: 'post',
    dataType: 'json',
    url: window.FlyntData.ajaxurl,
    data: {
      action: 'get_single_story',
      nonce: nonce,
      postId: postId
    },
    success: function (response) {
      jQuery('.jsSingleStoryPopupContentInner').html(response.single_story_html)
      jQuery('.jsSingleStoryNavWrapper').html(response.single_story_nav_html)

      jQuery('.jsStoriesSearchLoadSpinner').addClass('hide')

      jQuery('header').removeClass('header-hidden')
      jQuery('.header-menu-btn').addClass('hidden')
      jQuery('.jsStoriesSearchSinglePopupCloseBtn').addClass('open')
      disableBodyScroll(document.querySelector('.jsStoriesSearchSinglePopupContent'))

      jQuery('.jsStoriesSearchPopup').addClass('c-search__single__popup-visible')
      setClickEventToStoryPrevNexCard()

      // after adding the new content, scrolling top
      jQuery('.jsStoriesSearchSinglePopupContent').animate({ scrollTop: 0 })

      // This will create a new entry in the browser's history, without reloading
      window.history.pushState(nextState, response.single_story_title, nextURL)

      // This will replace the current entry in the browser's history, without reloading
      // window.history.replaceState(nextState, response.single_story_title, nextURL)
    }
  })

  return false
}

function setClickEventToStoryPrevNexCard () {
  /**
   * when the sotry nav card is clicked, open the ajax single story popup and change the url wihtout redirecting
   */
  jQuery('.c-single-story-nav__item a').click(function () {
    const postId = jQuery(this).attr('data-post-id')
    const nextURL = jQuery(this).attr('href')

    addPopupOpenEventForStoryClick(postId, nextURL)

    return false
  })
}

jQuery(document).ready(function () {
  /**
   * when search key word form is submitted
   */
  jQuery('.jsStoriesSearchFilterForm form').submit(function () {
    var searchKey = jQuery('input[type=text]', this).val()

    // when searchKey is not empty, make the form submit work
    if (searchKey) {
      if (jQuery(window).width() > 1000) {
        setStoriesSearchKeyLabel('Search results for <span>“' + searchKey + '”</span>')
      } else {
        setStoriesSearchKeyLabel('Filter : <span>All</span>')
        jQuery('.jsStoriesSearchKeyMobileRow h2 span').html('<span>“' + searchKey + '”</span>')
        jQuery('.jsStoriesSearchKeyMobileRow').removeClass('hide')
      }

      jQuery('input[type=text]', this).val('')

      // when form is submitted, the selected filter options will be ignored
      resetStoriesFilterOptionsVal()

      jQuery('.jsStoriesLoadBtn').attr('data-story-type', -1).attr('data-story-sector', -1).attr('data-story-search-key', searchKey)
      displayStoriesInit()
    }

    return false
  })

  // when story type radio is clicked
  jQuery('[name="story-type-term"]').click(function () {
    const oldStoryType = jQuery('.jsStoriesLoadBtn').attr('data-story-type')

    // when before and now are different, make the search func work
    if (oldStoryType !== jQuery(this).val()) {
      setStoriesSearchKeyLabel(getStoriesFilterOptionsLabel())

      displayStoriesInit()
    }
  })

  // when story sector radio is clicked
  jQuery('[name="story-sector-term"]').click(function () {
    const oldStorySector = jQuery('.jsStoriesLoadBtn').attr('data-story-sector')

    // when before and now are different, make the search func work
    if (oldStorySector !== jQuery(this).val()) {
      setStoriesSearchKeyLabel(getStoriesFilterOptionsLabel())

      displayStoriesInit()
    }
  })

  /**
   * when clear button is clicked, reset the search options
   */
  jQuery('.jsStoriesSearchFilterResetBtn button').click(function () {
    resetStoriesFilterOptionsVal()
    setStoriesSearchKeyLabel('Filter : <span>ALL</span>')

    jQuery('.jsStoriesLoadBtn').attr('data-story-type', -1).attr('data-story-sector', -1).attr('data-story-search-key', '')
    displayStoriesInit()

    jQuery('.jsStoriesSearchFilterResetBtn').addClass('hidden')
    jQuery('.jsStoriesSearchKeyMobileRow').addClass('hide')
  })

  jQuery('.jsStoriesSearchKey').click(function () {
    if (jQuery(window).width() < 1280) {
      jQuery('.jsStoriesSearchFilterCol').addClass('open').innerHeight(window.innerHeight)
      jQuery('header, .header-menu-section').addClass('hidden')

      disableBodyScroll(document.querySelector('.jsStoriesSearchFilterCol'))
    }
  })

  jQuery('.jsStoriesSearchFilterCloseBtn').click(function () {
    jQuery('.jsStoriesSearchFilterCol').removeClass('open').removeAttr('style')
    jQuery('header, .header-menu-section').removeClass('hidden')
    enableBodyScroll(document.querySelector('.jsStoriesSearchFilterCol'))
  })

  // when load more button is clicked
  jQuery('.jsStoriesLoadBtn button').click(function () {
    var page = parseInt(jQuery('.jsStoriesLoadBtn').attr('data-page'))
    var pageCounts = parseInt(jQuery('.jsStoriesLoadBtn').attr('data-page-counts'))
    var postsPerPage = jQuery('.jsStoriesLoadBtn').attr('data-posts-per-page')
    var nonce = jQuery('.jsStoriesLoadBtn').attr('data-nonce')
    var storyType = jQuery('.jsStoriesLoadBtn').attr('data-story-type')
    var storySector = jQuery('.jsStoriesLoadBtn').attr('data-story-sector')
    var storySearchKey = jQuery('.jsStoriesLoadBtn').attr('data-story-search-key')

    jQuery('.jsStoriesSearchLoadSpinner').removeClass('hide')

    if (page < pageCounts) {
      jQuery.ajax({
        type: 'post',
        dataType: 'json',
        url: window.FlyntData.ajaxurl,
        data: {
          action: 'get_stories',
          nonce: nonce,
          page: page + 1,
          postsPerPage: postsPerPage,
          storyType: storyType,
          storySector: storySector,
          storySearchKey: storySearchKey
        },
        success: function (response) {
          const newListElems = jQuery(response.stories_html)

          jQuery('.jsSearchStoryRow').append(newListElems)

          // add a tag click event to the created new elements
          jQuery('a', newListElems).click(function () {
            const postId = jQuery(this).attr('data-post-id')
            const nextURL = jQuery(this).attr('href')

            addPopupOpenEventForStoryClick(postId, nextURL)

            return false
          })

          jQuery('.jsStoriesLoadBtn').attr('data-page', page + 1)

          if (page + 1 >= pageCounts) {
            jQuery('.jsStoriesLoadBtn').addClass('hide')
          }

          jQuery('.jsStoriesSearchLoadSpinner').addClass('hide')
        }
      })
    }
  })

  /**
   * when story card is clicked, open the ajax single story popup and change the url wihtout redirecting
   */
  jQuery('.jsStoriesResultItem a').click(function () {
    const postId = jQuery(this).attr('data-post-id')
    const nextURL = jQuery(this).attr('href')

    addPopupOpenEventForStoryClick(postId, nextURL)

    return false
  })

  jQuery('.jsStoriesSearchSinglePopupCloseBtn').click(function () {
    closeSingleStoryPopup()
  })

  // when out side of single story popup content is clicked, close popup
  jQuery('.jsStoriesSearchPopup').click(function () {
    closeSingleStoryPopup()
  })

  // click event of popup inner click is stop for outside click popup
  jQuery('.jsStoriesSearchSinglePopupWrapper').click(function (event) {
    event.stopPropagation()
  })

  // if this is a single story page
  if (jQuery('.jsStoriesSearchPopup').attr('data-is-single-story') === 'yes') {
    jQuery('header').removeClass('header-hidden')
    jQuery('.header-menu-btn').addClass('hidden')
    jQuery('.jsStoriesSearchSinglePopupCloseBtn').addClass('open')
    disableBodyScroll(document.querySelector('.jsStoriesSearchSinglePopupContent'))

    jQuery('.jsStoriesSearchPopup').addClass('c-search__single__popup-visible')
    setClickEventToStoryPrevNexCard()
  }
})
