**Crear un CRUD Básico en Laravel**

En este tutorial, aprenderemos cómo crear un CRUD básico en Laravel, lo que implica crear, leer, actualizar y eliminar registros en una base de datos. Seguiremos los siguientes pasos:

**Paso 1: Instalación**
Primero, asegurémonos de tener Laravel instalado. Si no lo tienes, sigue estos pasos:
- Instalar Laravel utilizando Composer:
  `composer global require laravel/installer`
-Para despues hacer:
`laravel new nombreproyecto`

**Paso 2: Configurar el entorno**
Antes de comenzar, asegúrate de haber configurado el archivo `.env` con la información de la base de datos que desees utilizar.

**Paso 3: Crear la Base de Datos**
Crea una nueva base de datos en tu servidor MySQL o cualquier otro sistema de gestión de bases de datos que estés utilizando.

**Paso 4: Crear una Migración**
Laravel utiliza migraciones para gestionar los cambios en la estructura de la base de datos. Ejecuta el siguiente comando para crear una migración para nuestra tabla:

```
php artisan make:migration create_nombretabla_table
```

Esto creará un archivo de migración en el directorio `database/migrations`. Abre el archivo generado y define las columnas que deseas tener en tu tabla. Por ejemplo:

```
public function up()
{
    Schema::create('nombretabla', function (Blueprint $table) {
        $table->id();
        $table->string('nombre');
        $table->string('email')->unique();
        $table->timestamps();
    });
}
```

**Paso 5: Ejecutar las Migraciones**
Para aplicar los cambios definidos en la migración y crear la tabla en la base de datos, ejecuta el siguiente comando:

```
php artisan migrate
```

**Paso 6: Crear el Modelo**
Los modelos en Laravel nos permiten interactuar con la tabla de la base de datos. Ejecuta el siguiente comando para crear un modelo:

```
php artisan make:model NombreModelo
```

Esto generará un archivo en la carpeta `app/Models` que representa el modelo. Abre el archivo y asegúrate de que el modelo tenga la conexión correcta a la tabla en la base de datos y las relaciones si las hay.

**Paso 7: Crear el Controlador**
El controlador manejará las solicitudes HTTP y coordinará la lógica de la aplicación para nuestro CRUD. Ejecuta el siguiente comando para crear el controlador:

```
php artisan make:controller NombreController
```

Esto generará un archivo en la carpeta `app/Http/Controllers`. Abre el controlador y define los métodos necesarios para crear, leer, actualizar y eliminar registros.

Por ejemplo, para el CRUD completo, podemos tener los siguientes métodos:
```
public function index()
{
    // Lógica para mostrar todos los registros
}

public function create()
{
    // Lógica para mostrar el formulario de creación
}

public function store(Request $request)
{
    // Lógica para guardar un nuevo registro
}

public function show($id)
{
    // Lógica para mostrar un registro específico
}

public function edit($id)
{
    // Lógica para mostrar el formulario de edición
}

public function update(Request $request, $id)
{
    // Lógica para actualizar un registro específico
}

public function destroy($id)
{
    // Lógica para eliminar un registro específico
}
```

**Paso 8: Definir las Rutas**
Las rutas son las URL que nuestros usuarios utilizarán para acceder a las diferentes funciones del CRUD. Abre el archivo `routes/web.php` y define las rutas para cada método del controlador.

Por ejemplo:

```
Route::get('/nombretabla', [NombreController::class, 'index'])->name('nombrevista.index'); // Ruta para Mostrar la vista principal
Route::get('/nombretabla/create', [NameController::class, 'create'])->name('nombrevista.create'); // Ruta para la vista Crear
Route::post('/nombretabla', [NameController::class, 'store'])->name('nombretabla.store'); // Ruta para Guardar
Route::get('/nombretabla/{tabla}', [NameController::class, 'show'])->name('nombrevista.show'); // Ruta para Mostrar detalles del Registro
Route::get('/nombretabla/{tabla}/edit', [NameController::class, 'edit'])->name('nombrevista.edit'); // Ruta para la vista Editar
Route::put('/nombretabla/{tabla}', [NameController::class, 'update'])->name('nombretabla.update'); // Ruta para Actualizar
Route::delete('/nombretabla/{tabla}', [NombreController::class, 'destroy'])->name('nombretabla.destroy'); // Ruta para Eliminar
```

Existe una forma mas simplificada para trabajar con las rutas de un crud basico y es la siguiente
```
Route::resource('nombretabla', NombreController::class)->names('nombretabla');
```
Esto hará uso del llamado de todas las peticiones en una sola línea, pero ten cuidado
debes llamar a cada vista tanto en el controlador y las vista en views correctamente para que funcione.

**Paso 9: Crear las Vistas**
Ahora, necesitamos crear las vistas que se utilizarán para mostrar los formularios y los datos. Crea una carpeta `nombretabla` dentro de `resources/views` y crea las vistas necesarias, como `index.blade.php`, `create.blade.php`, `edit.blade.php`, etc.

Dentro de estas vistas, puedes usar el sistema de plantillas Blade de Laravel para mostrar los datos y los formularios.

**Paso 10: Ejecutar el Servidor de Desarrollo**
Una vez que hayas realizado todos los pasos anteriores, puedes ejecutar el servidor de desarrollo de Laravel para ver tu aplicación en acción:

```
php artisan serve
```

¡Listo! Ahora tienes un CRUD básico en Laravel que te permitirá crear, leer, actualizar y eliminar registros en tu base de datos. Puedes acceder a las diferentes rutas definidas en `routes/web.php` para interactuar con tu aplicación.
