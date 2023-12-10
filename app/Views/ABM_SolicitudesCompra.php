<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitudes de compra</title>
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

        .description-cell {
        max-width: 500px; /* Adjust the maximum height as needed */
        overflow: auto;
        }

        .box-shadow-hover-dos:hover {
        filter: drop-shadow(0 0 10px rgba(66, 135, 245, 0.90));
        }

        .box-shadow-hover-dos {
        transition: filter 0.3s ease; /* Ajusta la duración y la función de temporización según tus preferencias */
        }

        .box-shadow-hover-tres:hover {
        filter: drop-shadow(0 0 10px rgba(66, 205, 135, 0.90));
        }

        .box-shadow-hover-tres {
        transition: filter 0.3s ease; /* Ajusta la duración y la función de temporización según tus preferencias */
        }

        .box-shadow-hover-cuatro:hover {
        filter: drop-shadow(0 0 7px rgba(255, 0, 0, 0.50));
        }

        .box-shadow-hover-cuatro {
        transition: filter 0.2s ease; /* Ajusta la duración y la función de temporización según tus preferencias */
        }

        .custom-pagination li {
            display: inline-block;
            margin-right: 0.5rem;
        }

        .custom-pagination a {
            display: block;
            padding: 0.25rem 0.5rem;
            background-color: red; /* Color de fondo rojo */
            color: white; /* Texto en color blanco */
            text-decoration: none;
            border-radius: 0.25rem;
        }

        .custom-pagination a:hover {
            background-color: darkred; /* Color de fondo más oscuro al pasar el mouse */
        }
    </style>
</head>

<header> 
    <?= view('layout/navbar') ?>
</header>

<body class="bg-gray-100">
    <div class="container mx-auto py-8">
        <!-- Título de la tabla y barra de búsqueda -->
        <h1 class="text-3xl font-bold mb-6">Administración de solicitudes de compra</h1>

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
                <form action="<?= site_url('ordenes') ?>" method="get">
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
                        <a href="<?= site_url('/ordenes') . '?' . http_build_query(array_merge($_GET, ['sort' => 'newest'])) ?>" class="btn-filter text-blue-500" id="btnMasReciente">Más recientes</a>

                        </label>
                        <label class="flex items-center">
                        <a href="<?= site_url('/ordenes') . '?' . http_build_query(array_merge($_GET, ['sort' => 'oldest'])) ?>" class="btn-filter text-blue-500" id="btnMasAntiguo">Más antiguas</a>

                        </label>
                    </div>

                    <div class="filtro-tipo">
                        <h3>Estado:</h3>
                        <label class="flex items-center">
                            <a href="<?= site_url('/ordenes') . '?' . http_build_query(array_merge($_GET, ['estado' => 'pendiente'])) ?>" class="btn-filter text-blue-500" id="btnPendiente">Pendientes</a>
                        </label>
                        <label class="flex items-center">
                            <a href="<?= site_url('/ordenes') . '?' . http_build_query(array_merge($_GET, ['estado' => 'aceptada'])) ?>" class="btn-filter text-blue-500" id="btnPendiente">Aceptadas</a>
                        </label>
                        <label class="flex items-center">
                            <a href="<?= site_url('/ordenes') . '?' . http_build_query(array_merge($_GET, ['estado' => 'rechazada'])) ?>" class="btn-filter text-blue-500" id="btnPendiente">Rechazadas</a>
                        </label>
                     
    <!-- ... (otros elementos) ... -->
    <!-- Botón de Borrar Filtros -->
    
   
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
                    <th class="px-6 py-3 bg-gray-200 text-gray-700 font-bold uppercase border-r">Fecha</th>
                    <th class="px-6 py-3 bg-gray-200 text-gray-700 font-bold uppercase border-r">Solicitante</th>
                    <th class="px-6 py-3 bg-gray-200 text-gray-700 font-bold uppercase border-r description-cell">Productos solicitados</th>
                    <th class="px-6 py-3 bg-gray-200 text-gray-700 font-bold uppercase border-r">Total estimado</th>
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
                            <?php
                            $recorrido = 0;
                            foreach ($productos as $producto) {
                                if ($producto['orden_id'] == $orden['id']) {
                                    if ($recorrido == 3) {
                                        echo '<br>(...)';
                                        break;
                                    }
                                    if ($recorrido != 0) {
                                        echo '<br>';
                                    }
                                    echo '⋄ ', $producto['nombre'], ' (', $producto['cantidad'], ')';
                                    $recorrido += 1;
                                }
                            }
                            ?>
                        </td>
                        <td class="px-6 py-4 border-r text-center">$
                            <?php
                            $totalPrecioEstimado = 0;

                            foreach ($productos as $producto) {
                                if ($producto['orden_id'] == $orden['id']) {
                                    $totalPrecioEstimado += $producto['precio_estimado'] * $producto['cantidad'];
                                }
                            }

                            echo $totalPrecioEstimado;
                            ?>
                        </td>
                        <td class="px-6 py-4 border-r text-center">
                            <?php if ($orden['estado'] === 'Rechazada'): ?>
                                <span class="bg-red-200 text-red-800 px-2 py-1 rounded-full"><?= $orden['estado'] ?></span>
                            <?php else: ?>
                                <?php if ($orden['estado'] === 'Aceptada'): ?>
                                    <span class="bg-green-200 text-green-800 px-2 py-1 rounded-full"><?= $orden['estado'] ?></span>
                                <?php else: ?>
                                    <?php if ($orden['Contador_Aprobado'] === '0') : ?>
                                        <?php if ($isContador) : ?>
                                            <span class="bg-blue-400 text-white px-2 py-1 rounded-full" style="filter: drop-shadow(0 0 10px rgba(66, 135, 245, 0.90));">Pendiente de intervención</span>
                                        <?php endif; ?>
                                        <?php if (!$isContador) : ?>
                                            <span class="bg-yellow-200 text-yellow-800 px-2 py-1 rounded-full">Pendiente de intervención</span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <?php if ($orden['Contador_Aprobado'] === '1') : ?>
                                        <?php if ($orden['Presidente_Aprobado'] === '0') : ?>
                                            <?php if ($isPresidente) : ?>
                                                <span class="bg-blue-400 text-white px-2 py-1 rounded-full" style="filter: drop-shadow(0 0 10px rgba(66, 135, 245, 0.90));">Pendiente de aprobación</span>
                                            <?php endif; ?>
                                            <?php if (!$isPresidente) : ?>
                                                <span class="bg-yellow-200 text-yellow-800 px-2 py-1 rounded-full">Pendiente de aprobación</span>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <?php if ($orden['Presidente_Aprobado'] === '1' && $orden['licitacion'] === '1' && $orden['Ofertas_Ingresadas'] === '0') : ?>
                                        <?php if ($isContador) : ?>
                                            <span class="bg-blue-400 text-white px-2 py-1 rounded-full" style="filter: drop-shadow(0 0 10px rgba(66, 135, 245, 0.90));">Pendiente de recibir ofertas</span>
                                        <?php endif; ?>
                                        <?php if (!$isContador) : ?>
                                            <span class="bg-yellow-200 text-yellow-800 px-2 py-1 rounded-full">Pendiente de recibir ofertas</span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <?php if ($orden['Presidente_Aprobado'] === '1' && $orden['licitacion'] === '0' && $orden['Ofertas_Ingresadas'] === '0') : ?>
                                        <?php if ($currentUserId == $orden['solicitante_id'] || $isContador) : ?>
                                            <span class="bg-blue-400 text-white px-2 py-1 rounded-full" style="filter: drop-shadow(0 0 10px rgba(66, 135, 245, 0.90));">Pendiente de pedir cotizaciones</span>
                                        <?php endif; ?>
                                        <?php if (($currentUserId != $orden['solicitante_id']) && (!$isContador)) : ?>
                                            <span class="bg-yellow-200 text-yellow-800 px-2 py-1 rounded-full">Pendiente de pedir cotizaciones</span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <?php if ($orden['Ofertas_Ingresadas'] === '1') : ?>
                                        <?php if ($isPresidente) : ?>
                                            <span class="bg-blue-400 text-white px-2 py-1 rounded-full" style="filter: drop-shadow(0 0 10px rgba(66, 135, 245, 0.90));">Pendiente de elegir oferta</span>
                                        <?php endif; ?>
                                        <?php if (!$isPresidente) : ?>
                                            <span class="bg-yellow-200 text-yellow-800 px-2 py-1 rounded-full">Pendiente de elegir oferta</span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                <?php endif; ?>
                            <?php endif; ?>
                        </td>
                        <td class="px-6 py-4">
                            <a href="<?= site_url('/solicitud-detalles/' . $orden['id']) ?>" class="text-blue-500 hover:underline text-lg font-semibold">Ver detalles</a>
                            <?php if ($isContador && $orden['Presidente_Aprobado'] === '1' && $orden['licitacion'] === '1' && $orden['Ofertas_Ingresadas'] === '0') : ?>
                                <br>
                                <a href="<?= site_url('/ingresar-ofertas/' . $orden['id']) ?>" class="text-green-500 hover:underline text-lg font-semibold">Ingresar ofertas</a>
                            <?php endif; ?>
                            <?php if (($currentUserId == $orden['solicitante_id'] || $isContador) && $orden['Presidente_Aprobado'] === '1' && $orden['licitacion'] === '0' && $orden['Ofertas_Ingresadas'] === '0') : ?>
                                <br>
                                <a href="<?= site_url('/ingresar-ofertas/' . $orden['id']) ?>" class="text-green-500 hover:underline text-lg font-semibold">Ingresar cotizaciones</a>
                            <?php endif; ?>
                            <?php if ($isPresidente && $orden['Ofertas_Ingresadas'] === '1' && $orden['estado'] != 'Aceptada') : ?>
                                <br>
                                <a href="<?= site_url('/elegir-ofertas/' . $orden['id']) ?>" class="text-green-500 hover:underline text-lg font-semibold">Elegir ofertas</a>
                            <?php endif; ?>
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
        window.location.href = '<?= site_url('/ordenes') ?>';
    }

    // Agregar evento de clic al botón de Borrar Filtros
    const borrarFiltrosButton = document.getElementById('borrarFiltros');
    borrarFiltrosButton.addEventListener('click', function () {
        borrarFiltros();
    });
</script>
    
</body>

</html>