# roadiz/skeleton
**Headless API project skeleton built on Roadiz v2+**

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

### Generate [Symfony secrets](https://symfony.com/doc/current/configuration/secrets.html)

Make sure your defined a named volume for `/var/www/html/config/secrets` directory

```shell script
docker-compose exec -u www-data app bin/console secrets:generate-keys
```

Then generate secrets values for your configuration variables such as `APP_RECAPTCHA_PRIVATE_KEY` or `JWT_PASSPHRASE`:

```shell script
docker-compose exec -u www-data app bin/console secrets:set APP_RECAPTCHA_PRIVATE_KEY
```

**Make sure your remove any of these variables from your `.env` and `.env.local` files**, it would override your
secrets (empty values for example), and lose all benefits from encrypting your secrets.

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

### Credits

This skeleton uses https://github.com/vishnubob/wait-for-it script to wait for MySQL readiness before launching app entrypoint.
