<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Outsystems_Rest_Admin {
    public function __construct() {
        add_action('admin_menu', array($this, 'add_admin_menu'));
        add_action('admin_init', array($this, 'register_settings'));
    }

    public function add_admin_menu() {
        add_options_page(
            'Outsystems REST Settings',
            'Outsystems REST',
            'manage_options',
            'outsystems-rest',
            array($this, 'settings_page')
        );
    }

    public function register_settings() {
        register_setting('outsystems_rest_options_group', 'outsystems_rest_url');
        register_setting('outsystems_rest_options_group', 'outsystems_rest_metodo');
        register_setting('outsystems_rest_options_group', 'outsystems_rest_token');
        register_setting('outsystems_rest_options_group', 'outsystems_rest_param');

        add_settings_section(
            'outsystems_rest_section',
            'API Settings',
            null,
            'outsystems-rest'
        );

        add_settings_field(
            'outsystems_rest_url',
            'API URL',
            array($this, 'url_callback'),
            'outsystems-rest',
            'outsystems_rest_section'
        );

        add_settings_field(
            'outsystems_rest_metodo',
            'HTTP Method',
            array($this, 'metodo_callback'),
            'outsystems-rest',
            'outsystems_rest_section'
        );

        add_settings_field(
            'outsystems_rest_token',
            'API Token',
            array($this, 'token_callback'),
            'outsystems-rest',
            'outsystems_rest_section'
        );

        add_settings_field(
            'outsystems_rest_param',
            'Nome do Parâmetro',
            array($this, 'param_callback'),
            'outsystems-rest',
            'outsystems_rest_section'
        );
    }

    public function url_callback() {
        $url = get_option('outsystems_rest_url');
        echo "<input type='text' name='outsystems_rest_url' value='" . esc_attr($url) . "' />";
    }

    public function metodo_callback() {
        $metodo = get_option('outsystems_rest_metodo');
        echo "<input type='text' name='outsystems_rest_metodo' value='" . esc_attr($metodo) . "' />";
    }

    public function token_callback() {
        $token = get_option('outsystems_rest_token');
        echo "<input type='text' name='outsystems_rest_token' value='" . esc_attr($token) . "' />";
    }

    public function param_callback() {
        $param = get_option('outsystems_rest_param');
        echo "<input type='text' name='outsystems_rest_param' value='" . esc_attr($param) . "' />";
    }

    public function settings_page() {
        ?>
        <div class="wrap">
            <h1>Outsystems REST Settings</h1>
            <form method="post" action="options.php">
                <?php
                settings_fields('outsystems_rest_options_group');
                do_settings_sections('outsystems-rest');
                submit_button();
                ?>
            </form>
        </div>
        <?php
    }
}
