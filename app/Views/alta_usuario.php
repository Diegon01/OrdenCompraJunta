<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <!-- Agrega los estilos de Tailwind CSS desde CDN para este ejemplo -->
    <link href="/css/app.css" rel="stylesheet">
</head>

<header> 
    <?= view('layout/navbar') ?>
</header>

<body class="bg-gray-100">
<div class="bg-gray-100 h-screen flex justify-center items-center">
    <div class="bg-white p-8 rounded shadow-md max-w-md w-full text-center">
        <h2 class="text-2xl font-bold mb-6">Registro de Usuario</h2>
        <form action="/alta-usuario" method="POST">
            <?= csrf_field() ?>

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-600">Correo electrónico:</label>
                <input type="email" id="email" name="email"
                    class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:ring focus:border-blue-300">
            </div>

            <div class="mb-4">
                <label for="username" class="block text-sm font-medium text-gray-600">Nombre de usuario:</label>
                <input type="text" id="username" name="username"
                    class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:ring focus:border-blue-300">
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-600">Contraseña:</label>
                <input type="password" id="password" name="password"
                    class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:ring focus:border-blue-300">
            </div>

            <div class="mb-4">
                <label for="password_confirm" class="block text-sm font-medium text-gray-600">Confirmar contraseña:</label>
                <input type="password" id="password_confirm" name="password_confirm"
                    class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:ring focus:border-blue-300">
            </div>

            <div class="mb-4">
                <label for="nombre" class="block text-sm font-medium text-gray-600">Nombres:</label>
                <input type="text" id="nombre" name="nombre"
                    class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:ring focus:border-blue-300">
            </div>
            <div class="mb-4">
                <label for="apellido" class="block text-sm font-medium text-gray-600">Apellidos:</label>
                <input type="text" id="apellido" name="apellido"
                    class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:ring focus:border-blue-300">
            </div>
            <div class="mb-4">
                <label for="cedula" class="block text-sm font-medium text-gray-600">Cédula:</label>
                <input type="text" id="cedula" name="cedula"
                    class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:ring focus:border-blue-300">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-600 text-center">Roles:</label>
                <div class="mt-2 space-x-2 flex justify-center items-center">
                    <label class="inline-flex items-center">
                        <input type="checkbox" class="form-checkbox text-blue-500">
                        <span class="ml-2">Contador</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="checkbox" class="form-checkbox text-blue-500">
                        <span class="ml-2">Secretario</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="checkbox" class="form-checkbox text-blue-500">
                        <span class="ml-2">Presidente</span>
                    </label>
                </div>
            </div>
            <div class="flex items-center justify-center mt-4">
                <button type="submit"
                    class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded focus:outline-none focus:ring focus:border-blue-300">
                    Registrar Usuario
                </button>
            </div>
        </form>
    </div>
    </div>
</body>