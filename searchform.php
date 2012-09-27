<form method="get" id="searchform" action="<?php bloginfo('url'); ?>">
	<input type="text" class="input-text" name="s" id="s"  value="<?php _e('Search in this site...','soulol'); ?>" onfocus="if (this.value == '<?php _e('Search in this site...','soulol'); ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e('Search in this site...','soulol'); ?>';}" />
	<input id="searchsubmit" type="submit" value="Go" />
</form>