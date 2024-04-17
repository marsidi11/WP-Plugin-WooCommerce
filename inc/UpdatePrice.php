<?php

/**
 * Update product price based on selected options
 */

add_action('wp_footer', 'cpo_update_price_script');

function cpo_update_price_script()
{
    if (is_product()) 
    {
        $product = wc_get_product();

        if ($product) 
        {
            if ($product->get_id()) 
            {
?>
                <script>

                    jQuery(document).ready(function($) {

                        var base_price = <?php echo wc_get_price_to_display($product); ?>;

                        var total_price = base_price;

                        var currency_symbol = '<?php echo html_entity_decode(get_woocommerce_currency_symbol()); ?>';

                        $('select[name^="custom_options"]').change(function() {

                            var option_price = parseFloat($(this).find(':selected').data('price')) || 0;

                            total_price -= parseFloat($(this).data('old-price') || 0);

                            total_price += option_price;

                            $(this).data('old-price', option_price);

                            $('.total_price, .woocommerce-Price-amount').text(currency_symbol + total_price.toFixed(2));
                        });
                    });
                </script>
<?php
            } else {
                error_log('Invalid product id');
            }
        } else {
            error_log('Unable to get product data');
        }
    }
}
