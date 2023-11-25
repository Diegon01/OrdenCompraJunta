<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver usuarios</title>
    <!-- Enlaza el archivo CSS compilado de Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
</head>
<header> 
    <?= view('layout/navbar') ?>
</header>

<style>
    .box-shadow-hover-dos:hover {
    filter: drop-shadow(0 0 10px rgba(66, 135, 245, 0.90));
    }

    .box-shadow-hover-dos {
    transition: filter 0.3s ease; /* Ajusta la duración y la función de temporización según tus preferencias */
    }
</style>

<body class="bg-gray-100">
    <div class="container mx-auto py-16 text-center">
        <h1 class="text-4xl font-bold text-center text-blue-500">Listado de usuarios</h1>
        <br><br><br><br>
        <table class="mx-auto border-collapse border border-blue-500 mt-2">
            <thead>
                <tr>
                    <th class="border border-blue-500 px-4 py-2 bg-blue-100 sticky top-0">Nombre</th>
                    <th class="border border-blue-500 px-4 py-2 bg-blue-100 sticky top-0">DNI</th>
                    <th class="border border-blue-500 px-4 py-2 bg-blue-100 sticky top-0">Correo electrónico</th>
                    <th class="border border-blue-500 px-4 py-2 bg-blue-100 sticky top-0">Roles</th>
                    <th class="border border-blue-500 px-4 py-2 bg-blue-100 sticky top-0">Última vez activo</th>
                    <th class="border border-blue-500 px-4 py-2 bg-blue-100 sticky top-0">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $usuario): ?>
                    <tr>
                        <td class="border border-blue-500 px-4 py-2"><?= $usuario->nombres ?> <?= $usuario->apellidos ?></td>
                        <td class="border border-blue-500 px-4 py-2"><?= $usuario->cedula ?></td>
                        <td class="border border-blue-500 px-4 py-2"><?= $usuario->secret ?></td>
                        <td class="border border-blue-500 px-4 py-2">
                            <?php if ($usuario->Funcionario === '1') { ?>
                                ⋄ Funcionario<br>
                            <?php } ?>
                            <?php if ($usuario->Contador === '1') { ?>
                                ⋄ Contador<br>
                            <?php } ?>
                            <?php if ($usuario->Presidente === '1') { ?>
                                ⋄ Presidente<br>
                            <?php } ?>
                            <?php if ($usuario->Secretario === '1') { ?>
                                ⋄ Secretario<br>
                            <?php } ?>
                            <?php if ($usuario->Admin === '1') { ?>
                                ⋄ Administrador<br>
                            <?php } ?>
                        </td>
                        <td class="border border-blue-500 px-4 py-2"><?= $usuario->last_active ?></td>
                        <td class="border border-blue-500 px-4 py-2">
                            <!-- Botones de acciones -->
                            <a href="<?= site_url('/editar-usuario/' . $usuario->id) ?>" class="text-blue-500 hover:underline text-lg font-semibold">Editar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>