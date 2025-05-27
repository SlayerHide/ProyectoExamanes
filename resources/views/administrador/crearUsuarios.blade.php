<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public string $rol = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
            'rol' => ['required', 'in:administrador,docente,alumno'],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        // Creamos al usuario con el rol solicitado guardado en requested_role
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'requested_role' => $validated['rol'], // solo solicitud
            'rol' => null, // aún no tiene rol oficial
        ]);

        event(new Registered($user));

        // Mandamos mensaje al usuario (puede ser con session flash o estado Livewire)
        session()->flash('status', 'Tu solicitud de registro está pendiente de aprobación por el administrador.');

        // Redirigimos al login
        $this->redirect(route('login'), navigate: true);

        // Asigna el rol usando Spatie
        //$user->assignRole($validated['rol']);  // Asigna el rol elegido


        //Auth::login($user);

        //$user = Auth::user();

        // Redirigir según el rol del usuario
        /* switch ($user->rol) {
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
        } */
    }
}; ?>

<div class="flex flex-col gap-6">
    <x-auth-header :title="__('Create an account')" :description="__('Enter your details below to create your account')" />

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form wire:submit="register" class="flex flex-col gap-6">
        <!-- Name -->
        <flux:input
            wire:model="name"
            :label="__('Name')"
            type="text"
            required
            autofocus
            autocomplete="name"
            :placeholder="__('Full name')" />

        <!-- Email Address -->
        <flux:input
            wire:model="email"
            :label="__('Email address')"
            type="email"
            required
            autocomplete="email"
            placeholder="email@example.com" />

        <!-- Password -->
        <flux:input
            wire:model="password"
            :label="__('Password')"
            type="password"
            required
            autocomplete="new-password"
            :placeholder="__('Password')"
            viewable />

        <!-- Confirm Password -->
        <flux:input
            wire:model="password_confirmation"
            :label="__('Confirm password')"
            type="password"
            required
            autocomplete="new-password"
            :placeholder="__('Confirm password')"
            viewable />

        <div class="flex flex-col gap-2">
            <label for="rol" class="text-sm font-medium text-zinc-700 dark:text-zinc-300">{{ __('Rol solicitado') }}</label>
            <select id="rol" wire:model="rol" required class="p-2 rounded border border-zinc-300 dark:border-zinc-700">
                <option value="">{{ __('Elige un rol') }}</option>
                <option value="administrador">{{ __('Administrador') }}</option>
                <option value="docente">{{ __('Docente') }}</option>
                <option value="alumno">{{ __('Alumno') }}</option>
            </select>
        </div>

        <div class="flex items-center justify-end">
            <flux:button type="submit" variant="primary" class="w-full">
                {{ __('Create account') }}
            </flux:button>
        </div>
    </form>

    <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-600 dark:text-zinc-400">
        {{ __('Already have an account?') }}
        <flux:link :href="route('login')" wire:navigate>{{ __('Log in') }}</flux:link>
    </div>
</div>