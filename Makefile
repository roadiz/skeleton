cache :
	php bin/console cache:clear

test:
	php -d "memory_limit=-1" vendor/bin/phpcbf --report=full --report-file=./report.txt -p ./src
	php -d "memory_limit=-1" vendor/bin/phpstan analyse -c phpstan.neon
