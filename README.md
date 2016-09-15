## Amadeus console emulator (by Command Cryptic)

### Требования

0. Libs: libxml2-dev libxslt1-dev
1. PHP >= 5.6
2. PHP extensions: xsl soap 
3. Composer

### Установка и подготовка

1. Склонировать репозиторий
2. Сделать `composer install`
3. В папку WSDL добавить wsdl и xsd файлы
4. Создать .`env` файл из `.env.example`, прописав в него все пропущенные значения

### Запуск

#### Установленный нативно PHP

`php cryptic`

####  Dockerized PHP

    docker build -t command-cryptic-console-emulator
    docker run -it command-cryptic-console-emulator