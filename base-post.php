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

$template_path = 'post/';

# Template required data
$next_issue = null;
if( !$DAMN->latest && $DAMN->issue ){
	$next_issue = $DAMN->issue->number +1;
}

$prev_issue = null;
if( $DAMN->issue && $DAMN->issue->number > $latest_number-10 ){
	$prev_issue = $DAMN->issue->number -1;
}


$parameters = (object)[
	'issue'		 => $DAMN->issue,
	'issued'	 => $DAMN->issued,
	'next_issue' => $next_issue,
	'prev_issue' => $prev_issue,
	'history'	 => range ($latest_number, $latest_number-10),
	'theme_path' => get_template_directory_uri(),
	'template'	 => get_post_meta ($post->ID, '_template_slug', true),
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

# Template smarts
$parameters->template = $template_path . (
	$parameters->template?:
	(in_category ('news')? 'news-post': '.default')
);


if ( @!$DAMN->issue->brand && function_exists ('adrotate_group')){
	$parameters->advert = adrotate_group (3);
}

# Make something happen here..
if( !$DAMN->issue ){
	@$parameters->issue->link = get_site_url() . '/wp/editions/' . $DAMN->issued->slug;
	@$parameters->issue->link = str_replace('/wp', '', @$parameters->issue->link );
	@$parameters->issue->thumbnail =  wp_get_attachment_url( get_field( 'magazine_taxonomy_image', 'magazine_' . $DAMN->issued->term_id ) );
}




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


# Issuu shortcode
if( get_post_meta ($post->ID, 'issuu_shortcode', true) ){
	$shortcode = get_post_meta ($post->ID, 'issuu_shortcode', true);
	$parameters->issuu_shortcode = do_shortcode( $shortcode );
}



# Load Head
get_template_part('templates/head'); 

?>

	<body <?php body_class ($parameters->contrast? 'positive-contrast templated': 'templated'); ?>>	
	<div id="search-bar" class="collapse event-search-bar">
		<div class="container">
			<?php get_template_part('templates/search-form'); ?>
		</div>
	</div>
<?php

# Hold off DAMN+
if (in_category ('damn-plus') && !current_user_can ("access_s2member_level1"))

	echo $Wustache->render ('partials/damn-plus', $parameters);

else 
{

	/**
	 *	Code is Poetry.
	 */
	do_action ('the_template', $parameters);
	
	// Handled comfortably by Wustache.


}	
	

	/**
	 *	Add Related Posts
	 */
	$related = [
		'posts'=> $DAMN->relatedPosts (4, $parameters->post, $parameters->categories, $parameters->tags),
		'products'=> $DAMN->relatedProducts (3, false, $parameters->categories, $parameters->tags, isset($parameters->products)? $parameters->products : null ),
		'calendar'=> $DAMN->relatedCalendars (3, false, $parameters->categories, $parameters->tags, isset($parameters->calendars)? $parameters->calendars : null )
	];
			
	// Get some more
	echo $Wustache->render ('partials/related-posts', $related);
	
	do_action('get_footer');
	get_template_part('templates/footer');
	wp_footer();
?>

	<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-565b1d483536298e" async="async"></script>
	
	</body>
</html>
