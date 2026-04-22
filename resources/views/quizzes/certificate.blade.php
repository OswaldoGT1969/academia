<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificado - {{ $course->title }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Great+Vibes&family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <style>
        @media print {
            .no-print { display: none; }
            body { background: white; margin: 0; padding: 0; }
            .cert-container { border: 20px solid #C5A059; height: 100vh; width: 100vw; box-shadow: none; }
        }
        body { font-family: 'Inter', sans-serif; background: #0F172A; }
        .cert-container {
            font-family: 'Cinzel', serif;
            background: #fff;
            color: #1e293b;
            position: relative;
            overflow: hidden;
            border: 15px solid #C5A059;
            background-image: radial-gradient(circle at center, rgba(197, 160, 89, 0.05) 0%, transparent 70%);
        }
        .decorative-border {
            position: absolute;
            top: 20px; left: 20px; right: 20px; bottom: 20px;
            border: 2px solid #C5A059;
            pointer-events: none;
        }
        .script-font { font-family: 'Great+Vibes', cursive; }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen p-4 md:p-12">

    <div class="no-print fixed top-6 right-6 z-50 flex space-x-4">
        <a href="{{ route('dashboard') }}" class="bg-slate-800 text-white px-6 py-3 rounded-xl hover:bg-slate-700 transition-all font-bold shadow-lg flex items-center">
            &larr; Volver
        </a>
        <button onclick="window.print()" class="bg-[#FF6600] text-white px-6 py-3 rounded-xl hover:bg-[#E65C00] transition-all font-bold shadow-lg flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 00-2 2h2m2 4h10a2 2 0 002-2v-4a2 2 0 012-2H5a2 2 0 012 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
            Imprimir / PDF
        </button>
    </div>

    <div class="cert-container w-full max-w-5xl aspect-[1.414/1] shadow-2xl p-12 md:p-24 flex flex-col items-center text-center">
        <div class="decorative-border"></div>
        
        <img src="{{ asset('images/logo-buenfil.jpg') }}" alt="Logo" class="w-24 mb-6 rounded-md">
        
        <h1 class="text-4xl md:text-5xl font-bold tracking-widest text-[#8B6B23] mb-4">Certificado de Aprobación</h1>
        <div class="w-32 h-1 bg-[#C5A059] mb-12"></div>
        
        <p class="text-xl text-slate-500 mb-6 tracking-wide">Por la presente se certifica que:</p>
        
        <h2 class="text-5xl md:text-6xl font-bold text-slate-800 mb-8 script-font tracking-normal">{{ $user->name }}</h2>
        
        <p class="text-xl text-slate-500 mb-8 max-w-2xl leading-relaxed">
            Ha completado satisfactoriamente el curso teórico-práctico de
            <br>
            <span class="text-2xl font-bold text-slate-900 mt-2 block">{{ $course->title }}</span>
        </p>
        
        <p class="text-lg text-slate-400 mb-16">
            Obteniendo una calificación de <strong>{{ $attempt->score }}%</strong> el día {{ $date }}.
        </p>

        <div class="mt-auto w-full flex justify-between items-end">
            <div class="text-center w-64">
                <div class="border-b-2 border-slate-300 mb-2"></div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest leading-relaxed">Ing. Oswaldo Buenfil</p>
                <p class="text-[10px] text-slate-400 uppercase tracking-widest">Director General</p>
            </div>
            
            <div class="flex flex-col items-center">
                <div class="w-24 h-24 border-4 border-[#C5A059]/30 rounded-full flex items-center justify-center text-[#C5A059] mb-2">
                    <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 20 20"><path d="M5 4a2 2 0 012-2h6a2 2 0 012 2v14l-5-2.5L5 18V4z"></path></svg>
                </div>
                <p class="text-[10px] text-slate-300 uppercase tracking-tighter">Sello de Autenticidad</p>
            </div>

            <div class="text-center w-64">
                <div class="border-b-2 border-slate-300 mb-2"></div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest leading-relaxed">Academia Buenfil</p>
                <p class="text-[10px] text-slate-400 uppercase tracking-widest">Plataforma Educativa</p>
            </div>
        </div>
    </div>

</body>
</html>
