<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitudes</title>
    <!-- Enlaza el archivo CSS compilado de Tailwind CSS -->
    <link href="/css/app.css" rel="stylesheet">
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
        <h1 class="text-4xl font-bold text-center text-blue-500">Panel de administración</h1>
        <br><br><br><br>
        <?php if ($isAdmin) : ?>
            <a href="<?= site_url('/registrar') ?>" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-8 px-4 rounded hover:no-underline box-shadow-hover-dos">
                Dar de alta un Usuario</a>
            <br><br><br><br>
        <?php endif; ?>
        <?php if ($isContador || $isAdmin) : ?>
            <a href="<?= site_url('/alta-proveedor/crear') ?>" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-8 px-4 rounded hover:no-underline box-shadow-hover-dos">
                Dar de alta un Proveedor</a>
            <br><br><br><br>
        <?php endif; ?>     
        <?php if ($isContador || $isAdmin) : ?>
            <a href="<?= site_url('/alta-rubro') ?>" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-8 px-4 rounded hover:no-underline box-shadow-hover-dos">
                Dar de alta un Rubro</a>
            <br><br><br><br>
        <?php endif; ?>
    </div>
</body>
</html>