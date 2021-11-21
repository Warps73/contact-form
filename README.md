## Contact form

### Setup

> I assume that you have symfony cli and docker installed on your system

`composer install`

`docker-compose up -d`

`symfony console doctrine:databas:create`

`symfony console doctrine:migrations:migrate`

`symfony console doctrine:fixtures:load --no-interaction`

`symfony server:start -d`

Go to http://127.0.0.1:8000

### Admin

Go to /admin

login: admin@company.com

password: admin

### Test

> I assume that you have Make installed on your system

To run test

`make fixtures_test`
`php bin/phpunit`




