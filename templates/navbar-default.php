<nav class="navbar navbar-default navbar-static-top">
	<div class="container">
		<!-- Mobile View -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#primary-navigation" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="ion-ios-drag"></span>
			</button>
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#search-bar" aria-expanded="false">
				<span class="sr-only">Search</span>
				<span class="ion-ios-search"></span>
			</button>
			<!--<a class="navbar-brand" href="/">
				<img alt="Brand" src="/app/themes/damn-sage/dist/images/damn.svg">
			</a>-->
		</div>
		
		<!-- Desktop View -->
		<?php wp_nav_menu(['theme_location'=> 'primary_navigation', 'container_id'=> 'primary-navigation', 'container_class'=> 'collapse navbar-collapse', 'menu_class'=> 'nav navbar-nav', 'walker'=> new wp_bootstrap_navwalker ()]); ?>
		
	</div>
	
	<div id="search-bar" class="collapse">
		<div class="container">
		<!-- Search field -->
		<?php get_template_part('templates/search-form'); ?>
		</div>
	</div>
</nav>