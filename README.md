## Amadeus console emulator (by Command Cryptic)

### Требования

0. Libs: libxml2-dev libxslt1-dev
1. PHP >= 5.6
2. PHP extensions: xsl soap 
3. Composer

### Install and configure

1. Clone this repo
2. Make `composer install`
3. Copy your WSAP wsdl and xsd files into WSDL folder
4. Create `.env` file from `.env.example` and fill it variables

### Launch

#### In system PHP installation

Run `php cryptic` in the root of it repo

####  Dockerized PHP

    docker build -t command-cryptic-console-emulator
    docker run -it command-cryptic-console-emulator