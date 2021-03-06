<?php

namespace WpUserManagement;

defined('ABSPATH') || exit;

/**
 * main plugin loaded final class
 *
 * @author sayedulsayem 
 * @since 1.0.0
 */
final class Plugin
{

    /**
     * accesing for object of this class
     *
     * @var object
     */
    private static $instance;

    /**
     * construct function of this class
     *
     * @return void
     * @since 1.0.0
     */
    public function __construct()
    {
        $this->define_constant();
        Autoloader::run();
    }

    /**
     * defining constant function
     *
     * @return void
     * @since 1.0.0
     */
    public function define_constant()
    {

        define('WP_USER_MNG_VERSION', '1.0.0');
        define('WP_USER_MNG_PACKAGE', 'free');
        define('WP_USER_MNG_PLUGIN_URL', trailingslashit(plugin_dir_url(__FILE__)));
        define('WP_USER_MNG_PLUGIN_DIR', trailingslashit(plugin_dir_path(__FILE__)));

        define('WP_USER_MNG_PLUGIN_PUBLIC', WP_USER_MNG_PLUGIN_URL . 'public');
        define('WP_USER_MNG_PLUGIN_PUBLIC_DIR', WP_USER_MNG_PLUGIN_DIR . 'public');
    }

    /**
     * plugn actication function
     *
     * @return void
     * @since 1.0.0
     */
    public function active_plugin_action()
    {
        $this->store_plugin_activation_info();
        $this->flush_rewrites();
    }

    /**
     * store some neccessary information during plugin activation
     *
     * @return void
     * @since 1.0.0
     */
    public function store_plugin_activation_info()
    {
        $info = [
            'version' => WP_USER_MNG_VERSION,
            'activation_time' => time(),
        ];

        update_option('wp_user_management_active_info', $info);
    }

    /**
     * plugin initialization function
     *
     * @return void
     * @since 1.0.0
     */
    public function init()
    {

        // create plugin dashboard menu in wp dashboard
        if (current_user_can('manage_options')) {
            add_action('admin_menu', [$this, 'admin_menu']);
        }

        // enqueue js, css in wp admin
        add_action('admin_enqueue_scripts', [$this, 'js_css_admin']);   

    }

    /**
     * admin assets load function
     *
     * @return void
     * @since 1.0.0
     */
    public function js_css_admin()
    {

        $screen = get_current_screen();

        if (in_array($screen->id, ['toplevel_page_wp-user-management-menu'])) {

            wp_enqueue_style('font-awesome', 'https://use.fontawesome.com/releases/v5.8.2/css/all.css', false, WP_USER_MNG_VERSION);
            wp_enqueue_style('bootstrap', 'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css', false, WP_USER_MNG_VERSION);
            wp_enqueue_style('wp-user-management-admin-ui', WP_USER_MNG_PLUGIN_PUBLIC . '/assets/css/admin-style.css', false, WP_USER_MNG_VERSION);

            wp_enqueue_script('bootstrap', 'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js',[], WP_USER_MNG_VERSION, false);
            wp_enqueue_script('wp-user-management-admin', WP_USER_MNG_PLUGIN_PUBLIC . '/assets/js/admin-functions.js', ['jquery'], WP_USER_MNG_VERSION, false);
            wp_localize_script('wp-user-management-admin', 'ajax', [
                'ajaxUrl' => admin_url('admin-ajax.php')
            ]);

        }
    }


    /**
     * plugin menu add function
     *
     * @return void
     * @since 1.0.0
     */
    public function admin_menu()
    {
        add_menu_page(
            esc_html__('WP User Management'),
            esc_html__('WP User Management'),
            'manage_options',
            'wp-user-management-menu',
            [App\Users\Base::instance(), 'call_data_table'],
            'dashicons-businessperson',
            5
        );
    }

    /**
     * update permalink after register cpt function
     *
     * @return void
     * @since 1.0.0
     */
    public function flush_rewrites()
    {
        flush_rewrite_rules( true );
    }

    /**
     * singleton instance create function
     *
     * @return object
     * @since 1.0.0
     */
    public static function instance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }
}
