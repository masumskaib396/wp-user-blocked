<?php
/*
Plugin Name: User Blocked
Plugin URI: 
Description:Smpale user blocked
Version: 1.1
Author: Masum Sakib
Author URI: 
Text Domain:  userblocked
License: GPLv2 or later
*/

/**
 * carate a blocked url 
 */
add_action('init', function() {
    add_role('ub_user_blocked', __('Blocked', 'userblocked'), ['blocked' => true] );
    add_rewrite_rule( 'blocked/?$', 'index.php?blocked=1', 'top');
});

/**
 * tempalte redirect
 */
add_action('init', function(){
    if(is_admin() && current_user_can( 'blocked' )) {

        wp_redirect(get_home_url().'/blocked');
        die();
        
    }
});

/**
 * query vars
 */
 add_filter( 'query_vars', function ( $query_vars ) {
    $query_vars[] = 'blocked';
    return $query_vars;
 } );

/**
 * Style and content tempalte
 */
add_action('template_redirect', function() {
    $is_blocked = intval(get_query_var( 'blocked' ));
    if($is_blocked){
        ?>
       <!DOCTYPE html>
       <html lang="en">
       <head>
           <meta charset="UTF-8">
           <meta name="viewport" content="width=device-width, initial-scale=1.0">
           <title>Document</title>
       </head>
       <body>
           <h2>Your Are A blocked</h2>
       </body>
       </html>
        <?php
         die();
    };
});