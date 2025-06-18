<?php

/**
 * ReduxFramework Sample Config File
 * For full documentation, please visit: http://docs.reduxframework.com/
 */

if ( ! class_exists( 'Redux_Framework_theme_options' ) ) {

    class Redux_Framework_theme_options {

        public $args = array();
        public $sections = array();
        public $theme;
        public $ReduxFramework;

        public function __construct() {
            if ( ! class_exists( 'HaruReduxFramework' ) ) {
                return;
            }

            $this->initSettings();
        }

        public function initSettings() {
            // Set the default arguments
            $this->setArguments();

            // Set a few help tabs so you can see how it's done
            $this->setHelpTabs();

            // Create the sections and fields
            $this->setSections();

            // If Redux is running as a plugin, this will remove the demo notice and links
            add_action( 'init', array( $this, 'remove_demo' ) );

            if ( ! isset( $this->args['opt_name'] ) ) { // No errors please
                return;
            }

            $this->ReduxFramework = new HaruReduxFramework( $this->sections, $this->args );
        }

        /**
         * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
         * */
        function change_arguments( $args ) {
            $args['dev_mode'] = false;

            return $args;
        }

        /**
         * Filter hook for filtering the default value of any given field. Very useful in development mode.
         * */
        function change_defaults( $defaults ) {
            $defaults['str_replace'] = 'Testing filter hook!';

            return $defaults;
        }

        // Remove the demo link and the notice of integrated demo from the redux-framework plugin
        function remove_demo() {
            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
            if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
                // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
                remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
            }
        }

        public function setSections() {
            // General Setting
            $this->sections[] = array(
                'title'  => esc_html__( 'General Setting', 'teespace' ),
                'desc'   => esc_html__( 'Welcome to Haru TeeSpace theme options panel! You can easy to customize the theme for your purpose! Please note some settings in here can be override by settings in Page Metabox of each page.', 'teespace' ),
                'icon'   => 'el el-cog',
                'fields' => array(
                    array(
                        'id'       => 'haru_layout_style',
                        'type'     => 'image_select',
                        'title'    => esc_html__( 'Layout Style', 'teespace' ),
                        'subtitle' => '',
                        'desc'     => '',
                        'options'  => array(
                            'wide'  => array(
                                'title' => esc_html__( 'Wide', 'teespace' ), 
                                'img' => get_template_directory_uri().'/framework/admin-assets/images/theme-options/layout-wide.png'
                            ),
                            'boxed' => array(
                                'title' => esc_html__( 'Boxed', 'teespace' ), 
                                'img' => get_template_directory_uri().'/framework/admin-assets/images/theme-options/layout-boxed.png'
                            ),
                            'float' => array(
                                'title' => esc_html__( 'Float', 'teespace' ), 
                                'img' => get_template_directory_uri().'/framework/admin-assets/images/theme-options/layout-float.png'
                            )
                        ),
                        'default'  => 'wide'
                    ),

                    array(
                        'id'       => 'haru_layout_site_max_width',
                        'type'     => 'slider',
                        'title'    => esc_html__( 'Site Max Width (px)', 'teespace' ),
                        'subtitle' => esc_html__( 'Set the site max width of body', 'teespace' ),
                        'default'  => '1200',
                        "min"      => 980,
                        "step"     => 10,
                        "max"      => 1600,
                        'required' => array('haru_layout_style','=','boxed'),
                    ),

                    array(
                        'id'       => 'haru_body_background_mode',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Body Background Mode', 'teespace' ),
                        'subtitle' => esc_html__( 'Chose Background Mode', 'teespace' ),
                        'desc'     => '',
                        'options'  => array(
                            'background' => esc_html__( 'Background', 'teespace' ),
                            'pattern'    => esc_html__( 'Pattern', 'teespace' )
                        ),
                        'default'  => 'background',
                        'required' => array('haru_layout_style','=','boxed'),
                    ),

                    array(
                        'id'       => 'haru_body_background',
                        'type'     => 'background',
                        'output'   => array( 'body' ),
                        'title'    => esc_html__( 'Body Background', 'teespace' ),
                        'subtitle' => esc_html__( 'Body background (Use only for Boxed layout style).', 'teespace' ),
                        'default'  => array(
                            'background-color'      => '',
                            'background-repeat'     => 'no-repeat',
                            'background-position'   => 'center center',
                            'background-attachment' => 'fixed',
                            'background-size'       => 'cover'
                        ),
                        'required'  => array(
                            array('haru_body_background_mode', '=', array( 'background' ))
                        ),
                    ),

                    array(
                        'id'       => 'haru_body_background_pattern',
                        'type'     => 'image_select',
                        'title'    => esc_html__( 'Background Pattern', 'teespace' ),
                        'subtitle' => esc_html__( 'Body background pattern (Use only for Boxed layout style)', 'teespace' ),
                        'desc'     => '',
                        'height'   => '40px',
                        'options'  => array(
                            'pattern-1.png' => array('title' => '', 'img' => get_template_directory_uri().'/framework/admin-assets/images/theme-options/pattern-1.png'),
                            'pattern-2.png' => array('title' => '', 'img' => get_template_directory_uri().'/framework/admin-assets/images/theme-options/pattern-2.png'),
                            'pattern-3.png' => array('title' => '', 'img' => get_template_directory_uri().'/framework/admin-assets/images/theme-options/pattern-3.png'),
                            'pattern-4.png' => array('title' => '', 'img' => get_template_directory_uri().'/framework/admin-assets/images/theme-options/pattern-4.png'),
                            'pattern-5.png' => array('title' => '', 'img' => get_template_directory_uri().'/framework/admin-assets/images/theme-options/pattern-5.png'),
                            'pattern-6.png' => array('title' => '', 'img' => get_template_directory_uri().'/framework/admin-assets/images/theme-options/pattern-6.png'),
                            'pattern-7.png' => array('title' => '', 'img' => get_template_directory_uri().'/framework/admin-assets/images/theme-options/pattern-7.png'),
                            'pattern-8.png' => array('title' => '', 'img' => get_template_directory_uri().'/framework/admin-assets/images/theme-options/pattern-8.png'),
                            'pattern-9.png' => array('title' => '', 'img' => get_template_directory_uri().'/framework/admin-assets/images/theme-options/pattern-9.png'),
                            'pattern-10.png' => array('title' => '', 'img' => get_template_directory_uri().'/framework/admin-assets/images/theme-options/pattern-10.png'),
                        ),
                        'default'  => 'pattern-1.png',
                        'required' => array(
                            array('haru_body_background_mode', '=', array('pattern'))
                        ) ,
                    ),
                    
                    array(
                        'id'       => 'haru_home_preloader',
                        'type'     => 'select',
                        'title'    => esc_html__( 'Page Preloader', 'teespace' ),
                        'subtitle' => esc_html__( 'Please leave empty if you don\'t want to use this!', 'teespace' ),
                        'desc'     => '',
                        'options'  => array(
                            'square-1'   => esc_html__('Square 01', 'teespace' ),
                            'square-2'   => esc_html__('Square 02', 'teespace' ),
                            'square-3'   => esc_html__('Square 03', 'teespace' ),
                            'square-4'   => esc_html__('Square 04', 'teespace' ),
                            'square-5'   => esc_html__('Square 05', 'teespace' ),
                            'square-6'   => esc_html__('Square 06', 'teespace' ),
                            'square-7'   => esc_html__('Square 07', 'teespace' ),
                            'square-8'   => esc_html__('Square 08', 'teespace' ),
                            'square-9'   => esc_html__('Square 09', 'teespace' ),
                            'round-1'    => esc_html__('Round 01', 'teespace' ),
                            'round-2'    => esc_html__('Round 02', 'teespace' ),
                            'round-3'    => esc_html__('Round 03', 'teespace' ),
                            'round-4'    => esc_html__('Round 04', 'teespace' ),
                            'round-5'    => esc_html__('Round 05', 'teespace' ),
                            'round-6'    => esc_html__('Round 06', 'teespace' ),
                            'round-7'    => esc_html__('Round 07', 'teespace' ),
                            'round-8'    => esc_html__('Round 08', 'teespace' ),
                            'round-9'    => esc_html__('Round 09', 'teespace' ),
                        ),
                        'default' => ''
                    ),

                    array(
                        'id'       => 'haru_home_preloader_bg_color',
                        'type'     => 'color_rgba',
                        'title'    => esc_html__( 'Preloader background color', 'teespace' ),
                        'subtitle' => '',
                        'default'  => array(),
                        'mode'     => 'background',
                        // 'validate' => 'colorrgba',
                        'required' => array('haru_home_preloader', 'not_empty_and', array('none')),
                    ),

                    array(
                        'id'       => 'haru_home_preloader_spinner_color',
                        'type'     => 'color',
                        'title'    => esc_html__( 'Preloader spinner color', 'teespace' ),
                        'subtitle' => '',
                        'default'  => '#e8e8e8',
                        // 'validate' => 'color',
                        'required' => array( 'haru_home_preloader', 'not_empty_and', array('none') ),
                    ),

                    array(
                        'id'       => 'haru_back_to_top',
                        'type'     => 'switch',
                        'title'    => esc_html__( 'Back To Top', 'teespace' ),
                        'subtitle' => '',
                        'default'  => true
                    ),

                    // Custom CSS & Script
                    array(
                        'id'       => 'haru_custom_js',
                        'type'     => 'ace_editor',
                        'mode'     => 'javascript',
                        'theme'    => 'monokai',
                        'title'    => esc_html__('Custom JS', 'teespace'),
                        'subtitle' => esc_html__('Insert your Javscript code here. You can add your Google Analytics Code here. Please do not place any <script> tags in here! From WordPress version 4.7+ you can add Custom CSS in Appearance » Customize » Additional CSS.', 'teespace'),
                        'desc'     => '',
                        'default'  => '',
                        'options'  => array( 'minLines'=> 10, 'maxLines' => 60 )
                    ),
                )
            );

            // Header
            $this->sections[] = array(
                'title'  => esc_html__( 'Header', 'teespace' ),
                'desc'   => '',
                'icon'   => 'el el-credit-card',
                'fields' => array(
                    array(
                        'id'       => 'haru_header',
                        'type'     => 'header',
                        'title'    => esc_html__( 'Header Builder Type', 'teespace' ),
                        'subtitle' => esc_html__('Please go to Header Builder to create Header.', 'teespace'),
                        'desc'     => esc_html__( 'This option can be override by Page Metabox -> Header of each page.', 'teespace' ),
                    ),
                    array(
                        'id'       => 'haru_header_transparent',
                        'type'     => 'switch',
                        'title'    => esc_html__( 'Header Transparent', 'teespace' ),
                        'desc'     => esc_html__( 'This option can be override by Page Metabox -> Header of each page.', 'teespace' ),
                        'default'  => '0',
                    ),
                    array(
                        'id'       => 'haru_header_transparent_skin',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Header Transparent Skin', 'teespace' ),
                        'desc'     => esc_html__( 'This option can be override by Page Metabox -> Header of each page.', 'teespace' ),
                        'options'  => array(
                            'light' => esc_html__( 'Light', 'teespace' ),
                            'dark'  => esc_html__( 'Dark', 'teespace' ),
                        ),
                        'default'  => 'light',
                        'required' => array( 'haru_header_transparent', '=', array( '1' ) ),
                    ),
                    array(
                        'id'       => 'haru_header_sticky',
                        'type'     => 'switch',
                        'title'    => esc_html__( 'Header Sticky', 'teespace' ),
                        'desc'     => esc_html__( 'This option can be override by Page Metabox -> Header of each page.', 'teespace' ),
                        'default'  => '1',
                    ),
                    array(
                        'id'       => 'haru_header_sticky_element',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Header Sticky Element', 'teespace' ),
                        'desc'     => esc_html__( 'You can choose sticky Header or only Menu (section include Haru Nav Menu widget in Elementor).', 'teespace' ),
                        'options'  => array(
                            'header' => esc_html__( 'Header', 'teespace' ),
                            'menu'  => esc_html__( 'Menu', 'teespace' ),
                        ),
                        'default'  => 'header',
                        'required' => array( 'haru_header_sticky', '=', array( '1' ) ),
                    ),
                )
            );
            

            // Footer
            $this->sections[] = array(
                'title'  => esc_html__( 'Footer', 'teespace' ),
                'desc'   => '',
                'icon'   => 'el el-lines',
                'fields' => array(
                    array(
                        'id'       => 'haru_footer',
                        'type'     => 'footer',
                        'title'    => esc_html__('Footer Builder Type', 'teespace'),
                        'subtitle' => esc_html__('Please go to Footer Builder to create Footer.', 'teespace'),
                        'desc'     => esc_html__( 'This option can be override by Page Metabox -> Footer of each page.', 'teespace' ),
                    ),

                )
            );

            // Logo
            $this->sections[] = array(
                'title'  => esc_html__( 'Logo & Favicon', 'teespace' ),
                'desc'   => '',
                'icon'   => 'el el-picture',
                'fields' => array(
                    array(
                        'id'    => 'haru_logo',
                        'type'  => 'info',
                        'style' => 'success',
                        'title' => esc_html__( 'Logo', 'teespace' ),
                        'icon'  => 'el el-info-circle',
                        'desc'  => esc_html__( 'Please go to Header Builder & Footer Builder to manage site Logo. You need to activate Haru TeeSpace plugin to see Header Builder & Footer Builder.', 'teespace')
                    ),
                    array(
                        'id'       => 'haru_custom_favicon',
                        'type'     => 'media',
                        'url'      => true,
                        'title'    => esc_html__( 'Custom favicon', 'teespace'),
                        'subtitle' => esc_html__( 'Upload a 16px x 16px Png/Gif/ico image.', 'teespace' ),
                        'desc'     => ''
                    ),
                )
            );

            // Appearance
            $this->sections[] = array(
                'title'      => esc_html__( 'Appearance', 'teespace' ),
                'desc'       => esc_html__( 'If you want to change Color Scheme or Typography you must turn ON SCSS Compiler.', 'teespace' ),
                'icon'       => 'el el-edit',
                'fields' => array(
                    array(
                        'id'       => 'haru_scss_compiler',
                        'type'     => 'switch',
                        'title'    => esc_html__( 'SCSS Compiler', 'teespace' ),
                        'subtitle' => esc_html__( 'To make this option work you need make sure PHP settings as Theme Requirement.', 'teespace' ),
                        'default'  => '0',
                    ),

                )
            );

            // Styling Options
            $this->sections[] = array(
                'title'  => esc_html__( 'Color Scheme', 'teespace' ),
                'desc'   => esc_html__( 'To make sure Typograhpy works you need enable SCSS Compiler and Save Changes 2 times to Regenerate Custom CSS file.', 'teespace' ),
                'icon'   => 'el el-magic',
                'subsection' => true,
                'fields' => array(
                    array(
                        'id'     => 'haru_section_color_light',
                        'type'   => 'section',
                        'title'  => esc_html__( 'Light Mode', 'teespace' ),
                        'indent' => true
                    ),
                    array(
                        'id'       => 'haru_primary_color',
                        'type'     => 'color',
                        'title'    => esc_html__( 'Primary Color', 'teespace' ),
                        'subtitle' => esc_html__( 'Set Primary Color', 'teespace' ),
                        'compiler' => true,
                        'default'  => '#dd1d26',
                        // 'validate' => 'color',
                    ),
                    array(
                        'id'       => 'haru_secondary_color',
                        'type'     => 'color',
                        'title'    => esc_html__( 'Secondary Color', 'teespace' ),
                        'subtitle' => esc_html__( 'Set Secondary Color', 'teespace' ),
                        'compiler' => true,
                        'default'  => '#b479d9',
                        // 'validate' => 'color',
                    ),
                    array(
                        'id'       => 'haru_text_color',
                        'type'     => 'color',
                        'title'    => esc_html__( 'Text Color', 'teespace' ),
                        'subtitle' => esc_html__( 'Set Text Color.', 'teespace' ),
                        'compiler' => true,
                        'default'  => '#7e7e7e',
                        // 'validate' => 'color',
                    ),
                    array(
                        'id'       => 'haru_text_color_secondary',
                        'type'     => 'color',
                        'title'    => esc_html__( 'Text Color Secondary', 'teespace' ),
                        'subtitle' => esc_html__( 'Set Text Color Secondary.', 'teespace' ),
                        'compiler' => true,
                        'default'  => '#9b9b9b',
                        // 'validate' => 'color',
                    ),
                    array(
                        'id'       => 'haru_text_color_tertiary',
                        'type'     => 'color',
                        'title'    => esc_html__( 'Text Color Tertiary', 'teespace' ),
                        'subtitle' => esc_html__( 'Set Text Color Tertiary.', 'teespace' ),
                        'compiler' => true,
                        'default'  => '#ababab',
                        // 'validate' => 'color',
                    ),
                    array(
                        'id'       => 'haru_heading_color',
                        'type'     => 'color',
                        'title'    => esc_html__( 'Heading Color', 'teespace' ),
                        'subtitle' => esc_html__( 'Set Heading Color.', 'teespace' ),
                        'default'  => '#000000',
                        'compiler' => true,
                        // 'validate' => 'color',
                    ),
                    array(
                        'id'       => 'haru_link_color',
                        'type'     => 'link_color',
                        'title'    => esc_html__( 'Link Color', 'teespace' ),
                        'subtitle' => esc_html__( 'Set Link Color.', 'teespace' ),
                        'compiler' => true,
                        'default'  => array(
                            'regular'  => '#7e7e7e',
                            'hover'    => '#dd1d26',
                            'active'   => '#dd1d26',
                        ),
                    ),
                    array(
                        'id'     => 'haru_section_color_gradient',
                        'type'   => 'section',
                        'title'  => esc_html__( 'Gradient Color', 'teespace' ),
                        'subtitle' => esc_html__( 'Because gradient have many colors, Currently you can set Background Gradient of Icon Box or Element have background gradient. With Container of Elementor you can change manually by setttings.', 'teespace' ),
                        'indent' => true
                    ),
                    array(
                        'id'       => 'haru_gradient_color_1',
                        'type'     => 'color',
                        'title'    => esc_html__( 'Gradient Color 1', 'teespace' ),
                        'subtitle' => esc_html__( 'Set Gradient Color 1.', 'teespace' ),
                        'compiler' => true,
                        'default'  => '#ff869f',
                        // 'validate' => 'color',
                    ),
                    array(
                        'id'       => 'haru_gradient_color_2',
                        'type'     => 'color',
                        'title'    => esc_html__( 'Gradient Color 2', 'teespace' ),
                        'subtitle' => esc_html__( 'Set Gradient Color 2.', 'teespace' ),
                        'compiler' => true,
                        'default'  => '#fa988a',
                        // 'validate' => 'color',
                    ),
                    array(
                        'id'       => 'haru_gradient_color_3',
                        'type'     => 'color',
                        'title'    => esc_html__( 'Gradient Color 3', 'teespace' ),
                        'subtitle' => esc_html__( 'Set Gradient Color 3.', 'teespace' ),
                        'compiler' => true,
                        'default'  => '#f19a73',
                        // 'validate' => 'color',
                    ),
                    array(
                        'id'       => 'haru_gradient_color_4',
                        'type'     => 'color',
                        'title'    => esc_html__( 'Gradient Color 4', 'teespace' ),
                        'subtitle' => esc_html__( 'Set Gradient Color 4.', 'teespace' ),
                        'compiler' => true,
                        'default'  => '#ffd0b1',
                        // 'validate' => 'color',
                    ),
                    array(
                        'id'       => 'haru_gradient_color_8',
                        'type'     => 'color',
                        'title'    => esc_html__( 'Gradient Color 8', 'teespace' ),
                        'subtitle' => esc_html__( 'Set Gradient Color 8.', 'teespace' ),
                        'compiler' => true,
                        'default'  => '#fbab83',
                        // 'validate' => 'color',
                    ),
                    array(
                        'id'       => 'haru_gradient_heading_1',
                        'type'     => 'color',
                        'title'    => esc_html__( 'Gradient Heading 1', 'teespace' ),
                        'subtitle' => esc_html__( 'Set Gradient Heading 4.', 'teespace' ),
                        'compiler' => true,
                        'default'  => '#b1f1b3',
                        // 'validate' => 'color',
                    ),
                    array(
                        'id'       => 'haru_gradient_heading_2',
                        'type'     => 'color',
                        'title'    => esc_html__( 'Gradient Heading 2', 'teespace' ),
                        'subtitle' => esc_html__( 'Set Gradient Heading 2.', 'teespace' ),
                        'compiler' => true,
                        'default'  => '#f3eec2',
                        // 'validate' => 'color',
                    ),
                    array(
                        'id'     => 'haru_section_color_dark',
                        'type'   => 'section',
                        'title'  => esc_html__( 'Dark Mode', 'teespace' ),
                        'subtitle' => esc_html__( 'Currently we don\'t allow change Color for Dark Mode to keep the structure of our design. Please notice TeeSpace does\'t have design for Dark Mode and this function is not working now.', 'teespace' ),
                        'indent' => true
                    ),
                    array(
                        'id'       => 'haru_dark_mode',
                        'type'     => 'switch',
                        'title'    => esc_html__( 'Dark Mode', 'teespace' ),
                        'subtitle' => esc_html__( 'Set Theme to Dark Mode', 'teespace' ),
                        'desc'     => esc_html__( 'This option to change Theme style to Dark Mode.', 'teespace' ),
                        'default'  => false
                    ),
                    array(
                        'id'       => 'haru_dark_mode_button',
                        'type'     => 'switch',
                        'title'    => esc_html__( 'Switch Mode Button', 'teespace' ),
                        'desc'     => esc_html__( 'You can show/hide Theme Switch Mode button at Frontend.', 'teespace' ),
                        'default'  => false,
                    ),
                )
            );

            // Typography
            $font_weights = array(
                100 => esc_html__( 'Ultra-Light 100', 'teespace' ),
                200 => esc_html__( 'Light 200', 'teespace' ),
                300 => esc_html__( 'Book 300', 'teespace' ),
                400 => esc_html__( 'Normal 400', 'teespace' ),
                500 => esc_html__( 'Medium 500', 'teespace' ),
                600 => esc_html__( 'Semi-Bold 600', 'teespace' ),
                700 => esc_html__( 'Bold 700', 'teespace' ),
                800 => esc_html__( 'Extra-Bold 800', 'teespace' ),
                900 => esc_html__( 'Ultra-Bold 900', 'teespace' ),
            );

            if ( false == haru_check_custom_fonts_plugin_status() ) {
                $this->sections[] = array(
                    'icon'   => 'el el-font',
                    'subsection' => true,
                    'title'  => esc_html__( 'Typograhpy', 'teespace' ),
                    'desc'   => esc_html__( 'To make sure Typograhpy works you need enable SCSS Compiler and Save Changes 2 times to Regenerate Custom CSS file.', 'teespace' ),
                    'fields' => array(
                        array(
                            'id'     => 'haru_section_custom_fonts',
                            'type'   => 'section',
                            'title'  => esc_html__( 'Custom Fonts', 'teespace' ),
                            'subtitle' => esc_html__( 'Google Font will disabled when you Activate Custom Fonts plugin & follow Custom Fonts tutorial.', 'teespace' ),
                            'indent' => true
                        ),
                        array(
                            'id'    => 'haru_custom_fonts',
                            'type'  => 'info',
                            'style' => 'critical',
                            'title' => esc_html__( 'Custom Fonts', 'teespace' ),
                            'icon'  => 'el el-info-circle',
                            'desc'  => 'Please install & active <a href="https://wordpress.org/plugins/custom-fonts/" target="_blank">Custom Fonts</a> plugin & follow this topic: <a href="https://harutheme.com/forums/topic/how-to-use-custom-fonts-in-harutheme/" target="_blank">https://harutheme.com/forums/topic/how-to-use-custom-fonts-in-harutheme/</a>'
                        ),
                        array(
                            'id'     => 'haru_section_body_font',
                            'type'   => 'section',
                            'title'  => esc_html__( 'Body Font', 'teespace' ),
                            'indent' => true
                        ),
                        array(
                            'id'             => 'haru_body_font',
                            'type'           => 'typography',
                            'title'          => esc_html__( 'Body Font', 'teespace' ),
                            'subtitle'       => esc_html__( 'Set body font properties.', 'teespace' ),
                            'google'         => true,
                            'font_display'   => 'auto',
                            'line-height'    => false,
                            'color'          => false,
                            'letter-spacing' => false,
                            'text-align'     => false,
                            'all_styles'     => true, // Enable all Google Font style/weight variations to be added to the page
                            'output'         => array( 'body' ), // An array of CSS selectors to apply this font style to dynamically
                            'compiler'       => array( 'body' ), // An array of CSS selectors to apply this font style to dynamically
                            'units'          => 'px', // Defaults to px
                            'default'        => array(
                                'font-size'   => '15px',
                                'font-family' => 'Plus Jakarta Sans',
                                'font-weight' => '500',
                                'google'      => true,
                            ),
                        ),
                        array(
                            'id'             => 'haru_secondary_font',
                            'type'           => 'typography',
                            'title'          => esc_html__( 'Secondary Font', 'teespace' ),
                            'subtitle'       => esc_html__( 'Set secondary font properties.', 'teespace' ),
                            'desc'           => esc_html__( 'Please don\'t set Font Size for Secondary Font!', 'teespace' ),
                            'google'         => true,
                            'font_display'   => 'auto',
                            'line-height'    => false,
                            'color'          => false,
                            'letter-spacing' => false,
                            'text-align'     => false,
                            'all_styles'     => true, // Enable all Google Font style/weight variations to be added to the page
                            'output'         => array( '.font__secondary' ), // An array of CSS selectors to apply this font style to dynamically
                            'compiler'       => array( '.font__secondary' ), // An array of CSS selectors to apply this font style to dynamically
                            'units'          => 'px', // Defaults to px
                            'default'        => array(
                                'font-size'   => '',
                                'font-family' => 'Playfair Display',
                                'font-weight' => '400',
                                'google'      => true,
                            ),
                        ),
                        array(
                            'id'     => 'haru_section_heading_font',
                            'type'   => 'section',
                            'title'  => esc_html__( 'Heading Font', 'teespace' ),
                            'indent' => true
                        ),
                        array(
                            'id'             => 'haru_h1_font',
                            'type'           => 'typography',
                            'title'          => esc_html__( 'H1 Font', 'teespace' ),
                            'subtitle'       => esc_html__( 'Set H1 font properties.', 'teespace' ),
                            'google'         => true,
                            'font_display'   => 'auto',
                            'letter-spacing' => false,
                            'color'          => false,
                            'line-height'    => false,
                            'text-align'     => false,
                            'all_styles'     => true, // Enable all Google Font style/weight variations to be added to the page
                            'output'         => array( 'h1' ), // An array of CSS selectors to apply this font style to dynamically
                            'compiler'       => array( 'h1' ), // An array of CSS selectors to apply this font style to dynamically
                            'units'          =>'px', // Defaults to px
                            'default'        => array(
                                'font-size'   => '36px',
                                'font-family' => 'Plus Jakarta Sans',
                                'font-weight' => '700',
                            ),
                        ),
                        array(
                            'id'             => 'haru_h2_font',
                            'type'           => 'typography',
                            'title'          => esc_html__( 'H2 Font', 'teespace' ),
                            'subtitle'       => esc_html__( 'Set H2 font properties.', 'teespace' ),
                            'google'         => true,
                            'font_display'   => 'auto',
                            'letter-spacing' => false,
                            'color'          => false,
                            'line-height'    => false,
                            'text-align'     => false,
                            'all_styles'     => true, // Enable all Google Font style/weight variations to be added to the page
                            'output'         => array( 'h2' ), // An array of CSS selectors to apply this font style to dynamically
                            'compiler'       => array( 'h2' ), // An array of CSS selectors to apply this font style to dynamically
                            'units'          =>'px', // Defaults to px
                            'default'        => array(
                                'font-size'   => '28px',
                                'font-family' => 'Plus Jakarta Sans',
                                'font-weight' => '700',
                            ),
                        ),
                        array(
                            'id'             => 'haru_h3_font',
                            'type'           => 'typography',
                            'title'          => esc_html__( 'H3 Font', 'teespace' ),
                            'subtitle'       => esc_html__( 'Set H3 font properties.', 'teespace' ),
                            'google'         => true,
                            'font_display'   => 'auto',
                            'color'          => false,
                            'line-height'    => false,
                            'letter-spacing' => false,
                            'text-align'     => false,
                            'all_styles'     => true, // Enable all Google Font style/weight variations to be added to the page
                            'output'         => array( 'h3' ), // An array of CSS selectors to apply this font style to dynamically
                            'compiler'       => array( 'h3' ), // An array of CSS selectors to apply this font style to dynamically
                            'units'          =>'px', // Defaults to px
                            'default'        => array(
                                'font-size'   => '24px',
                                'font-family' => 'Plus Jakarta Sans',
                                'font-weight' => '700',
                            ),
                        ),
                        array(
                            'id'             => 'haru_h4_font',
                            'type'           => 'typography',
                            'title'          => esc_html__( 'H4 Font', 'teespace' ),
                            'subtitle'       => esc_html__( 'Set H4 font properties.', 'teespace' ),
                            'google'         => true,
                            'font_display'   => 'auto',
                            'color'          => false,
                            'line-height'    => false,
                            'letter-spacing' => false,
                            'text-align'     => false,
                            'all_styles'     => true, // Enable all Google Font style/weight variations to be added to the page
                            'output'         => array( 'h4' ), // An array of CSS selectors to apply this font style to dynamically
                            'compiler'       => array( 'h4' ), // An array of CSS selectors to apply this font style to dynamically
                            'units'          =>'px', // Defaults to px
                            'default'        => array(
                                'font-size'   => '21px',
                                'font-family' => 'Plus Jakarta Sans',
                                'font-weight' => '700',
                            ),
                        ),
                        array(
                            'id'             => 'haru_h5_font',
                            'type'           => 'typography',
                            'title'          => esc_html__( 'H5 Font', 'teespace' ),
                            'subtitle'       => esc_html__( 'Set H5 font properties.', 'teespace' ),
                            'google'         => true,
                            'font_display'   => 'auto',
                            'line-height'    => false,
                            'color'          => false,
                            'letter-spacing' => false,
                            'text-align'     => false,
                            'all_styles'     => true, // Enable all Google Font style/weight variations to be added to the page
                            'output'         => array( 'h5' ), // An array of CSS selectors to apply this font style to dynamically
                            'compiler'       => array( 'h5' ), // An array of CSS selectors to apply this font style to dynamically
                            'units'          =>'px', // Defaults to px
                            'default'        => array(
                                'font-size'   => '18px',
                                'font-family' => 'Plus Jakarta Sans',
                                'font-weight' => '700',
                            ),
                        ),
                        array(
                            'id'             => 'haru_h6_font',
                            'type'           => 'typography',
                            'title'          => esc_html__( 'H6 Font', 'teespace' ),
                            'subtitle'       => esc_html__( 'Set H6 font properties.', 'teespace' ),
                            'google'         => true,
                            'font_display'   => 'auto',
                            'color'          => false,
                            'line-height'    => false,
                            'letter-spacing' => false,
                            'text-align'     => false,
                            'all_styles'     => true, // Enable all Google Font style/weight variations to be added to the page
                            'output'         => array( 'h6' ), // An array of CSS selectors to apply this font style to dynamically
                            'compiler'       => array( 'h6' ), // An array of CSS selectors to apply this font style to dynamically
                            'units'          =>'px', // Defaults to px
                            'default'        => array(
                                'font-size'   => '14px',
                                'font-family' => 'Plus Jakarta Sans',
                                'font-weight' => '700',
                            ),
                        ),
                        array(
                            'id'     => 'haru_section_menu_font',
                            'type'   => 'section',
                            'title'  => esc_html__( 'Menu Font', 'teespace' ),
                            'indent' => true
                        ),
                        array(
                            'id'             => 'haru_menu_font',
                            'type'           => 'typography',
                            'title'          => esc_html__( 'Menu Font', 'teespace' ),
                            'subtitle'       => esc_html__( 'Set Menu Level 0 font properties.', 'teespace' ),
                            'google'         => true,
                            'font_display'   => 'auto',
                            'all_styles'     => false, // Enable all Google Font style/weight variations to be added to the page
                            'color'          => false,
                            'line-height'    => false,
                            'text-align'     => false,
                            'font-style'     => false,
                            'subsets'        => true,
                            'text-transform' => false,
                            'output'         => array( '.haru-nav-menu > li > a' ), // An array of CSS selectors to apply this font style to dynamically
                            'compiler'       => array( '' ), // An array of CSS selectors to apply this font style to dynamically
                            'units'          => 'px', // Defaults to px
                            'default'        => array(
                                'font-family'    => 'Plus Jakarta Sans',
                                'font-size'      => '14px',
                                'font-weight'    => '600',
                            ),
                        ),
                        array(
                            'id'     => 'haru_section_page_title_font',
                            'type'   => 'section',
                            'title'  => esc_html__( 'Page Title Font', 'teespace' ),
                            'indent' => true
                        ),
                        array(
                            'id'             => 'haru_page_title_font',
                            'type'           => 'typography',
                            'title'          => esc_html__( 'Page Title Font', 'teespace' ),
                            'subtitle'       => esc_html__( 'Set page title font properties.', 'teespace' ),
                            'google'         => true,
                            'font_display'   => 'auto',
                            'all_styles'     => true, // Enable all Google Font style/weight variations to be added to the page
                            'line-height'    => false,
                            'color'          => false,
                            'text-align'     => false,
                            'font-style'     => true,
                            'subsets'        => true,
                            'font-size'      => true,
                            'font-weight'    => true,
                            'text-transform' => false,
                            'output'         => array( '.page-title-inner h1' ), // An array of CSS selectors to apply this font style to dynamically
                            'compiler'       => array(), // An array of CSS selectors to apply this font style to dynamically
                            'units'          => 'px', // Defaults to px
                            'default'        => array(
                                'font-family'    => 'Plus Jakarta Sans',
                                'font-size'      => '36px',
                                'font-weight'    => '700',
                            ),
                        ),
                        array(
                            'id'             => 'haru_page_sub_title_font',
                            'type'           => 'typography',
                            'title'          => esc_html__( 'Page Sub Title Font', 'teespace' ),
                            'subtitle'       => esc_html__( 'Set page sub title font properties.', 'teespace' ),
                            'google'         => true,
                            'font-display'   => 'auto',
                            'all_styles'     => true, // Enable all Google Font style/weight variations to be added to the page
                            'line-height'    => false,
                            'color'          => false,
                            'font-style'     => true,
                            'text-align'     => false,
                            'subsets'        => true,
                            'font-size'      => true,
                            'font-weight'    => true,
                            'text-transform' => false,
                            'output'         => array( '.page-title-inner .page-sub-title' ), // An array of CSS selectors to apply this font style to dynamically
                            'compiler'       => array(), // An array of CSS selectors to apply this font style to dynamically
                            'units'          => 'px', // Defaults to px
                            'default'        => array(
                                'font-family'    => 'Plus Jakarta Sans',
                                'font-size'      => '14px',
                                'font-weight'    => '400',
                            ),
                        ),
                    ),
                );
            } else {
                $this->sections[] = array(
                    'icon'   => 'el el-font',
                    'subsection' => true,
                    'title'  => esc_html__( 'Typograhpy', 'teespace' ),
                    'desc'   => esc_html__( 'To make sure Typograhpy works you need enable SCSS Compiler and Save Changes 2 times to Regenerate Custom CSS file.', 'teespace' ),
                    'fields' => array(
                        array(
                            'id'     => 'haru_section_custom_fonts',
                            'type'   => 'section',
                            'title'  => esc_html__( 'Custom Fonts', 'teespace' ),
                            'subtitle' => esc_html__( 'Google Font will disabled when you Activate Custom Fonts plugin & follow Custom Fonts tutorial.', 'teespace' ),
                            'indent' => true
                        ),
                        array(
                            'id'    => 'haru_custom_fonts',
                            'type'  => 'info',
                            'style' => 'critical',
                            'title' => esc_html__( 'Custom Fonts', 'teespace' ),
                            'icon'  => 'el el-info-circle',
                            'desc'  => 'Please install & active <a href="https://wordpress.org/plugins/custom-fonts/" target="_blank">Custom Fonts</a> plugin & follow this topic: <a href="https://harutheme.com/forums/topic/how-to-use-custom-fonts-in-harutheme/" target="_blank">https://harutheme.com/forums/topic/how-to-use-custom-fonts-in-harutheme/</a>'
                        ),
                        array(
                            'id'     => 'haru_section_body_font',
                            'type'   => 'section',
                            'title'  => esc_html__( 'Body Font', 'teespace' ),
                            'indent' => true
                        ),
                        array(
                            'id'             => 'haru_body_font',
                            'type'           => 'typography',
                            'title'          => esc_html__( 'Body Font', 'teespace' ),
                            'subtitle'       => esc_html__( 'Set body font properties.', 'teespace' ),
                            'google'         => false,
                            'font_display'   => 'auto',
                            'weights'        => $font_weights,
                            'line-height'    => false,
                            'color'          => false,
                            'letter-spacing' => false,
                            'text-align'     => false,
                            'all_styles'     => true, // Enable all Google Font style/weight variations to be added to the page
                            'output'         => array( 'body' ), // An array of CSS selectors to apply this font style to dynamically
                            'compiler'       => array( 'body' ), // An array of CSS selectors to apply this font style to dynamically
                            'units'          => 'px', // Defaults to px
                            'default'        => array(
                                'font-size'   => '15px',
                                'font-family' => 'Arial, Helvetica, sans-serif',
                                'font-weight' => '500',
                                'google'      => false,
                            ),
                        ),
                        array(
                            'id'             => 'haru_secondary_font',
                            'type'           => 'typography',
                            'title'          => esc_html__( 'Secondary Font', 'teespace' ),
                            'subtitle'       => esc_html__( 'Set secondary font properties.', 'teespace' ),
                            'desc'           => esc_html__( 'Please don\'t set Font Size for Secondary Font!', 'teespace' ),
                            'google'         => false,
                            'font_display'   => 'auto',
                            'weights'        => $font_weights,
                            'line-height'    => false,
                            'color'          => false,
                            'letter-spacing' => false,
                            'text-align'     => false,
                            'all_styles'     => true, // Enable all Google Font style/weight variations to be added to the page
                            'output'         => array( '.font__secondary' ), // An array of CSS selectors to apply this font style to dynamically
                            'compiler'       => array( '.font__secondary' ), // An array of CSS selectors to apply this font style to dynamically
                            'units'          => 'px', // Defaults to px
                            'default'        => array(
                                'font-size'   => '',
                                'font-family' => 'Arial, Helvetica, sans-serif',
                                'font-weight' => '400',
                                'google'      => false,
                            ),
                        ),
                        array(
                            'id'     => 'haru_section_heading_font',
                            'type'   => 'section',
                            'title'  => esc_html__( 'Heading Font', 'teespace' ),
                            'indent' => true
                        ),
                        array(
                            'id'             => 'haru_h1_font',
                            'type'           => 'typography',
                            'title'          => esc_html__( 'H1 Font', 'teespace' ),
                            'subtitle'       => esc_html__( 'Set H1 font properties.', 'teespace' ),
                            'google'         => false,
                            'font_display'   => 'auto',
                            'weights'        => $font_weights,
                            'letter-spacing' => false,
                            'color'          => false,
                            'line-height'    => false,
                            'text-align'     => false,
                            'all_styles'     => true, // Enable all Google Font style/weight variations to be added to the page
                            'output'         => array( 'h1' ), // An array of CSS selectors to apply this font style to dynamically
                            'compiler'       => array( 'h1' ), // An array of CSS selectors to apply this font style to dynamically
                            'units'          =>'px', // Defaults to px
                            'default'        => array(
                                'font-size'   => '36px',
                                'font-family' => 'Arial, Helvetica, sans-serif',
                                'font-weight' => '700',
                                'google'      => false,
                            ),
                        ),
                        array(
                            'id'             => 'haru_h2_font',
                            'type'           => 'typography',
                            'title'          => esc_html__( 'H2 Font', 'teespace' ),
                            'subtitle'       => esc_html__( 'Set H2 font properties.', 'teespace' ),
                            'google'         => false,
                            'font_display'   => 'auto',
                            'weights'        => $font_weights,
                            'letter-spacing' => false,
                            'color'          => false,
                            'line-height'    => false,
                            'text-align'     => false,
                            'all_styles'     => true, // Enable all Google Font style/weight variations to be added to the page
                            'output'         => array( 'h2' ), // An array of CSS selectors to apply this font style to dynamically
                            'compiler'       => array( 'h2' ), // An array of CSS selectors to apply this font style to dynamically
                            'units'          =>'px', // Defaults to px
                            'default'        => array(
                                'font-size'   => '28px',
                                'font-family' => 'Arial, Helvetica, sans-serif',
                                'font-weight' => '700',
                                'google'      => false,
                            ),
                        ),
                        array(
                            'id'             => 'haru_h3_font',
                            'type'           => 'typography',
                            'title'          => esc_html__( 'H3 Font', 'teespace' ),
                            'subtitle'       => esc_html__( 'Set H3 font properties.', 'teespace' ),
                            'google'         => false,
                            'font_display'   => 'auto',
                            'weights'        => $font_weights,
                            'color'          => false,
                            'line-height'    => false,
                            'letter-spacing' => false,
                            'text-align'     => false,
                            'all_styles'     => true, // Enable all Google Font style/weight variations to be added to the page
                            'output'         => array( 'h3' ), // An array of CSS selectors to apply this font style to dynamically
                            'compiler'       => array( 'h3' ), // An array of CSS selectors to apply this font style to dynamically
                            'units'          =>'px', // Defaults to px
                            'default'        => array(
                                'font-size'   => '24px',
                                'font-family' => 'Arial, Helvetica, sans-serif',
                                'font-weight' => '700',
                                'google'      => false,
                            ),
                        ),
                        array(
                            'id'             => 'haru_h4_font',
                            'type'           => 'typography',
                            'title'          => esc_html__( 'H4 Font', 'teespace' ),
                            'subtitle'       => esc_html__( 'Set H4 font properties.', 'teespace' ),
                            'google'         => false,
                            'font_display'   => 'auto',
                            'weights'        => $font_weights,
                            'color'          => false,
                            'line-height'    => false,
                            'letter-spacing' => false,
                            'text-align'     => false,
                            'all_styles'     => true, // Enable all Google Font style/weight variations to be added to the page
                            'output'         => array( 'h4' ), // An array of CSS selectors to apply this font style to dynamically
                            'compiler'       => array( 'h4' ), // An array of CSS selectors to apply this font style to dynamically
                            'units'          =>'px', // Defaults to px
                            'default'        => array(
                                'font-size'   => '21px',
                                'font-family' => 'Arial, Helvetica, sans-serif',
                                'font-weight' => '700',
                                'google'      => false,
                            ),
                        ),
                        array(
                            'id'             => 'haru_h5_font',
                            'type'           => 'typography',
                            'title'          => esc_html__( 'H5 Font', 'teespace' ),
                            'subtitle'       => esc_html__( 'Set H5 font properties.', 'teespace' ),
                            'google'         => false,
                            'font_display'   => 'auto',
                            'weights'        => $font_weights,
                            'line-height'    => false,
                            'color'          => false,
                            'letter-spacing' => false,
                            'text-align'     => false,
                            'all_styles'     => true, // Enable all Google Font style/weight variations to be added to the page
                            'output'         => array( 'h5' ), // An array of CSS selectors to apply this font style to dynamically
                            'compiler'       => array( 'h5' ), // An array of CSS selectors to apply this font style to dynamically
                            'units'          =>'px', // Defaults to px
                            'default'        => array(
                                'font-size'   => '18px',
                                'font-family' => 'Arial, Helvetica, sans-serif',
                                'font-weight' => '700',
                                'google'      => false,
                            ),
                        ),
                        array(
                            'id'             => 'haru_h6_font',
                            'type'           => 'typography',
                            'title'          => esc_html__( 'H6 Font', 'teespace' ),
                            'subtitle'       => esc_html__( 'Set H6 font properties.', 'teespace' ),
                            'google'         => false,
                            'font_display'   => 'auto',
                            'weights'        => $font_weights,
                            'color'          => false,
                            'line-height'    => false,
                            'letter-spacing' => false,
                            'text-align'     => false,
                            'all_styles'     => true, // Enable all Google Font style/weight variations to be added to the page
                            'output'         => array( 'h6' ), // An array of CSS selectors to apply this font style to dynamically
                            'compiler'       => array( 'h6' ), // An array of CSS selectors to apply this font style to dynamically
                            'units'          =>'px', // Defaults to px
                            'default'        => array(
                                'font-size'   => '14px',
                                'font-family' => 'Arial, Helvetica, sans-serif',
                                'font-weight' => '700',
                                'google'      => false,
                            ),
                        ),
                        array(
                            'id'     => 'haru_section_menu_font',
                            'type'   => 'section',
                            'title'  => esc_html__( 'Menu Font', 'teespace' ),
                            'indent' => true
                        ),
                        array(
                            'id'             => 'haru_menu_font',
                            'type'           => 'typography',
                            'title'          => esc_html__( 'Menu Font', 'teespace' ),
                            'subtitle'       => esc_html__( 'Set Menu Level 0 font properties.', 'teespace' ),
                            'google'         => false,
                            'font_display'   => 'auto',
                            'weights'        => $font_weights,
                            'all_styles'     => false, // Enable all Google Font style/weight variations to be added to the page
                            'color'          => false,
                            'line-height'    => false,
                            'text-align'     => false,
                            'font-style'     => false,
                            'subsets'        => true,
                            'text-transform' => false,
                            'output'         => array( '.haru-nav-menu > li > a' ), // An array of CSS selectors to apply this font style to dynamically
                            'compiler'       => array( '' ), // An array of CSS selectors to apply this font style to dynamically
                            'units'          => 'px', // Defaults to px
                            'default'        => array(
                                'font-family'    => 'Arial, Helvetica, sans-serif',
                                'font-size'      => '14px',
                                'font-weight'    => '600',
                                'google'      => false,
                            ),
                        ),
                        array(
                            'id'     => 'haru_section_page_title_font',
                            'type'   => 'section',
                            'title'  => esc_html__( 'Page Title Font', 'teespace' ),
                            'indent' => true
                        ),
                        array(
                            'id'             => 'haru_page_title_font',
                            'type'           => 'typography',
                            'title'          => esc_html__( 'Page Title Font', 'teespace' ),
                            'subtitle'       => esc_html__( 'Set page title font properties.', 'teespace' ),
                            'google'         => false,
                            'font_display'   => 'auto',
                            'weights'        => $font_weights,
                            'all_styles'     => true, // Enable all Google Font style/weight variations to be added to the page
                            'line-height'    => false,
                            'color'          => false,
                            'text-align'     => false,
                            'font-style'     => true,
                            'subsets'        => true,
                            'font-size'      => true,
                            'font-weight'    => true,
                            'text-transform' => false,
                            'output'         => array( '.page-title-inner h1' ), // An array of CSS selectors to apply this font style to dynamically
                            'compiler'       => array(), // An array of CSS selectors to apply this font style to dynamically
                            'units'          => 'px', // Defaults to px
                            'default'        => array(
                                'font-family'    => 'Arial, Helvetica, sans-serif',
                                'font-size'      => '36px',
                                'font-weight'    => '700',
                                'google'      => false,
                            ),
                        ),
                        array(
                            'id'             => 'haru_page_sub_title_font',
                            'type'           => 'typography',
                            'title'          => esc_html__( 'Page Sub Title Font', 'teespace' ),
                            'subtitle'       => esc_html__( 'Set page sub title font properties.', 'teespace' ),
                            'google'         => false,
                            'font-display'   => 'auto',
                            'weights'        => $font_weights,
                            'all_styles'     => true, // Enable all Google Font style/weight variations to be added to the page
                            'line-height'    => false,
                            'color'          => false,
                            'font-style'     => true,
                            'text-align'     => false,
                            'subsets'        => true,
                            'font-size'      => true,
                            'font-weight'    => true,
                            'text-transform' => false,
                            'output'         => array( '.page-title-inner .page-sub-title' ), // An array of CSS selectors to apply this font style to dynamically
                            'compiler'       => array(), // An array of CSS selectors to apply this font style to dynamically
                            'units'          => 'px', // Defaults to px
                            'default'        => array(
                                'font-family'    => 'Arial, Helvetica, sans-serif',
                                'font-size'      => '14px',
                                'font-weight'    => '400',
                                'google'      => false,
                            ),
                        ),
                    ),
                );
            }

            $this->sections[] = array(
                'icon'   => 'el el-cogs',
                'subsection' => true,
                'title'  => esc_html__( 'SCSS Variables', 'teespace' ),
                'desc'   => esc_html__( 'Allow to change Element height base, border radius, font weights, ...', 'teespace' ),
                'fields' => array(
                    array(
                        'id'    => 'haru_scss_variables_notice',
                        'type'  => 'info',
                        'style' => 'critical',
                        'title' => esc_html__( 'SCSS Variables', 'teespace' ),
                        'icon'  => 'el el-info-circle',
                        'desc'  => esc_html__( 'Change SCSS Variables is not recommended because it can break the design structure! Please use our default settings for the best design display.', 'teespace' )
                    ),
                    array(
                        'id'     => 'haru_section_font_size',
                        'type'   => 'section',
                        'title'  => esc_html__( 'Font Size Define', 'teespace' ),
                        'subtitle' => esc_html__( 'Define font size. Example almost fonts is 14px but some fonts is 15px or 16px!', 'teespace' ),
                        'indent' => true
                    ),
                    array(
                        'id'       => 'haru_font_size_base',
                        'type'     => 'slider',
                        'title'    => esc_html__( 'Font Size Base', 'teespace' ),
                        'subtitle' => esc_html__( 'Set font size base', 'teespace' ),
                        'default'  => '14',
                        'min'      => 14,
                        'step'     => 1,
                        'max'      => 16,
                    ),
                    array(
                        'id'     => 'haru_section_font_weights',
                        'type'   => 'section',
                        'title'  => esc_html__( 'Font Weights Define', 'teespace' ),
                        'subtitle' => esc_html__( 'Define font weights. Example almost fonts is 700 but some fonts Bold is 600!', 'teespace' ),
                        'indent' => true
                    ),
                    array(
                        'id'       => 'haru_font_weight_light',
                        'type'     => 'slider',
                        'title'    => esc_html__( 'Font Weight Light', 'teespace' ),
                        'subtitle' => esc_html__( 'Set font weight light', 'teespace' ),
                        'default'  => '300',
                        'min'      => 100,
                        'step'     => 100,
                        'max'      => 900,
                    ),
                    array(
                        'id'       => 'haru_font_weight_normal',
                        'type'     => 'slider',
                        'title'    => esc_html__( 'Font Weight Normal', 'teespace' ),
                        'subtitle' => esc_html__( 'Set font weight normal', 'teespace' ),
                        'default'  => '400',
                        'min'      => 100,
                        'step'     => 100,
                        'max'      => 900,
                    ),
                    array(
                        'id'       => 'haru_font_weight_medium',
                        'type'     => 'slider',
                        'title'    => esc_html__( 'Font Weight Medium', 'teespace' ),
                        'subtitle' => esc_html__( 'Set font weight medium', 'teespace' ),
                        'default'  => '500',
                        'min'      => 100,
                        'step'     => 100,
                        'max'      => 900,
                    ),
                    array(
                        'id'       => 'haru_font_weight_semi_bold',
                        'type'     => 'slider',
                        'title'    => esc_html__( 'Font Weight Semi Bold', 'teespace' ),
                        'subtitle' => esc_html__( 'Set font weight semi bold', 'teespace' ),
                        'default'  => '600',
                        'min'      => 100,
                        'step'     => 100,
                        'max'      => 900,
                    ),
                    array(
                        'id'       => 'haru_font_weight_bold',
                        'type'     => 'slider',
                        'title'    => esc_html__( 'Font Weight Bold', 'teespace' ),
                        'subtitle' => esc_html__( 'Set font weight bold', 'teespace' ),
                        'default'  => '700',
                        'min'      => 100,
                        'step'     => 100,
                        'max'      => 900,
                    ),
                    array(
                        'id'       => 'haru_font_weight_extra_bold',
                        'type'     => 'slider',
                        'title'    => esc_html__( 'Font Weight Extra Bold', 'teespace' ),
                        'subtitle' => esc_html__( 'Set font weight extra bold', 'teespace' ),
                        'default'  => '800',
                        'min'      => 100,
                        'step'     => 100,
                        'max'      => 900,
                    ),
                    array(
                        'id'     => 'haru_section_border_radius_e',
                        'type'   => 'section',
                        'title'  => esc_html__( 'Border Radius Elements', 'teespace' ),
                        'subtitle' => esc_html__( 'Define some border radius value to use for Button, Input, Label.', 'teespace' ),
                        'indent' => true
                    ),
                    array(
                        'id'       => 'haru_border_radius_e',
                        'type'     => 'slider',
                        'title'    => esc_html__( 'Border Radius Base (px)', 'teespace' ),
                        'subtitle' => esc_html__( 'Set border radius base', 'teespace' ),
                        'default'  => '12',
                        'min'      => 0,
                        'step'     => 1,
                        'max'      => 50,
                    ),
                    array(
                        'id'       => 'haru_border_radius_e_tiny',
                        'type'     => 'slider',
                        'title'    => esc_html__( 'Border Radius Tiny (px)', 'teespace' ),
                        'subtitle' => esc_html__( 'Set border radius tiny', 'teespace' ),
                        'default'  => '12',
                        'min'      => 0,
                        'step'     => 1,
                        'max'      => 50,
                    ),
                    array(
                        'id'       => 'haru_border_radius_e_small',
                        'type'     => 'slider',
                        'title'    => esc_html__( 'Border Radius Small (px)', 'teespace' ),
                        'subtitle' => esc_html__( 'Set border radius small', 'teespace' ),
                        'default'  => '3',
                        'min'      => 0,
                        'step'     => 1,
                        'max'      => 50,
                    ),
                    array(
                        'id'       => 'haru_border_radius_e_medium',
                        'type'     => 'slider',
                        'title'    => esc_html__( 'Border Radius Medium (px)', 'teespace' ),
                        'subtitle' => esc_html__( 'Set border radius medium', 'teespace' ),
                        'default'  => '12',
                        'min'      => 0,
                        'step'     => 1,
                        'max'      => 50,
                    ),
                    array(
                        'id'       => 'haru_border_radius_e_large',
                        'type'     => 'slider',
                        'title'    => esc_html__( 'Border Radius Large (px)', 'teespace' ),
                        'subtitle' => esc_html__( 'Set border radius large', 'teespace' ),
                        'default'  => '12',
                        'min'      => 0,
                        'step'     => 1,
                        'max'      => 50,
                    ),
                    array(
                        'id'       => 'haru_border_radius_e_extra_large',
                        'type'     => 'slider',
                        'title'    => esc_html__( 'Border Radius Extra Large (px)', 'teespace' ),
                        'subtitle' => esc_html__( 'Set border radius extra large', 'teespace' ),
                        'default'  => '40',
                        'min'      => 0,
                        'step'     => 1,
                        'max'      => 50,
                    ),
                    array(
                        'id'     => 'haru_section_border_radius',
                        'type'   => 'section',
                        'title'  => esc_html__( 'Border Radius Layout', 'teespace' ),
                        'subtitle' => esc_html__( 'Define some border radius value to use for Elements ( not Button, Input, Label ) like images, products, section,...', 'teespace' ),
                        'indent' => true
                    ),
                    array(
                        'id'       => 'haru_border_radius',
                        'type'     => 'slider',
                        'title'    => esc_html__( 'Border Radius Base (px)', 'teespace' ),
                        'subtitle' => esc_html__( 'Set border radius base', 'teespace' ),
                        'default'  => '12',
                        'min'      => 0,
                        'step'     => 1,
                        'max'      => 50,
                    ),
                    array(
                        'id'       => 'haru_border_radius_tiny',
                        'type'     => 'slider',
                        'title'    => esc_html__( 'Border Radius Tiny (px)', 'teespace' ),
                        'subtitle' => esc_html__( 'Set border radius tiny', 'teespace' ),
                        'default'  => '3',
                        'min'      => 0,
                        'step'     => 1,
                        'max'      => 50,
                    ),
                    array(
                        'id'       => 'haru_border_radius_small',
                        'type'     => 'slider',
                        'title'    => esc_html__( 'Border Radius Small (px)', 'teespace' ),
                        'subtitle' => esc_html__( 'Set border radius small', 'teespace' ),
                        'default'  => '3',
                        'min'      => 0,
                        'step'     => 1,
                        'max'      => 50,
                    ),
                    array(
                        'id'       => 'haru_border_radius_medium',
                        'type'     => 'slider',
                        'title'    => esc_html__( 'Border Radius Medium (px)', 'teespace' ),
                        'subtitle' => esc_html__( 'Set border radius medium', 'teespace' ),
                        'default'  => '5',
                        'min'      => 0,
                        'step'     => 1,
                        'max'      => 50,
                    ),
                    array(
                        'id'       => 'haru_border_radius_large',
                        'type'     => 'slider',
                        'title'    => esc_html__( 'Border Radius Large (px)', 'teespace' ),
                        'subtitle' => esc_html__( 'Set border radius large', 'teespace' ),
                        'default'  => '10',
                        'min'      => 0,
                        'step'     => 1,
                        'max'      => 50,
                    ),
                    array(
                        'id'       => 'haru_border_radius_extra_large',
                        'type'     => 'slider',
                        'title'    => esc_html__( 'Border Radius Extra Large (px)', 'teespace' ),
                        'subtitle' => esc_html__( 'Set border radius extra large', 'teespace' ),
                        'default'  => '40',
                        'min'      => 0,
                        'step'     => 1,
                        'max'      => 50,
                    ),
                ),
            );

            // WordPress Setting
            $this->sections[] = array(
                'title'  => esc_html__( 'WordPress Setting', 'teespace' ),
                'desc'   => '',
                'icon'   => 'el el-website',
                'fields' => array(

                )
            );

            // Pages Setting
            $this->sections[] = array(
                'title'      => esc_html__( 'Pages Setting', 'teespace' ),
                'desc'       => '',
                'icon'       => 'el el-website',
                'subsection' => true,
                'fields'     => array(
                    array(
                        'id'       => 'haru_page_layout',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Layout', 'teespace' ),
                        'desc'     => esc_html__( 'This option can be override by Page Metabox of each page.', 'teespace' ),
                        'options'  => array(
                            'full-width'            => esc_html__( 'Full Width', 'teespace' ),
                            'haru-container'       => esc_html__( 'Container', 'teespace' ),
                            'haru-container haru-container--large'       => esc_html__( 'Large Container', 'teespace' ),
                        ),
                        'default'  => 'haru-container'
                    ),
                    array(
                        'id'       => 'haru_page_sidebar',
                        'type'     => 'image_select',
                        'title'    => esc_html__( 'Sidebar', 'teespace' ),
                        'subtitle' => esc_html__( 'Sidebar Style: None, Left, Right, Two Sidebar', 'teespace' ),
                        'desc'     => esc_html__( 'This option can be override by Page Metabox of each page.', 'teespace' ),
                        'options'  => array(
                            'none'  => array('title' => '', 'img' => get_template_directory_uri().'/framework/admin-assets/images/theme-options/sidebar-none.png'),
                            'left'  => array('title' => '', 'img' => get_template_directory_uri().'/framework/admin-assets/images/theme-options/sidebar-left.png'),
                            'right' => array('title' => '', 'img' => get_template_directory_uri().'/framework/admin-assets/images/theme-options/sidebar-right.png'),
                            'two'   => array('title' => '', 'img' => get_template_directory_uri().'/framework/admin-assets/images/theme-options/sidebar-two.png'),
                        ),
                        'default' => 'none'
                    ),
                    array(
                        'id'       => 'haru_page_left_sidebar',
                        'type'     => 'select',
                        'title'    => esc_html__( 'Left Sidebar', 'teespace' ),
                        'subtitle' => esc_html__( 'Choose the default left sidebar', 'teespace' ),
                        'data'     => 'sidebars',
                        'desc'     => esc_html__( 'This option can be override by Page Metabox of each page.', 'teespace' ),
                        'default'  => 'sidebar-1',
                        'required' => array( 'haru_page_sidebar', '=', array( 'left', 'two' ) ),
                    ),
                    array(
                        'id'       => 'haru_page_right_sidebar',
                        'type'     => 'select',
                        'title'    => esc_html__( 'Right Sidebar', 'teespace' ),
                        'subtitle' => esc_html__( 'Choose the default right sidebar', 'teespace' ),
                        'data'     => 'sidebars',
                        'desc'     => esc_html__( 'This option can be override by Page Metabox of each page.', 'teespace' ),
                        'default'  => 'sidebar-2',
                        'required' => array( 'haru_page_sidebar', '=', array( 'right', 'two' ) ),
                    ),
                    array(
                        'id'     => 'haru-section-page-title-setting-start',
                        'type'   => 'section',
                        'title'  => esc_html__( 'Page Title Setting', 'teespace' ),
                        'indent' => true
                    ),
                    array(
                        'id'       => 'haru_show_page_title',
                        'type'     => 'switch',
                        'title'    => esc_html__( 'Show Page Title', 'teespace' ),
                        'desc'     => esc_html__( 'This option can be override by Page Metabox of each page.', 'teespace' ),
                        'default'  => true
                    ),
                    array(
                        'id'       => 'haru_page_title_layout',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Page Title Layout', 'teespace' ),
                        'subtitle' => esc_html__( 'This option will use for Background Image layout', 'teespace' ),
                        'desc'     => esc_html__( 'This option can be override by Page Metabox of each page.', 'teespace' ),
                        'options'  => array(
                            'full-width'            => esc_html__( 'Full Width', 'teespace' ),
                            'haru-container'       => esc_html__( 'Container', 'teespace' ),
                            'haru-container haru-container--large'       => esc_html__( 'Large Container', 'teespace' ),
                        ),
                        'default'  => 'full-width',
                        'required' => array( 'haru_show_page_title', '=', array( '1' ) ),
                    ),
                    array(
                        'id'       => 'haru_page_title_content_layout',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Page Title Content Layout', 'teespace' ),
                        'subtitle' => esc_html__( 'This option will use for Title, Sub Title and Breadcrumbs layout', 'teespace' ),
                        'desc'     => esc_html__( 'This option can be override by Page Metabox of each page.', 'teespace' ),
                        'options'  => array(
                            'full-width'            => esc_html__( 'Full Width', 'teespace' ),
                            'haru-container'       => esc_html__( 'Container', 'teespace' ),
                            'haru-container haru-container--large'       => esc_html__( 'Large Container', 'teespace' ),
                        ),
                        'default'  => 'haru-container',
                        'required' => array( 'haru_show_page_title', '=', array( '1' ) ),
                    ),
                    array(
                        'id'       => 'haru_page_title_bg_image',
                        'type'     => 'media',
                        'url'      => true,
                        'title'    => esc_html__( 'Page Title Background', 'teespace' ),
                        'desc'     => esc_html__( 'This option can be override by Page Metabox of each page.', 'teespace' ),
                        'default'  => array(),
                        'required'  => array( 'haru_show_page_title', '=', array( '1' ) ),
                    ),
                    array(
                        'id'       => 'haru_page_title_heading',
                        'type'     => 'switch',
                        'title'    => esc_html__( 'Heading', 'teespace' ),
                        'subtitle' => '',
                        'desc'     => esc_html__( 'This option can be override by Page Metabox of each page.', 'teespace' ),
                        'default'  => true,
                        'required'  => array( 'haru_show_page_title', '=', array( '1' ) ),
                    ),
                    array(
                        'id'       => 'haru_page_title_breadcrumbs',
                        'type'     => 'switch',
                        'title'    => esc_html__( 'Breadcrumbs', 'teespace' ),
                        'desc'     => esc_html__( 'This option can be override by Page Metabox of each page.', 'teespace' ),
                        'default'  => true,
                        'required'  => array( 'haru_show_page_title', '=', array( '1' ) ),
                    ),
                )
            );

            // Archive Blog Setting
            $this->sections[] = array(
                'title'      => esc_html__( 'Archive (Blog) Setting', 'teespace' ),
                'desc'       => '',
                'subsection' => true,
                'icon'       => 'el el-folder-close',
                'fields'     => array(
                    array(
                        'id'       => 'haru_archive_layout',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Layout', 'teespace' ),
                        'subtitle' => '',
                        'desc'     => '',
                        'options'  => array(
                            'full-width'            => esc_html__( 'Full Width', 'teespace' ),
                            'haru-container'       => esc_html__( 'Container', 'teespace' ),
                            'haru-container haru-container--large'       => esc_html__( 'Large Container', 'teespace' ),
                        ),
                        'default'  => 'haru-container'
                    ),
                    array(
                        'id'       => 'haru_archive_sidebar',
                        'type'     => 'image_select',
                        'title'    => esc_html__( 'Sidebar', 'teespace' ),
                        'subtitle' => esc_html__( 'Sidebar Style: None, Left, Right or Two Sidebar', 'teespace' ),
                        'desc'     => '',
                        'options'  => array(
                            'none'     => array( 'title' => '', 'img' => get_template_directory_uri() . '/framework/admin-assets/images/theme-options/sidebar-none.png' ),
                            'left'     => array( 'title' => '', 'img' => get_template_directory_uri() . '/framework/admin-assets/images/theme-options/sidebar-left.png' ),
                            'right'    => array( 'title' => '', 'img' => get_template_directory_uri() . '/framework/admin-assets/images/theme-options/sidebar-right.png' ),
                            'two'      => array( 'title' => '', 'img' => get_template_directory_uri() . '/framework/admin-assets/images/theme-options/sidebar-two.png' ),
                        ),
                        'default'  => 'left'
                    ),
                    array(
                        'id'       => 'haru_archive_left_sidebar',
                        'type'     => 'select',
                        'title'    => esc_html__( 'Left Sidebar', 'teespace' ),
                        'subtitle' => '',
                        'desc'     => '',
                        'data'     => 'sidebars',
                        'default'  => 'sidebar-1',
                        'required' => array( 'haru_archive_sidebar', '=', array( 'left', 'two' ) ),
                    ),
                    array(
                        'id'       => 'haru_archive_right_sidebar',
                        'type'     => 'select',
                        'title'    => esc_html__( 'Right Sidebar', 'teespace' ),
                        'subtitle' => '',
                        'desc'     => '',
                        'data'     => 'sidebars',
                        'default'  => 'sidebar-2',
                        'required' => array( 'haru_archive_sidebar', '=', array( 'right', 'two' ) ),
                    ),
                    array(
                        'id'       => 'haru_archive_display_type',
                        'type'     => 'select',
                        'title'    => esc_html__( 'Archive Blog Style', 'teespace' ),
                        'subtitle' => '',
                        'desc'     => '',
                        'options'  => array(
                            'large-image'  => esc_html__( 'Large Image', 'teespace' ),
                            'medium-image' => esc_html__( 'Medium Image', 'teespace' ),
                            'grid'         => esc_html__( 'Grid', 'teespace' ),
                        ),
                        'default'  => 'large-image'
                    ),
                    array(
                        'id'       => 'haru_archive_display_columns',
                        'type'     => 'select',
                        'title'    => esc_html__( 'Archive Display Columns', 'teespace' ),
                        'subtitle' => esc_html__( 'Choose the number of columns to display on archive pages.', 'teespace' ),
                        'desc'     => '',
                        'options'  => array(
                            '2'     => '2',
                            '3'     => '3',
                            '4'     => '4',
                        ),
                        'default'  => '2',
                        'required' => array( 'haru_archive_display_type', '=', array( 'grid' ) ),
                    ),
                    array(
                        'id'       => 'haru_archive_paging_style',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Blog Paging Style', 'teespace' ),
                        'subtitle' => '',
                        'desc'     => esc_html__( 'Default is Navigation & Load More is button.', 'teespace' ),
                        'options'  => array(
                            'default'         => esc_html__( 'Default', 'teespace' ),
                            'load-more'       => esc_html__( 'Load More', 'teespace' ),
                        ),
                        'default'  => 'default'
                    ),
                    array(
                        'id'        => 'haru_archive_number_exceprt',
                        'type'      => 'text',
                        'title'     => esc_html__( 'Length of excerpt (words)', 'teespace' ),
                        'default'   => '30',
                        'validate'  => array( 'not_empty' )
                    ),
                    array(
                        'id'     => 'haru-section-archive-title-setting-start',
                        'type'   => 'section',
                        'title'  => esc_html__( 'Archive Title Setting', 'teespace' ),
                        'indent' => true
                    ),
                    array(
                        'id'       => 'haru_show_archive_title',
                        'type'     => 'switch',
                        'title'    => esc_html__( 'Archive Page Title', 'teespace' ),
                        'subtitle' => '',
                        'default'  => true
                    ),
                    array(
                        'id'       => 'haru_archive_title_layout',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Archive Title Layout', 'teespace' ),
                        'subtitle' => '',
                        'desc'     => '',
                        'options'  => array(
                            'full-width'            => esc_html__( 'Full Width', 'teespace' ),
                            'haru-container'       => esc_html__( 'Container', 'teespace' ),
                            'haru-container haru-container--large'       => esc_html__( 'Large Container', 'teespace' ),
                        ),
                        'default'  => 'full-width',
                        'required' => array( 'haru_show_archive_title', '=', array( '1' ) ),
                    ),
                    array(
                        'id'       => 'haru_archive_title_content_layout',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Archive Title Content Layout', 'teespace' ),
                        'subtitle' => '',
                        'desc'     => '',
                        'options'  => array(
                            'full-width'            => esc_html__( 'Full Width', 'teespace' ),
                            'haru-container'       => esc_html__( 'Container', 'teespace' ),
                            'haru-container haru-container--large'       => esc_html__( 'Large Container', 'teespace' ),
                        ),
                        'default'  => 'haru-container',
                        'required' => array( 'haru_show_archive_title', '=', array( '1' ) ),
                    ),
                    array(
                        'id'       => 'haru_archive_title_bg_image',
                        'type'     => 'media',
                        'url'      => true,
                        'title'    => esc_html__( 'Archive Title Background', 'teespace' ),
                        'subtitle' => '',
                        'desc'     => '',
                        'default'  =>  array(),
                        'required' => array( 'haru_show_archive_title', '=', array( '1' ) ),
                    ),
                    array(
                        'id'       => 'haru_archive_title_heading',
                        'type'     => 'switch',
                        'title'    => esc_html__( 'Heading', 'teespace' ),
                        'subtitle' => '',
                        'default'  => true,
                        'required' => array( 'haru_show_archive_title', '=', array( '1' ) ),
                    ),
                    array(
                        'id'       => 'haru_archive_title_breadcrumbs',
                        'type'     => 'switch',
                        'title'    => esc_html__( 'Breadcrumbs', 'teespace' ),
                        'subtitle' => '',
                        'default'  => true,
                        'required' => array( 'haru_show_archive_title', '=', array( '1' ) ),
                    ),
                )
            );

            // Single Blog Settings
            $this->sections[] = array(
                'title'      => esc_html__( 'Single (Blog) Setting', 'teespace' ),
                'desc'       => '',
                'icon'       => 'el el-file',
                'subsection' => true,
                'fields'     => array(
                    array(
                        'id'       => 'haru_single_layout',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Layout', 'teespace' ),
                        'subtitle' => '',
                        'desc'     => esc_html__( 'This option can be override by Page Metabox of each Post.', 'teespace' ),
                        'options'  => array(
                            'full-width'            => esc_html__( 'Full Width', 'teespace' ),
                            'haru-container'       => esc_html__( 'Container', 'teespace' ),
                            'haru-container haru-container--large'       => esc_html__( 'Large Container', 'teespace' ),
                        ),
                        'default'  => 'haru-container'
                    ),
                    array(
                        'id'       => 'haru_single_sidebar',
                        'type'     => 'image_select',
                        'title'    => esc_html__( 'Sidebar', 'teespace' ),
                        'subtitle' => esc_html__( 'Sidebar Style: None, Left, Right or Two Sidebar', 'teespace' ),
                        'desc'     => esc_html__( 'This option can be override by Page Metabox of each Post.', 'teespace' ),
                        'options'  => array(
                            'none'     => array( 'title' => '', 'img' => get_template_directory_uri() . '/framework/admin-assets/images/theme-options/sidebar-none.png' ),
                            'left'     => array( 'title' => '', 'img' => get_template_directory_uri() . '/framework/admin-assets/images/theme-options/sidebar-left.png' ),
                            'right'    => array( 'title' => '', 'img' => get_template_directory_uri() . '/framework/admin-assets/images/theme-options/sidebar-right.png' ),
                            'two'      => array( 'title' => '', 'img' => get_template_directory_uri() . '/framework/admin-assets/images/theme-options/sidebar-two.png' ),
                        ),
                        'default'  => 'left'
                    ),
                    array(
                        'id'       => 'haru_single_left_sidebar',
                        'type'     => 'select',
                        'title'    => esc_html__( 'Left Sidebar', 'teespace' ),
                        'subtitle' => '',
                        'data'     => 'sidebars',
                        'desc'     => esc_html__( 'This option can be override by Page Metabox of each Post.', 'teespace' ),
                        'default'  => 'sidebar-1',
                        'required' => array( 'haru_single_sidebar', '=', array( 'left', 'two' ) ),
                    ),
                    array(
                        'id'       => 'haru_single_right_sidebar',
                        'type'     => 'select',
                        'title'    => esc_html__( 'Right Sidebar', 'teespace' ),
                        'subtitle' => '',
                        'data'     => 'sidebars',
                        'desc'     => esc_html__( 'This option can be override by Page Metabox of each Post.', 'teespace' ),
                        'default'  => 'sidebar-2',
                        'required' => array( 'haru_single_sidebar', '=', array( 'right', 'two' ) ),
                    ),

                    array(
                        'id'       => 'haru_single_navigation',
                        'type'     => 'switch',
                        'title'    => esc_html__( 'Post Navigation', 'teespace' ),
                        'subtitle' => esc_html__( 'Show/Hide Next/Pre post', 'teespace' ),
                        'default'  => false
                    ),

                    array(
                        'id'       => 'haru_single_author_info',
                        'type'     => 'switch',
                        'title'    => esc_html__( 'Author Info', 'teespace' ),
                        'subtitle' => esc_html__( 'Show/Hide Author Info', 'teespace' ),
                        'default'  => false
                    ),

                    array(
                        'id'       => 'haru_single_related',
                        'type'     => 'switch',
                        'title'    => esc_html__( 'Post Related', 'teespace' ),
                        'subtitle' => esc_html__( 'Show/Hide Post Related', 'teespace' ),
                        'default'  => false
                    ),

                    array(
                        'id'     => 'haru-section-single-blog-title-setting-start',
                        'type'   => 'section',
                        'title'  => esc_html__( 'Single Blog Title Setting', 'teespace' ),
                        'indent' => true
                    ),
                    array(
                        'id'       => 'haru_show_single_title',
                        'type'     => 'switch',
                        'title'    => esc_html__( 'Single Blog Title', 'teespace' ),
                        'desc'     => esc_html__( 'This option can be override by Page Metabox of each Post.', 'teespace' ),
                        'subtitle' => '',
                        'default'  => true
                    ),
                    array(
                        'id'       => 'haru_single_title_layout',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Single Blog Title Layout', 'teespace' ),
                        'subtitle' => '',
                        'desc'     => esc_html__( 'This option can be override by Page Metabox of each Post.', 'teespace' ),
                        'options'  => array(
                            'full-width'            => esc_html__( 'Full Width', 'teespace' ),
                            'haru-container'       => esc_html__( 'Container', 'teespace' ),
                            'haru-container haru-container--large'       => esc_html__( 'Large Container', 'teespace' ),
                        ),
                        'default'  => 'full-width',
                        'required' => array( 'haru_show_single_title', '=', array( '1' ) ),
                    ),
                    array(
                        'id'       => 'haru_single_title_content_layout',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Single Blog Title Content Layout', 'teespace' ),
                        'subtitle' => '',
                        'desc'     => esc_html__( 'This option can be override by Page Metabox of each Post.', 'teespace' ),
                        'options'  => array(
                            'full-width'            => esc_html__( 'Full Width', 'teespace' ),
                            'haru-container'       => esc_html__( 'Container', 'teespace' ),
                            'haru-container haru-container--large'       => esc_html__( 'Large Container', 'teespace' ),
                        ),
                        'default'  => 'haru-container',
                        'required' => array( 'haru_show_single_title', '=', array( '1' ) ),
                    ),
                    array(
                        'id'       => 'haru_single_title_bg_image',
                        'type'     => 'media',
                        'url'      => true,
                        'title'    => esc_html__( 'Single Blog Title Background', 'teespace' ),
                        'subtitle' => '',
                        'desc'     => esc_html__( 'This option can be override by Page Metabox of each Post.', 'teespace' ),
                        'default'  =>  array(),
                        'required'  => array( 'haru_show_single_title', '=', array( '1' ) )
                    ),
                    array(
                        'id'       => 'haru_single_title_heading',
                        'type'     => 'switch',
                        'title'    => esc_html__( 'Heading', 'teespace' ),
                        'subtitle' => '',
                        'desc'     => esc_html__( 'This option can be override by Page Metabox of each Post.', 'teespace' ),
                        'default'  => false,
                        'required' => array( 'haru_show_single_title', '=', array( '1' ) ),
                    ),
                    array(
                        'id'       => 'haru_single_title_breadcrumbs',
                        'type'     => 'switch',
                        'title'    => esc_html__( 'Breadcrumbs', 'teespace' ),
                        'subtitle' => '',
                        'desc'     => esc_html__( 'This option can be override by Page Metabox of each Post.', 'teespace' ),
                        'default'  => true,
                        'required' => array( 'haru_show_single_title', '=', array( '1' ) ),
                    ),
                )
            );

            if ( true == haru_check_woocommerce_status() ) {
                // WooCommerce
                $this->sections[] = array(
                    'title'  => esc_html__( 'WooCommerce', 'teespace' ),
                    'desc'   => '',
                    'icon'   => 'el el-shopping-cart-sign',
                    'fields' => array(
                        array(
                            'id'       => 'haru_product_sale_flash_mode',
                            'type'     => 'button_set',
                            'title'    => esc_html__( 'Sale Badge Mode', 'teespace' ),
                            'subtitle' => esc_html__( 'Choose Sale Badge Mode', 'teespace' ),
                            'desc'     => '',
                            'options'  => array(
                                'text'    => esc_html__( 'Text', 'teespace' ),
                                'percent' => esc_html__( 'Percent', 'teespace' )
                            ),
                            'default'  => 'percent'
                        ),
                        array(
                            'id'       => 'haru_product_attribute',
                            'type'     => 'product_attribute',
                            'title'    => esc_html__( 'Product Attribute', 'teespace' ),
                            'subtitle' => esc_html__( 'Show Product Attribute', 'teespace' ),
                            'desc'     => esc_html__( 'Apply for Color, Image & Label attribute type in Products -> Attributes', 'teespace' ),
                            'default' => ''
                        ),
                        array(
                            'id'       => 'haru_product_quick_view',
                            'type'     => 'switch',
                            'title'    => esc_html__( 'Quick View Button', 'teespace' ),
                            'subtitle' => esc_html__( 'Enable/Disable Quick View', 'teespace' ),
                            'default'  => true
                        ),
                        array(
                            'id'       => 'haru_product_add_wishlist',
                            'type'     => 'switch',
                            'title'    => esc_html__( 'Add To Wishlist Button', 'teespace' ),
                            'subtitle' => esc_html__( 'Enable/Disable Add To Wishlist Button', 'teespace' ),
                            'default'  => true
                        ),
                        array(
                            'id'       => 'haru_product_add_to_compare',
                            'type'     => 'switch',
                            'title'    => esc_html__( 'Add To Compare Button', 'teespace' ),
                            'subtitle' => esc_html__( 'Enable/Disable Add To Compare Button', 'teespace' ),
                            'default'  => true
                        ),
                    )
                );

                // Archive Product
                $this->sections[] = array(
                    'title'      => esc_html__( 'Archive Product (Shop)', 'teespace' ),
                    'desc'       => '',
                    'icon'       => 'el el-book',
                    'subsection' => true,
                    'fields'     => array(
                        array(
                            'id'       => 'haru_product_per_page',
                            'type'     => 'text',
                            'title'    => esc_html__( 'Products Per Page', 'teespace' ),
                            'desc'     => esc_html__( 'This must be numeric or empty (default 12).', 'teespace' ),
                            'subtitle' => '',
                            'validate' => 'numeric',
                            'default'  => '12',
                        ),
                        array(
                            'id'    => 'haru_product_per_row',
                            'type'  => 'info',
                            'style' => 'success',
                            'title' => esc_html__( 'Products per row ( Columns )', 'teespace' ),
                            'icon'  => 'el el-info-circle',
                            'desc'  => __( 'You can set Products per row in Appearence -> Customize -> WooCommerce ( Closest Additional CSS ) -> Product Catalog.', 'teespace')
                        ),
                        array(
                            'id'     => 'haru-section-archive-product-layout-start',
                            'type'   => 'section',
                            'title'  => esc_html__( 'Layout Options', 'teespace' ),
                            'indent' => true
                        ),
                        array(
                            'id'       => 'haru_archive_product_layout',
                            'type'     => 'button_set',
                            'title'    => esc_html__( 'Archive Product Layout', 'teespace' ),
                            'subtitle' => '',
                            'desc'     => '',
                            'options'  => array(
                                'full-width'            => esc_html__( 'Full Width', 'teespace' ),
                                'haru-container'       => esc_html__( 'Container', 'teespace' ),
                                'haru-container haru-container--large'       => esc_html__( 'Large Container', 'teespace' ),
                            ),
                            'default'  => 'haru-container'
                        ),
                        array(
                            'id'       => 'haru_archive_product_hidden_sidebar_layout',
                            'type'     => 'switch',
                            'title'    => esc_html__( 'Hidden Sidebar', 'teespace' ),
                            'subtitle' => esc_html__( 'Use Hidden Sidebar layout', 'teespace' ),
                            'default'  => false
                        ),
                        array(
                            'id'       => 'haru_archive_product_hidden_sidebar_style',
                            'type'     => 'button_set',
                            'title'    => esc_html__( 'Hidden Sidebar Style', 'teespace' ),
                            'subtitle' => '',
                            'desc'     => esc_html__( '', 'teespace' ),
                            'options'  => array(
                                'fixed'       => esc_html__( 'Fixed', 'teespace' ),
                                'toggle'      => esc_html__( 'Toggle', 'teespace' ),
                            ),
                            'default'  => 'fixed',
                            'required' => array( 'haru_archive_product_hidden_sidebar_layout', '=', array( '1' ) ),
                        ),
                        array(
                            'id'       => 'haru_archive_product_hidden_sidebar',
                            'type'     => 'select',
                            'title'    => esc_html__( 'Archive Product Hidden Sidebar', 'teespace' ),
                            'subtitle' => '',
                            'data'     => 'sidebars',
                            'desc'     => '',
                            'default'  => 'woocommerce',
                            'required' => array( 'haru_archive_product_hidden_sidebar_layout', '=', array( '1' ) ),
                        ),
                        array(
                            'id'       => 'haru_archive_product_sidebar',
                            'type'     => 'image_select',
                            'title'    => esc_html__( 'Archive Product Sidebar', 'teespace' ),
                            'subtitle' => esc_html__( 'None, Left or Right Sidebar', 'teespace' ),
                            'desc'     => '',
                            'options'  => array(
                                'none'     => array( 'title' => '', 'img' => get_template_directory_uri() . '/framework/admin-assets/images/theme-options/sidebar-none.png' ),
                                'left'     => array( 'title' => '', 'img' => get_template_directory_uri() . '/framework/admin-assets/images/theme-options/sidebar-left.png' ),
                                'right'    => array( 'title' => '', 'img' => get_template_directory_uri() . '/framework/admin-assets/images/theme-options/sidebar-right.png' ),
                                'two'      => array( 'title' => '', 'img' => get_template_directory_uri() . '/framework/admin-assets/images/theme-options/sidebar-two.png' ),
                            ),
                            'default'  => 'left',
                            'required' => array( 'haru_archive_product_hidden_sidebar_layout', '=', array( '0' ) ),
                        ),
                        array(
                            'id'       => 'haru_archive_product_left_sidebar',
                            'type'     => 'select',
                            'title'    => esc_html__( 'Archive Product Left Sidebar', 'teespace' ),
                            'subtitle' => esc_html__( 'Set Left Sidebar', 'teespace' ),
                            'data'     => 'sidebars',
                            'desc'     => '',
                            'default'  => 'woocommerce',
                            'required' => array( 'haru_archive_product_sidebar', '=', array( 'left', 'two' ) ),
                        ),
                        array(
                            'id'       => 'haru_archive_product_right_sidebar',
                            'type'     => 'select',
                            'title'    => esc_html__( 'Archive Product Right Sidebar', 'teespace' ),
                            'subtitle' => esc_html__( 'Set Right Sidebar', 'teespace' ),
                            'data'     => 'sidebars',
                            'desc'     => '',
                            'default'  => 'woocommerce',
                            'required' => array( 'haru_archive_product_sidebar', '=', array( 'right', 'two' ) ),
                        ),
                        array(
                            'id'       => 'haru_archive_product_hidden_sidebar_mobile_layout',
                            'type'     => 'switch',
                            'title'    => esc_html__( 'Hidden Sidebar Mobile', 'teespace' ),
                            'subtitle' => esc_html__( 'Use Hidden Sidebar layout on Mobile', 'teespace' ),
                            'desc'     => esc_html__( 'If you use Hidden Sidebar on Mobile the Archive Product Sidebar above will hidden on mobile.', 'teespace' ),
                            'default'  => false,
                            'required' => array( 'haru_archive_product_hidden_sidebar_layout', '=', array( '0' ) ),
                        ),
                        array(
                            'id'       => 'haru_archive_product_hidden_sidebar_mobile_style',
                            'type'     => 'button_set',
                            'title'    => esc_html__( 'Hidden Sidebar Mobile Style', 'teespace' ),
                            'subtitle' => '',
                            'desc'     => esc_html__( '', 'teespace' ),
                            'options'  => array(
                                'fixed'       => esc_html__( 'Fixed', 'teespace' ),
                                'toggle'      => esc_html__( 'Toggle', 'teespace' ),
                            ),
                            'default'  => 'fixed',
                            'required' => array( 'haru_archive_product_hidden_sidebar_mobile_layout', '=', array( '1' ) ),
                        ),
                        array(
                            'id'       => 'haru_archive_product_hidden_sidebar_mobile',
                            'type'     => 'select',
                            'title'    => esc_html__( 'Archive Product Hidden Sidebar Mobile', 'teespace' ),
                            'subtitle' => '',
                            'data'     => 'sidebars',
                            'desc'     => '',
                            'default'  => 'woocommerce',
                            'required' => array( 'haru_archive_product_hidden_sidebar_mobile_layout', '=', array( '1' ) ),
                        ),
                        array(
                            'id'       => 'haru_archive_product_widget_scroll',
                            'type'     => 'switch',
                            'title'    => esc_html__( 'Widget Scroll', 'teespace' ),
                            'subtitle' => esc_html__( 'Use Scroll when widget is too long.', 'teespace' ),
                            'default'  => true
                        ),
                        array(
                            'id'       => 'haru_archive_product_widget_toggle',
                            'type'     => 'switch',
                            'title'    => esc_html__( 'Widget Toggle', 'teespace' ),
                            'subtitle' => esc_html__( 'Use Toggle when widget is too long.', 'teespace' ),
                            'default'  => true
                        ),
                        array(
                            'id'       => 'haru_archive_product_style',
                            'type'     => 'button_set',
                            'title'    => esc_html__( 'Archive Product Style', 'teespace' ),
                            'subtitle' => esc_html__( 'Set Product Loop Style', 'teespace' ),
                            'desc'     => esc_html__( 'Style 1 is Classic & Style 2 is Boxed Shadow', 'teespace' ),
                            'options'  => array(
                                'style-1'       => esc_html__( 'Style 1', 'teespace' ),
                                'style-2'       => esc_html__( 'Style 2', 'teespace' ),
                            ),
                            'default'  => 'style-1',
                        ),
                        array(
                            'id'     => 'haru-section-archive-product-layout-end',
                            'type'   => 'section',
                            'indent' => false
                        ),
                        array(
                            'id'     => 'haru-section-archive-product-title-start',
                            'type'   => 'section',
                            'title'  => esc_html__( 'Page Title Options', 'teespace' ),
                            'indent' => true
                        ),
                        array(
                            'id'       => 'haru_show_archive_product_title',
                            'type'     => 'switch',
                            'title'    => esc_html__( 'Archive Product Title', 'teespace' ),
                            'subtitle' => '',
                            'default'  => true
                        ),
                        array(
                            'id'       => 'haru_archive_product_title_layout',
                            'type'     => 'button_set',
                            'title'    => esc_html__( 'Archive Product Title Layout', 'teespace' ),
                            'subtitle' => '',
                            'desc'     => '',
                            'options'  => array(
                                'full-width'            => esc_html__( 'Full Width', 'teespace' ),
                                'haru-container'       => esc_html__( 'Container', 'teespace' ),
                                'haru-container haru-container--large'       => esc_html__( 'Large Container', 'teespace' ),
                            ),
                            'default'  => 'full-width',
                            'required' => array( 'haru_show_archive_product_title', '=', array( '1' ) ),
                        ),
                        array(
                            'id'       => 'haru_archive_product_title_content_layout',
                            'type'     => 'button_set',
                            'title'    => esc_html__( 'Archive Product Title Content Layout', 'teespace' ),
                            'subtitle' => '',
                            'desc'     => '',
                            'options'  => array(
                                'full-width'            => esc_html__( 'Full Width', 'teespace' ),
                                'haru-container'       => esc_html__( 'Container', 'teespace' ),
                                'haru-container haru-container--large'       => esc_html__( 'Large Container', 'teespace' ),
                            ),
                            'default'  => 'haru-container',
                            'required' => array( 'haru_show_archive_product_title', '=', array( '1' ) ),
                        ),
                        array(
                            'id'       => 'haru_archive_product_title_bg_image',
                            'type'     => 'media',
                            'url'      => true,
                            'title'    => esc_html__( 'Archive Product Title Background', 'teespace' ),
                            'subtitle' => '',
                            'desc'     => '',
                            'default'  => array(),
                            'required'  => array( 'haru_show_archive_product_title', '=', array( '1' ) ),
                        ),
                        array(
                            'id'       => 'haru_archive_product_title_heading',
                            'type'     => 'switch',
                            'title'    => esc_html__( 'Heading', 'teespace' ),
                            'subtitle' => '',
                            'default'  => true,
                            'required' => array( 'haru_show_archive_product_title', '=', array( '1' ) ),
                        ),
                        array(
                            'id'       => 'haru_archive_product_title_breadcrumbs',
                            'type'     => 'switch',
                            'title'    => esc_html__( 'Breadcrumbs', 'teespace' ),
                            'subtitle' => '',
                            'default'  => true,
                            'required'  => array( 'haru_show_archive_product_title', '=', array( '1' ) ),
                        ),
                        // Extra
                        array(
                            'id'     => 'haru-section-archive-product-content-start',
                            'type'   => 'section',
                            'title'  => esc_html__( 'Extra Content', 'teespace' ),
                            'indent' => true
                        ),
                        array(
                            'id'       => 'haru_archive_product_extra',
                            'type'     => 'switch',
                            'title'    => esc_html__( 'Extra Content', 'teespace' ),
                            'subtitle' => esc_html__( 'Add Content for Shop & Product Category, Tags,...', 'teespace'),
                            'desc'     => esc_html__( 'This option can be override by in each Product Category.', 'teespace' ),
                            'default'  => false
                        ),
                        array(
                            'id'       => 'haru_archive_product_extra_content',
                            'type'     => 'content',
                            'title'    => esc_html__( 'Extra Content Builder', 'teespace' ),
                            'subtitle' => esc_html__( 'Please go to Content Builders to create Content.', 'teespace'),
                            'desc'     => esc_html__( 'This option can be override by in each Product Category.', 'teespace' ),
                            'required' => array( 'haru_archive_product_extra', '=', array( '1' ) ),
                        ),
                        array(
                            'id'       => 'haru_archive_product_extra_all',
                            'type'     => 'switch',
                            'title'    => esc_html__( 'Add All Product Terms', 'teespace' ),
                            'subtitle' => esc_html__( 'Add Content for all Product Category, Tags,...', 'teespace' ),
                            'desc'     => esc_html__( 'This option can be override by in each Product Category.', 'teespace' ),
                            'default'  => false,
                            'required' => array( 'haru_archive_product_extra', '=', array( '1' ) ),
                        ),
                        array(
                            'id'       => 'haru_archive_product_extra_position',
                            'type'     => 'select',
                            'title'    => esc_html__( 'Extra Content Position', 'teespace' ),
                            'subtitle' => esc_html__( 'Set position to display Extra Content.', 'teespace' ),
                            'desc'     => esc_html__( 'This option can be override by in each Product Category.', 'teespace' ),
                            'options'  => array(
                                'before_main_content'  => esc_html__( 'Before Main Content', 'teespace' ),
                                'after_main_content'  => esc_html__( 'After Main Content', 'teespace' ),
                            ),
                            'default'  => 'before_main_content',
                            'required' => array( 'haru_archive_product_extra', '=', array( '1' ) ),
                        ),
                        array(
                            'id'     => 'haru-section-archive-product-conent-end',
                            'type'   => 'section',
                            'indent' => false
                        ),

                    )
                );

                // Single Product
                $this->sections[] = array(
                    'title'      => esc_html__( 'Single Product', 'teespace' ),
                    'desc'       => '',
                    'icon'       => 'el el-laptop',
                    'subsection' => true,
                    'fields'     => array(
                        array(
                            'id'     => 'haru-section-single-product-layout-start',
                            'type'   => 'section',
                            'title'  => esc_html__( 'Layout Options', 'teespace' ),
                            'indent' => true
                        ),
                        array(
                            'id'       => 'haru_single_product_layout',
                            'type'     => 'button_set',
                            'title'    => esc_html__( 'Single Product Layout', 'teespace' ),
                            'subtitle' => '',
                            'desc'     => '',
                            'options'  => array(
                                'full-width'            => esc_html__( 'Full Width', 'teespace' ),
                                'haru-container'       => esc_html__( 'Container', 'teespace' ),
                                'haru-container haru-container--large'       => esc_html__( 'Large Container', 'teespace' ),
                            ),
                            'default'  => 'haru-container'
                        ),
                        array(
                            'id'       => 'haru_single_product_style',
                            'type'     => 'select',
                            'title'    => esc_html__( 'Single Product Style', 'teespace' ),
                            'subtitle' => '',
                            'desc'     => esc_html__( 'This option can be override by Page Metabox of each Product.', 'teespace' ),
                            'options'  => array(
                                'horizontal'        => esc_html__( 'Horizontal Slide', 'teespace' ),
                                'vertical'          => esc_html__( 'Vertical Slide', 'teespace' ),
                                'vertical_gallery'  => esc_html__( 'Vertical Gallery', 'teespace' ),
                                'grid_gallery'      => esc_html__( 'Grid Gallery', 'teespace' ),
                            ),
                            'default'  => 'horizontal'
                        ),
                        array(
                            'id'       => 'haru_single_product_thumbnail_columns',
                            'type'     => 'select',
                            'title'    => esc_html__( 'Product Thumbnail Columns', 'teespace' ),
                            'subtitle' => esc_html__( 'Choose the number of columns to display thumbnails.', 'teespace' ),
                            'desc'     => esc_html__( 'This option can be override by Page Metabox of each Product.', 'teespace' ),
                            'options'  => array(
                                '2'     => '2',
                                '3'     => '3',
                                '4'     => '4',
                                '5'     => '5'
                            ),
                            'default' => '4',
                            'required'  => array( 'haru_single_product_style', '=', array( 'horizontal', 'vertical' ) ),
                        ),
                        array(
                            'id'       => 'haru_single_product_thumbnail_position',
                            'type'     => 'button_set',
                            'title'    => esc_html__( 'Product Thumbnails Position', 'teespace' ),
                            'subtitle' => '',
                            'desc'     => esc_html__( 'This option can be override by Page Metabox of each Product.', 'teespace' ),
                            'options'  => array(
                                'thumbnail-left'        => esc_html__( 'Left', 'teespace' ),
                                'thumbnail-right'       => esc_html__( 'Right', 'teespace' ),
                            ),
                            'default'  => 'thumbnail-left',
                            'required'  => array( 'haru_single_product_style', '=', array( 'vertical' ) ),
                        ),
                        array(
                            'id'       => 'haru_single_product_sticky_image',
                            'type'     => 'select',
                            'title'    => esc_html__( 'Sticky Product Images', 'teespace' ),
                            'subtitle' => '',
                            'desc'     => esc_html__( 'This option can be override by Page Metabox of each Product.', 'teespace' ),
                            'options'  => array(
                                'no-sticky'  => esc_html__( 'No Sticky', 'teespace' ),
                                'sticky'     => esc_html__( 'Sticky', 'teespace' ),
                            ),
                            'default'  => 'no-sticky',
                            'required' => array( 'haru_single_product_style', '=', array( 'horizontal', 'vertical' ) ),
                        ),
                        array(
                            'id'       => 'haru_single_product_sidebar',
                            'type'     => 'image_select',
                            'title'    => esc_html__( 'Single Product Sidebar', 'teespace' ),
                            'subtitle' => esc_html__( 'None, Left or Right Sidebar', 'teespace' ),
                            'desc'     => '',
                            'options'  => array(
                                'none'     => array( 'title' => '', 'img' => get_template_directory_uri() . '/framework/admin-assets/images/theme-options/sidebar-none.png' ),
                                'left'     => array( 'title' => '', 'img' => get_template_directory_uri() . '/framework/admin-assets/images/theme-options/sidebar-left.png' ),
                                'right'    => array( 'title' => '', 'img' => get_template_directory_uri() . '/framework/admin-assets/images/theme-options/sidebar-right.png' ),
                                'two'      => array( 'title' => '', 'img' => get_template_directory_uri() . '/framework/admin-assets/images/theme-options/sidebar-two.png' ),
                            ),
                            'default' => 'none'
                        ),
                        array(
                            'id'       => 'haru_single_product_left_sidebar',
                            'type'     => 'select',
                            'title'    => esc_html__( 'Single Product Left Sidebar', 'teespace' ),
                            'subtitle' => '',
                            'data'     => 'sidebars',
                            'desc'     => '',
                            'default'  => 'woocommerce',
                            'required' => array( 'haru_single_product_sidebar', '=', array( 'left', 'two' ) ),
                        ),
                        array(
                            'id'       => 'haru_single_product_right_sidebar',
                            'type'     => 'select',
                            'title'    => esc_html__( 'Single Product Right Sidebar', 'teespace' ),
                            'subtitle' => '',
                            'data'     => 'sidebars',
                            'desc'     => '',
                            'default'  => 'woocommerce',
                            'required' => array( 'haru_single_product_sidebar', '=', array( 'right', 'two' ) ),
                        ),
                        array(
                            'id'       => 'haru_single_product_sticky_cart',
                            'type'     => 'select',
                            'title'    => esc_html__( 'Sticky Add To Cart', 'teespace' ),
                            'subtitle' => esc_html__( 'Sticky Add To Cart button when scroll on Desktop.', 'teespace' ),
                            'desc'     => esc_html__( 'This option can be override by Page Metabox of each Product and will hide on Mobile Devices.', 'teespace' ),
                            'options'  => array(
                                'no-sticky'  => esc_html__( 'No Sticky', 'teespace' ),
                                'sticky'     => esc_html__( 'Sticky', 'teespace' ),
                            ),
                            'default'  => 'no-sticky',
                        ),
                        array(
                            'id'       => 'haru_single_product_navigation',
                            'type'     => 'select',
                            'title'    => esc_html__( 'Navigation', 'teespace' ),
                            'subtitle' => esc_html__( 'Product Next, Previous products navigation.', 'teespace' ),
                            'options'  => array(
                                'hide'  => esc_html__( 'Hide', 'teespace' ),
                                'show'  => esc_html__( 'Show', 'teespace' ),
                            ),
                            'default'  => 'hide',
                        ),
                        array(
                            'id'     => 'haru-section-single-product-layout-end',
                            'type'   => 'section',
                            'indent' => false
                        ),
                        array(
                            'id'     => 'haru-section-single-product-related-start',
                            'type'   => 'section',
                            'title'  => esc_html__( 'Related Product Options', 'teespace' ),
                            'indent' => true
                        ),
                        array(
                            'id'       => 'haru_related_product_count',
                            'type'     => 'text',
                            'title'    => esc_html__( 'Related Products Number', 'teespace' ),
                            'subtitle' => '',
                            'validate' => 'number',
                            'default'  => '6',
                        ),
                        array(
                            'id'       => 'haru_related_product_display_columns',
                            'type'     => 'select',
                            'title'    => esc_html__( 'Related Product Display Columns', 'teespace' ),
                            'subtitle' => '',
                            'options'  => array(
                                '3'     => esc_html__( '3', 'teespace' ),
                                '4'     => esc_html__( '4', 'teespace' ),
                            ),
                            'desc'    => '',
                            'default' => '4'
                        ),
                        array(
                            'id'       => 'haru_related_product_display_type',
                            'type'     => 'button_set',
                            'title'    => esc_html__( 'Related Product Display Type', 'teespace' ),
                            'subtitle' => '',
                            'desc'     => '',
                            'options'  => array(
                                'slideshow'     => esc_html__( 'Slideshow', 'teespace' ),
                                'grid'          => esc_html__( 'Grid', 'teespace' ),
                            ),
                            'default'  => 'slideshow',
                        ),
                        array(
                            'id'     => 'haru-section-single-product-related-end',
                            'type'   => 'section',
                            'indent' => false
                        ),
                        array(
                            'id'     => 'haru-section-single-product-title-start',
                            'type'   => 'section',
                            'title'  => esc_html__( 'Page Title Options', 'teespace' ),
                            'indent' => true
                        ),
                        array(
                            'id'       => 'haru_show_single_product_title',
                            'type'     => 'switch',
                            'title'    => esc_html__( 'Single Title', 'teespace' ),
                            'subtitle' => '',
                            'default'  => true
                        ),
                        array(
                            'id'       => 'haru_single_product_title_layout',
                            'type'     => 'button_set',
                            'title'    => esc_html__( 'Single Product Title Layout', 'teespace' ),
                            'subtitle' => '',
                            'desc'     => '',
                            'options'  => array(
                                'full-width'            => esc_html__( 'Full Width', 'teespace' ),
                                'haru-container'       => esc_html__( 'Container', 'teespace' ),
                                'haru-container haru-container--large'       => esc_html__( 'Large Container', 'teespace' ),
                            ),
                            'default'  => 'full-width',
                            'required' => array( 'haru_show_single_product_title', '=', array( '1' ) ),
                        ),
                        array(
                            'id'       => 'haru_single_product_title_content_layout',
                            'type'     => 'button_set',
                            'title'    => esc_html__( 'Archive Product Title Content Layout', 'teespace' ),
                            'subtitle' => '',
                            'desc'     => '',
                            'options'  => array(
                                'full-width'            => esc_html__( 'Full Width', 'teespace' ),
                                'haru-container'       => esc_html__( 'Container', 'teespace' ),
                                'haru-container haru-container--large'       => esc_html__( 'Large Container', 'teespace' ),
                            ),
                            'default'  => 'haru-container',
                            'required' => array( 'haru_show_single_product_title', '=', array( '1' ) ),
                        ),
                        array(
                            'id'       => 'haru_single_product_title_bg_image',
                            'type'     => 'media',
                            'url'      => true,
                            'title'    => esc_html__( 'Single Product Title Background', 'teespace' ),
                            'subtitle' => '',
                            'desc'     => '',
                            'default'  => array(),
                            'required'  => array( 'haru_show_single_product_title', '=', array( '1' ) ),
                        ),
                        array(
                            'id'       => 'haru_single_product_title_heading',
                            'type'     => 'switch',
                            'title'    => esc_html__( 'Heading', 'teespace' ),
                            'subtitle' => '',
                            'default'  => false,
                            'required' => array( 'haru_show_single_product_title', '=', array( '1' ) ),
                        ),
                        array(
                            'id'       => 'haru_single_product_title_breadcrumbs',
                            'type'     => 'switch',
                            'title'    => esc_html__( 'Breadcrumbs', 'teespace' ),
                            'subtitle' => '',
                            'default'  => true,
                            'required'  => array( 'haru_show_single_product_title', '=', array( '1' ) ),
                        ),
                        array(
                            'id'     => 'haru-section-single-product-title-end',
                            'type'   => 'section',
                            'indent' => false
                        ),
                        // Extra
                        array(
                            'id'     => 'haru-section-single-product-content-start',
                            'type'   => 'section',
                            'title'  => esc_html__( 'Extra Content', 'teespace' ),
                            'indent' => true
                        ),
                        array(
                            'id'       => 'haru_single_product_extra',
                            'type'     => 'switch',
                            'title'    => esc_html__( 'Extra Content', 'teespace' ),
                            'subtitle' => esc_html__( 'Add Content for Single Product page', 'teespace'),
                            'desc'     => esc_html__( 'This option can be override by in each Product.', 'teespace' ),
                            'default'  => false
                        ),
                        array(
                            'id'       => 'haru_single_product_extra_content',
                            'type'     => 'content',
                            'title'    => esc_html__( 'Extra Content Builder', 'teespace' ),
                            'subtitle' => esc_html__( 'Please go to Content Builders to create Content.', 'teespace'),
                            'desc'     => esc_html__( 'This option can be override by in each Product.', 'teespace' ),
                            'required' => array( 'haru_single_product_extra', '=', array( '1' ) ),
                        ),
                        array(
                            'id'       => 'haru_single_product_extra_position',
                            'type'     => 'select',
                            'title'    => esc_html__( 'Extra Content Position', 'teespace' ),
                            'subtitle' => esc_html__( 'Set position to display Extra Content.', 'teespace' ),
                            'desc'     => esc_html__( 'This option can be override by in each Product.', 'teespace' ),
                            'options'  => array(
                                'before_main_content'  => esc_html__( 'Before Main Content', 'teespace' ),
                                'after_main_content'  => esc_html__( 'After Main Content', 'teespace' ),
                            ),
                            'default'  => 'before_main_content',
                            'required' => array( 'haru_single_product_extra', '=', array( '1' ) ),
                        ),
                        array(
                            'id'     => 'haru-section-single-product-content-end',
                            'type'   => 'section',
                            'indent' => false
                        ),
                    )
                );
                
                if ( true == haru_check_wpc_product_options_plugin_status() ) {
                    $this->sections[] = array(
                        'title'      => esc_html__( 'Single Product Options', 'teespace' ),
                        'desc'       => '',
                        'icon'       => 'el el-wrench-alt',
                        'subsection' => true,
                        'fields'     => array(
                            array(
                                'id'     => 'haru-section-single-product-extra-start',
                                'type'   => 'section',
                                'title'  => esc_html__( 'Extra Options', 'teespace' ),
                                'indent' => true
                            ),
                            array(
                                'id'    => 'haru_single_product_extra_options_notice',
                                'type'  => 'info',
                                'style' => 'critical',
                                'title' => esc_html__( 'Extra Options', 'teespace' ),
                                'icon'  => 'el el-info-circle',
                                'desc'  => 'Please install & active <a href="https://wordpress.org/plugins/wpc-product-options/" target="_blank">WPC Product Options for WooCommerce</a> plugin & follow this topic: <a href="https://harutheme.com/forums/topic/how-to-use-woocommerce-product-extra-options/" target="_blank">https://harutheme.com/forums/topic/how-to-use-woocommerce-product-extra-options/</a>'
                            ),
                            array(
                                'id'       => 'haru_single_product_extra_options',
                                'type'     => 'button_set',
                                'title'    => esc_html__( 'Extra Options Style', 'teespace' ),
                                'subtitle' => '',
                                'desc'     => esc_html__( 'This option can be override by Product Metabox of each Product.', 'teespace' ),
                                'options'  => array(
                                    'show'         => esc_html__( 'Show', 'teespace' ),
                                    'toggle'       => esc_html__( 'Toggle', 'teespace' ),
                                ),
                                'default'  => 'show'
                            ),
                            array(
                                'id'       => 'haru_single_product_extra_options_limit',
                                'type'     => 'text',
                                'title'    => esc_html__( 'File Size Limit', 'teespace' ),
                                'subtitle' => '',
                                'desc'     => esc_html__( 'Setting for File Upload field. This must be numeric or empty (default is 1), unit is MB. ', 'teespace' ),
                                'validate' => 'numeric',
                                'default'  => '32',
                            ),
                        ),
                    );
                }

                // Buy Now
                $this->sections[] = array(
                    'title'      => esc_html__( 'Buy Now Options', 'teespace' ),
                    'desc'       => '',
                    'icon'       => 'el el-shopping-cart',
                    'subsection' => true,
                    'fields'     => array(
                        array(
                            'id'       => 'haru_product_buy_now',
                            'type'     => 'switch',
                            'title'    => esc_html__( 'Buy Now Button', 'teespace' ),
                            'subtitle' => esc_html__( 'Enable/Disable Buy Now Button', 'teespace' ),
                            'default'  => false
                        ),
                        array(
                            'id'       => 'haru_woo_buy_now_single_position',
                            'type'     => 'select',
                            'title'    => esc_html__( 'Single Position', 'teespace' ),
                            'subtitle' => esc_html__( 'Buy Now Single Position', 'teespace' ),
                            'desc'     => esc_html__( 'Set position for Buy Now button on Single Product page', 'teespace' ),
                            'options'  => array(
                                'after_add_to_cart'       => esc_html__( 'After Add to Cart', 'teespace' ),
                                'before_add_to_cart'       => esc_html__( 'Before Add to Cart', 'teespace' ),
                            ),
                            'default'  => 'after_add_to_cart',
                            'required' => array( 'haru_product_buy_now', '=', array( '1' ) ),
                        ),
                        array(
                            'id'       => 'haru_product_buy_now_archive',
                            'type'     => 'switch',
                            'title'    => esc_html__( 'Archive Buy Now Button', 'teespace' ),
                            'subtitle' => esc_html__( 'Enable/Disable Buy Now Button on Archive', 'teespace' ),
                            'desc'     => esc_html__( 'Buy Now button may show only on Simple Product', 'teespace' ),
                            'default'  => false,
                            'required' => array( 'haru_product_buy_now', '=', array( '1' ) ),
                        ),
                        array(
                            'id'       => 'haru_woo_buy_now_archive_position',
                            'type'     => 'select',
                            'title'    => esc_html__( 'Archive Position', 'teespace' ),
                            'subtitle' => esc_html__( 'Buy Now Archive Position', 'teespace' ),
                            'desc'     => esc_html__( 'Set position for Buy Now button on Archive Product page', 'teespace' ),
                            'options'  => array(
                                'after_price'       => esc_html__( 'After Price', 'teespace' ),
                            ),
                            'default'  => 'after_price',
                            'required' => array( 'haru_product_buy_now_archive', '=', array( '1' ) ),
                        ),
                        array(
                            'id'       => 'haru_woo_buy_now_cats',
                            'type'     => 'select',
                            'multi'    => true,
                            'data'     => 'terms',
                            'args'     => array( 
                                'taxonomies' => 'product_cat',
                                'hide_empty' => false
                            ),
                            'title'    => esc_html__( 'Categories Display', 'teespace' ),
                            'subtitle' => esc_html__( 'Buy Now Categories Display', 'teespace' ),
                            'desc'     => esc_html__( 'Set Categories to display Buy Now button. If not set will display on all Product Categories', 'teespace' ),
                            'default'  => array(),
                            'required' => array( 'haru_product_buy_now', '=', array( '1' ) ),
                        ),
                        array(
                            'id'       => 'haru_woo_buy_now_hide_atc',
                            'type'     => 'switch',
                            'title'    => esc_html__( 'Hide Add To Cart Button', 'teespace' ),
                            'subtitle' => esc_html__( 'Enable/Disable hide Add To Cart button', 'teespace' ),
                            'desc'     => esc_html__( 'Hide the default Add To Cart button on products that already has Buy Now button', 'teespace' ),
                            'default'  => false,
                            'required' => array( 'haru_product_buy_now', '=', array( '1' ) ),
                        ),
                        array(
                            'id'       => 'haru_woo_buy_now_redirect',
                            'type'     => 'select',
                            'title'    => esc_html__( 'Redirect', 'teespace' ),
                            'subtitle' => esc_html__( 'Buy Now Redirect', 'teespace' ),
                            'desc'     => esc_html__( 'Set redirect after click Buy Now button', 'teespace' ),
                            'options'  => array(
                                'checkout'   => esc_html__( 'Checkout', 'teespace' ),
                                'cart'       => esc_html__( 'Cart', 'teespace' ),
                                'custom'       => esc_html__( 'Custom URL', 'teespace' ),
                            ),
                            'default'  => 'checkout',
                            'required' => array( 'haru_product_buy_now', '=', array( '1' ) ),
                        ),
                        array(
                            'id'       => 'haru_woo_buy_now_custom_redirect',
                            'type'     => 'text',
                            'title'    => esc_html__( 'Custom Redirect URL', 'teespace' ),
                            'desc'     => esc_html__( 'Insert Custom Redirect URL after click Buy Now button.', 'teespace' ),
                            'subtitle' => '',
                            'default'  => '/',
                            'required' => array( 'haru_woo_buy_now_redirect', '=', array( 'custom' ) ),
                        ),
                    )
                );
            }

            // Bottom Toolbar
            $this->sections[] = array(
                'title'  => esc_html__( 'Bottom Toolbar', 'teespace' ),
                'desc'   => '',
                'subsection' => false,
                'icon'   => 'el el-credit-card',
                'fields' => array(
                    array(
                        'id'       => 'haru_bottom_toolbar',
                        'type'     => 'select',
                        'title'    => esc_html__( 'Bottom Toolbar', 'teespace' ),
                        'subtitle' => esc_html__( 'WooCommerce bottom toolbar for quick access on Mobile Devices.', 'teespace' ),
                        'desc'     => esc_html__( 'Bottom Toolbar show only on Mobile Devices.', 'teespace' ),
                        'options'  => array(
                            'hide'  => esc_html__( 'Hide', 'teespace' ),
                            'show'  => esc_html__( 'Show', 'teespace' ),
                        ),
                        'default'  => 'hide',
                    ),
                    array(
                        'id'       => 'haru_bottom_toolbar_template',
                        'type'     => 'footer',
                        'title'    => esc_html__( 'Bottom Toolbar Template', 'teespace' ),
                        'subtitle' => esc_html__( 'Please go to Footer Builder to create Bottom Toolbar.', 'teespace'),
                        'desc'     => esc_html__( 'This option will show on mobile devices only.', 'teespace' ),
                        'required' => array( 'haru_bottom_toolbar', '=', array( 'show' ) ),
                    ),
                )
            );

            // Social options
            $this->sections[] = array(
                'title'  => esc_html__( 'Social Settings', 'teespace' ),
                'desc'   => '',
                'icon'   => 'el el-facebook',
                'fields' => array(
                    array(
                        'title'    => esc_html__( 'Social Share', 'teespace' ),
                        'subtitle' => esc_html__( 'Show the social sharing in blog posts or custom posttype', 'teespace' ),
                        'id'       => 'haru_social_sharing',
                        'type'     => 'checkbox',
                        // Must provide key => value pairs for multi checkbox options
                        'options'  => array(
                            'facebook'  => esc_html__( 'Facebook', 'teespace' ),
                            'twitter'   => esc_html__( 'Twitter', 'teespace' ),
                            'linkedin'  => esc_html__( 'Linkedin', 'teespace' ),
                            'tumblr'    => esc_html__( 'Tumblr', 'teespace' ),
                            'pinterest' => esc_html__( 'Pinterest', 'teespace' ),
                            'vk'        => esc_html__( 'VK', 'teespace' ),
                            'telegram'  => esc_html__( 'Telegram', 'teespace' ),
                            'whatsapp'  => esc_html__( 'WhatsApp', 'teespace' ),
                            'email'     => esc_html__( 'Email', 'teespace' ),
                        ),

                        // See how default has changed? you also don't need to specify opts that are 0.
                        'default' => array(
                            'facebook'  => '1',
                            'twitter'   => '1',
                            'linkedin'  => '1',
                            'tumblr'    => '1',
                            'pinterest' => '1',
                            'vk'        => '1',
                            'telegram'  => '1',
                            'whatsapp'  => '0',
                            'email'     => '0',
                        )
                    )
                )
            );

            // Popup Configs
            $this->sections[] = array(
                'title'  => esc_html__( 'Newsletter Popup', 'teespace' ),
                'desc'   => '',
                'icon'   => 'el el-photo',
                'fields' => array(
                    array(
                        'id'       => 'haru_show_popup',
                        'type'     => 'switch',
                        'title'    => esc_html__( 'Show Popup', 'teespace' ),
                        'subtitle' => '',
                        'default'  => false
                    ),
                    array(
                        'id'       => 'haru_popup_width',
                        'type'     => 'text',
                        'title'    => esc_html__( 'Popup Width', 'teespace' ),
                        'subtitle' => esc_html__( 'Please set with of popup (number only in px)', 'teespace' ),
                        'validate' => 'numeric',
                        'desc'     => '',
                        'default'  => '750',
                        'required' => array( 'haru_show_popup', '=', array( '1' ) ),
                    ),
                    array(
                        'id'       => 'haru_popup_height',
                        'type'     => 'text',
                        'title'    => esc_html__( 'Popup Height', 'teespace' ),
                        'subtitle' => esc_html__( 'Please set height of popup (number only in px)', 'teespace' ),
                        'validate' => 'numeric',
                        'desc'     => '',
                        'default'  => '450',
                        'required' => array( 'haru_show_popup', '=', array( '1' ) ),
                    ),
                    array(
                        'id'       => 'haru_popup_effect',
                        'type'     => 'select',
                        'title'    => esc_html__( 'Popup Effect', 'teespace' ),
                        'subtitle' => '',
                        'options'  => array(
                            'mfp-zoom-in'         => esc_html__( 'ZoomIn', 'teespace' ),
                            'mfp-newspaper'       => esc_html__( 'Newspaper', 'teespace' ),
                            'mfp-move-horizontal' => esc_html__( 'Move Horizontal', 'teespace' ),
                            'mfp-move-from-top'   => esc_html__( 'Move From Top', 'teespace' ),
                            'mfp-3d-unfold'       => esc_html__( '3D Unfold', 'teespace' ),
                            'mfp-zoom-out'        => esc_html__( 'ZoomOut', 'teespace' ),
                            'hinge'               => esc_html__( 'Hinge', 'teespace' )
                        ),
                        'desc'     => '',
                        'default'  => 'mfp-zoom-in',
                        'required' => array( 'haru_show_popup', '=', array( '1' ) ),
                    ),
                    array(
                        'id'       => 'haru_popup_delay',
                        'type'     => 'text',
                        'title'    => esc_html__( 'Popup Delay', 'teespace' ),
                        'subtitle' => esc_html__( 'Please set delay of popup (caculate by miliseconds)', 'teespace' ),
                        'validate' => 'numeric',
                        'desc'     => '',
                        'default'  => '5000',
                        'required' => array( 'haru_show_popup', '=', array( '1' ) ),
                    ),
                    array(
                        'id'       => 'haru_popup_content',
                        'type'     => 'editor',
                        'title'    => esc_html__( 'Popup Content', 'teespace' ),
                        'subtitle' => esc_html__( 'Please set content of popup. You can use shortcode here.', 'teespace' ),
                        'desc'     => '',
                        'default'  => '',
                        'required' => array( 'haru_show_popup', '=', array( '1' ) ),
                    ),
                    array(
                        'id'       => 'haru_popup_background',
                        'type'     => 'media',
                        'title'    => esc_html__( 'Popup Background', 'teespace' ),
                        'url'      => true,
                        'subtitle' => '',
                        'desc'     => '',
                        'default'  => array(
                            'url'  =>  ''
                        ),
                        'required' => array( 'haru_show_popup', '=', array( '1' ) ),
                    ),

                )
            );
        }

        public function setHelpTabs() {

        }

        /**
         * All the possible arguments for Redux.
         * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
         * */
        public function setArguments() {

            $theme = wp_get_theme(); // For use with some settings. Not necessary.

            $this->args = array(
                // TYPICAL -> Change these values as you need/desire
                'opt_name'           => 'haru_teespace_options',
                // This is where your data is stored in the database and also becomes your global variable name.
                'display_name'       => $theme->get( 'Name' ),
                // Name that appears at the top of your panel
                'display_version'    => $theme->get( 'Version' ),
                // Version that appears at the top of your panel
                'menu_type'          => 'menu', // or submenu under Appearence
                //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                'allow_sub_menu'     => true,
                // Show the sections below the admin menu item or not
                'menu_title'         => esc_html__( 'Theme Options', 'teespace' ),
                'page_title'         => esc_html__( 'Theme Options', 'teespace' ),
                // You will need to generate a Google API key to use this feature.
                // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
                'google_api_key'     => '',
                // Must be defined to add google fonts to the typography module

                'async_typography'   => true,
                // Use a asynchronous font on the front end or font string
                'font_display'       => 'auto', // block|swap|fallback|optional.
                'admin_bar'          => true,
                // Show the panel pages on the admin bar
                'global_variable'    => '',
                // Set a different name for your global variable other than the opt_name
                'dev_mode'           => false,
                // Show the time the page took to load, etc
                'forced_dev_mode_off' => true,
                // To forcefully disable the dev mode
                'templates_path'     => get_template_directory().'/framework/core/templates/panel',
                // Path to the templates file for various Redux elements
                'customizer'         => true,
                // Enable basic customizer support

                // OPTIONAL -> Give you extra features
                'page_priority'      => null,
                // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                'page_parent'        => 'themes.php',
                // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_theme_page#Parameters
                'page_permissions'   => 'manage_options',
                // Permissions needed to access the options panel.
                'menu_icon'          => '',
                // Specify a custom URL to an icon
                'last_tab'           => '',
                // Force your panel to always open to a specific tab (by id)
                'page_icon'          => 'icon-themes',
                // Icon displayed in the admin panel next to your menu_title
                'page_slug'          => '_options',
                // Page slug used to denote the panel
                'save_defaults'      => true,
                // On load save the defaults to DB before user clicks save or not
                'default_show'       => false,
                // If true, shows the default value next to each field that is not the default value.
                'default_mark'       => '',
                // What to print by the field's title if the value shown is default. Suggested: *
                'show_import_export' => true,
                // Shows the Import/Export panel when not used as a field.

                // CAREFUL -> These options are for advanced use only
                'transient_time'     => 60 * MINUTE_IN_SECONDS,
                'output'             => true,
                // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
                'output_tag'         => true,
                // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head

                // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                'database'           => '',
                // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                'system_info'        => false,
                // REMOVE

                // HINTS
                'hints'              => array(
                    'icon'          => 'icon-question-sign',
                    'icon_position' => 'right',
                    'icon_color'    => 'lightgray',
                    'icon_size'     => 'normal',
                    'tip_style'     => array(
                        'color'   => 'light',
                        'shadow'  => true,
                        'rounded' => false,
                        'style'   => '',
                    ),
                    'tip_position'  => array(
                        'my' => 'top left',
                        'at' => 'bottom right',
                    ),
                    'tip_effect'    => array(
                        'show' => array(
                            'effect'   => 'slide',
                            'duration' => '500',
                            'event'    => 'mouseover',
                        ),
                        'hide' => array(
                            'effect'   => 'slide',
                            'duration' => '500',
                            'event'    => 'click mouseleave',
                        ),
                    ),
                )
            );

            // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
            $args['share_icons'][] = array(
                'url'   => 'https://github.com/ReduxFramework/ReduxFramework',
                'title' => esc_html__( 'Visit us on GitHub', 'teespace' ),
                'icon'  => 'el el-github'
            );
            $args['share_icons'][] = array(
                'url'   => 'https://www.facebook.com/pages/Redux-Framework/243141545850368',
                'title' => esc_html__( 'Like us on Facebook', 'teespace' ),
                'icon'  => 'el el-facebook'
            );
            $args['share_icons'][] = array(
                'url'   => 'https://twitter.com/reduxframework',
                'title' => esc_html__( 'Follow us on Twitter', 'teespace' ),
                'icon'  => 'el el-twitter'
            );
            $args['share_icons'][] = array(
                'url'   => 'https://www.linkedin.com/company/redux-framework',
                'title' => esc_html__( 'Find us on LinkedIn', 'teespace' ),
                'icon'  => 'el el-linkedin'
            );

        }

    }

    // global $reduxConfig;
    $reduxConfig = new Redux_Framework_theme_options();
}