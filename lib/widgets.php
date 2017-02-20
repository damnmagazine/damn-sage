<?php // Other Articles, All Categories - Widget
class blog_Widget extends WP_Widget {
	function blog_Widget() {
		$widget_ops = array( 'classname' => 'latest-articles', 'description' => 'List of latest articles across all categories' );
		parent::__construct( 'latest_articles', 'Latest Articles', $widget_ops );
	}

	function widget( $args, $instance ) {
		extract( $args, EXTR_SKIP );
		echo $before_widget;
		$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };

		global $post;
		$args=array(
			'posts_per_page'=> $instance['posts_number'], // Number of related posts that will be shown.
			'post_type' => 'post',
			'post__not_in' => array($post->ID),
		);
		$my_query = new wp_query( $args );
		if( $my_query->have_posts() ) {
			echo '<ol class="latest-articles-list">';
			while( $my_query->have_posts() ) {
				$my_query->the_post();
				$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail' );
				$url = $thumb['0'];
				?>
				<li class="<?php foreach(get_the_category() as $category) { echo $category->slug . ' ';} ?>">
					<?php if ( has_post_thumbnail()) { ?>
						<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>" class="list-thumb" style="background-image:url(<?=$url?>);">
					<?php } else { ?>
						<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>" class="list-thumb">
					<?php } ?>
							<img src="<?= get_template_directory_uri(); ?>/dist/images/blank-square.png" alt="<?php the_title_attribute(); ?>" />
						</a>
					<div class="list-meta">
						<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
							<?php /* if video post format, show play icon */ if ( has_post_format( 'video' )) { ?>
								<i class="fa fa-play-circle-o play-video-icon"></i>
							<?php /* else if photo gallery format */ } elseif ( has_post_format( 'gallery' )) { ?>
								<i class="fa fa-camera"></i>
							<?php } ?>
							<?php the_title(); ?>
						</a><br />
						<?php /* display category links as a comma separated list, and not the block format */
						get_template_part('templates/snippet', 'category-link-sep'); ?>
					</div>
					<div class="clearthis"></div>
				</li>
			<?php }
			echo '</ol>';
		}
		wp_reset_query();
		echo $after_widget;
	}


	/** @see WP_Widget::update */
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['posts_number'] = strip_tags($new_instance['posts_number']);
		return $instance;
	}

	/** @see WP_Widget::form */
	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'title'    => 'Latest', 'posts_number'  => '5' ));
		$title = strip_tags($instance['title']);
		$posts_number = strip_tags($instance['posts_number']);
		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>">Widget Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
		<p><label for="<?php echo $this->get_field_id('posts_number'); ?>">Number of Items: <input class="widefat" id="<?php echo $this->get_field_id('posts_number'); ?>" name="<?php echo $this->get_field_name('posts_number'); ?>" type="text" value="<?php echo esc_attr($posts_number); ?>" /></label></p>
		<?php
	}
}
// register widget
add_action( 'widgets_init', create_function( '', "register_widget('blog_Widget');" ) );


// Productivity list widget
class product_Widget extends WP_Widget {
	function product_Widget() {
		$widget_ops = array( 'classname' => 'latest-articles', 'description' => 'Product Lists' );
		parent::__construct( 'product_widget', 'Productivity', $widget_ops );
	}

	function widget( $args, $instance ) {
		extract( $args, EXTR_SKIP );
		echo $before_widget;
		$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };

		global $post;
		$args=array(
			'posts_per_page'=> $instance['posts_number'], // Number of related posts that will be shown.
			'post_type' => 'product',
			'post__not_in' => array($post->ID),
		);
		$my_query = new wp_query( $args );
		if( $my_query->have_posts() ) {
			echo '<ol class="latest-articles-list">';
			while( $my_query->have_posts() ) {
				$my_query->the_post();
				$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail' );
				$url = $thumb['0'];
				?>
				<li class="<?php foreach(get_the_category() as $category) { echo $category->slug . ' ';} ?>">
					<?php if ( has_post_thumbnail()) { ?>
						<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>" class="list-thumb" style="background-image:url(<?=$url?>);">
					<?php } else { ?>
						<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>" class="list-thumb">
					<?php } ?>
							<img src="<?= get_template_directory_uri(); ?>/dist/images/blank-square.png" alt="<?php the_title_attribute(); ?>" />
						</a>
					<div class="list-meta">
						<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
							<?php /* if video post format, show play icon */ if ( has_post_format( 'video' )) { ?>
								<i class="fa fa-play-circle-o play-video-icon"></i>
							<?php } ?>
							<?php the_title(); ?>
						</a><br />
						<?php /* display category links as a comma separated list, and not the block format */
						get_template_part('templates/snippet', 'category-link-sep'); ?>
					</div>
					<div class="clearthis"></div>
				</li>
			<?php }
			echo '</ol>';
		}
		wp_reset_query();
		echo $after_widget;
	}


	/** @see WP_Widget::update */
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['posts_number'] = strip_tags($new_instance['posts_number']);
		return $instance;
	}

	/** @see WP_Widget::form */
	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'title'    => 'Productivity', 'posts_number'  => '5' ));
		$title = strip_tags($instance['title']);
		$posts_number = strip_tags($instance['posts_number']);
		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>">Widget Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
		<p><label for="<?php echo $this->get_field_id('posts_number'); ?>">Number of Items: <input class="widefat" id="<?php echo $this->get_field_id('posts_number'); ?>" name="<?php echo $this->get_field_name('posts_number'); ?>" type="text" value="<?php echo esc_attr($posts_number); ?>" /></label></p>
		<?php
	}
}
// register widget
add_action( 'widgets_init', create_function( '', "register_widget('product_Widget');" ) );


// magazines widget

class magazine_Widget extends WP_Widget {
	function magazine_Widget() {
		$widget_ops = array( 'classname' => 'other-issues', 'description' => 'List of other magazine issues' );
		parent::__construct( 'magazine_related', 'Magazine Issues', $widget_ops );
	}

	function widget( $args, $instance ) {
		extract( $args, EXTR_SKIP );
		echo $before_widget;
		$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };

		$tax = 'magazine';
		$current_item = get_queried_object();
		$current_issue_number = abs(filter_var($current_item->slug, FILTER_SANITIZE_NUMBER_INT));
		$tax_args = array(
			'orderby' => 'name',
			'order' => 'DESC',
			'exclude' => $current_item->term_id,
		);
		$magazines = get_terms( $tax, $tax_args );
		echo '<ul class="older-issues-list">';

		$display_magazines = array();
		foreach($magazines as $magazine) {
			$issue_number = abs(filter_var($magazine->slug, FILTER_SANITIZE_NUMBER_INT));
			$display_magazines[$issue_number] = $magazine;
	 }

		arsort($display_magazines);

		$idx = 0;
		foreach($display_magazines as $issue_number => $magazine) {
			if($issue_number >= $current_issue_number){
				continue;
			}
			if($idx >= $instance['posts_number']){
				break;
			}
			$idx++;

			$issue_acf_id = 'magazine_' . $magazine->term_id;
			$link = get_term_link(intval($magazine->term_id),'magazine');
			$image_url = get_template_directory_uri();
			$magazineimage = wp_get_attachment_image_src(get_field('magazine_taxonomy_image', $magazine->taxonomy.'_'.$magazine->term_id), 'medium');
			$issue_color = get_field('issue_color', $magazine->taxonomy.'_'.$magazine->term_id);
			$issue_number = get_field('magazine_number', $magazine->taxonomy.'_'.$magazine->term_id); { ?>

				<li<?php if($issue_color) { ?> style="background-color: <?php echo $issue_color; ?>"<?php } ?>>
					<div class="mag-image">
						<a href="<?php echo $link; ?>" rel="bookmark" title="<?php echo $magazine->name; ?>" class="list-thumb">
							<?php if($magazineimage) { ?>
								<img src="<?php echo $magazineimage[0]; ?>" alt="<?php echo $magazine->name; ?>" />
							<?php } else { ?>
								<img src="<?= get_template_directory_uri(); ?>/dist/images/blank-image-magazine.gif" alt="<?php echo $magazine->name; ?>" />
							<?php } ?>
						</a>
					</div>
					<h2><a href="<?php echo $link; ?>" title="<?php echo $magazine->name; ?>"><?php echo $magazine->name; ?></a></h2>
					<span><a href="<?php echo $link; ?>" title="<?php echo $magazine->name; ?>"><?php the_archive_description(); ?></a></span>
					<span>Articles: <?php echo $magazine->count; ?></span>
					<div class="clearthis"></div>
				</li>
			<?php }
		}
		echo '</ol>';
		echo $after_widget;
	}


	/** @see WP_Widget::update */
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['posts_number'] = strip_tags($new_instance['posts_number']);
		return $instance;
	}

	/** @see WP_Widget::form */
	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'title'    => 'Latest', 'posts_number'  => '5' ));
		$title = strip_tags($instance['title']);
		$posts_number = strip_tags($instance['posts_number']);
		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>">Widget Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
		<p><label for="<?php echo $this->get_field_id('posts_number'); ?>">Number of Items: <input class="widefat" id="<?php echo $this->get_field_id('posts_number'); ?>" name="<?php echo $this->get_field_name('posts_number'); ?>" type="text" value="<?php echo esc_attr($posts_number); ?>" /></label></p>
		<?php
	}
}
// register widget
add_action( 'widgets_init', create_function( '', "register_widget('magazine_Widget');" ) );


// Calendar Agenda widget
class agenda_Widget extends WP_Widget {
	function agenda_Widget() {
		$widget_ops = array( 'classname' => 'calendar-events', 'description' => 'List of latest calendar events' );
		parent::__construct( 'calendar-events', 'Agenda - Latest Calendar Events', $widget_ops );
	}

	function widget( $args, $instance ) {
		extract( $args, EXTR_SKIP );
		echo $before_widget;
		$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };

		global $post;

		$today = date('Ymd');
		$args = array (
			'posts_per_page'=> $instance['posts_number'], // Number of posts that will be shown.
			'post_type' => 'calendar',
			'meta_query' => array(
			array(
					'key'   => 'start_date',
					'compare' => '<=',
					'value'   => $today,
				),
				 array(
					'key'   => 'end_date',
					'compare' => '>=',
					'value'   => $today,
				)
			),
			'meta_key' => 'start_date', // name of custom field
			'orderby' => 'meta_value_num',
			'order' => 'DESC'
		);

		$my_query = new wp_query( $args );
		if( $my_query->have_posts() ) {
			echo '<ol class="latest-calendar-list list-group">';
			while( $my_query->have_posts() ) {
				$my_query->the_post();
				$startdate = get_field('start_date');
				$enddate = get_field('end_date');
				$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail' );
				if ( $thumb ){
					 $url = $thumb['0'];
				} else {
					if( get_post_meta( $post->ID , '_scheduled_thumbnail_list' ) ){
						$list = get_post_meta( $post->ID, '_scheduled_thumbnail_list');
						$array =json_decode($list[0]);
						$thumb = wp_get_attachment_image_src( $array[0], 'thumbnail' );
						$url = $thumb['0'];
					}
				}

				?>

				<li class="list-group-item <?php foreach(get_the_category() as $category) { echo $category->slug . ' ';} ?>">
					<?php if ( has_post_thumbnail() || get_post_meta( $post->ID , '_scheduled_thumbnail_list' ) ) { ?>
						<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>" class="list-thumb positionRelative" style="background-image:url(<?=$url?>);">

							<?php /* calendar box */ if(get_field('start_date')) { ?>
								<?php $date = get_field('start_date');
									$datemonth = date("M", strtotime($date));
									$dateday = date("j", strtotime($date));
								?>

								<div class="calendar-box">
									<div class="calendar-box-wrapper">
										<span class="month"><?php echo $datemonth; ?></span>
										<span class="day"><?php echo $dateday; ?></span>
									</div>
								</div>
							<?php } ?>

							<img src="<?= get_template_directory_uri(); ?>/dist/images/blank-square.png" alt="<?php the_title_attribute(); ?>" />
						</a>
					<?php } else { ?>
						<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>" class="list-thumb positionRelative">
					<?php } ?>

					<?php if ( has_post_thumbnail()) { ?>
						<div class="list-meta">
					<?php } else { ?>
						<div class="list-meta fullWidth">
					<?php } ?>
						<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>" class="boldText grey-font">
							<?php /* if video post format, show play icon */ if ( has_post_format( 'video' )) { ?>
								<i class="fa fa-play-circle-o play-video-icon"></i>
							<?php } ?>
							<?php the_title(); ?>
						</a>
						<span class="small-date">
							<?php if($startdate) { ?>
								<strong>Starts:</strong> <?php echo $startdate; ?><br />
							<?php } ?>
							<?php if($enddate) { ?>
								<strong>Ends:</strong> <?php echo $enddate; ?><br />
							<?php } ?>
						</span>
						<span><?php get_template_part('templates/snippet', 'category-link'); ?></span>
					</div>
					<div class="clearthis"></div>
				</li>
			<?php }
			echo '</ol>';
		}
		wp_reset_query();
		echo $after_widget;
	}


	/** @see WP_Widget::update */
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['posts_number'] = strip_tags($new_instance['posts_number']);
		return $instance;
	}

	/** @see WP_Widget::form */
	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'title'    => 'Events', 'posts_number'  => '5' ));
		$title = strip_tags($instance['title']);
		$posts_number = strip_tags($instance['posts_number']);
		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>">Widget Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
		<p><label for="<?php echo $this->get_field_id('posts_number'); ?>">Number of Items: <input class="widefat" id="<?php echo $this->get_field_id('posts_number'); ?>" name="<?php echo $this->get_field_name('posts_number'); ?>" type="text" value="<?php echo esc_attr($posts_number); ?>" /></label></p>
		<?php
	}
}
// register widget
add_action( 'widgets_init', create_function( '', "register_widget('agenda_Widget');" ) );


// Event widget
class event_Widget extends WP_Widget {
	function event_Widget() {
		$widget_ops = array( 'classname' => 'calendar-events events-events', 'description' => 'List of latest DAMN events' );
		parent::__construct( 'events-events', 'Events - Latest DAMN Events List', $widget_ops );
	}

	function widget( $args, $instance ) {
		extract( $args, EXTR_SKIP );
		echo $before_widget;
		$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };

		global $post;

		$args=array(
			'posts_per_page'=> $instance['posts_number'], // Number of related posts that will be shown.
			'post_type' => 'events',
			'post__not_in' => array($post->ID),
		);
		$my_query = new wp_query( $args );

		if( $my_query->have_posts() ) {
			echo '<ol class="latest-articles-list">';
			while( $my_query->have_posts() ) {
				$my_query->the_post();
				$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail' );
				$url = $thumb['0'];
				?>
				<li class="<?php foreach(get_the_category() as $category) { echo $category->slug . ' ';} ?>">
					<?php if ( has_post_thumbnail()) { ?>
						<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>" class="list-thumb positionRelative" style="background-image:url(<?=$url?>);">
					<?php } else { ?>
						<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>" class="list-thumb positionRelative">
					<?php } ?>

							<?php /* calendar box */ if(get_field('start_date')) { ?>
								<?php $date = get_field('start_date');
									$datemonth = date("M", strtotime($date));
									$dateday = date("j", strtotime($date));
								?>

								<div class="calendar-box">
									<span class="month"><?php echo $datemonth; ?></span>
									<span class="day"><?php echo $dateday; ?></span>
								</div>
							<?php } ?>

							<img src="<?= get_template_directory_uri(); ?>/dist/images/blank-square.png" alt="<?php the_title_attribute(); ?>" />
						</a>
					<div class="list-meta">
						<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
							<?php the_title(); ?>
						</a><br />
						<?php /* display category links as a comma separated list, and not the block format */
						get_template_part('templates/snippet', 'category-link-sep'); ?>
					</div>
					<div class="clearthis"></div>
				</li>
			<?php }
			echo '</ol>';
		}
		wp_reset_query();
		echo $after_widget;
	}


	/** @see WP_Widget::update */
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['posts_number'] = strip_tags($new_instance['posts_number']);
		return $instance;
	}

	/** @see WP_Widget::form */
	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'title'    => 'Agenda', 'posts_number'  => '5' ));
		$title = strip_tags($instance['title']);
		$posts_number = strip_tags($instance['posts_number']);
		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>">Widget Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
		<p><label for="<?php echo $this->get_field_id('posts_number'); ?>">Number of Items: <input class="widefat" id="<?php echo $this->get_field_id('posts_number'); ?>" name="<?php echo $this->get_field_name('posts_number'); ?>" type="text" value="<?php echo esc_attr($posts_number); ?>" /></label></p>
		<?php
	}
}
// register widget
add_action( 'widgets_init', create_function( '', "register_widget('event_Widget');" ) );


