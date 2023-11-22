<x-guest-layout>
    <div class="auth-box h-full flex flex-col justify-center">
        <div class="mobile-logo text-center mb-6 lg:hidden flex justify-center">
            <div class="mb-10 inline-flex items-center justify-center">
                <span class="ltr:ml-3 rtl:mr-3 text-xl font-Inter font-bold text-slate-900 dark:text-white">{{config('app.name')}}</span>
            </div>
        </div>
        <div class="text-center 2xl:mb-10 mb-4">
            <h4 class="font-medium"> {!! __('Iniciar sess&oacute;n') !!}</h4>
            <div class="text-slate-500 text-base">
                {{ __('Inicia session para comenzar a usar ' . config('app.name')) }}
            </div>
        </div>

        <!-- START::LOGIN FORM -->
        <x-login-form></x-login-form>
    </div>
</x-guest-layout>