FROM gcr.io/aleph-infra/nought-wp-base-docker/main:v0.0.10 AS base

ARG THEME_SLUG=aleph-nought

# This must be included manually per-project. This is where you include any MU custom plugins
COPY mu-plugins/nought-wp-custom /app/web/app/mu-plugins

WORKDIR /app/project
COPY composer.json .

WORKDIR /app
RUN composer update --lock

WORKDIR /app/themes/${THEME_SLUG}/
COPY themes/${THEME_SLUG}/composer.json .
COPY themes/${THEME_SLUG}/composer.lock .
RUN composer install --prefer-dist --no-progress --no-dev --optimize-autoloader --no-suggest


FROM node:12.16.1 AS theme-builder

ARG THEME_SLUG=aleph-nought

WORKDIR /theme
COPY themes/${THEME_SLUG}/ .
RUN yarn && yarn build:production


FROM us.gcr.io/aleph-infra/docker-apache-php:v1.2.5

ARG THEME_SLUG=aleph-nought
ARG PHP_ENV=production

ENV WP_HOME=http://localhost:8080
ENV WP_SITEURL=http://localhost:8080/wp
ENV DB_NAME=wordpress
ENV DB_USER=wordpress
ENV DB_PASSWORD=wordpress

COPY ./php/php-${PHP_ENV}.ini /usr/local/etc/php/conf.d/php-${PHP_ENV}.ini

WORKDIR /var/www/html

COPY --chown=www-data:www-data --from=base /app/config ./config
COPY --chown=www-data:www-data --from=base /app/vendor ./vendor
COPY --chown=www-data:www-data --from=base /app/web ./web
COPY --chown=www-data:www-data themes/${THEME_SLUG}/ ./web/app/themes/${THEME_SLUG}/
COPY --chown=www-data:www-data --from=base /app/themes/${THEME_SLUG}/vendor/ ./web/app/themes/${THEME_SLUG}/vendor/
COPY --chown=www-data:www-data --from=theme-builder /theme/dist/ ./web/app/themes/${THEME_SLUG}/dist/

# RUN mkdir /var/www/html/web/app/uploads && chown -R www-data:www-data /var/www/html/web
RUN chown -R www-data:www-data /var/www/html/web
VOLUME /var/www/html/web/app/uploads