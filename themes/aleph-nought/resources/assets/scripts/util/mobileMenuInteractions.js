import { disableBodyScroll, enableBodyScroll } from 'body-scroll-lock'

export default function mobileMenuInteractions () {
  const navWrap = $('.mobileNav_Wrap')[0];
  const mobileNav = $('.mobileNav')
  const mobileToggle = $('.mobileMenuToggle')
  const mobileNavClose = $('.mobileNav_Close')
  const lastMenuElement = $('#menu-mobile-navigation li a:last')

  function openMobileMenu () {
    $('.mobileNav_Wrap').toggleClass('mobileNav_Wrap__hidden')
    setTimeout(() => {
      $('body').addClass('mobile-nav-active')
      }, 60
    )
    disableBodyScroll(navWrap)
    mobileToggle.attr('aria-expanded', 'true')
    mobileNav.attr('aria-hidden', 'false')
    $('#menu-mobile-navigation li a:first').focus()
  }
  
  function closeMobileMenu () {
    $('body').removeClass('mobile-nav-active')
    enableBodyScroll(navWrap)
    mobileToggle.focus().attr('aria-expanded', 'false')
    setTimeout(() => {
      $('.mobileNav_Wrap').toggleClass('mobileNav_Wrap__hidden')
      }, 600
    )
    mobileNav.attr('aria-hidden', 'true')
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

  // trap focus
  mobileNavClose.on('keydown', (e) => {
    if (e.shiftKey && e.keyCode === 9) {
      e.preventDefault()
      lastMenuElement.focus()
    }
  })

  lastMenuElement.on('keydown', (e) => {
    if (e.keyCode === 9 && !(e.shiftKey && e.keyCode === 9)) {
      e.preventDefault()
      mobileNavClose.focus()
    }
  })
}
