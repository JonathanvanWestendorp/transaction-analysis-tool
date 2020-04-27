FROM php:7.3-apache
COPY src/ /var/www/html/

# Install npm, node, solcjs and expressjs
WORKDIR /var/www/html/
RUN apt-get update
RUN apt-get -y install curl gnupg
RUN curl -sL https://deb.nodesource.com/setup_11.x  | bash -
RUN apt-get -y install nodejs
RUN npm install && \
    npm install express && \
    npm install solcjs
