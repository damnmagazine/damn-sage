<?php
/*
Template Name: Magazine taxonomy
*/

?>

<div class="row marginTop2em">

  <?php
  
  $tax = 'magazine';
  $tax_args = array(
    'orderby' => 'ID',
    'order' => 'DESC',
  );
  $magazines = get_terms( $tax, $tax_args );
  $post_count = 0;
  foreach($magazines as $magazine) {
    $issue_acf_id = 'magazine_' . $magazine->term_id;
    $link = get_term_link(intval($magazine->term_id),'magazine');
    $image_url = get_template_directory_uri();
    $magazineimage = wp_get_attachment_image_src(get_field('magazine_taxonomy_image', $magazine->taxonomy.'_'.$magazine->term_id), 'full');

    echo "<div class='item col-xs-6 col-sm-4 col-md-3 col-lg-3'>";
      echo "<div class='news-item'>";
        echo '<div class="post-image issue-container" style="background-image:url('.$magazineimage[0].');">';
          if(!$magazineimage ){
            echo "<div class='no-cover-image'><h1>" . $magazine->name . "</h1></div>";
          } 
          
          echo "<a href=\"{$link}\" title='{$magazine->name}'>";
            echo '<img src="'.$image_url.'/dist/images/blank-image-magazine.gif" alt="'.$magazine->name.'" class="placeholder" />';
          echo "</a>";
        
        echo "</div>";
        echo "<h2 class='entry-title text-center entry-title-hide'><a href=\"{$link}\" title='{$magazine->name}'>{$magazine->name}</a></h2>";
      echo "</div>";
    echo "</div>";
  }
  ?>

</div>