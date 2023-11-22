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
<div class="bg-white p-8 rounded shadow-md w-1/5 mx-auto text-center">

            <h2 class="text-2xl font-bold mb-6">Cambiar foto de perfil</h2>

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

            <form action="<?= url_to('editar-perfil-pfp') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>

                <div class="bg-white p-8 rounded mx-auto text-center items-center justify-center">
                    <label for="profile_pic" class="block text-sm font-medium text-gray-600">Selecciona una foto de perfil:</label>
                    <input type="file" id="profile_pic" name="profile_pic" accept="image/*" class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:ring focus:border-blue-300" />
                </div>

                <div class="flex items-center justify-center mt-4">
                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded focus:outline-none focus:ring focus:border-blue-300">Confirmar</button>
                </div>

            </form>
        </div>
    </div>
</body>