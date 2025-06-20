<?php
/**
 * Redux Framework is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * Redux Framework is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Redux Framework. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package     ReduxFramework
 * @author      Dovy Paukstys
 * @version     3.1.5
 */

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) exit;

// Don't duplicate me!
if( !class_exists( 'ReduxFramework_Content' ) ) {

    /**
     * Main ReduxFramework_Content class
     *
     * @since       1.0.0
     */
    class ReduxFramework_Content extends ReduxFramework {

        protected $parent;
        
        protected $field;

        protected $value;

        public $extension_url;

        public $extension_dir;
    
        /**
         * Field Constructor.
         *
         * Required - must call the parent constructor, then assign field and value to vars, and obviously call the render field function
         *
         * @since       1.0.0
         * @access      public
         * @return      void
         */
        function __construct( $field = array(), $value ='', $parent='' ) {
        
            
            $this->parent = $parent;
            $this->field = $field;
            $this->value = $value;

            if ( empty( $this->extension_dir ) ) {
                $this->extension_dir = trailingslashit( str_replace( '\\', '/', dirname( __FILE__ ) ) );
                $this->extension_url = site_url( str_replace( trailingslashit( str_replace( '\\', '/', ABSPATH ) ), '', $this->extension_dir ) );
            }    

            // Set default args for this field to avoid bad indexes. Change this to anything you use.
            $defaults = array(
                'options'           => array(),
                'stylesheet'        => '',
                'output'            => true,
                'enqueue'           => true,
                'enqueue_frontend'  => true
            );
            $this->field = wp_parse_args( $this->field, $defaults );            
        
        }

        /**
         * Field Render Function.
         *
         * Takes the vars and outputs the HTML for the field in the settings
         *
         * @since       1.0.0
         * @access      public
         * @return      void
         */

        public function render() {
            // Get Content Builder to render
            $content = array();
            $args = array(
                'posts_per_page'   => -1,
                'post_type'        => 'haru_content',
                'post_status'      => 'publish',
            );
            $posts_array = get_posts( $args );
            foreach ( $posts_array as $k => $v ) {
                $content[$v->ID] = $v->post_title;
            }

            $this->field['options'] = $content;

            if ( ! empty( $this->field['options'] ) ) {

                if ( ! empty( $this->field['width'] ) ) {
                    $width = ' style="' . $this->field['width'] . '"';
                } else {
                    $width = ' style="width: 40%;"';
                }

                $placeholder = ( isset( $this->field['placeholder'] ) ) ? esc_attr( $this->field['placeholder'] ) : esc_html__( 'Select an Content', 'haru-teespace' );

                echo '<select ' . ' id="' . $this->field['id'] . '-select" data-placeholder="' . $placeholder . '" name="' . $this->field['name'] . $this->field['name_suffix'] . '" class="' . $this->field['class'] . '"' . $width . ' rows="6">';

                foreach ( $this->field['options'] as $k => $v ) {

                    if (is_array($v)) {
                        echo '<option label="' . $k . '">';

                        foreach($v as $opt => $val) {
                            $this->make_option($opt, $val, $k);
                        }

                        echo '</option>';

                        continue;
                    }

                    $this->make_option($k, $v);
                }
                // foreach

                echo '</select>';
            } else {
                echo '<strong>' . esc_html__( 'No Content were found.', 'haru-teespace' ) . '</strong>';
            }
        } //function

        private function make_option($id, $value, $group_name = '') {
            if ( is_array( $this->value ) ) {
                $selected = ( is_array( $this->value ) && in_array( $id, $this->value ) ) ? ' selected="selected"' : '';
            } else {
                $selected = selected( $this->value, $id, false );
            }

            echo '<option value="' . $id . '"' . $selected . '>' . $value . '</option>';                
        }

    
        /**
         * Enqueue Function.
         *
         * If this field requires any scripts, or css define this function and register/enqueue the scripts/css
         *
         * @since       1.0.0
         * @access      public
         * @return      void
         */
        public function enqueue() {

            // $extension = ReduxFramework_extension_content::getInstance();
        
            wp_enqueue_script(
                'redux-field-content-js', 
                $this->extension_url . 'field-content.js', 
                array( 'jquery' ),
                time(),
                true
            );

            wp_enqueue_style(
                'redux-field-content-css', 
                $this->extension_url . 'field-content.css',
                time(),
                true
            );
        
        }
        
        /**
         * Output Function.
         *
         * Used to enqueue to the front-end
         *
         * @since       1.0.0
         * @access      public
         * @return      void
         */        
        public function output() {

            if ( $this->field['enqueue_frontend'] ) {

            }
            
        }        
        
    }
}