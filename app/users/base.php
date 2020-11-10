<?php

namespace WpUserManagement\App\Users;

defined('ABSPATH') || exit;
/**
 * base class for loading functionality of user dashboard
 *
 * @author sayedulsayem
 * @since 1.0.0
 */
class Base{

    use \WpUserManagement\Traits\Singleton;

    /**
     * call dashboard template with data function
     *
     * @return void
     * @since 1.0.0
     */
    public function call_data_table()
    {
        $users = Action::instance()->get_all_users();
        $roles = Action::instance()->get_roles();
        include 'views/user-management-table.php';
    }

}

?>