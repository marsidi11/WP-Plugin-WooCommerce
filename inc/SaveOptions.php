<?php
/**
 * Save custom options
 */

add_action('woocommerce_process_product_meta', 'cpo_save_custom_options');

function cpo_save_custom_options($post_id) 
{
    if (isset($_POST['_wpnonce']) && wp_verify_nonce($_POST['_wpnonce'], 'update-post_' . $post_id)) 
    {
        if (isset($_POST['custom_options_group_name']) && isset($_POST['custom_options']))
         {

            $custom_options = array();

            $group_names = array_filter($_POST['custom_options_group_name']);
            
            $group_options = array_filter($_POST['custom_options']);

            foreach ($group_names as $index => $group_name) 
            {
                if (!empty($group_name) && !empty($group_options[$index])) 
                {
                    $options = array_filter(array_map('trim', explode("\n", $group_options[$index])));

                    $options = array_filter($options, function($option) 
                    {
                        return !empty($option);
                    });

                    $custom_options[$group_name] = $options;
                }
            }

            update_post_meta($post_id, '_custom_options', $custom_options);
            
        } else 
        {
            error_log('Custom options data not found in the POST request.');
        }
    } else 
    {
        error_log('Invalid request for saving custom options data.');
    }
}