<?php

/*
Plugin Name: Portfolio for Elementor | Powerfolio
Plugin URI: https://powerfoliowp.com/
Description: This plugin extend Elementor by adding the Portfolio functionality for free!
Author: RexDot
Version: 1.2.8
Author URI: https://powerfoliowp.com/
*/
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
//Freemius

if ( function_exists( 'pe_fs' ) ) {
    pe_fs()->set_basename( false, __FILE__ );
} else {
    // DO NOT REMOVE THIS IF, IT IS ESSENTIAL FOR THE `function_exists` CALL ABOVE TO PROPERLY WORK.
    
    if ( !function_exists( 'pe_fs' ) ) {
        // ... Freemius integration snippet ...
        // Create a helper function for easy SDK access.
        function pe_fs()
        {
            global  $pe_fs ;
            
            if ( !isset( $pe_fs ) ) {
                // Include Freemius SDK.
                require_once dirname( __FILE__ ) . '/freemius/start.php';
                $pe_fs = fs_dynamic_init( array(
                    'id'             => '7226',
                    'slug'           => 'portfolio-elementor',
                    'premium_slug'   => 'portfolio-elementor-pro',
                    'type'           => 'plugin',
                    'public_key'     => 'pk_75702ac7c5c10d2bfd4880c1c8039',
                    'is_premium'     => false,
                    'premium_suffix' => 'PRO',
                    'has_addons'     => false,
                    'has_paid_plans' => true,
                    'menu'           => array(
                    'slug'       => 'elementor_portfolio',
                    'first-path' => 'admin.php?page=elementor_portfolio',
                ),
                    'is_live'        => true,
                ) );
            }
            
            return $pe_fs;
        }
        
        // Init Freemius.
        pe_fs();
        // Signal that SDK was initiated.
        do_action( 'pe_fs_loaded' );
    }
    
    // ... Your plugin's main file logic ...
    
    if ( !class_exists( 'ELPT_portfolio_Post_Types' ) ) {
        /*
         * Start Powerfolio
         */
        /*
         * Custom Post Types
         */
        require 'classes/powerfolio_post_types.php';
        /*
         * Shortcodes
         */
        require 'classes/powerfolio_shortcodes.php';
        /*
         * Elementor
         */
        require 'elementor/extend-elementor.php';
        /*
         * Plugin Options
         */
        require 'includes/panel.php';
    }
    
    //Elementor Category
    
    if ( !function_exists( 'elpug_powerups_cat' ) ) {
        //Create Elementor Category
        function elpug_powerups_cat()
        {
            \Elementor\Plugin::$instance->elements_manager->add_category( 'elpug-elements', [
                'title' => __( 'Powerfolio / Power-Ups for Elementor', 'elpug' ),
                'icon'  => 'fa fa-plug',
            ], 2 );
        }
        
        add_action( 'elementor/init', 'elpug_powerups_cat' );
    }
    
    register_activation_hook( __FILE__, 'elpt_activate' );
}


if ( !function_exists( 'elpt_activate' ) ) {
    //Flush rewrite rules after plugin activation
    function elpt_activate()
    {
        if ( !get_option( 'elpt_flush_rewrite_rules_flag' ) ) {
            add_option( 'elpt_flush_rewrite_rules_flag', true );
        }
    }
    
    register_activation_hook( __FILE__, array( 'ELPT_portfolio_Post_Types', 'elpt_add_cpt_support' ) );
}
