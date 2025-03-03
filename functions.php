<?php
/**
 * Theme functions and definitions
 * 
 * @package WordPress
 */

// Exit if accessed directly.
if (!defined("ABSPATH")) {
	exit;
}

// Ensure the Requests library is loaded
if (!class_exists('WpOrg\Requests\Autoload')) {
	require_once ABSPATH . WPINC . '/class-requests.php';
}

use WpOrg\Requests\Requests;

// Core constants 
define("THEME_DIR", get_template_directory());
define("THEME_URI", get_template_directory_uri());

/**
 * Theme class
 */
final class Theme_Functions
{

	/**
	 * Add hooks and load theme functions 
	 * 
	 * @since 1.0
	 */
	public function __construct()
	{
		// Define theme constants
		$this->theme_constants();
		// Import theme files
		$this->theme_imports();

		// Setup theme support, nav menus, etc.
		add_action("after_setup_theme", array($this, "theme_setup"));

		if (is_admin()) {
			// Enqueue admin scripts
			add_action("admin_enqueue_scripts", array($this, "theme_admin_css"));
			add_action("admin_enqueue_scripts", array($this, "theme_admin_js"));
		} else {

			// Enqueue theme scripts
			add_action("wp_enqueue_scripts", array($this, "theme_css"));
			add_action("wp_enqueue_scripts", array($this, "theme_js"), 1);
		}

		// Enqueue theme fonts
		add_action("wp_enqueue_scripts", array($this, "theme_fonts"));
		add_action("admin_enqueue_scripts", array($this, "theme_fonts"));

		// Add action to make custom query before loading posts
		add_action("pre_get_posts", array($this, "set_query_params"));

		// Add action to define custom excerpt length
		add_filter("excerpt_length", array($this, "custom_excerpt_len"), 999);

		// Add action to make API request after CF7's form submission
		add_action('wpcf7_mail_sent', array($this, 'send_lead_to_jetimob'));
	}

	/**
	 * Define theme constants
	 *
	 * @since 1.0
	 */
	public static function theme_constants()
	{
		$version = self::get_theme_version();

		define("THEME_VERSION", $version);

		// JS and CSS files URIs
		define("THEME_JS_URI", THEME_URI . "/assets/js/");
		define("THEME_CSS_URI", THEME_URI . "/assets/css/");

		// Images URI
		define("THEME_IMG_URI", THEME_URI . "/assets/img/");

		// Fonts URI
		define("THEME_FONT_URI", THEME_URI . "/assets/fonts/");

		// Includes URI
		define("THEME_INC_DIR", THEME_DIR . "/inc/");
		define("THEME_INC_URI", THEME_URI . "/inc/");
	}

	/**
	 * Include theme classes and files
	 *
	 * @since 1.0
	 */
	public static function theme_imports()
	{
		// Directory of files to be included
		$dir = THEME_INC_DIR;

		require_once(THEME_DIR . '/configs.php');

		require_once($dir . 'walker/bs_menu_walker.php');

		require_once($dir . 'cpt/cpt-empreendimentos.php');
		require_once($dir . 'cpt/cpt-arquivo.php');

		require_once($dir . 'kirki/kirki.php');
		require_once($dir . 'customizer/customizer.php');

		require_once($dir . 'shortcodes/shortcodes.php');
		require_once($dir . 'helpers/helpers.php');
	}

	/**
	 * Setup theme support, nav menus, etc.
	 *
	 * @since 1.0
	 */
	public static function theme_setup()
	{
		// Register nav menus
		register_nav_menus(
			array(
				"main_menu"   => esc_html__("Principal"),
				"footer_menu"   => esc_html__("Rodapé"),
			)
		);

		// Enable support for site logo
		add_theme_support(
			"custom-logo",
			apply_filters(
				"custom_logo_args",
				array(
					"flex-height" => true,
					"flex-width"  => true,
				)
			)
		);

		add_filter('nav_menu_css_class', function ($classes, $item, $args) {
			if (isset($args->li_class)) {
				$classes[] = $args->li_class;
			}
			return $classes;
		}, 1, 3);

		// Enable support for Post Formats.
		add_theme_support('post-formats', array('video', 'gallery', 'audio', 'quote', 'link'));

		// Let WordPress handle Title Tag in all pages
		add_theme_support("title-tag");

		// Enable support for Post Thumbnails on posts and pages.
		add_theme_support('post-thumbnails');

		// Enable support for excerpt text on posts and pages.
		add_post_type_support('page', 'excerpt');

		// Switch default core markup to output valid HTML5.
		add_theme_support(
			'html5',
			array(
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'widgets',
			)
		);
	}

	/**
	 * Enqueue theme CSS
	 *
	 * @since 1.0
	 */
	public static function theme_css()
	{
		$dir = THEME_CSS_URI;

		$version = THEME_VERSION;

		wp_enqueue_style('theme-css', $dir . 'main.css', [], $version, false);

		wp_deregister_style("bootstrap");
		wp_enqueue_style('bootstrap', $dir . 'bootstrap.css', [], $version, false);
	}

	/**
	 * Enqueue theme JS
	 *
	 * @since 1.0
	 */
	public static function theme_js()
	{
		$dir = THEME_JS_URI;

		$version = THEME_VERSION;

		wp_enqueue_script('theme-js', $dir . 'main.js', ["jquery"], $version, false);
	}

	/**
	 * Enqueue theme CSS for admin
	 *
	 * @since 1.0
	 */
	public static function theme_admin_css()
	{
		$dir = THEME_CSS_URI;

		$version = THEME_VERSION;

		wp_enqueue_style('theme-admin-css', $dir . 'admin.css', [], $version, false);
	}

	/**
	 * Enqueue theme JS for admin
	 *
	 * @since 1.0
	 */
	public static function theme_admin_js()
	{
		$dir = THEME_JS_URI;

		$version = THEME_VERSION;

		wp_enqueue_script('theme-admin-js', $dir . 'admin.js', ["jquery"], $version, false);
	}

	/**
	 * Enqueue theme fonts
	 *
	 * @since 1.0
	 */
	public static function theme_fonts()
	{
		$dir = THEME_FONT_URI;

		$version = THEME_VERSION;

		wp_enqueue_style('bootstrap-icons', $dir . 'bootstrap-icons/bootstrap-icons.css', [], "1.5.0", false);
		wp_enqueue_style('raleway', $dir . 'Raleway/font.css', [], $version, false);
	}

	/**
	 * Get theme version
	 *
	 * @return string Theme Version
	 * @since 1.0
	 */
	public static function get_theme_version()
	{
		$theme = wp_get_theme();
		return $theme->get("Version");
	}

	/**
	 * Set query params for blog page by using the GET params
	 *
	 * @param [array] $query
	 * @since 2.0
	 */
	public static function set_query_params($query)
	{

		if (
			$query->is_main_query()
			&& !$query->is_feed()
		) {

			if (isset($_GET['category'])) {
				$category = $_GET['category'];
				$query->set('category_name', $category);
			}
		}
	}

	/**
	 * Set custom excerpt length
	 *
	 * @param int $length
	 * @since 2.0
	 */
	public static function custom_excerpt_len($length)
	{
		return 20;
	}

	public static function send_lead_to_jetimob($contact_form)
	{
		$submission = WPCF7_Submission::get_instance();

		// Check for API key existence
		if (!defined('JETIMOB_PUBLIC_KEY') || !defined('JETIMOB_PRIVATE_KEY')) {
			error_log('Jetimob API key(s) not defined.');
			return;
		}

		if (!$submission) {
			return;
		}

		// Retrieve form data
		$form_data = $submission->get_posted_data();

		// Map form fields to Jetimob API fields
		$lead_data = [
			'full_name' => sanitize_text_field($form_data['nome'] ?? ''),
			'email'     => sanitize_email($form_data['email'] ?? ''),
			'phone'     => sanitize_text_field($form_data['telefone'] ?? ''),
			'message'   => sanitize_textarea_field($form_data['mensagem'] ?? ''),
			'source'    => 'site - GPR',
			'tags'      => 'contato-site'
		];

		// Jetimob API URL
		$api_url = 'https://api.jetimob.com/leads/' . JETIMOB_PUBLIC_KEY;

		// API request headers
		$headers = [
			'Authorization-Key' => JETIMOB_PRIVATE_KEY,
		];

		// Send data using Requests::post to ensure multipart/form-data
		$response = Requests::post($api_url, $headers, $lead_data, ['timeout' => 10]);

		// Check for errors
		if ($response->status_code !== 200) {
			error_log('Jetimob API Error: ' . $response->status_code . ' - ' . $response->body);
		} else {
			error_log('Jetimob API Response: ' . $response->status_code . ' - ' . $response->body);
		}
	}
}

new Theme_Functions();
