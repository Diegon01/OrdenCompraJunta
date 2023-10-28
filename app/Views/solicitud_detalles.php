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

    </style>
</head>
<header> 
    <?= view('layout/navbar') ?>
</header>
<body class="bg-gray-100">
    <div class="bg-gray-100 p-4 pt-8">
        <!--<form action="/alta-orden" method="POST" class="max-w-6x1 mx-auto bg-white p-4 rounded-md shadow-md">-->
            <?= csrf_field() ?>
            <div class="page-container bg-gray-200 p-4 pt-8">
                <h1 class="text-2xl font-semibold mb-4 text-center">Detalle Solicitud de Orden de Compra Nº <?= $orden['id'] ?></h1>

                

                <div class="inputs-container">
                    
                    <label class="font-semibold block text-2xl text-center pt-2 mb-4" for="descripcion">Solicitante:</label>
                    
                    <table class="w-full">
                        <tr>
                            <th class="pr-4 font-semibold text-center sticky top-0 bg-white z-10">Cedula</th>
                            <th class="pr-4 font-semibold text-center sticky top-0 bg-white z-10">Nombres</th>
                            <th class="pr-4 font-semibold text-center sticky top-0 bg-white z-10">Apellidos</th>
                        </tr>

                        
                        <tr class="producto-clone">
                            <td class="text-center">
                                <div class="input-wrapper">
                                    <input type="text" name="nombre[]"
                                        class="mt-1 p-2 w-full border rounded-md readonly-input"
                                        readonly placeholder=<?= $solicitante->cedula ?>>
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="input-wrapper">
                                    <input type="text" name="precio_estimado[]"
                                        class="mt-1 p-2 w-full border rounded-md" readonly placeholder=<?= $solicitante->nombres ?>>
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="input-wrapper">
                                    <input type="text" name="cant_producto[]"
                                        class="mt-1 p-2 w-full border rounded-md" readonly placeholder=<?= $solicitante->apellidos ?>>
                                </div>
                            </td>
                        </tr>
                       
                        <!-- Puedes agregar más filas según sea necesario -->
                        
                    </table>
                </div>

                <div class="descripcion-container">
                    <label class="font-semibold block text-2xl mb-2 text-center" for="descripcion">Descripción:</label>
                    <textarea id="descripcion" name="descripcion" class="border-2 p-4 rounded w-full resize-none text-base readonly-input bg-gray-200 text-center mx-auto"
                        placeholder="No se ha proporcionado una descripción" spellcheck="false" readonly><?= $orden['descripcion'] ?></textarea>
                </div>

                <div class="inputs-container">
                      
                    <label class="font-semibold block text-2xl pt-10 mb-2 text-center" for="posibles_proveedores">Productos:</label>

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
                                    <input type="text" name="nombre[]"
                                        class="mt-1 p-2 w-full border rounded-md readonly-input"
                                        readonly placeholder=<?= $producto['nombre'] ?>>
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="input-wrapper">
                                    <input type="number" name="precio_estimado[]"
                                        class="mt-1 p-2 w-full border rounded-md" readonly placeholder=<?= $producto['precio_estimado'] ?>>
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="input-wrapper">
                                    <input type="text" name="cant_producto[]"
                                        class="mt-1 p-2 w-full border rounded-md" readonly placeholder=<?= $producto['cantidad'] ?>>
                                </div>
                            <td class="text-center">
                                <div class="input-wrapper">
                                    <input type="text" name="total_producto[]"
                                        class="mt-1 p-2 w-full border rounded-md" readonly placeholder=<?= $precio_multiplicado ?>>
                                </div>
                            </td>
                            <?php if ($isContador && $orden['Contador_Aprobado'] === '0') : ?>
                                <td class="text-center">
                                    <div class="input-wrapper">
                                        <input type="text" name="nro_rubro[]"
                                            class="mt-1 p-2 w-full border rounded-md" placeholder="">
                                    </div>
                                </td>
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
                       
                        <!-- Puedes agregar más filas según sea necesario -->
                        
                    </table>
                </div>
    
    
    
                <div class="mt-4 text-center">
                    <?php if ($isContador && $orden['Contador_Aprobado'] === '0') : ?>
                        <button id="openModalBtn" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Detalle Proveedores</button>
                    <?php endif; ?>

                    <button id="openPosiblesProveedoresModalBtn" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Posibles Proveedores</button>
                    
                    <?php if ($isContador && $orden['Contador_Aprobado'] === '0') : ?>
                        <button id="openObservacionesModalBtn" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">Observaciones</button>
                    <?php endif; ?>   
                </div>
                
         <!--</form>--> 
    
    </div>
    
<!-- Modal de Posibles Proveedores -->
<div id="posiblesProveedoresModal" class="modal fixed inset-0 z-50 overflow-auto bg-black bg-opacity-50 flex justify-center items-center">
    <div class="modal-content bg-white p-8 rounded shadow-lg">
        <h2 class="text-xl font-semibold mb-4 text-center">Posibles proveedores</h2>
        <textarea id="posibles_proveedores_izquierda" name="descripcion" class="border-2 p-4 rounded text-base readonly-input proveedores-textarea"
            placeholder="" spellcheck="false" readonly><?= $orden['posibles_proveedores'] ?></textarea>
        <button class="modal-close-btn bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 mt-4 rounded">Cerrar</button>
    </div>
</div>

<!-- Modal de Observaciones -->
<div id="observacionesModal" class="modal fixed inset-0 z-50 overflow-auto bg-black bg-opacity-50 flex justify-center items-center">
    <div class="modal-content bg-white p-8 rounded shadow-lg">
        <h2 class="text-xl font-semibold mb-4 text-center">Título del Modal</h2>
        <textarea id="observacionesTextArea" class="modal-textarea"></textarea>
        <button class="modal-close-btn bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 mt-4 rounded">Cerrar</button>
    </div>
</div>

    <!-- Modal -->
    <div id="myModal" class="modal fixed inset-0 z-50 overflow-auto bg-black bg-opacity-50">
        <div class="modal-content bg-white p-8 rounded shadow-lg"
            style="position: absolute; top: 50px; left: 50px; cursor: grab;">
                  
            <!-- Barra de búsqueda -->
            <div class="flex mb-4">
                <input type="text" id="searchInput" class="p-2 w-full border rounded" placeholder="Buscar...">
                <button id="searchButton" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 ml-2 rounded">Buscar</button>
            </div>
    
        <div class="bg-white p-8 rounded shadow-md max-w-md w-full text-center">
        <h1 class="text-2xl font-semibold mb-2 text-center">Detalle Proveedor</h1>

        <!-- Formulario para el alta de proveedor -->
        <form action="/alta-proveedor" method="POST">

                    <!-- Campo Nombre de Proveedor -->
            <div class="mb-4 flex items-center">
                <label for="nombreProveedor" class="block text-sm font-medium text-gray-600 w-[150px] text-left">Nombre de Proveedor</label>
                <input type="text" id="nombreProveedor" name="nombreProveedor" class="mt-1 p-2 w-full border rounded" readonly>
            </div>

            <!-- Campo Persona de Contacto -->
            <div class="mb-4 flex items-center">
                <label for="personaContacto" class="block text-sm font-medium text-gray-600 w-[150px] text-left ">Persona de Contacto</label>
                <input type="text" id="personaContacto" name="personaContacto" class="mt-1 p-2 w-full border rounded" readonly>
            </div>

            <!-- Campo Número de Contacto -->
            <div class="mb-4 flex items-center">
                <label for="numeroContacto" class="block text-sm font-medium text-gray-600 w-[150px] text-left">Número de Contacto</label>
                <input type="text" id="numeroContacto" name="numeroContacto" class="mt-1 p-2 w-full border rounded" readonly>
            </div>

            <!-- Campo RUT -->
            <div class="mb-4 flex items-center">
                <label for="rut" class="block text-sm font-medium text-gray-600 w-[150px] text-left">RUT</label>
                <input type="text" id="rut" name="rut" class="ml-2 mt-1 p-2 pr-5 w-full border rounded" readonly>
            </div>

            <!-- Campo Número de Cuenta -->
            <div class="mb-4 flex items-center">
                <label for="numeroCuenta" class="block text-sm font-medium text-gray-600 w-[150px] text-left">Número de Cuenta</label>
                <input type="text" id="numeroCuenta" name="numeroCuenta" class="mt-1 p-2 w-full border rounded" readonly>
            </div>

            <!-- Fecha de Vencimiento DGI -->
            <div class="mb-4 flex items-center">
                <label for="fechaVencimientoDgi" class="block text-sm font-medium text-gray-600 w-[150px] text-left">Fecha de Vencimiento DGI</label>
                <input type="date" id="fechaVencimientoDgi" name="fechaVencimientoDgi" class="mt-1 p-2 w-full border rounded" readonly>
            </div>

            <!-- Fecha de Vencimiento BPS -->
            <div class="mb-4 flex items-center">
                <label for="fechaVencimientoBps" class="block text-sm font-medium text-gray-600 w-[150px] text-left">Fecha de Vencimiento BPS</label>
                <input type="date" id="fechaVencimientoBps" name="fechaVencimientoBps" class="mt-1 p-2 w-full border rounded" readonly>
            </div>

            <div class="mt-8 space-x-2 flex justify-center items-center">
                <!-- Campo RUPE -->
                <div class="inline-flex items-center">
                    <label for="rupe" class="block text-sm font-medium text-gray-600 mr-2">RUPE</label>
                    <input type="checkbox" id="rupe" name="rupe" class="form-checkbox h-5 w-5 text-blue-600"readonly>
                </div>
                
                <!-- Campo Empresa del Estado -->
                <div class="inline-flex items-center">
                    <label for="empresaEstado" class="block text-sm font-medium text-gray-600 mr-2 ">Empresa del Estado</label>
                    <input type="checkbox" id="empresaEstado" name="empresaEstado" class="form-checkbox h-5 w-5 text-blue-600"readonly>
                </div>
            </div>
         </form>
    </div>
                    <button id="closeModalBtn"
                        class="modal-close-btn bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 mt-4 rounded">Cerrar Detalle</button>
                </div>
            </div>
    
    

            <script>

                // Obtén todos los botones de cierre con la clase "modal-close-btn"
    const closeModalBtns = document.querySelectorAll('.modal-close-btn');
    const modals = document.querySelectorAll('.modal');

    // Agrega un event listener a todos los botones de cerrar
    closeModalBtns.forEach((btn, index) => {
        btn.addEventListener('click', function () {
            modals[index].style.display = 'none';
        });
    });
    
    // Obtén el botón para abrir el modal y el modal en sí
    const openModalBtn = document.getElementById('openModalBtn');
    const modal = document.getElementById('myModal');

    // Agrega un event listener al botón para abrir el modal si existe
    if (openModalBtn) {
        openModalBtn.addEventListener('click', function () {
            modal.style.display = 'block';
        });
    }

    const openPosiblesProveedoresModalBtn = document.getElementById('openPosiblesProveedoresModalBtn');
    const openObservacionesModalBtn = document.getElementById('openObservacionesModalBtn');

    // Event listener para abrir el modal de Posibles Proveedores si existe
    if (openPosiblesProveedoresModalBtn) {
        openPosiblesProveedoresModalBtn.addEventListener('click', function () {
            // Muestra el modal correspondiente (puedes modificar el contenido aquí)
            // Por ejemplo, para mostrar el text area de Posibles Proveedores:
            const posiblesProveedoresModal = document.getElementById('posiblesProveedoresModal');
            posiblesProveedoresModal.style.display = 'block';
        });
    }

    // Event listener para abrir el modal de Observaciones si existe
    if (openObservacionesModalBtn) {
        openObservacionesModalBtn.addEventListener('click', function () {
            // Muestra el modal correspondiente (puedes modificar el contenido aquí)
            // Por ejemplo, para mostrar el text area de Observaciones:
            const observacionesModal = document.getElementById('observacionesModal');
            observacionesModal.style.display = 'block';
        });
    }
</script>

</body>

</html>