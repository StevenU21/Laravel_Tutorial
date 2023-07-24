A la hora de empezar un nuevo proyecto con Laravel tenemos que conocer ciertos comandos para poder ejecutar el proyecto correctamente.

**Instalación**

  Instalar Laravel utilizando Composer:
```composer global require laravel/installer```
-  Crear un nuevo proyecto de Laravel:
   `laravel new nombre-del-proyecto`
- Ejecutar el servidor de desarrollo de Laravel:
	`php artisan serve`

Si clonamos el proyecto desde GitHub tenemos que instalar las dependencias de PHP y JavaScript con`composer install` y `npm install`

También hay que hacer una copia del archivo .env.example, lo podemos hacer con el siguiente comando: `cp .env.example .env`

Por ultimo tenemos que generar una nueva clave de aplicación con el siguiente comando: `php artisan key:generate`

**Comando make**
-  `make:model`: Crea un nuevo modelo en la carpeta `app/Models` del proyecto. Un modelo representa una tabla de la base de datos y se utiliza para interactuar con los datos de esa tabla.
    
-  `make:controller`: Genera un nuevo controlador en la carpeta `app/Http/Controllers`. Los controladores se utilizan para manejar las solicitudes HTTP y coordinar la lógica de la aplicación.
    
-  `make:migration`: Crea una nueva migración en el directorio `database/migrations`. Las migraciones se utilizan para gestionar los cambios en la estructura de la base de datos, como la creación de tablas o la adición de columnas.
    
-  `make:seeder`: Genera un archivo de semillas en el directorio `database/seeders`. Las semillas se utilizan para insertar datos predefinidos en la base de datos durante la fase de desarrollo o para la inicialización de datos.
    
-  `make:factory`: Crea una nueva factoría en el directorio `database/factories`. Las factorías se utilizan para generar datos de prueba y se utilizan en conjunto con las pruebas de unidad o de integración.
    
-  `make:request`: Genera una nueva clase de solicitud en la carpeta `app/Http/Requests`. Las clases de solicitud se utilizan para validar y manejar las solicitudes HTTP entrantes.

**Comandos de la base de datos**
- `migrate`: Ejecuta las migraciones pendientes para aplicar los cambios en la base de datos. Utiliza el comando `migrate` para crear las tablas necesarias en la base de datos.

- `db:seed`: Ejecuta las clases de semillas (seeds) para insertar datos predefinidos en la base de datos. Puedes usar este comando después de haber creado las tablas mediante las migraciones.

**Comandos de configuración**
- `route:list`: Muestra una lista de todas las rutas definidas en tu aplicación Laravel. Puedes ver los URI, los controladores asociados y los métodos HTTP admitidos.

- `optimize`: Realiza varias optimizaciones en tu aplicación, como la carga en caché de las rutas y configuraciones, lo cual puede mejorar el rendimiento.

- `config:cache`: Crea un archivo en caché para acelerar el acceso a la configuración de tu aplicación. Este comando es útil después de realizar cambios en la configuración y deseas optimizar el rendimiento.

**Comando tinker**
- `tinker`: Inicia el REPL (Read-Eval-Print Loop) de Laravel, que te permite interactuar con tu aplicación y ejecutar código PHP en un entorno interactivo. Puedes probar consultas de base de datos, llamar a métodos de tus modelos, etc. Este comando es muy útil a la hora de buscar errores o probar alguna funcionalidad.
