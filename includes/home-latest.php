<div id="latest">
	<h3><?php _e('Latest News','soulol'); ?></h3>
	<ul>
		<?php 
			if(get_theme_mod('home_latest_from') == 'All Categories')
				query_posts('showposts='.get_theme_mod('home_latest_num').'&caller_get_posts=1');
			else 
				query_posts('cat='.get_theme_mod('home_latest_cat').'&showposts='.get_theme_mod('home_latest_num').'&caller_get_posts=1');
				while(have_posts()) : the_post();
		?>
		<li>
			<span class="postdate"><?php the_time('m/d') ?></span>
			<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'soulol' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
		</li>
			<?php endwhile; wp_reset_query(); ?>
	</ul>
		
	<?php 
		$permalink_structure = get_option('permalink_structure'); 
		echo '<p class="more"><a href="'.get_bloginfo('url');
		if($permalink_structure == '') 
			echo  '/?paged=2';
		else 
			echo '/page/2/';
		echo '" title="">';
		_e('More latest news &raquo;','soulol');
		echo '</a></p>';
	?>
</div> <!--end #latest-->