import { disableBodyScroll, enableBodyScroll } from 'body-scroll-lock'

/**
 * when the mouse is over on avatar, change zindex
 */
function setAvatarHoverEvent () {
  jQuery('.jsSingleTeamAvatarDouble').mouseenter(function () {
    var maxZIndex = 0

    jQuery('.jsSingleTeamAvatarDouble').each(function (index, elem) {
      var elemZIndex = parseInt(jQuery(elem).css('zIndex'))
      maxZIndex = maxZIndex > elemZIndex ? maxZIndex : elemZIndex
    })

    jQuery(this).css('zIndex', maxZIndex + 1)
  })
}

/**
 * get the selected options string
 */
function getTeamsFilterOptionsLabel () {
  var str = ''
  var searchClass = ''

  var selectedTeamIndustryVal = jQuery('[name="team-industry-term"]:checked').val()
  if (selectedTeamIndustryVal !== '-1') {
    // if team industry is not ALL, get the label
    str = jQuery('[name="team-industry-term"]:checked').parent().text()

    // generate conditional class
    searchClass += '.ti' + selectedTeamIndustryVal
  } else {
    str = 'All'
  }

  str += ', '

  var selectedTeamFunctionVal = jQuery('[name="team-function-term"]:checked').val()
  if (selectedTeamFunctionVal !== '-1') {
    // if team function is not ALL, get the label
    str += jQuery('[name="team-function-term"]:checked').parent().text()

    // generate conditional class
    searchClass += '.tf' + selectedTeamFunctionVal
  } else {
    str += 'All'
  }

  str = str === 'All, All' ? 'All' : str

  if (str !== '') {
    str = 'FILTER : <span>' + str + '</span>'
  }

  if (searchClass === '') {
    // if searchClass is empty, display everything
    jQuery('.jsSearchAplineTeamRow .jsSearchTeamItem').removeClass('hide')
  } else {
    // display selected cards
    jQuery('.jsSearchAplineTeamRow .jsSearchTeamItem').addClass('hide')
    jQuery('.jsSearchAplineTeamRow .jsSearchTeamItem' + searchClass).removeClass('hide')
  }

  return str
}

function setTeamsSearchKeyLabel (str) {
  // display Search Key
  if (str !== '') {
    jQuery('.jsTeamsSearchKey h2').html(str)

    // display clear button
    jQuery('.jsTeamsSearchFilterResetBtn').removeClass('hidden')
  }
}

function resetTeamsFilterOptionsVal () {
  jQuery('[name="team-industry-term"][value=-1]').prop('checked', true)
  jQuery('[name="team-function-term"][value=-1]').prop('checked', true)
}

function closeTeamStoryPopup () {
  enableBodyScroll(document.querySelector('.jsTeamsSearchSinglePopupContent'))

  jQuery('.jsTeamsSearchPopup').removeClass('c-search__single__popup-visible')
  jQuery('.header-menu-btn').removeClass('hidden')
  jQuery('.jsTeamsSearchSinglePopupCloseBtn').removeClass('open')
  jQuery('header').addClass('header-hidden')

  jQuery('.jsTeamsSearchSinglePopupContent').scrollTop(0)

  const nextURL = jQuery('.jsTeamsSearchSinglePopupCloseBtn').attr('data-current-page-url')
  const nextState = { additionalInformation: 'Updated the URL with JS' }

  // This will create a new entry in the browser's history, without reloading
  window.history.pushState(nextState, null, nextURL)

  // This will replace the current entry in the browser's history, without reloading
  // window.history.replaceState(nextState, null, nextURL);
}

/**
 * when the single team card is clicked on team list, the single team detail popup will display
 * @param postId : selected single team id
 * @param nextURL : selected single team permalink
 */
function addPopupOpenEventForTeamClick (postId, nextURL) {
  jQuery('.jsTeamsSearchLoadSpinner').removeClass('hide')

  const nonce = jQuery('.jsTeamsSearchPopup').attr('data-nonce')

  const nextState = { postId: postId }

  jQuery.ajax({
    type: 'post',
    dataType: 'json',
    url: window.FlyntData.ajaxurl,
    data: {
      action: 'get_single_team',
      nonce: nonce,
      postId: postId
    },
    success: function (response) {
      jQuery('.jsSingleTeamPopupContentInner').html(response.single_team_html)

      jQuery('.jsTeamsSearchLoadSpinner').addClass('hide')

      jQuery('header').removeClass('header-hidden')
      jQuery('.header-menu-btn').addClass('hidden')
      jQuery('.jsTeamsSearchSinglePopupCloseBtn').addClass('open')
      disableBodyScroll(document.querySelector('.jsTeamsSearchSinglePopupContent'))

      jQuery('.jsTeamsSearchPopup').addClass('c-search__single__popup-visible')

      // This will create a new entry in the browser's history, without reloading
      window.history.pushState(nextState, null, nextURL)

      // This will replace the current entry in the browser's history, without reloading
      // window.history.replaceState(nextState, null, nextURL);

      setAvatarHoverEvent()
    }
  })

  return false
}

jQuery(document).ready(function () {
  // when team industry radio is clicked
  jQuery('[name="team-industry-term"]').click(function () {
    setTeamsSearchKeyLabel(getTeamsFilterOptionsLabel())
  })

  // when team function radio is clicked
  jQuery('[name="team-function-term"]').click(function () {
    setTeamsSearchKeyLabel(getTeamsFilterOptionsLabel())
  })

  /**
   * when clear button is clicked, reset the search options
   */
  jQuery('.jsTeamsSearchFilterResetBtn button').click(function () {
    resetTeamsFilterOptionsVal()
    setTeamsSearchKeyLabel('Filter : <span>ALL</span>')

    jQuery('.jsSearchAplineTeamRow .jsSearchTeamItem').removeClass('hide')

    jQuery('.jsTeamsSearchFilterResetBtn').addClass('hidden')
  })

  jQuery('.jsTeamsSearchKey').click(function () {
    if (jQuery(window).width() < 1280) {
      jQuery('.jsTeamsSearchFilterCol').addClass('open').innerHeight(window.innerHeight)
      jQuery('header, .header-menu-section').addClass('hidden')

      disableBodyScroll(document.querySelector('.jsTeamsSearchFilterCol'))
    }
  })

  jQuery('.jsTeamsSearchFilterCloseBtn').click(function () {
    jQuery('.jsTeamsSearchFilterCol').removeClass('open').removeAttr('style')
    jQuery('header, .header-menu-section').removeClass('hidden')
    enableBodyScroll(document.querySelector('.jsTeamsSearchFilterCol'))
  })

  jQuery('.jsTeamsSearchSinglePopupCloseBtn').click(function () {
    closeTeamStoryPopup()
  })

  // when out side of single story popup content is clicked, close popup
  jQuery('.jsTeamsSearchPopup').click(function () {
    closeTeamStoryPopup()
  })

  // click event of popup inner click is stop for outside click popup
  jQuery('.jsTeamsSearchSinglePopupWrapper').click(function (event) {
    event.stopPropagation()
  })

  // if this is a single team page
  if (jQuery('.jsTeamsSearchPopup').attr('data-is-single-team') === 'yes') {
    jQuery('header').removeClass('header-hidden')
    jQuery('.header-menu-btn').addClass('hidden')
    jQuery('.jsTeamsSearchSinglePopupCloseBtn').addClass('open')
    disableBodyScroll(document.querySelector('.jsTeamsSearchSinglePopupContent'))

    jQuery('.jsTeamsSearchPopup').addClass('c-search__single__popup-visible')

    setAvatarHoverEvent()
  }

  jQuery('.jsSearchTeamItem a').click(function () {
    const postId = jQuery(this).attr('data-post-id')
    const nextURL = jQuery(this).attr('href')

    addPopupOpenEventForTeamClick(postId, nextURL)

    return false
  })

  jQuery('.c-search-team__tab-item').click(function () {
    if (!jQuery(this).hasClass('active')) {
      jQuery('.c-search-team__tab-item').removeClass('active')
      jQuery(this).addClass('active')

      var value = jQuery(this).attr('data-value')

      if (value === 'alpine-team') {
        jQuery('.jsPortfolioLeadersSearch').fadeOut(100, function () {
          jQuery('.jsAlpineTeamsSearch').fadeIn(100)
        })
      } else if (value === 'portfolio-leaders') {
        jQuery('.jsAlpineTeamsSearch').fadeOut(100, function () {
          jQuery('.jsPortfolioLeadersSearch').fadeIn(100)
        })
      }
    }
  })
})
