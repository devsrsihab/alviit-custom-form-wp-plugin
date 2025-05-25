<?php
/**
 * Plugin Name:       Alviit Custom Form
 * Description:       A custom form plugin with advanced JS/CSS support.
 * Version:           1.0.0
 * Author:            Md. Sohanur Rohman Sihab
 * Text Domain:       aitcf
 * Domain Path:       /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define( 'ALVIIT_CF_PATH', plugin_dir_path( __FILE__ ) );
define( 'ALVIIT_CF_URL', plugin_dir_url( __FILE__ ) );

// Include TGMPA
require_once plugin_dir_path(__FILE__) . 'includes/class-tgm-plugin-activation.php';
require_once plugin_dir_path(__FILE__) . 'includes/alviit-required-plugins.php';

require_once ALVIIT_CF_PATH.'classes/AlviitMultiStepForm.php';


$instance = new AlviitMultiStepForm();
// Add this instead:
register_activation_hook(__FILE__, function() {
    $instance = new AlviitMultiStepForm();
    $instance->create_alviit_Cf_form_tables();
    $instance->insert_alviit_Cf_household_rooms_data();
    
});

register_deactivation_hook(__FILE__, function() {
    $instance = new AlviitMultiStepForm();
    $instance->drop_alviit_cf_form_tables();
});