<?php 

namespace SimpleFavorites\API\Shortcodes;

use SimpleFavorites\Entities\User\UserFavorites;

class UserFavoritesShortcode 
{

	/**
	* Shortcode Options
	* @var array
	*/
	private $options;

	/**
	* List Filters
	* @var array
	*/
	private $filters;

	public function __construct()
	{
		add_shortcode('user_favorites', array($this, 'renderView'));
	}

	/**
	* Shortcode Options
	*/
	private function setOptions($options)
	{
		$this->options = shortcode_atts(array(
			'user_id' => '',
			'site_id' => '',
			'include_links' => 'true',
			'post_types' => '',
			'include_buttons' => 'false'
		), $options);
	}

	/**
	* Parse Post Types
	*/
	private function parsePostTypes()
	{
		if ( $this->options['post_types'] == "" ) return;
		$post_types = explode(',', $this->options['post_types']);
		$this->filters = array('post_type' => $post_types);
	}

	/**
	* Render the HTML list
	* @param $options, array of shortcode options
	*/
	public function renderView($options)
	{
		$this->setOptions($options);
		$this->parsePostTypes();
		
		$this->options['include_links'] = ( $this->options['include_links'] == 'true' ) ? true : false;
		$this->options['include_buttons'] = ( $this->options['include_buttons'] == 'true' ) ? true : false;
		if ( $this->options['user_id'] == "" ) $this->options['user_id'] = null;
		if ( $this->options['site_id'] == "" ) $this->options['site_id'] = null;

		$favorites = new UserFavorites($this->options['user_id'], $this->options['site_id'], $this->options['include_links'], $this->filters);
		return $favorites->getFavoritesList($this->options['include_buttons']);
	}

}