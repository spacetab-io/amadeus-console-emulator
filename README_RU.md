## Amadeus console emulator (by Command Cryptic)

![](http://i.imgur.com/EsYtWjL.png)

### Требования

0. Libs: libxml2-dev libxslt1-dev
1. PHP >= 5.6
2. PHP extensions: xsl soap 
3. Composer
4. (опционально) Docker

### Установка и подготовка

1. Склонировать репозиторий
2. Сделать `composer install`
3. В папку WSDL добавить wsdl и xsd файлы
4. Создать .`env` файл из `.env.example`, прописав в него все пропущенные значения

### Запуск

#### Установленный нативно PHP

`php cryptic`

####  Dockerized PHP

Запуск командой `docker run -it -v "$(pwd)/.env":/console/.env -v "$(pwd)/WSDL":/console/WSDL tmconsulting/amadeus-console-emulator`

Внимание! Для запуска из контейнера необходима подгрузка .env файла с настройками и папки WSDL с wsdl и xsd файлами. 
 Запускайте контейнер из папки, где у вас лежат эти файлы и папки.
