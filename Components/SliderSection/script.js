import Swiper, { Navigation, Pagination, A11y, Autoplay } from 'swiper/swiper.esm'
import 'swiper/swiper-bundle.css'

Swiper.use([Navigation, Pagination, A11y, Autoplay])

class SliderRow extends window.HTMLDivElement {
  constructor (...args) {
    const self = super(...args)
    self.init()
    return self
  }

  init () {
    this.$ = jQuery(this)
    this.resolveElements()
  }

  resolveElements () {
    this.$buttonNext = jQuery('.c-slider__button-next', this)
    this.$buttonPrev = jQuery('.c-slider__button-prev', this)
    this.$pagination = jQuery('.c-slider__pagination', this)
  }

  connectedCallback () {
    this.initSlider()
  }

  initSlider () {
    const config = {
      slidesPerView: 1,
      spaceBetween: 0,
      // autoplay: {
      //   delay: 300,
      // },
      loop: true,
      navigation: {
        nextEl: this.$buttonNext.get(0),
        prevEl: this.$buttonPrev.get(0)
      },
      pagination: {
        el: this.$pagination.get(0),
        type: 'fraction'
      }
    }

    this.slider = new Swiper(this.$.get(0), config)
  }
}

window.customElements.define('flynt-slider-row', SliderRow, { extends: 'div' })
