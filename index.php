<?php /**
 * Canary Archives file
 *
 * @category WordPress
 * @package  Canary
 * @author   Linesh Jose <lineshjos@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://linesh.com/projects/canary/
 * */
/* Template Name: Archives */
 get_header(); 
?>
<main id="main" class="site-main alignleft content-area archives <?php if(!canary_active_sidebars()){ echo 'full-width';}?>" role="main">
  <?php if ( have_posts() ) { 
			if(is_author()){
        ?>
    <header class="page-header">
    <div class="author-info">
      <div class="author-avatar"> <?php echo get_avatar(get_the_author_meta('user_email'), apply_filters( 'linesh_author_bio_avatar_size',100) );?> </div>
      <div class="author-description">
        <h1 class="author-title"><?php echo esc_html(get_the_author_meta('display_name'));?></h1>
        <?php if($desc=get_the_author_meta('description')) {
        echo '<div class="author-bio">'.esc_html($desc).'</div>';
        } ?>
        <?php canary_author_metas(get_the_author_meta('ID')); ?>
      </div>
      <div class="clear"></div>
    </div>
    <h3 class="page-title screen-reader-text"><?php echo esc_html(get_the_author_meta('display_name'));?>
      <?php esc_html_e( '\'s Posts', 'canary' );?>
    </h3>
  </header>
  <?php }else if ( !is_home() && !is_front_page() ){?>
  <header class="page-header">
    <?php if(is_search()) {?>
    <h1 class="page-title">
      <?php
			 /* translators: %s: Search query */
			 printf( esc_html__( 'Searching for: "%s"', 'canary' ), get_search_query() );?>
    </h1>
    <?php }else{
			  the_archive_title( '<h1 class="page-title">', '</h1>' );
			  the_archive_description( '<div class="taxonomy-description">', '</div>' );
		  } ?>
  </header>
  <?php
		}
	while ( have_posts() ) : the_post();
		get_template_part( 'content');
	endwhile;
	// Pagination
	the_posts_pagination( array(
				'mid_size' => 5,
				'prev_text'          => esc_html__( 'Previous page', 'canary' ),
				'next_text'          => esc_html__( 'Next page', 'canary' ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page:', 'canary' ) . ' </span>',
				'screen_reader_text' =>  esc_html__( 'Pagination', 'canary' ) 
	) );
}else {
		get_template_part( 'content', 'none' );
};
?>
  <div class="clear"></div>
</main>
<?php get_sidebar();?>
<?php get_footer(); ?>