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
# Copy override file to customize your local environment
cp compose.override.yml.dist compose.override.yml
# Do not forget to add your COMPOSER_DEPLOY_TOKEN and COMPOSER_DEPLOY_TOKEN_USER
# in compose.override.yml to configure your container to fetch private repositories.
docker compose build
docker compose up -d --force-recreate
```

Then wait for your services to initialize, especially your *database* could take several seconds
to initialize (filesystem, database and user creation).

When you're ready you can check that *Symfony* console responds through your Docker service:

```shell
docker compose exec app bin/console
```

#### Using Docker for development

If you want to ensure that your local environment is as close as possible to your production environment, 
you should use Docker. This skeleton comes with development and production `Dockerfile` configurations. So you will
avoid troubles with installing PHP extensions, Solr, Varnish, Redis, MySQL, etc. You can also use `composer` inside
your app container to install your dependencies.

```shell
# This command will run once APP container to install your dependencies without starting other services
docker compose run --rm --no-deps --entrypoint= app composer install -o
```

To access your app services, you will have to expose ports locally in your `compose.override.yml` file.
Copy `compose.override.yml.dist` to `compose.override.yml` file to override your `compose.yml` file and expose 
your app container ports for local development:

```yaml
# Expose all services default ports for local development
services:
    db:
        ports:
            - ${PUBLIC_DB_PORT}:3306/tcp
    nginx:
        ports:
            - ${PUBLIC_NGINX_PORT}:80/tcp
    mailer:
        ports:
            - ${PUBLIC_MAILER_PORT}:8025/tcp
    varnish:
        ports:
            - ${PUBLIC_VARNISH_PORT}:80/tcp
    redis:
        ports:
            - ${PUBLIC_REDIS_PORT}:6379/tcp
    pma:
        ports:
            - ${PUBLIC_PMA_PORT}:80/tcp
    # If you depend on private Gitlab repositories, you must use a deploy token and username
    #app:
    #    build:
    #        args:
    #            UID: ${UID}
    #            COMPOSER_DEPLOY_TOKEN: xxxxxxxxxxxxx
    #            COMPOSER_DEPLOY_TOKEN_USER: "gitlab+deploy-token-1"
```

### Generate [Symfony secrets](https://symfony.com/doc/current/configuration/secrets.html)

When you run `composer create-project` first time, following command should have been executed automatically:

```shell script
docker compose exec app bin/console secrets:generate-keys
```

Then generate secrets values for your configuration variables such as `APP_SECRET` or `JWT_PASSPHRASE`:

```shell script
docker compose exec app bin/console secrets:set JWT_PASSPHRASE --random
docker compose exec app bin/console secrets:set APP_SECRET --random
```

**Make sure your remove any of these variables from your `.env` and `.env.local` files**, it would override your
secrets (empty values for example), and lose all benefits from encrypting your secrets.

### Generate JWT private and public keys

Use built-in command to generate your key pair (following command should have been executed automatically at `composer create-project`):

```shell
docker compose exec app bin/console lexik:jwt:generate-keypair
```

### Install database

Use `make install` command to install your database schema and fixtures.

Or manually:

```shell
# Create Roadiz database schema
docker compose exec app bin/console doctrine:migrations:migrate
# Migrate any existing data types
docker compose exec app bin/console app:install
# Install base Roadiz fixtures, roles and settings
docker compose exec app bin/console install
# Clear cache
docker compose exec app bin/console cache:clear
```

Before accessing the application, you need to create an admin user. Use the following command to create a user account:
```shell
# Create your admin account with the specified username and email
export EMAIL="username@roadiz.io"
docker compose exec app bin/console users:create -m $EMAIL -b -s $EMAIL
# By default, a random password will be generated for the new user.
# If you want to set a custom password, you can add the -p option followed by your desired password
```

### Manage Node-types

Node-types can be managed through back-office interface or by editing JSON files in `src/Resources/node-types` directory.
If you edit JSON files manually you need to synchronize your database with these files and generate Doctrine Migrations
if this leads to database schema changes.

#### Migrate node-types

When you direct update the `node-types` JSON files, you need to add them into `src/Resources/config.yml` 
and run the following command to update the database:

```bash 
make migrate
```

This command will **update PHP entities** and **create a Doctrine migration** file if necessary.

#### Apply node-type migration

When you pull the project and just want to sync your local node-types, you need to apply the migration:

```bash 
make update
```

This will **only load node-types** that are not already in the database. But it won't create any migration.
This is the same script that is executed when you run `make install` and in your docker image entrypoint.

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

### Conventional commits

This project uses conventional commits to automate the release process and 
*changelog* generation with [git-cliff](https://github.com/orhun/git-cliff).
A `cliff.toml` configuration file is already provided in this skeleton.

#### Generate a CHANGELOG file
```bash
git-cliff -o CHANGELOG.md
```

#### Before releasing

- With a known tag
    ```bash
    git-cliff -o CHANGELOG.md --tag 1.0.0
    ```
- Without knowing tag, let `git-cliff` find the right version
    ```bash
    git-cliff -o CHANGELOG.md --bump
    ```

### Credits

This skeleton uses https://github.com/vishnubob/wait-for-it script to wait for MySQL readiness before launching app entrypoint.
