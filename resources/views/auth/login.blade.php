<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Senha')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-4">
            
            <label for="remember_me" class="inline-flex items-center">
               
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-gray-800 shadow-sm focus:ring-transparent" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Manter conectado') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Esqueceu sua senha?') }}
                </a>
            @endif
        </div>
        
        <div class="flex flex-col items-center mt-6"> 
            <x-primary-button class="w-full justify-center">
                {{ __('ENTRAR') }}
            </x-primary-button>
        </div>
        
        <div class="text-center mt-6 pt-4 border-t border-gray-200">
            <p class="text-sm text-gray-600">
                Não tem uma conta?
                <a class="underline font-semibold text-indigo-600 hover:text-indigo-800" href="{{ route('register') }}">
                    Cadastre-se
                </a>
            </p>
        </div>
        
    </form>
</x-guest-layout>

