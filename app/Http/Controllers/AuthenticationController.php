<?php

namespace App\Http\Controllers;

use App\Models\Managers\UserManager;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticationController extends Controller
{
    /**
     * Shows login form
     *
     * @param Request $request
     * @return Response
     */
    public function loginForm(Request $request): View
    {
        return view('authentication.login-form');
    }

    /**
     * Login
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function login(Request $request, UserManager $userManager): RedirectResponse
    {
        return $userManager->login($request->email, $request->password, null)
            ? redirect()->intended('home')
            : redirect()->back()->withInput()->withErrors([
                'error' => 'Login Failed'
            ]);
    }
}
