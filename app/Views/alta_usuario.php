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
            <h2 class="text-2xl font-bold mb-6"><?= lang('Auth.register') ?></h2>

            <?php if (session('error') !== null) : ?>
                <div class="bg-red-500 text-white p-2 mb-4"><?= session('error') ?></div>
            <?php elseif (session('errors') !== null) : ?>
                <div class="bg-red-500 text-white p-2 mb-4">
                    <?php if (is_array(session('errors'))) : ?>
                        <?php foreach (session('errors') as $error) : ?>
                            <?= $error ?>
                            <br>
                        <?php endforeach ?>
                    <?php else : ?>
                        <?= session('errors') ?>
                    <?php endif ?>
                </div>
            <?php endif ?>

            <form action="<?= url_to('alta-usuario') ?>" method="post">
                <?= csrf_field() ?>

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-600">Correo electrónico:</label>
                    <input type="email" id="email" name="email" class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:ring focus:border-blue-300" value="<?= old('email') ?>" required />
                </div>

                <!-- Username -->
                <div class="mb-4">
                    <label for="username" class="block text-sm font-medium text-gray-600">Nombre de usuario:</label>
                    <input type="text" id="username" name="username" class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:ring focus:border-blue-300" value="<?= old('username') ?>" required />
                </div>

                <div class="mb-4">
                    <label for="nombres" class="block text-sm font-medium text-gray-600">Nombres:</label>
                    <input type="text" id="nombres" name="nombres" class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:ring focus:border-blue-300" value="<?= old('username') ?>" required />
                </div>

                <div class="mb-4">
                    <label for="apellidos" class="block text-sm font-medium text-gray-600">Apellidos:</label>
                    <input type="text" id="apellidos" name="apellidos" class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:ring focus:border-blue-300" value="<?= old('username') ?>" required />
                </div>

                <div class="mb-4">
                    <label for="cedula" class="block text-sm font-medium text-gray-600">Cedula:</label>
                    <input type="text" id="cedula" name="cedula" class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:ring focus:border-blue-300" value="<?= old('username') ?>" required />
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-600">Contraseña:</label>
                    <input type="password" id="password" name="password" class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:ring focus:border-blue-300" required />
                </div>

                <!-- Password (Again) -->
                <div class="mb-4">
                    <label for="password_confirm" class="block text-sm font-medium text-gray-600">Confirmar contraseña:</label>
                    <input type="password" id="password_confirm" name="password_confirm" class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:ring focus:border-blue-300" required />
                </div>

                <div class="flex items-center justify-center mt-4">
                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded focus:outline-none focus:ring focus:border-blue-300"><?= lang('Auth.register') ?></button>
                </div>

            </form>
        </div>
    </div>
</body>