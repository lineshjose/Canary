<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php endif; ?>
<?php wp_head(); ?>
<style type="text/css" id="canary-color-scheme">
<?php if(get_background_color()) {
}
 if(($image=(array)get_custom_header()) && trim($image['url'])) {
echo '#masthead{
			 background-image:url(\''.esc_url($image['url']).'\') !important;
			 background-size:cover;
			 background-color:'.esc_attr(get_theme_mod('header_background_color')).'
	}';
}
 if(get_header_textcolor()) {
 echo '#masthead, #masthead a {
	 	color: #'.esc_attr(get_header_textcolor()).'!important;
	}';
}
 if (!display_header_text() ) {
 echo '.site-branding, .site-branding .site-title, .site-description {
		 clip: rect(1px, 1px, 1px, 1px)!important;
		 position: absolute!important;
		 margin:0px !important;
	}';
}
echo '#secondary.sidebar .widget .widget-title { 
		background:'.esc_attr(get_theme_mod('wt_bg_color')).';
		color:'.esc_attr(get_theme_mod('wt_color')).' ;
}';
echo 'button, .button, input[type="submit"],input[type="reset"] {
		background-color:'.esc_attr(get_theme_mod('bt_bg_color')).'; 
		color:'.esc_attr(get_theme_mod('bt_color')).';
}
a{ 
	color:'.esc_attr(get_theme_mod('link_color')).';
}
#colophon{
	background-color:'.esc_attr(get_theme_mod('footer_bg_color')).'; 
}
';
?>
</style>
</head>
<body id="site-body" <?php body_class(); ?>>
<div id="page" class="site">
<div class="screen-reader-text"> <a class="skip-link" href="#content">
  <?php esc_html_e( 'Skip to content', 'canary' ); ?>
  </a> </div>
<header id="masthead" class="site-header" role="banner">
  <?php the_custom_header_markup();?>
  <div class="site-header-menubar">
    <div class="wrapper">
      <div id="site-header-menu" class="site-header-menu alignleft">
        <button id="menu-toggle" class="menu-toggle"><i class="fa fa-bars"></i><span>
        <?php esc_html_e( 'Menu', 'canary' ); ?>
        </span></button>
        <nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'canary' ); ?>">
          <?php if (has_nav_menu('primary')) {
				wp_nav_menu(array( 
					'theme_location' => 'primary', 
					'container' => false, 
					'fallback_cb'=>false,
					'menu_id' => 'primary-menu', 
					'menu_name' => 'primary_menu', 
					'menu_class' => 'primary-menu', 
					'link_before' => '<span>', 
					'link_after' => '</span>',
					'depth'=>1
				));
			}
			?>
          <div class="clear"></div>
        </nav>
      </div>
      <div class="right-section alignright">
        <div class="search-form-wrap alignright">
          <button id="search-toggle" class="search-toggle"><i class="fa fa-search"></i><span>
          <?php esc_html_e( 'Search', 'canary' ); ?>
          </span></button>
          <?php get_search_form();?>
        </div>
        <div class="clear"></div>
      </div>
      <div class="clear"></div>
    </div>
  </div>
  <div class="site-header-main">
    <?php canary_the_custom_logo();  ?>
    <nav id="social-navigation" class="social-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Social Link', 'canary' ); ?>">
      <?php if (has_nav_menu('social')) {
				wp_nav_menu(array( 
					'theme_location' => 'social', 
					'container' => false, 
					'fallback_cb'=>false,
					'menu_id' => 'social-menu', 
					'menu_name' => 'social_menu', 
					'menu_class' => 'social-menu', 
					'link_before' => '<span class="screen-reader-text">', 
					'link_after' => '</span>',
					'depth'=>1
				));
			}
			?>
      <div class="clear"></div>
    </nav>
  </div>
  <div class="clear"></div>
</header>
<div id="content" class="site-content wrapper">
