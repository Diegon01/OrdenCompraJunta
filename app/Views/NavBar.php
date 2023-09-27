<!-- app/Views/layout/navbar.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Tu Aplicación</title>
    <!-- Agrega los estilos de Tailwind CSS -->
    <link href="/css/app.css" rel="stylesheet">
</head>
<body>
    <!-- Barra de navegación -->
    <nav class=" bg-blue-500 p-4 text-white flex justify-between items-center ">
        <!-- Logo a la izquierda -->
        <img src="<?= base_url('assets/images/LogoJunta.png') ?>" alt="Logo" width="100" height="100">
        
        <!-- Botones de redirección en el centro -->
        <div class="space-x-4">
            <a href="<?= site_url('pagina1') ?>" class="hover:underline text-lg font-semibold">Página 1</a>
            <a href="<?= site_url('pagina2') ?>" class="hover:underline text-lg font-semibold">Página 2</a>
            <a href="<?= site_url('pagina3') ?>" class="hover:underline text-lg font-semibold">Página 3</a>
        </div>
        
        <!-- Cerrar sesión y la imagen de usuario a la derecha usando ml-auto -->
        <div class="flex items-center">
            <a href="<?= site_url('auth/logout') ?>" class="hover:underline text-lg font-semibold mr-4">Cerrar sesión</a>
            <div class="w-20 h-20 profile-image-container">
                <img src="<?= base_url('assets/images/personaprueba.jpg') ?>" alt="Imagen de perfil" class="profile-image rounded-full">
            </div>
        </div>
    </nav>
</body>
</html>