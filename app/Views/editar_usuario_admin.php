<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar usuario</title>
    <!-- Agrega los estilos de Tailwind CSS desde CDN para este ejemplo -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
</head>

<header> 
    <?= view('layout/navbar') ?>
</header>

<body class="bg-gray-100">
<div class="bg-gray-100 h-screen flex justify-center items-center">
<div class="bg-white p-8 rounded shadow-md w-2/5 mx-auto text-center">

            <h2 class="text-2xl font-bold mb-6">Editar usuario</h2>

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

            <form action="<?= base_url('editar-usuario/aceptar') ?>" method="POST">
                <?= csrf_field() ?>

                <input type="hidden" id="idUs" name="idUs" value="<?= $usuario_a->id ?>">

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-600">Correo electrónico:</label>
                    <input type="email" id="email" name="email" class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:ring focus:border-blue-300" value="<?= $usuario_a->secret ?>" required />
                </div>

                <div class="mb-4">
                    <label for="nombres" class="block text-sm font-medium text-gray-600">Nombres:</label>
                    <input type="text" id="nombres" name="nombres" class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:ring focus:border-blue-300" value="<?= $usuario_a->nombres ?>" required />
                </div>

                <div class="mb-4">
                    <label for="apellidos" class="block text-sm font-medium text-gray-600">Apellidos:</label>
                    <input type="text" id="apellidos" name="apellidos" class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:ring focus:border-blue-300" value="<?= $usuario_a->apellidos ?>" required />
                </div>

                <div class="mb-4">
                    <label for="cedula" class="block text-sm font-medium text-gray-600">Cedula:</label>
                    <input type="number" id="cedula" min="10000000" max="99999999" name="cedula" class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:ring focus:border-blue-300" value="<?= $usuario_a->cedula ?>" required />
                </div>

                <!-- Checkboxes -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-600">Selecciona los roles:</label>
                    <div class="flex items-center space-x-4">
                        <label for="Funcionario" class="inline-flex items-center">
                            <?php if ($usuario_a->Funcionario === '1') { ?>
                                <input type="checkbox" id="Funcionario" name="Funcionario" value="Funcionario" class="form-checkbox text-blue-500" checked />
                            <?php } ?>
                            <?php if ($usuario_a->Funcionario === '0') { ?>
                                <input type="checkbox" id="Funcionario" name="Funcionario" value="Funcionario" class="form-checkbox text-blue-500" />
                            <?php } ?>
                            <span class="ml-2">Funcionario</span>
                        </label>
                        <label for="Contador" class="inline-flex items-center">
                            <?php if ($usuario_a->Contador === '1') { ?>
                                <input type="checkbox" id="Contador" name="Contador" value="Contador" class="form-checkbox text-blue-500" checked />
                            <?php } ?>
                            <?php if ($usuario_a->Contador === '0') { ?>
                                <input type="checkbox" id="Contador" name="Contador" value="Contador" class="form-checkbox text-blue-500" />
                            <?php } ?>
                            <span class="ml-2">Contador</span>
                        </label>
                        <label for="Presidente" class="inline-flex items-center">
                            <?php if ($usuario_a->Presidente === '1') { ?>
                                <input type="checkbox" id="Presidente" name="Presidente" value="Presidente" class="form-checkbox text-blue-500" checked />
                            <?php } ?>
                            <?php if ($usuario_a->Presidente === '0') { ?>
                                <input type="checkbox" id="Presidente" name="Presidente" value="Presidente" class="form-checkbox text-blue-500" />
                            <?php } ?>
                            <span class="ml-2">Presidente</span>
                        </label>
                        <label for="Secretario" class="inline-flex items-center">
                            <?php if ($usuario_a->Secretario === '1') { ?>
                                <input type="checkbox" id="Secretario" name="Secretario" value="Secretario" class="form-checkbox text-blue-500" checked />
                            <?php } ?>
                            <?php if ($usuario_a->Secretario === '0') { ?>
                                <input type="checkbox" id="Secretario" name="Secretario" value="Secretario" class="form-checkbox text-blue-500" />
                            <?php } ?>
                            <span class="ml-2">Secretario</span>
                        </label>
                        <label for="Admin" class="inline-flex items-center">
                            <?php if ($usuario_a->Admin === '1') { ?>
                                <input type="checkbox" id="Admin" name="Admin" value="Admin" class="form-checkbox text-blue-500" checked />
                            <?php } ?>
                            <?php if ($usuario_a->Admin === '0') { ?>
                                <input type="checkbox" id="Admin" name="Admin" value="Admin" class="form-checkbox text-blue-500" />
                            <?php } ?>
                        <span class="ml-2">Administrador</span>
                        </label>
                    </div>
                </div>

                <div class="flex items-center justify-center mt-4">
                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded focus:outline-none focus:ring focus:border-blue-300">Aceptar cambios</button>
                </div>

                

            </form>
        </div>
    </div>
</body>