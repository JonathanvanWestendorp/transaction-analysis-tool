FROM php:7.3-apache
COPY src/ /var/www/html/
WORKDIR /var/www/html/
RUN apt-get update
RUN apt-get -y install curl gnupg vim git
RUN curl -sL https://deb.nodesource.com/setup_10.x  | bash -
RUN apt-get -y install nodejs
RUN npm install
RUN mkdir bin
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php --install-dir=bin --filename=composer
RUN php -r "unlink('composer-setup.php');"
RUN bin/composer install
# CMD node index.js