# Fix volume permissions
/bin/chown -R www-data:www-data /var/www/html/var;
/bin/chown -R www-data:www-data /var/www/html/public;
/bin/chown -R www-data:www-data /var/www/html/config;

# Wait for database to be ready.
/bin/sleep 2s;

# Print local env vars to .env.xxx.php file for performances and crontab jobs
/usr/bin/sudo -u www-data -- bash -c  "/usr/local/bin/composer dump-env prod"
/usr/bin/sudo -u www-data -- bash -c "/var/www/html/bin/console cache:clear -n"

/usr/bin/sudo -u www-data -- bash -c "/var/www/html/bin/console assets:install -n"
/usr/bin/sudo -u www-data -- bash -c "/var/www/html/bin/console themes:assets:install -n Rozier"

# Uncomment following line to enable automatic migration for your theme at each docker start

#/usr/bin/sudo -u www-data -- bash -c "/var/www/html/bin/console doctrine:migrations:migrate -q --allow-no-migration"
#
#if [ -e "./src/Resources/config.yml" ]; then
#  /usr/bin/sudo -u www-data -- bash -c "/var/www/html/bin/console themes:migrate -n src/Resources/config.yml"
#fi
