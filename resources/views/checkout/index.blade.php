<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-900">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Checkout - {{ $course->title }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>

<body class="bg-slate-900 text-slate-300 min-h-full py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-12 text-center">
            <a href="/">
                <img class="mx-auto h-12 w-auto rounded-lg mb-6" src="{{ asset('images/logo-buenfil.jpg') }}" alt="Logo">
            </a>
            <h1 class="text-3xl font-extrabold text-white">Finalizar Compra</h1>
            <p class="mt-2 text-slate-400">Estás por adquirir: <span class="text-[#FF6600] font-semibold">{{ $course->title }}</span></p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Course Summary -->
            <div class="bg-slate-800 p-8 rounded-2xl border border-slate-700 shadow-xl">
                <h2 class="text-xl font-bold text-white mb-6">Resumen del pedido</h2>
                <div class="flex items-center mb-8">
                    <div class="h-20 w-20 bg-slate-900 rounded-lg flex items-center justify-center p-2 border border-slate-700">
                        @if($course->image_path)
                            <img src="{{ asset('storage/' . $course->image_path) }}" alt="" class="max-h-full object-contain">
                        @else
                            <span class="text-[#FF6600] font-bold text-2xl">{{ substr($course->title, 0, 1) }}</span>
                        @endif
                    </div>
                    <div class="ml-4">
                        <p class="text-white font-medium">{{ $course->title }}</p>
                        <p class="text-slate-500 text-sm">Acceso de por vida</p>
                    </div>
                </div>
                
                <div class="border-t border-slate-700 pt-6 space-y-4">
                    <div class="flex justify-between text-slate-400">
                        <span>Subtotal</span>
                        <span>${{ number_format($course->price, 2) }}</span>
                    </div>
                    <div class="flex justify-between text-2xl font-bold text-white">
                        <span>Total</span>
                        <span class="text-[#FF6600]">${{ number_format($course->price, 2) }}</span>
                    </div>
                </div>
            </div>

            <!-- Payment Selection -->
            <div class="space-y-6">
                <h2 class="text-xl font-bold text-white mb-6">Selecciona tu método de pago</h2>

                <!-- Stripe Option -->
                <form action="{{ route('checkout.stripe', $course) }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full group bg-slate-800 hover:bg-slate-700 border border-slate-700 hover:border-[#FF6600]/50 p-6 rounded-2xl transition-all text-left flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="bg-indigo-500/10 p-3 rounded-xl mr-4 group-hover:bg-indigo-500/20 transition-colors">
                                <svg class="w-6 h-6 text-indigo-400" fill="currentColor" viewBox="0 0 24 24"><path d="M20 4H4c-1.11 0-1.99.89-1.99 2L2 18c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V6c0-1.11-.89-2-2-2zm0 14H4v-6h16v6zm0-10H4V6h16v2z"/></svg>
                            </div>
                            <div>
                                <p class="text-white font-bold text-lg">Tarjeta Bancaria</p>
                                <p class="text-slate-400 text-sm">Pago seguro vía Stripe</p>
                            </div>
                        </div>
                        <svg class="w-6 h-6 text-slate-600 group-hover:text-[#FF6600] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </button>
                </form>

                <!-- Deposit Option -->
                <a href="{{ route('checkout.deposit', $course) }}" class="group bg-slate-800 hover:bg-slate-700 border border-slate-700 hover:border-[#FF6600]/50 p-6 rounded-2xl transition-all text-left flex items-center justify-between block">
                    <div class="flex items-center">
                        <div class="bg-[#FF6600]/10 p-3 rounded-xl mr-4 group-hover:bg-[#FF6600]/20 transition-colors">
                            <svg class="w-6 h-6 text-[#FF6600]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        </div>
                        <div>
                            <p class="text-white font-bold text-lg">Depósito / Transferencia</p>
                            <p class="text-slate-400 text-sm">Vía OXXO o Banco</p>
                        </div>
                    </div>
                    <svg class="w-6 h-6 text-slate-600 group-hover:text-[#FF6600] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>

                <div class="text-center">
                    <a href="{{ route('courses.show', $course->slug) }}" class="text-sm text-slate-500 hover:text-white transition-colors underline">Cancelar y volver</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
