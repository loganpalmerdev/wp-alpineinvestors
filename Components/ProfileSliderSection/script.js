import Swiper, { Navigation, Pagination, A11y, Autoplay, EffectFade } from 'swiper/swiper.esm'
import 'swiper/swiper-bundle.css'

Swiper.use([Navigation, Pagination, A11y, Autoplay, EffectFade])

class ProfileSlider extends window.HTMLDivElement {
  constructor (...args) {
    const self = super(...args)
    self.init()
    return self
  }

  init () {
    this.imageSlider = null
    this.contentSlider = null
    this.resolveElements()
  }

  resolveElements () {
    this.$ImageSlider = jQuery('.c-profile-slider__image .swiper-container', this)
    this.$ImagebuttonNext = jQuery('.c-profile-slider__image .c-profile-slider__button-next', this)
    this.$ImagebuttonPrev = jQuery('.c-profile-slider__image .c-profile-slider__button-prev', this)
    this.$Imagepagination = jQuery('.c-profile-slider__image .c-profile-slider__pagination', this)
    this.$ContentSlider = jQuery('.c-profile-slider__content .swiper-container', this)
  }

  connectedCallback () {
    this.initSlider()
  }

  initSlider () {
    const imageSliderConfig = {
      slidesPerView: 1,
      spaceBetween: 0,
      effect: 'fade',
      // fadeEffect: {
      //   crossFade: true
      // },
      // autoplay: {
      //   delay: 300,
      // },
      loop: true,
      navigation: {
        nextEl: this.$ImagebuttonNext.get(0),
        prevEl: this.$ImagebuttonPrev.get(0)
      },
      pagination: {
        el: this.$Imagepagination.get(0),
        type: 'fraction'
      },
      on: {
        slideChange: (swiper) => {
          if (this.contentSlider) {
            this.contentSlider.slideTo(swiper.activeIndex)
            // if (swiper.activeIndex < swiper.previousIndex) {
            //   this.contentSlider.slideNext(500, false)
            // } else if (swiper.activeIndex > swiper.previousIndex) {
            //   this.contentSlider.slidePrev(500, false)
            // }
          }
        }
      }
    }

    const contentSliderConfig = {
      slidesPerView: 1,
      spaceBetween: 0,
      effect: 'fade',
      // fadeEffect: {
      //   crossFade: true
      // },
      // autoplay: {
      //   delay: 300,
      // },
      loop: true,
      on: {
        slideChange: (swiper) => {
          if (this.imageSlider) {
            this.imageSlider.slideTo(swiper.activeIndex)
          }
        }
      }
    }

    this.imageSlider = new Swiper(this.$ImageSlider.get(0), imageSliderConfig)
    this.contentSlider = new Swiper(this.$ContentSlider.get(0), contentSliderConfig)
  }
}

window.customElements.define('flynt-profile-slider', ProfileSlider, { extends: 'div' })

class ProfileSliderMobile extends window.HTMLDivElement {
  constructor (...args) {
    const self = super(...args)
    self.init()
    return self
  }

  init () {
    this.imageSlider = null
    this.resolveElements()
  }

  resolveElements () {
    this.$ImageSlider = jQuery('.swiper-container', this)
    this.$ImagebuttonNext = jQuery('.c-profile-slider__button-next', this)
    this.$ImagebuttonPrev = jQuery('.c-profile-slider__button-prev', this)
    this.$Imagepagination = jQuery('.c-profile-slider__pagination', this)
  }

  connectedCallback () {
    this.initSlider()
  }

  initSlider () {
    const imageSliderConfig = {
      slidesPerView: 1,
      spaceBetween: 0,
      effect: 'fade',
      fadeEffect: {
        crossFade: true
      },
      // autoplay: {
      //   delay: 300,
      // },
      loop: true,
      navigation: {
        nextEl: this.$ImagebuttonNext.get(0),
        prevEl: this.$ImagebuttonPrev.get(0)
      },
      pagination: {
        el: this.$Imagepagination.get(0),
        type: 'fraction'
      }
    }

    this.imageSlider = new Swiper(this.$ImageSlider.get(0), imageSliderConfig)
  }
}

window.customElements.define('flynt-profile-slider-mobile', ProfileSliderMobile, { extends: 'div' })
