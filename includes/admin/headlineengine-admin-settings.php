<?php
class HeadlineEngineAdminSettings {
    private $options = [
        "headlineengine_post_types",
        "headlineengine_readability_range_min",
        "headlineengine_readability_range_max",
        "headlineengine_length_range_min",
        "headlineengine_length_range_max",
        "headlineengine_powerwords_min",
        "headlineengine_powerwords_max",
        "headlineengine_powerwords_list",
        "headlineengine_developer_mode"
    ];
    
    public function __construct() {
        add_action('admin_menu', [ $this, 'settings_page' ]);
        add_action('admin_init', [ $this, 'register_settings' ]);
    }

    public function settings_page() {
        add_submenu_page(
            'headlineengine',
			'HeadlineEngine Settings',
			'Settings',
			'manage_options',
			'headlineengine',
			[ $this, 'headlineengine_settings' ]
		);
    }

    public function headlineengine_settings() {
        if (!current_user_can('manage_options')) {
            wp_die(__('You do not have sufficient permissions to access this page.'));
        }
        
        require_once plugin_dir_path( dirname( __FILE__ ) ).'admin/views/settings.php';
    }

    public function register_settings() {
        foreach($this->options as $option) {
            register_setting( 'headlineengine-settings-group', $option );
        }
    }
}