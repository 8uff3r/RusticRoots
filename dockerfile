FROM php:8.2-cli
RUN \
  apt-get update && \
  apt-get install git unzip bash curl -y && \
  mkdir ~/.ssh && \
  ssh-keyscan -t rsa github.com > ~/.ssh/known_hosts
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php -r "if (hash_file('sha384', 'composer-setup.php') === 'dac665fdc30fdd8ec78b38b9800061b4150413ff2e3b6f88543c636f7cd84f6db9189d43a81e5503cda447da73c7e5b6') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"
RUN mv composer.phar /bin/composer

RUN rm -rf /app

COPY . /app

WORKDIR /app

ADD --chmod=0755 https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /bin/

RUN install-php-extensions \
    pcntl pdo_mysql mysqli sockets
    # Add other PHP extensions here...
RUN composer install

RUN php artisan octane:install --server roadrunner -n

RUN curl -fsSL https://bun.sh/install | bash
RUN ~/.bun/bin/bun install
RUN ~/.bun/bin/bun run build

EXPOSE 8090
ENTRYPOINT ["php", "artisan", "octane:start","--host", "0.0.0.0", "--port", "8090", "--server", "roadrunner", "--rr-config", ".rr.yaml"]
