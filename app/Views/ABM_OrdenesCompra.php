<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Órdenes de Compra</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Estilos para el modal de filtros */
        .modal {
            display: none;
            position: fixed;
            background-color: rgba(255, 255, 255, 1);
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            padding: 10px;
        }

        .filtro-button {
            cursor: pointer;
            display: block;
            text-align: center;
            margin-bottom: 10px;
        }

        .filtro-columna {
            column-count: 2;
        }

        .filtro-tipo {
            margin-bottom: 10px;
        }

        /* Estilos para la paginación */
        .pagination-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .pagination-container .pagination {
            list-style: none;
            display: flex;
        }

        .pagination-container .pagination li {
            margin: 0 5px;
        }

        .pagination-container .pagination li a {
            display: block;
            padding: 10px 15px;
            background-color: #3498db;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }

        .pagination-container .pagination li.active a {
            background-color: #87CEEB; /* Azul aún más claro */
        }

        /* Estilo para las líneas entre filas */
        table tr:not(:last-child) {
            border-bottom: 1px solid #ddd;
        }
    </style>
</head>

<header> 
    <?= view('layout/navbar') ?>
</header>

<body class="bg-gray-100">
    <div class="container mx-auto py-8">
        <!-- Título de la tabla y barra de búsqueda -->
        <h1 class="text-3xl font-bold mb-6">Lista de Órdenes de Compra</h1>

        <!-- Contenedor para filtro y búsqueda -->
        <div class="w-full bg-white border border-gray-300 rounded-t-lg p-4 mb-4 flex flex-col lg:flex-row items-center relative">
            <!-- Botón de filtro -->
            <div class="mr-auto">
                <div class="filtro-button" id="filtroButton">
                    <svg xmlns="http://www.w3.org/2x000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2"
                            d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </div>
            </div>
            <div class="flex items-center"> <button id="borrarFiltros" class="bg-red-700 hover:bg-red-500 text-white font-bold py-2 px-4 rounded hover:no-underline box-shadow-hover-cuatro" maring>Borrar Filtros</button>
            &nbsp; 
            &nbsp; 
            &nbsp; 
            &nbsp; 

            <!-- Barra de búsqueda -->


                <label for="busqueda" class="text-gray-700 mr-2">Buscar:</label>
                <form action="<?= site_url('ordenescompra') ?>" method="get">
                    <!-- Input para el filtro actual -->
                    <?php foreach ($_GET as $key => $value): ?>
                        <?php if ($key !== 'search'): ?>
                            <input type="hidden" name="<?= $key ?>" value="<?= htmlspecialchars($value) ?>">
                        <?php endif; ?>
                    <?php endforeach; ?>

                    <!-- Campo de búsqueda -->
                    <input type="text" name="search" id="busqueda" class="border rounded px-2 py-1" placeholder="Ingrese búsqueda...">

                    <!-- Botón de submit -->
                    <button type="submit"></button>
                </form>
            </div>
        </div>

        <!-- Modal de Filtros -->
        <div id="modalFiltros" class="modal">
            <div class="modal-content">
                <!-- Filtros organizados en columnas -->
                <div class="filtro-columna">
                    <div class="filtro-tipo">
                        <h3>Fecha:</h3>
                        <label class="flex items-center">
                        <a href="<?= site_url('/ordenescompra') . '?' . http_build_query(array_merge($_GET, ['sort' => 'newest'])) ?>" class="btn-filter text-blue-500" id="btnMasReciente">Más recientes</a>

                        </label>
                        <label class="flex items-center">
                        <a href="<?= site_url('/ordenescompra') . '?' . http_build_query(array_merge($_GET, ['sort' => 'oldest'])) ?>" class="btn-filter text-blue-500" id="btnMasAntiguo">Más antiguas</a>

                        </label>
                    </div>

                    <div class="filtro-tipo">
                        <h3>Estado:</h3>
                        <label class="flex items-center">
                            <a href="<?= site_url('/ordenescompra') . '?' . http_build_query(array_merge($_GET, ['estado' => 'pendiente'])) ?>" class="btn-filter text-blue-500" id="btnPendiente">Emitidas pendientes</a>
                        </label>
                        <label class="flex items-center">
                            <a href="<?= site_url('/ordenescompra') . '?' . http_build_query(array_merge($_GET, ['estado' => 'lista'])) ?>" class="btn-filter text-blue-500" id="btnPendiente">Emitidas y listas</a>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabla para mostrar las órdenes de compra -->
        <table id="tabla-ordenes"
            class="min-w-full bg-white border border-gray-300 rounded-b-lg overflow-hidden mt-4">
            <!-- Encabezados de la tabla -->
            <thead>
                <tr>
                    <th class="px-6 py-3 bg-gray-200 text-gray-700 font-bold uppercase border-r">Nº</th>
                    <th class="px-6 py-3 bg-gray-200 text-gray-700 font-bold uppercase border-r">Fecha de emisión</th>
                    <th class="px-6 py-3 bg-gray-200 text-gray-700 font-bold uppercase border-r">Solicitante</th>
                    <th class="px-6 py-3 bg-gray-200 text-gray-700 font-bold uppercase border-r">Ítems</th>
                    <th class="px-6 py-3 bg-gray-200 text-gray-700 font-bold uppercase border-r">Estado</th>
                    <th class="px-6 py-3 bg-gray-200 text-gray-700 font-bold uppercase">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ordenes as $orden): ?>
                    <tr>
                        <td class="px-6 py-4 border-r text-center"><?= $orden['id'] ?></td>
                        <td class="px-6 py-4 border-r text-center"><?= date('Y-m-d', strtotime($orden['created_at'])) ?></td>
                        <td class="px-6 py-4 border-r text-center"><?= $orden['nombres'] ?> <?= $orden['apellidos'] ?></td>
                        <td class="px-6 py-4 border-r text-center">
                            <?php foreach ($productos as $producto) {
                                if ($producto['ordenfinal_id'] == $orden['id']) {
                            ?>
                                -<?= $producto['nombre'] ?><br> <!-- PLACEHOLDER, AGREGAR NOMBRE A PRODUCTOS DE ORDENES -->
                            <?php }} ?>
                        </td>
                        <td class="px-6 py-4 border-r text-center">
                            <?php if ($orden['secretario_visto'] === '0'): ?>
                                <?php if ($isSecretario): ?>
                                    <span class="bg-blue-400 text-white px-2 py-1 rounded-full" style="filter: drop-shadow(0 0 10px rgba(66, 135, 245, 0.90));">Emitida, pendiente visto bueno</span>
                                <?php endif; ?>
                                <?php if (!$isSecretario): ?>
                                    <span class="bg-yellow-200 text-yellow-800 px-2 py-1 rounded-full">Emitida, pendiente visto bueno</span>
                                <?php endif; ?>
                            <?php else: ?>
                                <span class="bg-green-200 text-green-800 px-2 py-1 rounded-full">Emitida y lista</span>
                            <?php endif; ?>
                        </td>
                        <td class="px-6 py-4">
                            <!-- Botones de acciones -->
                            <a href="<?= site_url('/orden-detalles/' . $orden['id']) ?>" class="text-blue-500 hover:underline text-lg font-semibold">Ver detalles</a>
                            <br>
                            <a href="<?= site_url('/solicitud-detalles/' . $orden['solicitud_id']) ?>" class="text-blue-500 hover:underline text-lg font-semibold">Solicitud original</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="pagination-container">
            <?= $pager->links('default', 'junta_full') ?>
        </div>

    <script>
        // Función para abrir y cerrar el modal de filtros
        function toggleModal() {
            const modal = document.getElementById('modalFiltros');
            modal.style.display = modal.style.display === 'block' ? 'none' : 'block';
        }

        // Función para posicionar el modal
        function positionModal() {
            // Obtener el botón de filtros
            const filtroButton = document.getElementById('filtroButton');

            // Obtener las coordenadas del botón de filtros
            const filtroButtonRect = filtroButton.getBoundingClientRect();

            // Establecer la posición del modal debajo del botón de filtros con un margen de 10px
            const modal = document.getElementById('modalFiltros');
            modal.style.top = filtroButtonRect.bottom + 10 + 'px';

            // Establecer la posición izquierda del modal para que comience en la misma distancia del margen que el botón de filtros
            const marginLeft = filtroButtonRect.left - 10; // 10px de margen
            modal.style.left = marginLeft + 'px';
        }

        // Agregar evento de clic al botón de filtros
        const filtroButton = document.getElementById('filtroButton');
        filtroButton.addEventListener('click', function() {
            toggleModal();
            positionModal();
        });

        // Agregar evento de redimensionamiento de la ventana para reposicionar el modal
        window.addEventListener('resize', function() {
            if (document.getElementById('modalFiltros').style.display === 'block') {
                positionModal();
            }
        });

        // Posicionar el modal al cargar la página
        window.addEventListener('load', function() {
            positionModal();
        });
    </script>

    <script>
        // Get the search input field
        const searchInput = document.getElementById('busqueda');

        // Listen for the Enter key press
        searchInput.addEventListener('keyup', function (event) {
            if (event.key === 'Enter') {
                // Submit the form when Enter is pressed
                document.getElementById('searchForm').submit();
            }
        });
        function borrarFiltros() {
            // Eliminar el valor de búsqueda
            document.getElementById('busqueda').value = '';

            // Redirigir a la página de órdenes sin filtros
            window.location.href = '<?= site_url('/ordenescompra') ?>';
        }

        // Agregar evento de clic al botón de Borrar Filtros
        const borrarFiltrosButton = document.getElementById('borrarFiltros');
        borrarFiltrosButton.addEventListener('click', function () {
            borrarFiltros();
        });
    </script>
</body>

</html>