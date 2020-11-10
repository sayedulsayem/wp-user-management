<?php

/**
 * gloabl function declare file
 */


/**
 * user info update function
 *
 * @return string
 * @since 1.0.0
 */
function wp_user_manager_update_user_info() {
	// first check if data is being sent and that it is the data we want   
   
	if( isset( $_POST['nonce'] ) ){     
		$nonce = $_POST['nonce'];
		if ( ! wp_verify_nonce( $nonce, 'wp_rest' ) ){
			wp_die( 'You are not allowed!');
        }

        $user_id = isset($_POST['userId'])? $_POST['userId']: '';
        $user_name = isset($_POST['userName'])? $_POST['userName']: '';
        $user_role = isset($_POST['userRole'])? $_POST['userRole']: '';

        global $wpdb;
        $wpdb->update($wpdb->users, array('user_login' => $user_name), array('ID' => $user_id));

        // Fetch the WP_User object of our user.
        $user = new WP_User( $user_id );

        // Replace the current role with 'editor' role
        $user->set_role( $user_role );
		
		echo json_encode(['done']);
		wp_die(); 
	} 
}

add_action('wp_ajax_update_user_info', 'wp_user_manager_update_user_info');
add_action('wp_ajax_nopriv_update_user_info', 'wp_user_manager_update_user_info');

/**
 * user delete function
 *
 * @return string
 * @since 1.0.0
 */
function wp_user_manager_delete_user_info() {
	// first check if data is being sent and that it is the data we want   
	if( isset( $_POST['nonce'] ) ){     
		$nonce = $_POST['nonce'];
		if ( ! wp_verify_nonce( $nonce, 'wp_rest' ) ){
			wp_die( 'You are not allowed!');
        }

        $user_id = isset($_POST['userId'])? $_POST['userId']: '';

        wp_delete_user( $user_id );
		
		echo json_encode(['done']);
		wp_die(); 
	} 
}

add_action('wp_ajax_delete_user_info', 'wp_user_manager_delete_user_info');
add_action('wp_ajax_nopriv_delete_user_info', 'wp_user_manager_delete_user_info');

?>