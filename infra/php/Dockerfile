# Use a imagem base do PHP 8.3 com Apache
FROM php:8.3-apache

# Instale pacotes básicos e ferramentas necessárias
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libzip-dev \
    unzip \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    pdftk \
    ghostscript \
    default-mysql-client \
    postgresql-client \
    && docker-php-ext-configure gd \
        --with-freetype \
        --with-jpeg \
    && docker-php-ext-install gd zip pdo pdo_mysql pdo_pgsql \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Habilitar o módulo de reescrita do Apache
RUN a2enmod rewrite


# Exponha a porta padrão do Apache
EXPOSE 80

# Defina o comando para iniciar o Apache
CMD ["apache2-foreground"]
