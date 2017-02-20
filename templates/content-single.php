<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(''); ?>>
    <div class="entry-content">

      <?php /* if is single event, display the sharing icons above content */ if (is_singular( 'events' )) { ?>
        <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-55ce3c8af0d16341" async="async"></script>
        <div class="addthis_responsive_sharing"></div>
      <?php } ?>

      <?php /* if this is a quote post format, add the quote at the top of the page */ ?>
        <?php if ( has_post_format( 'quote' )) { ?>

          <header class="quote-single">
            <blockquote>
                <?php the_excerpt(); ?>
            </blockquote>
          </header>

        <?php } ?>
      <?php /* end if quote */ ?>

      <?php /* If is in DAMN + category, decide to show content IF user is logged in with an account, or else, CTA.. else, all other categories, display normal content */ ?>
      <?php if (in_category('damn-plus')) { ?>

        <?php /* if in damn plus and can access locked content */ ?>
        <?php if (current_user_can("access_s2member_level1")){ ?>
          <?php /* If visitor is logged in and can access blocked content, display all content */ ?>
          <?php the_content(); ?>

          <?php /* Multiple external URL links, if added */ ?>
          <?php get_template_part('templates/snippet', 'external-links'); ?>

          <?php /* REUSED snippet to display standard post footer */ ?>
          <?php get_template_part('templates/snippet', 'post-footer'); ?>

        <?php } else /* else show CTA and lock everything else out */ { ?>
          <?php /* display items above the more tag, or a limited content (if more not selected, so "excerpt" doesn't duplicate on quote post formats) */ ?>
          <?php if(strpos(get_the_content(),'id="more-')) : global $more; $more = 0; the_content(''); ?>
          <?php else : ?>
            <p>
            <?php $content = get_the_content();
            $content = strip_tags($content);
            echo substr($content, 0, 400);
            echo '...';
            ?>
            </p>
          <?php endif; ?>

          <?php /* CTA */ ?>
          <div class="damn-plus-cta">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 damn-plus-image-cta">
              <a href="/join-damn-plus" title="Join DAMN +">
                <img src="<?= get_template_directory_uri(); ?>/dist/images/damn-join-box-boxed.png" alt="Join DAMN +" class="placeholder visible-lg-block" />
                <img src="<?= get_template_directory_uri(); ?>/dist/images/damn-join-box-wide.png" alt="Join DAMN +" class="placeholder visible-xs-block visible-sm-block visible-md-block mobile-image" />
              </a>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 damn-plus-cta-copy">
              <?php /* Join DAMN Plus */ ?>
              <h2>Dear DAMN reader,<br /><span style="font-size: 80%;">This is a <strong>DAMN +</strong> article.</span></h2>
              <p>
                With a subscription, you get unlimited access to:

                <ul>
                  <li><span style="font-size: 115%;">•</span> All articles of the current, and previous DAMN issues</li>
                  <li><span style="font-size: 115%;">•</span> Premium articles and content, hidden to regular users</li>
                  <li><span style="font-size: 115%;">•</span> The entire DAMN archive</li>
                  <li><span style="font-size: 115%;">•</span> Much more to come!</li>
                </ul>

                <h3><strong>Subscribe for just € 5 / month</strong>, and get two months on the house.</h3>
              </p>
              <a href="/join-damn-plus" class="btn btn-default btn-lg join-btn" role="button" title="Join DAMN +">JOIN DAMN +</a>

              <?php /* subscribe to the magazine - display cover based on the issue this article resides */ ?>
              <div class="row marginTop marginBottom">
                <div class="col-xs-12">
                  <h2 class="marginTop">Subscribe to our print magazine</h2>
                </div>
                <div class="col-xs-7 col-sm-7 col-md-5 col-lg-4 latest-cover">

                <?php /* display cover based on the issue of this particular article. IF no damn issue taxonomy selected, default to latest issue */
                  $terms = get_the_terms( $post->ID, 'magazine' );

                  /* if the article is connected to an issue, load that issue's cover and link to that issue */
                  if ( !empty( $terms ) ){
                    // get the first term
                    $term = array_shift( $terms );

                    $issue_acf_id = 'magazine_' . $term->term_id;
                    $link = get_term_link(intval($term->term_id),'magazine');

                    $magazineimage = wp_get_attachment_image_src(get_field('magazine_taxonomy_image', $issue_acf_id), 'medium');

                    echo "<div class='item'>";
                      echo "<div class='news-item whiteBackground marginBottom'>";
                        echo '<div class="post-image noMargin">';
                          echo "<a href=\"{$link}\" title='{$term->name}'>";
                            echo '<img src="'.$magazineimage[0].'" alt="'.$term->name.'" class="placeholder" />';
                          echo "</a>";
                        echo "</div>";
                      echo "</div>";
                    echo "</div>";

                    echo "<p class='noMargin'>";
                    echo "</p>";
                    echo '<h3>'.$term->name.'</h3>';

                  } else /* default to latest issue to avoid error */ {

                    global $issue, $issue_color, $issue_number;

                    $issue = $_GET['issue'] ? get_term_by('slug', preg_replace ("/[^A-Za-z0-9-]/", '', $_GET['issue']), 'magazine'): get_field ('current_issue', 'option');
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
                  }
                ?>

                </div>
                <div class="col-xs-12 col-sm-12 col-md-7 col-lg-8">
                  <p>Don’t miss a single copy of DAMN° Magazine! Build your own library and feel DAMN° by taking a yearly subscription today.</p>
                  <h3>6 issues for €70 (Europe)</h3>
                  <h3>$172 (rest of the world)</h3>
                </div>
                <div class="col-xs-12">

                  <a class="btn btn-lg btn-default text-uppercase" href="https://www.bruil.info/damn" target="_blank" title="Subscribe Now">SUBSCRIBE</a>

                  &nbsp; or &nbsp;

                  <a class="btn btn-lg btn-default text-uppercase" href="http://www.bruil.info/magazine-damn/back-issues" target="_blank" title="Order Back Issue">ORDER BACK ISSUE</a>
                </div>
                <div class="clearthis"></div>
              </div>

            </div>
          </div>
        <?php } ?>
        <?php /* end if damn + and can or can't access locked content */ ?>

      <?php } else { ?>

        <?php /* or else if not in DAMN+, show all content normally, as this is not on a protected post */ ?>
        <?php
	        
	    the_content(); 
        
		/*$images =& get_children( 'post_type=attachment&post_mime_type=image&post_parent=' . get_the_ID ());
		
		if ($images)
		{
			print_r ($images);
			
			//array_shift($images);
			
			foreach ( $images as $attachment_id => $attachment )
				echo wp_get_attachment_image( $attachment_id, 'full' );
		}*/
		
        ?>
        
        <?php /* Add Menifesto, if so */ 
		
		if( has_category("manifesto")) : 
			global $issue_number;
		?>
			<hr>
			<div class='previous'><a href="/category/manifesto">View All</a> <a href="/?issue=damn-<?=$issue_number-1?>#manifesto">/ Previous Manifesto</a></div>
			
		<?php endif; ?>
		
        <?php /* Multiple external URL links, if added */ ?>
        <?php get_template_part('templates/snippet', 'external-links'); ?>

        <?php /* REUSED snippet to display standard post footer */ ?>
        <?php get_template_part('templates/snippet', 'post-footer'); ?>

      <?php } ?>

    </div>


  </article>
<?php endwhile; ?>

