import { disableBodyScroll, enableBodyScroll } from 'body-scroll-lock'

/**
 * get the selected options string
 */
function getProfilesFilterOptionsLabel () {
  var str = ''

  var selectedPortfolioStatusVal = jQuery('[name="portfolio-status-term"]:checked').val()
  if (selectedPortfolioStatusVal !== '-1') {
    // if story type is not ALL, get the label
    str = jQuery('[name="portfolio-status-term"]:checked').parent().text()
  } else {
    str = 'All'
  }

  str += ', '

  var selectedPortfolioIndustryVal = jQuery('[name="portfolio-industry-term"]:checked').val()
  if (selectedPortfolioIndustryVal !== '-1') {
    // if story sector is not ALL, get the label
    str += jQuery('[name="portfolio-industry-term"]:checked').parent().text()
  } else {
    str += 'All'
  }

  str += ', '

  var selectedPortfolioVerticalVal = jQuery('[name="portfolio-vertical-term"]:checked').val()
  if (selectedPortfolioVerticalVal !== '-1') {
    // if story sector is not ALL, get the label
    str += jQuery('[name="portfolio-vertical-term"]:checked').parent().text()
  } else {
    str += 'All'
  }

  str = str === 'All, All, All' ? 'All' : str

  if (str !== '') {
    str = 'FILTER : <span>' + str + '</span>'
  }

  return str
}

function setProfilesSearchKeyLabel (str) {
  jQuery('.jsProfileSearchKey h2').html(str)
}

jQuery(document).ready(function () {
  jQuery('.jsProfileSearchKey').click(function () {
    if (jQuery(window).width() < 1280) {
      jQuery('.jsProfileSearchFilterCol').addClass('open').innerHeight(window.innerHeight)
      jQuery('header, .header-menu-section').addClass('hidden')

      disableBodyScroll(document.querySelector('.jsProfileSearchFilterCol'))
    }
  })

  jQuery('.jsProfileSearchFilterCloseBtn').click(function () {
    jQuery('.jsProfileSearchFilterCol').removeClass('open').removeAttr('style')
    jQuery('header, .header-menu-section').removeClass('hidden')
    enableBodyScroll(document.querySelector('.jsProfileSearchFilterCol'))
  })

  /**
   * when one portfolio item is clicked, show popup
   */
  function setPortfolioPopupClickEvent () {
    jQuery('.jsSearchPortfolioRow .jsSearchPortfolioItemInner').click(function () {
      // add hide class to all portfolio popup
      jQuery('.jsSearchPortfolioPopup').addClass('hide')
      // remove hide class of clicked item
      jQuery('.jsSearchPortfolioPopup', jQuery(this).parent()).removeClass('hide')

      var contentElem = jQuery('.c-search__portfolio-popup-content', jQuery(this).parent()).get(0)

      disableBodyScroll(contentElem)
    })

    /**
     * when close button of opened portfolio popup is clicked, close that popup
     */
    jQuery('.jsSearchPortfolioRow .jsSearchPortfolioPopupClose').click(function () {
      jQuery(this).parent().addClass('hide')

      var contentElem = jQuery('.c-search__portfolio-popup-content', jQuery(this).parent()).get(0)

      enableBodyScroll(contentElem)
    })
  }

  function setPortfolioVisible () {
    var portfolioStatusTerm = jQuery('[name="portfolio-status-term"]:checked').val()
    var portfolioIndustryTerm = jQuery('[name="portfolio-industry-term"]:checked').val()
    var portfolioVerticalTerm = jQuery('[name="portfolio-vertical-term"]:checked').val()

    var conditionClass = ''

    if (portfolioStatusTerm !== '-1') {
      conditionClass += '.' + portfolioStatusTerm
    }

    if (portfolioIndustryTerm !== '-1') {
      conditionClass += '.' + portfolioIndustryTerm
    }

    if (portfolioVerticalTerm !== '-1') {
      conditionClass += '.' + portfolioVerticalTerm
    }

    setProfilesSearchKeyLabel(getProfilesFilterOptionsLabel())

    jQuery('.c-search__portfolio-row').html('')

    jQuery('.c-search__portfolio-backup .jsSearchPortfolioItem' + conditionClass).each(function (index, elem) {
      jQuery('.c-search__portfolio-row').append(jQuery(elem).clone())
    })

    // add popup click event to new added elements
    setPortfolioPopupClickEvent()
  }

  setPortfolioPopupClickEvent()

  /**
   * when portfolio term is clicked
   */
  jQuery('.jsPortfolioTerm').click(function () {
    jQuery('.jsProfileSearchFilterResetBtn').removeClass('hidden')
    setPortfolioVisible()
  })

  jQuery('.jsProfileSearchFilterResetBtn button').click(function () {
    jQuery('.jsProfileSearchFilterResetBtn').addClass('hidden')

    jQuery('[name="portfolio-status-term"][value=-1]').prop('checked', true)
    jQuery('[name="portfolio-industry-term"][value=-1]').prop('checked', true)
    jQuery('[name="portfolio-vertical-term"][value=-1]').prop('checked', true)

    setPortfolioVisible()
  })
})
