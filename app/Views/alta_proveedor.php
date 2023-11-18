<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta de Proveedor</title>
    <!-- Agrega los estilos de Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
</head>

<header> 
    <?= view('layout/navbar') ?>
</header>

<body class="bg-gray-100">
    <div class="h-screen flex justify-center items-center">
        <div class="bg-white p-8 rounded shadow-md max-w-md w-full text-center">
            <h1 class="text-2xl font-semibold mb-6 text-center">Alta de Proveedor</h1>

        <!-- Formulario para el alta de proveedor -->
        <form action="/alta-proveedor/pasouno" method="POST">

 
            <!-- Campo RUT -->
            <div class="mb-4 flex items-center">
                <label for="rut" class="block text-sm font-medium text-gray-600 w-[150px] text-left">RUT</label>
                <input type="numer" min="100000000000" max="999999999999"id="rut" name="rut" class="ml-2 mt-1 p-2 pr-5 w-full border rounded">
            </div>


            <!-- Botón de enviar -->
            <div class="flex justify-center mt-8">
                <button type="submit"
                    class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded focus:outline-none focus:ring focus:border-blue-300">
                    Verificar RUT
                </button>
            </div>
        </form>
    </div>
    </div>
</body>
