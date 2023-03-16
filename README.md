Dentro da pasta raiz do projeto, utilizar os seguintes comandos na ordem

1 - docker-compose build
2 - docker-compose up -d

Com isso o ambiente está montado. Agora vamos utilizar o composer para instalar as dependências

1 - docker exec -it om30_container bash
2 - composer install

Com o ambiente totalmente montado, agora será preciso subir o banco e popular com alguns dado. Continue dentro do container para realizar esses comandos

1 - php artisan migrate
2 - php artisan db:seed

Agora podemos sair do container e acessar o sistema através da url http://localhost:8080/paciente
