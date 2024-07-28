# outsystems-rest

O plugin `outsystems-rest` permite consumir uma API com autenticação personalizada. Este plugin é altamente configurável através do painel administrativo do WordPress, permitindo definir a URL da API, o método HTTP, o token de autenticação, e o nome do parâmetro.

## Descrição

O plugin `outsystems-rest` permite consumir uma API com autenticação personalizada. Este plugin é altamente configurável através do painel administrativo do WordPress, permitindo definir a URL da API, o método HTTP, o token de autenticação, e o nome do parâmetro.

## Instalação

1. **Faça o Download do Plugin:**
   - Baixe o plugin `outsystems-rest.zip` e extraia-o.

2. **Carregue o Plugin:**
   - Faça o upload da pasta `outsystems-rest` para o diretório `/wp-content/plugins/` no seu servidor.

3. **Ative o Plugin:**
   - Acesse o painel administrativo do WordPress.
   - Vá até "Plugins" e ative o plugin `outsystems-rest`.

4. **Configuração Inicial:**
   - Vá até "Configurações" > "Outsystems REST" para configurar o plugin.
   - Defina a URL da API, o método HTTP, o token de autenticação e o nome do parâmetro.

## Como Usar

1. **Adicionar o Shortcode:**
   - Adicione o shortcode `[formulario_api]` em qualquer página ou post onde você deseja exibir o formulário de consumo da API.

2. **Configuração do Formulário:**
   - O formulário incluirá automaticamente um nonce de segurança e enviará a requisição para a URL configurada com o parâmetro definido.

## Features

- **Configuração Administrativa:**
  - Defina a URL da API, método HTTP, token de autenticação, e nome do parâmetro através do painel administrativo.

- **Proteção com Nonce:**
  - Integração com o nonce do WordPress para proteção contra solicitações CSRF.

- **Consumo de API com Autenticação Customizada:**
  - Suporte para métodos HTTP GET e POST com autenticação customizada.

- **Personalização do Parâmetro:**
  - Permite configurar o nome do parâmetro que será enviado na requisição.

## Requisitos

- **Versão mínima do WordPress:** 5.0
- **Versão mínima do PHP:** 7.0

## Exemplo de Uso

1. **Adicionar Shortcode em uma Página:**
   - Crie ou edite uma página/post no WordPress.
   - Adicione o shortcode `[formulario_api]` no conteúdo da página/post.

2. **Configuração do Plugin:**
   - Acesse "Configurações" > "Outsystems REST".
   - Configure os campos:
     - **API URL:** A URL da API que será consumida.
     - **HTTP Method:** O método HTTP a ser usado (GET ou POST).
     - **API Token:** O token de autenticação personalizado.
     - **Nome do Parâmetro:** O nome do parâmetro que será enviado na requisição.

3. **Enviar Formulário:**
   - O visitante preenche o formulário e clica em "Enviar".
   - O plugin envia a requisição para a API configurada e exibe a resposta no mesmo local.

## Conclusão

Este plugin permite que você consuma uma API com autenticação customizada, com configurações flexíveis diretamente no painel administrativo do WordPress. A integração com nonce do WordPress garante a segurança contra solicitações CSRF.
