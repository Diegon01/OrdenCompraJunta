<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <!-- Agrega los estilos de Tailwind CSS desde CDN para este ejemplo -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
</head>

<header> 
    <?= view('layout/navbar') ?>
</header>

<body class="bg-gray-100">
<div class="bg-gray-100 h-screen flex justify-center items-center">
<div class="bg-white p-8 rounded shadow-md w-2/5 mx-auto text-center border border-blue-200" style="filter: drop-shadow(0 0 10px rgba(66, 135, 245, 0.50));">

            <h2 class="text-2xl font-bold mb-6">Dar de alta nuevo usuario</h2>

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

            <form action="<?= url_to('alta-usuario') ?>" method="post" enctype="multipart/form-data">
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
                    <input type="number" id="cedula" min="10000000" max="99999999" name="cedula" class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:ring focus:border-blue-300" value="<?= old('username') ?>" required />
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <input type="password" id="password" name="password" class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:ring focus:border-blue-300" value="Contrasenia123" hidden />
                </div>

                <!-- Password (Again) -->
                <div class="mb-4">
                    <input type="password" id="password_confirm" name="password_confirm" class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:ring focus:border-blue-300" value="Contrasenia123" hidden />
                </div>

                <div class="bg-white p-8 rounded w-3/5 mx-auto text-center items-center justify-center">
                    <label for="profile_pic" class="block text-sm font-medium text-gray-600">Selecciona una foto de perfil:</label>
                    <input type="file" id="profile_pic" name="profile_pic" accept="image/*" class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:ring focus:border-blue-300" />
                </div>

                <!-- Checkboxes -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-600">Selecciona los roles:</label>
                    <div class="flex items-center space-x-4 flex justify-center items-center">
                        <label for="Funcionario" class="inline-flex items-center">
                            <input type="checkbox" id="Funcionario" name="Funcionario" value="Funcionario" class="form-checkbox text-blue-500" checked hidden />
                        </label>
                        <label for="Contador" class="inline-flex items-center">
                            <input type="checkbox" id="Contador" name="Contador" value="Contador" class="form-checkbox text-blue-500" />
                            <span class="ml-2">Contador</span>
                        </label>
                        <label for="Presidente" class="inline-flex items-center">
                            <input type="checkbox" id="Presidente" name="Presidente" value="Presidente" class="form-checkbox text-blue-500" />
                            <span class="ml-2">Presidente</span>
                        </label>
                        <label for="Secretario" class="inline-flex items-center">
                            <input type="checkbox" id="Secretario" name="Secretario" value="Secretario" class="form-checkbox text-blue-500" />
                            <span class="ml-2">Secretario</span>
                        </label>
                        <label for="Admin" class="inline-flex items-center">
                            <input type="checkbox" id="Admin" name="Admin" value="Admin" class="form-checkbox text-blue-500" />
                            <span class="ml-2">Administrador</span>
                        </label>
                    </div>
                </div>

                <div class="flex items-center justify-center mt-4">
                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded focus:outline-none focus:ring focus:border-blue-300">Registrar</button>
                </div>

                

            </form>
        </div>
    </div>
</body>