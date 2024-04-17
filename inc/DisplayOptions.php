<?php 
/**
 * Display custom options
 */

add_action('woocommerce_before_add_to_cart_button', 'cpo_display_custom_options');

function cpo_display_custom_options()
{
    global $product;
    $custom_options = get_post_meta($product->get_id(), '_custom_options', true);

    if (!empty($custom_options)) 
    {
        echo '<table class="custom_options_container">';

        foreach ($custom_options as $group_name => $options) 
        {
			
            echo '<tr class="custom_options_group">';
            echo '<td><h4>' . esc_html($group_name) . '</h4></td>';

            echo '<td><select name="custom_options[' . esc_attr($group_name) . ']">';

            echo '<option value="none">None</option>';

            foreach ($options as $option) 
            {
                $option_data = explode('|', $option);
                $option_name = $option_data[0];
                $option_price = isset($option_data[1]) ? floatval($option_data[1]) : 0;

                echo '<option value="' . esc_attr($option) . '" data-price="' . esc_attr($option_price) . '">' . esc_html($option_name) . ' (+' . wc_price($option_price) . ')</option>';
            }

            echo '</td></select>';
            echo '</tr>';
        }
        echo '</table>';
        echo '<div class="custom_options_total">';
        echo '<span class="total_label">' . esc_html__('Total', 'cpo') . ':</span> <span class="total_price">' . wc_price($product->get_price()) . '</span>';
        echo '</div>';
    }
}