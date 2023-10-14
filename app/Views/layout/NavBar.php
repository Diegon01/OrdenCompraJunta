
    <nav class=" bg-blue-500 p-2 text-white flex justify-between items-center shadow-md">
        <!-- Logo a la izquierda -->
        <a href="<?= base_url('/') ?>">
            <img src="<?= base_url('assets/images/LogoJunta.png') ?>" alt="Logo" width="80" height="80">
        </a>
        
        <!-- Botones de redirección en el centro -->
        <div class="space-x-4">
            <a href="<?= site_url('/alta-proveedor/crear') ?>" class="hover:underline text-lg font-semibold">Alta Proveedor</a>
            <a href="<?= site_url('/alta-orden-compra/crear') ?>" class="hover:underline text-lg font-semibold">Alta Orden de compra</a>
            <a href="<?= site_url('/registrar') ?>" class="hover:underline text-lg font-semibold">Alta Usuario</a>
            <a href="<?= site_url('/ordenes') ?>" class="hover:underline text-lg font-semibold">Órdenes de compra</a>
        </div>
        
        <!-- Cerrar sesión y la imagen de usuario a la derecha usando ml-auto -->
        <div class="flex items-center">
            <a href="<?= site_url('/logout') ?>" class="hover:underline text-lg font-semibold mr-4">Cerrar sesión</a>
            <div class="profile-image-container ml-2" style="max-width: 70px; max-height: 70px;">
                <img src="<?= base_url('assets/images/personaprueba.jpg') ?>" alt="Imagen de perfil" class="profile-image rounded-full">
            </div>
        </div>
    </nav>