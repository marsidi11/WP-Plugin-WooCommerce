<?php
/**
 * Register the custom options tab
 */

add_filter('woocommerce_product_data_tabs', 'cpo_add_product_data_tab');

function cpo_add_product_data_tab($tabs)
{
    $tabs['custom_options'] = array(
        'label'  => __('Add Custom Options', 'cpo'),
        'target' => 'custom_options_data',
        'class'  => array('show_if_simple', 'show_if_variable'),
    );
    return $tabs;
}