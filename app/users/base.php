<?php

namespace WpUserManagement\App\Users;

defined('ABSPATH') || exit;

class Base{

    use \WpUserManagement\Traits\Singleton;

    public function init()
    {
        
    }

    public function call_data_table_ui()
    {
        include 'views/user-management-table.php';
    }

}

?>