<?php // Event website and ticket buttons ?>
<?php if(get_field('event_website')) { ?>
  <a class="btn btn-lg btn-default marginRight marginTop text-uppercase" href="http://<?php the_field('event_website'); ?>" role="button" target="_blank" title="Event Website">Website</a>
<?php } ?>
<?php if(get_field('ticket_url')) { ?>
  <a class="btn btn-lg btn-default marginTop marginRight text-uppercase" href="http://<?php the_field('ticket_url'); ?>" role="button" target="_blank" title="Event Tickets">Tickets</a>
<?php } ?>

<?php // other URL buttons if added ?>
<?php if(get_field('extra_buttons')): ?>
  <?php while(has_sub_field('extra_buttons')): ?>

    <a class="btn btn-lg btn-default marginTop marginRight text-uppercase" href="http://<?php the_sub_field('button_link'); ?>" role="button" target="_blank" title="<?php the_sub_field('button_title'); ?>">
      <?php the_sub_field('button_title'); ?>
    </a>

  <?php endwhile; ?>
<?php endif; ?>