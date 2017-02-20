<div class="item col-xs-12 col-md-8">
	
	<div id="home-carousel" class="carousel slide" data-ride="carousel">
		
		
		<!-- Wrapper for slides -->
		<div class="carousel-inner" role="listbox">
			
		<?php
		$indicators = [];
		
		while( $featured->have_posts() ):
			
			$featured->the_post();
			
			// Excempt featured post from main streams
			$issue_query['post__not_in'][] = get_the_ID();
			
			// Filling
			$fill = get_field('sub-title')?: get_the_excerpt();
			
			//$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' );
			//$url = $thumb['0'];
			//fetch_post_image()
				
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

		?>
			
			
			<div class="item<?=count ($indicators)? '': ' active'?>">
				<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
					<img src="<?=$url?>" alt="<?= the_title_attribute()?>">
					
					<div class="carousel-caption">
						<h3><?php the_title_attribute(); ?></h3>
						<p><?=$fill?></p>
					</div>
				</a>
			</div>
			
				
			<?php
				$indicators[] = '<li data-target="#home-carousel" data-slide-to="' .count ($indicators). '"' .(count ($indicators)? '': ' class="active"'). '></li>';
				endwhile;
			?>
		
		</div>
		
		<!-- Controls -->
		<ol class="carousel-indicators">
			<?=implode ("\n", $indicators)?>
		</ol>
		<a class="left carousel-control" href="#home-carousel" role="button" data-slide="prev">
			<span class="icon-prev" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="right carousel-control" href="#home-carousel" role="button" data-slide="next">
			<span class="icon-next" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
	</div>	

</div>


			<?php
				
			/*
				
				<div class="item col-xs-12 col-sm-12 slider-content <?=has_post_format('quote')? 'quote-format ':null?><?=implode (' ', $cats)?>"<?=isset ($url)? ' style="width:100%!important;height:89%!important;background-image:url(' . $url . ');background-repeat:no-repeat;background-size:cover;background-position:left bottom;"': null?>>
				
					
<?php get_template_part('templates/snippet', 'feed-header'); ?>

<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>" class="link-image">
	
	<img src="<?= get_template_directory_uri(); ?>/dist/images/blank-image.gif" alt="<?php the_title_attribute(); ?> - <?= get_bloginfo("name"); ?>" class="placeholder visible-sm-block visible-xs-block" />
</a>
				
				</div>
			*/
			
					/*	<div class="item active">
				<img src="..." alt="...">
				<div class="carousel-caption">
					...
					</div>
				</div>
				<div class="item">
					<img src="..." alt="...">
					<div class="carousel-caption">
					...
				</div>
			</div>
			...
		</div>*/
		
		?>