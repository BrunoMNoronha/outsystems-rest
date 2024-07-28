<?php
$param_name = get_option('outsystems_rest_param', 'texto');
?>
<form id="api-form" class="outsystems-rest-form">
    <label for="<?php echo esc_attr($param_name); ?>"><?php echo esc_html($param_name); ?>:</label>
    <input type="text" id="<?php echo esc_attr($param_name); ?>" name="<?php echo esc_attr($param_name); ?>" required>
    <button type="submit" class="wp-element-button wp-block-button__link">Enviar</button>
    <div id="loading" class="spinner" style="display:none;">Loading...</div>
</form>
<div id="api-result"></div>
<script>
    document.getElementById('api-form').addEventListener('submit', function(e) {
        e.preventDefault();
        document.getElementById('loading').style.display = 'block';
        var paramName = '<?php echo esc_js($param_name); ?>';
        var paramValue = document.getElementById(paramName).value;
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4) {
                document.getElementById('loading').style.display = 'none';
                if (this.status == 200) {
                    var response = JSON.parse(this.responseText);
                    var resultDiv = document.getElementById('api-result');
                    resultDiv.innerHTML = '';
                    if (response.success) {
                        var data = response.data;
                        if (Array.isArray(data)) {
                            data.forEach(function(item) {
                                var itemDiv = document.createElement('div');
                                for (var key in item) {
                                    if (item.hasOwnProperty(key)) {
                                        var p = document.createElement('p');
                                        p.textContent = key + ': ' + item[key];
                                        itemDiv.appendChild(p);
                                    }
                                }
                                resultDiv.appendChild(itemDiv);
                            });
                        } else if (typeof data === 'object') {
                            var itemDiv = document.createElement('div');
                            for (var key in data) {
                                if (data.hasOwnProperty(key)) {
                                    var p = document.createElement('p');
                                    p.textContent = key + ': ' + data[key];
                                    itemDiv.appendChild(p);
                                }
                            }
                            resultDiv.appendChild(itemDiv);
                        } else {
                            resultDiv.innerHTML = 'Resposta inesperada.';
                        }
                    } else {
                        resultDiv.innerHTML = 'Erro: ' + response.data;
                    }
                } else {
                    document.getElementById('api-result').innerHTML = 'Erro ao enviar a solicitação.';
                }
            }
        };
        xhttp.open("GET", "<?php echo esc_url(admin_url('admin-ajax.php')); ?>?action=consultar_api&" + paramName + "=" + encodeURIComponent(paramValue), true);
        xhttp.send();
    });
</script>
