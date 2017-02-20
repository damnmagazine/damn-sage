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

$template_path = 'projects/';

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
	'background-color'	=> get_field ('background_color'),
	'header-color'	=> get_field ('header_color'),
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
	])
];

# Date
if ( get_field('start_date') ) {
	$parameters->date = get_field('start_date');
} 

if( get_field('start_date') && get_field('end_date') ){
	$parameters->date = "From ". get_field('start_date') ." until " . get_field('end_date');
}


# Ad
if ( $DAMN->issue && !$DAMN->issue->brand && function_exists ('adrotate_group'))
	
	$parameters->advert = adrotate_group (3);

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
$parameters->has_video = has_post_video ($post->ID);

if ($parameters->has_video)
	$parameters->video = get_the_post_video($post->ID, '100%');


$title_arr = explode( ' ' , get_the_title() );

# Custom Title
$custom_title = $title_arr[0] . ' ';
for ($i=0; $i < count( $title_arr  ) ; $i++) { 
	
	if ( $i >= 1 ){
		$custom_title .= '<span class="project-title-span">' . $title_arr[$i] . '</span> ';
	}

}
$parameters->custom_title = trim($custom_title);

$parameters->text_area = get_field( 'text_area' );

$parameters->sponsor_name = get_field( 'sponsor_name' );

$parameters->sponsor_information = get_field( 'sponsor_information' );


$tag_name = get_field( 'project_tag', 'option' );

$tag = get_term_by('name', $tag_name, 'post_tag');



# Get Posts
$args = array( 'post_type' => 'post', 'tag__in' => $tag ? array( $tag->term_id ) : null );

$query = new WP_Query( $args );


if( $query->found_posts > 5 ){
	$parameters->load_more = true;
} else {
	$parameters->load_more = false;
}


if( $query->have_posts() ){
	

	$x = 1;
	while ( $query->have_posts() ) {
			
		if( $x >= 6 ){
			break;
		}

		$query->the_post();
		global $post;

		if( $x % 2 == 0 ){
			$post->even = true;
			$post->float = 'left';
		} else {
			$post->even = false;
			$post->float = 'right';
		}

		$post->permalink = get_permalink();

		$thumb = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID), 'large' );
		$url = $thumb['0'];

		$post->thumb_url = $url;

		$post->place = get_field( 'city_country' );

		$post->designers = get_field( 'designers' );

		$parameters->rel_posts[] = $post; 

		$x++;
	}
} wp_reset_postdata(); wp_reset_query();


# Load Head
get_template_part('templates/head'); 

?>

	<body class="single-events single-projects" <?php body_class ($parameters->contrast? 'positive-contrast templated': 'templated'); ?>>	
	<div id="search-bar" class="collapse event-search-bar">
		<div class="container">
			<?php get_template_part('templates/search-form'); ?>
		</div>
	</div>
<?php

# Hold off DAMN+

/**
 *	Code is Poetry.
 */
do_action ('the_template', $parameters); // Handled comfortably by Wustache.


do_action('get_footer');
get_template_part('templates/footer');
wp_footer();
?>

	<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-565b1d483536298e" async="async"></script>
	
	</body>
</html>
