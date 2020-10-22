# Update the VARIANT arg in docker-compose.yml to pick a PHP version: 7, 7.4, 7.3
ARG VARIANT=7
FROM mcr.microsoft.com/vscode/devcontainers/php:dev-${VARIANT}

# Install MariaDB client
RUN apt-get update && export DEBIAN_FRONTEND=noninteractive \
    && apt-get install -y mariadb-client \ 
    && apt-get clean -y && rm -rf /var/lib/apt/lists/*

# Update args in docker-compose.yaml to set the UID/GID of the "vscode" user.
ARG USER_UID=1000
ARG USER_GID=$USER_UID
RUN if [ "$USER_GID" != "1000" ] || [ "$USER_UID" != "1000" ]; then \
    groupmod --gid $USER_GID vscode \
    && usermod --uid $USER_UID --gid $USER_GID vscode \
    && chown -R $USER_UID:$USER_GID /home/vscode \
    && chown -R $USER_UID:root /usr/local/share/nvm; \
    fi

# [Optional] Install a version of Node.js using nvm for front end dev
ARG INSTALL_NODE="true"
ARG NODE_VERSION="lts/*"
RUN if [ "${INSTALL_NODE}" = "true" ]; then su vscode -c "source /usr/local/share/nvm/nvm.sh && nvm install ${NODE_VERSION} 2>&1"; fi

# [Optional] Uncomment this section to install additional OS packages.
# RUN apt-get update && export DEBIAN_FRONTEND=noninteractive \
#     && apt-get -y install --no-install-recommends <your-package-list-here>

# [Optional] Uncomment this line to install global node packages.
# RUN su vscode -c "source /usr/local/share/nvm/nvm.sh && npm install -g <your-package-here>" 2>&1

# Apache configuration
COPY ./default.conf /etc/apache2/sites-available/000-default.conf

COPY ./apache2.conf /etc/apache2/apache2-cust.conf
RUN cat /etc/apache2/apache2-cust.conf >> /etc/apache2/apache2.conf

# Up PHP limit!
RUN sed -i "s/memory_limit.*/memory_limit = -1/" /usr/local/etc/php/php.ini-development
RUN sed -i "s/memory_limit.*/memory_limit = -1/" /usr/local/etc/php/php.ini-production

# OpenPGP (privacy guard)
RUN apt-get update \
    && apt-get install gnupg -y
# Linked libraries
RUN apt-get update \
    # ODBC libraries
    && apt-get install unixodbc unixodbc-dev -y \
    # XML parser lib
    && apt-get install libxml2 libxml2-dev -y \
    # Regex library
    && apt-get install libonig-dev -y \
    # Manipulating ZIP files
    && apt-get install libzip-dev -y \
    # GZIP compression
    && apt-get install zlib1g-dev -y \
    # Encryption
    && apt-get install libmcrypt-dev -y \
    # PNG
    && apt-get install libpng-dev -y

# PHP extensions
RUN docker-php-ext-install \
    pdo_mysql \
    soap \
    fileinfo \
    mbstring \
    bcmath \
    zip \
    opcache \
    sockets \
    gd
RUN docker-php-ext-enable \
    pdo_mysql \
    soap \
    fileinfo \
    mbstring \
    bcmath \
    zip \
    opcache \
    sockets \
    gd

# Apache mod rewrite
RUN a2enmod rewrite

# Run COMPOSER_MEMORY_LIMIT=2GB composer install
# Run apache2ctl start 😊