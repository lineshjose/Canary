<?php /**
 * Canary footer file
 *
 * @category WordPress
 * @package  Canary
 * @author   Linesh Jose <lineshjos@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://linesh.com/projects/canary/
 *
 */
?>

<div class="clear"></div>
</div>
<footer id="colophon" class="site-footer " role="contentinfo">
  <div class="site-info wrapper">
    <?php
    if (has_nav_menu('footer')) {
         wp_nav_menu(
             array( 
             'theme_location' => 'footer', 
             'container' => false, 
             'menu_id' => 'footer-nav', 
             'menu_name' => 'footer_nav', 
             'menu_class' => 'footer-nav ', 
             'link_before' => '<span>', 
             'link_after' => '</span>',
             'fallback_cb'=>false,
             'depth'=>1
             )
         );
    }?>
    <p class="site-info centertext footer-copy"> <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">&copy; <?php echo esc_html(date('Y'));?>
      <?php bloginfo('name'); ?>
      . </a><a href="<?php echo esc_url('https://wordpress.org/'); ?>">
      <?php esc_html_e('Proudly powered by WordPress', 'canary'); ?>
      . </a><a href="<?php echo esc_url('https://linesh.com/projects/canary/'); ?>">
      <?php esc_html_e('Canary', 'canary'); ?>
      </a>, <a href="<?php echo esc_url('https://linesh.com/'); ?>">
      <?php esc_html_e('Theme by Linesh Jose', 'canary'); ?>
      </a> </p>
  </div>
</footer>
</div>
<?php wp_footer(); ?>
</body></html>