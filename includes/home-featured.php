<div id="loopedSlider">	

	<div class="container">
	
		<div class="slides">

		<?php 
			$sticky = get_option('sticky_posts'); 
			$home_featured_from = get_theme_mod('home_featured_from');
			$home_featured_num = get_theme_mod('home_featured_num');
			$home_featured_cat = get_theme_mod('home_featured_cat');
			
			if($home_featured_from == 'Sticky Posts') {
				query_posts(array(
					'showposts' => $home_featured_num,
					'post__in' => $sticky,
					'caller_get_posts' => 1 
				)); 
			} else {
				query_posts(array(
					'showposts' => $home_featured_num,
					'cat' => $home_featured_cat,
					'caller_get_posts' => 1 
				)); 
			}
			while(have_posts()) : the_post(); 
			global $wp_query; $maxnum = $wp_query->found_posts;
		 ?>
		 
		 <div id="featured-<?php the_ID(); ?>">
			<p class="featured-thumb">
				<?php tj_thumbnail(280,get_theme_mod('home_featured_thumb_height')); ?>
			</p>
			<h3 class="entry-title">
				<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'soulol' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
			</h3>

			</div> <!--end .slides-->
		 
		 	<?php endwhile; wp_reset_query(); ?>
		 	
		</div> <!--end #post-->

	</div> <!--end .container-->
	
	<ul class="pagination">
	    <?php $i = 1; $home_featured_num = get_theme_mod('home_featured_num'); while($i <= $home_featured_num) : echo '<li><a href="#">'; echo $i; echo '</a></li>'; $i++;?>
        <?php endwhile; ?>
	</ul>	

</div> <!--end #loopslider-->

<script type="text/javascript" charset="utf-8">
	$(function(){
		$('#loopedSlider').loopedSlider();
	});
</script>
    