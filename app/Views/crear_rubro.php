<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta de Rubro</title>
    <!-- Agrega los estilos de Tailwind CSS -->
    <link href="/css/app.css" rel="stylesheet">
</head>

<body class="bg-gray-100 h-screen flex justify-center items-center">
    <div class="bg-white p-8 rounded shadow-md max-w-md w-full text-center">
        <h1 class="text-2xl font-semibold mb-6 text-center">Alta de Rubro</h1>

        
        <form class="text-left">

            <!-- Campo Nombre -->
            <div class="mb-4">
                <label for="nombre" class="block text-sm font-medium text-gray-600">Nombre:</label>
                <input type="text" id="nombre" name="nombre" class="mt-1 p-2 w-full border rounded">
            </div>

            <!-- Campo Código -->
            <div class="mb-4">
                <label for="codigo" class="block text-sm font-medium text-gray-600">Código:</label>
                <input type="text" id="codigo" name="codigo" class="mt-1 p-2 w-full border rounded">
            </div>

            <!-- Campo Saldo -->
            <div class="mb-4">
                <label for="saldo" class="block text-sm font-medium text-gray-600">Saldo:</label>
                <input type="number" id="saldo" name="saldo" class="mt-1 p-2 w-full border rounded">
            </div>

            <!-- Botón de enviar -->
            <div class="flex justify-center">
                <button type="submit"
                    class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded focus:outline-none focus:ring focus:border-blue-300">
                    Crear Rubro
                </button>
            </div>
        </form>
    </div>

</body>
