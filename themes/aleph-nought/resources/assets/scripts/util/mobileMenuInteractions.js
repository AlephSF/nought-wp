import { disableBodyScroll, enableBodyScroll } from 'body-scroll-lock'

export default function mobileMenuInteractions () {
  const navWrap = $('.mobileNav_Wrap')[0];

  function openMobileMenu () {
    $('body').addClass('mobile-nav-active')
    disableBodyScroll(navWrap)
  }
  
  function closeMobileMenu () {
    $('body').removeClass('mobile-nav-active')
    enableBodyScroll(navWrap)
  }
  
  $('.mobileMenuToggle').on('click', () => {
    openMobileMenu()
  })
  
  $('.mobileNav_Close').on('click', () => {
    closeMobileMenu()
  })
}
