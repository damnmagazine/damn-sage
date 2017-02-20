<?php
// Identifier between issue- and event-based header will be placed here

/**
 *  Selected Issue
 */
global $issue, $issue_color, $issue_number;

$issue = $_GET['issue']?

  get_term_by('slug', preg_replace ("/[^A-Za-z0-9-]/", '', $_GET['issue']), 'magazine'):
  get_field ('current_issue', 'option');


if (!$issue) $issue = get_field ('current_issue', 'option');
if (!$issue)

   throw new Exception('No current issue is set, please contact the DAMN° Moderator.');

// Some dry data
$issue_acf_id = 'magazine_' . $issue->term_id;
$issue_color = get_field ('issue_color', $issue_acf_id);
$issue_number = get_field ('magazine_number', $issue_acf_id);
?>

<?php /*-- style all colors based on issue # color --*/ ?>
<style type="text/css" media="screen">
  .back-to-calendar a.btn-primary {
    background-color: <?=$issue_color?>;
    color: #fff !important;
  }
</style>


<div class="home-feature">
  <?php get_template_part('templates/snippet', 'header-nav'); ?>
</div>
