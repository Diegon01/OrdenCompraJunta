<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitudes</title>
    <!-- Enlaza el archivo CSS compilado de Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
</head>
<header> 
    <?= view('layout/navbar') ?>
</header>

<style>
    .box-shadow-hover-dos:hover {
    filter: drop-shadow(0 0 25px rgba(66, 135, 245, 0.90));
    }

    .box-shadow-hover-dos {
    transition: filter 0.3s ease; /* Ajusta la duración y la función de temporización según tus preferencias */
    }
</style>

<body class="bg-gray-100">
    <div class="container mx-auto py-16 text-center">
        <h1 class="text-4xl font-bold text-center text-blue-500">Panel de administración</h1>
        

        <div class="container mx-auto py-16 text-center">
            <table class="mx-auto border-collapse border border-transparent mt-2">
                <thead>
                    <tr class="border border-transparent">
                        <?php if ($isAdmin) : ?>
                            <th class="border border-transparent px-4 py-2">Administración de Usuarios</th>
                        <?php endif; ?>
                        <th class="border border-transparent px-4 py-2">Administración de Proveedores</th>
                        <th class="border border-transparent px-4 py-2">Administración de Rubros</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php if ($isAdmin) : ?>
                            <td class="border border-transparent px-4 py-2"> 
                                <br>
                                <a href="<?= site_url('/registrar') ?>" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-4 px-4 rounded hover:no-underline box-shadow-hover-dos">
                                Dar de alta un Usuario</a>
                            </td>
                        <?php endif; ?>
                        <td class="border border-transparent px-4 py-2"> 
                            <br>
                            <a href="<?= site_url('/alta-proveedor/crear') ?>" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-4 px-4 rounded hover:no-underline box-shadow-hover-dos">
                            Dar de alta un Proveedor</a>
                        </td>
                        <td class="border border-transparent px-4 py-2"> 
                            <br>
                            <a href="<?= site_url('/alta-rubro') ?>" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-4 px-4 rounded hover:no-underline box-shadow-hover-dos">
                            Dar de alta un Rubro</a>
                        </td>
                    </tr>
                    <tr>
                        <?php if ($isAdmin) : ?>
                            <td class="border border-transparent px-4 py-2"> 
                                <br>
                                <a href="<?= site_url('/ver-usuarios') ?>" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-4 px-4 rounded hover:no-underline box-shadow-hover-dos">
                                Ver y editar Usuarios</a>
                            </td>
                        <?php endif; ?>
                        <td class="border border-transparent px-4 py-2"> 
                            <br>
                            <a href="<?= site_url('/ver-proveedores') ?>" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-4 px-4 rounded hover:no-underline box-shadow-hover-dos">
                            Ver y editar Proveedores</a>
                        </td>
                        <td class="border border-transparent px-4 py-2"> 
                            <br>
                            <a href="<?= site_url('/ver-rubros') ?>" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-4 px-4 rounded hover:no-underline box-shadow-hover-dos">
                            Ver y editar Rubros</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>