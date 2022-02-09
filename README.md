# roadiz/skeleton
**Headless API project skeleton built on Roadiz v2+**

### Install

```shell
COMPOSER_MEMORY_LIMIT=-1 composer create-project roadiz/skeleton my-website dev-main
```

If Composer complains about memory limit issue, just prefix with `COMPOSER_MEMORY_LIMIT=-1`.

Edit your `.env` and `docker-compose.yml` files according to your local environment.

```shell
docker-compose build
docker-compose up -d --force-recreate
```

Then wait for your services to initialize, especially your *database* could take several seconds
to initialize (filesystem, database and user creation).

When you're ready you can check that *Symfony* console responds through your Docker service:

```shell
docker-compose exec -u www-data app bin/console
```

### Generate JWT private and public keys

```shell script
# Generate a strong secret
openssl rand --base64 16; 
# Fill JWT_PASSPHRASE env var.
openssl genpkey -out config/jwt/private.pem -aes256 -algorithm rsa -pkeyopt rsa_keygen_bits:4096;
openssl pkey -in config/jwt/private.pem -out config/jwt/public.pem -pubout;
```

### Install database

```shell
# Create Roadiz database schema
docker-compose exec -u www-data app bin/console doctrine:migrations:migrate
# Migrate any existing data types
docker-compose exec -u www-data app bin/console themes:migrate ./src/Resources/config.yml
# Install base Roadiz fixtures, roles and settings
docker-compose exec -u www-data app bin/console install
# Clear cache
docker-compose exec -u www-data app bin/console cache:clear
# Create your admin account
docker-compose exec -u www-data app bin/console users:create -m username@roadiz.io -b -s username
```

### Features

- Configured to be used in headless mode with *API Platform*
- Configured with *lexik/jwt-authentication-bundle*
- All-Docker development and production environments
- Supervisor daemon for execution symfony/messenger consumers
- Solr and Varnish services right out-the-box
- Gitlab CI ready
- Use *phpcs* and *phpstan* to ensure code-smell and static analysis
