# roadiz/skeleton
**Headless API project skeleton built on Roadiz v2+**

### Install

```shell
composer create-project roadiz/skeleton my-website
```

### Install database and node-types

```shell
dcapp bin/console doctrine:migrations:migrate
dcapp bin/console themes:migrate ./src/Resources/config.yml
dcapp bin/console install
```

### Features

- Configured to be used in headless mode with *API Platform*
- All-Docker development and production environments
- Supervisor daemon for execution symfony/messenger consumers
- Solr and Varnish services right out-the-box
- Gitlab CI ready
- Use *phpcs* and *phpstan* to ensure code-smell and static analysis
