# Fix volume permissions
/bin/chown -R www-data:www-data /var/www/html/var;
/bin/chown -R www-data:www-data /var/www/html/public;
/bin/chown -R www-data:www-data /var/www/html/config;

# Print local env vars to .env.xxx.php file for performances and crontab jobs
/usr/bin/sudo -u www-data -- bash -c  "/usr/local/bin/composer dump-env prod"
/usr/bin/sudo -u www-data -- bash -c "/var/www/html/bin/console cache:clear -n"
/usr/bin/sudo -u www-data -- bash -c "/var/www/html/bin/console assets:install -n"
/usr/bin/sudo -u www-data -- bash -c "/var/www/html/bin/console themes:assets:install -n Rozier"

# To improve performance (i.e. avoid decrypting secrets at runtime),
# you can decrypt your secrets during deployment to the "local" vault:
#/usr/bin/sudo -u www-data -- bash -c "APP_RUNTIME_ENV=prod /var/www/html/bin/console secrets:decrypt-to-local --force"

##
## Uncomment following lines to generate node-types found in database
## This disallow automatic node-type update from Docker image, and local database
## has priority over committed changes
##
#/usr/bin/sudo -u www-data -- bash -c "/var/www/html/bin/console generate:nsentities"
#/usr/bin/sudo -u www-data -- bash -c "/var/www/html/bin/console generate:api-resources"

##
## Uncomment following lines to enable automatic migration for your theme at each docker start
##
#if [ -e "./src/Resources/config.yml" ]; then
#  # Perform migrations directly as database should be ready thanks to wait-for-it.sh
#  /usr/bin/sudo -u www-data -- bash -c "/var/www/html/bin/console themes:migrate -n src/Resources/config.yml"
#fi
