<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-900">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $currentLesson->title }} - {{ $course->title }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <script src="//unpkg.com/alpinejs" defer></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .aspect-w-16 {
            position: relative;
            padding-bottom: 56.25%;
        }

        .aspect-w-16 iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        /* Custom scrollbar for sidebar */
        .sidebar-scroll::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar-scroll::-webkit-scrollbar-track {
            background: #0f172a;
        }

        .sidebar-scroll::-webkit-scrollbar-thumb {
            background: #334155;
            border-radius: 3px;
        }

        .sidebar-scroll::-webkit-scrollbar-thumb:hover {
            background: #475569;
        }
    </style>
</head>

<body class="bg-slate-900 text-slate-300 h-full flex flex-col antialiased">

    <!-- Navbar (Simplified for Classroom) -->
    <nav class="bg-slate-900 border-b border-slate-800 h-16 flex-shrink-0 z-50">
        <div class="max-w-full mx-auto px-4 sm:px-6 lg:px-8 h-full">
            <div class="flex justify-between items-center h-full">
                <div class="flex items-center">
                    <a href="{{ route('dashboard') }}"
                        class="text-slate-400 hover:text-white flex items-center mr-6 transition-colors">
                        <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Volver al Dashboard
                    </a>
                    <span class="text-slate-600 mr-4">|</span>
                    <h1 class="text-white font-bold text-lg truncate hidden md:block">{{ $course->title }}</h1>
                </div>

                @auth
                    <div class="relative ml-3" x-data="{ open: false }">
                        <div>
                            <button @click="open = !open" @click.away="open = false" type="button"
                                class="flex items-center max-w-xs text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF6600] focus:ring-offset-slate-900 bg-slate-800 p-1 pr-3 border border-slate-700 hover:border-[#FF6600]/30 transition-all"
                                id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                <div
                                    class="h-8 w-8 rounded-full bg-[#FF6600]/10 flex items-center justify-center text-[#FF6600] font-bold border border-[#FF6600]/20">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                                <span
                                    class="ml-2 text-slate-300 font-medium hidden sm:block">{{ Auth::user()->name }}</span>
                                <svg class="ml-2 h-4 w-4 text-slate-500" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                        <div x-show="open" style="display: none;"
                            class="origin-top-right absolute right-0 mt-2 w-56 rounded-xl shadow-lg py-1 bg-slate-800 ring-1 ring-black ring-opacity-5 focus:outline-none border border-slate-700 z-50">
                            <div class="px-4 py-3 border-b border-slate-700/50">
                                <p class="text-xs text-slate-500 uppercase tracking-wider font-bold">Conectado como</p>
                                <p class="text-sm font-medium text-white truncate">{{ Auth::user()->email }}</p>
                            </div>
                            <a href="{{ route('dashboard') }}"
                                class="block px-4 py-2 text-sm text-slate-300 hover:bg-slate-700 hover:text-white transition-colors">Dashboard</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="block w-full text-left px-4 py-2 text-sm text-red-400 hover:bg-slate-700 hover:text-red-300 transition-colors">Cerrar
                                    sesión</button>
                            </form>
                        </div>
                    </div>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Main Content Area -->
    <div class="flex-1 flex overflow-hidden" x-data="{ sidebarOpen: false }">

        <!-- Mobile Sidebar Toggle -->
        <div class="md:hidden fixed bottom-6 right-6 z-50">
            <button @click="sidebarOpen = !sidebarOpen"
                class="bg-[#FF6600] text-white p-4 rounded-full shadow-lg hover:bg-[#E65C00] focus:outline-none">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7">
                    </path>
                </svg>
            </button>
        </div>

        <!-- Sidebar (Lesson List) -->
        <div :class="{'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen}"
            class="fixed inset-y-0 left-0 z-40 w-80 bg-slate-800 border-r border-slate-700 transform md:relative md:translate-x-0 transition-transform duration-300 ease-in-out flex flex-col h-full">
            <div class="p-4 border-b border-slate-700 bg-slate-800">
                <h3 class="font-bold text-white text-lg">Contenido del Curso</h3>
                <p class="text-xs text-slate-400 mt-1">{{ $lessons->count() }} Lecciones</p>
            </div>

            <div class="flex-1 overflow-y-auto sidebar-scroll p-2">
                @foreach ($lessons as $lesson)
                    <a href="{{ route('lessons.show', ['course_slug' => $course->slug, 'lesson_id' => $lesson->id]) }}"
                        class="block mb-2 p-3 rounded-xl transition-all {{ $lesson->id === $currentLesson->id ? 'bg-[#FF6600]/10 border border-[#FF6600]/30 text-white' : 'text-slate-400 hover:bg-slate-700/50 hover:text-slate-200' }}">
                        <div class="flex items-start">
                            <span
                                class="flex-shrink-0 w-6 h-6 flex items-center justify-center rounded-full text-xs font-bold mr-3 {{ $lesson->id === $currentLesson->id ? 'bg-[#FF6600] text-white' : 'bg-slate-700 text-slate-500' }}">
                                {{ $loop->iteration }}
                            </span>
                            <div class="flex-1">
                                <span class="text-sm font-medium leading-tight block">{{ $lesson->title }}</span>
                                @if($lesson->id === $currentLesson->id)
                                    <span class="text-xs text-[#FF6600] font-bold mt-1 inline-block">Reproduciendo</span>
                                @endif
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Mobile Overlay -->
        <div x-show="sidebarOpen" @click="sidebarOpen = false"
            class="fixed inset-0 z-30 bg-black/50 backdrop-blur-sm md:hidden" style="display: none;"></div>

        <!-- Video Player Area -->
        <main class="flex-1 overflow-y-auto bg-slate-900 w-full relative">
            <div class="max-w-4xl mx-auto p-4 md:p-8">

                <!-- Video Embedding -->
                <div class="bg-black rounded-2xl overflow-hidden shadow-2xl ring-1 ring-slate-700 mb-8">
                    <div class="aspect-w-16 aspect-h-9 relative" style="padding-bottom: 56.25%;">
                        @if($currentLesson->youtube_video_id)
                            <iframe
                                src="https://www.youtube.com/embed/{{ $currentLesson->youtube_video_id }}?rel=0&modestbranding=1&iv_load_policy=3&playsinline=1&showinfo=0&controls=1"
                                title="{{ $currentLesson->title }}" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen class="absolute top-0 left-0 w-full h-full">
                            </iframe>
                        @else
                            <div
                                class="absolute top-0 left-0 w-full h-full flex items-center justify-center bg-slate-800 text-slate-500">
                                <div class="text-center">
                                    <svg class="w-16 h-16 mx-auto mb-4 opacity-50" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    <p>Video no disponible</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Lesson Info & Nav -->
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
                    <h1 class="text-2xl md:text-3xl font-bold text-white mb-4 md:mb-0">{{ $currentLesson->title }}</h1>

                    <div class="flex space-x-3 w-full md:w-auto">
                        @if($previousLesson)
                            <a href="{{ route('lessons.show', ['course_slug' => $course->slug, 'lesson_id' => $previousLesson->id]) }}"
                                class="flex-1 md:flex-none text-center px-4 py-2 bg-slate-800 border border-slate-700 text-slate-300 rounded-lg hover:bg-slate-700 hover:text-white transition-colors">
                                &larr; Anterior
                            </a>
                        @else
                            <button disabled
                                class="flex-1 md:flex-none px-4 py-2 bg-slate-800/50 border border-slate-700/50 text-slate-600 rounded-lg cursor-not-allowed">
                                &larr; Anterior
                            </button>
                        @endif

                        @if($nextLesson)
                            <a href="{{ route('lessons.show', ['course_slug' => $course->slug, 'lesson_id' => $nextLesson->id]) }}"
                                class="flex-1 md:flex-none text-center px-4 py-2 bg-[#FF6600] text-white rounded-lg hover:bg-[#E65C00] transition-colors font-medium">
                                Siguiente &rarr;
                            </a>
                        @else
                            <a href="{{ route('dashboard') }}"
                                class="flex-1 md:flex-none text-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors font-medium">
                                Finalizar &rarr;
                            </a>
                        @endif
                    </div>
                </div>

                <div class="prose prose-invert prose-lg max-w-none text-slate-400">
                    <h3 class="text-white">Descripción</h3>
                    {!! nl2br(e($currentLesson->description)) !!}
                </div>

            </div>
        </main>
    </div>

</body>

</html>