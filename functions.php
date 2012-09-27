<?php
// Translations can be filed in the /languages/ directory
load_theme_textdomain( 'soulol', TEMPLATEPATH . '/languages' );	

// Load functions.
require_once(TEMPLATEPATH . '/functions/comments.php');
require_once(TEMPLATEPATH . '/functions/theme-options.php');
require_once(TEMPLATEPATH . '/functions/flickr-widget.php');


if (function_exists('create_initial_post_types')) create_initial_post_types(); //fix for wp 3.0
if (function_exists('add_custom_background')) add_custom_background();
if (function_exists('add_post_type_support')) add_post_type_support( 'page', 'excerpt' );

/* MENUS */
add_action( 'init', 'tj_register_my_menu' );

function tj_register_my_menu() {
   register_nav_menus(
      array(
         'header-pages' => __( 'Header Pages', 'soulol' ),
         'header-cats' => __( 'Header Categories', 'soulol' ),
         'footer-cats' => __( 'Footer Categories', 'soulol' )
      )
   );
}
/* MENUS END */

// Filter to new excerpt length
function tj_excerpt_length( $length ) {
	return 30;
}
add_filter( 'excerpt_length', 'tj_excerpt_length' );

// Filter to new excerpt more text
function tj_excerpt_more($post) {
	return '... <a class="meta-more" href="'. get_permalink($post->ID) . '">'.__('Read more <span class="meta-nav">&raquo;</span>','soulol').'</a>';
}
add_filter('excerpt_more', 'tj_excerpt_more');

// Register Widgets
function tj_widgets_init() {
	
	// Top Widget Area
	register_sidebar( array (
		'name' => __( 'Top Widget Area', 'soulol' ),
		'id' => 'top-widget-area',
		'description' => __( 'The top widget area', 'soulol' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => "</div>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Middle Left Widget Area
	register_sidebar( array (
		'name' => __( 'Middle Left Widget Area', 'soulol' ),
		'id' => 'middle-left-widget-area',
		'description' => __( 'The middle left widget area', 'soulol' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => "</div>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Middle Right Widget Area
	register_sidebar( array (
		'name' => __( 'Middle Right Widget Area', 'soulol' ),
		'id' => 'middle-right-widget-area',
		'description' => __( 'The middle right area', 'soulol' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => "</div>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	// Bottom Widget Area
	register_sidebar( array (
		'name' => __( 'Bottom Widget Area', 'soulol' ),
		'id' => 'bottom-widget-area',
		'description' => __( 'The bottom widget area', 'soulol' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => "</div>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
add_action( 'init', 'tj_widgets_init' );

// Register and deregister Stylesheet and Scripts files	
if(!is_admin()) {
//	add_action( 'wp_print_styles', 'my_deregister_styles', 100 );
	add_action( 'wp_print_scripts', 'my_deregister_scripts', 100 );
}
	
// function my_deregister_styles() {
//	$color_scheme = get_theme_mod('color_scheme');
//	if($color_scheme == 'Brown') 
//		wp_enqueue_style('style-brown',get_bloginfo('template_url').'/style-brown.css');
// }
	
function my_deregister_scripts() {
		wp_deregister_script( 'jquery' );
		
		// wp_enqueue_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js', false, '1.3.2');
		wp_enqueue_script('jquery', get_bloginfo('template_url').'/js/jquery-1.3.2.min.js', false, '1.3.2');
		wp_enqueue_script('jquery-cookie', get_bloginfo('template_url').'/js/jcookie.js', true, '0.1');
		wp_enqueue_script('jquery-carousel', get_bloginfo('template_url').'/js/jcarousellite.js', true, '1.0.1');
		wp_enqueue_script('jquery-superfish', get_bloginfo('template_url').'/js/superfish.js', true, '1.0');
		wp_enqueue_script('jquery-global', get_bloginfo('template_url').'/js/global.js', true, '1.0');
		wp_enqueue_script('loopedslider', get_bloginfo('template_url').'/js/loopedslider.js', true, '0.5.6');

		if ( is_singular() && get_option('thread_comments') ) wp_enqueue_script( 'comment-reply' );
	}

// Pagenavi
function tj_pagenavi($range = 9) {
	global $paged, $wp_query;
	if ( !$max_page ) { $max_page = $wp_query->max_num_pages;}
	if($max_page > 1){
		echo '<div class="pagenavi clear">';
		if(!$paged){$paged = 1;}
		echo '<span>'.$paged.' / '.$max_page.'</span>';
		previous_posts_link('&laquo; Previous');
		if($max_page > $range){
			if($paged < $range){
				for($i = 1; $i <= ($range + 1); $i++){
					echo "<a href='" . get_pagenum_link($i) ."'";
					if($i==$paged) echo " class='current'";
					echo ">$i</a>";

				}
			} elseif($paged >= ($max_page - ceil(($range/2)))){
				for($i = $max_page - $range; $i <= $max_page; $i++){
					echo "<a href='" . get_pagenum_link($i) ."'";
					if($i==$paged) echo " class='current'";
					echo ">$i</a>";
				}
			} elseif($paged >= $range && $paged < ($max_page - ceil(($range/2)))){
				for($i = ($paged - ceil($range/2)); $i <= ($paged + ceil(($range/2))); $i++){
					echo "<a href='" . get_pagenum_link($i) ."'";
					if($i==$paged) echo " class='current'";
					echo ">$i</a>";
				}
			}
		} else {
			for($i = 1; $i <= $max_page; $i++){
				echo "<a href='" . get_pagenum_link($i) ."'";
				if($i==$paged) echo " class='current'";
				echo ">$i</a>";
			}
		}
		next_posts_link('Next &raquo;');
		echo '</div>';
	}
}

// Breadcrumb
function tj_breadcrumb() {
	 $delimiter = '';
  $name = '首页'; //text for the 'Home' link
  $currentBefore = '<span class="current">';
  $currentAfter = '</span>';
	echo '您的位置:';
 
    global $post;
    $home = get_bloginfo('url');
   
	if(is_home() && get_query_var('paged') == 0) 
		echo '<span class="home">' . $name . '</span>';
	else
		echo '<a class="home" href="' . $home . '">' . $name . '</a> '. $delimiter . ' ';
 
    if ( is_category() ) {
      global $wp_query;
      $cat_obj = $wp_query->get_queried_object();
      $thisCat = $cat_obj->term_id;
      $thisCat = get_category($thisCat);
      $parentCat = get_category($thisCat->parent);
      if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
      echo $currentBefore;
      single_cat_title();
      echo $currentAfter;
 
    } elseif ( is_day() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
      echo $currentBefore . get_the_time('d') . $currentAfter;
 
    } elseif ( is_month() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo $currentBefore . get_the_time('F') . $currentAfter;
 
    } elseif ( is_year() ) {
      echo $currentBefore . get_the_time('Y') . $currentAfter;
 
    } elseif ( is_single() ) {
      $cat = get_the_category(); $cat = $cat[0];
      echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
      echo $currentBefore;
      the_title();
      echo $currentAfter;
 
    } elseif ( is_page() && !$post->post_parent ) {
      echo $currentBefore;
      the_title();
      echo $currentAfter;
 
    } elseif ( is_page() && $post->post_parent ) {
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
        $parent_id  = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
      echo $currentBefore;
      the_title();
      echo $currentAfter;
 
    } elseif ( is_search() ) {
      echo $currentBefore . 'Search for ' . get_search_query() . $currentAfter;
 
    } elseif ( is_tag() ) {
      echo $currentBefore;
      single_tag_title();
      echo $currentAfter;
 
    } elseif ( is_author() ) {
       global $author;
      $userdata = get_userdata($author);
      echo $currentBefore. $userdata->display_name . $currentAfter;
 
    } elseif ( is_404() ) {
      echo $currentBefore . 'Error 404' . $currentAfter;
    }
 
    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
      echo $currentBefore . __('Page') . ' ' . get_query_var('paged') . $currentAfter;
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    }
 

}

// Get image attachment (sizes: thumbnail, medium, full)
function get_thumbnail($postid=0, $size='full') {
	if ($postid<1) 
	$postid = get_the_ID();
	$thumb_key = get_theme_mod('thumb_key');
	if($thumb_key)
		$thumb_key = $thumb_key;
	else
		$thumb_key = 'thumb';
	$thumb = get_post_meta($postid, $thumb_key, TRUE); // Declare the custom field for the image
	if ($thumb != null or $thumb != '') {
		return $thumb; 
	} elseif ($images = get_children(array(
		'post_parent' => $postid,
		'post_type' => 'attachment',
		'numberposts' => '1',
		'post_mime_type' => 'image', ))) {
		foreach($images as $image) {
			$thumbnail=wp_get_attachment_image_src($image->ID, $size);
			return $thumbnail[0]; 
		}
	} else {
		return get_bloginfo ( 'stylesheet_directory' ).'/images/default_thumb.gif';
	}
	
}

// Automatically display/resize thumbnail
function tj_thumbnail($width, $height) {
	echo '<a href="'.get_permalink($post->ID).'" rel="bookmark"><img src="'.get_bloginfo('template_url').'/timthumb.php?src='.get_thumbnail($post->ID, 'full').'&amp;h='.$height.'&amp;w='.$width.'&amp;zc=1" alt="'.get_the_title().'" /></a>';
}

// Get limit excerpt
function tj_content_limit($max_char, $more_link_text = '', $stripteaser = 0, $more_file = '') {
    $content = get_the_content($more_link_text, $stripteaser, $more_file);
    $content = apply_filters('the_content', $content);
    $content = str_replace(']]>', ']]&gt;', $content);
    $content = strip_tags($content);

   if (strlen($_GET['p']) > 0) {
      echo "";
      echo $content;
      echo "...";
   }
   else if ((strlen($content)>$max_char) && ($espacio = strpos($content, " ", $max_char ))) {
        $content = substr($content, 0, $espacio);
        $content = $content;
        echo "";
        echo $content;
        echo "...";
   }
   else {
      echo "";
      echo $content;
   }
}


// Return number of posts in a Archive Page
function tj_current_postnum() {
	global $wp_query;
	$request = $wp_query->request;
	$posts_per_page = intval(get_query_var('posts_per_page'));
	$paged = intval(get_query_var('paged'));
	$numposts = $wp_query->found_posts;
	$max_page = $wp_query->max_num_pages;
	if(empty($paged) || $paged == 0) $paged = 1;
	if (!is_404()) 
		$begin_postnum = (($paged-1)*$posts_per_page)+1; 
	else 
		$begin_postnum = '0';
	if ($paged*$posts_per_page < $numposts) 
		$end_postnum = $paged*$posts_per_page; 
	else 
		$end_postnum = $numposts;
	$current_page_postnum = $end_postnum-$begin_postnum+1;
	return $current_page_postnum;
}

// Tabber: Get Most Popular Posts
function tj_tabs_popular( $posts = 5, $size = 35 ) {
	$popular = new WP_Query('caller_get_posts=1&orderby=comment_count&posts_per_page='.$posts);
	while ($popular->have_posts()) : $popular->the_post();
?>
<li class="clear">
 	<?php tj_thumbnail($size, $size); ?>
 	<div class="info">
 	<a title="<?php the_title(); ?>" href="<?php the_permalink() ?>"><?php the_title(); ?></a>
 	<span class="meta"><?php comments_popup_link('还没有评论，快来评论吧', '1 条评论', '% 条评论', 'comments-link', ''); ?></span>
	</div> <!--end .info-->
</li>
<?php endwhile; 
}

function tj_tabs_latest( $posts = 5, $size = 35 ) {
	$the_query = new WP_Query('caller_get_posts=1&showposts='. $posts .'&orderby=post_date&order=desc');	
	while ($the_query->have_posts()) : $the_query->the_post(); 
?>
<li class="clear">
	<?php if ($size <> 0) ?>
	<?php tj_thumbnail($size, $size);?>
	<div class="info">
	<a title="<?php the_title(); ?>" href="<?php the_permalink() ?>"><?php the_title(); ?></a>
	<span class="meta"><?php the_time('F j, Y'); ?></span>
	</div> <!--end .info-->
</li>
<?php endwhile; 
}

// Tabber: Get Recent Comments
function tj_tabs_comments( $posts = 5, $size = 35 ) {
	global $wpdb;
	$sql = "SELECT DISTINCT ID, post_title, post_password, comment_ID,
	comment_post_ID, comment_author, comment_author_email, comment_date_gmt, comment_approved,
	comment_type,comment_author_url,
	SUBSTRING(comment_content,1,65) AS com_excerpt
	FROM $wpdb->comments
	LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID =
	$wpdb->posts.ID)
	WHERE comment_approved = '1' AND comment_type = '' AND
	post_password = ''
	ORDER BY comment_date_gmt DESC LIMIT ".$posts;
	
	$comments = $wpdb->get_results($sql);
	
	foreach ($comments as $comment) {
	?>
	<li class="clear">
		<?php echo get_avatar( $comment, $size ); ?>
	
		<a href="<?php echo get_permalink($comment->ID); ?>#comment-<?php echo $comment->comment_ID; ?>" title="<?php _e('on ', 'soulol'); ?> <?php echo $comment->post_title; ?>">
			<span class="comment-author"><?php echo strip_tags($comment->comment_author); ?>:</span> <span class="comment-excerpt"><?php echo strip_tags($comment->com_excerpt); ?>...</span>
		</a>
	</li>
	<?php 
	}
}

?>