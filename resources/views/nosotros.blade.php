<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-900">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nosotros - Academia Buenfil</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <script src="//unpkg.com/alpinejs" defer></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            scroll-behavior: smooth;
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
                    <a href="{{ route('home') }}" class="flex-shrink-0 flex items-center">
                        <img class="h-10 w-auto rounded-md" src="{{ asset('images/logo-buenfil.jpg') }}"
                            alt="Academia Buenfil">
                        <span class="ml-3 text-xl font-bold text-white tracking-tight">Academia Buenfil</span>
                    </a>
                </div>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}#cursos"
                        class="text-slate-300 hover:text-[#FF6600] transition-colors font-medium">Cursos</a>
                    <a href="{{ route('about') }}"
                        class="text-[#FF6600] transition-colors font-medium">Nosotros</a>
                    @auth
                        <a href="{{ route('dashboard') }}"
                            class="text-slate-300 hover:text-[#FF6600] transition-colors font-medium">Mis Cursos</a>
                    @else
                        <a href="{{ route('login') }}"
                            class="text-slate-300 hover:text-white transition-colors font-medium">Login</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Header Section -->
    <div class="relative pt-32 pb-12 bg-slate-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-6xl font-extrabold text-white mb-4 animate-fade-in-up">Nuestra Historia</h1>
            <p class="text-xl text-slate-400 max-w-2xl mx-auto animate-fade-in-up" style="animation-delay: 0.1s;">Más de dos décadas transformando técnicos en expertos de nivel componente.</p>
        </div>
    </div>

    <!-- Meet Arturo Buenfil Section -->
    <div class="bg-slate-800 py-24 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <div class="relative animate-fade-in-up">
                    <div class="relative z-10 rounded-[3rem] overflow-hidden shadow-2xl border-4 border-slate-700/50">
                        <img src="{{ asset('images/instructor-arturo.png') }}" alt="Arturo Buenfil" class="w-full aspect-square object-cover">
                    </div>
                    <div class="absolute -bottom-8 -right-8 w-64 h-64 bg-[#FF6600]/20 rounded-full blur-3xl -z-10"></div>
                </div>
                <div class="animate-fade-in-up" style="animation-delay: 0.2s;">
                    <h2 class="text-[#FF6600] font-bold uppercase tracking-widest text-sm mb-4">Tu Instructor</h2>
                    <h3 class="text-4xl md:text-5xl font-extrabold text-white mb-6 leading-tight">Liderando con experiencia: Arturo Buenfil</h3>
                    <p class="text-xl text-slate-300 mb-6 leading-relaxed italic">
                        "Mi misión es formar técnicos que no solo reparen, sino que entiendan la electrónica a nivel componente, devolviendo la vida a equipos que otros dan por perdidos."
                    </p>
                    <div class="space-y-6 text-slate-400">
                        <p>Con más de 20 años de experiencia real en el taller, Arturo ha diagnosticado y reparado miles de equipos, especializándose en fallos complejos de placas madre de laptops.</p>
                        <p>Como fundador de Academia Buenfil, ha diseñado una metodología práctica que elimina la teoría innecesaria y se enfoca en lo que realmente necesitas saber para generar ingresos en tu propio taller.</p>
                    </div>
                    <div class="mt-10 flex items-center gap-6">
                        <div class="text-center">
                            <span class="block text-3xl font-bold text-white">20+</span>
                            <span class="text-xs text-slate-500 uppercase tracking-wider">Años Exp.</span>
                        </div>
                        <div class="w-px h-10 bg-slate-700"></div>
                        <div class="text-center">
                            <span class="block text-3xl font-bold text-white">1,000+</span>
                            <span class="text-xs text-slate-500 uppercase tracking-wider">Alumnos</span>
                        </div>
                        <div class="w-px h-10 bg-slate-700"></div>
                        <div class="text-center">
                            <span class="block text-3xl font-bold text-white">5,000+</span>
                            <span class="text-xs text-slate-500 uppercase tracking-wider">Reparaciones</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Testimonials Section -->
    <div class="bg-slate-900 py-24 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Lo que dicen nuestros alumnos</h2>
                <p class="text-slate-400 max-w-2xl mx-auto">Técnicos de toda Latinoamérica que han transformado su taller con nosotros.</p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Testimonial 1 -->
                <div class="bg-slate-800 p-8 rounded-3xl border border-slate-700 relative group hover:border-[#FF6600]/30 transition-all">
                    <div class="flex text-[#FF6600] mb-4">
                        @for($i=0; $i<5; $i++)
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        @endfor
                    </div>
                    <p class="text-slate-300 italic mb-6 leading-relaxed">"Gracias a Arturo pude entender por fin cómo usar el osciloscopio para ver los protocolos de comunicación. Ahora reparo equipos que antes devolvía."</p>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full overflow-hidden border border-slate-600 bg-slate-700">
                            <img src="{{ asset('images/testimonial-1.png') }}" class="w-full h-full object-cover" alt="Carlos M.">
                        </div>
                        <div>
                            <span class="block text-white font-bold">Carlos M.</span>
                            <span class="text-xs text-slate-500">México</span>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 2 -->
                <div class="bg-slate-800 p-8 rounded-3xl border border-slate-700 relative group hover:border-[#FF6600]/30 transition-all">
                    <div class="flex text-[#FF6600] mb-4">
                        @for($i=0; $i<5; $i++)
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        @endfor
                    </div>
                    <p class="text-slate-300 italic mb-6 leading-relaxed">"La claridad con la que explica las fuentes de 3 y 5 voltios es única. Academia Buenfil es la mejor inversión para cualquier técnico de laptops."</p>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full overflow-hidden border border-slate-600 bg-slate-700">
                            <img src="{{ asset('images/testimonial-2.png') }}" class="w-full h-full object-cover" alt="Lucía R.">
                        </div>
                        <div>
                            <span class="block text-white font-bold">Lucía R.</span>
                            <span class="text-xs text-slate-500">Colombia</span>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 3 -->
                <div class="bg-slate-800 p-8 rounded-3xl border border-slate-700 relative group hover:border-[#FF6600]/30 transition-all">
                    <div class="flex text-[#FF6600] mb-4">
                        @for($i=0; $i<5; $i++)
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        @endfor
                    </div>
                    <p class="text-slate-300 italic mb-6 leading-relaxed">"Lo mejor es el soporte y la comunidad. Sentirse acompañado por Arturo en reparaciones difíciles no tiene precio."</p>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full overflow-hidden border border-slate-600 bg-slate-700">
                            <img src="{{ asset('images/testimonial-3.png') }}" class="w-full h-full object-cover" alt="Andrés G.">
                        </div>
                        <div>
                            <span class="block text-white font-bold">Andrés G.</span>
                            <span class="text-xs text-slate-500">Argentina</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- FAQ Section -->
    <div class="bg-slate-800 py-24">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Preguntas Frecuentes</h2>
                <p class="text-slate-400">Todo lo que necesitas saber antes de empezar.</p>
            </div>
            
            <div class="space-y-4" x-data="{ selected: 1 }">
                <div class="bg-slate-900/50 rounded-2xl border border-slate-700 overflow-hidden">
                    <button @click="selected !== 1 ? selected = 1 : selected = null" class="w-full px-8 py-6 text-left flex justify-between items-center hover:bg-slate-700/30 transition-colors">
                        <span class="text-lg font-bold text-white">¿Necesito conocimientos previos de electrónica?</span>
                        <svg class="w-5 h-5 text-[#FF6600] transform transition-transform" :class="selected === 1 ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="selected === 1" x-collapse>
                        <div class="px-8 pb-6 text-slate-400 leading-relaxed">
                            Es recomendable tener nociones básicas de uso de multímetro, pero nuestros cursos están diseñados para llevarte de la mano desde los fundamentos de la placa madre hasta niveles avanzados.
                        </div>
                    </div>
                </div>

                <div class="bg-slate-900/50 rounded-2xl border border-slate-700 overflow-hidden">
                    <button @click="selected !== 2 ? selected = 2 : selected = null" class="w-full px-8 py-6 text-left flex justify-between items-center hover:bg-slate-700/30 transition-colors">
                        <span class="text-lg font-bold text-white">¿Cuánto tiempo tengo acceso a los cursos?</span>
                        <svg class="w-5 h-5 text-[#FF6600] transform transition-transform" :class="selected === 2 ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="selected === 2" x-collapse style="display: none;">
                        <div class="px-8 pb-6 text-slate-400 leading-relaxed">
                            ¡Acceso por un año completo! Una vez que adquieres un curso, tendrás 12 meses para verlo las veces que quieras, cuando quieras, desde cualquier dispositivo.
                        </div>
                    </div>
                </div>

                <div class="bg-slate-900/50 rounded-2xl border border-slate-700 overflow-hidden">
                    <button @click="selected !== 3 ? selected = 3 : selected = null" class="w-full px-8 py-6 text-left flex justify-between items-center hover:bg-slate-700/30 transition-colors">
                        <span class="text-lg font-bold text-white">¿Recibiré un certificado al finalizar?</span>
                        <svg class="w-5 h-5 text-[#FF6600] transform transition-transform" :class="selected === 3 ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="selected === 3" x-collapse style="display: none;">
                        <div class="px-8 pb-6 text-slate-400 leading-relaxed">
                            Sí, al completar todas las lecciones y aprobar el examen correspondiente, podrás descargar tu certificado avalado por Academia Buenfil.
                        </div>
                    </div>
                </div>

                <div class="bg-slate-900/50 rounded-2xl border border-slate-700 overflow-hidden">
                    <button @click="selected !== 4 ? selected = 4 : selected = null" class="w-full px-8 py-6 text-left flex justify-between items-center hover:bg-slate-700/30 transition-colors">
                        <span class="text-lg font-bold text-white">¿Qué pasa si tengo dudas durante el curso?</span>
                        <svg class="w-5 h-5 text-[#FF6600] transform transition-transform" :class="selected === 4 ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="selected === 4" x-collapse style="display: none;">
                        <div class="px-8 pb-6 text-slate-400 leading-relaxed">
                            Tendrás acceso a nuestro soporte dedicado y a una comunidad exclusiva de alumnos donde podrás resolver tus dudas directamente con Arturo y otros compañeros.
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
        </div>
    </footer>

</body>

</html>
