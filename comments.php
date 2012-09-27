<div id="comments">
	<?php if ( post_password_required() ) : ?>
		<div class="nopassword">
			<?php _e( 'This post is password protected. Enter the password to view any comments.', 'soulol' ); ?>
		</div>
</div> <!--end .comments-->

<?php
	return;
	endif;
?>

<?php
	// You can start editing here -- including this comment!
?>

<?php if ( have_comments() ) : ?>

	<span class="pc-feedlink"><a href="<?php echo get_post_comments_feed_link(); ?>" title="<?php _e('Subscribe to Comments RSS Feed in this post','soulol'); ?>"><?php _e('Subscribe to Comments RSS Feed in this post','soulol'); ?></a></span>
	
	<h3 id="comments-title"><?php printf( _n( '1条评论', '%1$s 条评论', get_comments_number(), 'soulol' ), number_format_i18n( get_comments_number() )); ?></h3>

	<?php if ( get_comment_pages_count() > 1 ) : // are there comments to navigate through ?>
		<div class="navigation">
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'soulol' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'soulol' ) ); ?></div>
		</div> <!--navigation-->
	<?php endif; // check for comment navigation ?>

	<ol class="commentlist">
		<?php wp_list_comments( array( 'callback' => 'tj_custom_comment', 'type' => 'comment' ) ); ?>
	</ol>
			
	<?php if ( ! empty($comments_by_type['pings']) ) : // Begin Pings Loop ?>
		<h3 id="pings"><?php _e('Pingbacks/Trackbacks','soulol'); ?></h3>
			<ul class="pinglist">
				<?php wp_list_comments( array( 'callback' => 'tj_custom_comment', 'type' => 'pings' ) ); ?>
			</ul>
	<?php endif; // End Pings Loop ?>

	<?php if ( get_comment_pages_count() > 1 ) : // are there comments to navigate through ?>
		<div class="navigation">
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'soulol' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'soulol' ) ); ?></div>
		</div> <!--end .navigation-->
	<?php endif; // check for comment navigation ?>

<?php else : // this is displayed if there are no comments so far ?>

<?php if ( comments_open() ) : // If comments are open, but there are no comments ?>

<?php else : // if comments are closed ?>

	<p class="nocomments"><?php _e( 'Comments are closed.', 'soulol' ); ?></p>

<?php endif; ?>
<?php endif; ?>

<?php tj_comment_form(); ?>

</div><!-- #comments -->
