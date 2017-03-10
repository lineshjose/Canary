<?php /**
 * Canary single post file
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
<main id="main" class="site-main alignleft single-post <?php if(!canary_active_sidebars()){ echo 'full-width';}?>" role="main">
  <?php 
    while ( have_posts() ) : the_post(); 
		get_template_part( 'content');	
    endwhile; 
    if ( comments_open() || get_comments_number() ) {comments_template(); }
    ?>
</main>
<?php get_sidebar();?>
<?php get_footer(); ?>