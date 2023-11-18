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
    filter: drop-shadow(0 0 10px rgba(66, 135, 245, 0.90));
    }

    .box-shadow-hover-dos {
    transition: filter 0.3s ease; /* Ajusta la duración y la función de temporización según tus preferencias */
    }
</style>

<body class="bg-gray-100">
    <div class="container mx-auto py-16 text-center">
        <h1 class="text-4xl font-bold text-center text-blue-500">Listado de rubros</h1>
        <br><br><br><br>
        <table class="mx-auto border-collapse border border-blue-500 mt-2">
            <thead>
                <tr>
                    <th class="border border-blue-500 px-4 py-2">Código</th>
                    <th class="border border-blue-500 px-4 py-2">Nombre</th>
                    <th class="border border-blue-500 px-4 py-2">Saldo disponible</th>
                    <th class="border border-blue-500 px-4 py-2">Saldo congelado</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rubros as $rubro): ?>
                    <?php foreach ($rubros_con as $rubro_con): ?>
                        <?php if ($rubro_con['codigo'] === $rubro['codigo']): ?>
                            <tr>
                                <td class="border border-blue-500 px-4 py-2"><?= $rubro['codigo'] ?></td>
                                <td class="border border-blue-500 px-4 py-2"><?= $rubro['nombre'] ?></td>
                                <td class="border border-blue-500 px-4 py-2"><?= $rubro['saldo'] ?></td>
                                <td class="border border-blue-500 px-4 py-2"><?= $rubro_con['saldo_congelado'] ?></td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>