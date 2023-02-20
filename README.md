<h1 align="center">CONFIGURAÇÕES DE PHP, APACHE E MYSQL PARA DOCKER</h1>

<br>
<br>
<br>

<div align="center">

<img width="100" style="background:white; border-radius:30%" src="https://www.iconattitude.com/icons/open_icon_library/apps/png/256/apache.png"/>
<img width="100" src="https://github.com/tandpfun/skill-icons/raw/main/icons/PHP-Dark.svg"/>
<img width="100" src="https://github.com/tandpfun/skill-icons/raw/main/icons/MySQL-Dark.svg"/>
<img width="100" src="https://github.com/tandpfun/skill-icons/raw/main/icons/Docker.svg"/>

</div>

<br>
<br>
<br>

<hr>
<br>

<p align="center">
Esse material contem as configurações básicas para startar um projeto php, apache e mysql usando o docker.
<br>
Autor: Igor Lage
<br>
Data: 19/02/2023
</p>

<br>
<hr>


<br>
<br>

## Índice
<br>

[Requisitos do sistema](#requisitos-do-sistema)<br>
[Clonar e inicializar o projeto](#clonar-e-inicializar-o-projeto)<br>
[Passo a passo para criar o projeto](#passo-a-passo-para-criar-o-projeto)<br>
>[Configurações dos Arquivos Docker](#configurações-dos-arquivos-docker)<br>
>[Inicialize o projeto](#inicialize-o-projeto)<br>
>[Primeiro teste](#primeiro-teste)<br>
>[Teste de conexão com o banco de dados](#teste-de-conexão-com-o-banco-de-dados)

<br>

## Requisitos do sistema
<br>

[WSL](https://learn.microsoft.com/pt-br/windows/wsl/install) - Subsistema linux para windows <br>
[Ubuntu](https://ubuntu.com/wsl)<br>
[VS Code](https://learn.microsoft.com/pt-br/windows/wsl/tutorials/wsl-vscode)<br>
[node.js](https://learn.microsoft.com/en-us/windows/dev-environment/javascript/nodejs-on-wsl) <br>
[npm](https://learn.microsoft.com/en-us/windows/dev-environment/javascript/nodejs-on-wsl#install-nvm-nodejs-and-npm) <br>
[OhMyZshel](https://github.com/ohmyzsh/ohmyzsh/wiki/Installing-ZSH) - opcional<br>
[Docker Engine](https://docs.docker.com/engine/install/ubuntu/)<br>
[Docker Compose](https://docs.docker.com/compose/install/linux/)<br>
[vim](https://www.cyberciti.biz/faq/howto-install-vim-on-ubuntu-linux/)

<br>
<hr>
<br>

## Clonar e inicializar o projeto
<br>
Para clonar o projeto, abra o bash e execute o comando:

```bash
gh repo clone igorRL/docker-php-apache-mysql
```

Acesse o projeto utilizando o link [localhost:8000](http://127.0.0.1:8000).
Uma página contendo as configurações do php e apache serão exibidas.

Acesse o teste de conexão utilizando o link [localhost:8000/teste-conexao.php](http://127.0.0.1:8000/teste-conexao.php).
A mensagem "Connected to MySQL server successfully!" indica que a conexão do php com o banco de dados está configurada e pronta para uso.

Agora, é só criar uma pasta para armazenar seus projetos php na pasta 'html':
```bash
sudo mkdir ./.docker/php/html/projetos && cd ./.docker/php/html/projetos && code .
```
Divirta-se!

<br>
<hr>
<br>

## Passo a passo para criar o projeto
<ul>
<br>
<br>

## Configurações dos Arquivos Docker
<li>Dockerfile</li>

```bash
mkdir .docker && mkdir ./.docker/php && sudo vim ./.docker/php/Dockerfile
```

Copie e cole as instruções:
```bash
FROM php:8.2.3-apache

RUN docker-php-ext-install pdo pdo_mysql mysqli && docker-php-ext-enable mysqli pdo pdo_mysql

RUN apt-get update && apt-get upgrade -y
```

<li>Docker compose</li>

```bash
sudo vim docker-compose.yml
```

Copie e cole as instruções:
```bash
version: '3.8'
services:

  php-apache:
    container_name: php-apache
    build:
      context: ./.docker/php
      dockerfile: Dockerfile
    depends_on:
      - mysql
    restart: always
    ports:
      - 8000:80
    volumes:
      - ./.docker/php/html:/var/www/html/

  mysql:
    container_name: mysql
    image: mysql
    restart: always
    ports:
      - "3306:3306"
    volumes:
      - ./.docker/php/data:/var/lib/mysql
    environment:
      MYSQL_ROOT_PASSWORD: root
      MYSQL_DATABASE: teste

```

<br>
<br>
<br>

## Inicialize o projeto
Para inicializar o projeto execute o comando:
```bash
docker compose up
```

<br>
<br>
<br>

## Primeiro teste
Crie o arquivo de teste
```bash
mkdir .docker/php/html && sudo vim .docker/php/html/index.php
```

Copie e cole o código fonte:
```bash
<?php
phpinfo();
```
Acesse o projeto utilizando o link [localhost:8000](localhost:8000).

Se o resultado for uma página com as informações do php, parabéns, você conseguiu startar o projeto com sucesso!

<br>
<br>
<br>

## Teste de conexão com o banco de dados
Crie o arquivo de teste de conexão:
```bash
sudo vim .docker/php/html/teste-conexao.php
```
Cole o código php:
```bash
<?php
$host = 'mysql';
$user = 'root';
$pass = 'root';
$db = 'tese';

$conn = new mysqli($host, $user, $pass, $db);
if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected to MySQL server successfully!";
$conn->close();

```
Acesse o teste de conexão utilizando o link [localhost:8000/teste-conexao.php](127.0.0.1:8000/teste-conexao.php).<br>

Se a mensagem "Connected to MySQL server successfully!" aparecer na tela, parabéns! Você concluiu a instalação do php, apache e mysql.
</ul>