<?php /**
 * Canary 404 Page File
 *
 * @category WordPress
 * @package  Canary
 * @author   Linesh Jose <lineshjos@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://linesh.com/projects/canary/
 *
 */
get_header();?>
<main id="main" class="site-main content-area not-found-page" role="main">
  <article class="fof-page">
    <h1 class="page-title"><?php echo esc_html_e('404', 'canary'); ?></h1>
    <h2 class="page-title"><?php echo esc_html_e('Oops! That page can&rsquo;t be found.', 'canary'); ?></h2>
    <p>
      <?php esc_html_e('It looks like nothing was found at this location. Maybe try a search?', 'canary'); ?>
    </p>
    <div class="search-form-wrap">
      <?php get_search_form(); ?>
    </div>
    <div class="clear"></div>
  </article>
  <div class="clear"></div>
</main>
<?php get_footer(); ?>
