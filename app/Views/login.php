<!-- app/Views/auth/login.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Iniciar sesión</title>
    <!-- Agrega los estilos de Tailwind CSS -->
    <link href="/css/app.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded-lg shadow-md w-96">
        <!-- Reducir el tamaño de la imagen al 80% y centrarla -->
        <img src="<?= base_url('assets/images/LogoJunta.png') ?>" alt="Imagen de inicio de sesión" class="mx-auto mb-6 w-80">
        
        <!-- Aumentar el tamaño del título "Iniciar sesión" -->
        <h2 class="text-3xl font-semibold text-center text-blue-500 mb-6">Iniciar sesión</h2>
        <form action="<?= site_url('auth/login') ?>" method="post">
            <div class="mb-4 text-center mt-4">
                <label for="email" class="block text-gray-600 text-blue-500">Correo electrónico</label>
                <input type="email" name="email" id="email" class="w-full px-3 py-2 border rounded-lg shadow-sm focus:outline-none focus:border-blue-500" required>
            </div>
            <div class="mb-6 text-center">
                <label for="password" class="block text-gray-600 text-blue-500">Contraseña</label>
                <input type="password" name="password" id="password" class="w-full px-3 py-2 border rounded-lg shadow-sm focus:outline-none focus:border-blue-500" required>
            </div>
            <!-- Centrar y separar el botón de Iniciar sesión -->
            <div class="mb-4 text-center mt-4">
                <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 focus:outline-none focus:bg-blue-600 mt-4">Iniciar sesión</button>
            </div>
        </form>
    </div>
</body>
</html>