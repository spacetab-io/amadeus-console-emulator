FROM php:7.0-cli

RUN apt-get update && apt-get install -y \
        libxml2-dev \
        libxslt1-dev

RUN docker-php-ext-install -j$(nproc) xsl soap

COPY . /console
WORKDIR /console
CMD ["php", "cryptic"]