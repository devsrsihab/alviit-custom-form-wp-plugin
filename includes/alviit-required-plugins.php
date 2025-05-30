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
 * @version    2.6.0
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
require_once dirname( __FILE__ ) . '/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'alviit_register_required_plugins' );


function alviit_register_required_plugins() {
	
	// plugins
   $plugins = [
        [
            'name'     => esc_html__( 'Translate WordPress with GTranslate', 'aitcf' ),
            'slug'     => 'gtranslate',
            'required' => true,
        ],

    ];

	// config
	$config = array(
        'id'           => 'aitcf',
        'default_path' => '',
        'menu'         => 'tgmpa-install-plugins',
        'parent_slug'  => 'plugins.php', // Changed from themes.php to plugins.php
        'capability'   => 'manage_options', // Changed to appropriate capability
        'has_notices'  => true,
        'dismissable'  => false,
        'dismiss_msg'  => '',
        'is_automatic' => false,
        'message'      => '',
        'strings'      => [
            'page_title'                      => esc_html__( 'Install Required Plugins', 'aitcf' ),
            'menu_title'                      => esc_html__( 'Install Plugins', 'aitcf' ),
            'installing'                      => esc_html__( 'Installing Plugin: %s', 'aitcf' ),
            'updating'                        => esc_html__( 'Updating Plugin: %s', 'aitcf' ),
            'oops'                            => esc_html__( 'Something went wrong with the plugin API.', 'aitcf' ),
            'notice_can_install_required'     => _n_noop(
                'This plugin requires the following plugin: %1$s.',
                'This plugin requires the following plugins: %1$s.',
                'aitcf'
            ),
            'notice_can_install_recommended'  => _n_noop(
                'This plugin recommends the following plugin: %1$s.',
                'This plugin recommends the following plugins: %1$s.',
                'aitcf'
            ),
            'notice_ask_to_update'            => _n_noop(
                'The following plugin needs to be updated to its latest version: %1$s.',
                'The following plugins need to be updated to their latest versions: %1$s.',
                'aitcf'
            ),
            'notice_ask_to_update_maybe'      => _n_noop(
                'There is an update available for: %1$s.',
                'There are updates available for the following plugins: %1$s.',
                'aitcf'
            ),
            'notice_can_activate_required'    => _n_noop(
                'The following required plugin is currently inactive: %1$s.',
                'The following required plugins are currently inactive: %1$s.',
                'aitcf'
            ),
            'notice_can_activate_recommended' => _n_noop(
                'The following recommended plugin is currently inactive: %1$s.',
                'The following recommended plugins are currently inactive: %1$s.',
                'aitcf'
            ),
            'install_link'                    => _n_noop(
                'Begin installing plugin',
                'Begin installing plugins',
                'aitcf'
            ),
            'update_link'                     => _n_noop(
                'Begin updating plugin',
                'Begin updating plugins',
                'aitcf'
            ),
            'activate_link'                   => _n_noop(
                'Begin activating plugin',
                'Begin activating plugins',
                'aitcf'
            ),
            'return'                          => esc_html__( 'Return to Plugin Installer', 'aitcf' ),
            'plugin_activated'                => esc_html__( 'Plugin activated successfully.', 'aitcf' ),
            'activated_successfully'          => esc_html__( 'The following plugin was activated successfully:', 'aitcf' ),
            'plugin_already_active'           => esc_html__( 'No action taken. Plugin %1$s was already active.', 'aitcf' ),
            'plugin_needs_higher_version'     => esc_html__( 'Plugin not activated. A higher version of %s is needed. Please update the plugin.', 'aitcf' ),
            'complete'                        => esc_html__( 'All plugins installed and activated successfully. %1$s', 'aitcf' ),
            'dismiss'                         => esc_html__( 'Dismiss this notice', 'aitcf' ),
            'notice_cannot_install_activate'  => esc_html__( 'There are required or recommended plugins to install, update or activate.', 'aitcf' ),
            'contact_admin'                   => esc_html__( 'Please contact the site administrator for assistance.', 'aitcf' ),
            'nag_type'                        => '',
        ],
		
	);

	tgmpa( $plugins, $config );
}
