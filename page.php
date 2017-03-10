<?php /** 
 * Canary single page file
 *
 * @category WordPress
 * @package  Canary
 * @author   Linesh Jose <lineshjos@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://linesh.com/projects/canary/
 *
 */
?>
<?php get_header(); ?>
<main id="main" class="site-main alignleft single-page <?php if(!canary_active_sidebars()){ echo 'full-width';}?>" role="main">
  <?php 
  while ( have_posts() ) : the_post(); 
    get_template_part( 'content');	
  endwhile; 
  ?>
</main>
<?php get_sidebar();?>
<?php get_footer(); ?>