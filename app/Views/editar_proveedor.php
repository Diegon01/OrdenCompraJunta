<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar proveedor</title>
    <!-- Agrega los estilos de Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
</head>

<header> 
    <?= view('layout/navbar') ?>
</header>

<body class="bg-gray-100">
    <div class="h-screen flex justify-center items-center border border-blue-200" style="filter: drop-shadow(0 0 10px rgba(66, 135, 245, 0.50));">
        <div class="bg-white p-8 rounded shadow-md max-w-md w-full text-center">
            <h1 class="text-2xl font-semibold mb-6 text-center">Editar proveedor</h1>

        <!-- Formulario para el alta de proveedor -->
        <form action="<?= base_url('editar-proveedor/aceptar') ?>" method="POST">

            <!-- Campo Nombre de Proveedor -->
            <input type="hidden" id="idProveedor" name="idProveedor" value="<?= $proveedor['id'] ?>">
            <div class="mb-4 flex items-center">
                <label for="nombreProveedor" class="block text-sm font-medium text-gray-600 w-[150px] text-left">Nombre de Proveedor</label>
                <input type="text" id="nombreProveedor" name="nombreProveedor" class="mt-1 p-2 w-full border rounded" value="<?= $proveedor['nombre'] ?>" readonly>
            </div>

            <!-- Campo Persona de Contacto -->
            <div class="mb-4 flex items-center">
                <label for="personaContacto" class="block text-sm font-medium text-gray-600 w-[150px] text-left ">Persona de Contacto</label>
                <input type="text" id="personaContacto" name="personaContacto" class="mt-1 p-2 w-full border rounded" value="<?= $proveedor['persona_de_contacto'] ?>">
            </div>

            <!-- Campo Número de Contacto -->
            <div class="mb-4 flex items-center">
                <label for="numeroContacto" class="block text-sm font-medium text-gray-600 w-[150px] text-left">Número de Contacto</label>
                <input type="text" id="numeroContacto" name="numeroContacto" class="mt-1 p-2 w-full border rounded" value="<?= $proveedor['numero_de_contacto'] ?>">
            </div>

            <!-- Campo RUT -->
            <div class="mb-4 flex items-center">
                <label for="rut" class="block text-sm font-medium text-gray-600 w-[150px] text-left">RUT</label>
                <input type="numer" min="100000000000" max="999999999999" id="rut" name="rut" class="ml-2 mt-1 p-2 pr-5 w-full border rounded" value="<?= $proveedor['RUT'] ?>" readonly>
            </div>

            <!-- Campo Número de Cuenta -->
            <div class="mb-4 flex items-center">
                <label for="numeroCuenta" class="block text-sm font-medium text-gray-600 w-[150px] text-left">Número de Cuenta</label>
                <input type="text" id="numeroCuenta" name="numeroCuenta" class="mt-1 p-2 w-full border rounded" value="<?= $proveedor['numero_de_cuenta'] ?>">
            </div>

            <!-- Fecha de Vencimiento DGI -->
            <div class="mb-4 flex items-center">
                <label for="fechaVencimientoDgi" class="block text-sm font-medium text-gray-600 w-[150px] text-left">Fecha de Vencimiento DGI</label>
                <input type="date" id="fechaVencimientoDgi" name="fechaVencimientoDgi" class="mt-1 p-2 w-full border rounded" value="<?= $proveedor['fecha_de_vencimiento_dgi'] ?>">
            </div>

            <!-- Fecha de Vencimiento BPS -->
            <div class="mb-4 flex items-center">
                <label for="fechaVencimientoBps" class="block text-sm font-medium text-gray-600 w-[150px] text-left">Fecha de Vencimiento BPS</label>
                <input type="date" id="fechaVencimientoBps" name="fechaVencimientoBps" class="mt-1 p-2 w-full border rounded" value="<?= $proveedor['fecha_de_vencimiento_bps'] ?>">
            </div>

            <div class="mt-8 space-x-2 flex justify-center items-center">
                <!-- Campo RUPE -->
                <?php if ($proveedor['rupe'] === '1') { ?>
                    <div class="inline-flex items-center">
                        <label for="rupe" class="block text-sm font-medium text-gray-600 mr-2">RUPE</label>
                        <input type="checkbox" id="rupe" name="rupe" class="form-checkbox h-5 w-5 text-blue-600" checked>
                    </div>
                <?php } ?>
                <?php if ($proveedor['rupe'] === '0') { ?>
                    <div class="inline-flex items-center">
                        <label for="rupe" class="block text-sm font-medium text-gray-600 mr-2">RUPE</label>
                        <input type="checkbox" id="rupe" name="rupe" class="form-checkbox h-5 w-5 text-blue-600">
                    </div>
                <?php } ?>
                
                <!-- Campo Empresa del Estado -->
                <?php if ($proveedor['empresa_del_estado'] === '1') { ?>
                    <div class="inline-flex items-center">
                        <label for="empresaEstado" class="block text-sm font-medium text-gray-600 mr-2">Empresa del Estado</label>
                        <input type="checkbox" id="empresaEstado" name="empresaEstado" class="form-checkbox h-5 w-5 text-blue-600" checked>
                    </div>
                <?php } ?>
                <?php if ($proveedor['empresa_del_estado'] === '0') { ?>
                    <div class="inline-flex items-center">
                        <label for="empresaEstado" class="block text-sm font-medium text-gray-600 mr-2">Empresa del Estado</label>
                        <input type="checkbox" id="empresaEstado" name="empresaEstado" class="form-checkbox h-5 w-5 text-blue-600">
                    </div>
                <?php } ?>
            </div>

            <!-- Botón de enviar -->
            <div class="flex justify-center mt-8">
                <button type="submit"
                    class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded focus:outline-none focus:ring focus:border-blue-300">
                    Aceptar cambios
                </button>
            </div>
        </form>
    </div>
    </div>
</body>
