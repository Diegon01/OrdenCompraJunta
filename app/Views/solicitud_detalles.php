<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta de Proveedor</title>
    <!-- Agrega los estilos de Tailwind CSS -->
    <link href="/css/app.css" rel="stylesheet">
</head>
<header> 
    <?= view('layout/navbar') ?>
</header>
<body class="bg-gray-100">
    <div class="container mx-auto py-16">
        <h1 class="text-4xl font-bold text-center text-blue-500">Solicitud de orden de compra Nº <?= $orden['id'] ?></h1>
        <p class="mt-4 text-lg text-gray-700 text-center">Solicitante: <?= $solicitante->nombres ?> <?= $solicitante->apellidos ?></p>
        <p class="mt-4 text-lg text-gray-700 text-center">Descripción: <?= $orden['descripcion'] ?></p>
        <p class="mt-4 text-lg text-gray-700 text-center">Posibles proveedores: <?= $orden['posibles_proveedores'] ?></p>
        <p class="mt-4 text-lg text-gray-700 text-center">Productos: 
            <?php 
                $totalPrecioEstimado = 0;
                foreach ($productos as $producto) {
                    $totalPrecioEstimado += $producto['precio_estimado'] * $producto['cantidad'];
                    $precio_multiplicado = $producto['precio_estimado'] * $producto['cantidad'];
                    echo '<br>', $producto['nombre'], ' (', $producto['cantidad'], ')<br>Precio estimado por unidad: $', $producto['precio_estimado'], '<br>Precio estimado de (', $producto['cantidad'], ') unidades: $', $precio_multiplicado, '<br>';
                }
                echo '<br>Precio total estimado de la solicitud de compra: $', $totalPrecioEstimado;
            ?>
        </p>
    </div>
</body>
</html>