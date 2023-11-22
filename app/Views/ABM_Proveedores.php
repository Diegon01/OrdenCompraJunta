<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proveedores</title>
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
        <h1 class="text-4xl font-bold text-center text-blue-500">Listado de proveedores</h1>
        <br><br><br><br>
        <table class="mx-auto border-collapse border border-blue-500 mt-2">
            <thead>
                <tr>
                    <th class="border border-blue-500 px-4 py-2">RUT</th>
                    <th class="border border-blue-500 px-4 py-2">Nombre</th>
                    <th class="border border-blue-500 px-4 py-2">Número de contacto</th>
                    <th class="border border-blue-500 px-4 py-2">Número de cuenta</th>
                    <th class="border border-blue-500 px-4 py-2">Estado de actividad del DGI</th>
                    <th class="border border-blue-500 px-4 py-2">Vencimiento de DGI</th>
                    <th class="border border-blue-500 px-4 py-2">Vencimiento de BPS</th>
                    <th class="border border-blue-500 px-4 py-2">RUPE</th>
                    <th class="border border-blue-500 px-4 py-2">Empresa del estado</th>
                    <th class="border border-blue-500 px-4 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($proveedores as $proveedor): ?>
                    <tr>
                        <td class="border border-blue-500 px-4 py-2"><?= $proveedor['RUT'] ?></td>
                        <td class="border border-blue-500 px-4 py-2"><?= $proveedor['nombre'] ?></td>
                        <td class="border border-blue-500 px-4 py-2"><?= $proveedor['numero_de_contacto'] ?></td>
                        <td class="border border-blue-500 px-4 py-2"><?= $proveedor['numero_de_cuenta'] ?></td>
                        <?php if(isset($estadoActividades[$proveedor['id']])) { ?>
                            <?php if($estadoActividades[$proveedor['id']] === 'AA') { ?>
                            <td class="border border-blue-500 px-4 py-2">Activo</td>
                        <?php }} ?>
                        <?php if(isset($estadoActividades[$proveedor['id']])) { ?>
                            <?php if($estadoActividades[$proveedor['id']] === 'AF') { ?>
                            <td class="border border-blue-500 px-4 py-2">Activo futuro</td>
                        <?php }} ?>
                        <?php if(isset($estadoActividades[$proveedor['id']])) { ?>
                            <?php if($estadoActividades[$proveedor['id']] === 'CC') { ?>
                            <td class="border border-blue-500 px-4 py-2">Cancelado</td>
                        <?php }} ?>
                        <?php if(isset($estadoActividades[$proveedor['id']])) { ?>
                            <?php if($estadoActividades[$proveedor['id']] === 'CH') { ?>
                            <td class="border border-blue-500 px-4 py-2">Cancelado hoy</td>
                        <?php }} ?>
                        <?php if(isset($estadoActividades[$proveedor['id']])) { ?>
                            <?php if($estadoActividades[$proveedor['id']] === 'NT') { ?>
                            <td class="border border-blue-500 px-4 py-2">Nunca tuvo</td>
                        <?php }} ?>
                        <?php if(!isset($estadoActividades[$proveedor['id']])) { ?>
                            <td class="border border-blue-500 px-4 py-2">Error 404</td>
                        <?php } ?>
                        <td class="border border-blue-500 px-4 py-2"><?= $proveedor['fecha_de_vencimiento_dgi'] ?></td>
                        <td class="border border-blue-500 px-4 py-2"><?= $proveedor['fecha_de_vencimiento_bps'] ?></td>
                        <td class="border border-blue-500 px-4 py-2">
                            <?php if ($proveedor['rupe']) : ?>
                                <div class="input-wrapper">
                                    <input type="text" name="nombre_producto[]"
                                        class="mt-1 p-2 w-full border text-center rounded-md text-black placeholder-black"
                                        style="background: transparent;"
                                        readonly
                                        placeholder=""
                                        value="Sí">
                                </div>
                            <?php endif; ?>
                            <?php if (!$proveedor['rupe']) : ?>
                                <div class="input-wrapper">
                                    <input type="text" name="nombre_producto[]"
                                        class="mt-1 p-2 w-full border text-center rounded-md text-black placeholder-black"
                                        style="background: transparent;"
                                        readonly
                                        placeholder=""
                                        value="No">
                                </div>
                            <?php endif; ?>
                        </td>
                        <td class="border border-blue-500 px-4 py-2">
                            <?php if ($proveedor['empresa_del_estado']) : ?>
                                <div class="input-wrapper">
                                    <input type="text" name="nombre_producto[]"
                                        class="mt-1 p-2 w-full border text-center rounded-md text-black placeholder-black"
                                        style="background: transparent;"
                                        readonly
                                        placeholder=""
                                        value="Sí">
                                </div>
                            <?php endif; ?>
                            <?php if (!$proveedor['empresa_del_estado']) : ?>
                                <div class="input-wrapper">
                                    <input type="text" name="nombre_producto[]"
                                        class="mt-1 p-2 w-full border text-center rounded-md text-black placeholder-black"
                                        style="background: transparent;"
                                        readonly
                                        placeholder=""
                                        value="No">
                                </div>
                            <?php endif; ?>
                        </td>
                        <td class="border border-blue-500 px-4 py-2">
                            <!-- Botones de acciones -->
                            <a href="<?= site_url('/editar-proveedor/' . $proveedor['id']) ?>" class="text-blue-500 hover:underline text-lg font-semibold">Editar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>