<?php
/** 
 * @package    HaruTheme/Haru TeeSpace
 * @version    1.0.0
 * @author     Administrator <admin@harutheme.com>
 * @copyright  Copyright 2022, HaruTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://harutheme.com
*/

namespace Haru_TeeSpace\Widgets;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Utils;
use \Elementor\Icons_Manager;
use \Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use \Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use \Haru_TeeSpace\Classes\Haru_Template;

if ( ! class_exists( 'Haru_TeeSpace_Header_Icon_Box_Widget' ) ) {
    class Haru_TeeSpace_Header_Icon_Box_Widget extends Widget_Base {

        public function get_name() {
            return 'haru-header-icon-box';
        }

        public function get_title() {
            return esc_html__( 'Haru Header Icon Box', 'haru-teespace' );
        }

        public function get_icon() {
            return 'eicon-icon-box';
        }

        public function get_categories() {
            return [ 'haru-elements' ];
        }

        public function get_keywords() {
            return [
                'header icon-box',
                'icon-box',
                'icon',
                'box',
                'header',
            ];
        }

        public function get_custom_help_url() {
            return 'https://document.harutheme.com/elementor/';
        }

        protected function register_controls() {

            $this->start_controls_section(
                'section_icon',
                [
                    'label' => __( 'Header Icon Box', 'haru-teespace' ),
                ]
            );

            $this->add_control(
                'pre_style',
                [
                    'label' => __( 'Pre Header Icon Box', 'haru-teespace' ),
                    'description'   => __( 'If you choose Pre Header Icon Box you will use Style default from our theme.', 'haru-teespace' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'style-1',
                    'options' => [
                        'style-1'   => __( 'Pre Header Icon Box 1', 'haru-teespace' ),
                    ]
                ]
            );

            $this->add_control(
                'selected_icon',
                [
                    'label' => __( 'Icon', 'haru-teespace' ),
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'icon',
                    'default' => [
                        'value' => 'fas fa-star',
                        'library' => 'fa-solid',
                    ],
                ]
            );

            $this->add_control(
                'title_text',
                [
                    'label' => __( 'Title & Description', 'haru-teespace' ),
                    'type' => Controls_Manager::TEXT,
                    'dynamic' => [
                        'active' => true,
                    ],
                    'default' => __( 'This is the heading', 'haru-teespace' ),
                    'placeholder' => __( 'Enter your title', 'haru-teespace' ),
                    'label_block' => true,
                ]
            );

            $this->add_control(
                'description_text',
                [
                    'label' => '',
                    'type' => Controls_Manager::TEXTAREA,
                    'dynamic' => [
                        'active' => true,
                    ],
                    'default' => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'haru-teespace' ),
                    'placeholder' => __( 'Enter your description', 'haru-teespace' ),
                    'rows' => 10,
                    'separator' => 'none',
                    'show_label' => false,
                ]
            );

            $this->add_control(
                'link',
                [
                    'label' => __( 'Link', 'haru-teespace' ),
                    'type' => Controls_Manager::URL,
                    'dynamic' => [
                        'active' => true,
                    ],
                    'placeholder' => __( 'https://your-link.com', 'haru-teespace' ),
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'el_class',
                [
                    'label' => __( 'CSS Classes', 'haru-teespace' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => '',
                    'title' => __( 'Add your custom class WITHOUT the dot. e.g: my-class', 'haru-teespace' ),
                ]
            );

            $this->end_controls_section();

            $this->start_controls_section(
                'section_title_style',
                [
                    'label' => __( 'Layout', 'haru-teespace' ),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
            );

            $this->add_control(
                'background_dark',
                [
                    'label'         => __( 'Background Dark', 'haru-teespace' ),
                    'type'          => Controls_Manager::SWITCHER,
                    'description'   => __( 'Enable if use for section has background dark.', 'haru-teespace' ),
                    'default'       => 'no',
                    'return_value'  => 'yes',
                ]
            );

            $this->end_controls_section();

            $this->start_controls_section(
                'section_style_icon',
                [
                    'label' => __( 'Icon', 'haru-teespace' ),
                    'tab'   => Controls_Manager::TAB_STYLE,
                    'conditions' => [
                        'relation' => 'or',
                        'terms' => [
                            [
                                'name' => 'selected_icon[value]',
                                'operator' => '!=',
                                'value' => '',
                            ],
                        ],
                    ],
                ]
            );

            $this->add_control(
                'primary_color',
                [
                    'label' => __( 'Primary Color', 'haru-teespace' ),
                    'type' => Controls_Manager::COLOR,
                    'global' => [
                        'default' => '',
                    ],
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .haru-header-icon-box__icon' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .haru-header-icon-box__icon svg, {{WRAPPER}} .haru-header-icon-box__icon *' => 'fill: {{VALUE}}; color: {{VALUE}};',
                    ],
                ]
            );

            $this->end_controls_section();

            $this->start_controls_section(
                'section_style_content',
                [
                    'label' => __( 'Content', 'haru-teespace' ),
                    'tab'   => Controls_Manager::TAB_STYLE,
                ]
            );

            $this->add_responsive_control(
                'text_align',
                [
                    'label' => __( 'Alignment', 'haru-teespace' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => __( 'Left', 'haru-teespace' ),
                            'icon' => 'eicon-text-align-left',
                        ],
                        'center' => [
                            'title' => __( 'Center', 'haru-teespace' ),
                            'icon' => 'eicon-text-align-center',
                        ],
                        'right' => [
                            'title' => __( 'Right', 'haru-teespace' ),
                            'icon' => 'eicon-text-align-right',
                        ],
                        'justify' => [
                            'title' => __( 'Justified', 'haru-teespace' ),
                            'icon' => 'eicon-text-align-justify',
                        ],
                    ],
                    'default' => 'left',
                    'selectors' => [
                        '{{WRAPPER}} .haru-header-icon-box' => 'text-align: {{VALUE}};',
                    ],
                ]
            );

            $this->end_controls_section();
        }

        protected function render() {
            $settings = $this->get_settings_for_display();

            $this->add_render_attribute( 'header-icon-box', 'class', 'haru-header-icon-box' );

            if ( $settings['pre_style']  ) {
                $this->add_render_attribute( 'header-icon-box', 'class', 'haru-header-icon-box--' . $settings['pre_style'] );
            }

            if ( ! empty( $settings['el_class'] ) ) {
                $this->add_render_attribute( 'header-icon-box', 'class', $settings['el_class'] );
            }

            $icon_tag = 'span';

            if ( ! isset( $settings['icon'] ) && ! Icons_Manager::is_migration_allowed() ) {
                // add old default
                $settings['icon'] = 'fa fa-star';
            }

            $has_icon = ! empty( $settings['icon'] );

            if ( ! empty( $settings['link']['url'] ) ) {
                $icon_tag = 'a';

                $this->add_link_attributes( 'link', $settings['link'] );
            }

            if ( $has_icon ) {
                $this->add_render_attribute( 'i', 'class', $settings['icon'] );
                $this->add_render_attribute( 'i', 'aria-hidden', 'true' );
            }

            $icon_attributes = $this->get_render_attribute_string( 'icon' );
            $link_attributes = $this->get_render_attribute_string( 'link' );

            $this->add_render_attribute( 'description_text', 'class', 'haru-header-icon-box__description' );

            $this->add_inline_editing_attributes( 'title_text', 'none' );
            $this->add_inline_editing_attributes( 'description_text' );
            if ( ! $has_icon && ! empty( $settings['selected_icon']['value'] ) ) {
                $has_icon = true;
            }
            $migrated = isset( $settings['__fa4_migrated']['selected_icon'] );
            $is_new = ! isset( $settings['icon'] ) && Icons_Manager::is_migration_allowed();
            ?>

            <?php if ( 'yes' == $settings['background_dark'] ) : ?>
                <div class="background-dark">
            <?php endif; ?>
                <div <?php echo $this->get_render_attribute_string( 'header-icon-box' ); ?>>
                    <?php if ( $has_icon ) : ?>
                        <?php if ( in_array( $settings['pre_style'], array( 'style-1', 'style-2', 'style-3', 'style-4', 'style-5' ) ) ) : ?>
                            <div class="haru-header-icon-box__icon">
                                <<?php echo implode( ' ', [ $icon_tag, $icon_attributes, $link_attributes ] ); ?>>
                                <?php
                                if ( $is_new || $migrated ) {
                                    Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true' ] );
                                } elseif ( ! empty( $settings['icon'] ) ) {
                                    ?><i <?php echo $this->get_render_attribute_string( 'i' ); ?>></i><?php
                                }
                                ?>
                                </<?php echo $icon_tag; ?>>
                            </div>

                            <div class="haru-header-icon-box__content">
                                <h6 class="haru-header-icon-box__title">
                                    <<?php echo implode( ' ', [ $icon_tag, $link_attributes ] ); ?><?php echo $this->get_render_attribute_string( 'title_text' ); ?>><?php echo $settings['title_text']; ?></<?php echo $icon_tag; ?>>
                                </h6>
                                <?php if ( ! Utils::is_empty( $settings['description_text'] ) ) : ?>
                                <p <?php echo $this->get_render_attribute_string( 'description_text' ); ?>><?php echo $settings['description_text']; ?></p>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            <?php if ( 'yes' == $settings['background_dark'] ) : ?>
                </div>
            <?php endif; ?>

            <?php
        }

    }
}
