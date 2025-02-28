<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
     */
    public function __invoke(Request $request): RedirectResponse|View
    {
        if ($request->user()->hasVerifiedEmail()) {
            // Check user roles and redirect accordingly
            if ($request->user()->hasRole('admin') || $request->user()->hasRole('super-admin')) {
                return redirect()->intended(route('dashboard', absolute: false));
            }

            // Otherwise redirect to home page
            return redirect()->intended('/');
        }

        return view('auth.verify-email');
    }
}
