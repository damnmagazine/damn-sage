<?php 
/**
 *	3 latest posts under slider.
 */


$thumb = has_post_thumbnail ()? wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' ): [null];

if (!$thumb[0]){
	if ( get_post_meta( $post->ID, '_scheduled_thumbnail_id' ) ){
		$array = get_post_meta( $post->ID, '_scheduled_thumbnail_id' );
		$thumb = wp_get_attachment_image_src( $array [0], 'large' );
	} else if ( get_post_meta( $post->ID, '_scheduled_thumbnail_list') ){
		$list = get_post_meta( $post->ID, '_scheduled_thumbnail_list');
		$array =json_decode($list[0]);
		$thumb = wp_get_attachment_image_src( $array[0], 'large' );
	} else {
		$thumb = [null];
	}

}

 ?>

<article class="item col-xs-12 col-sm-4 col-md-4">
	<a href="<?=the_permalink()?>" rel="bookmark" title="<?=the_title_attribute()?>">
		<div class="post-image"<?=isset ($thumb['0'])? ' style="background-image:url(' . $thumb['0'] . ');"': null?>></div>
	</a>
	
	<h2 class="grey-font"><?=the_title()?></h2>
	<h3><?=get_field('sub-title')?></h3>
	<div class='company-post-excerpt'><?=strlen(get_the_excerpt())>300? substr(get_the_excerpt(), 0,298) . '...': get_the_excerpt()?></div>
		

	<div class="post-share">
		<a href="http://twitter.com/share?url=<?=the_permalink()?>" target="_blank"><i class='ion-social-twitter'></i></a>
		<a href="http://www.facebook.com/sharer.php?u=<?=the_permalink()?>" target="_blank"><i class='ion-social-facebook'></i></a>
		<a href="javascript:void((function()%7Bvar%20e=document.createElement('script');e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','//assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e)%7D)());" target="_blank"><i class='ion-social-pinterest'></i></a>
		<a href="http://www.tumblr.com/share/link?<?=the_permalink()?>" target="_blank"><i class='ion-social-tumblr'></i></a>
	</div>

</article>