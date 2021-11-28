# Simple app based on Lumen PHP Framework

Laravel Lumen is a stunningly fast PHP micro-framework for building web applications with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Lumen attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as routing, database abstraction, queueing, and caching.

## Official Documentation

Documentation for the framework can be found on the [Lumen website](https://lumen.laravel.com/docs).

## App requirements
https://git.ilcd.rocks/alpha-public/php-test/-/blob/main/README.md

## Setting up the project

App requirements description: Install docker and docker-container

### Building up the docker container

git clone https://github.com/janevskaelena/gig_cms_lumen_app.git

cd gig_cms_lumen_app/

docker-compose up --build

### Running up the docker container

docker-compose up

### Stopping the docker container

docker stop

### Run commands inside the container

docker exec -it gig_cms_lumen_app_lumen_1 sh

php artisan migrate

php artisan db:seed

## Example Endpoints

### Get Posts

curl --location --request GET 'http://0.0.0.0:8000/api/posts?post_id=1&with=comments&limit=20&page=1&topic=Kir&sort=topic&direction=desc'

### Get comments

curl --location --request GET 'http://0.0.0.0:8000/api/comments?post_id=1&limit=20&page=1&content=nice&abbreviation=na&sort=abbreviation&direction=desc'

## Delete comment

curl --location --request DELETE 'http://0.0.0.0:8000/api/comments/2' --header 'Authorization: secretToken'

## Delete posts

curl --location --request DELETE 'http://0.0.0.0:8000/api/posts/2' --header 'Authorization: secretToken'

## Crete comment

curl --location --request POST 'http://0.0.0.0:8000/api/comments?post_id=1&content=Alfa Beta Gama Delta' --header 'Authorization: secretToken'



