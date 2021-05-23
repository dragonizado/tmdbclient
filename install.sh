#!/bin/bash
composer install

if [ -f "./.env" ]; then
    echo "Archivo correcto"
else
	cp .env.example .env
    php artisan key:generate
    echo "Se ha creado el .env correctamente"
fi
php dragonizado --origin=sh
echo "Instalacion correcta"
php artisan serve

