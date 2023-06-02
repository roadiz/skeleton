cache :
	docker-compose exec -u www-data app php bin/console cache:clear
	docker-compose exec -u www-data app bin/console cache:pool:clear cache.global_clearer
	# Stop workers to force restart them (Supervisord)
	docker-compose exec -u www-data app php bin/console messenger:stop-workers

test:
	docker-compose exec -u www-data app php -d "memory_limit=-1" vendor/bin/phpcbf --report=full --report-file=./report.txt -p ./src
	docker-compose exec -u www-data app php -d "memory_limit=-1" vendor/bin/phpstan analyse -c phpstan.neon

migrate:
	docker-compose exec -u www-data app php bin/console doctrine:migrations:migrate
	docker-compose exec -u www-data app php bin/console themes:migrate ./src/Resources/config.yml
	# Stop workers to force restart them (Supervisord)
	docker-compose exec -u www-data app php bin/console messenger:stop-workers

install:
	make migrate;
	docker-compose exec -u www-data app bin/console install;
	make cache;
