<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elección de ofertas</title>
    <!-- Enlaza el archivo CSS compilado de Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <header>
        <?= view('layout/navbar') ?>
    </header>

    <div class="bg-white p-2 mt-8 mx-auto w-1/2 rounded-md">
            <br><br>

            <div class="productos-container p-0">
                <label class="font-semibold text-2xl pb-2 block text-center">Posibles proveedores:</label>
                <table class="w-full px-2 py-1">
                    <tr>
                        <th class="font-semibold text-center sticky top-0 bg-white z-10">Nombre</th>
                        <th class="font-semibold text-center sticky top-0 bg-white z-10">Detalle de Proveedor</th>
                        <th class="font-semibold text-center sticky top-0 bg-white z-10">Ofertas</th>
                        <th class="font-semibold text-center sticky top-0 bg-white z-10">Acciones</th>
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
                                            Ver
                                        </button>
                                    </td>

                                    <td class="text-center px-2 py-1">
                                        <!-- Botón de apertura del modal -->
                                        <form action="<?= base_url('eleccion-oferta') ?>" method="POST">
                                            <input type="hidden" name="order_id" value="<?= $orden['id'] ?>">
                                            <input type="hidden" name="prov_id" value="<?= $proveedor['id'] ?>">
                                            <div class="mt-0 py-8 text-center">
                                                <button id="ingresarBtn" type="submit" class="bg-green-500 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded">Elegir esta oferta</button>
                                            </div>
                                        </form>
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
                <div id="modal<?= $proveedorId ?>" class="modal hidden fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50">
                    <div class="modal-content bg-white border border-gray-300 shadow-md rounded-lg p-6 w-3/4">
                    <button type="button" class="top-4 right-4 text-red-600 text-3xl" onclick="closeModal('modal<?= $proveedorId ?>')">&times;</button>
                        <div class="productos-container p-0">
                            <br>
                            <label class="font-semibold text-2xl pb-2 block text-center">Mostrando oferta de <?= $proveedorNombre ?>:</label>
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
                                    foreach ($ofertas as $oferta) {
                                        if (($oferta['producto_id'] === $producto['id']) && ($oferta['proveedor_id'] === $proveedor['id'])) :
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
                                                    style="background: transparent;"
                                                    readonly
                                                    placeholder=""
                                                    value="<?= $oferta['precio_oferta'] ?>">
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="input-wrapper">
                                                <input type="number" name="precio_total_producto[]"
                                                    class="mt-1 p-2 w-full border text-center rounded-md text-black placeholder-black"
                                                    style="background: transparent;"
                                                    readonly
                                                    placeholder=""
                                                    value="<?= $oferta['precio_oferta'] * $producto['cantidad'] ?>">
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="input-wrapper">
                                                <input type="text" name="notas_producto[]"
                                                    class="mt-1 p-2 w-full border text-center rounded-md text-black placeholder-black"
                                                    style="background: transparent;"
                                                    readonly
                                                    placeholder=""
                                                    value="<?= $oferta['notas'] ?>">
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endif; ?>
                                <?php
                                }}
                                ?>
                            </table>
                            <br><br>
                            <div id="modalContent<?= $proveedorId ?>"></div>
                        </div>
                    </div>
                </div>


                    <!-- Ver Modal -->
                    <div id="vermodal<?= $proveedorId ?>" class="modal hidden fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50">
                        <div class="modal-content bg-white p-4 rounded shadow-lg w-1/4 mx-auto my-16">
                        <button type="button" class="top-4 right-4 text-red-600 text-3xl" onclick="closeModal('vermodal<?= $proveedorId ?>')">&times;</button>
                        <h1 class="text-2xl font-semibold mb-2 text-center">Detalles de <?= $proveedorNombre ?>:</h1>
            
                        <div class="mb-4 flex items-center">
                            <input type="text" id="idProveedor" name="idProveedor" class="mt-1 p-2 w-full border rounded" style="display: none;" readonly>
                        </div>

                        <div class="mb-4 flex items-center">
                            <label for="personaContacto" class="block text-sm font-medium text-gray-600 w-[150px] text-left">Persona de Contacto</label>
                            <input type="text" id="personaContacto" name="personaContacto" class="mt-1 p-2 w-full border rounded" value="<?= $proveedor['persona_de_contacto'] ?>" readonly>
                        </div>

                        <div class="mb-4 flex items-center">
                            <label for="numeroContacto" class="block text-sm font-medium text-gray-600 w-[150px] text-left">Número de Contacto</label>
                            <input type="text" id="numeroContacto" name="numeroContacto" class="mt-1 p-2 w-full border rounded" value="<?= $proveedor['numero_de_contacto'] ?>" readonly>
                        </div>

                        <div class="mb-4 flex items-center">
                            <label for="rut" class="block text-sm font-medium text-gray-600 w-[150px] text-left">RUT</label>
                            <input type="text" id="rut" name="rut" class="ml-2 mt-1 p-2 pr-5 w-full border rounded" value="<?= $proveedor['RUT'] ?>" readonly>
                        </div>

                        <div class="mb-4 flex items-center">
                            <label for="numeroCuenta" class="block text-sm font-medium text-gray-600 w-[150px] text-left">Número de Cuenta</label>
                            <input type="text" id="numeroCuenta" name="numeroCuenta" class="mt-1 p-2 w-full border rounded" value="<?= $proveedor['numero_de_cuenta'] ?>" readonly>
                        </div> 

                        <div class="mb-4 flex items-center">
                            <label for="fechaVencimientoDgi" class="block text-sm font-medium text-gray-600 w-[150px] text-left">Fecha de Vencimiento DGI</label>
                            <input type="date" id="fechaVencimientoDgi" name="fechaVencimientoDgi" class="mt-1 p-2 w-full border rounded" value="<?= $proveedor['fecha_de_vencimiento_dgi'] ?>" readonly>
                        </div>

                        <div class="mb-4 flex items-center">
                            <label for="fechaVencimientoBps" class="block text-sm font-medium text-gray-600 w-[150px] text-left">Fecha de Vencimiento BPS</label>
                            <input type="date" id="fechaVencimientoBps" name="fechaVencimientoBps" class="mt-1 p-2 w-full border rounded" value="<?= $proveedor['fecha_de_vencimiento_bps'] ?>" readonly>
                        </div>

                        <div class="mt-8 space-x-2 flex justify-center items-center">
                            <div class="inline-flex items-center">
                                <label for="rupe" class="block text-sm font-medium text-gray-600 mr-2">RUPE</label>
                                <?php if ($proveedor['rupe'] === '1') { ?>
                                    <input type="checkbox" id="rupe" name="rupe" class="form-checkbox h-5 w-5 text-blue-600" checked disabled>
                                <?php } ?>
                                <?php if ($proveedor['rupe'] === '0') { ?>
                                    <input type="checkbox" id="rupe" name="rupe" class="form-checkbox h-5 w-5 text-blue-600" disabled>
                                <?php } ?>
                            </div>

                            <div class="inline-flex items-center">
                                <label for="empresaEstado" class="block text-sm font-medium text-gray-600 mr-2">Empresa del Estado</label>
                                <?php if ($proveedor['empresa_del_estado'] === '1') { ?>
                                    <input type="checkbox" id="empresaEstado" name="empresaEstado" class="form-checkbox h-5 w-5 text-blue-600" checked disabled>
                                <?php } ?>
                                <?php if ($proveedor['empresa_del_estado'] === '0') { ?>
                                    <input type="checkbox" id="empresaEstado" name="empresaEstado" class="form-checkbox h-5 w-5 text-blue-600" disabled>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            <?php
            }}
            ?>
            <br><br>
            <input type="hidden" name="order_id" value="<?= $orden['id'] ?>">
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
