<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Órdenes de Compra</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Estilos para el modal de filtros (mantén estos estilos) */
        .modal {
            /* Estilos del modal */
        }

        .modal-content {
            /* Estilos del contenido del modal */
        }

        .filtro-columna {
            column-count: 2;
        }

        .filtro-tipo {
            margin-bottom: 10px;
        }
    </style>
</head>

<body class="bg-gray-100">
    <div class="container mx-auto py-8">
        <!-- Título de la tabla -->
        <h1 class="text-3xl font-bold mb-6">Lista de Órdenes de Compra</h1>

        <!-- Contenedor para filtro y búsqueda -->
        <div class="w-full bg-white border border-gray-300 rounded-t-lg p-4 mb-4 flex flex-col lg:flex-row justify-between items-center">
            <!-- Filtros -->
            <div class="flex items-center mb-4 lg:mb-0">
                <!-- Icono de filtro que abre el modal -->
                <div class="mr-4 cursor-pointer" onclick="toggleModal()">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2"
                            d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </div>

                <!-- Modal de Filtros -->
                <div id="modalFiltros" class="modal">
                    <div class="modal-content">
                        <span class="close" onclick="toggleModal()">&times;</span>

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
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Barra de búsqueda -->
            <div class="flex items-center">
                <label for="busqueda" class="text-gray-700 mr-2">Buscar:</label>
                <input type="text" id="busqueda" class="border rounded px-2 py-1"
                    placeholder="Ingrese término de búsqueda...">
            </div>
        </div>

        <!-- Tabla para mostrar las órdenes de compra -->
        <table id="tabla-ordenes" class="min-w-full bg-white border border-gray-300">
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
                <!-- Más filas de órdenes de compra se pueden agregar aquí -->
            </tbody>
        </table>
    </div>

    <script>
        // Función para abrir y cerrar el modal de filtros
        function toggleModal() {
            const modal = document.getElementById('modalFiltros');
            modal.style.display = modal.style.display === 'block' ? 'none' : 'block';
        }
    </script>
</body>

</html>