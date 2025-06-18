<?php
/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.6.1
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */

/**
 * Include the TGM_Plugin_Activation class.
 *
 * Depending on your implementation, you may want to change the include call:
 *
 * Parent Theme:
 * require_once get_template_directory() . '/path/to/class-tgm-plugin-activation.php';
 *
 * Child Theme:
 * require_once get_stylesheet_directory() . '/path/to/class-tgm-plugin-activation.php';
 *
 * Plugin:
 * require_once dirname( __FILE__ ) . '/path/to/class-tgm-plugin-activation.php';
 */

if ( ! class_exists( 'TGM_Plugin_Activation' ) ) {
    require_once get_template_directory() . '/plugins/class-tgm-plugin-activation.php';
}

add_action( 'tgmpa_register', 'haru_teespace_register_required_plugins' );

/**
 * Register the required plugins for this theme.
 *
 * In this example, we register five plugins:
 * - one included with the TGMPA library
 * - two from an external source, one from an arbitrary source, one from a GitHub repository
 * - two from the .org repo, where one demonstrates the use of the `is_callable` argument
 *
 * The variables passed to the `tgmpa()` function should be:
 * - an array of plugin arrays;
 * - optionally a configuration array.
 * If you are not changing anything in the configuration array, you can remove the array and remove the
 * variable from the function call: `tgmpa( $plugins );`.
 * In that case, the TGMPA default settings will be used.
 *
 * This function is hooked into `tgmpa_register`, which is fired on the WP `init` action on priority 10.
 */
function haru_teespace_register_required_plugins() {
    /*
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(

        // This is an example of how to include a plugin from the WordPress Plugin Repository.
        array(
            'name'               => esc_html__( 'Haru TeeSpace', 'teespace' ), // The plugin name
            'slug'               => 'haru-teespace', // The plugin slug (typically the folder name)
            'source'             => get_template_directory() . '/plugins/haru-teespace.zip', // The plugin source
            'required'           => true, // If false, the plugin is only 'recommended' instead of required
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'       => '', // If set, overrides default API URL and points to an external URL
            'version'            => '1.5.7', // Minimum version is 1.5.7
        ),
        array(
            'name'     => esc_html__( 'Revolution Slider', 'teespace' ), // The plugin name
            'slug'     => 'revslider', // The plugin slug (typically the folder name)
            'source'   => get_template_directory() . '/plugins/revslider.zip', // The plugin source
            'required' => true, // If false, the plugin is only 'recommended' instead of required
            'version'   => '6.7.25', // Minimum version is 6.7.25
        ),
        array(
            'name'      => esc_html__( 'Redux Framework', 'teespace' ),
            'slug'      => 'redux-framework',
            'required'  => true,
        ),
        array(
            'name'      => esc_html__( 'Elementor', 'teespace' ),
            'slug'      => 'elementor',
            'required'  => true,
        ),
        array(
            'name'     => esc_html__( 'Contact Form 7', 'teespace' ), // The plugin name
            'slug'     => 'contact-form-7', // The plugin slug (typically the folder name)
            'required' => true, // If false, the plugin is only 'recommended' instead of required
        ),
        array(
            'name'      => esc_html__( 'WooCommerce', 'teespace' ),
            'slug'      => 'woocommerce',
            'required'  => true,
        ),
        array(
            'name'     => esc_html__( 'WC Designer Pro', 'teespace' ), // The plugin name
            'slug'     => 'wc-designer-pro', // The plugin slug (typically the folder name)
            'source'   => get_template_directory() . '/plugins/wc-designer-pro.zip', // The plugin source
            'required' => true, // If false, the plugin is only 'recommended' instead of required
            'version'  => '1.9.25', // Minimum version is 1.9.25
        ),
        array(
            'name'     => esc_html__( 'Drag and Drop Multiple File Upload (Pro) - WooCommerce', 'teespace' ), // The plugin name
            'slug'     => 'drag-and-drop-file-uploads-wc-pro', // The plugin slug (typically the folder name)
            'source'   => get_template_directory() . '/plugins/drag-and-drop-file-uploads-wc-pro.zip', // The plugin source
            'required' => false, // If false, the plugin is only 'recommended' instead of required
            'version'  => '5.0.5', // Minimum version is 5.0.5
        ),
        array(
            'name'     => esc_html__( 'WPC Product Options for WooCommerce', 'teespace' ), // The plugin name
            'slug'     => 'wpc-product-options', // The plugin slug (typically the folder name)
            'required' => false, // If false, the plugin is only 'recommended' instead of required
        ),
        array(
            'name'     => esc_html__( 'Dokan – Best WooCommerce Multivendor Marketplace Solution', 'teespace' ), // The plugin name
            'slug'     => 'dokan-lite', // The plugin slug (typically the folder name)
            'required' => false, // If false, the plugin is only 'recommended' instead of required
        ),
        array(
            'name'     => esc_html__( 'YITH WooCommerce Wishlist', 'teespace' ), // The plugin name
            'slug'     => 'yith-woocommerce-wishlist', // The plugin slug (typically the folder name)
            'required' => true, // If false, the plugin is only 'recommended' instead of required
        ),
        array(
            'name'     => esc_html__( 'YITH WooCommerce Compare', 'teespace' ), // The plugin name
            'slug'     => 'yith-woocommerce-compare', // The plugin slug (typically the folder name)
            'required' => true, // If false, the plugin is only 'recommended' instead of required
        ),
        array(
            'name'      => esc_html__( 'MC4WP: Mailchimp for WordPress', 'teespace' ),
            'slug'      => 'mailchimp-for-wp',
            'required'  => true,
        ),
        array(
            'name'     => esc_html__( 'Smash Balloon Instagram Feed', 'teespace' ), // The plugin name
            'slug'     => 'instagram-feed', // The plugin slug (typically the folder name)
            'required' => true, // If false, the plugin is only 'recommended' instead of required
        ),
    );

    /*
     * Array of configuration settings. Amend each line as needed.
     *
     * TGMPA will start providing localized text strings soon. If you already have translations of our standard
     * strings available, please help us make TGMPA even better by giving us access to these translations or by
     * sending in a pull-request with .po file(s) with the translations.
     *
     * Only uncomment the strings in the config array if you want to customize the strings.
     */
    $config = array(
        'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',                      // Default absolute path to bundled plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'parent_slug'  => 'themes.php',            // Parent menu slug.
        'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.

    );

    tgmpa( $plugins, $config );
}
