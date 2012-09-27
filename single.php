<?php get_header(); ?>

<div id="container">
	<div id="content">
		<?php the_post(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<h1 class="entry-title"><?php the_title(); ?></h1>
			
			<div class="entry-meta">
				<span class="meta-author"><?php _e('Posted by','soulol'); ?> <?php the_author_posts_link(); ?></span>
				<span class="meta-date"><?php _e( 'on ', 'soulol' ); ?><?php the_time(get_option('date_format')); ?></span>
				<span class="meta-cat"><?php _e( 'in ', 'soulol' ); ?><?php the_category( ', ' ); ?></span>
				<span class="meta-View">浏览:<?php the_views(); ?></span>
				<span class="meta-sep">|</span>
				<span class="meta-comments"><?php comments_popup_link( __( '0 Comment', 'soulol' ), __( '1 Comment', 'soulol' ), __( '% Comments', 'soulol' ) )	; ?></span>
				<?php edit_post_link( __( 'Edit', 'soulol' ), '<span class="meta-edit right">', '</span>' ); ?>
			</div> <!--end .entry-meta-->

			<div class="entry entry-content">
				<?php the_content(); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'soulol' ), 'after' => '</div>' ) ); ?>
			</div> <!--end .entry-->

			<?php printf(the_tags(__('<div id="entry-tags"><span>标签:</span>&nbsp;','soulol'),', ','</div>')); ?>

			<?php if(get_theme_mod('display_author_info') == 'Yes') { ?>
			<div id="entry-author" class="clear">
				<div id="author-avatar">
					<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'soulol_author_bio_avatar_size', 60 ) ); ?>
				</div> <!--end .author-avatar-->
				<div id="author-description">
					<h3><?php _e( 'About ', 'soulol' ); ?><?php the_author(); ?></h3>
					<?php the_author_meta( 'description' ); ?>
					<div id="author-link">
						<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" title="<?php printf( esc_attr__( '阅读全部日志 %s', 'soulol' ), get_the_author() ); ?>"><?php _e( '阅读全部日志 ', 'soulol' ); ?><?php the_author(); ?> &rarr;</a>
					</div> <!--end .author-link-->
				</div> <!--end .author-description-->
			</div> <!--end .entry-author-->
			<?php } ?>
		</div>
		
		<?php comments_template( '', true ); ?>
	</div><!--end #content -->
</div><!--end #container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
