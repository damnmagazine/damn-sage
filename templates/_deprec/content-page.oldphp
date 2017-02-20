<article <?php post_class(''); ?>>
  <div class="entry-content">
    <?php the_content(); ?>

    <?php if ( is_page('search') ) { ?>
      <div class="search-large">
       <?php get_template_part('templates/snippet-search-form'); ?>
      </div>
    <?php } ?>

    <?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
    
    <?php
	    
	  if (is_page ('unsubscribe') && $_GET['e-mail'])
	  {
		  wp_mail( 'koen@cloudoki.com', 'A DAMN unsubscribe', $_GET['e-mail'] . " would like to unsubscribe."); 
	  }
	    
	?>
  </div>
</article>
