<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Productos</title>
    <!-- Incluye el archivo de estilo de Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.15/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Estilo personalizado para el contenedor de los inputs */
        .inputs-container {
            max-height: 290px; /* 6 filas * 64px (altura de una fila) */
            overflow-y: auto;
        }
    </style>
</head>
<body class="bg-gray-100 p-4 pt-8">
    <div class="max-w-6xl mx-auto bg-white p-4 rounded-md shadow-md">
        <div class="max-w-4xl mx-auto bg-gray-200 p-4 rounded-md shadow-md">
            <h1 class="text-2xl font-semibold mb-4 text-center">Formulario de Productos</h1>
            <!-- Formulario para ingresar datos de productos en forma de tabla -->
            <form action="procesar_formulario.php" method="POST">
                <table class="w-full mb-4">
                    <!-- Encabezados de la tabla -->
                    <tr>
                        <th class="pr-4 font-semibold text-center">Nombre Producto</th>
                        <th class="pr-4 font-semibold text-center">Precio Estimado</th>
                        <th class="pr-4 font-semibold text-center">Nombre Rubro</th>
                        <th class="pr-4 font-semibold text-center">Código Rubro</th>
                        <th class="pr-4 font-semibold text-center">Saldo Rubro</th>
                        <th class="pr-4 font-semibold text-center">Acciones</th>
                    </tr>
                </table>
                <!-- Contenedor con altura fija y desbordamiento solo para los inputs -->
                <div class="inputs-container">
                    <table class="w-full">
                        <!-- Campos del producto aquí -->
                        <tr class="producto-clone">
                            <!-- ... Inputs ... -->
                            <td class="text-center">
                                <div class="input-wrapper">
                                    <input type="text" name="nombre" class="mt-1 p-2 w-full border rounded-md">
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="input-wrapper">
                                    <input type="number" name="precio_estimado" class="mt-1 p-2 w-full border rounded-md">
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="input-wrapper">
                                    <input type="text" name="nombre_rubro" class="mt-1 p-2 w-full border rounded-md">
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="input-wrapper">
                                    <input type="text" name="codigo_rubro" class="mt-1 p-2 w-full border rounded-md">
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="input-wrapper">
                                    <input type="number" name="saldo_rubro" class="mt-1 p-2 w-full border rounded-md">
                                </div>
                            </td>
                            <td class="text-center">
                                <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded delete-producto">Eliminar</button>
                            </td>
                        </tr>
                    </table>
                </div>
                <!-- Botón de Enviar -->
                <div class="mt-4 text-center">
                    <button id="agregar-producto" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Agregar Producto</button>
                </div>
                <div class="mt-4 text-center">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Guardar Producto</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById("agregar-producto").addEventListener("click", function(event) {
            event.preventDefault();

            // Clonar el primer conjunto de campos de producto
            var productoClonado = document.querySelector(".producto-clone").cloneNode(true);

            // Limpiar los valores de los campos clonados
            productoClonado.querySelectorAll("input").forEach(function(input) {
                input.value = "";
            });

            // Agregar el conjunto clonado al contenedor de productos
            document.querySelector(".inputs-container table").appendChild(productoClonado);

            // Agrega el evento de clic para los botones de eliminar en el producto clonado
            productoClonado.querySelector(".delete-producto").addEventListener("click", function(event) {
                event.preventDefault();

                // Encuentra el padre (fila) del botón y elimínala
                var filaProducto = productoClonado.closest(".producto-clone");
                filaProducto.parentNode.removeChild(filaProducto);
            });
        });
    </script>
</body>
</html>