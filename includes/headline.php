<?php $post = $posts[0]; ?>
<div class="headline">
<span class="display" title="<?php _e('Change Layout','soulol'); ?>"><?php _e('List/Grid','soulol'); ?></span>			
<h1>
<?php if (is_category()) : ?>
<?php printf( __('%s', 'soulol' ), get_cat_name($cat) ); ?>

<span class="single-cat-feedlink cat-feedlink"><a href="<?php echo get_category_feed_link($cat, ''); ?>" title="<?php printf(__('订阅 %s','soulol'),get_cat_name($cat)); ?>"><?php printf(__('订阅 %s','soulol'), get_cat_name($cat)); ?></a></span>

<?php elseif( is_tag() ) : ?>	
	<?php printf( __( '按标签归档: <span>%s</span>', 'soulol' ), single_tag_title('',false)); ?>		
	
<?php elseif ( is_search() ) : ?>
	<?php printf( __( '搜索 <span>%s</span>', 'soulol' ), $s ); ?>	
			
<?php elseif ( is_day() ) : ?>
	<?php printf( __( '按日归档: <span>%s</span>', 'soulol' ), get_the_time() ); ?>
				
<?php elseif ( is_month() ) : ?>
	<?php printf( __( '按月归档: <span>%s</span>', 'soulol' ), get_the_time('F Y') ); ?>	
			
<?php elseif ( is_year() ) : ?>
	<?php printf( __( '按年归档: <span>%s</span>', 'soulol' ), get_the_time('Y') ); ?>	
			
<?php elseif (is_author()) : ?>	
	<?php if(get_query_var('author_name')) : $curauth = get_userdatabylogin(get_query_var('author_name')); else : $curauth = get_userdata(get_query_var('author'));	endif; ?>				
	<?php printf( __( '按作者归档: <span>%s</span>', 'soulol' ), $curauth->display_name); ?>	
			
<?php elseif (is_home() && get_query_var('paged') > 0) : ?>
	<?php printf( __( '归档: <span>Page %s</span>', 'soulol' ), $paged ); ?>
	
<?php endif; ?>			
</h1>			
</div> <!--end .headline-->