<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-900">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} - Verificar Correo</title>
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
            Verifica tu correo
        </h2>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-slate-800 py-8 px-4 shadow sm:rounded-lg sm:px-10 border border-slate-700">
            <div class="mb-4 text-sm text-slate-300">
                ¡Gracias por registrarte! Antes de comenzar, ¿podrías verificar tu dirección de correo electrónico
                haciendo clic en el enlace que te acabamos de enviar? Si no recibiste el correo, con gusto te enviaremos
                otro.
            </div>

            @if (session('status') == 'verification-link-sent')
                <div class="mb-4 font-medium text-sm text-[#FF6600]">
                    Se ha enviado un nuevo enlace de verificación a la dirección de correo electrónico que proporcionaste
                    durante el registro.
                </div>
            @endif

            <div class="mt-4 flex items-center justify-between">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf

                    <div>
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-[#FF6600] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#E65C00] focus:bg-[#E65C00] active:bg-[#E05900] focus:outline-none focus:ring-2 focus:ring-[#FF6600] focus:ring-offset-2 focus:ring-offset-slate-800 transition ease-in-out duration-150">
                            Reenviar correo
                        </button>
                    </div>
                </form>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit"
                        class="underline text-sm text-slate-400 hover:text-slate-200 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF6600] focus:ring-offset-slate-800">
                        Cerrar Sesión
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>