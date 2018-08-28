<?php
/**
 * Handler for functionality.
 * This class binds overs together.
 *
 * @since      1.0.0
 * @package    BoostCookie
 * @subpackage BoostCookie/Classes
 * @author     Matthew Bull <matthewbull@boostonline.co.uk>
 */

namespace BoostCookie\Classes;

use BoostCookie\Classes\Loader as Loader;
use BoostCookie\Classes\CookieNotification as Cookies;

class Core
{
	protected $loader;
	protected $version;

	private static $instance = null;

	public static function instance()
	{
 		null === self::$instance and self::$instance = new self;
        return self::$instance;
	} 

	public function __construct()
	{
		$this->version = '0.3';

		$this->loader = new Loader;

		$this->define_admin_hooks();
		$this->define_public_hooks();
	}

	/**
	 * Register all of the hooks related to the admin-facing functionality of the plugin.
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks()
	{
		$cookie = new Cookies($this->version);
		$this->loader->add_action('init', $cookie, 'register_shortcodes');
	}

	/**
	 * Register all of the hooks related to the public-facing functionality of the plugin.
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() 
	{
		$cookie = new Cookies($this->version);

		# cookie assets		
		$this->loader->add_action('wp_footer', $cookie, 'enqueue_public_scripts');
		$this->loader->add_action('wp_footer', $cookie, 'enqueue_public_styles');
	}
    
	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 * @since    1.0.0
	 */
	public function run() 
	{
		$this->loader->run();
	}
}