<?php 
$issue = get_field ('current_issue', 'option');
$issue_color = get_field ('issue_color', 'magazine_' . $issue->term_id );
$issue_image   = get_field('magazine_taxonomy_image', 'magazine_' . $issue->term_id );

$footer_desc   = get_field('magazine_footer_description', 'magazine_' . $issue->term_id );

?>

<footer class="content-info" role="contentinfo">
  <div class="container">
    <div class="advert footer-advert">
      <?php if (function_exists('adrotate_group')) echo adrotate_group(2); ?>
    </div>
  </div>

<div class="footer-wrap">
	<div class="container">

		<div class="row">
			
			<!-- Footer content -->
			<div class="col-xs-12 col-md-10">
				
				<div class="row logo-buttons">
					<div class="col-md-4 footer-logo">
						<a class="main-logo" style="background: url(<?php echo get_template_directory_uri(); ?>/dist/images/damn-white.svg) no-repeat" href="/">DAM<sub>N</sub>° MAGAZINE - <?php bloginfo('name'); ?></a>
					</div>
					
					<div class="col-md-8 footer-cta">
					
						<div class="btn-group pull-right">
							<a href="/back-issues/subscribe" class="btn btn-whitestroke btn-xl btn-noRadius" title="DAMN Magazine - Back Issues">Subscribe</a>
						</div>
						
						<div class="btn-group pull-right">
							<a class="btn btn-whitestroke btn-xl btn-noRadius" href="/subscribe" title="Join The Mailing List">Join The Mailing List</a>
						</div>
						
						<div class="btn-group pull-right">
							<a href="/back-issues" class="btn btn-whitestroke btn-xl btn-noRadius" title="DAMN Magazine - Back Issues">Back Issues</a>
						</div>
					</div>
				</div>
				
				<div class="row row-links">
					<div class="col-xs-12 col-sm-6 col-lg-8">
						<h4 class="about-damn-title">About DAM<sub>N</sub>°</h4>
						<span class="about-damn"><?php the_field('about_damn', 'option'); ?></span>
					</div>
					
					<div class="col-xs-6 col-sm-3 col-lg-2 footer-social">
						<div class="pull-right">
							<h4>Socials</h4>
							<?php
							if (has_nav_menu('footer_socials')) :
							wp_nav_menu(['theme_location' => 'footer_socials', 'menu_class' => 'footer-nav list-unstyled']);
							endif;
							?>
						</div>
					</div>
					
					<div class="col-xs-6 col-sm-3 col-lg-2 footer-colophon">
						<div class="pull-right">
							<h4>Colophon</h4>
							<?php
							if (has_nav_menu('colophon')) :
							wp_nav_menu(['theme_location' => 'colophon', 'menu_class' => 'footer-nav list-unstyled']);
							endif;
							?>
						</div>
					</div>
				
				</div>				
			</div>
			
			<!-- Magazine -->
			<div class="col-xs-3 col-md-2 footer-magazine">
				
				<a href="/back-issues/subscribe" >
					<?php echo wp_get_attachment_image( $issue_image, 'medium' ); ?>
				</a>
				<br>
				<div class="magazine_footer_description">
					<?php echo trim( $footer_desc ); ?>
				</div>
				
			</div>
			
		</div>
      <div class="row">
        <div class="col-xs-12 text-center">
          <p class="copyright">&copy; <?php echo date('Y'); ?> <?php bloginfo( 'name' ); ?>. All rights reserved. <span class="footer-extra"><a href="/colophon/privacy-policy/">Privacy</a> - <a href="/colophon/terms-conditions">Terms & Conditions</a></span></p>
        </div>
      </div>

    </div>
  </div>
</footer>
<script src="https://cdnjs.cloudflare.com/ajax/libs/masonry/3.3.0/masonry.pkgd.min.js"></script>
