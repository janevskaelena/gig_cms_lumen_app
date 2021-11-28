FROM php:fpm-alpine3.14 as local

ADD start-script.sh /start-script.sh
WORKDIR /var/www/html/

# Install extensions
RUN docker-php-ext-install pdo_mysql

# Install composer
RUN php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer --2

# Copy existing application directory contents
COPY . .

RUN chmod -v +x /start-script.sh
CMD ["/start-script.sh"]
