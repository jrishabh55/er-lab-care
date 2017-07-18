<?php

namespace App\Http\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

trait ClientLogin
{
    public function clientLogin(Request $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptClientLogin($request)) {
            return $this->sendClientLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    protected function attemptClientLogin(Request $request)
    {
        return $this->clientGuard()->attempt(
            $this->credentials($request), $request->has('remember')
        );
    }

    protected function clientGuard()
    {
        return Auth::guard('client_web');
    }

    protected function sendClientLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        return $this->authenticated($request, $this->clientGuard()->user())
            ?: redirect()->intended($this->redirectClientPath());
    }

    public function redirectClientPath()
    {
        if (method_exists($this, 'redirectToClient')) {
            return $this->redirectToClient();
        }

        return property_exists($this, 'redirectToClientTo') ? $this->redirectTo : '/home';
    }

    public function redirectToClient()
    {
        return 'services';
    }

}