<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV & Portofolio - Leonard Hega Hutagalung</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-slate-950 text-slate-100 min-h-screen font-sans selection:bg-indigo-500 selection:text-white">

    <!-- Background Glow Gradient -->
    <div class="fixed inset-0 -z-10 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-40 w-96 h-96 bg-indigo-600/20 rounded-full blur-3xl"></div>
        <div class="absolute top-1/2 -left-40 w-96 h-96 bg-purple-600/20 rounded-full blur-3xl"></div>
    </div>

    <div class="max-w-6xl mx-auto px-6 py-10">
        <!-- Header Actions -->
        <header class="flex justify-between items-center pb-6 border-b border-slate-800/80 mb-8">
            <span class="px-3 py-1 bg-indigo-500/10 text-indigo-400 text-xs font-semibold rounded-full border border-indigo-500/20">
                NIM: 1100 | Kelas: 2TID
            </span>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin') }}" class="px-4 py-2 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-500 hover:to-purple-500 text-white rounded-xl text-sm font-semibold shadow-lg shadow-indigo-600/20 transition-all flex items-center gap-2">
                    <i class="fa-solid fa-sliders"></i> Kelola Data (CRUD)
                </a>
                <button onclick="window.print()" class="px-4 py-2 bg-slate-900 hover:bg-slate-800 text-slate-300 rounded-xl text-sm font-medium border border-slate-800 transition-all flex items-center gap-2">
                    <i class="fa-solid fa-print"></i> Cetak / PDF
                </button>
            </div>
        </header>

        <!-- BIODATA & PROFIL CARD -->
        <section class="bg-slate-900/60 border border-slate-800/80 rounded-3xl p-6 md:p-8 backdrop-blur-xl shadow-2xl mb-12">
            <div class="flex flex-col md:flex-row items-center gap-6 md:gap-8">
                <!-- Foto Profil / Avatar -->
                <div class="relative shrink-0">
                    <img src="https://ui-avatars.com/api/?name=Leonard+Hega+Hutagalung&background=4f46e5&color=fff&size=160&bold=true"
                         alt="Foto Profil"
                         class="w-32 h-32 md:w-40 md:h-40 rounded-2xl object-cover border-2 border-indigo-500/40 shadow-xl">
                    <span class="absolute -bottom-2 -right-2 bg-emerald-500 text-slate-950 text-xs font-bold px-2 py-0.5 rounded-md flex items-center gap-1 shadow-md">
                        <span class="w-2 h-2 rounded-full bg-slate-950 animate-pulse"></span> Active
                    </span>
                </div>

                <!-- Info Identitas Diri -->
                <div class="flex-1 text-center md:text-left">
                    <h1 class="text-3xl md:text-4xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 via-purple-400 to-pink-400">
                        Leonard Hega Hutagalung
                    </h1>
                    <p class="text-indigo-400 font-medium text-sm md:text-base mt-1">
                        Web Developer & Informatics Student
                    </p>
                    <p class="text-slate-400 text-sm mt-3 leading-relaxed max-w-2xl">
                        Halo! Saya mahasiswa Teknik Informatika yang berfokus pada pengembangan aplikasi web modern menggunakan Laravel, Tailwind CSS, dan MySQL.
                    </p>

                    <!-- Bio Detail Badges -->
                    <div class="flex flex-wrap justify-center md:justify-start gap-4 mt-5 text-xs text-slate-300">
                        <span class="flex items-center gap-1.5 px-3 py-1.5 bg-slate-950/60 border border-slate-800 rounded-xl">
                            <i class="fa-solid fa-id-card text-indigo-400"></i> NIM: 1100
                        </span>
                        <span class="flex items-center gap-1.5 px-3 py-1.5 bg-slate-950/60 border border-slate-800 rounded-xl">
                            <i class="fa-solid fa-graduation-cap text-purple-400"></i> Kelas: 2TID
                        </span>
                        <span class="flex items-center gap-1.5 px-3 py-1.5 bg-slate-950/60 border border-slate-800 rounded-xl">
                            <i class="fa-solid fa-envelope text-pink-400"></i> leonard@example.com
                        </span>
                    </div>
                </div>
            </div>
        </section>

        <!-- Skill Section -->
        <section class="mb-12">
            <h2 class="text-xl font-bold mb-4 flex items-center gap-2 text-indigo-400">
                <i class="fa-solid fa-code"></i> Keahlian / Skills
            </h2>
            <div class="flex flex-wrap gap-3">
                @forelse($skills as $skill)
                    <div class="px-4 py-2 bg-slate-900/80 border border-slate-800/80 rounded-xl flex items-center gap-3 backdrop-blur-md">
                        <span class="font-semibold text-slate-200 text-sm">{{ $skill->nama_skill }}</span>
                        <span class="text-xs bg-indigo-500/10 text-indigo-400 border border-indigo-500/20 px-2 py-0.5 rounded-full font-medium">{{ $skill->tingkat }}</span>
                    </div>
                @empty
                    <p class="text-slate-500 text-sm">Belum ada skill yang ditambahkan.</p>
                @endforelse
            </div>
        </section>

        <!-- Project Portfolio Section -->
        <section>
            <h2 class="text-xl font-bold mb-6 flex items-center gap-2 text-purple-400">
                <i class="fa-solid fa-layer-group"></i> Daftar Proyek & Karya
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($portofolios as $item)
                    <div class="bg-slate-900/60 border border-slate-800/80 rounded-2xl overflow-hidden shadow-xl backdrop-blur-xl flex flex-col justify-between group hover:border-indigo-500/40 transition-all">
                        <div>
                            <div class="h-48 bg-slate-950 relative overflow-hidden">
                                @if($item->gambar)
                                    <img src="{{ asset('storage/'.$item->gambar) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-slate-700">
                                        <i class="fa-regular fa-image text-4xl"></i>
                                    </div>
                                @endif
                                <span class="absolute top-3 left-3 bg-slate-950/80 backdrop-blur-md text-indigo-400 text-xs px-2.5 py-1 rounded-full border border-slate-700">
                                    {{ $item->skill->nama_skill ?? 'General' }}
                                </span>
                            </div>
                            <div class="p-5">
                                <h3 class="font-bold text-lg text-slate-100 group-hover:text-indigo-400 transition-colors">{{ $item->judul }}</h3>
                                <p class="text-slate-400 text-sm mt-2 leading-relaxed">{{ $item->deskripsi }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12 border border-dashed border-slate-800 rounded-2xl text-slate-500">
                        Belum ada proyek yang ditampilkan.
                    </div>
                @endforelse
            </div>
        </section>
    </div>
</body>
</html>
