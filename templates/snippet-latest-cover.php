<?php
global $issue, $issue_color, $issue_number;

$issue = isset( $_GET['issue'] ) ? get_term_by('slug', preg_replace ("/[^A-Za-z0-9-]/", '', $_GET['issue']), 'magazine'): get_field ('current_issue', 'option');
$issue_acf_id = 'magazine_' . $issue->term_id;
$link = get_term_link(intval($issue->term_id),'magazine');
$magazineimage = wp_get_attachment_image_src(get_field('magazine_taxonomy_image', $issue_acf_id), 'medium');

echo "<div class='item'>";
  echo "<div class='news-item whiteBackground marginBottom'>";
    echo '<div class="post-image noMargin">';
      echo "<a href=\"{$link}\" title='{$issue->name}'>";
        echo '<img src="'.$magazineimage[0].'" alt="'.$issue->name.'" class="placeholder" />';
      echo "</a>";
    echo "</div>";
  echo "</div>";
echo "</div>";

echo "<p class='noMargin'>";
echo "</p>";

?>