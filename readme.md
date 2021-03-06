# Agenda Telefônica - Private Code Test

## Instalando o projeto:
<p>Acesse o diretório em que deseja baixar o projeto e execute o comando:</p>
<pre><code>git clone https://github.com/nikolastimoteo/private-code-test.git</code></pre>

<p>Acesse o diretório do projeto e crie uma cópia do arquivo <b>.env.example</b> com o nome <b>.env</b> e altere as variáveis de ambiente abaixo, no novo arquivo, para as configurações do seu banco de dados:</p>
<pre><code>DB_CONNECTION=mysql
DB_HOST=
DB_PORT=
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=</code></pre>

<p>Instale as dependências do projeto executando o comando:</p>
<pre><code>composer install</code></pre>

<p>Gere a chave da aplicação executando o comando:</p>
<pre><code>php artisan key:generate</code></pre>

<p>Execute as migrações e <i>seeders</i> do projeto com o comando:</p>
<pre><code>php artisan migrate --seed</code></pre>

<p>Execute o servidor de teste com o comando:</p>
<pre><code>php artisan serve</code></pre>

<p>Acesse http://localhost:8000 e comece a usar o sistema.</p>