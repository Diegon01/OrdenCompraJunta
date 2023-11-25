<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar rubro</title>
    <!-- Enlace a los estilos de Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
</head>

<header> 
    <?= view('layout/navbar') ?>
</header>

<body class="bg-gray-100">
<div class="max-w-md mx-auto bg-white p-8 rounded shadow-md mt-16 border border-blue-200" style="filter: drop-shadow(0 0 10px rgba(66, 135, 245, 0.50));">
        <h2 class="text-2xl font-semibold mb-4">Editar rubro</h2>
        <!-- Formulario de alta de rubros -->
        <form action="<?= base_url('editar-rubro/aceptar') ?>" method="POST">
            <!-- Campo Código -->
            <div class="mb-4">
                <label for="codigo" class="block text-sm font-medium text-gray-600">Código</label>
                <input type="number" id="codigo" name="codigo" class="mt-1 p-2 border rounded w-full" value=<?= $rubro['codigo'] ?> readonly>
            </div>
            <!-- Campo Nombre -->
            <div class="mb-4">
                <label for="nombre" class="block text-sm font-medium text-gray-600">Nombre</label>
                <input type="text" id="nombre" name="nombre" class="mt-1 p-2 border rounded w-full" value=<?= $rubro['nombre'] ?>>
            </div>
            <!-- Campo Presupuesto -->
            <div class="mb-4">
                <label for="presupuesto" class="block text-sm font-medium text-gray-600">Presupuesto disponible</label>
                <input type="text" id="presupuesto" name="presupuesto" class="mt-1 p-2 border rounded w-full" value=<?= $rubro['saldo'] ?>
                    >
            </div>
            <div class="mb-4">
                <label for="presupuestoc" class="block text-sm font-medium text-gray-600">Presupuesto congelado</label>
                <input type="text" id="presupuestoc" name="presupuestoc" class="mt-1 p-2 border rounded w-full" value=<?= $rubro_con['saldo_congelado'] ?>
                    >
            </div>
            <!-- Botón de Enviar -->
            <div class="mt-6">
                <button type="submit" class="bg-blue-500 text-white p-2 rounded hover:bg-blue-700 focus:outline-none focus:ring focus:border-blue-300">
                    Aceptar cambios
                </button>
            </div>
        </form>
    </div>
</body>

</html>