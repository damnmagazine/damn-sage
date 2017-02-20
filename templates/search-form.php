<div class="search-large">
	<form role="search" method="get" class="search-form form-inline" action="<?= esc_url(home_url('/')); ?>">
		<label class="sr-only"><?php _e('Search for:', 'sage'); ?></label>
		
		<div class="input-group input-group-lg">
			<input type="search" value="<?= get_search_query(); ?>" name="s" class="search-field form-control" placeholder="<?php _e('Search', 'sage'); ?> <?php bloginfo('name'); ?>" required autofocus>
			<span class="input-group-btn">
				<button type="submit" class="search-submit btn btn-default"><i class="ion-ios-search"></i></button>
			</span>
		</div>
	</form>
</div>