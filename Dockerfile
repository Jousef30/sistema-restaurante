# Usar imagen base de PHP con Apache
FROM php:8.2-apache

# Habilitar extensiones necesarias (como mysqli para MySQL)
RUN docker-php-ext-install mysqli

# Copiar los archivos del proyecto al directorio de Apache
COPY . /var/www/html/

# Dar permisos si es necesario
RUN chown -R www-data:www-data /var/www/html

# Exponer el puerto 80 (Render espera este puerto)
EXPOSE 80
