# TMDB Client!

# Requisitos

## Windows

Tener instalado [Laragon](https://laragon.org/download/index.html)

## Linux

Tener instalado 

- PHP >= 7.3
- Curl PHP Extension
- Dom PHP Extension 
- Mbstring PHP Extension 
- Pdo_postgres PHP Extension
- Pgsql PHP Extension 
- Postgresql


# Instalación

Clonar el repositorio 

    git clone git@github.com:dragonizado/tmdbclient.git

Ejecutar el comando de instalación y seguir las instrucciones

	cd ./tmdbclient
	sh install.sh

> El archivo install.sh ejecuta en forma secuencial los siguientes
> comandos

	composer install
	php dragonizado --origin=sh
	php artisan migrate
	php artisan serve

> El comando **php dragonizado --origin=sh** es una clase php encargada de generar y configurar el archivo .env, y probar conexión con la base de datos
> 
> **php artisan serve** ejecuta el servidor de Laravel
> 

Ingresar en el navegador la dirección http://localhost:8000/ . En Windows con Laragon instalado es http://tmdbclient.test .

- Para utilizár las funciones de busquedas avanzadas se debe tener una cuenta en el aplicativo.

Demo: http://dragonizado.ddns.net/tmdbclient/