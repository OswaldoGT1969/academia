<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-900">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Depósito - Academia Buenfil</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="//unpkg.com/alpinejs" defer></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>

<body class="bg-slate-900 text-slate-300 min-h-full py-12" x-data="{ 
    fileName: '', 
    filePreview: null,
    isImage: false,
    handleFile(event) {
        const file = event.target.files[0];
        if (!file) return;
        
        this.fileName = file.name;
        this.isImage = file.type.startsWith('image/');
        
        if (this.isImage) {
            const reader = new FileReader();
            reader.onload = (e) => { this.filePreview = e.target.result; };
            reader.readAsDataURL(file);
        } else {
            this.filePreview = null;
        }
    }
}">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-slate-800 rounded-3xl border border-slate-700 shadow-2xl overflow-hidden">
            <div class="p-8 bg-slate-700/30 border-b border-slate-700">
                <h1 class="text-2xl font-bold text-white">Instrucciones de Pago</h1>
                <p class="text-slate-400">Realiza tu depósito para el curso: <span class="text-[#FF6600]">{{ $course->title }}</span></p>
            </div>

            <div class="p-8 space-y-8">
                <!-- Bank Info -->
                <div class="bg-slate-900/50 p-6 rounded-2xl border border-slate-700">
                    <h2 class="text-[#FF6600] font-bold uppercase tracking-widest text-xs mb-4">Datos Bancarios</h2>
                    <div class="space-y-4">
                        <div>
                            <p class="text-slate-500 text-xs uppercase">Banco</p>
                            <p class="text-xl font-bold text-white uppercase">BANCOPPEL</p>
                        </div>
                        <div>
                            <p class="text-slate-500 text-xs uppercase">CLABE Interbancaria</p>
                            <p class="text-2xl font-mono text-white tracking-wider">137 691 102 167 974 563</p>
                        </div>
                        <div>
                            <p class="text-slate-500 text-xs uppercase">Beneficiario</p>
                            <p class="text-lg text-white font-medium uppercase">ARTURO BUENFIL ZÚÑIGA</p>
                        </div>
                    </div>
                </div>

                <!-- Guidance -->
                <div class="flex items-start">
                    <div class="bg-blue-500/10 p-2 rounded-lg mr-4">
                        <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <p class="text-sm text-slate-400 leading-relaxed">
                            Una vez realizado el depósito o transferencia, por favor toma una foto clara o captura de pantalla de tu comprobante y súbelo usando el siguiente formulario.
                        </p>
                    </div>
                </div>

                <!-- Upload Form -->
                <form action="{{ route('checkout.deposit.post', $course) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-2">Subir Comprobante (Imagen o PDF)</label>
                        
                        <!-- Main Upload Box -->
                        <div x-show="!fileName" class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-slate-700 border-dashed rounded-2xl hover:border-[#FF6600]/50 transition-colors">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-slate-500" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-slate-400">
                                    <label for="proof" class="relative cursor-pointer bg-slate-800 rounded-md font-medium text-[#FF6600] hover:text-[#E65C00] focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-offset-slate-900 focus-within:ring-[#FF6600]">
                                        <span>Cargar un archivo</span>
                                        <input id="proof" name="proof" type="file" class="sr-only" required @change="handleFile">
                                    </label>
                                    <p class="pl-1">o arrastra y suelta</p>
                                </div>
                                <p class="text-xs text-slate-500">PNG, JPG, PDF hasta 5MB</p>
                            </div>
                        </div>

                        <!-- Preview / Feedback Box -->
                        <div x-show="fileName" x-cloak class="mt-1 p-6 bg-slate-900/50 border-2 border-[#FF6600]/30 rounded-2xl flex flex-col items-center">
                            <!-- Image Preview -->
                            <template x-if="isImage && filePreview">
                                <img :src="filePreview" class="max-h-48 rounded-lg shadow-lg mb-4 border border-slate-700">
                            </template>
                            
                            <!-- File Icon (Non-image or fallback) -->
                            <template x-if="!isImage">
                                <div class="bg-[#FF6600]/10 p-4 rounded-full mb-4">
                                    <svg class="w-12 h-12 text-[#FF6600]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </template>

                            <div class="flex items-center space-x-2 text-white">
                                <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                <span class="font-medium" x-text="fileName"></span>
                            </div>
                            
                            <button type="button" @click="fileName = ''; filePreview = null; document.getElementById('proof').value = ''" class="mt-4 text-xs text-slate-500 hover:text-red-400 transition-colors">
                                Cambiar archivo
                            </button>
                        </div>
                        @error('proof')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center space-x-4">
                        <a href="{{ route('checkout.show', $course) }}" class="flex-1 text-center py-4 px-6 border border-slate-700 rounded-xl text-slate-400 font-medium hover:bg-slate-700/50 transition-all">
                            Volver
                        </a>
                        <button type="submit" class="flex-[2] py-4 px-6 bg-[#FF6600] hover:bg-[#E65C00] text-white font-bold rounded-xl shadow-lg hover:shadow-[#FF6600]/20 transition-all">
                            Enviar Comprobante
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
