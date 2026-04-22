<x-layout>
    <div class="max-w-2xl mx-auto pt-12">
        <div class="bg-slate-800 rounded-3xl border border-slate-700 shadow-2xl overflow-hidden p-8 text-center">
            @if($passed)
                <div class="w-24 h-24 bg-green-500/20 text-green-500 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-white mb-2">¡Felicidades, aprobaste!</h1>
                <p class="text-slate-400 mb-8">Has completado satisfactoriamente el cuestionario de <strong>{{ $course->title }}</strong>.</p>
            @else
                <div class="w-24 h-24 bg-red-500/20 text-red-500 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-white mb-2">No has aprobado</h1>
                <p class="text-slate-400 mb-8">No te preocupes, puedes volver a intentarlo después de repasar las lecciones.</p>
            @endif

            <div class="bg-slate-900/50 rounded-2xl p-6 mb-8 grid grid-cols-2 gap-4">
                <div class="text-center border-r border-slate-700">
                    <p class="text-slate-500 text-sm uppercase font-bold tracking-wider mb-1">Calificación</p>
                    <p class="text-3xl font-bold {{ $passed ? 'text-green-500' : 'text-red-500' }}">{{ $score }}%</p>
                </div>
                <div class="text-center">
                    <p class="text-slate-500 text-sm uppercase font-bold tracking-wider mb-1">Aciertos</p>
                    <p class="text-3xl font-bold text-white">{{ $correctAnswers }} / {{ $totalQuestions }}</p>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                @if($passed)
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center justify-center px-8 py-3 bg-[#FF6600] text-white font-bold rounded-xl hover:bg-[#E65C00] transition-all">
                        Ir a Mis Cursos
                    </a>
                    <a href="{{ route('quizzes.certificate', $course) }}" class="inline-flex items-center justify-center px-8 py-3 border border-slate-700 text-white font-bold rounded-xl hover:bg-slate-700 transition-all">
                        Ver Certificado
                    </a>
                @else
                    <a href="{{ route('quizzes.show', $course) }}" class="inline-flex items-center justify-center px-8 py-3 bg-[#FF6600] text-white font-bold rounded-xl hover:bg-[#E65C00] transition-all">
                        Reintentar
                    </a>
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center justify-center px-8 py-3 border border-slate-700 text-white font-bold rounded-xl hover:bg-slate-700 transition-all">
                        Volver al Panel
                    </a>
                @endif
            </div>
        </div>
    </div>
</x-layout>
