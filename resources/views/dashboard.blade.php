<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-900">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard - Academia Buenfil</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="//unpkg.com/alpinejs" defer></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-slate-900 text-slate-300 antialiased">
    
    <!-- Navbar -->
    <nav class="bg-slate-900/90 backdrop-blur-md fixed w-full z-50 border-b border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex-shrink-0 flex items-center">
                        <img class="h-10 w-auto rounded-md" src="{{ asset('images/logo-buenfil.jpg') }}" alt="Academia Buenfil">
                        <span class="ml-3 text-xl font-bold text-white tracking-tight">Academia Buenfil</span>
                    </a>
                </div>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('dashboard') }}" class="text-white font-medium border-b-2 border-[#FF6600]">Mis Cursos</a>
                    <a href="{{ route('home') }}#cursos" class="text-slate-300 hover:text-[#FF6600] transition-colors font-medium">Catálogo</a>
                    
                    @auth
                        <div class="relative ml-3" x-data="{ open: false }">
                            <div>
                                <button @click="open = !open" @click.away="open = false" type="button" class="flex items-center max-w-xs text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF6600] focus:ring-offset-slate-900 bg-slate-800 p-1 pr-3 border border-slate-700 hover:border-[#FF6600]/30 transition-all" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                    <div class="h-8 w-8 rounded-full bg-[#FF6600]/10 flex items-center justify-center text-[#FF6600] font-bold border border-[#FF6600]/20">
                                        {{ substr(Auth::user()->name, 0, 1) }}
                                    </div>
                                    <span class="ml-2 text-slate-300 font-medium">{{ Auth::user()->name }}</span>
                                    <svg class="ml-2 h-4 w-4 text-slate-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>
                            <div x-show="open" style="display: none;" class="origin-top-right absolute right-0 mt-2 w-56 rounded-xl shadow-lg py-1 bg-slate-800 ring-1 ring-black ring-opacity-5 focus:outline-none border border-slate-700 z-50">
                                <div class="px-4 py-3 border-b border-slate-700/50">
                                    <p class="text-xs text-slate-500 uppercase tracking-wider font-bold">Conectado como</p>
                                    <p class="text-sm font-medium text-white truncate">{{ Auth::user()->email }}</p>
                                </div>
                                <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-slate-300 hover:bg-slate-700 hover:text-white transition-colors">Dashboard</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-400 hover:bg-slate-700 hover:text-red-300 transition-colors">Cerrar sesión</button>
                                </form>
                            </div>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <div class="pt-28 pb-12 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Alerts -->
        @if (session('success'))
            <div class="mb-8 bg-green-500/10 border border-green-500/20 text-green-400 px-4 py-3 rounded-xl flex items-center shadow-lg" role="alert">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif
        @if (session('error'))
            <div class="mb-8 bg-red-500/10 border border-red-500/20 text-red-400 px-4 py-3 rounded-xl flex items-center shadow-lg" role="alert">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        <!-- My Courses Section -->
        <div class="mb-16">
            <h1 class="text-3xl font-bold text-white mb-8 border-l-4 border-[#FF6600] pl-4">Mis Cursos</h1>
            
            @if($myCourses->isEmpty())
                <div class="bg-slate-800/50 rounded-2xl p-12 text-center border border-dashed border-slate-700">
                    <svg class="mx-auto h-16 w-16 text-slate-600 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                    <h3 class="text-xl font-medium text-white mb-2">Aún no tienes cursos</h3>
                    <p class="text-slate-400 mb-6">Explora nuestro catálogo y comienza tu aprendizaje hoy mismo.</p>
                    <a href="#catalogo" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-xl text-white bg-[#FF6600] hover:bg-[#E65C00] transition-colors shadow-lg hover:shadow-[#FF6600]/20">
                        Ver Catálogo
                    </a>
                </div>
            @else
                <div class="grid gap-8 grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
                    @foreach($myCourses as $course)
                        <div class="flex flex-col rounded-2xl bg-slate-800 border-2 border-[#FF6600]/30 overflow-hidden hover:shadow-2xl transition-all group">
                            <div class="relative h-48 bg-slate-900 flex items-center justify-center p-4">
                                @if ($course->image_path)
                                    <img class="h-full w-full object-contain" src="{{ asset('storage/' . $course->image_path) }}" alt="{{ $course->title }}">
                                @else
                                    <div class="h-full w-full bg-[#FF6600]/10 flex items-center justify-center rounded-xl">
                                        <span class="text-[#FF6600] text-5xl font-bold">{{ substr($course->title, 0, 1) }}</span>
                                    </div>
                                @endif
                                <div class="absolute top-4 right-4 bg-green-500/90 backdrop-blur px-3 py-1 rounded-full text-xs font-bold text-white uppercase tracking-wide shadow-md">
                                    Adquirido
                                </div>
                            </div>
                            <div class="flex-1 p-6 flex flex-col">
                                <h3 class="text-xl font-bold text-white mb-2 leading-tight">{{ $course->title }}</h3>
                                
                                <div class="mb-6">
                                    <div class="flex justify-between items-center mb-1">
                                        <span class="text-xs font-bold text-slate-400 uppercase">Progreso</span>
                                        <span class="text-xs font-bold text-[#FF6600]">{{ $course->progress_percent }}%</span>
                                    </div>
                                    <div class="w-full bg-slate-700 rounded-full h-1.5 overflow-hidden">
                                        <div class="bg-gradient-to-r from-[#FF6600] to-orange-400 h-1.5 rounded-full transition-all duration-1000" style="width: {{ $course->progress_percent }}%"></div>
                                    </div>
                                    <div class="mt-1 flex justify-between">
                                        <span class="text-[10px] text-slate-500 font-medium">{{ $course->completed_count }} de {{ $course->total_count }} lecciones</span>
                                        @if($course->progress_percent == 100)
                                            <span class="text-[10px] text-green-500 font-bold uppercase tracking-tighter">¡Listo para el examen!</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="text-slate-400 text-sm mb-6 line-clamp-2">
                                    {!! strip_tags($course->description) !!}
                                </div>
                                <div class="mt-auto space-y-3">
                                    <a href="{{ route('lessons.show', $course->slug) }}" class="block w-full text-center px-4 py-3 border border-transparent text-sm font-bold rounded-xl text-white bg-[#FF6600] hover:bg-[#E65C00] transition-colors shadow-lg hover:shadow-[#FF6600]/20">
                                        Continuar Aprendiendo
                                    </a>

                                    @if($course->quiz)
                                        @php
                                            $bestAttempt = Auth::user()->quizAttempts()->where('quiz_id', $course->quiz->id)->orderByDesc('score')->first();
                                            $hasPassed = $bestAttempt ? $bestAttempt->passed : false;
                                        @endphp
                                        
                                        @if($hasPassed)
                                            <div class="flex flex-col space-y-3">
                                                <div class="flex items-center justify-between px-4 py-3 bg-green-500/10 border border-green-500/20 rounded-xl">
                                                    <span class="text-green-400 text-sm font-bold flex items-center">
                                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                                        Aprobado ({{ $bestAttempt->score }}%)
                                                    </span>
                                                    <a href="{{ route('quizzes.show', $course->slug) }}" class="text-[#FF6600] text-xs font-bold hover:underline">Repetir</a>
                                                </div>
                                                <a href="{{ route('quizzes.certificate', $course->slug) }}" class="block w-full text-center px-4 py-3 bg-slate-800 border border-slate-700 text-white text-sm font-bold rounded-xl hover:bg-slate-700 transition-all flex items-center justify-center">
                                                    <svg class="w-4 h-4 mr-2 text-[#C5A059]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path></svg>
                                                    Descargar Diploma
                                                </a>
                                            </div>
                                        @else
                                            <a href="{{ route('quizzes.show', $course->slug) }}" class="block w-full text-center px-4 py-3 border-2 border-[#FF6600] text-sm font-bold rounded-xl text-[#FF6600] hover:bg-[#FF6600] hover:text-white transition-all shadow-md">
                                                Tomar Cuestionario
                                            </a>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Available Courses Section -->
        <div id="catalogo">
            <h2 class="text-2xl font-bold text-white mb-8 flex items-center">
                <span class="bg-slate-800 p-2 rounded-lg mr-3 text-[#FF6600]">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                </span>
                Catálogo Disponible
            </h2>

            <div class="grid gap-8 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                @foreach ($availableCourses as $course)
                    <div class="flex flex-col rounded-2xl bg-slate-800 border border-slate-700 overflow-hidden transition-all duration-300 hover:shadow-xl hover:shadow-[#FF6600]/10 hover:-translate-y-1 group">
                        <div class="relative h-48 bg-slate-900 flex items-center justify-center p-6 border-b border-slate-700/50">
                            @if ($course->image_path)
                                <img class="h-full w-full object-contain transform group-hover:scale-105 transition-transform duration-500" src="{{ asset('storage/' . $course->image_path) }}" alt="{{ $course->title }}">
                            @else
                                <div class="h-full w-full bg-[#FF6600]/10 flex items-center justify-center rounded-xl">
                                    <span class="text-[#FF6600] text-5xl font-bold">{{ substr($course->title, 0, 1) }}</span>
                                </div>
                            @endif
                        </div>
                        <div class="flex-1 p-6 flex flex-col justify-between">
                            <div>
                                <h3 class="text-lg font-bold text-white group-hover:text-[#FF6600] transition-colors leading-tight mb-2">
                                    {{ $course->title }}
                                </h3>
                                <p class="text-2xl font-bold text-white mb-4">${{ number_format($course->price, 2) }}</p>
                            </div>
                            
                            <form action="{{ route('courses.enroll', $course) }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full inline-flex justify-center items-center px-4 py-2 border border-[#FF6600] text-sm font-medium rounded-lg text-[#FF6600] hover:bg-[#FF6600] hover:text-white transition-all bg-transparent">
                                    <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                    Inscribirse
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>

</body>
</html>
