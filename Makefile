fixtures_test:
	symfony console doctrine:database:drop --if-exists --force --env=test
	symfony console doctrine:database:create --env=test
	symfony console doctrine:migrations:migrate --no-interaction --env=test
	symfony console doctrine:fixtures:load --no-interaction --env=test
