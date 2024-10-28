cache:
	docker compose exec -u www-data app php bin/console cache:clear
	docker compose exec -u www-data app php bin/console cache:pool:clear cache.global_clearer
	# Stop workers to force restart them (Supervisord)
	docker compose exec -u www-data app php bin/console messenger:stop-workers

test:
	docker compose exec -u www-data app php -d "memory_limit=-1" vendor/bin/php-cs-fixer fix --ansi -vvv
	docker compose exec -u www-data app php -d "memory_limit=-1" vendor/bin/phpstan analyse -c phpstan.neon
	XDEBUG_MODE=coverage php -d "memory_limit=-1" vendor/bin/phpunit

update:
	docker compose exec -u www-data app php bin/console doctrine:migrations:migrate -n
	# Do not perform files changes just apply existing migrations and import data
	docker compose exec -u www-data app php bin/console app:install -n
	make cache;

migrate:
	docker compose exec -u www-data app php bin/console doctrine:migrations:migrate -n
	# Apply files changes and create new Doctrine migrations if necessary
	docker compose exec -u www-data app php bin/console app:migrate
	# Stop workers to force restart them (Supervisord)
	docker compose exec -u www-data app php bin/console messenger:stop-workers

install:
	docker compose exec -u www-data app php bin/console doctrine:migrations:migrate -n
	# Do not perform files changes on the database
	docker compose exec -u www-data app php bin/console app:install -n
	docker compose exec -u www-data app bin/console install;
	make cache;

changelog:
	git-cliff -o CHANGELOG.md

bump:
	git-cliff --bump -o CHANGELOG.md

##
## Start the development environment using Symfony server and Docker
##
dev:
	docker compose -f docker-compose.symfony.yml up -d
	symfony serve -d

stop:
	symfony server:stop
	docker compose -f docker-compose.symfony.yml down
