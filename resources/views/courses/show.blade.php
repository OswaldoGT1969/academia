<x-layout>
    <div class="bg-slate-900">
        <div class="max-w-7xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:px-8">
            <div class="lg:grid lg:grid-cols-2 lg:gap-8 lg:items-center">
                <div>
                    <h2 class="text-3xl font-extrabold text-white sm:text-4xl">
                        {{ $course->title }}
                    </h2>
                    <p class="mt-4 text-lg text-slate-400">
                        {!! $course->description !!}
                    </p>

                    <div class="mt-8 flex items-center">
                        <div class="text-3xl font-bold text-[#FF6600] mr-8">
                            ${{ number_format($course->price, 2) }}
                        </div>

                        <div class="flex space-x-4">
                            @if($isOwned)
                                <div class="flex flex-col sm:flex-row gap-4">
                                    <a href="{{ route('lessons.show', ['course_slug' => $course->slug]) }}"
                                        class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-2xl text-white bg-green-600 hover:bg-green-700 transition-colors shadow-sm hover:shadow-md">
                                        Entrar al Curso
                                    </a>
                                    @if($course->quiz && $course->quiz->is_active)
                                        <a href="{{ route('quizzes.show', $course) }}"
                                            class="inline-flex items-center justify-center px-5 py-3 border-2 border-[#FF6600] text-base font-medium rounded-2xl text-[#FF6600] hover:bg-[#FF6600] hover:text-white transition-all shadow-sm">
                                            Tomar Cuestionario
                                        </a>
                                    @endif
                                </div>
                            @else
                                <a href="{{ route('checkout.show', $course) }}"
                                    class="inline-flex items-center justify-center px-8 py-4 border border-transparent text-lg font-bold rounded-2xl text-white bg-[#FF6600] hover:bg-[#E65C00] transition-all shadow-lg hover:shadow-[#FF6600]/30 transform hover:-translate-y-1">
                                    Inscribirse Ahora
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="mt-8 lg:mt-0">
                    <div class="rounded-2xl shadow-lg ring-1 ring-white/10 overflow-hidden bg-white">
                        <!-- Kept bg-white for image container -->
                        @if($course->image_path)
                            <img class="w-full h-full object-contain" src="{{ asset('storage/' . $course->image_path) }}"
                                alt="{{ $course->title }}">
                        @else
                            <div class="h-96 w-full bg-[#FF6600] flex items-center justify-center">
                                <span class="text-white text-6xl font-bold">{{ substr($course->title, 0, 1) }}</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="mt-16 border-t border-slate-700 pt-10">
                <h3 class="text-2xl font-bold text-white mb-6">Contenido del Curso</h3>
                <div class="bg-slate-800 shadow overflow-hidden sm:rounded-2xl border border-slate-700">
                    <ul role="list" class="divide-y divide-slate-700">
                        @foreach($course->lessons()->orderBy('order_index')->get() as $lesson)
                            <li>
                                <div class="px-4 py-4 sm:px-6 hover:bg-slate-700/50 transition-colors">
                                    <div class="flex items-center justify-between">
                                        <p class="text-base font-medium text-slate-200 truncate">
                                            <span class="text-[#FF6600] mr-2">Lección {{ $lesson->order_index }}:</span>
                                            {{ $lesson->title }}
                                        </p>
                                        <div class="ml-2 flex-shrink-0 flex">
                                            @if($loop->first)
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-orange-900/30 text-[#FF6600] border border-orange-500/20">
                                                    Gratis
                                                </span>
                                            @else
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-slate-700 text-slate-300">
                                                    Miembros
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-layout>