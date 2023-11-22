<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.15/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/interact.js/dist/interact.min.js"></script>
    <style>
        .inputs-container {
            max-height: 270px;
            overflow-y: auto;
            margin-top: 60px;
            margin-bottom: 10px;
            position: relative;
        }

        .descripcion-container {
            max-height: 135px;
            margin-top: 2rem;
            position: relative;
        }

        .bg-gray-100 {
            min-height: 100vh;
        }

        


        .proveedores-container {
            display: flex;
            justify-content: center;
            gap: 300px; /* Espacio de separación entre los textareas */
        }

        .proveedores-textarea {
            width: 700px; /* Ancho del textarea (ajustado según tus necesidades) */
            height: 300px!important; /* Altura del textarea (ajustado según tus necesidades) */
            padding: 20px; /* Espaciado interno del textarea */
            resize: none; /* Evitar que el textarea sea redimensionable por el usuario */
            overflow-y: auto; /* Mostrar barra de desplazamiento solo cuando sea necesario */
        } 
        
        .modal {
            display: none;
        }
        #searchInput {
            margin-bottom: 0.5rem; /* Ajusta este valor según sea necesario */
        }

        .page-container {
            min-height: 100vh; /* Establece la altura del contenedor al 100% del viewport */
        }

        #searchResults {
            display: none;
        }

        #searchResults.active {
            display: block;
        }

    </style>
</head>
<header> 
    <?= view('layout/navbar') ?>
</header>
<body class="bg-gray-100">
    <div class="bg-gray-100 p-2">
        <div class="page-container bg-gray-200 p-4 pt-8">
            <h1 class="text-3xl font-semibold mb-4 text-center text-blue-500">Orden de Compra Nº <?= $orden['id'] ?></h1>

            <div class="text-center pt-5">
                <?php if ($orden['secretario_visto'] === '0') : ?>
                    <span class="bg-green-500 text-white p-2">
                    EMITIDA
                    </span>
                    <br>
                    <br>
                    <span class="bg-yellow-500 text-white p-2">
                    PENDIENTE VISTO BUENO DEL SECRETARIO
                    </span>
                <?php endif; ?>
                <?php if ($orden['secretario_visto'] === '1') : ?>
                    <span class="bg-green-500 text-white p-2">
                    EMITIDA Y LISTA
                    </span>
                <?php endif; ?>
            </div>
            <br>

            <div class="solicitante-container p-4">
                <label class="font-semibold text-2xl text-center pb-2 block">Solicitante:</label>
                <table class="w-auto mx-auto">
                    <tr>
                        <th class="pr-4 font-semibold text-center sticky top-0 bg-white z-10"></th>
                        <th class="pr-4 font-semibold text-center sticky top-0 bg-white z-10">Nombres y apellidos</th>
                        <th class="pr-4 font-semibold text-center sticky top-0 bg-white ">Cedula</th>
                    </tr>

                    <tr class="text-center">
                        <td class="justify-right">
                            <?php if ($solicitante->profile_pic === null) { ?>
                                <img src="<?= base_url('assets/images/new_user.png') ?>" alt="Imagen de perfil" class="profile-image rounded-full hover:no-underline box-shadow-hover" style="max-width: 50px; max-height: 50px; margin-right: 5px;">
                            <?php } else { ?>
                                <img src="<?= base_url($solicitante->profile_pic) ?>" alt="Imagen de perfil" class="profile-image rounded-full hover:no-underline box-shadow-hover" style="max-width: 50px; max-height: 50px; margin-right: 5px;">
                            <?php } ?>
                        </td>
                        <td class="text-center">
                            <div class="input-wrapper">
                                <input type="text" name="precio_estimado[]"
                                    class="mt-1 p-2 w-full border text-center rounded-md text-black placeholder-black"
                                    style="background: transparent;"
                                    readonly
                                    placeholder="<?= $solicitante->nombres ?> <?= $solicitante->apellidos ?>">
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="input-wrapper">
                                <input type="text" name="nombre[]"
                                    class="mt-1 p-2 w-full border text-center rounded-md text-black placeholder-black"
                                    style="background: transparent;"
                                    readonly
                                    placeholder="<?= $solicitante->cedula ?>">
                            </div>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="proveedor-container p-4">
                <label class="font-semibold text-2xl text-center pb-2 block">Proveedor:</label>
                <table class="w-auto mx-auto">
                    <tr>
                        <th class="pr-4 font-semibold text-center sticky top-0 bg-white z-10">RUT</th>
                        <th class="pr-4 font-semibold text-center sticky top-0 bg-white z-10">Proveedor</th>
                        <th class="pr-4 font-semibold text-center sticky top-0 bg-white z-10">Número de contacto</th>
                        <th class="pr-4 font-semibold text-center sticky top-0 bg-white z-10">Estado de actividad del DGI</th>
                        <th class="pr-4 font-semibold text-center sticky top-0 bg-white z-10">Vencimiento del DGI</th>
                        <th class="pr-4 font-semibold text-center sticky top-0 bg-white z-10">Vencimiento del BPS</th>
                        <th class="pr-4 font-semibold text-center sticky top-0 bg-white z-10">RUPE</th>
                        <th class="pr-4 font-semibold text-center sticky top-0 bg-white z-10">Empresa estatal</th>
                    </tr>

                    <tr class="producto-clone">
                        <td class="text-center">
                            <div class="input-wrapper">
                                <input type="text" name="nombre_producto"
                                    class="mt-1 p-2 w-full border text-center rounded-md text-black placeholder-black"
                                    style="background: transparent;"
                                    readonly
                                    placeholder=""
                                    value="<?= $proveedor['RUT'] ?>">
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="input-wrapper">
                                <input type="text" name="nombre_producto"
                                    class="mt-1 p-2 w-full border text-center rounded-md text-black placeholder-black"
                                    style="background: transparent;"
                                    readonly
                                    placeholder=""
                                    value="<?= $proveedor['nombre'] ?>">
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="input-wrapper">
                                <input type="text" name="nombre_producto"
                                    class="mt-1 p-2 w-full border text-center rounded-md text-black placeholder-black"
                                    style="background: transparent;"
                                    readonly
                                    placeholder=""
                                    value="<?= $proveedor['numero_de_contacto'] ?>">
                            </div>
                        </td>
                        <?php if($estadoActividad === 'AA') { ?>
                            <td class="text-center">
                                <div class="input-wrapper">
                                    <input type="text" name="nombre_producto[]"
                                        class="mt-1 p-2 w-full border text-center rounded-md text-black placeholder-black"
                                        style="background: transparent;"
                                        readonly
                                        placeholder=""
                                        value="Activo">
                                </div>
                            </td>
                        <?php } ?>
                        <?php if($estadoActividad === 'AF') { ?>
                            <td class="text-center">
                                <div class="input-wrapper">
                                    <input type="text" name="nombre_producto[]"
                                        class="mt-1 p-2 w-full border text-center rounded-md text-black placeholder-black"
                                        style="background: transparent;"
                                        readonly
                                        placeholder=""
                                        value="Activo futuro">
                                </div>
                            </td>
                        <?php } ?>
                        <?php if($estadoActividad === 'CC') { ?>
                            <td class="text-center">
                                <div class="input-wrapper">
                                    <input type="text" name="nombre_producto[]"
                                        class="mt-1 p-2 w-full border text-center rounded-md text-black placeholder-black"
                                        style="background: transparent;"
                                        readonly
                                        placeholder=""
                                        value="Cancelado">
                                </div>
                            </td>
                        <?php } ?>
                        <?php if($estadoActividad === 'CH') { ?>
                            <td class="text-center">
                                <div class="input-wrapper">
                                    <input type="text" name="nombre_producto[]"
                                        class="mt-1 p-2 w-full border text-center rounded-md text-black placeholder-black"
                                        style="background: transparent;"
                                        readonly
                                        placeholder=""
                                        value="Cancelado hoy">
                                </div>
                            </td>
                        <?php } ?>
                        <?php if($estadoActividad === 'NT') { ?>
                            <td class="text-center">
                                <div class="input-wrapper">
                                    <input type="text" name="nombre_producto[]"
                                        class="mt-1 p-2 w-full border text-center rounded-md text-black placeholder-black"
                                        style="background: transparent;"
                                        readonly
                                        placeholder=""
                                        value="No tiene">
                                </div>
                            </td>
                        <?php } ?>
                        <?php if($estadoActividad === null) { ?>
                            <td class="text-center">
                                <div class="input-wrapper">
                                    <input type="text" name="nombre_producto[]"
                                        class="mt-1 p-2 w-full border text-center rounded-md text-black placeholder-black"
                                        style="background: transparent;"
                                        readonly
                                        placeholder=""
                                        value="Error 404">
                                </div>
                            </td>
                        <?php } ?>
                        <td class="text-center">
                            <div class="input-wrapper">
                                <input type="text" name="nombre_producto"
                                    class="mt-1 p-2 w-full border text-center rounded-md text-black placeholder-black"
                                    style="background: transparent;"
                                    readonly
                                    placeholder=""
                                    value="<?= date('Y-m-d', strtotime($proveedor['fecha_de_vencimiento_dgi'])) ?>">
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="input-wrapper">
                                <input type="text" name="nombre_producto"
                                    class="mt-1 p-2 w-full border text-center rounded-md text-black placeholder-black"
                                    style="background: transparent;"
                                    readonly
                                    placeholder=""
                                    value="<?= date('Y-m-d', strtotime($proveedor['fecha_de_vencimiento_bps'])) ?>">
                            </div>
                        </td>
                        <td class="text-center">
                            <?php if ($proveedor['rupe']) : ?>
                                <div class="input-wrapper">
                                    <input type="text" name="nombre_producto"
                                        class="mt-1 p-2 w-full border text-center rounded-md text-black placeholder-black"
                                        style="background: transparent;"
                                        readonly
                                        placeholder=""
                                        value="Sí">
                                </div>
                            <?php endif; ?>
                            <?php if (!$proveedor['rupe']) : ?>
                                <div class="input-wrapper">
                                    <input type="text" name="nombre_producto"
                                        class="mt-1 p-2 w-full border text-center rounded-md text-black placeholder-black"
                                        style="background: transparent;"
                                        readonly
                                        placeholder=""
                                        value="No">
                                </div>
                            <?php endif; ?>
                        </td>
                        <td class="text-center">
                            <?php if ($proveedor['empresa_del_estado']) : ?>
                                <div class="input-wrapper">
                                    <input type="text" name="nombre_producto"
                                        class="mt-1 p-2 w-full border text-center rounded-md text-black placeholder-black"
                                        style="background: transparent;"
                                        readonly
                                        placeholder=""
                                        value="Sí">
                                </div>
                            <?php endif; ?>
                            <?php if (!$proveedor['empresa_del_estado']) : ?>
                                <div class="input-wrapper">
                                    <input type="text" name="nombre_producto"
                                        class="mt-1 p-2 w-full border text-center rounded-md text-black placeholder-black"
                                        style="background: transparent;"
                                        readonly
                                        placeholder=""
                                        value="No">
                                </div>
                            <?php endif; ?>
                        </td>
                    </tr>
                </table>
            </div>

            
            <div class="productos-container p-4">
                <label class="font-semibold text-2xl text-center pb-2 block">Ítems:</label>
                <table class="w-auto mx-auto">
                    <tr>
                        <th class="pr-4 font-semibold text-center sticky top-0 bg-white z-10">Nombre</th>
                        <th class="pr-4 font-semibold text-center sticky top-0 bg-white z-10">Cantidad</th>
                        <th class="pr-4 font-semibold text-center sticky top-0 bg-white z-10">Costo unitario</th>
                        <th class="pr-4 font-semibold text-center sticky top-0 bg-white z-10">Costo total</th>
                        <th class="pr-4 font-semibold text-center sticky top-0 bg-white z-10">Rubro</th>
                        <th class="pr-4 font-semibold text-center sticky top-0 bg-white z-10">Notas</th>
                    </tr>
                    <?php foreach ($productos as $producto) { ?>
                    <tr class="producto-clone">
                        <td class="text-center">
                            <div class="input-wrapper">
                                <input type="text" name="nombre[]"
                                    class="mt-1 p-2 w-full border text-center rounded-md text-black placeholder-black"
                                    style="background: transparent;"
                                    readonly
                                    placeholder="<?= $producto['nombre'] ?>">
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="input-wrapper">
                                <input type="text" name="cantidad[]"
                                    class="mt-1 p-2 w-full border text-center rounded-md text-black placeholder-black"
                                    style="background: transparent;"
                                    readonly
                                    placeholder="<?= $producto['cantidad'] ?>">
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="input-wrapper">
                                <input type="text" name="costo[]"
                                    class="mt-1 p-2 w-full border text-center rounded-md text-black placeholder-black"
                                    style="background: transparent;"
                                    readonly
                                    placeholder="<?= $producto['costo'] ?>">
                            </div>
                        </td>
                        <?php $total = ($producto['costo'] * $producto['cantidad']); ?>
                        <td class="text-center">
                            <div class="input-wrapper">
                                <input type="text" name="costototal[]"
                                    class="mt-1 p-2 w-full border text-center rounded-md text-black placeholder-black"
                                    style="background: transparent;"
                                    readonly
                                    placeholder="<?= $total ?>">
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="input-wrapper">
                                <?php foreach ($rubros as $rubro) {
                                        if ($rubro['codigo'] == $producto['rubro_id']) {
                                            $nombre = $rubro['nombre'];
                                            break; // Romper el bucle una vez que se haya encontrado el rubro
                                        }
                                    }
                                ?>
                                <input type="text" name="rubro[]"
                                    class="mt-1 p-2 w-full border text-center rounded-md text-black placeholder-black"
                                    style="background: transparent;"
                                    readonly
                                    placeholder="<?= $nombre ?>">
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="input-wrapper">
                                <input type="text" name="notas[]"
                                    class="mt-1 p-2 w-full border text-center rounded-md text-black placeholder-black"
                                    style="background: transparent;"
                                    readonly
                                    placeholder="<?= $producto['notas'] ?>">
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
            </div>

            <form action="<?= base_url('secretario-aprueba') ?>" method="POST">
                <?= csrf_field() ?>
                <br>
                <input type="hidden" name="order_id" value="<?= $orden['id'] ?>">
                <div class="mt-0 py-2 text-center">
                    <?php if ($isSecretario && $orden['secretario_visto'] === '0') : ?>
                        <button id="aprobarBtn_p" type="submit" class="bg-green-500 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded" onclick="enviarFormularioSecretario()">Marcar como visto</button>
                    <?php endif; ?>
                </div>
            </form>

</body>

</html>