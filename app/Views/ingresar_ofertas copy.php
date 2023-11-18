<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido a mi sitio</title>
    <!-- Enlaza el archivo CSS compilado de Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
</head>
<header> 
    <?= view('layout/navbar') ?>
</header>
<body class="bg-gray-100">
    <form action="/ingreso-oferta" method="POST">
    <br><br>

    <div class="productos-container p-0">
        <label class="font-semibold text-2xl pb-2 block text-center">Posibles proveedores:</label>
        <table class="w-full">
            <tr>
                <th class="pr-4 font-semibold text-center sticky top-0 bg-white z-10">RUT</th>
                <th class="pr-4 font-semibold text-center sticky top-0 bg-white z-10">Proveedor</th>
                <th class="pr-4 font-semibold text-center sticky top-0 bg-white z-10">Número de contacto</th>
                <th class="pr-4 font-semibold text-center sticky top-0 bg-white z-10">Vencimiento del DGI</th>
                <th class="pr-4 font-semibold text-center sticky top-0 bg-white z-10">Vencimiento del BPS</th>
                <th class="pr-4 font-semibold text-center sticky top-0 bg-white z-10">RUPE</th>
                <th class="pr-4 font-semibold text-center sticky top-0 bg-white z-10">Empresa estatal</th>

            </tr>
        <?php foreach ($enlaces as $enlace) { ?>
            <?php foreach ($proveedores as $proveedor) { ?>
                <?php if ($enlace['proveedor_id'] === $proveedor['id']) : ?>
                    <tr class="producto-clone">
                        <td class="text-center">
                            <div class="input-wrapper">
                                <input type="text" name="nombre_producto[]"
                                    class="mt-1 p-2 w-full border text-center rounded-md text-black placeholder-black"
                                    style="background: transparent;"
                                    readonly
                                    placeholder=""
                                    value="<?= $proveedor['RUT'] ?>">
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="input-wrapper">
                                <input type="text" name="nombre_producto[]"
                                    class="mt-1 p-2 w-full border text-center rounded-md text-black placeholder-black"
                                    style="background: transparent;"
                                    readonly
                                    placeholder=""
                                    value="<?= $proveedor['nombre'] ?>">
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="input-wrapper">
                                <input type="text" name="nombre_producto[]"
                                    class="mt-1 p-2 w-full border text-center rounded-md text-black placeholder-black"
                                    style="background: transparent;"
                                    readonly
                                    placeholder=""
                                    value="<?= $proveedor['numero_de_contacto'] ?>">
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="input-wrapper">
                                <input type="text" name="nombre_producto[]"
                                    class="mt-1 p-2 w-full border text-center rounded-md text-black placeholder-black"
                                    style="background: transparent;"
                                    readonly
                                    placeholder=""
                                    value="<?= date('Y-m-d', strtotime($proveedor['fecha_de_vencimiento_dgi'])) ?>">
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="input-wrapper">
                                <input type="text" name="nombre_producto[]"
                                    class="mt-1 p-2 w-full border text-center rounded-md text-black placeholder-black"
                                    style="background: transparent;"
                                    readonly
                                    placeholder=""
                                    value="<?= date('Y-m-d', strtotime($proveedor['fecha_de_vencimiento_bps'])) ?>">
                            </div>
                        </td>
                        <td class="text-center">
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
                        <td class="text-center">
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
                    </tr>
                <?php endif; ?>
        <?php }} ?>
        </table>
    </div>

    <div class="productos-container p-0">
        <?php foreach ($enlaces as $enlace) { ?>
            <?php foreach ($proveedores as $index => $proveedor) { ?>
                <?php if ($enlace['proveedor_id'] === $proveedor['id']) : ?>
                    <br>
                    <label class="font-semibold text-2xl pb-2 block text-center">Ingresar oferta de <?= $proveedor['nombre'] ?>:</label>
                    <table class="w-full">
                        <tr>
                            <th class="pr-4 font-semibold text-center sticky top-0 bg-white z-10">Producto</th>
                            <th class="pr-4 font-semibold text-center sticky top-0 bg-white z-10">Precio unitario ofrecido</th>
                            <th class="pr-4 font-semibold text-center sticky top-0 bg-white z-10">Precio total ofrecido</th>
                            <th class="pr-4 font-semibold text-center sticky top-0 bg-white z-10">Notas</th>
                        </tr>

                        <?php 
                            $totalPrecioEstimado = 0;
                            foreach ($productos as $key => $producto) { 
                                $totalPrecioEstimado += $producto['precio_estimado'] * $producto['cantidad'];
                                $precio_multiplicado = $producto['precio_estimado'] * $producto['cantidad']; ?>
                                                    <input type="hidden" name="id_proveedor[]" value="<?= $proveedor['id'] ?>">

                            <tr class="producto-clone">
                                <input type="hidden" name="id_producto[]" value="<?= $producto['id'] ?>">
                                <td class="text-center">
                                    <div class="input-wrapper">
                                        <input type="text" name="nombre_producto[]"
                                            class="mt-1 p-2 w-full border text-center rounded-md text-black placeholder-black"
                                            style="background: transparent;"
                                            readonly
                                            placeholder="<?= $producto['nombre'] ?>"
                                            value="<?= $producto['nombre'] ?>">
                                    </div>
                                </td>
                                <td class="text-center">
                                    <input type="hidden" name="cant_producto[]" value="<?= $producto['cantidad'] ?>">
                                    <div class="input-wrapper">
                                        <input type="number" name="precio_producto[]"
                                            class="mt-1 p-2 w-full border text-center rounded-md text-black placeholder-black"
                                            placeholder=""
                                            value=""
                                            oninput="calculateTotal(this, 'precio_total_producto[]')">
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="input-wrapper">
                                        <input type="number" name="precio_total_producto[]"
                                            class="mt-1 p-2 w-full border text-center rounded-md text-black placeholder-black"
                                            style="background: transparent;"
                                            readonly
                                            placeholder=""
                                            value="">
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="input-wrapper">
                                        <input type="text" name="notas_producto[]"
                                            class="mt-1 p-2 w-full border text-center rounded-md text-black placeholder-black"
                                            placeholder=""
                                            value="">
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>
                <?php endif; ?>
        <?php }} ?>

        <div class="mt-0 py-8 text-center">
            <button id="ingresarBtn" type="submit" class="bg-green-500 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded">Ingresar</button>
        </div>

    </div>
    <br><br>
    <input type="hidden" name="order_id" value="<?= $orden['id'] ?>">
    </form>

    <script>
        function calculateTotal(input, targetName) {
            // Obtén el valor ingresado en el primer input
            const precioProducto = parseFloat(input.value);
            const cantidadInput = input.closest('tr').querySelector(`input[name^="cant_producto"]`);
            const cantidadProducto = parseFloat(cantidadInput.value);

            // Realiza el cálculo (en este caso, multiplica por 2)
            const precioTotal = precioProducto * cantidadProducto;

            // Busca el input de precio_total_producto por su nombre
            const precioTotalInput = input.closest('tr').querySelector(`input[name="${targetName}"]`);

            if (precioTotalInput) {
                // Actualiza el valor del input precio_total_producto
                precioTotalInput.value = precioTotal;
            }
        }
    </script>
</body>
</html>