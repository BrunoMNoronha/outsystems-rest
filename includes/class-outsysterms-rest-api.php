<?php

if (!defined('ABSPATH')) {
    exit;
}

class Outsystems_Rest_API
{
    public function __construct()
    {
        add_action('wp_ajax_consultar_api', array($this, 'consultar_api'));
        add_action('wp_ajax_nopriv_consultar_api', array($this, 'consultar_api'));
        add_shortcode('formulario_api', array($this, 'form_shortcode'));
    }

    public function consumir_api($param_name, $param_value)
    {
        $url = get_option('outsystems_rest_url');
        $token = get_option('outsystems_rest_token');
        $metodo = get_option('outsystems_rest_metodo');

        $args = array(
            'method' => $metodo,
            'headers' => array(
                'Authorization' => 'Custom ' . $token
            )
        );

        if ($metodo === 'GET') {
            $url = add_query_arg($param_name, urlencode($param_value), $url);
        } else {
            $args['body'] = array($param_name => $param_value);
        }

        $response = wp_remote_request($url, $args);

        if (is_wp_error($response)) {
            return 'Erro: ' . $response->get_error_message();
        }

        $body = wp_remote_retrieve_body($response);
        return json_decode($body);
    }

    public function form_shortcode()
    {
        ob_start();
        include OUTSYSTEMS_REST_PLUGIN_DIR . 'templates/form.php';
        return ob_get_clean();
    }

    public function consultar_api()
    {
        if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'outsystems_rest_nonce')) {
            wp_send_json_error('Falha na verificação do nonce.');
            return;
        }

        $param_name = get_option('outsystems_rest_param', 'texto');
        if (!isset($_POST[$param_name])) {
            wp_send_json_error('Parâmetro "' . $param_name . '" não informado.');
            return;
        }

        $param_value = sanitize_text_field($_POST[$param_name]);
        $dados = $this->consumir_api($param_name, $param_value);

        if (is_string($dados)) {
            wp_send_json_error($dados);
        } else {
            wp_send_json_success($dados);
        }
    }
}
