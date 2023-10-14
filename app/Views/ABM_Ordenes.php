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

        .pagination-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .page-link {
            cursor: pointer;
            margin: 0 5px;
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
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2"
                            d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </div>
            </div>

            <!-- Barra de búsqueda -->
            <div class="flex items-center">
                <label for="busqueda" class="text-gray-700 mr-2">Buscar:</label>
                <input type="text" id="busqueda" class="border rounded px-2 py-1"
                    placeholder="Ingrese búsqueda...">
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
                            <input type="checkbox" class="mr-2"> Más Reciente
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="mr-2"> Más Antigua
                        </label>
                    </div>

                    <div class="filtro-tipo">
                        <h3>Estado:</h3>
                        <label class="flex items-center">
                            <input type="checkbox" class="mr-2"> Pendiente
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="mr-2"> En Progreso
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="mr-2"> Completado
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="mr-2"> Nuevo Estado 1
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="mr-2"> Nuevo Estado 2
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="mr-2"> Nuevo Estado 3
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="mr-2"> Nuevo Estado 4
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="mr-2"> Nuevo Estado 5
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
                    <th class="px-6 py-3 bg-gray-200 text-gray-700 font-bold uppercase border-r">Nro de Orden</th>
                    <th class="px-6 py-3 bg-gray-200 text-gray-700 font-bold uppercase border-r">Fecha</th>
                    <th class="px-6 py-3 bg-gray-200 text-gray-700 font-bold uppercase border-r">Solicitante</th>
                    <th class="px-6 py-3 bg-gray-200 text-gray-700 font-bold uppercase border-r">Estado</th>
                    <th class="px-6 py-3 bg-gray-200 text-gray-700 font-bold uppercase">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <!-- Filas de órdenes de compra se llenarán dinámicamente aquí (ejemplos) -->
                <tr>
                    <td class="px-6 py-4 border-r text-center">12345</td>
                    <td class="px-6 py-4 border-r text-center">2023-10-10</td>
                    <td class="px-6 py-4 border-r text-center">John Doe</td>
                    <td class="px-6 py-4 border-r text-center">
                        <span class="bg-yellow-200 text-yellow-800 px-2 py-1 rounded-full mr-2">Pendiente</span>
                        <span class="bg-blue-200 text-blue-800 px-2 py-1 rounded-full">En Progreso</span>
                    </td>
                    <td class="px-6 py-4">
                        <!-- Botones de acciones -->
                        <button class="text-blue-500 hover:underline mr-2">Editar</button>
                        <button class="text-red-500 hover:underline">Eliminar</button>
                    </td>
                </tr>
                <!-- 10 datos adicionales -->
                <tr>
                    <td class="px-6 py-4 border-r text-center">67890</td>
                    <td class="px-6 py-4 border-r text-center">2023-09-28</td>
                    <td class="px-6 py-4 border-r text-center">Jane Smith</td>
                    <td class="px-6 py-4 border-r text-center">
                        <span class="bg-green-200 text-green-800 px-2 py-1 rounded-full">Completado</span>
                    </td>
                    <td class="px-6 py-4">
                        <!-- Botones de acciones -->
                        <button class="text-blue-500 hover:underline mr-2">Editar</button>
                        <button class="text-red-500 hover:underline">Eliminar</button>
                    </td>
                </tr>
                <!-- Más filas de datos aquí -->
                <tr>
                    <td class="px-6 py-4 border-r text-center">13579</td>
                    <td class="px-6 py-4 border-r text-center">2023-09-15</td>
                    <td class="px-6 py-4 border-r text-center">Alice Johnson</td>
                    <td class="px-6 py-4 border-r text-center">
                        <span class="bg-yellow-200 text-yellow-800 px-2 py-1 rounded-full">Pendiente</span>
                    </td>
                    <td class="px-6 py-4">
                        <!-- Botones de acciones -->
                        <button class="text-blue-500 hover:underline mr-2">Editar</button>
                        <button class="text-red-500 hover:underline">Eliminar</button>
                    </td>
                </tr>
                <tr>
                    <td class="px-6 py-4 border-r text-center">24680</td>
                    <td class="px-6 py-4 border-r text-center">2023-09-20</td>
                    <td class="px-6 py-4 border-r text-center">Michael Brown</td>
                    <td class="px-6 py-4 border-r text-center">
                        <span class="bg-green-200 text-green-800 px-2 py-1 rounded-full">Completado</span>
                    </td>
                    <td class="px-6 py-4">
                        <!-- Botones de acciones -->
                        <button class="text-blue-500 hover:underline mr-2">Editar</button>
                        <button class="text-red-500 hover:underline">Eliminar</button>
                    </td>
                </tr>
                <tr>
                    <td class="px-6 py-4 border-r text-center">97531</td>
                    <td class="px-6 py-4 border-r text-center">2023-09-25</td>
                    <td class="px-6 py-4 border-r text-center">Eva Martinez</td>
                    <td class="px-6 py-4 border-r text-center">
                        <span class="bg-blue-200 text-blue-800 px-2 py-1 rounded-full">En Progreso</span>
                    </td>
                    <td class="px-6 py-4">
                        <!-- Botones de acciones -->
                        <button class="text-blue-500 hover:underline mr-2">Editar</button>
                        <button class="text-red-500 hover:underline">Eliminar</button>
                    </td>
                </tr>
                <tr>
                    <td class="px-6 py-4 border-r text-center">86420</td>
                    <td class="px-6 py-4 border-r text-center">2023-09-18</td>
                    <td class="px-6 py-4 border-r text-center">David Lee</td>
                    <td class="px-6 py-4 border-r text-center">
                        <span class="bg-yellow-200 text-yellow-800 px-2 py-1 rounded-full">Pendiente</span>
                    </td>
                    <td class="px-6 py-4">
                        <!-- Botones de acciones -->
                        <button class="text-blue-500 hover:underline mr-2">Editar</button>
                        <button class="text-red-500 hover:underline">Eliminar</button>
                    </td>
                </tr>
                <tr>
                    <td class="px-6 py-4 border-r text-center">64231</td>
                    <td class="px-6 py-4 border-r text-center">2023-09-23</td>
                    <td class="px-6 py-4 border-r text-center">Sarah Clark</td>
                    <td class="px-6 py-4 border-r text-center">
                        <span class="bg-green-200 text-green-800 px-2 py-1 rounded-full">Completado</span>
                    </td>
                    <td class="px-6 py-4">
                        <!-- Botones de acciones -->
                        <button class="text-blue-500 hover:underline mr-2">Editar</button>
                        <button class="text-red-500 hover:underline">Eliminar</button>
                    </td>
                </tr>
                <tr>
                    <td class="px-6 py-4 border-r text-center">12398</td>
                    <td class="px-6 py-4 border-r text-center">2023-09-14</td>
                    <td class="px-6 py-4 border-r text-center">Kevin Johnson</td>
                    <td class="px-6 py-4 border-r text-center">
                        <span class="bg-yellow-200 text-yellow-800 px-2 py-1 rounded-full">Pendiente</span>
                    </td>
                    <td class="px-6 py-4">
                        <!-- Botones de acciones -->
                        <button class="text-blue-500 hover:underline mr-2">Editar</button>
                        <button class="text-red-500 hover:underline">Eliminar</button>
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Contenedor de la barra blanca con bordes redondeados -->
        <div class="w-full bg-white rounded-b-lg border border-gray-300 mt-4"></div>

        <!-- Controles de paginación centrados -->
        <div class="pagination-container">
            <button class="bg-gray-300 text-gray-700 px-4 py-2 rounded-l-md hover:bg-gray-400">«</button>
            <button class="bg-gray-300 text-gray-700 px-4 py-2 hover:bg-gray-400">1</button>
            <button class="bg-gray-300 text-gray-700 px-4 py-2 hover:bg-gray-400">2</button>
            <button class="bg-gray-300 text-gray-700 px-4 py-2 hover:bg-gray-400">3</button>
            <button class="bg-gray-300 text-gray-700 px-4 py-2 hover:bg-gray-400">»</button>
        </div>
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
</body>

</html>