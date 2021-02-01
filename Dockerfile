FROM composer:1.8.6 AS builder

# Must be passed with --build-arg or builds will fail!
ARG ACF_PRO_KEY
ARG PHP_ENV=production
ARG THEME_SLUG=aleph-nought

WORKDIR /tmp/composer-cache
COPY ./composer.json .
COPY ./composer.lock .
COPY ./web/app/mu-plugins /tmp/composer-cache/web/app/mu-plugins
RUN composer install --prefer-dist --no-progress --no-dev --optimize-autoloader --no-suggest

# Separate process for Sage theme
WORKDIR /tmp/theme-composer-cache
COPY web/app/themes/${THEME_SLUG}/composer.json .
COPY web/app/themes/${THEME_SLUG}/composer.lock .
RUN composer install --prefer-dist --no-progress --no-dev --optimize-autoloader --no-suggest

WORKDIR /app
COPY ./config config
COPY ./web web

RUN mv /tmp/composer-cache/web/wp /app/web
RUN cp -rf /tmp/composer-cache/web/app/plugins/* /app/web/app/plugins/
RUN cp -rf /tmp/composer-cache/web/app/mu-plugins/* /app/web/app/mu-plugins/
RUN mv /tmp/composer-cache/vendor /app

WORKDIR /theme
RUN mv /tmp/theme-composer-cache/vendor .
WORKDIR /app
COPY ./config config
COPY ./web web

FROM node:12.16.1 AS theme-builder

ENV NPM_CONFIG_PREFIX=/home/node/.npm-global

RUN npm install -g yarn

WORKDIR /theme/deps-cache
# using ${THEME_SLUG} in local path doesn't work on the following two COPY commands
COPY web/app/themes/test-foo/package.json .
COPY web/app/themes/test-foo/yarn.lock .
RUN /home/node/.npm-global/bin/yarn install

WORKDIR /theme
COPY --from=builder /app/web/app/themes/${THEME_SLUG} .
RUN mv deps-cache/node_modules .
RUN pwd && ls -al && cd test-foo && ls -al

# chaning WORKDIR to the theme passes this step but does this nest the theme one level deeper than desired?
WORKDIR /theme/test-foo
RUN yarn && yarn build:production

FROM us.gcr.io/aleph-infra/docker-apache-php:v1.2.5

# WORKDIR /theme
# local file doesn't exist - unnecessary because using php from us.gcr.io?
# COPY ./php/php-${PHP_ENV}.ini /usr/local/etc/php/conf.d/php-${PHP_ENV}.ini

WORKDIR /var/www/html
COPY --chown=www-data:www-data --from=builder /app/config ./config
COPY --chown=www-data:www-data --from=builder /app/vendor ./vendor
COPY --chown=www-data:www-data --from=builder /app/web ./web
RUN cd web/app/themes/test-foo && ls -al && pwd
COPY --chown=www-data:www-data --from=theme-builder /theme/dist/ ./web/app/themes/test-foo/dist/
COPY --chown=www-data:www-data --from=builder /theme/vendor/ ./web/app/themes/${THEME_SLUG}/vendor/
COPY ./wp-cli.yml .

RUN mkdir /var/www/html/web/app/uploads && chown -R www-data:www-data /var/www/html/web

VOLUME /var/www/html/web/app/uploads