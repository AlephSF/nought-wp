<header class="siteHeader">
  <div id="skipnav">
    <p class="skipnav">
      <a href="#mainContent">Skip to main content</a>
    </p>
  </div>
  <div class="siteHeader_Inner container">
    <button class="siteHeader_Button mobileMenuToggle">
      Hamburger here
    </button>
    <a class="brand" href="{{ home_url('/') }}">{{ get_bloginfo('name', 'display') }}</a>
    <nav class="nav-primary">
      @if (has_nav_menu('primary_navigation'))
        {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav']) !!}
      @endif
    </nav>
  </div>
</header>
