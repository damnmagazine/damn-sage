<?php
/**
 *	Primary row
 *	Featured post and Premium Ad.
 */



if (has_post_thumbnail () && !has_post_format('quote'))
{
	$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' );
	$url = $thumb['0'];
} else {
	if ( get_post_meta( $post->ID, '_scheduled_thumbnail_id' ) ){
		$array = get_post_meta( $post->ID, '_scheduled_thumbnail_id' );
		$thumb = wp_get_attachment_image_src( $array [0], 'large' );
		$url = $thumb['0'];
	} else if ( get_post_meta( $post->ID, '_scheduled_thumbnail_list') ){
		$list = get_post_meta( $post->ID, '_scheduled_thumbnail_list');
		$array =json_decode($list[0]);
		$thumb = wp_get_attachment_image_src( $array[0], 'large' );
		$url = $thumb['0'];
	}
}

$cats = [];

foreach(get_the_category() as $category)
	$cats[] = $category->slug;


?>

<div class="item col-xs-12 col-sm-12 slider-content <?=has_post_format('quote')? 'quote-format ':null?><?=implode (' ', $cats)?>"<?=isset ($url)? ' style="width:100%!important;height:89%!important;background-image:url(' . $url . ');background-repeat:no-repeat;background-size:cover;background-position:left bottom;"': null?>>

	<?php get_template_part('templates/snippet', has_post_format('quote')? 'item-post-quote': 'item-post'); ?>

</div>

