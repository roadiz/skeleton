printenv | sed 's/^\(.*\)$/export \1/g' | grep -E "^export (IR|SYMFONY|APP|ROADIZ|RZ_|MYSQL|JWT|MAILER|SOLR|VARNISH|DATABASE|LOCK|MESSENGER)" > /var/www/html/project_env.sh

# Fix volume permissions
/bin/chown -R www-data:www-data /var/www/html/var;
/bin/chown -R www-data:www-data /var/www/html/public;
/bin/chown -R www-data:www-data /var/www/html/config;

/bin/chmod +x /var/www/html/project_env.sh;

# Wait for database to be ready.
/bin/sleep 2s;

/usr/bin/sudo -u www-data -- bash -c  "/var/www/html/project_env.sh; /usr/local/bin/composer dump-env prod"
/usr/bin/sudo -u www-data -- bash -c "/var/www/html/project_env.sh; /var/www/html/bin/console cache:clear -n"

# Uncomment following line to enable automatic migration for your theme at each docker start

#/usr/bin/sudo -u www-data -- bash -c "/var/www/html/project_env.sh; /var/www/html/bin/console doctrine:migrations:migrate -q --allow-no-migration"
#
#if [ -e "./src/Resources/config.yml" ]; then
#  /usr/bin/sudo -u www-data -- bash -c "/var/www/html/project_env.sh; /var/www/html/bin/console themes:migrate -n src/Resources/config.yml"
#fi
#
#/usr/bin/sudo -u www-data -- bash -c "/var/www/html/project_env.sh; /var/www/html/bin/console assets:install -n"
#/usr/bin/sudo -u www-data -- bash -c "/var/www/html/project_env.sh; /var/www/html/bin/console themes:assets:install -n Rozier"
