<?php
namespace WpUserManagement\Core;
defined( 'ABSPATH' ) || exit;

/**
 * custom post type register base class
 * 
 * @author sayedulsayem
 * @since 1.0.0
 */
abstract Class Cpt{

    /**
     * constructor function
     * help register cpt
     *
     * @return constructor function
     * @since 1.0.0
     */
    public function __construct() {
        
        $name = $this->get_name();
        $args = $this->post_type();

        add_action('init',function() use($name,$args) {
            register_post_type( $name, $args );
        });  

    }

    /**
     * cpt args ready function
     *implement from child class
     * @return void
     * @since 1.0.0
     */
    public abstract function post_type();

}

