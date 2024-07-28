<?php
/*
Plugin Name: outsystems-rest
Description: Plugin para consumir uma API com autenticação customizada.
Version: 1.5
Author: Bruno Menezes Noronha
Text Domain: outsystems-rest
Domain Path: /languages
Requires at least: 5.0
Requires PHP: 7.0
*/

// Evita o acesso direto ao arquivo.
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Define constantes do plugin.
define('OUTSYSTEMS_REST_VERSION', '1.5');
define('OUTSYSTEMS_REST_PLUGIN_DIR', plugin_dir_path(__FILE__));

// Inclui as classes necessárias.
require_once OUTSYSTEMS_REST_PLUGIN_DIR . 'includes/class-outsysterms-rest-api.php';
require_once OUTSYSTEMS_REST_PLUGIN_DIR . 'includes/class-outsysterms-rest-admin.php';

// Função de ativação do plugin.
function outsystems_rest_ativar()
{
    add_option('outsystems_rest_url', '');
    add_option('outsystems_rest_metodo', 'GET');
    add_option('outsystems_rest_token', '');
    add_option('outsystems_rest_param', 'texto');
}
register_activation_hook(__FILE__, 'outsystems_rest_ativar');

// Função de desativação do plugin.
function outsystems_rest_desativar()
{
    delete_option('outsystems_rest_url');
    delete_option('outsystems_rest_metodo');
    delete_option('outsystems_rest_token');
    delete_option('outsystems_rest_param');
}
register_deactivation_hook(__FILE__, 'outsystems_rest_desativar');

// Carrega o arquivo de tradução.
function outsystems_rest_load_textdomain()
{
    load_plugin_textdomain('outsystems-rest', false, dirname(plugin_basename(__FILE__)) . '/languages');
}
add_action('plugins_loaded', 'outsystems_rest_load_textdomain');

// Enfileira estilos e scripts.
function outsystems_rest_enqueue_scripts()
{
    wp_enqueue_style('outsystems-rest-style', plugins_url('assets/css/style.css', __FILE__));
    wp_enqueue_script('outsystems-rest-script', plugins_url('assets/js/script.js', __FILE__), array('jquery'), null, true);
    wp_localize_script('outsystems-rest-script', 'outsystemsRest', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('outsystems_rest_nonce')
    )
    );
}
add_action('wp_enqueue_scripts', 'outsystems_rest_enqueue_scripts');

// Adiciona link para a página de configuração.
function outsystems_rest_settings_link($links)
{
    $settings_link = '<a href="options-general.php?page=outsystems-rest">' . __('Configurações') . '</a>';
    array_unshift($links, $settings_link);
    return $links;
}
add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'outsystems_rest_settings_link');

// Inicializa a classe de administração.
new Outsystems_Rest_Admin();

// Inicializa a classe da API.
new Outsystems_Rest_API();
