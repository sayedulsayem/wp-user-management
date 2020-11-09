<div class="wrap">
    <h1><?php esc_html_e('WP User Management', 'wp-user-management'); ?></h1>
    <?php
    $users = (is_array($users) ? $users : []);
    $roles = array_keys($roles);
    //echo "<pre>"; print_r(array_keys($roles)); echo "</pre>";
    ?>
    <div class="user-table-wrapper" data-nonce="<?php echo esc_attr(wp_create_nonce('wp_rest')); ?>" data-roles="<?php echo esc_attr(json_encode($roles)); ?>">
        <table class="table table-hover">
            <thead>
                <tr class="user-header-wrapper">
                    <th scope="col"><?php esc_html_e('Serial No.', 'wp-user-management'); ?></th>
                    <th scope="col"><?php esc_html_e('UserName', 'wp-user-management'); ?></th>
                    <th scope="col"><?php esc_html_e('Role', 'wp-user-management'); ?></th>
                    <th scope="col"><?php esc_html_e('Action', 'wp-user-management'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $key => $value) : ?>
                    <?php
                    $user_meta = get_userdata($value->ID);
                    ?>
                    <tr class="user-info-wrapper" data-id="<?php echo esc_attr($value->ID); ?>">
                        <th class="user-serial" scope="row"><?php echo esc_html($key); ?></th>
                        <td class="user-name"><?php echo esc_html($value->user_login); ?></td>
                        <td class="user-role"><?php echo esc_html(is_array($user_meta->roles) ? implode(' | ', $user_meta->roles) : $user_meta->roles); ?></td>
                        <td>
                            <a class="action-edit btn btn-primary" href="#"><?php esc_html_e('Edit', 'wp-user-management'); ?></a> |
                            <a class="action-delete btn btn-danger" href="#"><?php esc_html_e('Delete', 'wp-user-management'); ?></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>