<?php
/**
 * Cookie notification plugin.
 *
 * @since      1.0.0
 * @package    BoostCookie
 * @subpackage BoostCookie/Classes
 * @author     Matthew Bull <matthewbull@boostonline.co.uk>
 */

namespace BoostCookie\Classes;

class CookieNotification
{
	public function __construct($version) 
	{
		$this->version = $version;
	}

	/**
	 * Register the shortcodes for the admin.
	 * @since    1.0.0
	 */
	public function register_shortcodes()
	{
		add_shortcode('cookie_notification', [$this, 'shortcode']);
	}

	/**
	 * Include the template for the shortcode notification.
	 * @since    1.0.0
	 */
	public function shortcode()
	{
		include_once AC_PLUGIN_PATH . 'views/cookie-shortcode.php';
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 * @since    1.0.0
	 */
	public function enqueue_public_styles() 
	{
		wp_enqueue_style('boost-cookie', AC_PLUGIN_URL . 'assets/css/cookie-public.css', [], $this->version, 'all');
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 * @since    1.0.0
	 */
	public function enqueue_public_scripts() 
	{
		wp_enqueue_script('boost-cookie', AC_PLUGIN_URL . 'assets/js/min/cookie-public-min.js', [ 'jquery' ], $this->version, false);
	}

}