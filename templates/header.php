<?php
global $issue, $contrast, $issue_color, $issue_number, $header_subtitle, $header_image;

// Issue numbers
$latest        = get_field ('current_issue', 'option');
$latest_acf_id = 'magazine_' . $latest->term_id;
$latest_number = (int) get_field ('magazine_number', $latest_acf_id);
$history       = -10;

?>
<style type="text/css" media="screen">
	/**
	 * Style all colors based on issue # color
	 */ 
	a, a:visited, .nav a span, .issue-number { color: <?=$issue_color?>; }
	
	a.mobile-menu .fa, .advertorial-badge, span.category-sep a.damn-plus, .issue-selector li.active { color: <?=$issue_color?> !important; }
	
	.btn-default, .btn-primary, body.damn-plus .title-wrapper, body.category-damn-plus .title-wrapper, body.login .main h3.widget-title, .back-to-calendar a.btn-primary, .article-navigation .pagination li span.current, .color-box, .damn-plus-badge, .join-damn-plus-home-image, .damn-plus-cta, .page-featured-image, .item.damn-plus .news-item, .single-news-item, .first-post-advert-wrapper .blackBackground, .category-link .damn-plus, .category-link .damn-plus:hover, .plus-select .post-image, #search-bar { background-color: <?=$issue_color?> !important; }
	
	.category-link .damn-plus { border-color: <?=$issue_color?> !important; }
</style>

<header <?=$contrast? 'class="positive-contrast" ': null?>style="background-image: url(<?=$header_image?>);">
	
	<div class="container">
		
		<div class="pull-right social-navs">
		<?php
		if (has_nav_menu('header_socials'))
			wp_nav_menu(['theme_location' => 'header_socials', 'menu_class' => 'social-nav navbar-nav']);
		?>
		</div>
		
		<div class="logo-container">
			<a class="main-logo" href="/"></a>
			
			<div class="issue-selector">
				<ul class="issue-list">
				<?php for ($n = 0; $n >= $history; $n--): $current = $latest_number + $n; ?>
					
					<?php if($current == (int) $issue_number): ?>
						
						<li class="active"><?=$current?></li>
						
					<?php else: ?> 	
					
						<li><a href="?issue=damn-<?=$current?>"><?=$current?></a></li>
				
				<?php endif; endfor; ?>
				</ul>
			</div>
			<div class="issue-buttons">
				<?php if($latest_number == (int) $issue_number): ?>
					<div class="fa fa-chevron-up inactive"></div>
				<?php else: ?>
					<a href='?issue=damn-<?=(int) $issue_number + 1?>'><div class="fa fa-chevron-up"></div></a>
				<?php endif; ?>
				
				<?php if((int) $issue_number <= $latest_number + $history): ?>
					<div class="fa fa-chevron-down inactive"></div>
				<?php else: ?>
					<a href='?issue=damn-<?=(int) $issue_number - 1?>'><div class="fa fa-chevron-down"></div></a>
				<?php endif; ?>
			</div>
			
			<script lang="text/javascript">
				
				var pos = jQuery('.issue-list li.active').position();
				jQuery('.issue-list').css('left', -pos.left + 'px');
				
			</script>
			
			<?php if (is_home()): ?>
			<h3 class="subtitle"><?=$header_subtitle?></h3>
			<?php endif; ?>
		</div>
		
		<!--<a class="mobile-menu no-badge normal-menu" data-count="0" href="#my-menu"><i class="fa fa-bars"></i></a>-->
		
	</div>
	
	<div class="fixed-nav-activator clearthis"></div>
</header>

<!--<div class="white-wrapper">-->
	<?php get_template_part('templates/navbar-default'); ?>
<!--</div>-->

<?php /* 
<nav id="my-menu" style="display:none;">
	<?php
	// Mobile nav
	if (has_nav_menu('primary_navigation'))
		wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'mobile-navigation']);
	?>
</nav>
*/?>

