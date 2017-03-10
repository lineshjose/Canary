<?php /**
 * More Functions file
 *
 * @category WordPress
 * @package  Canary
 * @author   Linesh Jose <lineshjos@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://linesh.com/projects/canary/
 *
 */

// Page nvaigation template  ----------->
add_filter('navigation_markup_template','canary_navigation_template');
function canary_navigation_template(){
	return $template = '
    <nav class="navigation %1$s" role="navigation">
        <h2 class="screen-reader-text">%2$s</h2>
        <div class="nav-links">%3$s
			<div class="clear"></div>
		</div>
    </nav>';
}


// checking for active sidebar  ----------->
function canary_active_sidebars(){
	foreach(canary_sidebars() as $sidebar){
		if ( is_active_sidebar($sidebar['id']) ) {
			return true ;
		}else{
			continue;
		}
	}
	return false;
}


// Adding body class --------------->
	add_filter( 'body_class', 'canary_body_classes' );
	function canary_body_classes( $classes ) {
		if ( get_background_image() ) { // Adds a class of custom-background-image to sites with a custom background image.
			$classes[] = 'custom-background-image';
		}
		if ( is_multi_author() ) { // Adds a class of group-blog to sites with more than 1 published author.
			$classes[] = 'group-blog';
		}
		if ( ! is_active_sidebar( 'sidebar-1' ) ) {// Adds a class of no-sidebar to sites without active sidebar.
			$classes[] = 'no-sidebar';
		}
		if ( ! is_singular() ) {// Adds a class of hfeed to non-singular pages.
			$classes[] = 'hfeed';
		}
		return $classes;
	}


// Handles JavaScript detection.Adds a `js` class to the root `<html>` element when JavaScript is detected. --------------->
	add_action( 'wp_head', 'canary_javascript_detection', 0 );
	function canary_javascript_detection() {
		echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
	}


// Add a `screen-reader-text` class to the search form's submit button. --------------->
	add_filter( 'get_search_form', 'canary_search_form_modify' );
	function canary_search_form_modify( $html ) {
		return str_replace( 'class="search-submit"', 'class="search-submit screen-reader-text"', $html );
	}

// Post entery metas --------------->
	function canary_entry_meta()
	{
		echo '<ul>';
		// sticky post ------------->	
		if ( is_sticky() && is_home() && ! is_paged() ) {
			echo '<li class="sticky-post"><i class="fa fa-bookmark"></i>'.esc_html__( 'Featured', 'canary' ).'</li>';
		}
	
		// post format ------------->
		$format = get_post_format();
		$formats_class=array(	
				'aside'=>'file-text',
				'image'=>'image',
				'video'=>'video-camera',
				'quote'=>'quote-left', 
				'link'=>'link',
				'gallery'=>'image',
				'status'=>'thumb-tack', 
				'audio'=>'music',
				'chat'=>'commenting-o',
			 );
		
		if ( current_theme_supports( 'post-formats', $format ) ) {
			echo '<li class="entry-format '.esc_attr($format).'">
			<i class="fa fa-'.esc_attr($formats_class[$format]).'"></i>
			<span class="screen-reader-text">'.esc_html__( 'Format:','canary' ) .'</span>
			<a href="'.esc_url(get_post_format_link($format)).'" title="'.esc_attr($format).' post">'.esc_html(get_post_format_string( $format )).'</a></li>';
		}
	
		// Time ------------->
		echo '<li class="posted-on">
				<i class="fa fa-calendar"></i>
				<span class="screen-reader-text">'.esc_html__( 'Posted on:', 'canary' ).'</span>
				<a href="'.esc_url( get_permalink()).'" rel="bookmark">
					<time class="entry-date published" datetime="'.esc_attr(get_the_date('c')).'">'.get_the_date().'</time>
					<time class="updated screen-reader-text" datetime="'.esc_attr( get_the_modified_date( 'c' ) ).'">'. esc_html(get_the_modified_date()).'</time>
				</a>
			</li>';
		

	
		// Author ---->
		echo '<li class="byline author vcard">
				<i class="fa fa-user"></i>
				<span class="screen-reader-text">'. esc_html__( 'Author:', 'canary' ).'</span>
				<a class="url fn n" href="'.esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ).'">'.esc_html(get_the_author()).'</a>
			</li>';
	  
		// categories ---->
		$categories_list = get_the_category_list( ', ' );
		if ( $categories_list && canary_categorized_blog() ) {
			echo '<li class="cat-links">
				<i class="fa fa-folder-open"></i>
				<span class="screen-reader-text">'. esc_html__( 'Categories:', 'canary' ).'</span>
				'.ent2ncr($categories_list).'
			</li>';
		}
	
		// tags ---->
		$tags_list = get_the_tag_list( '', ', ' );
		if ( $tags_list ) {
			echo '<li class="tag-links">
				<i class="fa fa-tags"></i>
				<span class="screen-reader-text">'. esc_html__( 'Tags:', 'canary' ).'</span>
				'.ent2ncr($tags_list).'
			</li>';
		}
	
		// attachemnt ---->
		if ( is_attachment() && wp_attachment_is_image() ) {
			// Retrieve attachment metadata.
			$metadata = wp_get_attachment_metadata();
			echo '<li class="full-size-link">
				<i class="fa fa-link"></i>
				<span class="screen-reader-text">'.esc_html__( 'Full size link:', 'canary' ).'</span>
				<a href="'.esc_url( wp_get_attachment_url() ).'">'.esc_html($metadata['width']).' &times; '.esc_html($metadata['height']).'</a>
			</li>';
		}
	
		// Comments ---->
		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<li class="comment">
				<i class="fa fa-comments"></i>';
				comments_popup_link(esc_html__( 'Leave a comment', 'canary' ).'<span class="screen-reader-text">:&nbsp;'.get_the_title().'</span>');
			echo '</li>';
		}
	
		// Edit Link ---->
		edit_post_link( esc_html__( 'Edit', 'canary' ), '<li class="edit-link"><i class="fa fa-pencil"></i>', '</li>' ); 
		echo '</ul>';
	}
	
	function canary_categorized_blog()
	{
		if ( false === ( $all_the_cool_cats = get_transient( 'canary_categories' ) ) ) {
			// Create an array of all the categories that are attached to posts.
			$all_the_cool_cats = get_categories( array(
			  'fields'     => 'ids',
			  'hide_empty' => 1,
			  'number'     => 2,
			));
			// Count the number of categories that are attached to the posts.
			$all_the_cool_cats = count( $all_the_cool_cats );
			set_transient( 'canary_categories', $all_the_cool_cats );
		}
		if ( $all_the_cool_cats > 1 ) {
			// This blog has more than 1 category so canary_categorized_blog should return true.
			return true;
		} else {
			// This blog has only 1 category so canary_categorized_blog should return false.
			return false;
		}
	}
	function canary_category_transient_flusher() {
		delete_transient( 'canary_categories' );
	}
	add_action( 'edit_category', 'canary_category_transient_flusher' );
	add_action( 'save_post',   'canary_category_transient_flusher' );


// Post featured image --------------->
	function canary_post_thumbnail($size=''){
		$size=trim($size);
		if(has_post_thumbnail()){ 
			echo '<div class="entry-thumbnail"><a class="" href="'.esc_url(get_the_permalink()).'" aria-hidden="true">';
			the_post_thumbnail( $size, array( 'alt' => get_the_title() ) );
			echo '</a></div>';
		}
	}


// Excerpt more --------------->
	add_filter( 'excerpt_more', 'canary_excerpt_more' );
	function canary_excerpt_more( $more ) {
		if(! is_admin()){
			 /* translators: %s: Name of current post */
			$link = sprintf( '<span class="clear"></span><a href="%1$s" class="more-link read-more" rel="bookmark">%2$s</a>',esc_url( get_permalink( get_the_ID() ) ),sprintf( esc_html__( 'Continue Reading %s', 'canary' ), '<span class="screen-reader-text">'.get_the_title( get_the_ID() ).'</span><i class="fa fa-arrow-right"></i>' ));
			return '&hellip; ' . $link;
		}
	}

// Excerpt character length --------------->
	add_filter( 'excerpt_length', 'canary_custom_excerpt_length', 999 );
	function canary_custom_excerpt_length( $length ) {
		return 50;
	}


// Home page validation --------------->
	function canary_is_home_page(){
		if ( is_home() && is_front_page()) { 
			return true;
		}else{
			return false;	
		}
	}


// Displays the optional custom logo --------------->
	function canary_the_custom_logo() 
	{

		if ( function_exists( 'the_custom_logo' )  && has_custom_logo() ) {

				echo ' <div class="site-branding logo-active">';
				the_custom_logo();
			}else{
				echo ' <div class="site-branding">';
				if(canary_is_home_page()){
					echo '<h1 class="site-title"><a href="'.esc_url( home_url( '/' ) ).'" rel="home">'.esc_html(get_bloginfo( 'name' )).'</a></h1>';
				} else{
					echo '<p class="site-title"><a href="'.esc_url( home_url( '/' ) ).'" rel="home">'.esc_html(get_bloginfo( 'name' )).'</a></p>';
				}
			}
			
			if ( $description = get_bloginfo( 'description', 'display' )){
	       		/*if( !is_customize_preview()){
					$class="says";
				}*/
				echo '<p class="site-description">'.esc_html($description).'</p>';
       		}
      		echo '</div>';
		}


// Author's meta ----------------> 	
	function canary_author_metas($author_id)
	{
		echo '<div class="author-metas">';
		
		if($post_count=count_user_posts($author_id)) { 
			echo '<a href='.esc_url(get_author_posts_url($author_id)).' title="'.esc_attr($post_count).' '.esc_attr('Posts', 'canary' ).'" class="posts"><i class="fa fa-thumb-tack"></i><span>'.esc_html($post_count).'</span></a>';
		}
		if($website=esc_url(get_the_author_meta('url',$author_id)) ){
			 echo '<a href="'.esc_url($website).'" rel="noopener" target="_blank" class="social web" title="'. esc_attr( 'Author\'s Website', 'canary' ).'"><i class="fa fa-globe"></i><span>'. esc_html__( 'Website', 'canary' ).'</span></a>';
		}
		echo '<a href="'.esc_url(get_author_feed_link($author_id )).'" rel="noopener"  title="'.esc_attr( 'Subscribe RSS Feed', 'canary' ).'" target="_blank" class="social rss"><i class="fa fa-rss"></i><span>'.esc_html__( 'RSS Feed', 'canary' ).'</span></a>';
		echo '<div class="clear"></div>
		</div>';
	}
	
// Archive title ----------------------->
	add_filter('get_the_archive_title','canary_filter_archive_title');	
	function canary_filter_archive_title($title )
	{
		$rss='';
		if (is_search()){
			$title = '<span>'. esc_html__( 'Searching for:','canary' ).'</span><strong>"'.get_search_query().'"</strong>' ;
			
		}elseif ( is_category() ) {
			$title = '<strong>'.single_cat_title( '', false ).'</strong><span>'. esc_html__( 'Category','canary' ).'</span>' ;
			$rss=get_category_feed_link(get_query_var('cat'));
			
		} elseif ( is_tag() ) {
			$title = '<strong>'.single_tag_title( '', false ).'</strong><span>'. esc_html__( 'Tag Archive','canary' ).'</span>' ;
			$rss=get_tag_feed_link(get_query_var('tag_id')); 
			
		} elseif ( is_author() ) {
			$title = '<strong class="vcard">' . get_the_author() . '</strong><span>'. esc_html__( 'Author','canary' ).'</span>' ;
			$rss= get_author_feed_link(get_the_author_meta('ID'));
			
		} elseif ( is_year() ) {
			$title = '<strong>' .get_the_date( __( 'Y', 'canary' ) )  . '</strong><span>'. esc_html__( 'Yearly Archives','canary' ).'</span>' ;
			
		} elseif ( is_month() ) {
			$title = '<strong>' .get_the_date( __( 'F Y', 'canary' ) )  . '</strong><span>'. esc_html__( 'Monthly Archives ','canary' ).'</span>' ;
			
		} elseif ( is_day() ) {
			$title = '<strong>' .get_the_date( __( 'F j, Y', 'canary' ) )  . '</strong><span>'. esc_html__( 'Daily Archives','canary' ).'</span>' ;
			
		} elseif ( is_post_type_archive() ) {
			$title = '<strong>' .post_type_archive_title( '', false )  . '</strong>' ;
			$rss=get_post_type_archive_feed_link(get_query_var('post_type'));
			
		} elseif ( is_tax() ) {
			$tax = get_taxonomy( get_queried_object()->taxonomy );
			$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
			$title = '<strong>'.single_term_title('', false ).'</strong><span>'.$tax->labels->singular_name.'</span>' ;
			$rss=get_term_feed_link($term->term_id, get_query_var( 'taxonomy' ));
			
		 } else {
			$title ='<strong>'.esc_html__( 'All Posts' ,'canary').'</strong> <span>'.esc_html__( 'Blog Archives:' ,'canary').'</span>';
			$rss=get_bloginfo('rss2_url');
		}
		
		if($title && $rss){
			$title=$title.'<a href="'.$rss.'" title="'.esc_attr(__('Subscribe this','canary')).'" class="subscribe" rel="noopener noreferrer" target="_blank"><i class="fa fa-rss"></i><srong class="">'.esc_html__('Subscribe','canary').'</srong></a>	';
		}
		return $title;
	}
?>