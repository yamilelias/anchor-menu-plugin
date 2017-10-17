<?php
/**
    Plugin Name: Anchor Menu Plugin
    Plugin URI: https://github.com/yamilelias/anchor-menu-plugin
    Description: WordPress plugin that add a minimal anchor link animation for a landing page.
    Version: 0.5.0
    Author: Yamil Elías
    Author URI: https://yamilelias.github.io
    License: GPLv3
*/

if( ! class_exists( 'wp_anchor_link' ) ) {

    add_action( 'init', array( 'wp_anchor_link', 'instantiate' ), 0 );

    class wp_anchor_link {

        /**
         * Reusable object instance.
         *
         * @type object
         */
        protected static $instance = null;

        /**
         * Creates a new instance. Called on 'init'.
         * May be used to access class methods from outside.
         *
         * @see    __construct()
         */
        public static function instantiate() {
            null === self :: $instance AND self :: $instance = new self;
            return self :: $instance;
        }

        /**
         * wp_anchor_link constructor.
         *
         * @since 0.5.0
         */
        public function __construct() {

            // Enqueue scripts
            add_action( 'init', array( $this, 'enqueue_scripts' ), 999 );

            // that's it!

        }

        /**
         * Enqueue needed scripts so the plugin animation works properly.
         *
         * @since 0.5.0
         */
        public function enqueue_scripts() {
            // jQuery
            if(!wp_script_is('jquery')){
                wp_enqueue_script('jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js');
            } else {
                wp_dequeue_script('jquery'); // Let's use this version so we don't have problems...

                wp_enqueue_script('jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js');
            }

            // Our script
            if(!wp_script_is('anchor-link')){
                wp_enqueue_script( 'anchor-link', plugins_url('anchor-link.js', __FILE__), ['jquery']);
            }
        }
    }
}