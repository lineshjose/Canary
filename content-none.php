<?php /** 
 * Canary content none file
 *
 * @category WordPress
 * @package  Canary
 * @author   Linesh Jose <lineshjos@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://linesh.com/projects/canary/
 *
 */
 ?>
<section class="no-results not-found">
  <header class="page-header">
    <h1 class="page-title">
      <?php esc_html_e('Nothing Found', 'canary'); ?>
    </h1>
  </header>
  <div class="page-content">
    <?php if (canary_is_home_page() && current_user_can('publish_posts') ) : ?>
    <p><?php echo esc_html__('Ready to publish your first post? ', 'canary').'<a href="'.esc_url(admin_url('post-new.php')).'">'.esc_html__('Get started here.', 'canary').'</a>'; ?></p>
    <?php elseif (is_search() ) : ?>
    <p>
      <?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'canary'); ?>
    </p>
    <div class="search-form-wrap">
      <?php get_search_form(); ?>
    </div>
    <?php else : ?>
    <p>
      <?php esc_html_e('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'canary'); ?>
    </p>
    <div class="search-form-wrap">
      <?php get_search_form(); ?>
    </div>
    <?php endif; ?>
  </div>
</section>
