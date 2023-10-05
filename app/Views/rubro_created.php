<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rubro exitoso</title>
    <!-- Enlaza el archivo CSS compilado de Tailwind CSS -->
    <link href="/css/app.css" rel="stylesheet">
</head>

    <body class="bg-blue-100 flex items-center justify-center h-screen">
        <div class="bg-white p-8 rounded-lg shadow-md w-96 mx-auto">
            <!-- Header -->
            <h1 class="text-3xl font-semibold text-gray-800 mb-4">Rubro Creado con Éxito</h1>
            
            <!-- Success message -->
            <div class="bg-blue-500 border border-blue-700 text-white px-4 py-2 rounded relative" role="alert">
                <strong class="font-bold">¡Éxito!</strong>
                <span class="block sm:inline">El rubro se ha creado correctamente.</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </span>
            </div>
            
            <!-- Return link -->
            <a href="/" class="block text-blue-500 mt-4 hover:underline">Volver a la página principal</a>
        </div>
    </body>
</html>