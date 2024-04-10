<?php

/**
 * Plugin Name: Another Woocommerce Addon
 * Plugin URI: https://anotherwoocommerceaddon.com/
 * Description: Another WordPress Woocommerce Addon.
 * Version: 1.0.0
 * Author: Marsid Zyberi
 */


// Call Enqueue.php to enqueue scripts
require_once plugin_dir_path(__FILE__) . 'inc/Enqueue.php';


// Call RegisterTab.php to register custom tab on Woocommerce product page
require_once plugin_dir_path(__FILE__) . 'inc/RegisterTab.php';


// Call AddOptions.php to add data panel options
require_once plugin_dir_path(__FILE__) . 'inc/AddOptions.php';


// Save custom options data
require_once plugin_dir_path( __FILE__ ) . 'inc/SaveOptions.php';


// Call DisplayOptions.php to display custom options on product page
require_once plugin_dir_path(__FILE__) . 'inc/DisplayOptions.php';


// Call UpdatePrice.php to update product price based on selected options
require_once plugin_dir_path(__FILE__) . 'inc/UpdatePrice.php';
                    

// Call AddToCart.php to pass product options and price to cart
require_once plugin_dir_path(__FILE__) . 'inc/AddToCart.php';