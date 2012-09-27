<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-thumb">
		<?php tj_thumbnail(get_theme_mod('thumb_width'),get_theme_mod('thumb_height')); ?>
	</div> <!--end .entry-thumb-->
	
	<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'soulol' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
	
	<div class="entry-meta">
		<span class="meta-date"><?php the_time(get_option('date_format')); ?></span>
		<span class="meta-sep">|</span>
		<span class="meta-comments"><?php comments_popup_link( __( '0 Comment', 'soulol' ), __( '1 Comment', 'soulol' ), __( '% Comments', 'soulol' ) ); ?></span>
	</div> <!--end .entry-meta-->
	
	<div class="entry-excerpt">
		<?php the_excerpt(''); ?>
	</div> <!--end .entry-excerpt-->
	
</div> <!-- end #post -->