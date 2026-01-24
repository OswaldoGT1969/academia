<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-900">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} - Iniciar Sesión</title>
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
            Iniciar Sesión
        </h2>
        <p class="mt-2 text-center text-sm text-slate-400">
            ¿No tienes cuenta?
            <a href="{{ route('register') }}" class="font-medium text-[#FF6600] hover:text-[#E65C00]">
                Regístrate gratis
            </a>
        </p>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-slate-800 py-8 px-4 shadow sm:rounded-lg sm:px-10 border border-slate-700">
            <form class="space-y-6" action="{{ route('login') }}" method="POST">
                @csrf

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-slate-300">
                        Correo Electrónico
                    </label>
                    <div class="mt-1">
                        <input id="email" name="email" type="email" autocomplete="email" required
                            value="{{ old('email') }}"
                            class="block w-full appearance-none rounded-md border border-slate-600 bg-slate-700 px-3 py-2 text-white placeholder-slate-400 shadow-sm focus:border-[#FF6600] focus:outline-none focus:ring-[#FF6600] sm:text-sm">
                        @error('email')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-slate-300">
                        Contraseña
                    </label>
                    <div class="mt-1">
                        <input id="password" name="password" type="password" autocomplete="current-password" required
                            class="block w-full appearance-none rounded-md border border-slate-600 bg-slate-700 px-3 py-2 text-white placeholder-slate-400 shadow-sm focus:border-[#FF6600] focus:outline-none focus:ring-[#FF6600] sm:text-sm">
                        @error('password')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember_me" name="remember" type="checkbox"
                            class="h-4 w-4 rounded border-slate-600 bg-slate-700 text-[#FF6600] focus:ring-[#FF6600] focus:ring-offset-slate-900">
                        <label for="remember_me" class="ml-2 block text-sm text-slate-300">
                            Recordarme
                        </label>
                    </div>

                    <div class="text-sm">
                        <a href="#" class="font-medium text-[#FF6600] hover:text-[#E65C00]">
                            ¿Olvidaste tu contraseña?
                        </a>
                    </div>
                </div>

                <div>
                    <button type="submit"
                        class="flex w-full justify-center rounded-md border border-transparent bg-[#FF6600] py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-[#E65C00] focus:outline-none focus:ring-2 focus:ring-[#FF6600] focus:ring-offset-2 focus:ring-offset-slate-900 transition-colors">
                        Entrar
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>