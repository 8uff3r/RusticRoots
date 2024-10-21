FROM dunglas/frankenphp
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
RUN curl -fsSL https://bun.sh/install | bash

RUN rm -rf /app

COPY . /app

WORKDIR /app

RUN install-php-extensions \
    pcntl pdo_mysql redis
    # Add other PHP extensions here...
EXPOSE 8090
RUN composer install
RUN ~/.bun/bin/bun install
RUN ~/.bun/bin/bun run build
ENTRYPOINT ["php", "artisan", "octane:frankenphp","--host", "0.0.0.0", "--port", "8090"]
