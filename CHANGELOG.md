# Changelog

All notable changes to project will be documented in this file.

## [2.6.3](https://github.com/roadiz/skeleton/compare/v2.6.2...v2.6.3) - 2025-08-11

### Bug Fixes

- update Docker Compose restarting procedure in CI configuration - ([9ecc100](https://github.com/roadiz/skeleton/commit/9ecc100f393b6d82ea776d06a123dbd9424a2f40)) - Ambroise Maupate

## [2.6.2](https://github.com/roadiz/skeleton/compare/v2.6.1...v2.6.2) - 2025-08-07

### Bug Fixes

- do not declare a messenger transport for scheduler_default - ([164ff13](https://github.com/roadiz/skeleton/commit/164ff137139e0b12da9f37cbc9d0545fa95ca33e)) - Ambroise Maupate

## [2.6.1](https://github.com/roadiz/skeleton/compare/v2.6.0...v2.6.1) - 2025-08-06

### Bug Fixes

- Missing `--entrypoint=` for run commands - ([798a931](https://github.com/roadiz/skeleton/commit/798a931d57f24c7ac731d61c4ef9b3d663a22165)) - Ambroise Maupate

## [2.6.0](https://github.com/roadiz/skeleton/compare/v2.5.12...v2.6.0) - 2025-08-06

### Features

- Add Docker configuration for FrankenPHP with development and production setups - ([6d8fb6b](https://github.com/roadiz/skeleton/commit/6d8fb6bdd5fdbf3923b2f7722431759be1d5bb14)) - Ambroise Maupate
- Update Symfony dependencies and configuration for version 7.3 - ([1435d46](https://github.com/roadiz/skeleton/commit/1435d461a718af3dd01daaf5ae2ef04b9c37e890)) - Ambroise Maupate
- Update configuration for Doctrine and Messenger components - ([bdc4913](https://github.com/roadiz/skeleton/commit/bdc49132cff86732df0d7f1ce3a84aef1cea32ed)) - Ambroise Maupate
- update Docker configuration to replace cron with scheduler and adjust entrypoints - ([a1e8b40](https://github.com/roadiz/skeleton/commit/a1e8b40468c23efc6fd389e437df9781ac5145b7)) - Ambroise Maupate
- add timestamps for sitemap lastmod and update translation resource for sitemap generation - ([7d4ad3b](https://github.com/roadiz/skeleton/commit/7d4ad3b2264d56ea029e638d907caa3e4ecc4254)) - Ambroise Maupate
- enhance security headers in nginx configuration - ([186bbda](https://github.com/roadiz/skeleton/commit/186bbda8e0c3c12cb995ac514aa2354dfd721da5)) - Ambroise Maupate
- update PHP version requirement to 8.3 and adjust roadiz/cms-pack version to ^3.0 in composer files - ([bc20361](https://github.com/roadiz/skeleton/commit/bc20361f0d234e38d860e1745772ebb71d06e544)) - Ambroise Maupate
- Update PHP version requirement to 8.3 and add Rector configuration - ([aff893e](https://github.com/roadiz/skeleton/commit/aff893e3ba79410d196c1a01a9a87792fd807549)) - Ambroise Maupate
- Add MAILER_ENVELOP_SENDER and update DEFAULT_ADMIN_NOTIFIER_RECIPIENT - ([4e4058e](https://github.com/roadiz/skeleton/commit/4e4058e80a160ff2410eef8b9503cea91978f1bf)) - Ambroise Maupate
- Add AliasBlock entity and related definitions for tree walker and custom normalizer - ([b6a2276](https://github.com/roadiz/skeleton/commit/b6a2276c862e97d00ce0947be6289684bf71c7ca)) - Ambroise Maupate

### Refactor

- Clean up role definitions and remove unused roles in configuration files - ([a629798](https://github.com/roadiz/skeleton/commit/a629798471b6a4c067a7d2a40734f4338843babd)) - Ambroise Maupate
- Simplify translation retrieval and enhance home page logic in GetCommonContentController - ([577a92f](https://github.com/roadiz/skeleton/commit/577a92fd184667a9ca157c2edfac4bf84627e955)) - Ambroise Maupate
- Update PHP version requirements, clean up Dockerfile, and migrate configuration settings - ([af469db](https://github.com/roadiz/skeleton/commit/af469dbe2818aa25998087e958650a5db09e73d5)) - Ambroise Maupate
- Rename reCAPTCHA keys to generic captcha keys and update configuration - ([ed92baa](https://github.com/roadiz/skeleton/commit/ed92baa6b8f9c0de81ab2f099f23cfe2fb0cf2cf)) - Ambroise Maupate
- Rename openapiContext to openapi in API configuration files - ([52927b1](https://github.com/roadiz/skeleton/commit/52927b192f0d5f264b8d5daaaf1abd4eb1389527)) - Ambroise Maupate
- Update normalize methods to align on symfony 7.3 signatures - ([baa5dd9](https://github.com/roadiz/skeleton/commit/baa5dd912b19b344717623b5e6e7cf1262065f5c)) - Ambroise Maupate
- update switch_user role (to default `ROLE_ALLOWED_TO_SWITCH`) and remove unnecessary access roles in security configuration - ([fc87609](https://github.com/roadiz/skeleton/commit/fc876099ac917c7733c575ac8716393267f7233d)) - Ambroise Maupate
- add Solr bundle suggestion in composer.json and remove SOLR_VERSION from Dockerfile - ([f486834](https://github.com/roadiz/skeleton/commit/f4868340af3c78ae28b06a5e9adc5f8f16a54c1d)) - Ambroise Maupate
- Improve prod and dev docker compose stacks - ([dc363ff](https://github.com/roadiz/skeleton/commit/dc363ff95ae09198f1c610bc3446a736a6ff26cc)) - Ambroise Maupate
- Remove Solr configuration and related dependencies ([#9](https://github.com/roadiz/skeleton/issues/9)) - ([0d0694d](https://github.com/roadiz/skeleton/commit/0d0694d0f9a9935457919b4f57b7f257a46681f3)) - Eliot

### Bug Fixes

- Correct condition to check publication status of aliased block in AliasBlockWalkerNormalizer - ([5072ca6](https://github.com/roadiz/skeleton/commit/5072ca6202c5a31669a7b5b71b2f2e7e9d970e1f)) - Ambroise Maupate
- Refactor AliasBlockWalkerNormalizer to use decorated normalizers and add preview support - ([90c805b](https://github.com/roadiz/skeleton/commit/90c805b65e9431305bc33941635390740b618f35)) - Ambroise Maupate
- Update of compose.prod.yml to be in line with docker-bake.hcl ([#7](https://github.com/roadiz/skeleton/issues/7)) - ([e35847c](https://github.com/roadiz/skeleton/commit/e35847c092f34681dd660fcda2bb2b840d400ba9)) - Eliot
- Add memory limit -1 in worker service ([#8](https://github.com/roadiz/skeleton/issues/8)) - ([c835335](https://github.com/roadiz/skeleton/commit/c8353354aefca90482624e6a4305a620a6516bc2)) - Eliot

## [2.5.12](https://github.com/roadiz/skeleton/compare/v2.5.11...v2.5.12) - 2025-06-26

### Bug Fixes

- Correct condition to check publication status of aliased block in AliasBlockWalkerNormalizer - ([5072ca6](https://github.com/roadiz/skeleton/commit/5072ca6202c5a31669a7b5b71b2f2e7e9d970e1f)) - Ambroise Maupate

## [2.5.11](https://github.com/roadiz/skeleton/compare/v2.5.10...v2.5.11) - 2025-06-26

### Bug Fixes

- Refactor AliasBlockWalkerNormalizer to use decorated normalizers and add preview support - ([90c805b](https://github.com/roadiz/skeleton/commit/90c805b65e9431305bc33941635390740b618f35)) - Ambroise Maupate

## [2.5.10](https://github.com/roadiz/skeleton/compare/v2.5.9...v2.5.10) - 2025-06-26

### Features

- Add AliasBlock entity and related definitions for tree walker and custom normalizer - ([b6a2276](https://github.com/roadiz/skeleton/commit/b6a2276c862e97d00ce0947be6289684bf71c7ca)) - Ambroise Maupate

## [2.5.9](https://github.com/roadiz/skeleton/compare/v2.5.8...v2.5.9) - 2025-06-24

### Bug Fixes

- Add return before Symfony String import - ([6f2cd6c](https://github.com/roadiz/skeleton/commit/6f2cd6c4c88ee8dc082eb86fb02a658ebc2d9e1c)) - eliot lauger

## [2.5.8](https://github.com/roadiz/skeleton/compare/v2.5.7...v2.5.8) - 2025-06-24

### Refactor

- Use camel case for URL keys in GetCommonContentController - ([686bf08](https://github.com/roadiz/skeleton/commit/686bf0898ccebaa118b5fb771dedab6dee187288)) - eliot lauger

## [2.5.7](https://github.com/roadiz/skeleton/compare/v2.5.6...v2.5.7) - 2025-06-16

### Bug Fixes

- Missing `TRUSTED_PROXIES` env variable in `symfony/framework-bundle` section - ([3e93e7b](https://github.com/roadiz/skeleton/commit/3e93e7ba169bab8efb07aee23303164af43355f5)) - Ambroise Maupate

## [2.5.6](https://github.com/roadiz/skeleton/compare/v2.5.5...v2.5.6) - 2025-06-12

### Bug Fixes

- Upgrade to PHP 8.4.8 - MYSQL 8.0.42 - NGINX 1.27.5 - MariaDB 11.4.7 - Varnish 7.6.3 - Composer 2.8.9 - ([7007ee4](https://github.com/roadiz/skeleton/commit/7007ee45d6333be293c8bf94a3ce0df7d522ad69)) - eliot lauger

## [2.5.5](https://github.com/roadiz/skeleton/compare/v2.5.4...v2.5.5) - 2025-06-06

### Bug Fixes

- Add JWT keypair generation to Docker entrypoints - ([44705da](https://github.com/roadiz/skeleton/commit/44705dad3373f1d9d56adb3b7ce28f53b65eb99d)) - eliot lauger

## [2.5.4](https://github.com/roadiz/skeleton/compare/v2.5.3...v2.5.4) - 2025-06-05

### Bug Fixes

- Update cache configuration and clean up unused API operations - ([f2ef8ce](https://github.com/roadiz/skeleton/commit/f2ef8ceff0ffc27353d8116a7f8518a05b77b8d5)) - Ambroise Maupate

### Documentation

- Enhance OpenAPI context for menus, footers, URLs, and colors in CommonContent - ([a41a57a](https://github.com/roadiz/skeleton/commit/a41a57ad643eb682c37d721c4a826e78bbdb88bf)) - Ambroise Maupate

### Features

- Add URLs and colors settings to common content resource - ([e85e808](https://github.com/roadiz/skeleton/commit/e85e8084731e1ea2f161131b93a23c54b17ead8e)) - Ambroise Maupate

## [2.5.3](https://github.com/roadiz/skeleton/compare/v2.5.2...v2.5.3) - 2025-05-13

### Bug Fixes

- More loose version constraint on rezozero/intervention-request-bundle - ([270ba64](https://github.com/roadiz/skeleton/commit/270ba64095b6003b6e0c69d5d0374c2d7c77770d)) - Ambroise Maupate

## [2.5.2](https://github.com/roadiz/skeleton/compare/v2.5.1...v2.5.2) - 2025-05-13

### Bug Fixes

- Add memory limit -1 in worker service ([#8](https://github.com/roadiz/skeleton/issues/8)) - ([c835335](https://github.com/roadiz/skeleton/commit/c8353354aefca90482624e6a4305a620a6516bc2)) - Eliot
- Upgraded rezozero/intervention-request-bundle to 4.1 - ([2b58b74](https://github.com/roadiz/skeleton/commit/2b58b7450d1970e56843028f8412dcf4076a1a6d)) - Ambroise Maupate

## [2.5.1](https://github.com/roadiz/skeleton/compare/v2.5.0...v2.5.1) - 2025-04-08

### Bug Fixes

- Update of compose.prod.yml to be in line with docker-bake.hcl ([#7](https://github.com/roadiz/skeleton/issues/7)) - ([e35847c](https://github.com/roadiz/skeleton/commit/e35847c092f34681dd660fcda2bb2b840d400ba9)) - Eliot
- Missing `PHP_CS_FIXER_IGNORE_ENV` and `nodetypes:validate-files` command - ([2a42940](https://github.com/roadiz/skeleton/commit/2a4294027e388a4dc6afa19c0c1a85eaaf92e789)) - Ambroise Maupate

## [2.5.0](https://github.com/roadiz/skeleton/compare/v2.4.14...v2.5.0) - 2025-03-11

### CI/CD

- Use new `roadiz/php-runner:8.4.4-bookworm` test image - ([5cbe853](https://github.com/roadiz/skeleton/commit/5cbe853efe20537a0d394337d6c58717b8290b1b)) - Ambroise Maupate

### Features

- Added NSErrorPage tree-walker into CommonContent - ([b05ac1b](https://github.com/roadiz/skeleton/commit/b05ac1bf441c3ae74fd63350d50c21246a6d5be9)) - Ambroise Maupate

## [2.4.14](https://github.com/roadiz/skeleton/compare/v2.4.13...v2.4.14) - 2025-02-11

### Bug Fixes

- Fixed Wrong Varnish size unit - ([e2b5985](https://github.com/roadiz/skeleton/commit/e2b5985b7e2f0e6ddf6cbc24eb1ff8c408b77ebf)) - Ambroise Maupate

## [2.4.13](https://github.com/roadiz/skeleton/compare/v2.4.12...v2.4.13) - 2025-02-10

### Bug Fixes

- Fixed MariaDb configuration header name - ([b65edc9](https://github.com/roadiz/skeleton/commit/b65edc968f95c951f028a50ce2ff82f44ca70eb1)) - Ambroise Maupate

## [2.4.12](https://github.com/roadiz/skeleton/compare/v2.4.11...v2.4.12) - 2025-02-10

### Bug Fixes

- Fixed MariaDB configuration location - ([8d145d8](https://github.com/roadiz/skeleton/commit/8d145d8347c1570048583484f694b31a67c653d8)) - Ambroise Maupate

### Features

- Added new starter Page node-type and re-generated node-source classes - ([bda3342](https://github.com/roadiz/skeleton/commit/bda33424a57a64c406db1b7471a46f87f396f24d)) - Ambroise Maupate
- Upgraded to PHP 8.4 - ([2c74725](https://github.com/roadiz/skeleton/commit/2c74725507af570918c38f4734fb74fdfaf7b231)) - Ambroise Maupate

## [2.4.11](https://github.com/roadiz/skeleton/compare/v2.4.10...v2.4.11) - 2025-02-08

### Bug Fixes

- Upgraded Varnish version and add optimization on query-string (sorting) - ([f0aa8b1](https://github.com/roadiz/skeleton/commit/f0aa8b19ff3063503f002ed655ac747e08c6bf04)) - Ambroise Maupate

### Features

- Migrated node-type JSON to YAML - ([1ac2fd7](https://github.com/roadiz/skeleton/commit/1ac2fd781578a3d74880318a6b8befdc3b40e2ee)) - Ambroise Maupate
- Add test node type files in pipeline and github action - ([41950b4](https://github.com/roadiz/skeleton/commit/41950b41d8e13cedc81a7cfba3b37d16e231e474)) - eliot lauger

## [2.4.10](https://github.com/roadiz/skeleton/compare/v2.4.9...v2.4.10) - 2025-01-24

### Features

- Added new docker-migrate-entrypoint to only migrate database and app fixture, added DEPLOY_TAG for docker images - ([e634b07](https://github.com/roadiz/skeleton/commit/e634b0798add87fbc15caece2e5a4f32618998b8)) - Ambroise Maupate

## [2.4.9](https://github.com/roadiz/skeleton/compare/v2.4.8...v2.4.9) - 2025-01-21

### Bug Fixes

- Fixed solr:reindex issues on crontab by clearing cache at startup - ([1d5b368](https://github.com/roadiz/skeleton/commit/1d5b368168deec50193a2f910275aa09e192b4b0)) - Ambroise Maupate

## [2.4.8](https://github.com/roadiz/skeleton/compare/v2.4.7...v2.4.8) - 2025-01-14

### Bug Fixes

- Enable solr by default and added "roadiz/solr" tags to easily find configuration locations - ([0b8c3f1](https://github.com/roadiz/skeleton/commit/0b8c3f162f9cad45ee9a07e4de4588b966ed04fa)) - Ambroise Maupate

## [2.4.7](https://github.com/roadiz/skeleton/compare/v2.4.6...v2.4.7) - 2025-01-13

### Bug Fixes

- Cleanup dotenv file to split between docker/env vars and Symfony - ([61916a1](https://github.com/roadiz/skeleton/commit/61916a1c96c5b5e4a422ed275fe44d88c6a612c1)) - Ambroise Maupate
- Use regular file name for phpstan flex recipe - ([2291f97](https://github.com/roadiz/skeleton/commit/2291f97c613582d077af8897def4a7c44be15df7)) - Ambroise Maupate

### Documentation

- Better `users:create` command example - ([98b13d2](https://github.com/roadiz/skeleton/commit/98b13d288e5fa9abf4968040cc7d65d81448bb58)) - Ambroise Maupate

## [2.4.6](https://github.com/roadiz/skeleton/compare/v2.4.5...v2.4.6) - 2025-01-10

### Bug Fixes

- Use MariaDB 11.4.4 - ([072771e](https://github.com/roadiz/skeleton/commit/072771ef2f75127a65ab786e4e2f61fa0231e44e)) - Ambroise Maupate

## [2.4.5](https://github.com/roadiz/skeleton/compare/v2.4.4...v2.4.5) - 2025-01-06

### Bug Fixes

- Prevent `phpstan/phpdoc-parser` to bump to v2 (composer.json) - ([d0b8484](https://github.com/roadiz/skeleton/commit/d0b84840975dc0b67decab07e5dcf435776d2a40)) - Ambroise Maupate

## [2.4.4](https://github.com/roadiz/skeleton/compare/v2.4.3...v2.4.4) - 2025-01-06

### Bug Fixes

- Prevent `phpstan/phpdoc-parser` to bump to v2 because of https://github.com/api-platform/core/discussions/6793 - ([e8ccb7b](https://github.com/roadiz/skeleton/commit/e8ccb7bf232db89abf509ef4c0ebee2ceef7b179)) - Ambroise Maupate

## [2.4.3](https://github.com/roadiz/skeleton/compare/v2.4.2...v2.4.3) - 2024-12-16

### Bug Fixes

- Use `HostRegexp` and `PathRegexp` for Traefik v3 compatibility - ([b924d22](https://github.com/roadiz/skeleton/commit/b924d22ccc1b95412972a6c1ba58d056eedfa04f)) - Ambroise Maupate

## [2.4.2](https://github.com/roadiz/skeleton/compare/v2.4.1...v2.4.2) - 2024-12-11

### Bug Fixes

- Make develop jobs interruptible - ([6c1f555](https://github.com/roadiz/skeleton/commit/6c1f55569e46017038fa252f60e874c5af914621)) - Ambroise Maupate

## [2.4.1](https://github.com/roadiz/skeleton/compare/v2.4.0...v2.4.1) - 2024-12-11

### Documentation

- Added Gitlab CI example how to deploy docker compose to distant SSH servers - ([d0ee7b3](https://github.com/roadiz/skeleton/commit/d0ee7b3ffdc65748ae6a74672d45fd0b08946c97)) - Ambroise Maupate

## [2.4.0](https://github.com/roadiz/skeleton/compare/v2.3.9...v2.4.0) - 2024-12-06

### ⚠ Breaking changes

- Base PHP image is now `php:8.3.13-fpm-bookworm`

### Bug Fixes

- Enable login-link feature - ([45b947a](https://github.com/roadiz/skeleton/commit/45b947affe23e254f2f935ea9d133e398f3159ce)) - Ambroise Maupate
- Removed `themes` from Dockerfile, removed ContactFormController in favor of Custom-forms - ([79f5167](https://github.com/roadiz/skeleton/commit/79f51679990c14ec27a152012792d6d5b7de1b47)) - Ambroise Maupate
- Use DEV cron entrypoint to prevent dumping production .env during development - ([b927159](https://github.com/roadiz/skeleton/commit/b9271593018c8de9c1647209bc2eab2903083376)) - Ambroise Maupate
- Update Github Action - ([85fdd82](https://github.com/roadiz/skeleton/commit/85fdd8298cf5a5198af1f61d8ccd68dc35938e68)) - Ambroise Maupate
- Do not use SSH keys volumes to share credentials between host and container, use `COMPOSER_DEPLOY_TOKEN` - ([4d01411](https://github.com/roadiz/skeleton/commit/4d01411b82475e7434cb37f4c8dc9d1a2db73e31)) - Ambroise Maupate

### CI/CD

- Set default docker user to `www-data` for docker images - ([45658ff](https://github.com/roadiz/skeleton/commit/45658ff21dc53ed637fcce0cf8ae9d45a39a5ca0)) - Ambroise Maupate
- Removed Composer private key, use a deploy token instead for private packages - ([18bbe92](https://github.com/roadiz/skeleton/commit/18bbe92329aa831c639b3f56d82a22d9baeaae38)) - Ambroise Maupate
- Added ParallelConfigFactory to PhpCsFixer - ([8018801](https://github.com/roadiz/skeleton/commit/801880193767fa2efd9869164a834cede7cea1c1)) - Ambroise Maupate
- Upgraded docker compose dev environment - ([dcbf346](https://github.com/roadiz/skeleton/commit/dcbf3463c7324cbd883d6ae9fd9ef1773d95f219)) - Ambroise Maupate
- Unnecessary job prefix, allow tests on merge_requests - ([de69c2c](https://github.com/roadiz/skeleton/commit/de69c2c8e9cede23982781be506010f23e176d07)) - Ambroise Maupate

### Documentation

- Improve README.md - ([fcd081c](https://github.com/roadiz/skeleton/commit/fcd081c54cfedf6b2a13c1083eecaf937f695f12)) - Ambroise Maupate
- Add suggestion about create first admin user with command line ([#6](https://github.com/roadiz/skeleton/issues/6)) - ([5e50725](https://github.com/roadiz/skeleton/commit/5e50725e9d89194cb1732873a9f9bc0357851489)) - Eliot

### Features

- Prevent cron docker entrypoint to run as non-root user - ([2dc6c62](https://github.com/roadiz/skeleton/commit/2dc6c6248a6ef72f0a557c3727ad8286ce8d0fed)) - Ambroise Maupate
- Replace `squizlabs/php_codesniffer` package with  `friendsofphp/php-cs-fixer` - ([a369090](https://github.com/roadiz/skeleton/commit/a36909011b085eb91aa6a0579a14859edbd9d234)) - Ambroise Maupate
-  [**breaking**]Migrate Dockerfile to multi-stage build and get rid of `roadiz/php83-fpm-alpine` base image - ([d2f3899](https://github.com/roadiz/skeleton/commit/d2f3899d10e2fc5df5e341354a387e8129f26789)) - Ambroise Maupate
- Use Docker Buildx Bake - ([f9f0fe9](https://github.com/roadiz/skeleton/commit/f9f0fe9a42af3d598e8cd5475570f7cd5a5f3eb9)) - Ambroise Maupate
- Use Docker Buildx Bake with COMPOSER_DEPLOY_TOKEN - ([ba8ef7c](https://github.com/roadiz/skeleton/commit/ba8ef7c944e0c9c6154faeecc02759535a25e3b1)) - Ambroise Maupate
- Upgraded sentry/sentry-symfony to ^5.1 - ([82ce87e](https://github.com/roadiz/skeleton/commit/82ce87e61fa21e5ceda8fee3be0381b30f2fbb5c)) - Ambroise Maupate
- Use dedicated images for php and nginx, aligned workdirs ([#4](https://github.com/roadiz/skeleton/issues/4)) - ([464b4ac](https://github.com/roadiz/skeleton/commit/464b4ac5c77247c22a77d847d9d1e3eead3309d9)) - Ambroise Maupate
- Use mariadb by default - ([3d9a3ee](https://github.com/roadiz/skeleton/commit/3d9a3ee8d80013b1f4144002ce787cfd27be717e)) - Ambroise Maupate

### Refactor

- Remove sensio_framework_extra - ([7c4b921](https://github.com/roadiz/skeleton/commit/7c4b921565fc52aadce661c863b10b3f70ac3c90)) - eliot lauger

## [2.3.9](https://github.com/roadiz/skeleton/compare/v2.3.8...v2.3.9) - 2024-08-01

### Bug Fixes

- Removed useless `themes` folder - ([f06198c](https://github.com/roadiz/skeleton/commit/f06198ce0b7584b8b7294cb42662a73b9fe9b7c0)) - Ambroise Maupate

### Features

- Config updates for api-platform 3.3 - ([3baf2d0](https://github.com/roadiz/skeleton/commit/3baf2d0308dd4d6de461267c8a86ec61d3225163)) - Ambroise Maupate

## [2.3.8](https://github.com/roadiz/skeleton/compare/v2.3.7...v2.3.8) - 2024-06-26

### Bug Fixes

- DotEnv var name - ([2a0e4f1](https://github.com/roadiz/skeleton/commit/2a0e4f1d0b7c703346e63dc7136697a4fd529ad4)) - Ambroise Maupate

## [2.3.7](https://github.com/roadiz/skeleton/compare/v2.3.6...v2.3.7) - 2024-06-11

### Bug Fixes

- Fix root folder permissions, do not chown twice during Dockerfile build - ([fe8a101](https://github.com/roadiz/skeleton/commit/fe8a10189d5b361800990bb765103a2f6c59c5ed)) - Ambroise Maupate

## [2.3.6](https://github.com/roadiz/skeleton/compare/v2.3.5...v2.3.6) - 2024-06-08

### Bug Fixes

- Improved Sentry integration - ([0f07a87](https://github.com/roadiz/skeleton/commit/0f07a875cb2c68d1c20c290e64eb36f87afde31b)) - Ambroise Maupate

## [2.3.5](https://github.com/roadiz/skeleton/compare/v2.3.4...v2.3.5) - 2024-05-31

### Features

- Use Redis for session storage in production - ([b7932d3](https://github.com/roadiz/skeleton/commit/b7932d3021d1a2509f7330da47342ff19c77e3f9)) - Ambroise Maupate

## [2.3.4](https://github.com/roadiz/skeleton/compare/v2.3.3...v2.3.4) - 2024-05-29

### Features

- **(Sentry)** Added more options to expose environment - ([1009bdc](https://github.com/roadiz/skeleton/commit/1009bdc84fcb1d07f9f9f6705752737d12b1a581)) - Ambroise Maupate

## [2.3.3](https://github.com/roadiz/skeleton/compare/v2.3.2...v2.3.3) - 2024-05-28

### Features

- Allow exposing `Cache-Tags` header when Varnish serve API and Nuxt responses - ([0833570](https://github.com/roadiz/skeleton/commit/083357092318e9b08ba400a5270457d563655f10)) - Ambroise Maupate

## [2.3.1](https://github.com/roadiz/skeleton/compare/v2.3.0...v2.3.1) - 2024-05-16

### Bug Fixes

- Upgraded docker entry point script to preserve environment - ([422ba47](https://github.com/roadiz/skeleton/commit/422ba4766200adc16675173637754bbbae5e93b5)) - Ambroise Maupate
- Missing redis-messenger package at composer create-project. Missing JWT_PASSPHRASE default value. - ([c27aebc](https://github.com/roadiz/skeleton/commit/c27aebc8d60ef5df21e5ba0fdc16b8a520d7a1bb)) - Ambroise Maupate

## [2.3.0](https://github.com/roadiz/skeleton/compare/v2.2.1...v2.3.0) - 2024-05-15

### Bug Fixes

- Fixed docker compose specification with `extends` and `depends_on` - ([aefde96](https://github.com/roadiz/skeleton/commit/aefde96f3660dc6d54c16a4e0073a97c087c4bdf)) - Ambroise Maupate
- Fixed monolog log level on prod - ([095cccc](https://github.com/roadiz/skeleton/commit/095cccca56e105bdbf40339391776e63e4cd8391)) - Ambroise Maupate
- Attribute class ApiPlatform\Core\Annotation\ApiProperty does not exist. - ([970ba38](https://github.com/roadiz/skeleton/commit/970ba381ea4df3179decd74b1ccfb42c4790d557)) - Ambroise Maupate
- Do not migrate app on make install - ([3c1024b](https://github.com/roadiz/skeleton/commit/3c1024b008491b1a86e0add6327b6b4a9a44698e)) - Ambroise Maupate
- Prefix all api_resource config file with `resources` - ([981b3ef](https://github.com/roadiz/skeleton/commit/981b3efd74784da97574df7a8cc8b266423bd537)) - Ambroise Maupate
- Improved docker cron entrypoint - ([185aefd](https://github.com/roadiz/skeleton/commit/185aefd733eb95624c7ebe3730694e49b92bee9c)) - Ambroise Maupate

### CI/CD

- Removed php 8.1 from version matrix - ([3341faa](https://github.com/roadiz/skeleton/commit/3341faa38d6dae06332e9710bd1943af666c009f)) - Ambroise Maupate
- Added php-unit configuration for Gitlab CI - ([0e5e3c9](https://github.com/roadiz/skeleton/commit/0e5e3c9ae82630bb7ae209d913fbc0ac24de64b6)) - Ambroise Maupate
- Removed /var/www/html/var/secret volume - ([6fd4063](https://github.com/roadiz/skeleton/commit/6fd4063a90e3c0b5b95bd3cea48f9a66c9467c89)) - Ambroise Maupate

### Documentation

- Improved README and added new Makefile recipe - ([bc721ea](https://github.com/roadiz/skeleton/commit/bc721ea2e3b5429f7a1f3697e07623614b3a6776)) - Ambroise Maupate
- Added dev and stop Make recipes - ([1d7f233](https://github.com/roadiz/skeleton/commit/1d7f23350a38ed39dcc4b649c40ece5a83b6d962)) - Ambroise Maupate

### Features

- Use a dedicated docker entrypoint for docker cron image - ([067d9fd](https://github.com/roadiz/skeleton/commit/067d9fd0fc464a1d3f59eb5a6286fc031a99eb99)) - Ambroise Maupate
- Switch to roadiz dev 2.3.x - ([1ee942d](https://github.com/roadiz/skeleton/commit/1ee942dd10505d726be1b4b1291b5abb4fe47882)) - Ambroise Maupate
- Added Footers and error page to common content - ([edc2550](https://github.com/roadiz/skeleton/commit/edc2550cbdd311058285480cff87db4894485a6a)) - Ambroise Maupate
- Allow sub Menu - ([0be1cde](https://github.com/roadiz/skeleton/commit/0be1cdeadae888cea647356818344d3cee86bad0)) - Ambroise Maupate
- Added git-cliff configuration template - ([2d514a8](https://github.com/roadiz/skeleton/commit/2d514a84c5c92b3d50d961579d090bbcba671a53)) - Ambroise Maupate
- Added git-cliff configuration template - ([bd0f2e8](https://github.com/roadiz/skeleton/commit/bd0f2e840dbd416a1be927af8ae881cc118dbb6d)) - Ambroise Maupate
- Upgrade to ApiPlatform 3.2 - ([4455344](https://github.com/roadiz/skeleton/commit/44553441627473572043d78e12a24f2fc264018f)) - Ambroise Maupate
- Added *LiipMonitorBundle* for health-checking API docker container - ([59fcb39](https://github.com/roadiz/skeleton/commit/59fcb39f85e39e10eb2653ee027c194117801cef)) - Ambroise Maupate
- Added simple `HEALTHCHECK` command for docker containers - ([997bd4e](https://github.com/roadiz/skeleton/commit/997bd4e172e96ac13504173213e80b9c0a909823)) - Ambroise Maupate
- Upgraded example node-types entities - ([5377feb](https://github.com/roadiz/skeleton/commit/5377feb1d7b37bd3ed8b28e98560195f55f24e5a)) - Ambroise Maupate

### Refactor

- Changed MenuLinkPathNormalizer.php method signature - ([d51461e](https://github.com/roadiz/skeleton/commit/d51461e89a184ffbb885e4aa59ab2e9b1efef6e3)) - Ambroise Maupate

## [2.2.1](https://github.com/roadiz/skeleton/compare/v2.2.0...v2.2.1) - 2023-12-12

### Bug Fixes

- Updated Github action version matrix - ([2ea26ef](https://github.com/roadiz/skeleton/commit/2ea26efda32ac04a52b0afbaa2409b89ab2bb464)) - Ambroise Maupate

## [2.2.0](https://github.com/roadiz/skeleton/compare/v2.1.15...v2.2.0) - 2023-12-12

### Bug Fixes

- **(Docker)** Clear caches after migrations and db ready - ([91c6220](https://github.com/roadiz/skeleton/commit/91c62209a44ac4a6fc092e4cd1ffe57cf9e70a1d)) - Ambroise Maupate
- Configure API firewall as database-less JWT by default to ensure PreviewUser are not reloaded. Missing `user_checker` - ([23d64e4](https://github.com/roadiz/skeleton/commit/23d64e49b613286f1a7b1818c8fbbea5db336dfa)) - Ambroise Maupate
- Fix docker compose watchtower depends-on labels - ([f5afbd3](https://github.com/roadiz/skeleton/commit/f5afbd38294523b7d9ca4a6faa7ae87af49be54b)) - Ambroise Maupate
- Removed deprecated `lexik_jwt_authentication.jwt_token_authenticator` - ([42850a0](https://github.com/roadiz/skeleton/commit/42850a0cfe79628557c1454b65c75e2d4c78e57b)) - Ambroise Maupate

### Features

- **(Solr)** Better Solr managed schema for French fields asciifolding - ([141186c](https://github.com/roadiz/skeleton/commit/141186cd0743233e4283ebc5be0b7fd611846232)) - Ambroise Maupate
- **(Solr)** Added *_ps field type for multiple geolocations - ([2c9f5e3](https://github.com/roadiz/skeleton/commit/2c9f5e36c6f0e81a05130c83f94d5872bc99478e)) - Ambroise Maupate
- Added Restic services for production backup and restoration in development env - ([fc28b13](https://github.com/roadiz/skeleton/commit/fc28b134f03e7bebeaec778ef673d8755f889daf)) - Ambroise Maupate
- Added `APP_ROUTER_DEFAULT_URI` to configure framework.router.default_uri - ([67ef138](https://github.com/roadiz/skeleton/commit/67ef1389069144257f43cc2df59da799a58902c7)) - Ambroise Maupate
- Switched to php 82 - ([8824e7e](https://github.com/roadiz/skeleton/commit/8824e7e9f21338c86ec6b47328fa808f03bc8835)) - Ambroise Maupate
- Requires php 8.1 minimum - ([424783d](https://github.com/roadiz/skeleton/commit/424783d01f95fa3c80536f372ccbc9e67a150217)) - Ambroise Maupate

## [2.1.15](https://github.com/roadiz/skeleton/compare/v2.1.14...v2.1.15) - 2023-09-20

### Bug Fixes

- **(CI)** Build and tag at the same time to avoid push same docker image digest from different jobs - ([6a96982](https://github.com/roadiz/skeleton/commit/6a96982957e029c9fb19f771ae8a32b88b685798)) - Ambroise Maupate
- Set default empty dotenv vars for OpenID and ignore large files and archives from Varnish cache - ([94f3975](https://github.com/roadiz/skeleton/commit/94f3975ccdfdf5369acf1cbae7ea7a013ab5196b)) - Ambroise Maupate
- Use VARNISH_HOST instead of URL for reverseProxyCache host param - ([5af0965](https://github.com/roadiz/skeleton/commit/5af0965020325714737c11b23c7b95c52b8fc63f)) - Ambroise Maupate

### Documentation

- More config hints - ([1c0504d](https://github.com/roadiz/skeleton/commit/1c0504d18bfb45b34d27102d2115f3b31677ce7d)) - Ambroise Maupate

### Features

- Updated docker-php-entrypoint to perform db migrations first then app:install - ([4b2079a](https://github.com/roadiz/skeleton/commit/4b2079a5dbad0f17f3f91be822d5a02be663b6f4)) - Ambroise Maupate

## [2.1.14](https://github.com/roadiz/skeleton/compare/v2.1.13...v2.1.14) - 2023-07-28

### Bug Fixes

- Added AutoDevops templates for Gitlab CI/CD - ([769495d](https://github.com/roadiz/skeleton/commit/769495dd8460fd66c8844a04c56be5fd9e259d69)) - Ambroise Maupate

### Features

- Do not use `themes:install` and `themes:migrate` command anymore as Roadiz will generate Doctrine migration at node-type changes - ([09b1714](https://github.com/roadiz/skeleton/commit/09b171417d68349c0a77b0d05dd2318c73627af6)) - Ambroise Maupate
- Do not expose WebResponse resource directly - ([a972b80](https://github.com/roadiz/skeleton/commit/a972b80a02e9e65e37f1fbc36d5f20c1c333a14c)) - Ambroise Maupate
- Updated README and Makefile for new `app:migrate` command, disabled default Varnish invalidation - ([b34cf42](https://github.com/roadiz/skeleton/commit/b34cf42f8b03879bc3152653d8819d63e3e72ca9)) - Ambroise Maupate

## [2.1.13](https://github.com/roadiz/skeleton/compare/v2.1.12...v2.1.13) - 2023-07-25

### Bug Fixes

- Wrong args order for docker compose with custom config file - ([f00addf](https://github.com/roadiz/skeleton/commit/f00addff020f3b9b583db854b29d556429dec43e)) - Ambroise Maupate

## [2.1.12](https://github.com/roadiz/skeleton/compare/v2.1.11...v2.1.12) - 2023-07-25

### Features

- Added some doc about using symfony server:start instead of full docker stack - ([b7ed89e](https://github.com/roadiz/skeleton/commit/b7ed89e1fd3bef5ce7bdb49b97e978037595d65d)) - Ambroise Maupate

## [2.1.11](https://github.com/roadiz/skeleton/compare/v2.1.10...v2.1.11) - 2023-07-25

### Bug Fixes

- Added missing Makefile entries, README and API platform `metadata_backward_compatibility_layer` - ([3346d79](https://github.com/roadiz/skeleton/commit/3346d794a60e3e94978a13d3f56d5bf28927f07b)) - Ambroise Maupate
- Run secrets command after composer install - ([4ef7f4c](https://github.com/roadiz/skeleton/commit/4ef7f4c6a855fac2e604c208fe212f91c8912470)) - Ambroise Maupate

### Features

- Upgraded configuration for Roadiz 2.2 - ([8ef0d3f](https://github.com/roadiz/skeleton/commit/8ef0d3f18a74f78dd99df94c2d029ee5b1cd0a4b)) - Ambroise Maupate

## [2.1.10](https://github.com/roadiz/skeleton/compare/v2.1.9...v2.1.10) - 2023-07-12

### Bug Fixes

- Missing gedmo_loggable doctrine mapping for Superclasses - ([ce63709](https://github.com/roadiz/skeleton/commit/ce63709c317b795ab3ee1e31ade0b8b4f3383ffd)) - Ambroise Maupate

## [2.1.9](https://github.com/roadiz/skeleton/compare/v2.1.8...v2.1.9) - 2023-06-27

### Bug Fixes

- Fixed `com.centurylinklabs.watchtower.depends-on` syntax - ([fc484c4](https://github.com/roadiz/skeleton/commit/fc484c43e08a1301922d614469e0046730cd9862)) - Ambroise Maupate

## [2.1.8](https://github.com/roadiz/skeleton/compare/v2.1.7...v2.1.8) - 2023-06-12

### Bug Fixes

- Rename Gitlab CI dropped vars - ([809af31](https://github.com/roadiz/skeleton/commit/809af3128ae18bce471a7140c3603facf1111ab5)) - Ambroise Maupate

## [2.1.7](https://github.com/roadiz/skeleton/compare/v2.1.6...v2.1.7) - 2023-06-01

### Bug Fixes

- Clear all cache pools on Symfony 5.4 on docker-entrypoint - ([03b93a8](https://github.com/roadiz/skeleton/commit/03b93a895e8dca451e8d261c43dca498fe8264a6)) - Ambroise Maupate

## [2.1.6](https://github.com/roadiz/skeleton/compare/v2.1.5...v2.1.6) - 2023-05-31

### Bug Fixes

- Missing serialization group on custom_form operations - ([41d57cc](https://github.com/roadiz/skeleton/commit/41d57cc57ead98c56981c26418570adc5c6b131b)) - Ambroise Maupate

## [2.1.5](https://github.com/roadiz/skeleton/compare/v2.1.4...v2.1.5) - 2023-05-31

### CI/CD

- Added `symfony/requirements-checker` and composer install --no-dev during CI build - ([3585c15](https://github.com/roadiz/skeleton/commit/3585c15a2f133d2ae2a4d7085e234a3a5d3ab44d)) - Ambroise Maupate

## [2.1.4](https://github.com/roadiz/skeleton/compare/v2.1.3...v2.1.4) - 2023-05-17

### Bug Fixes

- Force watchtower to restart dependent containers - ([a2b0357](https://github.com/roadiz/skeleton/commit/a2b0357f1ff1a8c6032b5e77b5b6d5f77c0c449e)) - Ambroise Maupate
- Mixed up public and private file volumes for backup - ([8d954ac](https://github.com/roadiz/skeleton/commit/8d954acb885bda28fd071c7db3b747bf57ac9af3)) - Ambroise Maupate

## [2.1.3](https://github.com/roadiz/skeleton/compare/v2.1.2...v2.1.3) - 2023-03-20

### Bug Fixes

- Fixed GetCommonContentController using NodesSourcesHeadFactoryInterface and type-hinting Request - ([33b637a](https://github.com/roadiz/skeleton/commit/33b637aea034111199b4edc00ceec788ff5b659c)) - Ambroise Maupate
- Missing docker/php-fpm-alpine/wait-for-it.sh in Dockerfile COPY - ([54785fe](https://github.com/roadiz/skeleton/commit/54785fef5fd0847a85c1746e51669563999b5363)) - Ambroise Maupate
- Varnish ACL should allow cron and worker hostname to purge - ([b1a69e4](https://github.com/roadiz/skeleton/commit/b1a69e4d367330bd4b86a606de3da835f00ba69e)) - Ambroise Maupate

### CI/CD

- Improve Docker compose templates - ([6ae85ee](https://github.com/roadiz/skeleton/commit/6ae85ee0e748905a7d8160886d5d3c493ac05732)) - Ambroise Maupate

### Features

- Migrate from monolithic docker image to app, nginx, worker and cron containers. - ([2a88497](https://github.com/roadiz/skeleton/commit/2a8849779778dd2e1ccf2217944cd8bcd8d6d97a)) - Ambroise Maupate
- Allow MultiTypeChildren treeWalker definition to fetch invisible nodes - ([3785331](https://github.com/roadiz/skeleton/commit/3785331d6220dfb8497ff5b4620193127fa01db6)) - Ambroise Maupate

## [2.1.2](https://github.com/roadiz/skeleton/compare/v2.1.1...v2.1.2) - 2023-03-14

### Bug Fixes

- Strip out irrelevant data - ([929756f](https://github.com/roadiz/skeleton/commit/929756fa1a5148dd5abb9d4240a11c368c858cc0)) - Ambroise Maupate

## [2.1.1](https://github.com/roadiz/skeleton/compare/v2.1.0...v2.1.1) - 2023-03-08

### Bug Fixes

- Missing return types on provided node-types - ([c5208fa](https://github.com/roadiz/skeleton/commit/c5208fa95f47fc5d9105b7c32139af9cf3082dd5)) - Ambroise Maupate

## [2.1.0](https://github.com/roadiz/skeleton/compare/2.0.5...v2.1.0) - 2023-03-06

### Bug Fixes

- **(Nginx)** Missing CORS on pdf extension - ([3fddf0e](https://github.com/roadiz/skeleton/commit/3fddf0e68b4212fce1f93427d40151954426f99c)) - Ambroise Maupate
- Missing path prefix for Symfony profiler - ([7015e36](https://github.com/roadiz/skeleton/commit/7015e368e9cc2b3ca38efe6a6b5cf4c2685d15c1)) - Ambroise Maupate
- Workaround for https://github.com/varnish/docker-varnish/issues/53 - ([1d9b847](https://github.com/roadiz/skeleton/commit/1d9b8477f342d12b82bb53e1e1d81faab62fa748)) - Ambroise Maupate
- Fixed doctrine resolved entities - ([3d2e029](https://github.com/roadiz/skeleton/commit/3d2e029f7c25b80ccf24be4848657d0942f6e080)) - Ambroise Maupate
- Missing ,`/css/login/image` path - ([06e6a70](https://github.com/roadiz/skeleton/commit/06e6a70a787067fe2b1b543e667a7a09bcca36cd)) - Ambroise Maupate
- SSO user roles - ([a3a3b92](https://github.com/roadiz/skeleton/commit/a3a3b9290e26bdb9fe894fb49899b860b3f1cb62)) - Ambroise Maupate
- Keep themes and bundles assets to include them in docker image - ([c43a3ee](https://github.com/roadiz/skeleton/commit/c43a3ee1799f59e095150637167f343dd306ec78)) - Ambroise Maupate
- added isTransactional: false on Doctrine migrations - ([7164208](https://github.com/roadiz/skeleton/commit/71642086cf28b342f5089a40850eb1f871f2cc9a)) - Ambroise Maupate
- skip messenger_messages migration if table already exists - ([e594113](https://github.com/roadiz/skeleton/commit/e594113ae15dcd7cbe813eca1ac295bb3b16cde1)) - Ambroise Maupate

### Features

- **(Documents)** Moved private documents to a dedicated listing - ([eaf8ce6](https://github.com/roadiz/skeleton/commit/eaf8ce6d4a188bce173c0d2caf3bba2046f32243)) - Ambroise Maupate
- Up to PHP 8.0, changed api resources config for roadiz v2.1 - ([d2bb269](https://github.com/roadiz/skeleton/commit/d2bb26980d86a5830faedc4a8a38a2bee67e0b2c)) - Ambroise Maupate
- Change doctrine mapping to attribute - ([f2521cc](https://github.com/roadiz/skeleton/commit/f2521cc3d43967994df1ab903b1a4f0651d1ea56)) - Ambroise Maupate
- Use attributes on Models - ([61a4763](https://github.com/roadiz/skeleton/commit/61a47634bfa0b13f8468b1aab38683f4fdd59fea)) - Ambroise Maupate
- Added wait-for-it before launching app - ([9c19335](https://github.com/roadiz/skeleton/commit/9c1933504897fbc1b2e507bea9c5c06a5c913e21)) - Ambroise Maupate
- Deprecated api_platform config - ([38235f3](https://github.com/roadiz/skeleton/commit/38235f3b0804f7345dc7a8d18df66cb82ff08008)) - Ambroise Maupate
- Do not wait for 1 sec on before_launch script thanks to wait-for-it.sh - ([0f9f317](https://github.com/roadiz/skeleton/commit/0f9f31747768ce3bc776de2f96e8be89b5f348d1)) - Ambroise Maupate
- Use traefik path_prefix to host API and NuxtJS on the same domain - ([8b5f4c5](https://github.com/roadiz/skeleton/commit/8b5f4c5ab598ce4936081b22a1e60ad43295194c)) - Ambroise Maupate
- Added backup docker service example - ([d1dc286](https://github.com/roadiz/skeleton/commit/d1dc2860dc2b0195fd467e6ad4f3a733bd64c5d2)) - Ambroise Maupate
- Added CIDR to Varnish ACLs - ([498d708](https://github.com/roadiz/skeleton/commit/498d70841c0865cdc946c504fd7f25f7ca518e2f)) - Ambroise Maupate
- Use Redis as default cache backend for production - ([e8144e3](https://github.com/roadiz/skeleton/commit/e8144e371ebf7080e103534c105bfd7aadda7291)) - Ambroise Maupate
- Default enable Varnish for dev env and disable Solr by default - ([bb180f6](https://github.com/roadiz/skeleton/commit/bb180f667f59776a76bb630db455f320919341f0)) - Ambroise Maupate
- Stop messenger workers when clearing cache or migrating - ([13664c9](https://github.com/roadiz/skeleton/commit/13664c93d2259ba6e0ae036470f41f1c7a18327e)) - Ambroise Maupate
- Added document_thumbnails serialization group - ([7dcaff8](https://github.com/roadiz/skeleton/commit/7dcaff82e17c5c04597852934cf1977b14baa485)) - Ambroise Maupate
- Moved constant settings to DotEnv variables - ([cde8a48](https://github.com/roadiz/skeleton/commit/cde8a4809484371fdc00b92bcdcf7f5599291c69)) - Ambroise Maupate
- Use Symfony secrets to store sensitive configuration values - ([446d5c5](https://github.com/roadiz/skeleton/commit/446d5c54afb40159cb4b7c97376f54da23cdc257)) - Ambroise Maupate
- Added Flysystem default storages - ([687ef20](https://github.com/roadiz/skeleton/commit/687ef2053e941adc5f2fbb158daafeac19b4bd0f)) - Ambroise Maupate
- Added default Menu and MenuLink node-types - ([891f378](https://github.com/roadiz/skeleton/commit/891f3783943b3489e35d48c4780584c194e2c287)) - Ambroise Maupate
- Use dev-develop bundles - ([7252f2c](https://github.com/roadiz/skeleton/commit/7252f2c5353dd5a48ed007a4a06b680b071bae04)) - Ambroise Maupate
- Restrict open_id users to editors roles - ([2672f26](https://github.com/roadiz/skeleton/commit/2672f26ffa331a4e94679abf6deb8770590ad9c1)) - Ambroise Maupate
- Declare docker volumes to persist node-types configuration - ([5d17b89](https://github.com/roadiz/skeleton/commit/5d17b89a100f0cadf2385ce80aa34cde9968f6a0)) - Ambroise Maupate
- Force dev-develop version - ([e99cda4](https://github.com/roadiz/skeleton/commit/e99cda45d160d229f4bc9d5e79116e718d20cdab)) - Ambroise Maupate
- Always pretty print with JMS Serializer - ([d7154fd](https://github.com/roadiz/skeleton/commit/d7154fd916e1d60ba2aad8963d5e8aa4c58ac86f)) - Ambroise Maupate
- Dotenv for API name and description - ([4a8ac47](https://github.com/roadiz/skeleton/commit/4a8ac4747c5409e76cbca836a08c28397156cd7c)) - Ambroise Maupate
- Added migration for Symfony Messenger message table - ([7a5a410](https://github.com/roadiz/skeleton/commit/7a5a410e4d721b0277efc460d4bc80c57a704afc)) - Ambroise Maupate
- Invert secret gen and jwt in README - ([d89ecd6](https://github.com/roadiz/skeleton/commit/d89ecd62fb0960692ebd6bed44d75eac27662b5a)) - Ambroise Maupate
- Ignore /config/secrets/*/*.decrypt.private.php - ([a4e32c3](https://github.com/roadiz/skeleton/commit/a4e32c3a9b046dfce86b3cb93b9f9348b86af88d)) - Ambroise Maupate
- Do not commit prod secret keys - ([0103b9f](https://github.com/roadiz/skeleton/commit/0103b9f41955c8506d6dd1f9ca29e5a05f61009d)) - Ambroise Maupate
- Added trusted_headers to accept HTTPS proto from Load balancers - ([4cc8130](https://github.com/roadiz/skeleton/commit/4cc8130419c455aefcf322eaa60f45b650659ee3)) - Ambroise Maupate
- Fixed Roadiz to v2.1 - ([106a79f](https://github.com/roadiz/skeleton/commit/106a79f1b0a38f05dffb5ca3155c995e91ed8e45)) - Ambroise Maupate

### Styling

- Customize Api Platform Swagger UI - ([fadb753](https://github.com/roadiz/skeleton/commit/fadb753305649da071a9475098a7ef6121ddd8c2)) - Ambroise Maupate

### Testing

- Added Github actions - ([4a353a9](https://github.com/roadiz/skeleton/commit/4a353a9bac29cd81b32220ad79eb5b7c31d12538)) - Ambroise Maupate

## [2.0.5](https://github.com/roadiz/skeleton/compare/2.0.4...2.0.5) - 2022-09-15

### Bug Fixes

- Missing realms Rozier admin section - ([834cd85](https://github.com/roadiz/skeleton/commit/834cd85ec9a2c26e29235bc05bb5b5b0ac89e5f5)) - Ambroise Maupate

## [2.0.4](https://github.com/roadiz/skeleton/compare/2.0.3...2.0.4) - 2022-09-15

### Bug Fixes

- Removed redundant dependencies - ([911924a](https://github.com/roadiz/skeleton/commit/911924a3a3e1646a7f7795ea5c1270625cf4424f)) - Ambroise Maupate

### Features

- Missing some default .env vars - ([6052505](https://github.com/roadiz/skeleton/commit/605250508651574dde83192591cd9fcf2ff2258e)) - Ambroise Maupate
- Improved config/packages files and default .env - ([910f32b](https://github.com/roadiz/skeleton/commit/910f32b70e75424598c000199d03315cf5e2c8a4)) - Ambroise Maupate

## [2.0.3](https://github.com/roadiz/skeleton/compare/2.0.2...2.0.3) - 2022-09-07

### Features

- Added APP_FFMPEG_PATH DotEnv and ffmpeg binary to Docker images - ([4c0f063](https://github.com/roadiz/skeleton/commit/4c0f063df497553d9fcd411bd47167c05b1beedb)) - Ambroise Maupate
- Use Imagick as default image driver to support AVIF/HEIC files formats - ([20ee3f6](https://github.com/roadiz/skeleton/commit/20ee3f643dc25deff3632385bbfe3e94f7faed28)) - Ambroise Maupate

## [2.0.2](https://github.com/roadiz/skeleton/compare/2.0.1...2.0.2) - 2022-08-04

### Bug Fixes

- **(PHP)** Removed PHP warnings on prod env - ([879e23b](https://github.com/roadiz/skeleton/commit/879e23b29ef341fe7d9c8c7ca8e02b659fb0b43e)) - Ambroise Maupate
- Removed useless API collection operations - ([85d58e9](https://github.com/roadiz/skeleton/commit/85d58e9d8b41be02609d7a8185cd7b67561a1aec)) - Ambroise Maupate
- Useless php-soap requirement - ([fcab0eb](https://github.com/roadiz/skeleton/commit/fcab0eb8ced1bd338306f3a098e0bac537157f2a)) - Ambroise Maupate

### CI/CD

- Docker and CI configuration fixes - ([675eb1e](https://github.com/roadiz/skeleton/commit/675eb1edb1eed607611da82d45a9171d6b064278)) - Ambroise Maupate
- Docker and CI configuration fixes - ([4635ae8](https://github.com/roadiz/skeleton/commit/4635ae8235e29dc778d994b8e9e0f877bf3c0b89)) - Ambroise Maupate

### Features

- **(Performances)** Added php.ini preload configuration - ([0e291fd](https://github.com/roadiz/skeleton/commit/0e291fdd038fe1a5c393c9b9e2cfadbc8a7c3679)) - Ambroise Maupate
- Added /api/common_content endpoint example - ([f909aa7](https://github.com/roadiz/skeleton/commit/f909aa78446b56803b2f6ee888d124c6dac2837c)) - Ambroise Maupate
- Additional CORS allowed headers - ([6501e2c](https://github.com/roadiz/skeleton/commit/6501e2c5dc62f849ea5b692917900871f01dca17)) - Ambroise Maupate
- Added realms api resource configuration - ([9f2d035](https://github.com/roadiz/skeleton/commit/9f2d0350cf9072f9e1019eef0a70fdc9723feaf0)) - Ambroise Maupate

## [2.0.1](https://github.com/roadiz/skeleton/compare/2.0.0...2.0.1) - 2022-07-04

### Bug Fixes

- Non existent Varnish docker image tag - ([5217af9](https://github.com/roadiz/skeleton/commit/5217af94c5f16f25db0d3b8fcc333edfd8cdb72f)) - Ambroise Maupate

## [2.0.0] - 2022-07-04

### Bug Fixes

- dump only real env vars - ([80c1d6a](https://github.com/roadiz/skeleton/commit/80c1d6a97cafd734031719d3653400b661d90f39)) - Ambroise Maupate
- refactored config - ([b9cd98d](https://github.com/roadiz/skeleton/commit/b9cd98d9913383a1eb40ed3fcc55fb3c6f56b780)) - Ambroise Maupate
- Production environment - ([a6d11d6](https://github.com/roadiz/skeleton/commit/a6d11d6819f23d31d4cafadcedc4518ff89e2ea0)) - Ambroise Maupate
- trusted proxies - ([8395028](https://github.com/roadiz/skeleton/commit/83950281ba7d69d59238515505f1b8b8af85c4d9)) - Ambroise Maupate
- do not add volume on var/cache - ([65b979a](https://github.com/roadiz/skeleton/commit/65b979a553ea8c4978a1da9d520ab5397c59d495)) - Ambroise Maupate
- Use rezozero Liform fork - ([1caa915](https://github.com/roadiz/skeleton/commit/1caa915f712ea03755528864d41f8f32b4184722)) - Ambroise Maupate
- Increase nginx buffer size for large collection of Cache-Tags - ([efa3db4](https://github.com/roadiz/skeleton/commit/efa3db447b863cd1c4648ea883e8df91f4ccbf80)) - Ambroise Maupate

### Features

- Better makefile using docker-compose - ([af83464](https://github.com/roadiz/skeleton/commit/af8346479767365350b10e7c4c662b6bdbe999e4)) - Ambroise Maupate
- Env var HTTP_CACHE_SHARED_MAX_AGE - ([f416070](https://github.com/roadiz/skeleton/commit/f41607042bb229abb54b83b60a07b24feff037ca)) - Ambroise Maupate
- Use OpenIdAuthenticator for backoffice access - ([3b1ccc5](https://github.com/roadiz/skeleton/commit/3b1ccc5ae37d99a220b7285ab45d9236821539eb)) - Ambroise Maupate
- Enable Scienta\DoctrineJsonFunctions JSON_CONTAINS - ([982c914](https://github.com/roadiz/skeleton/commit/982c914055db497c7e32584587f7ed8a4d6dc53b)) - Ambroise Maupate
- Added contact form controller and rate-limiter - ([90ee246](https://github.com/roadiz/skeleton/commit/90ee24628e867b14f52530a55d8a568a9e09202d)) - Ambroise Maupate
- Separate WebResponse Api Resource - ([c841437](https://github.com/roadiz/skeleton/commit/c841437a7227061f2d846b6807bfeff1e92994dc)) - Ambroise Maupate
- new APP_USE_ACCEPT_LANGUAGE_HEADER dotenv - ([5147c36](https://github.com/roadiz/skeleton/commit/5147c3697f5f2c691b99ba9d917252045eb64752)) - Ambroise Maupate
- Use php81 - ([cb4ed6a](https://github.com/roadiz/skeleton/commit/cb4ed6a8ab2f0c46c9f1d6678540e20db0813d5f)) - Ambroise Maupate
- Added dotenv vars and healthcheck entry-point - ([f34f106](https://github.com/roadiz/skeleton/commit/f34f1061bf9a238fc11dec34badc772c3f9d4c36)) - Ambroise Maupate
- New document section menu - ([b74997a](https://github.com/roadiz/skeleton/commit/b74997a003340d3627329c7c2ee8c49fc91c3d67)) - Ambroise Maupate
- Use built-in Symfony login throttling - ([97bca11](https://github.com/roadiz/skeleton/commit/97bca110744ead44aa03340c618c2e5fbd7f3ace)) - Ambroise Maupate
- Update crontab example with custom-form-answer prune command - ([4612eae](https://github.com/roadiz/skeleton/commit/4612eae801480e9d46f8c9cdf7c3f01e13e9290e)) - Ambroise Maupate
- Use custom Solr image to allow ASCII folding - ([d7633fe](https://github.com/roadiz/skeleton/commit/d7633fe774b61edfc3d9a9a4950d0b47da2ef4b1)) - Ambroise Maupate
- Moved open_id configuration from core to rozier bundle - ([8b534c1](https://github.com/roadiz/skeleton/commit/8b534c15d01bbe59cac79099005ac1acc945cae9)) - Ambroise Maupate
- Fixed roadiz packages to 2.0.0 - ([93fbd0b](https://github.com/roadiz/skeleton/commit/93fbd0b4cc75e74eec979b955912233d4eceb794)) - Ambroise Maupate
- Fixed dependencies, upgraded configuration files, added Contactform definition action - ([1b4c2e1](https://github.com/roadiz/skeleton/commit/1b4c2e1cf8ebfec239d42f35f441bbfd00b06b6a)) - Ambroise Maupate

### Refactor

- Removed VCS repositories for liform - ([0596a11](https://github.com/roadiz/skeleton/commit/0596a119a358fd2439c7f2fb884aa4b968406c00)) - Ambroise Maupate

<!-- generated by git-cliff -->
