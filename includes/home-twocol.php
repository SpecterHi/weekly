<div class="twocol">

	<?php        
	    $categories = get_categories('parent=0&orderby=id&include='.get_theme_mod('home_twocol_cats'));
	    $catcount = 0;
		
		echo '<div class="catbox-row clear">';
	    foreach ($categories as $cat) {
			echo '<div id="catbox2-'.$catcount.'" class="catbox';
			if(is_int($catcount/2)) echo ' catbox-even'; else echo ' catbox-odd';
			echo '">';
			
			if(get_theme_mod('home_twocol_feedlink') == 'Yes') {
				echo '<span class="cat-feedlink"><a href="'.get_category_feed_link($cat->cat_ID, '').'" title="';
				printf(__('订阅 %s','soulol'),$cat->cat_name);
				echo '">';
				printf(__('订阅 %s','soulol'),$cat->cat_name);
				echo '</a></span>';
			}
			
			echo '<h3 class="catbox-title"><a href="'.get_category_link($cat->cat_ID).'" title="View all posts under '.$cat->cat_name.'">'.$cat->cat_name.'</a></h3>';
			
			echo '<ul>';
	        query_posts('showposts='.get_theme_mod('home_twocol_num').'&cat='.$cat->cat_ID);
	        $postcount = 0;
	        while (have_posts()) : the_post();
	            global $post;
				if($postcount == 0 ) {  ?>
					<li class="first">
						<div class="entry-thumb">
							<?php tj_thumbnail(get_theme_mod('twocol_thumb_width'),get_theme_mod('twocol_thumb_height')); ?>
						</div> <!--end .entry-thumb-->
						
						<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'soulol' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
						
						<div class="entry-meta">
						<div class="clear:after"></div>
							<span class="meta-date"><?php the_time(get_option('date_format')); ?></span>
						</div> <!--end .entry-meta-->
					</li> <!--end .first-->
					<div class="clear:after"></div>
				<?php } else {
	                echo '<li class="catlist"><a href="'.get_permalink($post->ID).'" rel="bookmark">'.$post->post_title.'</a></li>';
	            }
	            $postcount++;
	        endwhile;
			wp_reset_query();
			echo '</ul></div><!--end .catbox-->';
			
			if(!is_int($catcount/2)) echo '</div><div class="catbox-row clear">';
			$catcount++;
	    }
		echo '</div><!--end .catbox-row-->';
	?>
	
	<div class="clear"></div>
	
</div> <!--end .twocol-->