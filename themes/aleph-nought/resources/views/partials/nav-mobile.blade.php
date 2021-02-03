@if (has_nav_menu('mobile_navigation'))
  <div class="mobileNav_Wrap">
    <nav class="mobileNav">
      <button class="mobileNav_Close">
        Menu
      </button>
      {!! wp_nav_menu(['theme_location' => 'mobile_navigation', 'menu_class' => 'nav']) !!}
    <nav>
  </div>
@endif
