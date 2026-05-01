<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="ph-theme font-sans text-gray-900 antialiased">
        <div class="min-h-screen" style="background: linear-gradient(135deg, #DDFFE7 0%, rgba(62, 210, 161, 0.55) 45%, rgba(23, 193, 255, 0.22) 100%);">
            <div class="min-h-screen w-full flex items-center justify-center px-4 py-12">
                <div class="p-5 max-w-md">
                    <div class="rounded-3xl p-5 bg-green/90 shadow-xl backdrop-blur-sm" style="border: 1px solid rgba(41, 160, 177, 0.88); border-radius: 10px">
                        <div class="" >
                            <a href="/" class="flex items-center gap-3">
                                <span class="inline-flex w-full items-center justify-center rounded-2xl" >
                                    <img src="{{ asset('backend/assets/images/Pharmacy-png.png') }}" class="" style="height:60px" alt="" />
                                </span>
                               
                            </a>
                             <div class="d-flex text-center mt-4" >
                                    <div class="text-xl font-extrabold tracking-tight text-gray-900">Pharmacy System</div>
                                    <div class="text-sm text-gray-600">Sign in to your dashboard</div>
                             </div>
                        </div>

                        <div class="px-8 pb-8 pt-6">
                            {{ $slot }}
                        </div>
                    </div>

                    <div class="mt-6 text-center text-xs text-gray-600">
                        <span>Secured access</span>
                        <span class="mx-2">|</span>
                        <span>Waziri & Qarizada</span>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
