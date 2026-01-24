<x-layout>
    <div class="bg-slate-900">
        <!-- Hero Section -->
        <div class="relative bg-slate-800 overflow-hidden mb-8 rounded-2xl shadow-sm">
            <div class="absolute inset-0">
                <img class="h-full w-full object-cover" src="{{ asset('images/hero-banner.jpg') }}"
                    alt="Hero Background">
                <div class="absolute inset-0 bg-gray-900 mix-blend-multiply opacity-60"></div>
            </div>
            <div class="relative max-w-7xl mx-auto py-24 px-4 sm:py-32 sm:px-6 lg:px-8">
                <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl lg:text-6xl text-shadow-lg">
                    Domina la Tecnología
                </h1>
                <p class="mt-6 max-w-xl text-xl text-gray-100 text-shadow">
                    Formación técnica especializada para impulsar tu carrera profesional.
                </p>
            </div>
        </div>

        <div class=""> <!-- Content Container -->
            <div class="text-left mb-8">
                <h2 class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl">
                    ¡Hola de nuevo!
                </h2>
                <p class="mt-2 max-w-2xl text-xl text-slate-400">
                    Continúa tu aprendizaje o explora nuevos cursos.
                </p>
            </div>

            <h3 class="text-lg leading-6 font-medium text-slate-200 mb-4">
                Tus Cursos Disponibles
            </h3>

            <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                @foreach($courses as $course)
                    <div
                        class="flex flex-col rounded-2xl shadow-md bg-slate-800 overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-1 hover:shadow-[#FF6600]/20 group border border-slate-700">
                        <div class="flex-shrink-0 relative bg-slate-700 h-48 flex items-center justify-center p-4">
                            @if($course->image_path)
                                <img class="h-full w-full object-contain" src="{{ asset('storage/' . $course->image_path) }}"
                                    alt="{{ $course->title }}">
                            @else
                                <div class="h-full w-full bg-[#FF6600] flex items-center justify-center">
                                    <span class="text-white text-4xl font-bold">{{ substr($course->title, 0, 1) }}</span>
                                </div>
                            @endif
                        </div>
                        <div class="flex-1 p-5 flex flex-col justify-between">
                            <div class="flex-1">
                                <a href="{{ route('courses.show', $course->slug) }}" class="block mt-1">
                                    <p
                                        class="text-lg font-bold text-white line-clamp-2 leading-tight group-hover:text-[#FF6600] transition-colors">
                                        {{ $course->title }}
                                    </p>
                                    <p class="mt-2 text-sm text-slate-400 line-clamp-2">
                                        {!! strip_tags($course->description) !!}
                                    </p>
                                </a>
                            </div>
                            <div class="mt-4 flex items-center justify-between">
                                <div class="text-lg font-bold text-[#FF6600]">
                                    ${{ number_format($course->price, 2) }}
                                </div>
                                <a href="{{ route('courses.show', $course->slug) }}"
                                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg text-white bg-[#FF6600] hover:bg-[#E65C00] transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF6600]">
                                    Ver Curso
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if($courses->isEmpty())
                <div class="text-center mt-20">
                    <svg class="mx-auto h-12 w-12 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                    <p class="mt-2 text-sm text-slate-500">No hay cursos disponibles por el momento.</p>
                </div>
            @endif
        </div>
    </div>
</x-layout>