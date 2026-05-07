<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-900">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Academia Buenfil - Reparación de Laptops</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <script src="//unpkg.com/alpinejs" defer></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            scroll-behavior: smooth;
        }

        @keyframes blob {
            0% {
                transform: translate(0px, 0px) scale(1);
            }

            33% {
                transform: translate(30px, -50px) scale(1.1);
            }

            66% {
                transform: translate(-20px, 20px) scale(0.9);
            }

            100% {
                transform: translate(0px, 0px) scale(1);
            }
        }

        .animate-blob {
            animation: blob 7s infinite;
        }

        .animation-delay-2000 {
            animation-delay: 2s;
        }

        .animation-delay-4000 {
            animation-delay: 4s;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translate3d(0, 40px, 0);
            }

            to {
                opacity: 1;
                transform: translate3d(0, 0, 0);
            }
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.8s ease-out forwards;
        }
    </style>
</head>

<body class="bg-slate-900 text-slate-300">

    <!-- Navbar -->
    <nav class="bg-slate-900/90 backdrop-blur-md fixed w-full z-50 border-b border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center">
                        <img class="h-10 w-auto rounded-md" src="{{ asset('images/logo-buenfil.jpg') }}"
                            alt="Academia Buenfil">
                        <span class="ml-3 text-xl font-bold text-white tracking-tight">Academia Buenfil</span>
                    </div>
                </div>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}"
                        class="text-slate-300 hover:text-[#FF6600] transition-colors font-medium">Inicio</a>
                    <a href="#cursos"
                        class="text-slate-300 hover:text-[#FF6600] transition-colors font-medium">Cursos</a>
                    <a href="{{ route('about') }}"
                        class="text-slate-300 hover:text-[#FF6600] transition-colors font-medium">Nosotros</a>
                    @auth
                        <a href="{{ route('dashboard') }}"
                            class="text-slate-300 hover:text-[#FF6600] transition-colors font-medium">Mis Cursos</a>
                        <div class="relative ml-3" x-data="{ open: false }">
                            <div>
                                <button @click="open = !open" @click.away="open = false" type="button"
                                    class="flex items-center max-w-xs text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF6600] focus:ring-offset-slate-900 bg-slate-800 p-1 pr-3 border border-slate-700 hover:border-[#FF6600]/30 transition-all"
                                    id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                    <span class="sr-only">Open user menu</span>
                                    <div
                                        class="h-8 w-8 rounded-full bg-[#FF6600]/10 flex items-center justify-center text-[#FF6600] font-bold border border-[#FF6600]/20">
                                        {{ substr(Auth::user()->name, 0, 1) }}
                                    </div>
                                    <span class="ml-2 text-slate-300 font-medium">{{ Auth::user()->name }}</span>
                                    <svg class="ml-2 h-4 w-4 text-slate-500" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>
                            <div x-show="open" x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="transform opacity-100 scale-100"
                                x-transition:leave-end="transform opacity-0 scale-95"
                                class="origin-top-right absolute right-0 mt-2 w-56 rounded-xl shadow-lg py-1 bg-slate-800 ring-1 ring-black ring-opacity-5 focus:outline-none border border-slate-700 z-50"
                                role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1"
                                style="display: none;">
                                <div class="px-4 py-3 border-b border-slate-700/50">
                                    <p class="text-xs text-slate-500 uppercase tracking-wider font-bold">Conectado como</p>
                                    <p class="text-sm font-medium text-white truncate">{{ Auth::user()->email }}</p>
                                </div>
                                <a href="{{ route('home') }}"
                                    class="block px-4 py-2 text-sm text-slate-300 hover:bg-slate-700 hover:text-white transition-colors"
                                    role="menuitem" tabindex="-1">Página Principal</a>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="block w-full text-left px-4 py-2 text-sm text-red-400 hover:bg-slate-700 hover:text-red-300 transition-colors"
                                        role="menuitem" tabindex="-1">
                                        Cerrar sesión
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}"
                            class="text-slate-300 hover:text-white transition-colors font-medium">Login</a>
                        <a href="#cursos"
                            class="bg-[#FF6600] hover:bg-[#E65C00] text-white px-5 py-2 rounded-lg font-semibold transition-all shadow-lg hover:shadow-[#FF6600]/20">
                            Ver Cursos
                        </a>
                    @endauth
                </div>
                <!-- Mobile menu button -->
                <div class="-mr-2 flex md:hidden items-center">
                    <button type="button"
                        class="bg-slate-800 inline-flex items-center justify-center p-2 rounded-md text-slate-400 hover:text-white hover:bg-slate-700 focus:outline-none"
                        aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="relative pt-24 pb-16 md:pt-44 md:pb-24 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid lg:grid-cols-12 gap-12 items-center">
                <div class="lg:col-span-5 animate-fade-in-up">
                    <h1
                        class="text-4xl md:text-5xl xl:text-6xl font-extrabold text-white tracking-tight leading-tight mb-6">
                        Domina la reparación de <span class="text-[#FF6600]">Laptops</span> a nivel componente
                    </h1>
                    <p class="mt-4 text-lg text-slate-400 mb-8 leading-relaxed">
                        Aprende a diagnosticar fuentes de 3 y 5 voltios, uso de osciloscopio, secuencias de encendido y
                        protocolos avanzados. Formación técnica real para profesionales.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="#cursos"
                            class="inline-flex justify-center items-center px-8 py-4 border border-transparent text-lg font-bold rounded-xl text-white bg-[#FF6600] hover:bg-[#E65C00] transition-all shadow-lg hover:shadow-[#FF6600]/30 transform hover:-translate-y-1">
                            Empezar Ahora
                        </a>
                    </div>
                </div>
                <div class="hidden lg:block lg:col-span-7 relative animate-fade-in-up" style="animation-delay: 0.2s;">
                    <div class="relative z-10 rounded-[2.5rem] overflow-hidden shadow-2xl ring-1 ring-slate-700 aspect-[4/3] xl:aspect-video">
                        <img src="{{ asset('images/hero-workshop.png') }}" alt="Aprendizaje en Academia Buenfil" class="object-cover w-full h-full transform hover:scale-105 transition-transform duration-1000">
                    </div>
                    <!-- Elementos decorativos para unir el diseño -->
                    <div class="absolute -top-10 -right-10 w-40 h-40 bg-[#FF6600]/10 rounded-full blur-3xl -z-10"></div>
                    <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-blue-500/10 rounded-full blur-3xl -z-10"></div>
                </div>
            </div>
        </div>

        <!-- Abstract Background Elements -->
        <div
            class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 bg-[#FF6600] rounded-full mix-blend-multiply filter blur-3xl opacity-10 animate-blob">
        </div>
        <div
            class="absolute top-0 right-1/4 w-72 h-72 bg-purple-500 rounded-full mix-blend-multiply filter blur-3xl opacity-10 animate-blob animation-delay-2000">
        </div>
        <div
            class="absolute -bottom-32 left-0 w-96 h-96 bg-[#FF6600] rounded-full mix-blend-multiply filter blur-3xl opacity-10 animate-blob animation-delay-4000">
        </div>
    </div>
    </div>

    <!-- Why Us Section -->
    <div id="nosotros" class="bg-slate-800 py-24 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">¿Por qué Academia Buenfil?</h2>
                <p class="text-slate-400 max-w-2xl mx-auto">Nos enfocamos en la práctica real y en los fundamentos
                    electrónicos que necesitas para reparar, no solo cambiar piezas.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <!-- Feature 1 -->
                <div
                    class="bg-slate-900/50 p-8 rounded-2xl border border-slate-700/50 hover:border-[#FF6600]/30 transition-all hover:-translate-y-2 group flex flex-col">
                    <div class="mb-6 h-32 w-full overflow-hidden rounded-xl border border-slate-700/50 group-hover:border-[#FF6600]/30 transition-all">
                        <img src="{{ asset('images/features/schematic.png') }}" class="w-full h-full object-cover opacity-60 group-hover:opacity-100 transition-opacity duration-500" alt="Diagnóstico">
                    </div>
                    <div
                        class="w-12 h-12 bg-[#FF6600]/10 rounded-lg flex items-center justify-center mb-6 group-hover:bg-[#FF6600]/20 transition-colors">
                        <svg class="w-6 h-6 text-[#FF6600]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Diagnóstico Preciso</h3>
                    <p class="text-slate-400 text-sm">Aprende a interpretar esquemáticos y boardviews para encontrar el fallo
                        exacto en la placa madre.</p>
                </div>

                <!-- Feature 2 -->
                <div
                    class="bg-slate-900/50 p-8 rounded-2xl border border-slate-700/50 hover:border-[#FF6600]/30 transition-all hover:-translate-y-2 group flex flex-col">
                    <div class="mb-6 h-32 w-full overflow-hidden rounded-xl border border-slate-700/50 group-hover:border-[#FF6600]/30 transition-all">
                        <img src="{{ asset('images/features/power.png') }}" class="w-full h-full object-cover opacity-60 group-hover:opacity-100 transition-opacity duration-500" alt="Potencia">
                    </div>
                    <div
                        class="w-12 h-12 bg-[#FF6600]/10 rounded-lg flex items-center justify-center mb-6 group-hover:bg-[#FF6600]/20 transition-colors">
                        <svg class="w-6 h-6 text-[#FF6600]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Electrónica de Potencia</h3>
                    <p class="text-slate-400 text-sm">Domina el funcionamiento de fuentes step-down, circuitos de carga y
                        reguladores lineales.</p>
                </div>

                <!-- Feature 3 -->
                <div
                    class="bg-slate-900/50 p-8 rounded-2xl border border-slate-700/50 hover:border-[#FF6600]/30 transition-all hover:-translate-y-2 group flex flex-col">
                    <div class="mb-6 h-32 w-full overflow-hidden rounded-xl border border-slate-700/50 group-hover:border-[#FF6600]/30 transition-all">
                        <img src="{{ asset('images/features/tools.png') }}" class="w-full h-full object-cover opacity-60 group-hover:opacity-100 transition-opacity duration-500" alt="Herramientas">
                    </div>
                    <div
                        class="w-12 h-12 bg-[#FF6600]/10 rounded-lg flex items-center justify-center mb-6 group-hover:bg-[#FF6600]/20 transition-colors">
                        <svg class="w-6 h-6 text-[#FF6600]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Herramientas Profesionales</h3>
                    <p class="text-slate-400 text-sm">Saca el máximo provecho a tu osciloscopio, multímetro y fuente de
                        laboratorio.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Courses Grid -->
    <div id="cursos" class="bg-slate-900 py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-end mb-12">
                <div>
                    <h2 class="text-3xl md:text-4xl font-bold text-white mb-2">Nuestros Cursos</h2>
                    <p class="text-slate-400">Capacitación especializada disponible.</p>
                </div>
                <!-- <a href="#" class="text-[#FF6600] font-medium hover:text-[#E65C00] hidden md:block">Ver todos los cursos &rarr;</a> -->
            </div>

            <div class="grid gap-8 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                @foreach ($courses as $course)
                    <div
                        class="flex flex-col rounded-2xl bg-slate-800 border border-slate-700 overflow-hidden transition-all duration-300 hover:shadow-xl hover:shadow-[#FF6600]/10 hover:-translate-y-2 group">
                        <div
                            class="flex-shrink-0 relative bg-slate-900 h-56 flex items-center justify-center p-6 border-b border-slate-700/50">
                            @if ($course->image_path)
                                <img class="h-full w-full object-contain transform group-hover:scale-105 transition-transform duration-500"
                                    src="{{ asset('storage/' . $course->image_path) }}" alt="{{ $course->title }}">
                            @else
                                <div class="h-full w-full bg-[#FF6600]/10 flex items-center justify-center rounded-xl">
                                    <span class="text-[#FF6600] text-5xl font-bold">{{ substr($course->title, 0, 1) }}</span>
                                </div>
                            @endif
                            <div
                                class="absolute top-4 right-4 bg-slate-900/80 backdrop-blur px-3 py-1 rounded-full border border-slate-700">
                                <span class="text-xs font-bold text-[#FF6600] uppercase tracking-wide">Online</span>
                            </div>
                        </div>
                        <div class="flex-1 p-6 flex flex-col justify-between">
                            <div class="flex-1">
                                <h3
                                    class="text-xl font-bold text-white group-hover:text-[#FF6600] transition-colors leading-tight mb-3">
                                    {{ $course->title }}
                                </h3>
                                <div class="text-sm text-slate-400 line-clamp-2 prose prose-invert">
                                    {!! strip_tags($course->description) !!}
                                </div>
                            </div>
                            <div class="mt-6 pt-6 border-t border-slate-700/50 flex items-center justify-between">
                                <div class="flex flex-col">
                                    <span class="text-xs text-slate-500">Precio</span>
                                    <span
                                        class="text-2xl font-bold text-white">${{ number_format($course->price, 2) }}</span>
                                </div>
                                <div class="flex flex-col gap-2">
                                    <a href="{{ route('checkout.show', $course) }}"
                                        class="inline-flex items-center justify-center px-4 py-2 border border-transparent bg-[#FF6600] text-sm font-medium rounded-lg text-white hover:bg-[#E65C00] transition-all shadow-md text-center">
                                        Inscribirse
                                    </a>
                                    <a href="{{ route('courses.show', $course->slug) }}"
                                        class="inline-flex items-center justify-center px-4 py-2 border border-[#FF6600] text-sm font-medium rounded-lg text-[#FF6600] hover:bg-[#FF6600] hover:text-white transition-all text-center">
                                        Detalles
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>


    <!-- CTA Section -->
    <div class="bg-[#FF6600] py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold text-white mb-4">¿Listo para mejorar tus habilidades?</h2>
            <p class="text-orange-100 text-lg mb-8 max-w-2xl mx-auto">Únete a cientos de técnicos que ya están reparando
                equipos que antes consideraban irreparables.</p>
            <a href="{{ route('register') }}"
                class="inline-block bg-white text-[#FF6600] font-bold text-lg px-8 py-4 rounded-xl hover:bg-gray-100 transition-colors shadow-xl">
                Empezar Ahora
            </a>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-slate-900 border-t border-slate-800 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center">
            <div class="flex items-center space-x-3 mb-4 md:mb-0">
                <img class="h-8 w-auto grayscale opacity-50 hover:opacity-100 transition-opacity"
                    src="{{ asset('images/logo-buenfil.jpg') }}" alt="Logo">
                <span class="text-slate-500 text-sm">© {{ date('Y') }} Academia Buenfil. Todos los derechos
                    reservados.</span>
            </div>
            <div class="flex space-x-6">
                <!-- Social links placeholders -->
                <a href="#" class="text-slate-500 hover:text-white transition-colors">
                    <span class="sr-only">Facebook</span>
                    <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                            clip-rule="evenodd" />
                    </svg>
                </a>
                <a href="#" class="text-slate-500 hover:text-white transition-colors">
                    <span class="sr-only">YouTube</span>
                    <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M19.812 5.418c.861.23 1.538.907 1.768 1.768C21.998 8.746 22 12 22 12s0 3.255-.418 4.814a2.504 2.504 0 0 1-1.768 1.768c-1.56.419-7.814.419-7.814.419s-6.255 0-7.814-.419a2.505 2.505 0 0 1-1.768-1.768C2 15.255 2 12 2 12s0-3.255.417-4.814a2.507 2.507 0 0 1 1.768-1.768C5.744 5 11.998 5 11.998 5s6.255 0 7.814.418ZM15.194 12 10 15V9l5.194 3Z"
                            clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
        </div>
    </footer>

</body>

</html>