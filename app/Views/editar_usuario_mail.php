<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar perfil</title>
    <!-- Agrega los estilos de Tailwind CSS desde CDN para este ejemplo -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
</head>

<header> 
    <?= view('layout/navbar') ?>
</header>

<body class="bg-gray-100">
<div class="bg-gray-100 h-screen flex justify-center items-center">
<div class="bg-white p-8 rounded shadow-md w-2/5 mx-auto text-center">

            <h2 class="text-2xl font-bold mb-6">Cambio de Contraseña</h2>

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

            <form action="<?= url_to('editar-perfil-a') ?>" method="post">
                <?= csrf_field() ?>
                
                <!-- Password -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-600">Nueva contraseña:</label>
                    <input type="password" id="password" name="password" class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:ring focus:border-blue-300" required />
                </div>

                <!-- Password (Again) -->
                <div class="mb-4">
                    <label for="password_confirm" class="block text-sm font-medium text-gray-600">Confirmar contraseña:</label>
                    <input type="password" id="password_confirm" name="password_confirm" class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:ring focus:border-blue-300" required />
                </div>

                <div class="flex items-center justify-center mt-4">
                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded focus:outline-none focus:ring focus:border-blue-300">Confirmar</button>
                </div>

                

            </form>
        </div>
    </div>
</body>