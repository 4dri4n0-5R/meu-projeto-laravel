<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Esqueceu sua senha? Sem problemas. Apenas informe seu endereço de e-mail que enviaremos um link que permitirá definir uma nova senha.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- --- MUDANÇA AQUI: ALINHAMENTO E TEXTO --- -->
        
        <!-- 1. Trocamos 'justify-center' ou 'justify-end' por 'justify-start' -->
        <div class="flex items-center justify-start mt-4"> 
            
            <!-- 2. Trocamos o texto longo por "ENVIAR" -->
            <!-- 3. Removemos as classes 'w-full' e 'justify-center' do botão (se existirem) -->
            <x-primary-button>
                {{ __('ENVIAR') }}
            </x-primary-button>
        </div>
        
        <!-- --- FIM DA MUDANÇA --- -->
    </form>
</x-guest-layout>
