<?php
/*
  Template Name: Login Page
 */
?>

<?php
get_header();
$user = wp_get_current_user();
?>

<?php
if (!is_user_logged_in()) { // Display WordPress login form:
    echo '<h1 class="Title">Login</h1>';
    $args = array(
//        'redirect' => home_url(),
        'redirect' => '/account',
        'form_id' => 'loginform-custom',
        'label_username' => __('Gebruikersnaam / Email'),
        'label_password' => __('Wachtwoord'),
        'label_remember' => __('Onthoud gegevens'),
        'label_log_in' => __('Log In'),
        'remember' => true
    );

    wp_login_form($args);
} else { // If logged in:
    require_once("account.php");
}
?>

<?php
get_footer();


