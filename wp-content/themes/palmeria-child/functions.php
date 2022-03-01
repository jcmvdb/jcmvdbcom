<?php
add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );

function enqueue_parent_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
}

// this function is changing the navigation bar on basis if you are logged in or logged out

function my_wp_nav_menu_args( $args = '' ) {

    if( is_user_logged_in() ) {
        $args['menu'] = 'logged-in';
    } else {
        $args['menu'] = 'logged-out';
    }
    return $args;
}
add_filter( 'wp_nav_menu_args', 'my_wp_nav_menu_args' );


// this function removes the toolbar in the top of the screen for everyone who has not the administrator role
add_action('after_setup_theme', 'remove_admin_bar');
function remove_admin_bar() {
    if (!current_user_can('administrator') && !is_admin()) {
        show_admin_bar(false);
    }
}