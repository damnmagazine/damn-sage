<?php 

$issue = get_field ('current_issue', 'option');
$issue_image   = get_field('magazine_taxonomy_image', 'magazine_' . $issue->term_id );
$issue_color = get_field ('issue_color', 'magazine_' . $issue->term_id );
//15581
?>

 <div id="popup-content-mobile" class="popup-content">

	<h2>DON'T MISS A <span>DAM<span class="that-char">N</span>º</span> THING</h2>

	<div class="popup-subscribe-container">
		<h3>Subscribe to our mailing list</h3>
		<div class="popup-subscribe-fields">
				<?php echo do_shortcode( '[mc4wp_form id="15581"]' ); ?>
		</div>
	</div>


	<div class="popup-content-middle">

		<h3>Subscription of <span class="bolder">DAM<span class="that-char">N</span>º</span> <span style="color:<?php echo $issue_color; ?>;">Magazine</span></h3>
			
		<h4>
			6 issues for €70 (Europe)<br>
			172$ (rest of the world)
		</h4>

		<p class="popup-mobile-2-buttons">
			<a class="btn btn-lg btn-default marginTop text-uppercase" title="Subscribe Now" href="/back-issues/subscribe" >SUBSCRIBE</a>

			<a class="btn btn-lg btn-default text-uppercase" title="Order Back Issue" href="/back-issues/" >ORDER BACK ISSUE</a>
		</p>

	</div>


</div>