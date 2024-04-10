<?php

function enqueue_frontend_woo() 
{
    // Enqueue accounting.js
    wp_enqueue_script(
        'accounting',
        plugin_dir_path(__FILE__) . 'assets/frontend/accounting.min.js',
        array(),
        '0.4.2',
    );

    wp_enqueue_style(
        'my_frontend_style_options',
        plugin_dir_url(__FILE__) . '../assets/frontend/style.css'
    );
}

add_action('wp_enqueue_scripts', 'enqueue_frontend_woo');