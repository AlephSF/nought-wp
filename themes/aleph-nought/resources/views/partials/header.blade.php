<header class="siteHeader">
  <div id="skipNav">
    <p class="skipNav_Text">
      <a href="#mainContent">Skip to main content</a>
    </p>
  </div>
  <div class="siteHeader_Inner container">
    <button id="mobileMenu_Toggle" class="siteHeader_Button mobileMenuToggle" aria-label="Main Navigation toggle" aria-expanded="false">
      Hamburger here
    </button>
  <a class="brand" href="{{ home_url('/') }}" aria-label="{{ get_bloginfo('name', 'display') }}">
    {{ get_bloginfo('name', 'display') }}
  </a>
    <nav class="nav-primary">
      @if (has_nav_menu('primary_navigation'))
        {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav']) !!}
      @endif
    </nav>
  </div>
</header>
