<?php
/*
Template Name: Colophon
*/


?>

<?php while (have_posts()) : the_post(); ?>

  <?php if ( has_post_thumbnail()) { ?>
    <div class="page-featured-image color-box">
      <?php the_post_thumbnail('large'); ?>
    </div>
  <?php } ?>

  <div class="row colophon marginTop2em">

    <?php the_content(); ?>

    <div class="col-xs-12 col-sm-6">
      <div class="col-xs-12 col-md-6 column-1">

        <?php /* query to show all users */ ?>
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

          foreach($allUsers as $currentUser) {
            if(in_array( 'author', $currentUser->roles )) {
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

        <!-- Contributors list -->
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
        <!-- End Contributors list -->

        <?php if(get_field('column_1')) { ?>
          <?php the_field('column_1'); ?>
        <?php } ?>
      </div>
      <div class="col-xs-12 col-md-6 column-2">
        <?php if(get_field('column_2')) { ?>
          <?php the_field('column_2'); ?>
        <?php } ?>
      </div>
    </div>

    <div class="col-xs-12 col-sm-6">
      <?php if(get_field('bookstore_title')) { ?>
        <div class="col-xs-12">
          <h3><?php the_field('bookstore_title'); ?></h3>
        </div>
      <?php } ?>
      <div class="nothing">
        <div class="col-xs-12 col-md-6 column-3">
          <?php if(get_field('column_3')) { ?>
            <?php the_field('column_3'); ?>
          <?php } ?>
        </div>
        <div class="col-xs-12 col-md-6 column-4">
          <?php if(get_field('column_4')) { ?>
            <?php the_field('column_4'); ?>
          <?php } ?>
        </div>
      </div>
    </div>

  </div>

<?php endwhile; ?>