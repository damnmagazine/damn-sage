<?php namespace Roots;


/**
 *	DAMN Custom Class
 */

class DAMN {

	/**
	 * 	Home - amount of posts queried
	 *
	 *	@param	int		$home_posts_amount
	 */
	private static $home_posts_amount = 20;

	/**
	 * 	Home - post types
	 *
	 *	@param	array	$home_post_types
	 */
	private static $home_post_types = ['post', 'calendar'];

	/**
	 *	Filter Issue based
	 *	Activate when $_GET issue is provided
	 *
	 *	@param	object	$query
	 */
	public static function filter_on_issue ($query)
	{
		$issue = preg_replace ("/[^A-Za-z0-9-]/", '', $_GET['issue']);

		if ($issue && !is_admin() && $query->is_main_query())
		{
			$query->set ('tax_query', [
				'taxonomy' => 'magazine',
	            'field' => 'slug',
	            'terms' => array( $issue )
			]);
		}
	}

	/**
	 *	Home filter
	 *	Activate on home
	 *
	 *	@param	object	$query
	 */
	public static function filter_home ($query)
	{
		if ($query->is_home())
		{
			$query->set('post_type', self::$home_post_types);
			$query->query_vars['posts_per_page'] = self::$home_posts_amount;
		}
	}

 }