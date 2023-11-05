<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingreso de ofertas</title>
    <!-- Enlaza el archivo CSS compilado de Tailwind CSS -->
    <link href="/css/app.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <header>
        <?= view('layout/navbar') ?>
    </header>

    <div class="bg-white p-2 mt-8 mx-auto w-1/2 rounded-md">
        <form action="/ingreso-oferta" method="POST">
            <br><br>

            <div class="productos-container p-0">
                <label class="font-semibold text-2xl pb-2 block text-center">Posibles proveedores:</label>
                <table class="w-full px-2 py-1">
                    <tr>
                        <th class="font-semibold text-center sticky top-0 bg-white z-10">Nombre</th>
                        <th class="font-semibold text-center sticky top-0 bg-white z-10">Detalle de Proveedor</th>
                        <th class="font-semibold text-center sticky top-0 bg-white z-10">Ofertas</th>
                    </tr>
                    <?php
                    foreach ($enlaces as $enlace) {
                        foreach ($proveedores as $proveedor) {
                            if ($enlace['proveedor_id'] === $proveedor['id']) :
                                $proveedorId = $proveedor['id'];
                                $proveedorNombre = $proveedor['nombre'];
                    ?>
                                <tr class="proveedor-row">
                                    <td class="text-center px-2 py-1">
                                        <div class="input-wrapper">
                                            <input type="text" name="nombre_producto[]"
                                                class="mt-1 p-2 w-full border text-center rounded-md text-black placeholder-black"
                                                style="background: transparent;"
                                                readonly
                                                placeholder=""
                                                value="<?= $proveedorNombre ?>">
                                        </div>
                                    </td>

                                    <td class="text-center px-2 py-1">
                                        <!-- Botón de apertura del modal -->
                                        <button type="button" class="open-modal-btn bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded"
                                            data-target="vermodal<?= $proveedorId ?>">
                                            Ver
                                        </button>
                                    </td>

                                    <td class="text-center px-2 py-1">
                                        <!-- Botón de apertura del modal -->
                                        <button type="button" class="open-modal-btn bg-blue-500 hover-bg-blue-700 text-white font-semibold py-2 px-4 rounded"
                                            data-target="modal<?= $proveedorId ?>">
                                            Ingresar
                                        </button>
                                    </td>
                                </tr>
                    <?php
                            endif;
                        }
                    }
                    ?>
                </table>
            </div>

            <?php foreach ($enlaces as $enlace) { ?>
            <?php
            foreach ($proveedores as $proveedor) {
                $proveedorId = $proveedor['id'];
                $proveedorNombre = $proveedor['nombre'];
            ?>
            <?php if ($enlace['proveedor_id'] === $proveedor['id']) : ?>
                <!-- Modal -->
                <div id="modal<?= $proveedorId ?>" class="modal hidden fixed inset-0 flex items-center justify-center z-50">
                    <div class="modal-content bg-white border border-gray-300 shadow-md rounded-lg p-6 w-3/4">
                        <div class="productos-container p-0">
                            <br>
                            <label class="font-semibold text-2xl pb-2 block text-center">Ingresar oferta de <?= $proveedorNombre ?>:</label>
                            <table class="w-full">
                                <tr>
                                    <th class="pr-4 font-semibold text-center sticky top-0 bg-white z-10">Producto</th>
                                    <th class="pr-4 font-semibold text-center sticky top-0 bg-white z-10">Precio unitario ofrecido</th>
                                    <th class="pr-4 font-semibold text-center sticky top-0 bg-white z-10">Precio total ofrecido</th>
                                    <th class="pr-4 font-semibold text-center sticky top-0 bg-white z-10">Notas</th>
                                </tr>
                                <?php
                                $totalPrecioEstimado = 0;
                                foreach ($productos as $producto) {
                                    $totalPrecioEstimado += $producto['precio_estimado'] * $producto['cantidad'];
                                    $precioMultiplicado = $producto['precio_estimado'] * $producto['cantidad'];
                                ?>
                                    <input type="hidden" name="id_proveedor[]" value="<?= $proveedorId ?>">
                                    <tr class="producto-row">
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
                                                    placeholder=""
                                                    value=""
                                                    oninput="calculateTotal_inv(this, 'precio_producto[]')">
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
                                <?php
                                }
                                ?>
                            </table>
                            <br><br>
                            <button type="button" class="close absolute top-4 right-4 text-gray-600 text-3xl" onclick="closeModal('modal<?= $proveedorId ?>')">&times;</button>
                            <div id="modalContent<?= $proveedorId ?>"></div>
                        </div>
                    </div>
                </div>


                <!-- Ver Modal -->
                <div id="vermodal<?= $proveedorId ?>" class="modal hidden fixed inset-0 flex items-center justify-center z-50">
                    <div class="modal-content bg-white border border-gray-300 shadow-md rounded-lg p-6 w-3/4">
                        <div class="productos-container p-0">
                            <br>
                            <label class="font-semibold text-2xl pb-2 block text-center">Detalles de <?= $proveedorNombre ?>:</label>
                            Persona de contacto: <?= $proveedor['persona_de_contacto'] ?>
                            <br><br>
                            Número de contacto: <?= $proveedor['numero_de_contacto'] ?>
                            <br><br>
                            RUT: <?= $proveedor['RUT'] ?>
                            <br><br>
                            Número de cuenta: <?= $proveedor['numero_de_cuenta'] ?>
                            <br><br>
                            Fecha de vencimiento de DGI: <?= $proveedor['fecha_de_vencimiento_dgi'] ?>
                            <br><br>
                            Fecha de vencimiento de BPS: <?= $proveedor['fecha_de_vencimiento_bps'] ?>
                            <br><br>
                            <div id="modalContent<?= $proveedorId ?>"></div>
                            <button type="button" class="close absolute top-4 right-4 text-gray-600 text-3xl" onclick="closeModal('vermodal<?= $proveedorId ?>')">&times;</button>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            <?php
            }}
            ?>
            <br><br>
            <input type="hidden" name="order_id" value="<?= $orden['id'] ?>">
            <div class="mt-0 py-8 text-center">
                <button id="ingresarBtn" type="submit" class="bg-green-500 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded">Ingresar</button>
            </div>
        </form>
    </div>

    <script>
        const openModalButtons = document.querySelectorAll('.open-modal-btn');

        openModalButtons.forEach(button => {
            button.addEventListener('click', function() {
                const modalId = this.getAttribute('data-target');
                openModal(modalId);
            });
        });

        function openModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.classList.remove('hidden');
        }

        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.classList.add('hidden');
        }

        function calculateTotal(input, targetName) {
            const precioProducto = parseFloat(input.value);
            const cantidadInput = input.closest('tr').querySelector(`input[name^="cant_producto"]`);
            const cantidadProducto = parseFloat(cantidadInput.value);
            const precioTotal = precioProducto * cantidadProducto;
            const precioTotalInput = input.closest('tr').querySelector(`input[name="${targetName}"]`);

            if (precioTotalInput) {
                precioTotalInput.value = precioTotal;
            }
        }

        function calculateTotal_inv(input, targetName) {
            const precioProducto = parseFloat(input.value);
            const cantidadInput = input.closest('tr').querySelector(`input[name^="cant_producto"]`);
            const cantidadProducto = parseFloat(cantidadInput.value);
            const precioTotal = precioProducto / cantidadProducto;
            const precioTotalInput = input.closest('tr').querySelector(`input[name="${targetName}"]`);

            if (precioTotalInput) {
                precioTotalInput.value = precioTotal;
            }
        }
    </script>
</body>

</html>
