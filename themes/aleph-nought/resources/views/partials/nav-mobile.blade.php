@if (has_nav_menu('mobile_navigation'))
  <div class="mobileNav_Wrap mobileNav_Wrap__hidden">
    <nav class="mobileNav" role="navigation" aria-labelledby="mobileMenu_Toggle" aria-hidden="true">
      <button class="mobileNav_Close" aria-label="Close menu">
        Menu
      </button>
      {!! wp_nav_menu(['theme_location' => 'mobile_navigation', 'menu_class' => 'nav']) !!}
    <nav>
  </div>
@endif
