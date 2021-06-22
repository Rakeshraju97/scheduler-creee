<?php 
/** 
 * @package scheduler-creee
 */

 /*
 Plugin Name: scheduler-creee
 Plugin URI: https://poweroins.com
 Description: Scheduler for osce
 Version: 1.0.0
 Auther: Poweroins IT solutions
 Author URI: http://poweroins.com
 License: GPLv2 or later 
 Text Domain: Poweroins
 */

 if( ! defined('ABSPATH')){
     die;
 }

 class scheduler_creee {
    
    //changed for seconfd commit and push

    function __construct(){
        add_action('init', array( $this, 'custom_post_type') );
    }

    function register(){
        add_action('admin_enqueue_scripts', array($this, 'enqueue'));   //Add admin side script
        // add_action('wp_enqueue_scripts', array($this, 'enqueue'));  //Add client side script
    }

    function activate(){
        echo 'The plugin was activated';
        // generated a CPT
        $this->custom_post_type();
        // flush rewrite rules
        flush_rewrite_rules();
    }

    function deactivate(){
        echo 'The plugin was deactivated';
         // flush rewrite rules
         flush_rewrite_rules();
    }

    function uninstall(){
        // delete CPT
        // delete all the plugin data from the DB
    }

    function custom_post_type(){
        register_post_type('book',['public' => true, 'label' => 'books']);
    }

    function enqueue(){
        //enqueue all script
        wp_enqueue_style( 'pluginstyle', plugins_url('/assets/style.css', __FILE__) );
        // wp_enqueue_style( 'clientpluginstyle', plugins_url('/assets/clientstyle.css', __FILE__) );
        wp_enqueue_script( 'pluginscript', plugins_url('/assets/script.js', __FILE__) );
    }    

 }

 if( class_exists('scheduler_creee')){
     $scheduler_creee = new scheduler_creee('creee scheduler initialized');
     $scheduler_creee->register();
 }

 //activation
 register_activation_hook(__FILE__, array( $scheduler_creee, 'activate') );
//  add_action('init', 'function_name');

//deactivation
 register_deactivation_hook(__FILE__, array( $scheduler_creee, 'activate') );
 
//uninstall
 register_uninstall_hook(__FILE__, array( $scheduler_creee, 'uninstall') );