
    <nav class=" bg-blue-500 p-2 text-white flex justify-between items-center shadow-md">
        <!-- Logo a la izquierda -->
        <a href="<?= base_url('/') ?>">
            <img src="<?= base_url('assets/images/LogoJunta.png') ?>" alt="Logo" width="80" height="80">
        </a>
        
        <!-- Botones de redirección en el centro -->
        <div class="space-x-4">
            <?php if ($isContador || $isAdmin) : ?>
                <a href="<?= site_url('/alta-proveedor/crear') ?>" class="hover:underline text-lg font-semibold">Alta Proveedor</a>
            <?php endif; ?>
            <?php if ($isFuncionario) : ?>
                <a href="<?= site_url('/alta-solicitud-orden-compra/crear') ?>" class="hover:underline text-lg font-semibold">Alta Solicitud de compra</a>
            <?php endif; ?>
            <?php if ($isAdmin) : ?>
                <a href="<?= site_url('/registrar') ?>" class="hover:underline text-lg font-semibold">Alta Usuario</a>
            <?php endif; ?>
            <?php if ($isContador || $isAdmin || $isPresidente || $isSecretario) : ?>
                <a href="<?= site_url('/ordenes') ?>" class="hover:underline text-lg font-semibold">Administrar solicitudes</a>
            <?php endif; ?>
            <?php if ($isFuncionario) : ?>
                <a href="<?= site_url('/misordenes') ?>" class="hover:underline text-lg font-semibold">Mis solicitudes</a>
            <?php endif; ?>
            
                <a href="<?= site_url('/alta-rubro/crear') ?>" class="hover:underline text-lg font-semibold">Alta Rubro</a>

        </div>
        
        <!-- Cerrar sesión y la imagen de usuario a la derecha usando ml-auto -->
        <div class="flex items-center">
            <a href="<?= site_url('/logout') ?>" class="hover:underline text-lg font-semibold mr-4">Cerrar sesión</a>
            <div class="profile-image-container ml-2" style="max-width: 70px; max-height: 70px;">
                <img src="<?= base_url('assets/images/personaprueba.jpg') ?>" alt="Imagen de perfil" class="profile-image rounded-full">
            </div>
        </div>
    </nav>
<?php if ($isAdmin) : ?>
    <p> ::Administrador:: </p>
<?php endif; ?>
<?php if ($isFuncionario) : ?>
    <p> ::Funcionario:: </p>
<?php endif; ?>
<?php if ($isContador) : ?>
    <p> ::Contador:: </p>
<?php endif; ?>
<?php if ($isPresidente) : ?>
    <p> ::Presidente:: </p>
<?php endif; ?>
<?php if ($isSecretario) : ?>
    <p> ::Secretario:: </p>
<?php endif; ?>