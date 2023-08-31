# Locadora-Carro (Em desenvolvimento)

> Esse projeto foi feito com o intuito de solidificar meus conhecimentos com Laravel, desenvolvendo uma API, onde a mesma é consumido por um front-end desenvolvido em VueJS.

Locadora Carro é um projeto de uma locadora fictícia de automóveis, onde é possível fazer várias ações como gerenciar marcas, modelos, carros, clientes e locações.

> Configurações:

# Instalar dependencias via composer
`composer install`


# Criando .env (Após criar, adicione os parametros do banco)
`cp .env.example .env`

# baixar as versões mais recentes de todos os pacotes, classes e bibliotecas que existem no repositório, recarregar e atualizar o arquivo de autoload
`composer dump-autoload`

# Instalar dependencias front
`npm i`

# Subindo containers docker
`docker compose up -d`

# Identifique o CONTAINER ID da locadora-carro-api-app
`docker ps`

# Abrir um terminal no container em execução
`docker exec -it (CONTAINER ID) bash`


# Executa migrações do Laravel
RUN php artisan migrate

# Gera chave JWT
RUN php artisan jwt:secret

# Cria link para storage
RUN php artisan storage:link

# Executa seeders do banco de dados
RUN php artisan db:seed

# Gerar uma key para api
`php artisan key:generate`

> Projeto sendo melhorado constantimente

- Adicionar filtro de placa no cadastro de carro