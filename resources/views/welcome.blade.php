<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>22 DESIGN Studio | Management System</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-gray-50 text-gray-900 selection:bg-blue-600 selection:text-white">
    
    <div class="relative min-h-screen flex flex-col items-center justify-center overflow-hidden">
        
        <div class="absolute -top-24 -left-24 w-96 h-96 bg-blue-100 rounded-full mix-blend-multiply filter blur-3xl opacity-50"></div>
        <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-gray-200 rounded-full mix-blend-multiply filter blur-3xl opacity-50"></div>

        <div class="relative z-10 w-full max-w-3xl px-6 flex flex-col items-center text-center">
            
            <div class="mb-6 inline-flex items-center px-3 py-1 rounded-full bg-blue-50 text-blue-700 text-xs font-bold tracking-widest uppercase border border-blue-100 shadow-sm">
                Sistem Manajemen Internal
            </div>

            <div class="mb-8 bg-white p-4 px-8 rounded-2xl shadow-sm border border-gray-100 inline-block">
                <div class="font-extrabold text-5xl md:text-6xl tracking-tighter">
                    <span class="text-gray-800">22</span><span class="text-blue-600">DESIGN</span>
                </div>
                <div class="text-sm font-bold text-gray-400 tracking-[0.4em] mt-1">STUDIO KREATIF</div>
            </div>

            <h1 class="text-3xl md:text-5xl font-extrabold text-gray-900 mb-6 leading-tight">
                Pusat Kendali <br> Project & Keuangan
            </h1>
            
            <p class="text-lg text-gray-500 mb-10 max-w-xl mx-auto font-medium">
                Satu platform untuk mengelola klien, melacak progres desain desainer, hingga mencetak invoice tagihan secara otomatis.
            </p>

            <div class="flex flex-col sm:flex-row justify-center gap-4 w-full sm:w-auto">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="w-full sm:w-auto px-8 py-3 rounded-lg bg-blue-600 text-white font-bold shadow-lg shadow-blue-200 hover:bg-blue-700 hover:-translate-y-0.5 transition duration-200">
                            Masuk ke Ruang Kerja
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="w-full sm:w-auto px-8 py-3 rounded-lg bg-gray-900 text-white font-bold shadow-lg shadow-gray-200 hover:bg-gray-800 hover:-translate-y-0.5 transition duration-200">
                            Log In Staff
                        </a>
                    @endauth
                @endif
            </div>

        </div>
        
        <div class="absolute bottom-6 w-full text-center text-xs font-medium text-gray-400">
            &copy; {{ date('Y') }} Dibangun dengan &hearts; oleh 22 DESIGN Tim.
        </div>
    </div>

</body>
</html>