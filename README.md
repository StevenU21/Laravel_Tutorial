A la hora de empezar un nuevo proyecto con Laravel, tenemos que conocer ciertos comandos para poder ejecutar el proyecto correctamente.

**Instalación**

Para crear un nuevo proyecto de Laravel, primero necesitamos instalar Laravel utilizando Composer. Ejecuta los siguientes comandos en tu terminal:

```
composer global require laravel/installer
```

Una vez instalado, podemos crear un nuevo proyecto de Laravel ejecutando:

```
laravel new nombre-del-proyecto
```

Después de crear el proyecto, podemos ejecutar el servidor de desarrollo de Laravel con el siguiente comando:

```
php artisan serve
```

Si clonamos el proyecto desde GitHub, necesitamos instalar las dependencias de PHP y JavaScript. Ejecuta los siguientes comandos en la terminal:

```
composer install
```

```
npm install && npm run dev
```

También, antes de continuar, debemos hacer una copia del archivo `.env.example` y renombrarlo como `.env` con el siguiente comando:

```
cp .env.example .env
```

Por último, para que Laravel funcione correctamente, generaremos una nueva clave de aplicación con el siguiente comando:

```
php artisan key:generate
```

**Comando make**

El comando `make` nos permite generar diferentes elementos dentro de nuestro proyecto. Estos son algunos ejemplos:

- `make:model`: Crea un nuevo modelo en la carpeta `app/Models` del proyecto. Un modelo representa una tabla de la base de datos y se utiliza para interactuar con los datos de esa tabla.

- `make:controller`: Genera un nuevo controlador en la carpeta `app/Http/Controllers`. Los controladores se utilizan para manejar las solicitudes HTTP y coordinar la lógica de la aplicación. Podemos utilizar opciones como `-mc` para crear el controlador con sus métodos de CRUD o `-resource` para crear un controlador RESTful.

- `make:migration`: Crea una nueva migración en el directorio `database/migrations`. Las migraciones se utilizan para gestionar los cambios en la estructura de la base de datos, como la creación de tablas o la adición de columnas.

- `make:seeder`: Genera un archivo de semillas en el directorio `database/seeders`. Las semillas se utilizan para insertar datos predefinidos en la base de datos durante la fase de desarrollo o para la inicialización de datos.

- `make:factory`: Crea una nueva factoría en el directorio `database/factories`. Las factorías se utilizan para generar datos de prueba y se utilizan en conjunto con las pruebas de unidad o de integración.

- `make:request`: Genera una nueva clase de solicitud en la carpeta `app/Http/Requests`. Las clases de solicitud se utilizan para validar y manejar las solicitudes HTTP entrantes.

**Comandos de la base de datos**

- `migrate`: Ejecuta las migraciones pendientes para aplicar los cambios en la base de datos. Utiliza el comando `migrate` para crear las tablas necesarias en la base de datos.
  
- `migrate:rollback`: Este comando deshace la última migración realizada, eliminando las tablas o modificaciones realizadas en la última ejecución de `migrate`.
  
- `migrate:reset`: Deshace todas las migraciones ejecutadas, eliminando todas las tablas de la base de datos. Es útil cuando necesitas restablecer completamente el estado de la base de datos.

- `migrate:refresh`: Es un comando combinado que deshace todas las migraciones y luego las vuelve a ejecutar. Esto puede ser útil para restablecer la base de datos a su estado inicial y luego volver a aplicar las migraciones.

- `migrate:fresh`: Elimina todas las tablas de la base de datos y luego las vuelve a crear mediante las migraciones. Este comando es similar a `migrate:refresh`, pero en lugar de deshacer todas las migraciones, simplemente elimina todas las tablas.

**Comandos de Semillas (Seeders)**

- `db:seed --class=NombreDelSeeder`: Este comando te permite ejecutar un seeder específico. Si tienes varios seeders definidos, puedes utilizar la opción `--class` para indicar cuál deseas ejecutar.

- `db:seed --force`: Si tienes configurado el modo de producción en tu archivo `AppServiceProvider`, necesitarás utilizar la opción `--force` para ejecutar los seeders en ese entorno. Esto evita que se muestren mensajes de advertencia o confirmación.
  
**Comandos de configuración**

- `route:list`: Muestra una lista de todas las rutas definidas en tu aplicación Laravel. Puedes ver los URI, los controladores asociados y los métodos HTTP admitidos.

- `optimize`: Realiza varias optimizaciones en tu aplicación, como la carga en caché de las rutas y configuraciones, lo cual puede mejorar el rendimiento.

- `config:cache`: Crea un archivo en caché para acelerar el acceso a la configuración de tu aplicación. Este comando es útil después de realizar cambios en la configuración y deseas optimizar el rendimiento.

**Comando tinker**

- `tinker`: Inicia el REPL (Read-Eval-Print Loop) de Laravel, que te permite interactuar con tu aplicación y ejecutar código PHP en un entorno interactivo. Puedes probar consultas de base de datos, llamar a métodos de tus modelos, etc. Este comando es muy útil a la hora de buscar errores o probar alguna funcionalidad.

**Comandos de Optimización**

- `optimize:clear`: Si has ejecutado el comando `config:cache` y necesitas deshacerlo, o simplemente deseas limpiar el archivo de caché de optimización generado, puedes utilizar este comando para borrar el archivo de caché.

- `route:cache`: Este comando cachea todas las rutas definidas en tu aplicación, lo que puede mejorar significativamente el rendimiento al reducir la carga en la generación de URLs.

- `view:clear`: Si has realizado cambios en las vistas y has utilizado el comando `view:cache`, este comando te permitirá borrar el archivo de caché generado y volver a utilizar las vistas sin caché.

**Comandos de Controladores API (API Resource)**

Además del comando `make:controller`, Laravel ofrece un comando específico para crear controladores API resource, que son controladores optimizados para API RESTful. Puedes utilizar el siguiente comando para generar un controlador API resource:

```bash
php artisan make:controller API/NombreController --api
```

Esto generará un controlador dentro de la carpeta `app/Http/Controllers/API` con los métodos necesarios para crear una API RESTful.

**Comandos de Autenticación**

Laravel también proporciona comandos para crear sistemas de autenticación completos. Por ejemplo:

- `php artisan make:auth`: Crea las vistas, rutas y controladores necesarios para un sistema de autenticación básico, que incluye registro, inicio de sesión, restablecimiento de contraseña y más.

- `php artisan ui vue --auth`: Si estás utilizando Vue.js como frontend, puedes utilizar este comando para generar el sistema de autenticación con las vistas y componentes de Vue.js.
