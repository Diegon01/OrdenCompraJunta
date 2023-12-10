<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProyectoUser;
use App\Models\UserRolesModel;
use CodeIgniter\Events\Events;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Shield\Authentication\Authenticators\Session;
use CodeIgniter\Shield\Entities\User;
use CodeIgniter\Shield\Exceptions\ValidationException;
use CodeIgniter\Shield\Models\UserModel;
use CodeIgniter\Shield\Traits\Viewable;
use CodeIgniter\Shield\Validation\ValidationRules;
use Psr\Log\LoggerInterface;
use CodeIgniter\Files\File;


class ProyectoUsersController extends BaseController
{
    public function index()
    {
        //
    }

    use Viewable;

    protected $helpers = ['setting'];

    public function initController(
        RequestInterface $request,
        ResponseInterface $response,
        LoggerInterface $logger
    ): void {
        parent::initController(
            $request,
            $response,
            $logger
        );
    }

    /**
     * Attempts to register the user.
     */
    public function registerAction(): RedirectResponse
    {

        $users = $this->getUserProvider();

        // Validate here first, since some things,
        // like the password, can only be validated properly here.
        $rules = $this->getValidationRules();

        if (! $this->validateData($this->request->getPost(), $rules, [], config('Auth')->DBGroup)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Save the user
        $allowedPostFields = array_keys($rules);
        $user              = $this->getUserEntity();
        $user->fill($this->request->getPost($allowedPostFields));

        // Workaround for email only registration/login
        if ($user->username === null) {
            $user->username = null;
        }

        $config = [
            'upload_path'      => 'pfp/', // Ruta donde guardarás los archivos (asegúrate de que esta carpeta exista y sea escribible)
            'allowed_types'    => 'jpg|png',
            'max_size'         => 2048, // Tamaño máximo en kilobytes (2MB en este caso)
            'max_width'        => 1024,
            'max_height'       => 1024,
            'overwrite'        => true, // Sobrescribir el archivo si ya existe
            'file_name'        => 'pfp_' . uniqid() . '.png' // Nombre del archivo, puedes personalizarlo según tus necesidades
        ];

        // Cargar la biblioteca de carga de archivos con la configuración
        $archivo = $this->request->getFile('profile_pic');

        // Verificar si se cargó correctamente el archivo
        $rutaArchivo = null;
        if ($archivo->isValid() && !$archivo->hasMoved()) {
            // Si la carga fue exitosa, puedes obtener información sobre el archivo
            $archivo->move($config['upload_path'], $config['file_name']);

            // Aquí puedes procesar la información del archivo como almacenar la ruta en la base de datos, etc.
            // Por ejemplo, puedes guardar la ruta en la base de datos
            $rutaArchivo = 'pfp/' . $config['file_name'];
            $user->profile_pic = $rutaArchivo;
            // Guardar $rutaArchivo en la base de datos o realizar otras operaciones según tus necesidades
        } else {
            // Si la carga falló, puedes obtener los errores
        }

        // Set the additional fields (Nombres, Apellidos, Cédula) here
        $user->nombres = $this->request->getPost('nombres');
        $user->apellidos = $this->request->getPost('apellidos');
        $user->cedula = $this->request->getPost('cedula');

        $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $stringAleatorio = '';

        for ($i = 0; $i < 10; $i++) {
            $indiceAleatorio = rand(0, strlen($caracteres) - 1);
            $stringAleatorio .= $caracteres[$indiceAleatorio];
        }

        $pass_random = $stringAleatorio;
        $user->setPassword($pass_random);

        $notificacionController = new \App\Controllers\NotificacionController();
        $destino = $this->request->getPost('email');
        $notificacionController->notificarUsuarioCreado($destino, $pass_random);

        try {
            $users->save($user);
        } catch (ValidationException $e) {
            return redirect()->back()->withInput()->with('errors', $users->errors());
        }

        // To get the complete user object with ID, we need to get from the database
        $user = $users->findById($users->getInsertID());

        // Insert data into the "user_roles" table
        $userRolesModel = new \App\Models\UserRolesModel(); // Adjust the namespace as per your project structure
        $userRolesData = [
            'user_id' => $user->id,
            'Funcionario' => $this->request->getPost('Funcionario') !== null ? 1 : 0,
            'Contador' => $this->request->getPost('Contador') !== null ? 1 : 0,
            'Presidente' => $this->request->getPost('Presidente') !== null ? 1 : 0,
            'Secretario' => $this->request->getPost('Secretario') !== null ? 1 : 0,
            'Admin' => $this->request->getPost('Admin') !== null ? 1 : 0,
        ];
        $userRolesModel->insert($userRolesData);

        return redirect()->to('/registrar/exito');
    }

    public function changePassAction() {
        $users = auth()->getProvider();
        $currentUserId = auth()->user()->id;
        $oldPass = $this->request->getPost('password_current');
        $newPass = $this->request->getPost('password');
        $repPass = $this->request->getPost('password_confirm');
    
        // Reglas de validación
        $validationRules = [
            'password' => 'required|min_length[8]|regex_match[/[A-Z]/]|regex_match[/[0-9]/]',
            'password_confirm' => 'matches[password]'
        ];
    
        // Mensajes de error personalizados
        $validationMessages = [
            'password' => [
                'regex_match' => 'La contraseña debe contener al menos una mayúscula y un número.'
            ]
        ];
    
        // Validar
        if ($this->validate($validationRules, $validationMessages)) {
            if ($this->check_password($oldPass)) {
                if ($this->check_password($newPass)) {
                    return redirect()->to('/pass-validation');
                } else {
                    $user = $users->findById($currentUserId);
                    $user->fill([
                        'password' => $newPass
                    ]);
                    $users->save($user);
                    return redirect()->to('/registrar/exito');
                }
            }
            else {
                return redirect()->to('/pass-wrong');
            }
        } 
        else {
            // Muestra los mensajes de error de validación
            return redirect()->to('/pass-validation');
        }
    }

    public function changePFPAction() {
        $users = auth()->getProvider();
        $currentUserId = auth()->user()->id;
        $user = $users->findById($currentUserId);

        $config = [
            'upload_path'      => 'pfp/', // Ruta donde guardarás los archivos (asegúrate de que esta carpeta exista y sea escribible)
            'allowed_types'    => 'jpg|png',
            'max_size'         => 2048, // Tamaño máximo en kilobytes (2MB en este caso)
            'max_width'        => 1024,
            'max_height'       => 1024,
            'overwrite'        => true, // Sobrescribir el archivo si ya existe
            'file_name'        => 'pfp_' . uniqid() . '.png' // Nombre del archivo, puedes personalizarlo según tus necesidades
        ];

        // Cargar la biblioteca de carga de archivos con la configuración
        $archivo = $this->request->getFile('profile_pic');

        // Verificar si se cargó correctamente el archivo
        $rutaArchivo = null;
        if ($archivo->isValid() && !$archivo->hasMoved()) {
            // Si la carga fue exitosa, puedes obtener información sobre el archivo
            $archivo->move($config['upload_path'], $config['file_name']);

            


            // Aquí puedes procesar la información del archivo como almacenar la ruta en la base de datos, etc.
            // Por ejemplo, puedes guardar la ruta en la base de datos
            $rutaArchivo = 'pfp/' . $config['file_name'];

            // Procesar la imagen para hacerla cuadrada
            $imagen = \Config\Services::image();
            $imagen->withFile($rutaArchivo);

            // Obtener las dimensiones originales de la imagen
            $anchoOriginal = $imagen->getWidth();
            $altoOriginal = $imagen->getHeight();

            // Calcular el lado más corto para recortar la imagen y hacerla cuadrada
            $ladoCorto = min($anchoOriginal, $altoOriginal);

            // Configurar las coordenadas para el recorte centrado
            $x = ($anchoOriginal - $ladoCorto) / 2;
            $y = ($altoOriginal - $ladoCorto) / 2;

            // Realizar el recorte para hacer la imagen cuadrada
            $imagen->crop($ladoCorto, $ladoCorto, $x, $y);

            // Guardar la imagen recortada
            $imagen->save($rutaArchivo);

            $user->profile_pic = $rutaArchivo;
            $users->save($user);
            return redirect()->to('/registrar/exito');
            // Guardar $rutaArchivo en la base de datos o realizar otras operaciones según tus necesidades
        } else {
            // Si la carga falló, puedes obtener los errores
            $error = $this->upload->display_errors();
        }
        
    }

    public function changeMailAction() {
        $users = auth()->getProvider();
        $currentUserId = auth()->user()->id;
        $user = $users->findById($currentUserId);
        $pass = $this->request->getPost('password');
        $newMail = $this->request->getPost('email');

        $result = auth()->check([
            'email'    => auth()->user()->email,
            'password' => $pass,
        ]);

        if( $result->isOK() ) {
            $user->fill([
                'email' => $newMail
            ]);
            $users->save($user);
            return redirect()->to('/registrar/exito');
        }
        else {
            echo 'Nuh huh';
        }
    }

    public function editUserAdmin()
    {
        // Si se ha enviado un formulario (POST)
        if ($this->request->getMethod() === 'post') {
            // Obtener los datos del formulario

            $id = $this->request->getPost('idUs');
            $correo = $this->request->getPost('email');
            $nombres = $this->request->getPost('nombres');
            $apellidos = $this->request->getPost('apellidos');
            $cedula = $this->request->getPost('cedula');
            $funcionario = $this->request->getPost('Funcionario') ? 1 : 0;
            $contador = $this->request->getPost('Contador') ? 1 : 0;
            $presidente = $this->request->getPost('Presidente') ? 1 : 0;
            $secretario = $this->request->getPost('Secretario') ? 1 : 0;
            $admin = $this->request->getPost('Admin') ? 1 : 0;

            // Insertar en la base de datos
            $newUserModelo = new \App\Models\UserModelo();
            $usuario = $newUserModelo->find($id);
            $newUserModelo->update($id, ['nombres' => $nombres]);
            $newUserModelo->update($id, ['apellidos' => $apellidos]);
            $newUserModelo->update($id, ['cedula' => $cedula]);

            $userRolesModel = new \App\Models\UserRolesModel(); // Adjust the namespace as per your project structure
            $userRolesData = $userRolesModel->find($id);
            $userRolesModel->update($id, ['Funcionario' => $funcionario]);
            $userRolesModel->update($id, ['Contador' => $contador]);
            $userRolesModel->update($id, ['Presidente' => $presidente]);
            $userRolesModel->update($id, ['Secretario' => $secretario]);
            $userRolesModel->update($id, ['Admin' => $admin]);

            $users_auth = auth()->getProvider();
            $user_auth = $users_auth->findById($id);
            $user_auth->fill([
                'email' => $correo
            ]);
            $users_auth->save($user_auth);

            // Redirigir a una página de éxito o a la misma página
            // Puedes personalizar esta parte según tus necesidades

            return redirect()->to('/alta-proveedor/exito');
        }

        // Si no se ha enviado el formulario, cargar la vista
        return view('alta_rubro');
    }

    protected function getUserProvider(): UserModel
    {
        $provider = model(setting('Auth.userProvider'));

        assert($provider instanceof UserModel, 'Config Auth.userProvider is not a valid UserProvider.');

        return $provider;
    }

    /**
     * Returns the Entity class that should be used
     */
    protected function getUserEntity(): User
    {
        return new User();
    }

    /**
     * Returns the rules that should be used for validation.
     *
     * @return array<string, array<string, array<string>|string>>
     * @phpstan-return array<string, array<string, string|list<string>>>
     */
    protected function getValidationRules(): array
    {
        $rules = new ValidationRules();

        return $rules->getRegistrationRules();
    }

    public function check_password(string $password, ?string &$error = null): bool
    {
        $result = auth()->check([
            'email'    => auth()->user()->email,
            'password' => $password,
        ]);

        if( !$result->isOK() ) {
            // Send back the error message
            $error = lang('Auth.errorOldPassword');

            return false;
        }

        return true;
    } 
}
