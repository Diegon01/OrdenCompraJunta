<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido a mi sitio</title>
    <!-- Enlaza el archivo CSS compilado de Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
</head>
<header> 
    <?= view('layout/navbar') ?>
</header>
<body class="bg-gray-100">
    <div class="container mx-auto py-16">
        <h1 class="text-4xl font-bold text-center text-blue-500">¡Bienvenido a mi sitio web!</h1>
        <p class="mt-4 text-lg text-gray-700 text-center">Aquí encontrarás contenido interesante y útil.</p>
    </div>
</body>
</html>