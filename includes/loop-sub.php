<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<h2 class="entry-title"><?php the_category(); ?><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'soulol' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
	
</div> <!-- end #post -->