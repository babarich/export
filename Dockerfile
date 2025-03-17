FROM php:8.2.9-apache
USER root


RUN a2enmod rewrite && a2enmod headers

RUN apt-get update && apt-get install -y cron libpng-dev libjpeg-dev libonig-dev libzip.dev libpq.dev libwebp.dev

RUN docker-php-ext-configure gd --with-jpeg --with-webp

RUN docker-php-ext-install zip gd pdo pdo_pgsql pgsql

  
RUN apt-get install -y postgresql-client supervisor net-tools


RUN mkdir -p /etc/apache2/ssl

RUN cp "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

RUN echo "expose_php = off" >> $PHP_INI_DIR/php.ini


COPY . /var/www/html
COPY export_worker.conf /etc/supervisor/conf.d/
RUN chmod -R 777 /var/www/html/storage
RUN chmod -R 777 /var/www/html/bootstrap/cache
RUN chmod -R 777 /var/www/html/public
RUN chmod -R 777 /var/www/html/storage
RUN chown -R www-data:www-data /var/www/html
RUN mv.env.prod .env

RUN echo "ServerTokens Prod" >> /etc/apache2/conf-available/security.conf
RUN echo "ServerSignature Off" >> /etc/apache2/apache2.conf

RUN touch /var/www/html/laravel_crontab
RUN touch /var/log/cron.log
RUN echo "***** cd /var/www/html && /usr/local/bin/php artisan schedule:run >> /var/log/cron.log 2>&1\n" >> /var/www/html/laravel_crontab

RUN cp /var/www/html/laravel_crontab /etc/cron.d/
RUN chmod 777 /etc/cron.d/laravel_crontab

RUN service cron.restart

RUN crontab /etc/cron.d/laravel_crontab



EXPOSE 443

COPY start.sh /start.sh
RUN chmod +x /start.sh


ENTRYPOINT  ["/start.sh"]
