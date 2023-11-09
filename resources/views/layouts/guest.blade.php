<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'dashcode') }}</title>
        <x-favicon/>
        {{-- Scripts --}}
        @vite(['resources/css/app.scss', 'resources/js/custom/store.js'])
    </head>
    <body>

        <div class="loginwrapper">
            <div class="lg-inner-column">
                <div class="left-column relative z-[1]">
                    <div class="p-4 px-7 w-full absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2">
                        <!-- APPLICATION LOGO -->

                        <h4 class="w-full mb-5">
                           {{config('app.name')}}
                        </h4>
                        <p class="w-full text-2xl italic bold">
                            Potenciando tu cadena de suministros con distribuci&oacute;n de calidad
                        </p>
                    </div>
                </div>
                <div class="right-column  relative">
                    <div class="inner-content h-full flex flex-col bg-white dark:bg-slate-800">
                        {{ $slot }}
                        <div class="auth-footer text-center">
                            {{ __('Copyright') }}
                            <script>
                                document.write(new Date().getFullYear())
                            </script>
                            , <a href="#">{{ __('Dashcode') }}</a>
                            {{ __('All Rights Reserved.') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>


        @vite(['resources/js/app.js'])
    </body>
</html>
