<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-900">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} - Restablecer Contraseña</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/alpinejs" defer></script>
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
            Restablecer Contraseña
        </h2>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-slate-800 py-8 px-4 shadow sm:rounded-lg sm:px-10 border border-slate-700">
            <form class="space-y-6" action="{{ route('password.store') }}" method="POST">
                @csrf

                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email Address -->
                <div>
                    <label for="email" class="block text-sm font-medium text-slate-300">
                        Correo Electrónico
                    </label>
                    <div class="mt-1">
                        <input id="email" name="email" type="email" autocomplete="email" required
                            value="{{ old('email', $request->email) }}"
                            class="block w-full appearance-none rounded-md border border-slate-600 bg-slate-700 px-3 py-2 text-white placeholder-slate-400 shadow-sm focus:border-[#FF6600] focus:outline-none focus:ring-[#FF6600] sm:text-sm">
                        @error('email')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-slate-300">
                        Nueva Contraseña
                    </label>
                    <div class="mt-1 relative" x-data="{ show: false }">
                        <input id="password" name="password" :type="show ? 'text' : 'password'"
                            autocomplete="new-password" required autofocus
                            class="block w-full appearance-none rounded-md border border-slate-600 bg-slate-700 px-3 py-2 text-white placeholder-slate-400 shadow-sm focus:border-[#FF6600] focus:outline-none focus:ring-[#FF6600] sm:text-sm">

                        <button type="button" @click="show = !show"
                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-slate-300 transition-colors">
                            <svg x-show="!show" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <svg x-show="show" class="h-5 w-5" style="display: none;" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.822 7.822L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                            </svg>
                        </button>

                        @error('password')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-slate-300">
                        Confirmar Nueva Contraseña
                    </label>
                    <div class="mt-1 relative" x-data="{ show: false }">
                        <input id="password_confirmation" name="password_confirmation" :type="show ? 'text' : 'password'"
                            autocomplete="new-password" required
                            class="block w-full appearance-none rounded-md border border-slate-600 bg-slate-700 px-3 py-2 text-white placeholder-slate-400 shadow-sm focus:border-[#FF6600] focus:outline-none focus:ring-[#FF6600] sm:text-sm">

                        <button type="button" @click="show = !show"
                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-slate-300 transition-colors">
                            <svg x-show="!show" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <svg x-show="show" class="h-5 w-5" style="display: none;" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.822 7.822L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                            </svg>
                        </button>
                        
                        @error('password_confirmation')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <button type="submit"
                        class="flex w-full justify-center rounded-md border border-transparent bg-[#FF6600] py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-[#E65C00] focus:outline-none focus:ring-2 focus:ring-[#FF6600] focus:ring-offset-2 focus:ring-offset-slate-900 transition-colors">
                        Restablecer Contraseña
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
