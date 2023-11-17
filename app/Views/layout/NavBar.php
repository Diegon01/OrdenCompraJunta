    <style>
        .box-shadow-hover:hover {
        filter: drop-shadow(0 0 10px rgba(255, 255, 255, 0.90));
        }

        .box-shadow-hover {
        transition: filter 0.3s ease; /* Ajusta la duración y la función de temporización según tus preferencias */
        }
    </style>

    <nav class=" bg-blue-500 p-2 text-white flex justify-between items-center shadow-md">
        <!-- Logo a la izquierda -->
        <a href="<?= base_url('/') ?>">
            <img src="<?= base_url('assets/images/LogoJunta.png') ?>" alt="Logo" width="80" height="80">
        </a>
        
        <!-- Botones de redirección en el centro -->
        <div class="space-x-4">
            <?php if ($isFuncionario) : ?>
                <a href="<?= site_url('/ordenes-botones') ?>" class="hover:no-underline text-lg font-semibold box-shadow-hover">Solicitudes y Órdenes</a>
            <?php endif; ?>
            <?php if ($isContador || $isAdmin) : ?>
                <a href="<?= site_url('/administracion') ?>" class="hover:no-underline text-lg font-semibold box-shadow-hover">Administración</a>
            <?php endif; ?> 
            <a href="<?= site_url('/editar-perfil') ?>" class="hover:no-underline text-lg font-semibold box-shadow-hover">Cambiar contraseña</a>
        </div>
        
        <!-- Cerrar sesión y la imagen de usuario a la derecha usando ml-auto -->
        <div class="flex items-center">
            <a href="<?= site_url('/logout') ?>" class="hover:no-underline text-lg font-semibold box-shadow-hover mr-4">Cerrar sesión</a>
            <div class="profile-image-container ml-2" style="max-width: 70px; max-height: 70px;">
                <img src="<?= base_url('assets/images/personaprueba.jpg') ?>" alt="Imagen de perfil" class="profile-image rounded-full">
            </div>
        </div>
    </nav>