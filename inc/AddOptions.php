<?php

/**
 * Add custom options to product data panel
 */

add_action('woocommerce_product_data_panels', 'cpo_add_product_data_panel');

function cpo_add_product_data_panel()
{
    global $post;
    $custom_options = get_post_meta($post->ID, '_custom_options', true);
?>
    <div id="custom_options_data" class="panel woocommerce_options_panel">

        <div class="options_group_container"></div>

        <button type="button" class="button add_options_group"><?php esc_html_e('Add Option Group', 'cpo'); ?></button>

    </div>

    <script>
        jQuery(document).ready(function($) {

            var custom_options = <?php echo json_encode($custom_options); ?>;
            if (custom_options) {
                $.each(custom_options, function(group_name, options) {
                    addOptionsGroup(group_name, options);
                });
            }

            // Add new option group button
            $('.add_options_group').on('click', function() {
                addOptionsGroup();
            });

            function addOptionsGroup(group_name = '', options = []) {

                var group_html = '<div class="options_group">';

                group_html += '<p class="form-field"><label for="custom_options_group_name"><?php esc_html_e('Option Group Name', 'cpo'); ?></label><input type="text" name="custom_options_group_name[]" value="' + group_name + '" placeholder="<?php esc_attr_e('e.g. Customize Your Computer', 'cpo'); ?>"></p>';

                group_html += '<p class="form-field"><label for="custom_options"><?php esc_html_e('Custom Options', 'cpo'); ?></label><textarea name="custom_options[]" rows="5" placeholder="<?php esc_attr_e('One option per line (option_name|option_price)', 'cpo'); ?>">' + options.join("\n") + '</textarea></p>';

                group_html += '<button type="button" class="button remove_options_group"><?php esc_html_e('Remove Group', 'cpo'); ?></button>';

                group_html += '</div>';

                $('.options_group_container').append(group_html);
            }

            // Remove option group button
            $(document).on('click', '.remove_options_group', function() {
                    $(this).closest('.options_group').remove();
                });

        });
    </script>
<?php
}
