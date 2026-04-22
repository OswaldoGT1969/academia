<x-layout>
    <div class="mb-8">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-2">
                <li>
                    <a href="{{ route('dashboard') }}" class="text-slate-400 hover:text-white transition-colors">Mis Cursos</a>
                </li>
                <li>
                    <svg class="h-5 w-5 text-slate-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                </li>
                <li class="text-slate-200 font-medium">Cuestionario: {{ $quiz->title }}</li>
            </ol>
        </nav>
    </div>

    <div class="max-w-4xl mx-auto">
        <div class="bg-slate-800 rounded-3xl border border-slate-700 shadow-2xl overflow-hidden">
            <div class="p-8 bg-slate-700/30 border-b border-slate-700">
                <h1 class="text-2xl font-bold text-white mb-2">{{ $quiz->title }}</h1>
                <p class="text-slate-400">Puntuación mínima para aprobar: <span class="text-[#FF6600] font-bold">{{ $quiz->passing_score }}%</span></p>
            </div>

            <form action="{{ route('quizzes.submit', $course) }}" method="POST" class="p-8 space-y-12">
                @csrf
                
                @foreach($quiz->questions as $index => $question)
                <div class="space-y-4">
                    <div class="flex items-start space-x-4">
                        <span class="flex-shrink-0 w-8 h-8 rounded-full bg-slate-700 text-[#FF6600] flex items-center justify-center font-bold">
                            {{ $index + 1 }}
                        </span>
                        <h3 class="text-lg font-medium text-white">{{ $question->question_text }}</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 ml-12">
                        @foreach($question->options as $option)
                        <label class="relative cursor-pointer group block">
                            <input type="radio" name="answers[{{ $question->id }}]" value="{{ $option->id }}" class="sr-only peer" required>
                            <div class="flex items-center p-4 rounded-xl border border-slate-700 bg-slate-900/50 
                                peer-checked:border-[#FF6600] peer-checked:bg-[#FF6600]/10 
                                peer-checked:[&_div.radio-circle]:border-[#FF6600] peer-checked:[&_div.radio-circle]:bg-[#FF6600]
                                peer-checked:[&_div.radio-dot]:scale-100
                                peer-checked:[&_span]:text-white
                                hover:border-[#FF6600]/50 hover:bg-slate-700/30 transition-all">
                                
                                <div class="radio-circle flex-shrink-0 w-6 h-6 border-2 border-slate-600 rounded-full flex items-center justify-center transition-all">
                                    <div class="radio-dot w-2 h-2 bg-white rounded-full scale-0 transition-transform"></div>
                                </div>
                                <span class="ml-3 text-slate-300 group-hover:text-white font-medium transition-colors">{{ $option->option_text }}</span>
                            </div>
                        </label>
                        @endforeach
                    </div>
                </div>
                @endforeach

                <div class="pt-8 border-t border-slate-700 flex justify-end">
                    <button type="submit" class="inline-flex items-center px-8 py-3 bg-[#FF6600] text-white font-bold rounded-xl hover:bg-[#E65C00] transition-all shadow-lg hover:shadow-orange-900/20 transform hover:-translate-y-0.5">
                        Enviar Cuestionario
                        <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
