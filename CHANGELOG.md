## [v2.1.6](https://github.com/roadiz/skeleton/compare/v2.1.5...v2.1.6) (2023-05-31)


### Bug Fixes

* Missing serialization group on custom_form operations ([41d57cc](https://github.com/roadiz/skeleton/commit/41d57cc57ead98c56981c26418570adc5c6b131b))

## [v2.1.5](https://github.com/roadiz/skeleton/compare/v2.1.4...v2.1.5) (2023-05-31)

## [v2.1.4](https://github.com/roadiz/skeleton/compare/v2.1.3...v2.1.4) (2023-05-17)


### Bug Fixes

* Mixed up public and private file volumes for backup ([8d954ac](https://github.com/roadiz/skeleton/commit/8d954acb885bda28fd071c7db3b747bf57ac9af3))

## [v2.1.3](https://github.com/roadiz/skeleton/compare/v2.1.2...v2.1.3) (2023-03-20)


### Features

* Allow MultiTypeChildren treeWalker definition to fetch invisible nodes ([3785331](https://github.com/roadiz/skeleton/commit/3785331d6220dfb8497ff5b4620193127fa01db6))
* Migrate from monolithic docker image to app, nginx, worker and cron containers. ([2a88497](https://github.com/roadiz/skeleton/commit/2a8849779778dd2e1ccf2217944cd8bcd8d6d97a))


### Bug Fixes

* Fixed GetCommonContentController using NodesSourcesHeadFactoryInterface and type-hinting Request ([33b637a](https://github.com/roadiz/skeleton/commit/33b637aea034111199b4edc00ceec788ff5b659c))
* Missing docker/php-fpm-alpine/wait-for-it.sh in Dockerfile COPY ([54785fe](https://github.com/roadiz/skeleton/commit/54785fef5fd0847a85c1746e51669563999b5363))
* Varnish ACL should allow cron and worker hostname to purge ([b1a69e4](https://github.com/roadiz/skeleton/commit/b1a69e4d367330bd4b86a606de3da835f00ba69e))

## [v2.1.2](https://github.com/roadiz/skeleton/compare/v2.1.1...v2.1.2) (2023-03-14)


### Bug Fixes

* Strip out irrelevant data ([929756f](https://github.com/roadiz/skeleton/commit/929756fa1a5148dd5abb9d4240a11c368c858cc0))

## [v2.1.1](https://github.com/roadiz/skeleton/compare/v2.1.0...v2.1.1) (2023-03-08)


### Bug Fixes

* Missing return types on provided node-types ([c5208fa](https://github.com/roadiz/skeleton/commit/c5208fa95f47fc5d9105b7c32139af9cf3082dd5))

## v2.1.0 (2023-03-06)


### Features

* Added backup docker service example ([d1dc286](https://github.com/roadiz/skeleton/commit/d1dc2860dc2b0195fd467e6ad4f3a733bd64c5d2))
* Added CIDR to Varnish ACLs ([498d708](https://github.com/roadiz/skeleton/commit/498d70841c0865cdc946c504fd7f25f7ca518e2f))
* Added default Menu and MenuLink node-types ([891f378](https://github.com/roadiz/skeleton/commit/891f3783943b3489e35d48c4780584c194e2c287))
* Added document_thumbnails serialization group ([7dcaff8](https://github.com/roadiz/skeleton/commit/7dcaff82e17c5c04597852934cf1977b14baa485))
* Added Flysystem default storages ([687ef20](https://github.com/roadiz/skeleton/commit/687ef2053e941adc5f2fbb158daafeac19b4bd0f))
* Added migration for Symfony Messenger message table ([7a5a410](https://github.com/roadiz/skeleton/commit/7a5a410e4d721b0277efc460d4bc80c57a704afc))
* Added trusted_headers to accept HTTPS proto from Load balancers ([4cc8130](https://github.com/roadiz/skeleton/commit/4cc8130419c455aefcf322eaa60f45b650659ee3))
* Added wait-for-it before launching app ([9c19335](https://github.com/roadiz/skeleton/commit/9c1933504897fbc1b2e507bea9c5c06a5c913e21))
* Always pretty print with JMS Serializer ([d7154fd](https://github.com/roadiz/skeleton/commit/d7154fd916e1d60ba2aad8963d5e8aa4c58ac86f))
* Change doctrine mapping to attribute ([f2521cc](https://github.com/roadiz/skeleton/commit/f2521cc3d43967994df1ab903b1a4f0651d1ea56))
* Declare docker volumes to persist node-types configuration ([5d17b89](https://github.com/roadiz/skeleton/commit/5d17b89a100f0cadf2385ce80aa34cde9968f6a0))
* Default enable Varnish for dev env and disable Solr by default ([bb180f6](https://github.com/roadiz/skeleton/commit/bb180f667f59776a76bb630db455f320919341f0))
* Deprecated api_platform config ([38235f3](https://github.com/roadiz/skeleton/commit/38235f3b0804f7345dc7a8d18df66cb82ff08008))
* Do not commit prod secret keys ([0103b9f](https://github.com/roadiz/skeleton/commit/0103b9f41955c8506d6dd1f9ca29e5a05f61009d))
* Do not wait for 1 sec on before_launch script thanks to wait-for-it.sh ([0f9f317](https://github.com/roadiz/skeleton/commit/0f9f31747768ce3bc776de2f96e8be89b5f348d1))
* **Documents:** Moved private documents to a dedicated listing ([eaf8ce6](https://github.com/roadiz/skeleton/commit/eaf8ce6d4a188bce173c0d2caf3bba2046f32243))
* Dotenv for API name and description ([4a8ac47](https://github.com/roadiz/skeleton/commit/4a8ac4747c5409e76cbca836a08c28397156cd7c))
* Fixed Roadiz to v2.1 ([106a79f](https://github.com/roadiz/skeleton/commit/106a79f1b0a38f05dffb5ca3155c995e91ed8e45))
* Force dev-develop version ([e99cda4](https://github.com/roadiz/skeleton/commit/e99cda45d160d229f4bc9d5e79116e718d20cdab))
* Ignore /config/secrets/*/*.decrypt.private.php ([a4e32c3](https://github.com/roadiz/skeleton/commit/a4e32c3a9b046dfce86b3cb93b9f9348b86af88d))
* Invert secret gen and jwt in README ([d89ecd6](https://github.com/roadiz/skeleton/commit/d89ecd62fb0960692ebd6bed44d75eac27662b5a))
* Moved constant settings to DotEnv variables ([cde8a48](https://github.com/roadiz/skeleton/commit/cde8a4809484371fdc00b92bcdcf7f5599291c69))
* Restrict open_id users to editors roles ([2672f26](https://github.com/roadiz/skeleton/commit/2672f26ffa331a4e94679abf6deb8770590ad9c1))
* Stop messenger workers when clearing cache or migrating ([13664c9](https://github.com/roadiz/skeleton/commit/13664c93d2259ba6e0ae036470f41f1c7a18327e))
* Up to PHP 8.0, changed api resources config for roadiz v2.1 ([d2bb269](https://github.com/roadiz/skeleton/commit/d2bb26980d86a5830faedc4a8a38a2bee67e0b2c))
* Use attributes on Models ([61a4763](https://github.com/roadiz/skeleton/commit/61a47634bfa0b13f8468b1aab38683f4fdd59fea))
* Use dev-develop bundles ([7252f2c](https://github.com/roadiz/skeleton/commit/7252f2c5353dd5a48ed007a4a06b680b071bae04))
* Use Redis as default cache backend for production ([e8144e3](https://github.com/roadiz/skeleton/commit/e8144e371ebf7080e103534c105bfd7aadda7291))
* Use Symfony secrets to store sensitive configuration values ([446d5c5](https://github.com/roadiz/skeleton/commit/446d5c54afb40159cb4b7c97376f54da23cdc257))
* Use traefik path_prefix to host API and NuxtJS on the same domain ([8b5f4c5](https://github.com/roadiz/skeleton/commit/8b5f4c5ab598ce4936081b22a1e60ad43295194c))


### Bug Fixes

* added isTransactional: false on Doctrine migrations ([7164208](https://github.com/roadiz/skeleton/commit/71642086cf28b342f5089a40850eb1f871f2cc9a))
* Fixed doctrine resolved entities ([3d2e029](https://github.com/roadiz/skeleton/commit/3d2e029f7c25b80ccf24be4848657d0942f6e080))
* Keep themes and bundles assets to include them in docker image ([c43a3ee](https://github.com/roadiz/skeleton/commit/c43a3ee1799f59e095150637167f343dd306ec78))
* Missing ,`/css/login/image` path ([06e6a70](https://github.com/roadiz/skeleton/commit/06e6a70a787067fe2b1b543e667a7a09bcca36cd))
* Missing path prefix for Symfony profiler ([7015e36](https://github.com/roadiz/skeleton/commit/7015e368e9cc2b3ca38efe6a6b5cf4c2685d15c1))
* **Nginx:** Missing CORS on pdf extension ([3fddf0e](https://github.com/roadiz/skeleton/commit/3fddf0e68b4212fce1f93427d40151954426f99c))
* skip messenger_messages migration if table already exists ([e594113](https://github.com/roadiz/skeleton/commit/e594113ae15dcd7cbe813eca1ac295bb3b16cde1))
* SSO user roles ([a3a3b92](https://github.com/roadiz/skeleton/commit/a3a3b9290e26bdb9fe894fb49899b860b3f1cb62))
* Workaround for https://github.com/varnish/docker-varnish/issues/53 ([1d9b847](https://github.com/roadiz/skeleton/commit/1d9b8477f342d12b82bb53e1e1d81faab62fa748))

## 2.0.5 (2022-09-15)

### Bug Fixes

* Missing `realms` Rozier admin section ([834cd85](https://github.com/roadiz/skeleton/commit/834cd85ec9a2c26e29235bc05bb5b5b0ac89e5f5))

## 2.0.4 (2022-09-15)

### Features

* Improved config/packages files and default .env ([910f32b](https://github.com/roadiz/skeleton/commit/910f32b70e75424598c000199d03315cf5e2c8a4))
* Missing some default .env vars ([6052505](https://github.com/roadiz/skeleton/commit/605250508651574dde83192591cd9fcf2ff2258e))

### Bug Fixes

* Removed redundant dependencies ([911924a](https://github.com/roadiz/skeleton/commit/911924a3a3e1646a7f7795ea5c1270625cf4424f))

## 2.0.3 (2022-09-07)

### Features

* Added `APP_FFMPEG_PATH` DotEnv and ffmpeg binary to Docker images ([4c0f063](https://github.com/roadiz/skeleton/commit/4c0f063df497553d9fcd411bd47167c05b1beedb))
* Use Imagick as default image driver to support AVIF/HEIC files formats ([20ee3f6](https://github.com/roadiz/skeleton/commit/20ee3f643dc25deff3632385bbfe3e94f7faed28))

## 2.0.2 (2022-08-04)

### Features

* Added /api/common_content endpoint example ([f909aa7](https://github.com/roadiz/skeleton/commit/f909aa78446b56803b2f6ee888d124c6dac2837c))
* Added realms api resource configuration ([9f2d035](https://github.com/roadiz/skeleton/commit/9f2d0350cf9072f9e1019eef0a70fdc9723feaf0))
* Additional CORS allowed headers ([6501e2c](https://github.com/roadiz/skeleton/commit/6501e2c5dc62f849ea5b692917900871f01dca17))
* **Performances:** Added php.ini preload configuration ([0e291fd](https://github.com/roadiz/skeleton/commit/0e291fdd038fe1a5c393c9b9e2cfadbc8a7c3679))

### Bug Fixes

* **PHP:** Removed PHP warnings on prod env ([879e23b](https://github.com/roadiz/skeleton/commit/879e23b29ef341fe7d9c8c7ca8e02b659fb0b43e))
* Removed useless API collection operations ([85d58e9](https://github.com/roadiz/skeleton/commit/85d58e9d8b41be02609d7a8185cd7b67561a1aec))
* Useless php-soap requirement ([fcab0eb](https://github.com/roadiz/skeleton/commit/fcab0eb8ced1bd338306f3a098e0bac537157f2a))

## 2.0.1 (2022-07-04)

### Bug Fixes

* Non-existent Varnish docker image tag ([5217af9](https://github.com/roadiz/skeleton/commit/5217af94c5f16f25db0d3b8fcc333edfd8cdb72f))

