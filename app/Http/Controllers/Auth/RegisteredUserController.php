<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'email_verified_at' => now(),
            'password' => Hash::make($request->password),
            'remember_token' => Str::random(60),
            
        ]);

        // event(new Registered($user));

        // Auth::login($user);
        // if (Auth::check()) {
        //     if(Auth::user()->role == 'admin')
        //     {
        //         return redirect()->intended(route('admin.dashboard', absolute: false));

        //     } elseif(Auth::user()->role == 'manajer_gudang')
        //     {
        //         return redirect()->intended(route('manager.dashboard', absolute: false));
                
        //     } elseif(Auth::user()->role == 'staff_gudang')
        //     {
        //         return redirect()->intended(route('staff.dashboard', absolute: false));
        //     }
        // }

        // return redirect(route('dashboard', absolute: false));
        return redirect()->route('login');
    }
}
