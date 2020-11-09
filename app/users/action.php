<?php

namespace WpUserManagement\App\Users;

defined('ABSPATH') || exit;

class Action{

    use \WpUserManagement\Traits\Singleton;

    public function init()
    {
        
    }

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

    public function get_roles() {
	
        global $wp_roles;
        
        $roles = $wp_roles->roles;
        
        return $roles;
        
    }

}

?>