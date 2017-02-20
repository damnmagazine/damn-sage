<?php

namespace Roots\Sage\Extras;

use Roots\Sage\Config;

/**
 * Add <body> classes
 */
function body_class($classes) {
  // Add page slug if it doesn't exist
  if (is_single() || is_page() && !is_front_page()) {
    if (!in_array(basename(get_permalink()), $classes)) {
      $classes[] = basename(get_permalink());
    }
  }

  // Add class if sidebar is active
  if (Config\display_sidebar()) {
    $classes[] = 'sidebar-primary';
  }

  return $classes;
}
add_filter('body_class', __NAMESPACE__ . '\\body_class');


/**
 * Clean up the_excerpt()
 */
/*function excerpt_more() {
  if ( has_post_format( 'quote' )) {
    return '';
  } else {
    return ' &hellip; <a class="more-link" href="' . get_permalink() . '">' . __('More', 'sage') . '</a>';
  }
}
add_filter('excerpt_more', __NAMESPACE__ . '\\excerpt_more');


function custom_excerpt_length($length) {
    if(in_category('damn-plus') && is_single()) {
        return 120; //return 65 words for the excerpt
    } elseif(is_single()) {
        return 50;
    } else {
      return 25;
    }
}
add_filter( 'excerpt_length', __NAMESPACE__ . '\\custom_excerpt_length', 999 );
*/

// limit excerpt by character count, not word count
function get_excerpt($count){
  $permalink = get_permalink($post->ID);
  $excerpt = get_the_excerpt();
  $excerpt = strip_tags($excerpt);
  $excerpt = substr($excerpt, 0, $count);
  $excerpt = $excerpt.'';
  return $excerpt;
}


//Page Slug Body Class

function add_slug_body_class( $classes ) {
global $post;
if ( isset( $post ) ) {
$classes[] = $post->post_type . '-' . $post->post_name;
}
return $classes;
}
add_filter( 'body_class', __NAMESPACE__ . '\\add_slug_body_class' );

/**
 *  DAMN Customised
 *  All action & hook functionalities - add them here for clear overview.
 */

// add_action ('pre_get_posts', array('Roots\DAMN', 'filter_home'));


function db_filter_authors_search( $posts_search ) {
  // Don't modify the query at all if we're not on the search template
  // or if the LIKE is empty
  if ( !is_search() || empty( $posts_search ) )
    return $posts_search;
  global $wpdb;
  // Get all of the users of the blog and see if the search query matches either
  // the display name or the user login
  add_filter( 'pre_user_query', __NAMESPACE__ . '\\db_filter_user_query' );
  $search = sanitize_text_field( get_query_var( 's' ) );
  $args = array(
    'count_total' => false,
    'search' => sprintf( '*%s*', $search ),
    'search_fields' => array(
      'display_name',
      'user_login',
    ),
    'fields' => 'ID',
  );
  $matching_users = get_users( $args );
  remove_filter( 'pre_user_query', __NAMESPACE__ . '\\db_filter_user_query' );
  // Don't modify the query if there aren't any matching users
  if ( empty( $matching_users ) )
    return $posts_search;
  // Take a slightly different approach than core where we want all of the posts from these authors
  $posts_search = str_replace( ')))', ")) OR ( {$wpdb->posts}.post_author IN (" . implode( ',', array_map( 'absint', $matching_users ) ) . ")))", $posts_search );
  return $posts_search;
}
/**
 * Modify get_users() to search display_name instead of user_nicename
 */
function db_filter_user_query( &$user_query ) {
  if ( is_object( $user_query ) )
    $user_query->query_where = str_replace( "user_nicename LIKE", "display_name LIKE", $user_query->query_where );
  return $user_query;
}
add_filter( 'posts_search', __NAMESPACE__ . '\\db_filter_authors_search' );

/*
// Adds Charachter Counter to the Excerpt Meta Box
// @ref = http://wpsnipp.com/index.php/excerpt/add-a-character-counter-to-excerpt-metabox/
function excerpt_count_js(){
      echo '<script>jQuery(document).ready(function(){
jQuery("#postexcerpt .handlediv").after("<div style=\"position:absolute;top:5px;right:80px;color:#666;\"><small>Excerpt length: </small><input type=\"text\" value=\"0\" maxlength=\"3\" size=\"3\" id=\"excerpt_counter\" readonly=\"\" style=\"background:#fff;\"> <small>character(s). 117 Characters MAX please</small></div>");
     jQuery("#excerpt_counter").val(jQuery("#excerpt").val().length);
     jQuery("#excerpt").keyup( function() {
     jQuery("#excerpt_counter").val(jQuery("#excerpt").val().length);
     if ( jQuery("#excerpt_counter").val() >= 110 ) {
      jQuery("#excerpt_counter").css("color","red");
     } else {
      jQuery("#excerpt_counter").css("color","green");
     }
   });
});</script>';
}
add_action( 'admin_head-post.php', __NAMESPACE__ . '\\excerpt_count_js');
add_action( 'admin_head-post-new.php', __NAMESPACE__ . '\\excerpt_count_js');
*/

// Add rel lightbox to images so photo galleries and lightbox will work

add_filter('wp_get_attachment_link', __NAMESPACE__ . '\\add_gallery_id_rel');
function add_gallery_id_rel($link) {
  global $post;
  return str_replace('<a href', '<a rel="gallery-'. $post->ID .'" href', $link);
}

// Custom filter function to modify default gallery shortcode output
function my_post_gallery( $output, $attr ) {

  // Initialize
  global $post, $wp_locale;

  // Gallery instance counter
  static $instance = 0;
  $instance++;

  // Validate the author's orderby attribute
  if ( isset( $attr['orderby'] ) ) {
    $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
    if ( ! $attr['orderby'] ) unset( $attr['orderby'] );
  }

  // Get attributes from shortcode
  extract( shortcode_atts( array(
    'order'      => 'ASC',
    'orderby'    => 'menu_order ID',
    'id'         => $post->ID,
    'itemtag'    => 'div',
    'icontag'    => 'div',
    'captiontag' => 'div',
    'columns'    => 3,
    'size'       => 'thumbnail',
    'include'    => '',
    'exclude'    => ''
  ), $attr ) );

  // Initialize
  $id = intval( $id );
  $attachments = array();
  if ( $order == 'RAND' ) $orderby = 'none';

  if ( ! empty( $include ) ) {

    // Include attribute is present
    $include = preg_replace( '/[^0-9,]+/', '', $include );
    $_attachments = get_posts( array( 'include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby ) );

    // Setup attachments array
    foreach ( $_attachments as $key => $val ) {
      $attachments[ $val->ID ] = $_attachments[ $key ];
    }

  } else if ( ! empty( $exclude ) ) {

    // Exclude attribute is present
    $exclude = preg_replace( '/[^0-9,]+/', '', $exclude );

    // Setup attachments array
    $attachments = get_children( array( 'post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby ) );
  } else {
    // Setup attachments array
    $attachments = get_children( array( 'post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby ) );
  }

  if ( empty( $attachments ) ) return '';

  // Filter gallery differently for feeds
  if ( is_feed() ) {
    $output = "\n";
    foreach ( $attachments as $att_id => $attachment ) $output .= wp_get_attachment_link( $att_id, $size, true ) . "\n";
    return $output;
  }

  // Filter tags and attributes
  $itemtag = tag_escape( $itemtag );
  $captiontag = tag_escape( $captiontag );
  $columns = intval( $columns );
  $itemwidth = $columns > 0 ? floor( 100 / $columns ) : 100;
  $float = is_rtl() ? 'right' : 'left';
  $selector = "gallery-{$instance}";

  // Filter gallery CSS
  $output = apply_filters( 'gallery_style', "
    <style type='text/css'>
    </style>
    <!-- see gallery_shortcode() in wp-includes/media.php -->
    <div id='$selector' class='row gallery-wrapper galleryid-{$id}'>"
  );

  // Iterate through the attachments in this gallery instance
  $i = 0;
  foreach ( $attachments as $id => $attachment ) {

    // Attachment link
    $link = isset( $attr['link'] ) && 'file' == $attr['link'] ? wp_get_attachment_link( $id, $size, false, false ) : wp_get_attachment_link( $id, $size, true, false );

    // Start itemtag
    $output .= "<{$itemtag} class='col-xs-6 col-sm-6 col-md-3 col-lg-3 image-thumb'>";

    // icontag
    $output .= "
    <{$icontag} class='image-thumb-img'>
      $link ";

      if ( $captiontag && trim( $attachment->post_excerpt ) ) {
        // captiontag
        $output .= "
        <{$captiontag} class='gallery-caption' title='" . wptexturize($attachment->post_excerpt) . "'>
          " . wptexturize($attachment->post_excerpt) . "
        </{$captiontag}>";
      }

    $output .= "
    </{$icontag}>";


    // End itemtag
    $output .= "</{$itemtag}>";

    // Line breaks by columns set - REMOVE
    // if($columns > 0 && ++$i % $columns == 0) $output .= '<br style="clear: both">';
  }

  // End gallery output
  $output .= "
    <div class='clearthis'></div>
  </div>\n";

  return $output;

}

// Apply filter to default gallery shortcode
add_filter( 'post_gallery', __NAMESPACE__ . '\\my_post_gallery', 10, 2 );


function wpseo_opengraph_url(){
  return 'http://'.$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
}
add_filter('wpseo_opengraph_url', __NAMESPACE__ . '\\wpseo_opengraph_url');


/*********************
* MIKE'S CUSTOM      *
*********************/

// Mike's function to modify the main/homepage query object to display 6 posts, not the default in "reading" settings

function mike_modify_main_query( $query ) {
  if ( $query->is_home() && $query->is_main_query() ) { // Run only on the homepage
  $query->query_vars['posts_per_page'] = 1; // Show only 6 posts on the homepage only
  }
}


// modify calendar posts to show 12 items per page

function mike_modify_calendar_archive_query( $query ) {
  if ( $query->is_post_type_archive('calendar') && is_archive()) { // Run only on archive pages, but not custom post types
    $query->query_vars['posts_per_page'] = 12; // Show only 15 posts per page
    $query->query_vars['meta_key'] = '_thumbnail_id'; // hide if no post thumbnail
  }
}
// Hook my above function to the pre_get_posts action
add_action( 'pre_get_posts', __NAMESPACE__ . '\\mike_modify_calendar_archive_query' );



// modify magazine taxonomy posts to show 16 items per page

function mike_modify_magazine_query( $query ) {
  if ( $query->is_tax('magazine') ) { // Run only on magazine taxonomy archive
  $query->query_vars['posts_per_page'] = 18; // Show only 15 posts per page
  }
}

// make sure calendar and productivity have post_tag registered

register_taxonomy_for_object_type( 'post_tag', 'calendar' );
register_taxonomy_for_object_type( 'post_tag', 'productivity' );


// removed "category:" or "archives:" etc from showing automatically in the archive title

add_filter( 'get_the_archive_title', function ($title) {
  if ( is_category() ) {
    $title = single_cat_title( '', false );
  // } elseif ( is_tag() ) {
  //   $title = single_tag_title( '', false );
  // } elseif ( is_author() ) {
  //   $title = '<span class="vcard">' . get_the_author() . '</span>' ;
  } elseif ( is_post_type_archive() ) {
    $title = post_type_archive_title( '', false );
  }
  return $title;
});


// return to homepage after logout

add_action('wp_logout', __NAMESPACE__ . '\\go_home');
function go_home(){
  wp_redirect( home_url() );
  exit();
}

/*********************
PAGE NAVI
*********************/

// Numeric Page Navi (built into the theme by default)

function sage_page_navi() {
  global $wp_query;
  $big = 999999999; // need an unlikely integer
  $pages = paginate_links( array(
  'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
  'format' => '?paged=%#%',
  'current' => max( 1, get_query_var('paged') ),
  'total' => $wp_query->max_num_pages,
  'prev_next' => false,
  'type'  => 'array',
  'prev_next'   => TRUE,
  'prev_text'    => '&larr;',
  'next_text'    => '&rarr;',
  ) );
  if( is_array( $pages ) ) {
    $paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
    echo '<ul class="pagination pagination-lg">';
    foreach ( $pages as $page ) {
      echo "<li>$page</li>";
    }
    echo '</ul>';
  }
}/* end page navi */
add_filter('sage_page_navi', __NAMESPACE__ . '\\sage_page_navi');


/*
* custom role
*
 */

$custom_role = add_role( 'damn_author', __('DAMn Author' ),
  array( 
      // Dashboard
      'read' => true, // Access to Dashboard and Users -> Your Profile.
      'update_core' => false, // Can NOT update core. I added a plugin for this.
      // Posts
      'edit_posts' => true, //Access to Posts, Add New, Comments and moderating comments.
      'create_posts' => true, // Allows user to create new posts
      'delete_posts' => true, // Can delete posts.
      'publish_posts' => true, // Can publish posts. Otherwise they stay in draft mode.
      'delete_published_posts' => false, // Can delete published posts.
      'edit_published_posts' => false, // Can edit posts.
      'edit_others_posts' => false, // Can edit other users posts.
      'delete_others_posts' => false, // Can delete other users posts.
      // Categories, comments and users
      'manage_categories' => false, // Access to managing categories.
      'moderate_comments' => false, // Access to moderating comments. Edit posts also needs to be set to true.
      'edit_comments' => false, // Comments are blocked out for this user.
      'edit_users' => false, // Can not view other users.
      // Pages
      'edit_pages' => false, // Access to Pages and Add New (page).
      'publish_pages' => false, // Can publish pages.
      'edit_other_pages' => false, // Can edit other users pages.
      'edit_published_ pages' => false, // Can edit published pages.
      'delete_pages' => false, // Can delete pages.
      'delete_others_pages' => false, // Can delete other users pages.
      'delete_published_pages' => false, // Can delete published pages.
      // Media Library
      'upload_files' => true, // Access to Media Library.
      // Appearance
      'edit_themes_options' => false, // Access to Appearance panel options.
      'switch_themes' => false, // Can not switch themes.
      'delete_themes' => false, // Can NOT delete themes.
      'install_themes' => false, // Can not install a new theme.
      'update_themes' => false, // Can NOT update themes.
      'edit_themes' => false, // Can not edit themes - through the appearance editor.
      // Plugins
      'activate_plugins' => false, // Access to plugins screen.
      'edit_plugins' => false, // Can not edit plugins - through the appearance editor.
      'install_plugins' => false, // Access to installing a new plugin.
      'update_plugins' => false, // Can update plugins.
      'delete_plugins' => false, // Can NOT delete plugins.
      // Settings
      'manage_options' => false, // Can not access Settings section.
      // Tools
      'import' => false, // Can not access Tools section.
      )
);

