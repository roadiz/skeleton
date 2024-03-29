# roadiz/skeleton
**Headless API project skeleton built on Roadiz v2+**

![Run test status](https://github.com/roadiz/skeleton/actions/workflows/run-test.yml/badge.svg?branch=develop)

### Install

```shell
COMPOSER_MEMORY_LIMIT=-1 composer create-project roadiz/skeleton my-website
```

Customize configuration by copying `.env` to `.env.local`:

```shell
cp .env .env.local
```

Make sure to tell docker-compose to use `.env.local` if you are changing variables used for
containers initialization (MySQL / Solr / SMTP credentials). Roadiz app will read `.env` then will override vars with your `.env.local`. 
That's why `.env` file is committed in Git repository, and it MUST not contain any secret.

If Composer complains about memory limit issue, just prefix with `COMPOSER_MEMORY_LIMIT=-1`.

Edit your `.env.local` and `docker-compose.yml` files according to your local environment.

```shell
docker compose build
docker compose up -d --force-recreate
```

Then wait for your services to initialize, especially your *database* could take several seconds
to initialize (filesystem, database and user creation).

When you're ready you can check that *Symfony* console responds through your Docker service:

```shell
docker compose exec -u www-data app bin/console
```

### Generate [Symfony secrets](https://symfony.com/doc/current/configuration/secrets.html)

When you run `composer create-project` first time, following command should have been executed automatically:

```shell script
docker compose exec -u www-data app bin/console secrets:generate-keys
```

Then generate secrets values for your configuration variables such as `APP_SECRET` or `JWT_PASSPHRASE`:

```shell script
docker compose exec -u www-data app bin/console secrets:set JWT_PASSPHRASE --random
docker compose exec -u www-data app bin/console secrets:set APP_SECRET --random
```

**Make sure your remove any of these variables from your `.env` and `.env.local` files**, it would override your
secrets (empty values for example), and lose all benefits from encrypting your secrets.

### Generate JWT private and public keys

Use built-in command to generate your key pair (following command should have been executed automatically at `composer create-project`):

```shell
docker compose exec -u www-data app bin/console lexik:jwt:generate-keypair
```

Or manually using `openssl`

```shell script
# Reveal your JWT_PASSPHRASE
docker compose exec -u www-data app bin/console secrets:list --reveal
# Fill JWT_PASSPHRASE env var.
openssl genpkey -out config/jwt/private.pem -aes256 -algorithm rsa -pkeyopt rsa_keygen_bits:4096;
openssl pkey -in config/jwt/private.pem -out config/jwt/public.pem -pubout;
```

### Install database

Use `make install` command to install your database schema and fixtures.

Or manually:

```shell
# Create Roadiz database schema
docker compose exec -u www-data app bin/console doctrine:migrations:migrate
# Migrate any existing data types
docker compose exec -u www-data app bin/console app:install
# Install base Roadiz fixtures, roles and settings
docker compose exec -u www-data app bin/console install
# Clear cache
docker compose exec -u www-data app bin/console cache:clear
# Create your admin account
docker compose exec -u www-data app bin/console users:create -m username@roadiz.io -b -s username
```

### Features

- Configured to be used in headless mode with *API Platform*
- Configured with *lexik/jwt-authentication-bundle*
- All-Docker development and production environments
- Supervisor daemon for execution symfony/messenger consumers
- Solr and Varnish services right out-the-box
- Gitlab CI ready
- Use *phpcs* and *phpstan* to ensure code-smell and static analysis
- Packed with 2 *node-types*: `Menu` and `MenuLink` in order to create automatic menus in your `/api/common_content` response

#### Common content endpoint

`/api/common_content` endpoint is meant to expose common data about your website.
You can fetch this endpoint once in your website frontend, instead of embedding the same data in each web response.
`menus` entry will automatically hold any root-level `Menu` tree-walker.

```json
{
    "@context": "/api/contexts/CommonContent",
    "@id": "/api/common_content?id=unique",
    "@type": "CommonContent",
    "home": {
        "@id": "/api/pages/1",
        "@type": "Page",
        "title": "home",
        "publishedAt": "2021-09-09T02:23:00+02:00",
        "node": {
            "@id": "/api/nodes/1",
            "@type": "Node",
            "nodeName": "home",
            "visible": true,
            "tags": []
        },
        "translation": {
            "@id": "/api/translations/1",
            "@type": "Translation",
            "name": "English",
            "defaultTranslation": true,
            "available": true,
            "locale": "en"
        },
        "slug": "home",
        "url": "/"
    },
    "head": {
        "@type": "NodesSourcesHead",
        "googleAnalytics": null,
        "googleTagManager": null,
        "matomoUrl": null,
        "matomoSiteId": null,
        "siteName": "Roadiz dev website",
        "metaTitle": "Roadiz dev website",
        "metaDescription": "Roadiz dev website",
        "policyUrl": null,
        "mainColor": null,
        "facebookUrl": null,
        "instagramUrl": null,
        "twitterUrl": null,
        "youtubeUrl": null,
        "linkedinUrl": null,
        "homePageUrl": "/",
        "shareImage": null
    },
    "menus": {
        "mainMenuWalker": {
            "@type": "MenuNodeSourceWalker",
            "children": [],
            "item": { ... },
            "childrenCount": 0,
            "level": 0,
            "maxLevel": 3
        }
    }
}
```

### Versioning

Make sure your `.env` file does not contain any sensitive data as it must be added to your repository: `git add --force .env`
in order to be overridden by `.env.local` file.
Sensitive and local data must be filled in `.env.local` which is git-ignored. 

### Using `symfony server:start` instead of Docker

If you are working on a *macOS* environment, you may prefer using `symfony` binary to start a local webserver instead of using
a full _Docker_ stack. You will need to install `symfony` binary first:

```shell
curl -sS https://get.symfony.com/cli/installer | bash
```

And make sure your local PHP environment is configured with php-intl, php-redis, php-gd extensions.
You will need to use at least *MySQL* and *Redis* (and *Solr* if needed) services from Docker stack in order to run your application.

```shell
docker compose -f docker-compose.symfony.yml up -d 
```

- Configure your `.env` variables to use your local MySQL and Redis services. Replacing `db`, `redis`, `mailer` and `solr` hostnames with `127.0.0.1`. Make sure to use `127.0.0.1` and not `localhost` on *macOS* as it will not work with Docker.
- Remove `docker compose exec -u www-data app ` prefix from all commands in `Makefile` to execute recipes locally. 
- Remove cache invalidation Varnish configuration from `config/packages/api_platform.yaml` and `config/packages/roadiz_core.yaml` file.

Then you can start your local webserver:

```shell
symfony server:start
```

Perform all installation steps described above, without using `docker compose exec` command.

Then your Roadiz backoffice will be available at `https://127.0.0.1:8000/rz-admin`

### Make node-types editable on production environment

You may want to set up and deploy your Roadiz v2 application and edit your node-type schema after (without any
Git versioning). You can enable Docker volumes on these 3 directories in order to persist your configuration between
Docker restarts.

- config/api_resources
- src/Resources
- src/GeneratedEntity

Pay attention that you will have to download your node-types JSON files if you want to replicate your setup in 
a local environment.

**We do not recommend this workflow on complex applications** in which you will need to control and version your node-types
schema. This is only recommended for small and basic websites.

### Credits

This skeleton uses https://github.com/vishnubob/wait-for-it script to wait for MySQL readiness before launching app entrypoint.
