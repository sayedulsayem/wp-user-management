<?php

namespace WpUserManagement\App\Users;

defined('ABSPATH') || exit;

/**
 * action class for completing some tasks
 *
 * @author sayedulsayem
 * @since 1.0.0
 */
class Action{

    use \WpUserManagement\Traits\Singleton;

    /**
     * get all user from db function
     *
     * @return array
     * @since 1.0.0
     */
    public function get_all_users()
    {
        $args = [
            'fields' => [
                'ID',
                'display_name',
                'user_login',
                'user_nicename',
                'user_email',
            ],
        ];

        $users = get_users( $args );

        return $users;
    }

    /**
     * get all roles of wp users function
     *
     * @return array
     * @since 1.0.0
     */
    public function get_roles() {
	
        global $wp_roles;
        
        $roles = $wp_roles->roles;
        
        return $roles;
        
    }

}

?>