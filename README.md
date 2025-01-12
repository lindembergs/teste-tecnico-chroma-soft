# teste-tecnico-chroma-soft: Projeto Usuários

Este é um projeto simples de cadastro de usuários com funcionalidades de criar, atualizar e excluir usuários, utilizando PHP , MySQL E JS.
Após fazer donlowad do arquivo e descompactar siga esses passos ->

## Passos para Rodar o Projeto

### 1. **Criação do Banco MySQL**

Para começar, crie o banco de dados e a tabela no MySQL:

1. Abra o MySQL na ferramenta de sua preferência.
2. Execute o seguinte comando para criar o banco de dados:

   ```sql
   create database users;
   ```

3. Crie a tabela `usuarios` com o seguinte comando:

   ```sql
   CREATE TABLE usuarios (
       id INT AUTO_INCREMENT PRIMARY KEY,
       nome VARCHAR(100) NOT NULL,
       email VARCHAR(100) NOT NULL UNIQUE,
       senha VARCHAR(200) NOT NULL
   );
   ```

### 2. **Instalar o XAMPP na Sua Máquina**

Certifique-se de que o XAMPP está instalado em sua máquina. Para isso:

1. **Baixe o XAMPP** (se ainda não tiver) em: [https://www.apachefriends.org/](https://www.apachefriends.org/).
2. **Inicie o XAMPP**.
3. Clique em "Start" no Apache e no MySQL para rodar o servidor web e o banco de dados localmente.

### 3. **Colocar a Pasta do Projeto no Diretório do XAMPP**

Coloque a pasta do seu projeto no diretório do XAMPP para que ele seja acessível via navegador:

1. Copie ou mova a pasta do seu projeto para o seguinte diretório:

   ```
   C:/xampp/htdocs
   ```

### 4. **Pesquisar no Navegador**

Abra o navegador e acesse o seguinte endereço:

```
http://localhost
```

### 5. **Abrir a Pasta do Projeto**

Agora você pode acessar a pasta do projeto no navegador e rodar as funcionalidades do sistema. Para isso, vá até:

```
http://localhost/teste_tecnico_chromasoft
```

Siga esses passos e o projeto deverá funcionar corretamente no seu ambiente local.

### 6. **Caso ocorra erro**

1. Retorne o connect.php para o padrão:

```php
 define('HOST', 'localhost'); // descomente esta linha
define('HOST', 'localhost:3307'); // comente esta linha ou selecione a mesma porta configurada no mySQL do xampp
```

2. Se estiver usando o phpMyAdmin, ajuste a porta no arquivo de configuração:

```
xampp/phpMyAdmin/config.inc.php
```

```php
$cfg['Servers'][$i]['port'] = '3307'; // selecione a mesma porta configurada no mySQL do xampp
```
