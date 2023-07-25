**Creando CRUD con Tablas Relacionadas en Laravel**

Este tutorial es una continuación del tutorial de CRUD Básico en el cual creamos una tabla con su respectivo modelo, controlador, rutas y vistas. Ahora, vamos a crear un CRUD para el caso en que una tabla esté relacionada con otra, como es el caso de "Productos" y "Marcas". No voy a crear un CRUD para las Marcas; simplemente las vamos a agregar a través de un seeder. Sin embargo, si tú deseas hacer un CRUD para las Marcas, eres bienvenido, de hecho, te lo dejo como tarea opcional.

### Paso 1: Preparación del Proyecto

1. Crear la migracion y el modelo para las tablas de "Brands" utilizando el comando
```
php artisan make:model Brand -m
```
### Paso 2: Definición de las Migraciones

1. Abrir la migración generada para la tabla "Brands" (`create_brands_table`) y definir los campos necesarios para almacenar las marcas, como el nombre de la marca. 
```
        Schema::create('brands', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 60); // Nombre de la Marca con un Limite de 60 Caracteres
            $table->timestamps();
        });
```
3. Abrir la migración generada para agregar la columna "brand_id" a la tabla "Products" (`add_brand_id_to_products`) y establecer una relación con la tabla "Brands" utilizando la restricción de clave foránea (`foreign`).
```
php artisan make:migration add_brand_id_to_products
```
        Schema::table('products', function (Blueprint $table) {
            $table->integer('brand_id')->unsigned(); // Marca del Producto
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade')->onUpdate('cascade');
        });

### Paso 3: Creación de los Modelos y Relaciones

1. En el modelo "Product", definir la relación de uno a muchos inversa con el modelo "Brand" utilizando el método `belongsTo`.
```
   protected $fillable = ['name', 'description','brand_id']; // Campos que se pueden Llenar
```
    // Relacion uno a muchos
    public function brand() // Relación de uno a muchos inversa
    {
        return $this->belongsTo(Brand::class); // Un Producto pertenece a una Marca
    }
3. En el modelo "Brand", definir la relación de uno a muchos con el modelo "Product" mediante el método `hasMany`.
```
protected $fillable = ['name', 'description']; // Campos que se pueden Llenar
```
    public function products() // Relación de uno a muchos
    {
        return $this->hasMany(Product::class); // Una Marca tiene muchos Productos
    }
### Paso 4: Modificación del Controlador

1. Abrir el controlador "ProductController" y mandamos a llamar al modelo de Brand.
```
use App\Models\Brand; // se importa el modelo
```
2. Metodo Create: En este método, obtenemos todas las marcas disponibles utilizando el modelo "Brand" y pasarlo a la vista de creación de productos.
```
    public function create()
    {
        $brands = Brand::all(); // se obtienen todas las marcas
        return view('products.create', compact('brands')); // se muestra el formulario para crear un producto
    }
```
3. Metodo Store: En este método, es donde primero validamos nuestros campos para despues guardarlos en la base de datos como un registro.
```
    public function store(Request $request)
    {
        $request->validate([ // Valida los campos
            'name' => 'required',
            'description' => 'required',
            'brand_id' => 'required'
        ]);

        Product::create([ // Crea el Producto
            'name' => $request->name, // Guarda el Nombre
            'description' => $request->description, // Guarda la Descripción
            'brand_id' => $request->brand_id // Guarda la Marca
        ]);

        return redirect()->route('products.index')->with('success', 'Producto Creado'); // Retorna a la vista de los Productos
    }
```
4. Metodo Edit: En este método, obtenemos todas las marcas disponibles utilizando el modelo "Brand" y pasarlo a la vista de edición de productos.
```
    public function edit(string $id)
    {
        $product = Product::find($id); // se obtiene el producto con el id que se envia
        $brands = Brand::all(); // se obtienen todas las marcas
        return view('products.edit', compact('product', 'brands')); // se envia el producto a la vista
    }
```
5. Metodo Update: En este método, es donde pasamos actualizar la informacion que ya existe en un registro de la tabla.
```
   public function show(string $id)
    {
        $products = Product::find($id); // se obtiene el producto con el id que se envia
        $brand = $products->brand; // se obtienen todas las marcas
        return view('products.show', compact('products', 'brand')); // se envia el producto y la marca a la vista
    }
```
5. Metodo Show: En este método, es donde visualizamos los detalles del registro.
```
   public function show(string $id)
    {
        $products = Product::find($id); // se obtiene el producto con el id que se envia
        $brand = $products->brand; // se obtienen todas las marcas
        return view('products.show', compact('products', 'brand')); // se envia el producto y la marca a la vista
    }
```
### Paso 5: Modificación de las Vistas

1. En la vista `products/index.blade.php`, mostrar la información de los productos y la marca a la que están asociados.
```
<table class="table table-bordered table-hover fixed-header">
                    <thead>
                        <tr>
                            <th><i class="fas fa-heading text-primary"></i> Nombre</th>
                            <th><i class="fas fa-tag text-info"></i> Marca</th>
                            <th><i class="fas fa-info-circle text-warning"></i> Descripción</th>
                            <th><i class="fas fa-cogs text-secondary"></i> Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td> {{$product->brand->name}} </td>
                                <td>{{ $product->description }}</td>
                                <td>
                                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-primary">
                                        <i class="fas fa-eye"></i> Ver
                                    </a>
                                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-success">
                                        <i class="fas fa-edit"></i> Editar
                                    </a>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fas fa-trash-alt"></i> Eliminar
                                        </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
```
2. En la vista `products/create.blade.php`, añadir un campo select para seleccionar la marca al crear un nuevo producto. Rellenar las opciones con las marcas obtenidas en el controlador.
```
            <div class="mb-3">
                <label for="brand" class="form-label">
                    <i class="fas fa-tag text-info"></i> Marca
                </label>
                <select class="form-control" id="brand" name="brand_id" required>
                    <option value="">Seleccionar Marca</option>
                    @foreach ($brands as $brand)
                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                    @endforeach
                </select>
            </div>
```
3. En la vista `products/edit.blade.php`, añadir un campo select para seleccionar la marca al querer actualizar un nuevo producto. Rellenar las opciones con las marcas obtenidas en el controlador.
```
           <div class="mb-3">
                <label for="brand" class="form-label">
                    <i class="fas fa-tag text-info"></i> Marca
                </label>
                <select class="form-control" id="brand" name="brand_id" required>
                    <option value="">Seleccionar Marca</option>
                    @foreach ($brands as $brand)
                        <option value="{{ $brand->id }}" {{ $brand->id == $product->brand_id ? 'selected' : '' }}>
                            {{ $brand->name }}
                        </option>
                    @endforeach
                </select>
            </div>
```
4. En la vista `products/show.blade.php`, agregamos un nuevo elemento para mostrar las marcas desde la vista show, ahora donde vamos a mostrar la marca relacionada con el producto.
```
                <h6 class="card-subtitle mb-2 text-muted">
                    <i class="fas fa-tag text-info"></i> {{ $brand->name }}
                </h6>
```

### Paso 6: Creación y Modificación del Seeder para la Tabla "brands"

En este paso, crearemos y modificaremos el seeder para la tabla "brands". El objetivo es poblar la tabla "brands" con marcas de ejemplo que serán utilizadas para asociarlas con los productos creados en el paso anterior.

1. **Creación del Seeder para la Tabla "brands":**
Primero, vamos a crear el seeder para la tabla "brands" utilizando el siguiente comando en la terminal:

```
php artisan make:seeder BrandsTableSeeder
```

Esto generará un archivo llamado "BrandsTableSeeder.php" en la carpeta "database/seeders/".

2. **Modificación del Seeder para la Tabla "brands":**

Abre el archivo "BrandsTableSeeder.php" y reemplaza su contenido con el siguiente código:

```php
<?php

namespace Database\Seeders;

use App\Models\Brand; // Importamos el modelo de la tabla "brands"
use Illuminate\Database\Seeder;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Nombres de marcas de ejemplo
        $brandNames = [
            'Google',
            'Apple',
            'Samsung',
            'Huawei',
            'Microsoft',
            'MSI',
            'Asus',
            'Acer',
            'Lenovo',
            // Agrega más nombres de marcas según tus necesidades
        ];

        // Crear registros de marcas de ejemplo en la tabla "brands"
        foreach ($brandNames as $brandName) {
            Brand::create([
                'name' => $brandName,
            ]);
        }
    }
}
```

3. **Ejecutar el Seeder para la Tabla "brands":**
Para ejecutar el seeder y llenar la tabla "brands" con las marcas de ejemplo, utiliza el siguiente comando en la terminal:

```
php artisan db:seed --class=BrandsTableSeeder
```

Esto insertará las marcas de ejemplo en la tabla "brands", y ahora podrás utilizarlas para asociarlas con los productos creados anteriormente en el formulario de creación.

Con este paso completado, tendrás la tabla "brands" poblada con marcas de ejemplo, lo que te permitirá relacionar los productos con las marcas correspondientes en el formulario de creación y edición.

### Paso 7: Conclusiones

En esta última sección, recapitular lo que hemos logrado en este tutorial: un CRUD completamente funcional con tablas relacionadas en Laravel. También se pueden mencionar las mejoras que se pueden implementar y animar a los lectores a seguir aprendiendo y explorando más sobre Laravel y GitHub.

### Fin del Tutorial

En esta guía, hemos aprendido cómo crear un CRUD con tablas relacionadas en Laravel, lo que te permitirá gestionar productos asociados a marcas de manera eficiente. ¡Esperamos que hayas encontrado este tutorial útil y que te haya brindado una visión más profunda de las capacidades de Laravel y el uso de GitHub para compartir tus proyectos!

¡Felicidades por completar el tutorial y feliz codificación!

