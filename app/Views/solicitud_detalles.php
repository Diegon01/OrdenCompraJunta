<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.15/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/interact.js/dist/interact.min.js"></script>
    <style>
        .inputs-container {
            max-height: 270px;
            overflow-y: auto;
            margin-top: 60px;
            margin-bottom: 10px;
            position: relative;
        }

        .descripcion-container {
            max-height: 135px;
            margin-top: 2rem;
            position: relative;
        }

        .bg-gray-100 {
            min-height: 100vh;
        }

        
        textarea[readonly] {
            border: 1px solid #ccc;
            color: #495057;
            border:none;
            height: 160px;
            
        }

        .proveedores-container {
            display: flex;
            justify-content: center;
            gap: 300px; /* Espacio de separación entre los textareas */
        }

        .proveedores-textarea {
            width: 700px; /* Ancho del textarea (ajustado según tus necesidades) */
            height: 300px!important; /* Altura del textarea (ajustado según tus necesidades) */
            padding: 20px; /* Espaciado interno del textarea */
            resize: none; /* Evitar que el textarea sea redimensionable por el usuario */
            overflow-y: auto; /* Mostrar barra de desplazamiento solo cuando sea necesario */
        }
        
    


       
        
        .modal {
            display: none;
        }
        #searchInput {
            margin-bottom: 0.5rem; /* Ajusta este valor según sea necesario */
        }

        .page-container {
            min-height: 100vh; /* Establece la altura del contenedor al 100% del viewport */
        }

        #searchResults {
            display: none;
        }

        #searchResults.active {
            display: block;
        }

    </style>
</head>
<header> 
    <?= view('layout/navbar') ?>
</header>
<body class="bg-gray-100">
    <div class="bg-gray-100 p-2">
    <form action="/contador-aprueba" method="POST">
        <?= csrf_field() ?>
        <div class="page-container bg-gray-200 p-4 pt-8">
            <h1 class="text-3xl font-semibold mb-4 text-center text-blue-500">Solicitud de Orden de Compra Nº <?= $orden['id'] ?></h1>

            <div class="solicitante-container p-4">
                <label class="font-semibold text-2xl text-center pb-2 block">Solicitante:</label>
                <table class="w-auto mx-auto">
                    <tr>
                        <th class="pr-4 font-semibold text-center sticky top-0 bg-white z-10">Cedula</th>
                        <th class="pr-4 font-semibold text-center sticky top-0 bg-white z-10">Nombres y apellidos</th>
                    </tr>

                    <tr class="producto-clone">
                        <td class="text-center">
                            <div class="input-wrapper">
                                <input type="text" name="nombre[]"
                                    class="mt-1 p-2 w-full border text-center rounded-md text-black placeholder-black"
                                    style="background: transparent;"
                                    readonly
                                    placeholder="<?= $solicitante->cedula ?>">
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="input-wrapper">
                                <input type="text" name="precio_estimado[]"
                                    class="mt-1 p-2 w-full border text-center rounded-md text-black placeholder-black"
                                    style="background: transparent;"
                                    readonly
                                    placeholder="<?= $solicitante->nombres ?> <?= $solicitante->apellidos ?>">
                            </div>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="descripcion-container p-1">
                <label class="font-semibold text-2xl mb-2 text-center block">Descripción:</label>
                <div class="flex justify-center items-center"> <!-- El div que centra el contenido verticalmente -->
                    <div class="w-1/2"> <!-- Este div tiene un ancho definido del 50% del ancho del contenedor padre -->
                        <textarea id="descripcion" name="descripcion" class="border-2 p-4 rounded w-full resize-none text-base readonly-input bg-gray-200 text-center"
                            style="background: transparent;" placeholder="No se ha proporcionado una descripción" spellcheck="false" readonly><?= $orden['descripcion'] ?></textarea>
                    </div>
                </div>
            </div>

            <div class="productos-container p-20">
                <label class="font-semibold text-2xl pb-2 block text-center">Productos:</label>
                <table class="w-full">
                    <tr>
                        <th class="pr-4 font-semibold text-center sticky top-0 bg-white z-10">Nombre del producto</th>
                        <th class="pr-4 font-semibold text-center sticky top-0 bg-white z-10">Precio unitario estimado</th>
                        <th class="pr-4 font-semibold text-center sticky top-0 bg-white z-10">Cantidad</th>
                        <th class="pr-4 font-semibold text-center sticky top-0 bg-white z-10">Precio estimado</th>
                        <?php if ($isContador && $orden['Contador_Aprobado'] === '0') : ?>
                            <th class="pr-4 font-semibold text-center sticky top-0 bg-white z-10">Nro Rubro</th>
                            <th class="pr-4 font-semibold text-center sticky top-0 bg-white z-10">Rubro</th>
                            <th class="pr-4 font-semibold text-center sticky top-0 bg-white z-10">Saldo Rubro</th>
                        <?php endif; ?>
                        <?php if ($orden['Contador_Aprobado'] === '1') : ?>
                            <?php if ($isPresidente || $isSecretario || $isContador) : ?>
                                <th class="pr-4 font-semibold text-center sticky top-0 bg-white z-10">Rubro</th>
                                <th class="pr-4 font-semibold text-center sticky top-0 bg-white z-10">Saldo Rubro</th>
                            <?php endif; ?>
                            <?php if (!$isPresidente && !$isSecretario && !$isContador) : ?>
                                <th class="pr-4 font-semibold text-center sticky top-0 bg-white z-10">Rubro</th>
                            <?php endif; ?>
                        <?php endif; ?>
                    </tr>

                    <?php 
                        $totalPrecioEstimado = 0;
                        foreach ($productos as $producto) { 
                            $totalPrecioEstimado += $producto['precio_estimado'] * $producto['cantidad'];
                            $precio_multiplicado = $producto['precio_estimado'] * $producto['cantidad']; ?>
                        <tr class="producto-clone">
                            <td class="text-center">
                                <div class="input-wrapper">
                                    <input type="text" name="total_producto[]"
                                        class="mt-1 p-2 w-full border text-center rounded-md text-black placeholder-black"
                                        style="background: transparent;"
                                        readonly
                                        placeholder="<?= $producto['nombre'] ?>">
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="input-wrapper">
                                    <input type="text" name="total_producto[]"
                                        class="mt-1 p-2 w-full border text-center rounded-md text-black placeholder-black"
                                        style="background: transparent;"
                                        readonly
                                        placeholder="$<?= $producto['precio_estimado'] ?>">
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="input-wrapper">
                                    <input type="text" name="total_producto[]"
                                        class="mt-1 p-2 w-full border text-center rounded-md text-black placeholder-black"
                                        style="background: transparent;"
                                        readonly
                                        placeholder="<?= $producto['cantidad'] ?>">
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="input-wrapper">
                                    <input type="text" name="total_producto[]"
                                        class="mt-1 p-2 w-full border text-center rounded-md text-black placeholder-black"
                                        style="background: transparent;"
                                        readonly
                                        placeholder="$<?= $precio_multiplicado ?>">
                                </div>
                            </td>
                            <?php if ($isContador && $orden['Contador_Aprobado'] === '0') : ?>
                                <td class="text-center">
                                    <div class="input-wrapper">
                                        <input type="text" name="nro_rubro[]"
                                            class="text-center mt-1 p-2 w-full border rounded-md" placeholder=""
                                            oninput="updateRubro(this)" required>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="input-wrapper">
                                        <input type="text" name="rubro[]"
                                            class="mt-1 p-2 w-full border text-center rounded-md text-black placeholder-black"
                                            style="background: transparent;"
                                            readonly
                                            placeholder="">
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="input-wrapper">
                                        <input type="text" name="saldo_rubro[]"
                                            class="mt-1 p-2 w-full border text-center rounded-md text-black placeholder-black"
                                            style="background: transparent;"
                                            readonly
                                            placeholder="">
                                    </div>
                                </td>
                            <?php endif; ?>
                            <?php if ($orden['Contador_Aprobado'] === '1') : ?>
                                <?php if ($isPresidente || $isSecretario || $isContador) : ?>
                                    <td class="text-center">
                                        <div class="input-wrapper">
                                            <input type="text" name="rubro[]"
                                                class="mt-1 p-2 w-full border rounded-md" readonly placeholder="">
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="input-wrapper">
                                            <input type="text" name="saldo_rubro[]"
                                                class="mt-1 p-2 w-full border rounded-md" readonly placeholder="">
                                        </div>
                                    </td>
                                <?php endif; ?>
                                <?php if (!$isPresidente && !$isSecretario && !$isContador) : ?>
                                    <td class="text-center">
                                        <div class="input-wrapper">
                                            <input type="text" name="rubro[]"
                                                class="mt-1 p-2 w-full border rounded-md" readonly placeholder="">
                                        </div>
                                    </td>
                                <?php endif; ?>
                            <?php endif; ?>
                        </tr>
                    <?php } ?>
                </table>
            </div>

            <div id="selectedIDsList"></div>
            <input type="hidden" name="selectedIDs[]" value="">

            <input type="hidden" name="order_id" value="<?= $orden['id'] ?>">
            <input type="hidden" name="order_estado" value="<?= $orden['estado'] ?>">
            <input type="hidden" name="order_Contador_Aprobado" value="<?= $orden['Contador_Aprobado'] ?>">
            <input type="hidden" name="order_Presidente_Aprobado" value="<?= $orden['Presidente_Aprobado'] ?>">
        

        <div class="mt-0 text-center">
            <button id="openPosiblesProveedoresModalBtn" type="button" class="bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">Proveedores sugeridos</button>
            <?php if ($isContador && $orden['Contador_Aprobado'] === '0') : ?>
                <button id="openModalBtn" type="button" class="bg-yellow-500 hover:bg-yellow-700 text-white font-semibold py-2 px-4 rounded">Asignar proveedor</button>
            <?php endif; ?>
            <?php if ($isContador && $orden['Contador_Aprobado'] === '0') : ?>
                <button id="openObservacionesModalBtn" type="button" class="bg-yellow-500 hover:bg-yellow-700 text-white font-semibold py-2 px-4 rounded">Agregar observaciones</button>
            <?php endif; ?>
        </div>
        <div class="mt-0 py-2 text-center">
            <?php if ($isContador && $orden['Contador_Aprobado'] === '0') : ?>
                <button id="aprobarBtn" type="submit" class="bg-green-500 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded">Aprobar</button>
            <?php endif; ?>
            <?php if ($isContador && $orden['Contador_Aprobado'] === '0') : ?>
                <button id="rechazarBtn" type="button" class="bg-red-500 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded" onclick="enviarFormularioRechazo()">Rechazar</button>
            <?php endif; ?>
        </div>
    </div>
</div>
</form>

    
<!-- Modal de Posibles Proveedores -->
<div id="posiblesProveedoresModal" class="modal fixed inset-0 z-50 overflow-auto bg-black bg-opacity-50 flex items-center justify-center">
    <div class="modal-content bg-white p-4 rounded shadow-lg w-1/2 mx-auto my-16"> <!-- Añadimos my-16 para centrar verticalmente -->
        <h2 class="text-xl font-semibold mb-4 text-center">Posibles proveedores</h2>
        <textarea id="posibles_proveedores_izquierda" name="descripcion" class="border-2 p-4 rounded text-base readonly-input proveedores-textarea"
            placeholder="" spellcheck="false" readonly><?= $orden['posibles_proveedores'] ?></textarea>
        <button class="modal-close-btn bg-red-500 hover-bg-red-700 text-white font-bold py-2 px-4 mt-4 rounded">Cerrar</button>
    </div>
</div>

<!-- Modal de Observaciones -->
<div id="observacionesModal" class="modal fixed inset-0 z-50 overflow-auto bg-black bg-opacity-50 flex items-center justify-center">
    <div class="modal-content bg-white p-4 rounded shadow-lg w-1/2 mx-auto my-16"> <!-- Añadimos my-16 para centrar verticalmente -->
        <h2 class="text-xl font-semibold mb-4 text-center">Observaciones del contador</h2>
        <textarea id="posibles_proveedores_izquierda" name="descripcion" class="border-2 p-4 rounded text-base readonly-input proveedores-textarea"
            placeholder="" spellcheck="false" readonly></textarea>
        <button class="modal-close-btn bg-red-500 hover-bg-red-700 text-white font-bold py-2 px-4 mt-4 rounded">Cerrar</button>
    </div>
</div>

<!-- Modal -->
<div id="myModal" class="modal fixed inset-0 z-50 overflow-auto bg-black bg-opacity-50">
    <div class="modal-content bg-white p-4 rounded shadow-lg w-1/4 mx-auto my-16">
        <h1 class="text-2xl font-semibold mb-2 text-center">Buscar Proveedor</h1>

        <!-- Barra de búsqueda -->
        <div class="relative">
            <input type="text" id="searchInput" class="p-2 w-1/2 item border rounded" placeholder="Buscar...">
            <div id="searchResults" class="hidden absolute left-0 mt-1 w-full bg-white border border-gray-300 rounded shadow-md">
                <!-- Aquí se mostrarán los resultados -->
            </div>
        </div>
        
        
            <div class="mb-4 flex items-center">
                <input type="text" id="idProveedor" name="idProveedor" class="mt-1 p-2 w-full border rounded" style="display: none;" readonly>
            </div>
        
            <div class="mb-4 flex items-center">
                <label for="nombreProveedor" class="block text-sm font-medium text-gray-600 w-[150px] text-left">Nombre de Proveedor</label>
                <input type="text" id="nombreProveedor" name="nombreProveedor" class="mt-1 p-2 w-full border rounded" readonly>
            </div>

            <div class="mb-4 flex items-center">
                <label for="personaContacto" class="block text-sm font-medium text-gray-600 w-[150px] text-left">Persona de Contacto</label>
                <input type="text" id="personaContacto" name "personaContacto" class="mt-1 p-2 w-full border rounded" readonly>
            </div>

            <div class="mb-4 flex items-center">
                <label for="numeroContacto" class="block text-sm font-medium text-gray-600 w-[150px] text-left">Número de Contacto</label>
                <input type="text" id="numeroContacto" name="numeroContacto" class="mt-1 p-2 w-full border rounded" readonly>
            </div>

            <div class="mb-4 flex items-center">
                <label for="rut" class="block text-sm font-medium text-gray-600 w-[150px] text-left">RUT</label>
                <input type="text" id="rut" name="rut" class="ml-2 mt-1 p-2 pr-5 w-full border rounded" readonly>
            </div>

            <div class="mb-4 flex items-center">
                <label for="numeroCuenta" class="block text-sm font-medium text-gray-600 w-[150px] text-left">Número de Cuenta</label>
                <input type="text" id="numeroCuenta" name="numeroCuenta" class="mt-1 p-2 w-full border rounded" readonly>
            </div> 

            <div class="mb-4 flex items-center">
                <label for="fechaVencimientoDgi" class="block text-sm font-medium text-gray-600 w-[150px] text-left">Fecha de Vencimiento DGI</label>
                <input type="date" id="fechaVencimientoDgi" name="fechaVencimientoDgi" class="mt-1 p-2 w-full border rounded" readonly>
            </div>

            <div class="mb-4 flex items-center">
                <label for="fechaVencimientoBps" class="block text-sm font-medium text-gray-600 w-[150px] text-left">Fecha de Vencimiento BPS</label>
                <input type="date" id="fechaVencimientoBps" name="fechaVencimientoBps" class="mt-1 p-2 w-full border rounded" readonly>
            </div>

            <div class="mt-8 space-x-2 flex justify-center items-center">
                <div class="inline-flex items-center">
                    <label for="rupe" class="block text-sm font-medium text-gray-600 mr-2">RUPE</label>
                    <input type="checkbox" id="rupe" name="rupe" class="form-checkbox h-5 w-5 text-blue-600" disabled>
                </div>

                <div class="inline-flex items-center">
                    <label for="empresaEstado" class="block text-sm font-medium text-gray-600 mr-2">Empresa del Estado</label>
                    <input type="checkbox" id="empresaEstado" name="empresaEstado" class="form-checkbox h-5 w-5 text-blue-600" disabled>
                </div>
            </div>

        <button id="closeModalBtn" class="modal-close-btn bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 mt-4 rounded">Cerrar</button>
        <button id="aceptarModalBtn" class="modal-aceptar-btn bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 mt-4 rounded">Agregar</button>

    </div>
</div>





    
    

<script>
    var rubros = <?= json_encode($rubros); ?>;
    var proveedores = <?= json_encode($proveedores) ?>;
    var resultsContainer = document.getElementById("searchResults");
    const searchInput = document.getElementById('searchInput');
    const searchResults = document.getElementById('searchResults');
    var selectedIDs = [];

    function enviarFormularioRechazo() {
        // Obtener el formulario actual
        var formulario = document.querySelector('form');
        // Cambiar la acción del formulario para que envíe a "/solicitud-rechaza"
        formulario.action = "/solicitud-rechaza";
        // Realizar el envío del formulario
        formulario.submit();
    }

    document.getElementById('aceptarModalBtn').addEventListener('click', function () {
        var idProveedorValue = document.getElementById('idProveedor').value;
        var idProveedorHiddenInput = document.querySelector('input[name="selectedIDs[]"]');

        if (idProveedorValue) {
            // Verifica si el ID ya está en el array antes de agregarlo
            if (!selectedIDs.includes(idProveedorValue)) {
                selectedIDs.push(idProveedorValue);

                // Obtén el campo de entrada oculto por ID

                // Actualiza su valor con los IDs seleccionados
                idProveedorHiddenInput.value = selectedIDs.join(','); // Puedes personalizar el formato
                
                // Muestra la lista de IDs seleccionados
                var selectedIDsList = document.getElementById('selectedIDsList');
                if (selectedIDsList) {
                    selectedIDsList.textContent = selectedIDs.map(function (id) {
                        var p = proveedores.find(function (p) {
                            return p.id == id;
                        });
                        return p ? p.nombre : '';
                    }).join(', '); // Puedes personalizar el formato de la lista
                }
            }
        }
        // Cierra el modal
        var modal = document.getElementById('myModal');
        modal.style.display = 'none'; // Otra opción es usar clases CSS para
    });

    function realizarBusqueda() {
        var searchTerm = document.getElementById("searchInput").value.toLowerCase();
        var resultsContainer = document.getElementById("searchResults");

        resultsContainer.innerHTML = "";

        var matchingProveedores = proveedores.filter(function(proveedor) {
            return proveedor.nombre.toLowerCase().includes(searchTerm);
        });

        matchingProveedores = matchingProveedores.slice(0, 10);

        matchingProveedores.forEach(function(proveedor) {
            var resultItem = document.createElement("div");
            resultItem.textContent = proveedor.nombre;
            resultsContainer.appendChild(resultItem);
        });
    }

    function actualizarResultados() {
        var searchTerm = document.getElementById("searchInput").value.toLowerCase();
        var matchingProveedores = proveedores.filter(function(proveedor) {
            return proveedor.nombre.toLowerCase().includes(searchTerm);
        });

        matchingProveedores = matchingProveedores.slice(0, 10);

        var resultsContainer = document.getElementById("searchResults");
        resultsContainer.innerHTML = "";

        if (matchingProveedores.length > 0) {
            resultsContainer.classList.add("active");
        } else {
            resultsContainer.classList.remove("active");
        }

        // ...

        matchingProveedores.forEach(function(proveedor) {
            var resultItem = document.createElement("div");
            resultItem.textContent = proveedor.nombre;
            resultItem.addEventListener("click", function() {
                document.getElementById("searchInput").value = proveedor.nombre;
                document.getElementById("idProveedor").value = proveedor.id;
                document.getElementById("nombreProveedor").value = proveedor.nombre;
                document.getElementById("personaContacto").value = proveedor.persona_de_contacto;
                document.getElementById("numeroContacto").value = proveedor.numero_de_contacto;
                document.getElementById("rut").value = proveedor.RUT;
                document.getElementById("numeroCuenta").value = proveedor.numero_de_cuenta;
                document.getElementById("fechaVencimientoDgi").value = proveedor.fecha_de_vencimiento_dgi;
                document.getElementById("fechaVencimientoBps").value = proveedor.fecha_de_vencimiento_bps;
                document.getElementById("rupe").checked = (proveedor.rupe === '1');
                document.getElementById("empresaEstado").checked = (proveedor.empresa_del_estado === '1');
                
                resultsContainer.classList.remove("active");
            });
            resultsContainer.appendChild(resultItem);
        });
    }

    document.getElementById("searchInput").addEventListener("input", actualizarResultados);



    function updateRubro(input) {
        var nroRubro = input.value;
        var row = input.closest('tr');
        var rubroField = row.querySelector('input[name="rubro[]"]');
        var saldoRubroField = row.querySelector('input[name="saldo_rubro[]"]');

        var matchingRubro = rubros.find(function (rubro) {
            return rubro.codigo === nroRubro;
        });

        if (matchingRubro) {
            rubroField.value = matchingRubro.nombre;
            saldoRubroField.value = "$" + matchingRubro.saldo;
        } else {
            rubroField.value = 'No existe ese rubro';
            saldoRubroField.value = '-----';
        }
    }

    const closeModalBtns = document.querySelectorAll('.modal-close-btn');
    const modals = document.querySelectorAll('.modal');

    closeModalBtns.forEach((btn, index) => {
        btn.addEventListener('click', function () {
            modals[index].style.display = 'none';
        });
    });

    const openModalBtn = document.getElementById('openModalBtn');
    const modal = document.getElementById('myModal');

    if (openModalBtn) {
        openModalBtn.addEventListener('click', function () {
            modal.style.display = 'block';
        });
    }

    const openPosiblesProveedoresModalBtn = document.getElementById('openPosiblesProveedoresModalBtn');
    const openObservacionesModalBtn = document.getElementById('openObservacionesModalBtn');

    if (openPosiblesProveedoresModalBtn) {
        openPosiblesProveedoresModalBtn.addEventListener('click', function () {
            const posiblesProveedoresModal = document.getElementById('posiblesProveedoresModal');
            posiblesProveedoresModal.style.display = 'block';
        });
    }

    if (openObservacionesModalBtn) {
        openObservacionesModalBtn.addEventListener('click', function () {
            const observacionesModal = document.getElementById('observacionesModal');
            observacionesModal.style.display = 'block';
        });
    }
</script>

</body>

</html>