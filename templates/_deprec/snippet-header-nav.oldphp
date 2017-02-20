<?php
// Retreiving parameters from header template
global $issue, $issue_color, $issue_number;
$issue_acf_id = 'magazine_' . $issue->term_id;
$header_image = get_field ('header_image', $issue_acf_id);
$contrast = (int) get_field ('colour_scheme', $issue_acf_id);
?>

<header class="banner navbar navbar-default" role="banner">
  <?php if (is_home()) : ?>
    <div class="header-wrapper">
  <?php elseif ($header_image) : ?>
    <div class="header-wrapper" style="background-image: url(<?=$header_image?>);">
  <?php else : ?>
    <div class="header-wrapper">
  <?php endif; ?>
    <div class="container">
      <div class="pull-left">
        <a class="main-logo" href="/">DAMN MAGAZINE - <?php bloginfo('name'); ?></a>
        <span class="issue-number" style="color: <?=$issue_color?>"><?=$issue_number?></span>

        <?php /* toggle selector for issues */ ?>
        <ul id="issue-selector" class="nav navbar-nav">
          <li id="" class="dropdown">
            <a title="Select An Issue" href="#" data-toggle="dropdown" class="dropdown-toggle" aria-haspopup="true">
              <i class="fa fa-chevron-up"></i>
              <i class="fa fa-chevron-down"></i>
            </a>
            <ul class="dropdown-menu">

              <?php
                $tax = 'magazine';
                $tax_args = array(
                  'orderby' => 'ID',
                  'order' => 'DESC'
                );
                $magazines = get_terms( $tax, $tax_args );
                foreach($magazines as $magazine) {
                  $issue_color = get_field('issue_color', $magazine->taxonomy.'_'.$magazine->term_id);
                  echo '<li style="background-color: ' . $issue_color . '"><a href="?issue=' . $magazine->slug . '" title="">'. $magazine->name .'</a></li>';
                }
              ?>

            </ul>
          </li>
        </ul>

      </div>

      <?php /* mobile menu toggle */ ?>
      <a class="mobile-menu no-badge normal-menu" data-count="0" href="#my-menu">
        <i class="fa fa-bars"></i>
      </a>

      <div class="pull-right social-navs">
        <?php
        if (has_nav_menu('header_socials')) :
          wp_nav_menu(['theme_location' => 'header_socials', 'walker' => new wp_bootstrap_navwalker(), 'menu_class' => 'social-nav navbar-nav']);
        endif;
        ?>
      </div>
    </div>
  </div>

  <div class="white-wrapper">
    <div class="container">
      <nav class="collapse navbar-collapse main-navigation" role="navigation">
        <?php
        if (has_nav_menu('primary_navigation')) :
          wp_nav_menu(['theme_location' => 'primary_navigation', 'walker' => new wp_bootstrap_navwalker(), 'menu_class' => 'nav navbar-nav', ]);
        endif;
        ?>
        <?php
        if (has_nav_menu('header_socials')) :
          wp_nav_menu(['theme_location' => 'header_socials', 'walker' => new wp_bootstrap_navwalker(), 'menu_class' => 'social-nav navbar-nav']);
        endif;
        ?>
      </nav>
    </div>
  </div>

  <?php /* leave this here, it activates the sticky nav */ ?>
  <div class="fixed-nav-activator clearthis"></div>
</header>

<div id="search-bar" class="collapse">
  <div class="container">
    <?php get_template_part('templates/snippet-search-form'); ?>
  </div>
</div>
<?php /* end actual header/navigation */ ?>


<?php /* header title items, for areas where the title displays */ ?>
<?php if(is_single() || (is_front_page()) || (is_author())) { ?>
  <?php /* dont display title wrapper if is single */ ?>
<?php } else { ?>
  <?php /* or else display title wrapper and show archive title based on if its a post type, category, taxonomy, or page */ ?>
  <div class="title-wrapper">

    <?php if(is_author()) { ?>
      <?php /* show nothing, the author name is in archive.php under if_author, it loads the author profile */ ?>
    <?php } elseif(is_archive()) { ?>
      <h1 class="archive-title">
        <?php the_archive_title(); ?>
      </h1>
      <?php
        the_archive_description( '<div class="taxonomy-description">', '</div>' );
      ?>
    <?php } elseif(is_page()) { ?>
      <h1 class="page-title" itemprop="headline">
        <?php the_title(); ?>
      </h1>
    <?php } elseif(is_search()) { ?>
      <?php get_template_part('templates/page', 'header'); ?>
    <?php } else { ?>
    <?php } ?>
  </div>
<?php } ?>
