<div id="tab-sidebar">

	<div class="widget" id="view-posts">
		<h3 class="widget-title"><?php _e('排行', 'soulol'); ?></h3>
		<ul>
            <?php if (function_exists('get_most_viewed')): ?>
            <?php get_most_viewed('post',11); ?>
            <?php endif; ?>
		</ul>			
	 </div> <!--end #view-posts-->
		       
	<div class="widget" id="popular-posts">
		<h3 class="widget-title"><?php _e('热点', 'soulol'); ?></h3>
		<ul>
			<?php tj_tabs_popular(get_theme_mod('tabber_popular_num'), get_theme_mod('tabber_thumb')); ?>                    
		</ul>			
	 </div> <!--end #popular-posts-->
		    
	<div class="widget" id="recent-comments">
		<h3 class="widget-title"><?php _e('评论', 'soulol'); ?></h3>
		<ul>
			<?php tj_tabs_comments(get_theme_mod('tabber_popular_num'), get_theme_mod('tabber_thumb')); ?>                    
		</ul>
	</div> <!--end #recent-comments-->
		      
	<div class="widget widget_tag_cloud">
		<h3 class="widget-title"><?php _e('标签', 'soulol'); ?></h3>
		<div>
		<?php wp_tag_cloud('unit=px&smallest=12&largest=20'); ?>
		</div>
	</div> <!--end #tag-cloud-->
	
</div> <!--end #tab-sidebar-->