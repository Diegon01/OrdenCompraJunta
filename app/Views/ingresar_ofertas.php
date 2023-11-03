<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido a mi sitio</title>
    <!-- Enlaza el archivo CSS compilado de Tailwind CSS -->
    <link href="/css/app.css" rel="stylesheet">
</head>
<header> 
    <?= view('layout/navbar') ?>
</header>
<body class="bg-gray-100">
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
        <?php foreach ($enlaces as $enlace) { ?>
            <?php foreach ($proveedores as $proveedor) { ?>
                <?php if ($enlace['proveedor_id'] === $proveedor['id']) : ?>
                    <tr class="producto-clone">
                        <td class="text-center px-2 py-1">
                            <div class="input-wrapper">
                                <input type="text" name="nombre_producto[]"
                                    class="mt-1 p-2 w-full border text-center rounded-md text-black placeholder-black"
                                    style="background: transparent;"
                                    readonly
                                    placeholder=""
                                    value="<?= $proveedor['nombre'] ?>">
                            </div>
                        </td>
                        
                         <!--agregar codigo php -->
                         <td class="text-center px-2 py-1">
                            <!-- Botón de apertura del modal -->
                            <button type="button" class="bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded open-modal-btn">
                                Ver
                            </button>
                        </td>

                        <!--agregar codigo php -->
                        <td class="text-center px-2 py-1">
                            <!-- Botón de apertura del modal -->
                            <button type="button" class="bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded open-modal-btn" data-target="modal<?= $proveedor['id'] ?>">
                                Ingresar
                            </button>
                        </td>

                        </td>
                    </tr>
                <?php endif; ?>
        <?php }} ?>
        
        </table>
    </div>
    
  <!-- Modal -->
<div id="modal<?= $proveedor['id'] ?>" class="modal hidden fixed inset-0 flex items-center justify-center z-50">
    <div class="modal-content bg-white border border-gray-300 shadow-md rounded-lg p-6 w-3/4">

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

        <button class="close absolute top-4 right-4 text-gray-600 text-3xl" onclick="closeModal('modal<?= $proveedor['id'] ?>')">&times;</button>
        <div id="modalContent<?= $proveedor['id'] ?>"></div>
    </div>
</div>                    

    
    </div>
    </div>
    <br><br>
    <input type="hidden" name="order_id" value="<?= $orden['id'] ?>">
    </form>

    <script>
        // Selecciona todos los botones con la clase open-modal-btn
    const openModalButtons = document.querySelectorAll('.open-modal-btn');

    // Asocia un evento de clic a cada botón para abrir el modal correspondiente
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
    </script>

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