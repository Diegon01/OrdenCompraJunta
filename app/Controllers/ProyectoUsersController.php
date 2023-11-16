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
            if ($this->old_password($newPass)) {
                echo 'La nueva contraseña no puede ser igual a la actual';
            } else {
                $user = $users->findById($currentUserId);
                $user->fill([
                    'password' => $newPass
                ]);
                $users->save($user);
                echo 'Éxito';
            }
        } 
        else {
            // Muestra los mensajes de error de validación
            echo 'La contraseña debe tener al menos 8 caracteres, una mayúscula y un número';
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
            echo 'Éxito';
        }
        else {
            echo 'Nuh huh';
        }
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

    public function old_password(string $password, ?string &$error = null): bool
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
