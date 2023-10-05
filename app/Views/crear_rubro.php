<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear rubro</title>
    <!-- Enlaza el archivo CSS compilado de Tailwind CSS -->
    <link href="./css/app.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
<?= view('layout/navbar') ?>
    <div class="container mx-auto py-16">
        <h1 class="text-4xl font-bold text-center text-blue-500">¡Bienvenido a mi sitio web!</h1>
        <p class="mt-4 text-lg text-gray-700 text-center">Con este botón creas un rubro de prueba.</p>
        
        <form action="rubro/insert" method="post" class="mt-8 flex justify-center">
            <!-- Add form fields here as needed -->
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-6 rounded-full text-lg">Crear</button>
        </form>
    </div>
</body>
</html>