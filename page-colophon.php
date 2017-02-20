<?php
/*
Template Name: Colophon
*/

global $issue, $issue_color, $issue_number;

// Some dry data
$issue_acf_id = 'magazine_' . $issue->term_id;
$colophon_image = wp_get_attachment_image_src(get_field('colophon_image', $issue_acf_id), 'large');
$colophon_alt = get_the_title(get_field('colophon_image', $issue_acf_id));
$colophon_image_data = get_field('cover_image_data', $issue_acf_id);
$colophon_copyright = get_field('copyright_year', $issue_acf_id);
$copyright = the_archive_description();
?>

<?php while (have_posts()) : the_post(); ?>

  <?php if ( has_post_thumbnail()) { ?>
    <div class="page-featured-image color-box">
      <?php the_post_thumbnail('large'); ?>
    </div>
  <?php } ?>

  <div class="row colophon marginTop2em">

    <?php the_content(); ?>

    <?php /* left side - column 1 & 2 */ ?>
    <div class="col-xs-12 col-sm-6">
      <?php /* COLUMN 1 Contributors dynamic & Staff */ ?>
      <div class="col-xs-12 col-md-6 column-1">

        <?php /* query to show all authors and admins who post (Vos) */ ?>
          <?php
          // Get all users order by amount of posts
          $allUsers = get_users('orderby=display_name');
          $users = array();

          function get_author_tags($id) {
            $user_tags = array();
            $query = new WP_Query(array(
                'posts_per_page' => -1,
                'author' => $id,
            ));
            while ($query->have_posts()) {
                $query->the_post();
                $tags = get_the_terms(get_the_ID(), 'magazine');
                if(!is_array($tags) || count($tags) == 0 ) { continue; }
                foreach ($tags as $key => $val) {
                    if ($val->term_id > 0) {
                        if (!array_key_exists($val->slug, $user_tags)) {
                            $user_tags[] = $val->slug;
                        }
                    }
                }
                wp_reset_postdata();
            }
            return $user_tags;
          }

          // return authors and admins
          foreach($allUsers as $currentUser) {
            if(in_array( 'author', $currentUser->roles ) || in_array( 'administrator', $currentUser->roles )) {
              $author_tags = get_author_tags($currentUser->ID);

              if(count($author_tags) == 0){
                continue;
              }

              $current_issue_slug = "damn-".$issue_number;

              if(in_array($current_issue_slug, $author_tags)){
                $users[] = $currentUser;
              }
            }
          }
        ?>

        <h3 class="text-uppercase">
          Contributors
        </h3>

        <?php /* Contributors dynamic list */ ?>
        <div class="contributor-names">
          <?php foreach($users as $user) { ?>
            <span>
              <a href="<?php echo get_author_posts_url( $user->ID ); ?>" title="Read Articles" class="black-link">
                <?php echo $user->display_name; ?>
              </a>
            </span>
          <?php } ?>

          <a href="/colophon/contributors/" title="All Contributors" class="btn btn-primary marginTop marginBottom15">All Contributors</a>
        </div>

        <?php /* Start staff */ ?>
        <?php if(get_field('column_1')) { ?>
          <?php the_field('column_1'); ?>
        <?php } ?>
      </div>
      <?php /* END COLUMN 1 */ ?>


      <?php /* COLUMN 2 - cover image, staff, copyright */ ?>
      <div class="col-xs-12 col-md-6 column-2">

        <?php if($colophon_image) { ?>
          <div class="marginBottom">
            <img src="<?php echo $colophon_image[0]; ?>" alt="<?php echo $colophon_alt ?>">
          </div>
        <?php } ?>

        <?php /* display bare cover image */
        if($colophon_image_data) { ?>
          <h3>COVER IMAGE</h3>
          <?php echo $colophon_image_data; ?>
        <?php } ?>

        <?php /* display normal column 2 items, copyright loads at bottom of column */
        if(get_field('column_2')) { ?>
          <?php the_field('column_2'); ?>
        <?php } ?>

        <?php if($colophon_copyright) { ?>
          Copyright &copy; <?php echo $colophon_copyright; ?>
        <?php } ?>

      </div>
    </div>
    <?php /* end left side */ ?>


   <?php /* right side - column 3 & 4 */ ?>
    <div class="col-xs-12 col-sm-6">
      <?php /* COLUMN 3 & 4 BOOKSTORE DISTRIBUTION */ ?>

      <?php /* TITLE of bookstore distrubtion */ ?>
      <?php if(get_field('bookstore_title')) { ?>
        <div class="col-xs-12">
          <h3><?php the_field('bookstore_title'); ?></h3>
        </div>
      <?php } ?>

      <div class="nothing columns-wrapper">
        <?php /* COLUMN 3 */ ?>
        <div class="col-xs-12 col-md-6 column-3">
          <?php if(get_field('column_3')) { ?>
            <?php the_field('column_3'); ?>
          <?php } ?>
        </div>
        <?php /* COLUMN 3 END */ ?>

        <?php /* COLUMN 4 */ ?>
        <div class="col-xs-12 col-md-6 column-4">
          <?php if(get_field('column_4')) { ?>
            <?php the_field('column_4'); ?>
          <?php } ?>
        </div>
        <?php /* COLUMN 4 END */ ?>
      </div>
      <?php /* Ends column 3 & 4 wrapper */ ?>

    </div>
    <?php /* end right side */ ?>

  </div>

<?php endwhile; ?>