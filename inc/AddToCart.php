<?php 

/**
 * Add selected options to cart item data and update cart item price
 */

add_filter('woocommerce_add_cart_item_data', 'cpo_add_cart_item_data', 10, 3);

function cpo_add_cart_item_data($cart_item_data, $product_id, $variation_id)
{
    if (isset($_POST['custom_options'])) 
    {
        $cart_item_data['custom_options'] = $_POST['custom_options'];
    }
    return $cart_item_data;
}

// Display custom options in cart and order
add_filter('woocommerce_get_item_data', 'cpo_display_item_data', 10, 2);

function cpo_display_item_data($item_data, $cart_item)
{
    if (!empty($cart_item['custom_options'])) 
    {
        $item_data[] = array(
            'key'     => __('Custom Options', 'cpo'),
            'value'   => implode(', ', $cart_item['custom_options']),
            'display' => '',
        );
    }
    return $item_data;
}

// Update cart item price based on selected options
add_action('woocommerce_before_calculate_totals', 'cpo_update_custom_price', 10, 1);

function cpo_update_custom_price($cart_object) 
{
    foreach ($cart_object->cart_contents as $key => $value) 
    {
        if (isset($value['custom_options'])) 
        {
            // Get the first price of the product
            $original_price = floatval($value['data']->get_price());

            // Calculate the new price
            $additional_price = calculate_custom_price($value['custom_options']);

            // Add the new price to the first price
            $new_price = $original_price + $additional_price;

            $value['data']->set_price($new_price);
        }
    }
}

function calculate_custom_price($custom_options) 
{
    error_log("Custom options: " . print_r($custom_options, true));

    $base_price = 0;
    foreach ($custom_options as $option) 
    {
        list($option_name, $option_value) = explode('|', $option);
        error_log("Option: $option_name, Value: $option_value");
        $base_price += floatval($option_value);
    }
    error_log("Calculated price: $base_price");
    return $base_price;
}