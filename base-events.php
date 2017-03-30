<!doctype html>
<html data-type="event" class="no-js" <?php language_attributes(); ?>>



<?php
global $DAMN;

/**
 *	Single Post
 *	Use the DAMN Constructor
 */
 
$DAMN = new DAMN ();

# Issue numbers
$latest_number = (int) !$DAMN->latest? 
	
	get_field ('magazine_number', 'magazine_' . $DAMN->latest_issue->term_id):
	$DAMN->issue->number;
	
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
	'background'	=> [
		'image' => get_field ('background_image'),
		'color' => get_field ('background_color'),
	],
	'image' 	 => get_field ('image'),
	'issue'		 => $DAMN->issue,
	'issued'	 => $DAMN->issued,
	'contrast'	 => get_field ('contrast'),
	'next_issue' => $next_issue,
	'prev_issue' => $prev_issue,
	'history'	 => range ($latest_number, $latest_number-10),
	'theme_path' => get_template_directory_uri(),
	'navigation' => wp_nav_menu (
	[
		'menu' => 'Minimal Nav', 
		'echo' => false
	]),
	
	// To update: should be issued release date
	'date'			=> get_the_date ("F o")
];

$template_path = 'events/';

# Template smarts
$parameters->template = $template_path . '.default';

# The Post
$parameters->post = get_post ();

# Tags
$parameters->tags = get_the_tags ();

# Event tag
$parameters->event_tag = get_field ('event_tag', get_the_ID());

# Categories
$parameters->categories = get_the_category (get_the_ID());

#GIF
$parameters->gif = get_template_directory_uri() . "/dist/images/gif-litta.gif";


# Agenda
$parameters->calnode = get_field ('calnode');
$parameters->calnode->subtitle = get_field ('subtitle', $parameters->calnode->ID);
$parameters->calnode->start = get_field ('start_date', $parameters->calnode->ID);
$parameters->calnode->start_day = date ('d', strtotime ($parameters->calnode->start));
$parameters->calnode->start_month = date ('M', strtotime ($parameters->calnode->start));
$parameters->calnode->end = get_field ('end_date', $parameters->calnode->ID);
$parameters->calnode->url = get_post_permalink ($parameters->calnode->ID);

# Brand
$parameters->brand = get_field ('brand');
if( $parameters->brand ){
	$parameters->brand->logo = get_field ('logo', $parameters->brand->ID);
	$parameters->brand->link = get_field ('link', $parameters->brand->ID);
	$parameters->brand->title = get_field ('link', $parameters->brand->ID);
	$parameters->brand->acfid = 'brand_' . $parameters->brand->ID;
} else {
	$parameters->brand = new StdClass;
	$parameters->brand->link = get_field( 'social_facebook' );
	$parameters->brand->title = get_field( 'social_facebook_title' ) ? get_field( 'social_facebook_title' ) : get_field( 'social_facebook' );
}


#Highlight
$highlights = ($highlight = get_field ('highlight'))? $DAMN->sugar ([$highlight]): [];

# Listed Posts
$event_tag = get_term_by( 'name', $parameters->event_tag , 'post_tag' );

# text area 
$parameters->text_area = get_field('text_area', get_the_ID() );


#offset posts
//$offset = $DAMN->relatedPosts( 1, $parameters->post, null, $event_tag->term_id, [], 'date' );

# Facebook stream
$parameters->facebook_shortcode = do_shortcode( get_field('facebook_shortcode', get_the_ID() ) );



if( !empty( $highlights ) ){

	$posts = $DAMN->relatedPosts( 6, $parameters->post, null, $event_tag->term_id, [$highlights[0]->ID], 'date');
	/*if( !$parameters->facebook_shortcode ){
		$posts = $DAMN->relatedPosts( -1, $parameters->post, null, $event_tag->term_id, [$highlights[0]->ID], 'date', 3);
		$offset = $DAMN->relatedPosts( 3, $parameters->post, null, $event_tag->term_id, [], 'date' );
		$parameters->offset_posts = $offset; 
	}*/
	$parameters->posts = $highlights;
	$parameters->rel_posts = $posts; 


} else {

	$highlights = $DAMN->relatedPosts( 1, $parameters->post, null, $event_tag->term_id, [], 'date' );
	$rel_posts = $DAMN->relatedPosts( 6, $parameters->post, null, $event_tag->term_id, [$highlights[0]->ID], 'date' );
	$parameters->posts = $highlights;
	$parameters->rel_posts = $rel_posts; 
}



#Issuu link
if( get_field ('issuu_post', $post->ID ) ){
	$parameters->issuu_post = get_field ('issuu_post', $post->ID );
}


# Classes
$classes = get_field ('class')?: null;

if ($parameters->contrast) $classes .= ' positive-contrast';

# Load Head
get_template_part('templates/head'); 


?>

	<body <?php body_class ($classes); ?>>	

<?php

	/**
	 *	Code is Poetry.
	 */
	$Wustache = new Cloudoki\Wustache\Publication ();
	echo $Wustache->template_content ($parameters, 'cpt/event'); // Handled comfortably by Wustache.

?>
	<div id="search-bar" class="collapse event-search-bar">
		<div class="container">
			<?php get_template_part('templates/search-form'); ?>
		</div>
	</div>

<?php
	// Get some more
	do_action('get_footer');
	get_template_part('templates/footer');
	wp_footer();
?>

	<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-565b1d483536298e" async="async"></script>
	
	</body>
</html>
