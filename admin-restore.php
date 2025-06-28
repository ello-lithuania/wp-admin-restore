<?php
// admin-restore.php

// CHANGE THESE
$secret_password = 'yourStrongSecretPassword';
$new_username = 'recovery_admin';
$new_password = 'StrongAdminPassword123!';
$new_email = 'you@example.com';

// PROTECTION - only run if password is provided correctly
if (!isset($_GET['auth']) || $_GET['auth'] !== $secret_password) {
    die('Unauthorized');
}

require_once('wp-load.php');

if (username_exists($new_username) || email_exists($new_email)) {
    die('User already exists.');
}

$user_id = wp_create_user($new_username, $new_password, $new_email);
$user = new WP_User($user_id);
$user->set_role('administrator');

echo "Admin user '$new_username' created successfully.";