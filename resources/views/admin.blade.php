<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Data CRUD - 1100</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-slate-950 text-slate-100 min-h-screen font-sans">
    <div class="max-w-7xl mx-auto px-6 py-10">
        <header class="flex justify-between items-center mb-8 pb-4 border-b border-slate-800">
            <div>
                <h1 class="text-2xl font-bold text-indigo-400">Panel Kelola Data (CRUD)</h1>
                <p class="text-slate-400 text-xs">Tambah, Edit, dan Hapus Skill & Proyek</p>
            </div>
            <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-slate-800 hover:bg-slate-700 text-slate-200 rounded-xl text-sm font-medium border border-slate-700">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke CV / Dashboard
            </a>
        </header>

        @if(session('success'))
            <div class="mb-6 p-4 bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 rounded-xl flex justify-between">
                <span>{{ session('success') }}</span>
                <button onclick="this.parentElement.remove()">&times;</button>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <!-- Form & Kelola Skill -->
            <aside class="lg:col-span-4 bg-slate-900 border border-slate-800 rounded-2xl p-6">
                <h2 class="text-lg font-bold mb-4 flex items-center gap-2"><i class="fa-solid fa-code text-indigo-400"></i> Kelola Skill</h2>
                <form action="{{ route('skill.store') }}" method="POST" class="space-y-3 mb-6">
                    @csrf
                    <input type="text" name="nama_skill" placeholder="Nama Skill" required class="w-full px-4 py-2 bg-slate-950 border border-slate-800 rounded-xl text-sm">
                    <select name="tingkat" required class="w-full px-4 py-2 bg-slate-950 border border-slate-800 rounded-xl text-sm">
                        <option value="Beginner">Beginner</option>
                        <option value="Intermediate">Intermediate</option>
                        <option value="Expert">Expert</option>
                    </select>
                    <button type="submit" class="w-full py-2 bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-medium rounded-xl">+ Tambah Skill</button>
                </form>

                <div class="space-y-2">
                    @foreach($skills as $skill)
                        <div class="flex justify-between items-center p-3 bg-slate-950 border border-slate-800 rounded-xl text-sm">
                            <span>{{ $skill->nama_skill }} ({{ $skill->tingkat }})</span>
                            <form action="{{ route('skill.destroy', $skill->id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button type="submit" onclick="return confirm('Hapus skill?')" class="text-rose-400 hover:text-rose-300"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </aside>

            <!-- Kelola Proyek -->
            <main class="lg:col-span-8 bg-slate-900 border border-slate-800 rounded-2xl p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-lg font-bold flex items-center gap-2"><i class="fa-solid fa-layer-group text-purple-400"></i> Kelola Proyek</h2>
                    <button onclick="document.getElementById('modalTambah').classList.remove('hidden')" class="px-4 py-2 bg-purple-600 hover:bg-purple-500 text-white text-sm font-medium rounded-xl">+ Proyek Baru</button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($portofolios as $item)
                        <div class="bg-slate-950 border border-slate-800 rounded-xl p-4 flex flex-col justify-between">
                            <div>
                                @if($item->gambar)
                                    <img src="{{ asset('storage/'.$item->gambar) }}" class="h-32 w-full object-cover rounded-lg mb-3">
                                @endif
                                <h3 class="font-bold text-slate-100">{{ $item->judul }}</h3>
                                <p class="text-slate-400 text-xs mt-1 line-clamp-2">{{ $item->deskripsi }}</p>
                            </div>
                            <div class="flex justify-end gap-2 mt-4 pt-2 border-t border-slate-800">
                                <button onclick="document.getElementById('modalEdit{{ $item->id }}').classList.remove('hidden')" class="px-3 py-1 bg-slate-800 text-xs text-slate-300 rounded-lg">Edit</button>
                                <form action="{{ route('portofolio.destroy', $item->id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="submit" onclick="return confirm('Hapus?')" class="px-3 py-1 bg-rose-500/10 text-rose-400 border border-rose-500/20 text-xs rounded-lg">Hapus</button>
                                </form>
                            </div>
                        </div>

                        <!-- Modal Edit -->
                        <div id="modalEdit{{ $item->id }}" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/70 p-4">
                            <div class="bg-slate-900 border border-slate-800 w-full max-w-lg rounded-2xl p-6">
                                <h3 class="font-bold mb-4">Edit Proyek</h3>
                                <form action="{{ route('portofolio.update', $item->id) }}" method="POST" enctype="multipart/form-data" class="space-y-3">
                                    @csrf @method('PUT')
                                    <input type="text" name="judul" value="{{ $item->judul }}" required class="w-full px-4 py-2 bg-slate-950 border border-slate-800 rounded-xl text-sm">
                                    <select name="skill_id" class="w-full px-4 py-2 bg-slate-950 border border-slate-800 rounded-xl text-sm">
                                        <option value="">-- Pilih Skill --</option>
                                        @foreach($skills as $sk)
                                            <option value="{{ $sk->id }}" {{ $item->skill_id == $sk->id ? 'selected' : '' }}>{{ $sk->nama_skill }}</option>
                                        @endforeach
                                    </select>
                                    <textarea name="deskripsi" rows="3" required class="w-full px-4 py-2 bg-slate-950 border border-slate-800 rounded-xl text-sm">{{ $item->deskripsi }}</textarea>
                                    <input type="file" name="gambar" class="w-full text-xs text-slate-400">
                                    <div class="flex justify-end gap-2 pt-2">
                                        <button type="button" onclick="document.getElementById('modalEdit{{ $item->id }}').classList.add('hidden')" class="px-4 py-2 bg-slate-800 text-xs rounded-xl">Batal</button>
                                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-xs text-white rounded-xl">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </main>
        </div>
    </div>

    <!-- Modal Tambah -->
    <div id="modalTambah" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/70 p-4">
        <div class="bg-slate-900 border border-slate-800 w-full max-w-lg rounded-2xl p-6">
            <h3 class="font-bold mb-4">Tambah Proyek Baru</h3>
            <form action="{{ route('portofolio.store') }}" method="POST" enctype="multipart/form-data" class="space-y-3">
                @csrf
                <input type="text" name="judul" placeholder="Judul Proyek" required class="w-full px-4 py-2 bg-slate-950 border border-slate-800 rounded-xl text-sm">
                <select name="skill_id" class="w-full px-4 py-2 bg-slate-950 border border-slate-800 rounded-xl text-sm">
                    <option value="">-- Pilih Skill --</option>
                    @foreach($skills as $sk)
                        <option value="{{ $sk->id }}">{{ $sk->nama_skill }}</option>
                    @endforeach
                </select>
                <textarea name="deskripsi" placeholder="Deskripsi Proyek" rows="3" required class="w-full px-4 py-2 bg-slate-950 border border-slate-800 rounded-xl text-sm"></textarea>
                <input type="file" name="gambar" class="w-full text-xs text-slate-400">
                <div class="flex justify-end gap-2 pt-2">
                    <button type="button" onclick="document.getElementById('modalTambah').classList.add('hidden')" class="px-4 py-2 bg-slate-800 text-xs rounded-xl">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-purple-600 text-xs text-white rounded-xl">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
