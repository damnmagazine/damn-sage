<?php
/**
 * Sage includes
 *
 * The $sage_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 * @link https://github.com/roots/sage/pull/1042
 */
$sage_includes = [
  'lib/utils.php',                 // Utility functions
  'lib/init.php',                  // Initial theme setup and constants
  'lib/wrapper.php',               // Theme wrapper class
  'lib/conditional-tag-check.php', // ConditionalTagCheck class
  'lib/config.php',                // Configuration
  'lib/assets.php',                // Scripts and stylesheets
  'lib/titles.php',                // Page titles
  'lib/extras.php',                // Custom functions
  'lib/widgets.php',               // Custom widgets
  'lib/wp_bootstrap_navwalker.php', // Bringing back Bootstrap dropdown menu to the main nav
//'lib/damn.php'					// DAMN customisations
];

foreach ($sage_includes as $file) {
  if (!$filepath = locate_template($file)) {
	trigger_error(sprintf(__('Error locating %s for inclusion', 'sage'), $file), E_USER_ERROR);
  }

  require_once $filepath;
}
unset($file, $filepath);

/**
 *	DAMN 
 *	Magazine specific functions
 *	Issues, Ads, Brands
 */
class DAMN {
	
	/**
	 *	Current Issue
	 *	Can be global, or item related
	 */
	public $issue;
	
	/**
	 *	Latest Issue
	 *	Should always be defined
	 */
	public $latest_issue;
	
	/**
	 *	Is Latest
	 *	Is issue the latest?
	 */
	public $latest;
	
	/**
	 *	Single View Issue
	 *	Does the single view have an Issue connected
	 */
	public $issued;
	
	/**
	 *	Single Template
	 *	Does the single view have a template
	 */
	public $template;
	
	/**
	 *	Issue Contrast
	 *	Positive or Negative issue
	 */
	public $contrast;
	
	/**
	 *	DAMN
	 *	The Class Constructor
	 */
	public function __construct ()
	{
		# Post Issue
		$this->issued = is_single () && ($terms = get_the_terms (get_the_ID (), 'magazine'))? 
			
			array_shift ($terms): 
			null;
		
		# Latest Issue
		$this->latest_issue = get_field ('current_issue', 'option');
		
		if(!$this->latest_issue)
		
			throw new Exception('No current issue is set, please contact the DAMN° Moderator.');
		
		# Current Issue
		//if( isset(  $_GET['issue'] ) )
		$this->issue = $this->issued? : $this->filterIssue ( $_GET['issue']);
		
		$this->expandIssue ();
		
		# Latest
		if( isset ($DAMN ) ) 
			$this->latest = $DAMN->latest_issue->term_id == $DAMN->issue->term_id;
		
		# Template
		$this->template = is_single()? 
			
			get_post_meta (get_the_ID (), '_template_slug', true): 
			null;
			
		# Contrast
		if( $this->issue )
			$this->contrast = (int) get_field ('colour_scheme', $this->issue->acf_id);
	}
	
	/**
	 *	Issue
	 *	Filter issue
	 */
	public function filterIssue ($slug)
	{
		if ($slug)
			$issue = get_term_by ('slug', preg_replace ("/[^A-Za-z0-9-]/", '', $slug), 'magazine');
		
		return $issue? : $this->latest_issue;	
	}
	
	/**
	 *	Issue
	 *	Expand Issue
	 */
	public function expandIssue ()
	{
		# afc id
		if( $this->issue ){
			$this->issue->acf_id	= 'magazine_' . $this->issue->term_id;
			
			$this->issue->link		= get_term_link ($this->issue->term_id, 'magazine');
			$this->issue->color		= get_field ('issue_color', $this->issue->acf_id);
			$this->issue->number	= get_field ('magazine_number', $this->issue->acf_id);
			
			$id = get_field ('magazine_taxonomy_image', $this->issue->acf_id);
			$this->issue->thumbnail	= $id? array_shift (wp_get_attachment_image_src ($id, 'small')): null;
		}

	}
	
	/**
	 *	Related Filters
	 */
	 
	/**
	 *	Related Posts
	 *	Topical relation, with advertorial
	 */
	public function relatedPosts ($limit, $_single, $categories = null, $tags = null, $exclude = [], $orderby = null, $offset = 0 )
	{
		wp_reset_query();

		$orderby = $orderby?: 'rand';

		# Filters
		$args = [];
		$base_args = [
			'posts_per_page' => $limit == -1? $limit: $limit * 2,
			'post_type'		 => array('post','product','calendar'),
			'date_query'	 => [
				[
					'column' => 'post_date',
					'after'  => '2 year ago',
				]
			],
			'orderby'		 => $orderby,
			//'post__not_in'	 => $exclude
			'meta_query' => array(
				array(
					'key' => '_thumbnail_list',
					'value' => '[""]',
					'compare' => '!='
				),
				array(
					'key' => '_thumbnail_list',
					'value' => '[]',
					'compare' => '!='
				)
			)
		];

		# Tags
		if( $tags && !is_array( $tags ) ){
			$args['tag_id'] = $tags;
		} else if($tags){
			$args['tag__in'] = $this->filterIds ($tags);
		}

		
		# Categories
		else if($categories) $args['category__in'] = $this->filterIds ($categories);
		
		# pre-parse excludes
		//if(count ($exclude)) $exclude = $this->filterIds ($exclude);
		
		# In "the post"
		if($_single) $exclude[] = $_single->ID;
		
		# Excludes
		if(count ($exclude)) $args['post__not_in'] = $exclude;

		$list = get_posts (array_merge ($base_args, $args));

		# Output limit
		if ($limit != -1 && count ($list) > $limit)
			
			$list = array_slice ($list, 0, $limit);
			
		# Fill to limit
		else if (count ($list) < $limit && $_single)
		{	
			$base_args['posts_per_page'] = $limit - count ($list);
			$base_args['post__not_in']	 = array_merge ($this->filterIds ($list), $exclude);
			$base_args[ 'author']		 = $_single->post_author;
			
			$list = array_merge ($list, get_posts ($base_args));
		}
		
		# Add partner content
		if($partnered = $this->partneredContent (1, 'post'))
		
			$list [rand (0,count($list)-1)] = $partnered;

		#offset posts
		if ( $offset > 0 ){

			$the_list = $list;
			$list = array();
			$counter = 1;

			foreach ($the_list as $post) {
				if( $counter > $offset ){
					array_push($list, $post);
				}
				$counter++;
			}

		}
		/* Make sure there is a thumbail */
		//
		foreach ( $list as $post ) {
			if( get_post_meta( $post->ID, 'scheduled' ) ){
				$thumbId =  get_post_meta( $post->ID, '_scheduled_thumbnail_id' );
				$url =  wp_get_attachment_url( $thumbId[0] );
				$post->fallback_image_url = $url;
			} 
		} wp_reset_postdata();

		return $this->sugar ($list);
	}

	/**
	 *	Related Products
	 *	Topical relation, with partner product
	 */
	public function relatedProducts ($limit, $is_single, $categories = null, $tags = null, $exclude = null)
	{
		
	}
	
	/**
	 *	Related Calendar Nodes
	 *	Topical relation, currently running, with partner calendar
	 */
	public function relatedCalendars ($limit, $is_single, $categories = null, $tags = null, $exclude = null)
	{
	}
	
	/**
	 *	Partner Content
	 *	Advertorials or highlighted content
	 */
	public function partneredContent ($limit, $post_type, $categories = null, $tags = null, $exclude = null)
	{
		$date = date('Ymd');
		
		$args = [
			'posts_per_page' => $limit,
			'post_type'      => $post_type,
			'meta_query'	 => [
				'relation'		=> 'AND',
				[
					'key'		=> 'highlight_start_date',
					'compare'	=> '<=',
					'value'		=> $date,
				],
				[
					'key'		=> 'highlight_end_date',
					'compare'	=> '>=',
					'value'		=> $date,
				]
			]
		];
		
		return get_posts ($args);
	}
	
	/**
	 *	Return IDs
	 *	Like the title says
	 */
	 public function filterIds ($list)
	 {
		 return $list? 
			
			array_map (function ($item){ return $item->ID | $item->post_id | $item->term_id | $item->id; }, $list): 
			[];
	 }
	 
	 /**
	 *	Sugar Item
	 *	Add additional required data per post
	 */
	 public function sugar ($list)
	 {
		 return array_map (function ($item)
		 {
			$id = $item->ID | $item->post_id | $item->term_id | $item->id;
			
			# Sub-title
			$item->subtitle = get_field ('sub-title', $id);
			
			# Thumbnail
			$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id ($id), 'full');			
			$item->thumbnail = $thumbnail[0];
			
			# Issue
			if ($terms = get_the_terms ($id, 'magazine'))
			{
				$term = array_shift ($terms); 
				$item->issue = get_field ('magazine_number', 'magazine_' . $term->term_id);
			}
			
			return $item;
			 
		 }, $list);
	 }
}


/**
 *	Fetch post image
 *	@return	string	image url string
 */
function fetch_post_image ()
{
	if (has_post_thumbnail () && !has_post_format('quote'))
	{
		$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' );
		$url = $thumb['0'];
	} else {
		if ( get_post_meta( $post->ID, '_scheduled_thumbnail_id' ) ){
			$array = get_post_meta( $post->ID, '_scheduled_thumbnail_id' );
			$thumb = wp_get_attachment_image_src( $array [0], 'large' );
			$url = $thumb['0'];
		} else if ( get_post_meta( $post->ID, '_scheduled_thumbnail_list') ){
			$list = get_post_meta( $post->ID, '_scheduled_thumbnail_list');
			$array =json_decode($list[0]);
			$thumb = wp_get_attachment_image_src( $array[0], 'large' );
			$url = $thumb['0'];
		}
	}
	
	return $url;
}



/**
 * Filter the except length to 20 characters.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function damn_custom_excerpt_length( $length ) {
	return 30;
}
add_filter( 'excerpt_length', 'damn_custom_excerpt_length', 999 );


function damn_add_pinterest_code(){
?>
	<meta name="p:domain_verify" content="4aad6966ef02523e0cbf9b5af759e550"/>
<?php
}
add_action( 'wp_head', 'damn_add_pinterest_code', 1 );


function damn_widget_title_link( $title ) {
	if( strtolower( $title ) == "instagram" ) {
		return "<a href=\"https://www.instagram.com/damn_magazine/\">".$title."</a>";
	} 
	return $title;
}
add_filter( 'widget_title', 'damn_widget_title_link' );



/* 
* Automatic email notification
 */
add_action( 'save_post', 'damn_send_email' );
function damn_send_email( $post_id ) {


	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
		return;


	if( get_post_status( $post_id) != 'publish' )
		return;


	if ( !wp_is_post_revision( $post_id ) ) {

		$dir = WP_CONTENT_DIR ."/uploads";

		$checker = get_field( 'email_notification', $post_id );

		if ( $checker ){

			$post_type = get_post_type( $post_id ) ;

			if ( $post_type == "product" ) {
				$post_type = "work";
			} else if ( $post_type == "calendar" ){
				$post_type = "event";
			} else {
				$post_type = "post";
			}

			$terms = wp_get_post_terms( $post_id, 'magazine', array('orderby' => 'name', 'order' => 'ASC' ) );
			$covers = array();

			if( count( $terms ) > 1 ){

				$issue = "";
				$numItems = count($terms);

				foreach ( $terms as $term ) {
					if(++$i === $numItems) {
						$issue = substr( $issue, 0, -2 );
						$issue .= ' and ';
						$issue .= $term->name;
					} else {
						$issue .= $term->name;
						$issue .= ', ';
					}

					$image_id = get_field( 'magazine_taxonomy_image', $term->taxonomy . '_' . $term->term_id );
					$image_data = wp_get_attachment_metadata( $image_id );

					$image_dir = $dir . "/" . $image_data['file'];

					$covers[] = $image_dir; 
				}

			} else {
				$issue = $terms[0]->name;
				$image_id = get_field( 'magazine_taxonomy_image', $terms[0]->taxonomy . '_' . $terms[0]->term_id );

				$image_data = wp_get_attachment_metadata( $image_id );

				$image_dir = $dir . "/" . $image_data['file'];

				$covers[] = $image_dir; 
			}

			$permalink = get_permalink( $post_id );

			$name = null;

			$default_content = '';
			$default_content .= "Your " . $post_type . " is published in our website - <a href='http://www.damnmagazine.net'>www.damnmagazine.net</a><br><br><br>"; 
			$default_content .= "Please store it for your archive and feel free to share this on Facebook, Twitter, Instagram, LinkedIn and all the social networks you are on. It benefits us all.<br><br>";
			$default_content .= "If you could send us the link to your post, we can re-publish it to boost your numbers.<br><br>";
			$default_content .= "Also, here is the link to the online publication:<br><br>";
			$default_content .= $permalink ."<br><br><br>";

			$pdf = get_field( 'email_pdf', $post_id );
			if ( $pdf ){
				$default_content = '';
				$default_content .= "Your " . $post_type . " is published in our current " . $issue . "<br><br>"; 
				$default_content .= "Attached you can find the pdf of the publication plus the cover.<br><br>"; 
				$default_content .= "Please store it for your archive and feel free to share this on Facebook, Twitter, Instagram, LinkedIn and all the social networks you are on. It benefits us all.<br><br>"; 
				$default_content .= "If you could send us the link to your post, we can re-publish it to boost your numbers.<br><br>";
				$default_content .= "Also, here is the link to the online publication:<br><br>";
				$default_content .= $permalink ."<br><br><br>";
			}

			$headers[] = 'Reply-To: Maria Ribeiro <maria@damnmagazine.net>';
			$headers[] = 'From: Maria Ribeiro <maria@damnmagazine.net>';
			$headers[] = 'Content-Type: text/html; charset=UTF-8';

			//$headers[] = 'Cc: Bessaam El-Asmar <bessaam@damnmagazine.net>';
			//$headers[] = 'Cc: Maria Ribeiro <maria@damnmagazine.net>';

			if ( have_rows( 'email_recipient', $post_id ) ){
				while ( have_rows( 'email_recipient', $post_id ) ){
					the_row();

					$email = get_sub_field( 'recipient_email', $post_id );

					$subject = "DAMNº Magazine / featured article_​";

					$content = "Dear " .  get_sub_field( 'recipient_name', $post_id ) . " team,<br><br><br>";
					$content .= $default_content; 

					$content .= "If you are not subscribed to DAMn Magazine but would like to support us with a subscription, just let me know. <br><br>";
					$content .= "Best regards <br><br>";
					$content .= "Maria Ribeiro <br>";
					$content .= "digital assistant <br><br>";
					$content .= "<a href='https://www.facebook.com/DAMnmagazine-27113480473/'>facebook</a> | <a href='https://www.instagram.com/damn_magazine/'>instagram</a>  | <a href='https://twitter.com/damntwice'>twitter</a> <br><br>";

					$body = get_field( 'email_content', $post_id ) ? get_field( 'email_content', $post_id ) : $content;

					if ( $pdf ){

						$file = array( $dir . date( "/Y/m/",  strtotime( $pdf['date'] ) ) . $pdf['filename']  );

						$attachments = array_merge( $file, $covers );

						wp_mail( $email, $subject, $body, $headers, $attachments );

					} else {

						wp_mail( $email, $subject, $body, $headers );

					}
				}
			}

			if ( $pdf ){
				wp_mail( 'maria@damnmagazine.net', $subject, $body, $headers, $attachments );
			} else {
				wp_mail( 'maria@damnmagazine.net', $subject, $body, $headers );
			}

		}

	}
}


/*
* AJAX load more
 */
add_action( 'wp_ajax_nopriv_ajax_load', 'projects_ajax_load' );
add_action( 'wp_ajax_ajax_load', 'projects_ajax_load' );

function projects_ajax_load() {

	$tag_name = get_field( 'project_tag', 'option' );

	$tag = get_term_by('name', $tag_name, 'post_tag');

	$args = array( 'post_type' => 'post', 'offset' => 5, 'tag__in' => $tag ? array( $tag->term_id ) : null );

	$query = new WP_Query( $args );

	if( $query->have_posts() ){
		$x = 0;
		while ( $query->have_posts() ) {
			$query->the_post();
			global $post;

			$post->place = get_field( 'city_country' );

			$thumb = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID), 'large' );
			$url = $thumb['0'];

			if( $x % 2 == 0 ){ 
				$float = "left";
			} else { 
				$float = "right";
			}
		?>
			<article class="item-project col-md-12 float-<?php echo $float; ?>">

				<div class="row">

					<div class="col-md-5 post-image" style="background-image: url(<?php echo $url; ?>)"><a class="home-img-link" href="<?php the_permalink(); ?>"></a></div>

					<div class="col-md-7">
						<a href="{{permalink}}" rel="bookmark" title="">
							<h1><?php echo get_the_title();  ?>/ <span class="description"><?php echo get_field( 'city_country' ); ?></span></h1></a>
							<p class="designers"><?php echo get_field( 'designers' ); ?></p>

							<p class="project-excerpt"><?php echo $post->post_excerpt  ?> <a href="<?php the_permalink(); ?>">...</a> <a class="projects-read-more" href="<?php the_permalink(); ?>"> Read More </a></p>
					
					</div>

				</div>
				<hr>
			</article>

		<?php
		$x++;
		}
	} wp_reset_postdata(); wp_reset_query();

	die();
}

/**
 * Bootstrap-class menu items, by filter & walker class
 */
class bootstrap_walker extends Walker_Nav_Menu
{
	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<ul class=\"dropdown-menu\">\n";
	}
}

function nav_menu_css_class_bootstrap_conversion($classes) 
{
	# Dropdowns
	if (in_array ('menu-item-has-children', $classes))	$classes[] = 'dropdown';
		
	
	return $classes;
}

add_filter( 'nav_menu_css_class', 'nav_menu_css_class_bootstrap_conversion', 10, 4);



/*
* Programmaticaly add menu items
 
function damn_add_menu_items( $items, $menu ) {

	if( $menu->menu->slug === 'main-nav' ){
		
		$new_item = array();

		 $item = array(
			'title'            => 'Projects',
			'attr_title'       => 'divider',
			'menu_item_parent' => 0,
			'ID'               => '',
			'db_id'            => '',
			'url'              => '/projects',
			'classes'          => array( 'menu-item' )
		);

		$new_item[] = (object) $item;  // Add the new menu item to our array

		$index = count( $items ) - 14;
		array_splice( $items, $index, 0, $new_item );

	}

	return $items;

}*/
//add_filter( 'wp_nav_menu_objects', 'damn_add_menu_items', 10, 2 );

