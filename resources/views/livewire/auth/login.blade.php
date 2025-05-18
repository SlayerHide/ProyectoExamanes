<?php

use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;
use Illuminate\Support\Facades\Gate;

new #[Layout('components.layouts.auth')] class extends Component {
    #[Validate('required|string|email')]
    public string $email = '';

    #[Validate('required|string')]
    public string $password = '';

    public bool $remember = false;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->ensureIsNotRateLimited();

        if (! Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
        Session::regenerate();

        $user = Auth::user();
        //Validar si el usuario tiene algún rol oficial antes de redirigir
        if (Gate::denies('access-system')) {
            Auth::logout();
            session()->flash('status', 'Tu cuenta aún no ha sido aprobada.');
            $this->redirect(route('login'), navigate: true);
            return;
        }


        // Redirigir según el rol del usuario
        switch ($user->rol) {
            case 'administrador':
                $this->redirect(route('dashboard.administrador'), navigate: true);
                break;
            case 'docente':
                $this->redirect(route('dashboard.docente'), navigate: true);
                break;
            case 'alumno':
                $this->redirect(route('dashboard.alumno'), navigate: true);
                break;
            default:
                $this->redirect(route('login'), navigate: true);
        }
    }

    /**
     * Ensure the authentication request is not rate limited.
     */
    protected function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout(request()));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => __('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the authentication rate limiting throttle key.
     */
    protected function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->email) . '|' . request()->ip());
    }
}; ?>
<div class="min-h-screen bg-gradient-to-br from-indigo-200 to-blue-100 dark:from-gray-900 dark:to-gray-800 flex items-center justify-center px-6">
    <div class="bg-white dark:bg-gray-900 shadow-2xl rounded-2xl w-full max-w-md p-8 border border-indigo-300 dark:border-indigo-700">

        {{-- Encabezado --}}
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-indigo-700 dark:text-indigo-300">Iniciar sesión</h2>
            <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">Accede con tu correo y contraseña</p>
        </div>

        {{-- Estado de sesión --}}
        <x-auth-session-status class="mb-4 text-center text-sm text-green-700 bg-green-100 px-4 py-2 rounded" :status="session('status')" />

        {{-- Formulario --}}
        <form wire:submit="login" class="space-y-6">
            {{-- Email --}}
            <div>
                <label class="block font-semibold text-indigo-600 dark:text-indigo-300 mb-1">Correo electrónico</label>
                <input wire:model="email" type="email" placeholder="usuario@correo.com" required
                    class="w-full px-4 py-3 rounded-lg border border-indigo-300 dark:border-indigo-600 bg-gray-50 dark:bg-gray-800 text-black dark:text-white focus:ring-2 focus:ring-indigo-400 transition shadow-sm">
            </div>

            {{-- Contraseña --}}
            <div>
                <label class="block font-semibold text-indigo-600 dark:text-indigo-300 mb-1">Contraseña</label>
                <input wire:model="password" type="password" placeholder="••••••••" required
                    class="w-full px-4 py-3 rounded-lg border border-indigo-300 dark:border-indigo-600 bg-gray-50 dark:bg-gray-800 text-black dark:text-white focus:ring-2 focus:ring-indigo-400 transition shadow-sm">
                @if (Route::has('password.request'))
                    <div class="text-right mt-2">
                        <a href="{{ route('password.request') }}" class="text-sm text-indigo-600 dark:text-indigo-400 hover:underline">
                            ¿Olvidaste tu contraseña?
                        </a>
                    </div>
                @endif
            </div>

            {{-- Recordarme --}}
            <div class="flex items-center gap-2">
                <input wire:model="remember" type="checkbox" class="accent-indigo-600 rounded">
                <label class="text-sm text-gray-700 dark:text-gray-300">Recordarme</label>
            </div>

            {{-- Botón de envío --}}
            <div>
                <button type="submit"
                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-3 rounded-lg font-semibold shadow transition">
                    Iniciar sesión
                </button>
            </div>
        </form>

        {{-- Registro --}}
        @if (Route::has('register'))
            <div class="mt-6 text-center text-sm text-gray-600 dark:text-gray-400">
                ¿No tienes cuenta?
                <a href="{{ route('register') }}" class="text-indigo-600 hover:underline dark:text-indigo-400">Regístrate</a>
            </div>
        @endif
    </div>
</div>
