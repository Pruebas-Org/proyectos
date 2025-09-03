# Usa una imagen base de PHP con Apache para PHP 8.1
FROM php:8.1-apache

# Actualiza los paquetes e instala las librerías de desarrollo necesarias para intl.
# Eliminamos 'php8.1-mysql' de aquí porque ya lo manejamos con docker-php-ext-install.
RUN apt-get update && \
    apt-get install -y --no-install-recommends \
        libicu-dev \
    && docker-php-ext-install mysqli pdo pdo_mysql intl \
    && a2enmod rewrite \
    && rm -rf /var/lib/apt/lists/*

# Copia la configuración personalizada de Apache
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf

# Copia tu proyecto CodeIgniter al contenedor
COPY . /var/www/html/

# Establece los permisos correctos
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html \
    && chmod -R 775 /var/www/html/writable

# Exponer el puerto 80
EXPOSE 80