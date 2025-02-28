<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            // Check user roles and redirect accordingly
            if ($request->user()->hasRole('admin') || $request->user()->hasRole('super-admin')) {
                return redirect()->intended(route('dashboard', absolute: false).'?verified=1');
            }

            // Otherwise redirect to home page
            return redirect()->intended('/?verified=1');
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        // Check user roles and redirect accordingly
        if ($request->user()->hasRole('admin') || $request->user()->hasRole('super-admin')) {
            return redirect()->intended(route('dashboard', absolute: false).'?verified=1');
        }

        // Otherwise redirect to home page
        return redirect()->intended('/?verified=1');
    }
}
