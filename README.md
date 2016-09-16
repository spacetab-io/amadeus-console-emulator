## Amadeus console emulator (by Command Cryptic)

![](http://i.imgur.com/EsYtWjL.png)

### Requirements

0. Libs: libxml2-dev libxslt1-dev
1. PHP >= 5.6
2. PHP extensions: xsl soap 
3. Composer
4. (optional) Docker

### Install and configure

1. Clone this repo
2. Make `composer install`
3. Copy your WSAP wsdl and xsd files into WSDL folder
4. Create `.env` file from `.env.example` and fill it variables

### Launch

#### In system PHP installation

Run `php cryptic`

####  Dockerized PHP

Run `docker run -it -v "$(pwd)/.env":/console/.env -v "$(pwd)/WSDL":/console/WSDL tmconsulting/amadeus-console-emulator`

Warning! To run emulator you need to pass .env file and WSDL folder. Run command from folder that has this files and folder.
