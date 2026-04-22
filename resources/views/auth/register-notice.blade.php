<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-900">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} - Verifica tu correo</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="h-full flex min-h-full flex-col justify-center py-12 sm:px-6 lg:px-8 bg-slate-900">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <a href="/">
            <img class="mx-auto h-16 w-auto rounded-lg" src="{{ asset('images/logo-buenfil.jpg') }}"
                alt="Academia Buenfil">
        </a>
        <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-white">
            ¡Ya casi está!
        </h2>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-slate-800 py-8 px-4 shadow sm:rounded-lg sm:px-10 border border-slate-700 text-center">
            <div class="mb-6">
                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-green-900/30">
                    <svg class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                    </svg>
                </div>
            </div>
            
            <p class="text-slate-300 mb-6">
                Hemos enviado un correo de confirmación a <span class="text-white font-semibold">{{ session('email') }}</span>. 
                Por favor, revisa tu bandeja de entrada y haz clic en el botón para activar tu cuenta.
            </p>

            <div class="text-sm text-slate-400">
                <p>¿No recibiste el correo? Revisa tu carpeta de spam o</p>
                <a href="{{ route('register') }}" class="mt-2 inline-block font-medium text-[#FF6600] hover:text-[#E65C00]">
                    intenta registrarte de nuevo
                </a>
            </div>

            <div class="mt-8 border-t border-slate-700 pt-6">
                <a href="/" class="text-sm font-medium text-slate-400 hover:text-white transition-colors">
                    &larr; Volver al inicio
                </a>
            </div>
        </div>
    </div>
</body>

</html>
