import { disableBodyScroll, enableBodyScroll } from 'body-scroll-lock'

export default {
  init() {
    // JavaScript to be fired on all pages
    
    // Mobile Nav
    const navWrap = $('.mobileNav_Wrap')[0];
    $('.mobileMenuToggle').on('click', () => {
        $('body').addClass('mobile-nav-active')
        disableBodyScroll(navWrap)
    })

    $('.mobileNav_Close').on('click', () => {
        $('body').removeClass('mobile-nav-active')
        enableBodyScroll(navWrap)
    })
  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};
