<?php 
namespace WpUserManagement\Core;
defined( 'ABSPATH' ) || exit;

/**
 * core rest api init class
 *
 * @author sayedulsayem 
 * @since 1.0.0
 */
abstract class Api{

    public $prefix = '';
    public $param = '';
    public $request = null;

    /**
     * constructor function
     *
     * @return constructor
     * @since 1.0.0
     */
    public function __construct(){
        $this->config();
        $this->init();
    }

    /**
     * rest api configuration function
     * implement from child
     *
     * @return void
     * @since 1.0.0
     */
    public abstract function config();

    /**
     * register rest api function
     *
     * @return void
     * @since 1.0.0
     */
    public function init(){
        add_action( 'rest_api_init', function () {
            register_rest_route( untrailingslashit('wp-user-management/v1/' . $this->prefix), '/(?P<action>\w+)/' . ltrim($this->param, '/'), array(
                'methods' => \WP_REST_Server::ALLMETHODS,
                'callback' => [$this, 'action'],
            ));
        });
    }

    /**
     * rest api register callback function
     *
     * @param array $request
     *
     * @return void
     * @since 1.0.0
     */
    public function action($request){
        $this->request = $request;
        $action_class = strtolower($this->request->get_method()) .'_'. $this->request['action'];

        if(method_exists($this, $action_class)){
            return $this->{$action_class}();
        }
    }

}