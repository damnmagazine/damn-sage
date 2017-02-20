<?php /* REUSED snippet to display title, category, subtitle */ ?>
<?php get_template_part('templates/snippet', 'feed-header'); ?>

<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>" class="link-image">
	<?php /* show non wide blank-image only on 768-992 so boxes adjust properly, using class "visible-xs-block" */ ?>
	<img src="<?= get_template_directory_uri(); ?>/dist/images/blank-image.gif" alt="<?php the_title_attribute(); ?> - <?= get_bloginfo("name"); ?>" class="placeholder visible-sm-block visible-xs-block" />
</a>