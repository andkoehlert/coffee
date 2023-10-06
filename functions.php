<?php
// Enqueue parent theme style
function enqueue_parent_theme_style() {
    wp_enqueue_style('style', get_stylesheet_directory_uri() . '/style.css');
}
add_action('wp_enqueue_scripts', 'enqueue_parent_theme_style');

add_filter('woocommerce_enqueue_styles', '__return_false');

function enqueue_woocommerce_styles() {
    wp_enqueue_style('woocommerce-styles', get_stylesheet_directory_uri() . '/woocommerce-styles.css');
}
add_action('wp_enqueue_scripts', 'enqueue_woocommerce_styles');

function enqueue_shop_styles() {
    wp_enqueue_style('shop-styles', get_stylesheet_directory_uri() . '/shop-styles.css');
}
add_action('wp_enqueue_scripts', 'enqueue_shop_styles');




// Register custom widgets
function mytheme_register_custom_widgets() {
    // Widget for Roast
    register_sidebar(array(
        "name" => "Roast",
        "id" => "roast"
    ));

    // Widget for Grams
    register_sidebar(array(
        "name" => "Grams",
        "id" => "grams"
    ));

    // Widget for Flavor
    register_sidebar(array(
        "name" => "Flavor",
        "id" => "flavor"
    ));
}

// Display Roast Widget
add_action('woocommerce_before_shop_loop', 'display_roast_widget');
function display_roast_widget() {
    dynamic_sidebar('roast');
}

// Display Grams Widget
add_action('woocommerce_before_shop_loop', 'display_grams_widget');
function display_grams_widget() {
    dynamic_sidebar('grams');
}

// Display Flavor Widget
add_action('woocommerce_before_shop_loop', 'display_flavor_widget');
function display_flavor_widget() {
    dynamic_sidebar('flavor');
}



add_action("widgets_init", "mytheme_register_custom_widgets");

// Function to print the content of widgets
function mytheme_print_sidebar($widget_id) {
    dynamic_sidebar($widget_id);
}

// Display widgets


// Remove related products tab
function remove_related_products_tab() {
    remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
}
add_action('init', 'remove_related_products_tab');

// Add ACF custom fields after add to cart form
function add_acf_custom_fields_after_add_to_cart() {
    // Get the values of your ACF custom fields
    $roast = get_field('roast', get_the_ID());
    $grams = get_field('grams', get_the_ID());
    $flavor = get_field('flavor', get_the_ID());

    // Output the ACF custom fields HTML with additional text
    echo '<div class="acf-custom-fields">';
    echo '<p>Roast: ' . esc_html($roast) . ' - Custom text for roast</p>';
    echo '<p>Grams: ' . esc_html($grams) . ' - Custom text for grams</p>';
    echo '<p>Flavor: ' . esc_html($flavor) . ' - Custom text for flavor</p>';
    echo '</div>';
}
add_action('woocommerce_after_add_to_cart_button', 'add_acf_custom_fields_after_add_to_cart');
