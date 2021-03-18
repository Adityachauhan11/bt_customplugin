<?php

class WPcustomfile
{	 
    public $version = '1.0.0'; 
	public function __construct() {
		$this->define_constants();
		$this->includes();
		$this->init_hooks();
		
		add_action('wp_enqueue_scripts', array($this, 'BtCustomFrontScript'), 0);
	}
	private function define_constants()
    {
        $this->define('BT_CUSTOM_PLUGIN_ABSPATH', dirname(BT_CUSTOM_PLUGIN_PLUGIN_FILE) . '/');
        $this->define('BT_CUSTOM_PLUGIN_BASENAME', plugin_basename(BT_CUSTOM_PLUGIN_PLUGIN_FILE));
        $this->define('BT_CUSTOM_PLUGIN_URL', plugins_url(basename(BT_CUSTOM_PLUGIN_ABSPATH)));
		$this->define('BT_CUSTOM_PLUGIN_VERSION', $this->version);
		
    }
	public function includes()
	{
      include_once BT_CUSTOM_PLUGIN_ABSPATH . '/classes/classAdminoption.php';
	  include_once BT_CUSTOM_PLUGIN_ABSPATH . '/classes/classCustomPluginShortcodes.php';	   
		
	}
	public function BtCustomFrontScript()
	{
		wp_enqueue_script('BtCustom_front_script', BT_CUSTOM_PLUGIN_URL . "/assets/js/bt_custom_front.js", array('jquery'), BT_CUSTOM_PLUGIN_VERSION);
		wp_enqueue_script('BtCustom_jquery_script', BT_CUSTOM_PLUGIN_URL . "/assets/js/jquery-1.12.4.js", array('jquery'), BT_CUSTOM_PLUGIN_VERSION);
		wp_enqueue_script('BtCustom_jquery-ui_script', BT_CUSTOM_PLUGIN_URL . "/assets/js/jquery-ui.js", array('jquery'), BT_CUSTOM_PLUGIN_VERSION);
		wp_enqueue_style('BtCustom_front_style', BT_CUSTOM_PLUGIN_URL . '/assets/css/bt_customplugin.css', array(), BT_CUSTOM_PLUGIN_VERSION);
		wp_enqueue_style('BtCustom_jquery-ui_style', BT_CUSTOM_PLUGIN_URL . '/assets/css/jquery-ui.css', array(), BT_CUSTOM_PLUGIN_VERSION);
	}
	/**
     * Define constant if not already set.
     *
     * @param string      $name  Constant name.
     * @param string|bool $value Constant value.
     */
	 
	 private function init_hooks(){		 
		register_activation_hook(BT_CUSTOM_PLUGIN_PLUGIN_FILE, array($this, 'bt_custom_plugin_install'));
		add_action('init', array($this, 'bt_init'), 0);
		add_action('init', array($this, 'cw_post_type_news'), 0);
	}
	public function bt_custom_plugin_install() {
		
	}
	public function bt_init()
    {
		$args=array(
            'label' => 'Travel List',
            'public' => true,
            'show_ui' => true,
            'capability_type' => 'post',
            'hierarchical' => false,
            'rewrite' => array(
                'slug' => 'travel_list',
                'with_front' => false
                ),
            'query_var' => true,
            'supports' => array(
                'title',
                'editor',
                'excerpt',
                'trackbacks',
                'custom-fields',
                'revisions',
                'thumbnail',
                'author',
                'page-attributes'
                )
            ); 
            register_post_type( 'travel_list', $args );
     }
		 function cw_post_type_news() {
				$supports = array(
				'title', // post title
				'editor', // post content
				'author', // post author
				'thumbnail', // featured images
				'excerpt', // post excerpt
				'custom-fields', // custom fields
				'comments', // post comments
				'revisions', // post revisions
				'post-formats', // post formats
				);
				$labels = array(
				'name' => _x('news', 'plural'),
				'singular_name' => _x('news', 'singular'),
				'menu_name' => _x('news', 'admin menu'),
				'name_admin_bar' => _x('news', 'admin bar'),
				'add_new' => _x('Add New', 'add new'),
				'add_new_item' => __('Add New news'),
				'new_item' => __('New news'),
				'edit_item' => __('Edit news'),
				'view_item' => __('View news'),
				'all_items' => __('All news'),
				'search_items' => __('Search news'),
				'not_found' => __('No news found.'),
				);
				$args = array(
				'supports' => $supports,
				'labels' => $labels,
				'public' => true,
				'query_var' => true,
				'rewrite' => array('slug' => 'news'),
				'has_archive' => true,
				'hierarchical' => false,
				);
				register_post_type('news', $args);
				}
    private function define($name, $value) {
        if (!defined($name)) {
            define($name, $value);
        }
    }
 	
}
return new WPcustomfile();
?>