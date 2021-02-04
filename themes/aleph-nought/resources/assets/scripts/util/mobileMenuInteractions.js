import { disableBodyScroll, enableBodyScroll } from 'body-scroll-lock'

export default function mobileMenuInteractions () {
  const navWrap = $('.mobileNav_Wrap')[0];
  const mobileToggle = $('.mobileMenuToggle')

  function openMobileMenu () {
    $('body').addClass('mobile-nav-active')
    disableBodyScroll(navWrap)
    $('#menu-mobile-navigation li a:first').focus()
  }
  
  function closeMobileMenu () {
    $('body').removeClass('mobile-nav-active')
    enableBodyScroll(navWrap)
    mobileToggle.focus()
  }
  
  $('.mobileMenuToggle').on('click', () => {
    openMobileMenu()
  })
  
  $('.mobileNav_Close').on('click', () => {
    closeMobileMenu()
  })

  $(document).on('keydown', (e) => {
    if ($('body').hasClass('mobile-nav-active')) {
      if (e.key === 'Escape' || e.keyCode === 'Esc') {
        closeMobileMenu()
      }
    }
  })
}
