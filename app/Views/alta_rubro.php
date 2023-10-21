<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta de Rubros</title>
    <!-- Enlace a los estilos de Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
</head>

<header> 
    <?= view('layout/navbar') ?>
</header>

<body class="bg-gray-100">
<div class="max-w-md mx-auto bg-white p-8 rounded shadow-md mt-16">
        <h2 class="text-2xl font-semibold mb-4">Alta de Rubros</h2>
        <!-- Formulario de alta de rubros -->
        <form action="/rubros/guardar" method="post">
            <!-- Campo Código -->
            <div class="mb-4">
                <label for="codigo" class="block text-sm font-medium text-gray-600">Código</label>
                <input type="text" id="codigo" name="codigo" class="mt-1 p-2 border rounded w-full">
            </div>
            <!-- Campo Nombre -->
            <div class="mb-4">
                <label for="nombre" class="block text-sm font-medium text-gray-600">Nombre</label>
                <input type="text" id="nombre" name="nombre" class="mt-1 p-2 border rounded w-full">
            </div>
            <!-- Campo Presupuesto -->
            <div class="mb-4">
                <label for="presupuesto" class="block text-sm font-medium text-gray-600">Presupuesto</label>
                <input type="text" id="presupuesto" name="presupuesto" class="mt-1 p-2 border rounded w-full"
                    placeholder="Ingrese el presupuesto (ej. 1000,50)">
            </div>
            <!-- Botón de Enviar -->
            <div class="mt-6">
                <button type="submit" class="bg-blue-500 text-white p-2 rounded hover:bg-blue-700 focus:outline-none focus:ring focus:border-blue-300">
                    Guardar Rubro
                </button>
            </div>
        </form>
    </div>
</body>

</html>