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
        <a class="hover:no-underline text-lg font-semibold box-shadow-hover" href="<?= base_url('/') ?>">
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
        </div>
        
        <!-- Cerrar sesión y la imagen de usuario a la derecha usando ml-auto -->
        <div class="flex items-center space-x-4">
            <div class="relative inline-block">
                <div id="optionsButton" class="profile-image-container ml-2" style="max-width: 70px; max-height: 70px;">
                    <img src="<?= base_url('assets/images/new_user.png') ?>" alt="Imagen de perfil" class="profile-image rounded-full hover:no-underline box-shadow-hover" style="cursor: pointer;">
                </div>
                <div id="optionsMenu" class="absolute hidden mt-2 bg-blue-500 rounded shadow-md" style="width: 225px; left: -175px; filter: drop-shadow(0 0 5px rgba(0, 0, 0, 0.50));">
                    <div class="mb-4">
                        <a href="<?= site_url('/editar-perfil') ?>" class="hover:no-underline box-shadow-hover px-4 text-lg font-semibold">🗝 Cambiar contraseña</a>
                    </div>
                    <div class="mb-2">
                        <a href="<?= site_url('/logout') ?>" class="hover:no-underline box-shadow-hover mr-4 px-4 text-lg font-semibold">🚪 Cerrar sesión</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <script>
        document.getElementById('optionsButton').addEventListener('click', function() {
            var optionsMenu = document.getElementById('optionsMenu');
            optionsMenu.classList.toggle('hidden');
            event.stopPropagation();
        });

        document.addEventListener('click', function(event) {
            var optionsMenu = document.getElementById('optionsMenu');
            var optionsButton = document.getElementById('optionsButton');

            // Verificar si el clic no ocurrió dentro del optionsMenu ni en el optionsButton
            if (!optionsMenu.contains(event.target) && event.target !== optionsButton && event.target !== optionsMenu) {
                optionsMenu.classList.add('hidden');
            }
        });
    </script>