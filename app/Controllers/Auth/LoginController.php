<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\Shield\Authentication\Authenticators\Session;

class LoginController extends BaseController
{
    public function loginView()
    {
        if (auth()->loggedIn()) {
            return redirect()->to(config('Auth')->loginRedirect());
        }

        /** @var Session $authenticator */
        $authenticator = auth('session')->getAuthenticator();

        // If an action has been defined, start it up.
        if ($authenticator->hasAction()) {
            return redirect()->route('auth-action-show');
        }

        return view('auth/login'); // panggil view login
    }

    public function loginAction(): RedirectResponse
    {
        $rules = [
            'login'    => 'required', // bisa username/email
            'password' => 'required'
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $login      = $this->request->getPost('login');
        $password   = $this->request->getPost('password');
        $remember   = (bool) $this->request->getPost('remember');

        $authenticator = auth('session')->getAuthenticator();

        $result = $authenticator->remember($remember)
            ->attempt([
                'login'    => $login,
                'password' => $password
            ]);

        if (! $result->isOK()) {
            return redirect()->back()
                ->withInput()
                ->with('error', $result->reason());
        }

        // Login sukses → simpan username ke session
        $user = auth()->user();
        session()->set('username', $user->username);

        // Redirect ke dashboard
        return redirect()->to('/');
    }

    public function logout(): RedirectResponse
    {
        auth()->logout();
        session()->remove('username'); // hapus session username
        return redirect()->to('/auth/login');
    }
}
