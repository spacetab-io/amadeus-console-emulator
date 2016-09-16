FROM php:7.0-cli

COPY . /console
WORKDIR /console

RUN apt-get update && apt-get install -y \
        libxml2-dev \
        libxslt1-dev \
        git

RUN docker-php-ext-install -j$(nproc) xsl soap

# Never-ever do it with some production staff! :)
ADD https://getcomposer.org/composer.phar ./composer.phar
RUN php ./composer.phar install
RUN rm composer.phar

CMD ["php", "cryptic"]