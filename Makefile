cache:
	docker compose exec app php bin/console cache:clear
	docker compose exec app php bin/console cache:pool:clear cache.global_clearer
	# Stop workers to force restart them (Supervisord)
	docker compose exec app php bin/console messenger:stop-workers

test:
	docker compose run --rm --no-deps app php -d "memory_limit=-1" bin/console nodetypes:validate-files
	docker compose run --rm --no-deps app php -d "memory_limit=-1" vendor/bin/rector process --dry-run
	docker compose run --rm --no-deps -e PHP_CS_FIXER_IGNORE_ENV=1 app php -d "memory_limit=-1" vendor/bin/php-cs-fixer fix --ansi -vvv
	docker compose run --rm --no-deps app php -d "memory_limit=-1" vendor/bin/phpstan analyse
	docker compose run --rm --no-deps -e XDEBUG_MODE=coverage app php -d "memory_limit=-1" vendor/bin/phpunit

rector:
	docker compose run --rm --no-deps app php -d "memory_limit=-1" vendor/bin/rector process
	docker compose run --rm --no-deps -e PHP_CS_FIXER_IGNORE_ENV=1 app php -d "memory_limit=-1" vendor/bin/php-cs-fixer fix --ansi -vvv

update:
	docker compose run --rm app composer install -o
	docker compose exec app php bin/console doctrine:migrations:migrate -n
	# Do not perform files changes just apply existing migrations and import data
	docker compose exec app php bin/console app:install -n
	make cache;

update_deps:
	docker compose run --rm app composer update -o

migrate:
	docker compose exec app php bin/console doctrine:migrations:migrate -n
	# Apply files changes and create new Doctrine migrations if necessary
	docker compose exec app php bin/console app:migrate
	# Stop workers to force restart them (Supervisord)
	docker compose exec app php bin/console messenger:stop-workers

install:
	docker compose run --rm app composer install -o
	docker compose up -d
	docker compose exec app php bin/console doctrine:migrations:migrate -n
	# Do not perform files changes on the database
	docker compose exec app php bin/console app:install -n
	docker compose exec app bin/console install;
	make cache;

changelog:
	git cliff -o CHANGELOG.md

bump:
	git cliff --bump -o CHANGELOG.md
