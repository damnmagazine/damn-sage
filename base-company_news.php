<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>

<?php
global $DAMN;

/**
 *	Single Post
 *	Use the DAMN Constructor
 */
 
$DAMN = new DAMN ();
$Wustache = new Cloudoki\Wustache\Template ();
$post = get_post ();

# Issue numbers
$latest_number = (int) !$DAMN->latest? 
	
	get_field ('magazine_number', 'magazine_' . $DAMN->latest_issue->term_id):
	$DAMN->issue->number;

$template_path = 'company_news/';

$next_issue = null;
if( !$DAMN->latest && $DAMN->issue ){
	$next_issue = $DAMN->issue->number +1;
}

$prev_issue = null;
if( $DAMN->issue && $DAMN->issue->number > $latest_number-10 ){
	$prev_issue = $DAMN->issue->number -1;
}
	
# Template required data
$parameters = (object)[
	'issue'		 => $DAMN->issue,
	'issued'	 => $DAMN->issued,
	'next_issue' => $next_issue,
	'prev_issue' => $prev_issue,
	'history'	 => range ($latest_number, $latest_number-10),
	'theme_path' => get_template_directory_uri(),
	'template'	 => $template_path . (get_post_meta ($post->ID, '_template_slug', true)?: '.default'),
	'contrast'	 => get_post_meta ($post->ID, '_template_contrast', true) != 'dark',
	'navigation' => wp_nav_menu (
	[
		'theme_location' => 'primary_navigation', 
		'depth'			 => 1, 
		'echo'			 => false
	]),
	
	// To update: should be issued release date
	'date'		=> get_the_date ("F o")
];

# External Links
$parameters->external_links = [];

if(get_field ('external_links'))
	
	while( has_sub_field('external_links'))
		
		$parameters->external_links[] = ['url'=> get_sub_field ('url')];

# The Post
$parameters->post = $post;

# Tags
$parameters->tags = get_the_tags ();

# Categories
$parameters->categories = get_the_category ($post->ID);

# Video
if( function_exists('has_post_video') )
	$parameters->has_video = has_post_video ($post->ID);

if ($parameters->has_video)
	$parameters->video = get_the_post_video($post->ID, '100%');

# Brand
if( get_field ('brand') ){
	$parameters->brand = get_field ('brand');
	$parameters->brand->logo = get_field ('logo', $parameters->brand->ID);
	$parameters->brand->link = get_field ('link', $parameters->brand->ID);
	$parameters->brand->acfid = 'brand_' . $parameters->brand->ID;
}

# Load Head
get_template_part('templates/head'); 

?>

	<body <?php body_class ($parameters->contrast? 'positive-contrast templated': 'templated'); ?>>
	<div id="search-bar" class="collapse event-search-bar">
		<div class="container">
			<?php get_template_part('snippets/search-form'); ?>
		</div>
	</div>
<?php

	/**
	 *	Code is Poetry.
	 */
	$Wustache = new Cloudoki\Wustache\Publication ();
	echo $Wustache->template_content ($parameters, 'cpt/event');
	
	// Handled comfortably by Wustache.
	
				
	// Get some more
	do_action('get_footer');
	get_template_part('templates/footer');
	wp_footer();
?>

	<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-565b1d483536298e" async="async"></script>
	
	</body>
</html>
