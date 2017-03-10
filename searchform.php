<?php /**
 * Canary search form file
 *
 * @category WordPress
 * @package  Canary
 * @author   Linesh Jose <lineshjos@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://linesh.com/projects/canary/
 *
 */
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
  <span class="screen-reader-text"><?php echo esc_html_x('Search for:', 'label', 'canary'); ?></span> <i class="fa fa-search"></i>
  <input type="search" class="search-field" placeholder="<?php echo esc_attr_x('Search &hellip;',  'placeholder', 'canary'); ?>" value="<?php echo get_search_query();?>" name="s" title="<?php echo esc_attr('Search', 'canary'); ?>" required>
  <button type="submit" class="search-submit"> <span ><?php echo esc_html_x('Search', 'submit button', 'canary'); ?></span> </button>
</form>