@extends('layouts.app')

@section('title', 'Template Surat')
@section('breadcrumb-parent', 'Warga')
@section('breadcrumb-current', 'Template Surat')

@section('content')

    {{-- HEADER --}}
    <div class="mb-8">
        <h1 class="font-manrope font-bold text-2xl" style="color: #191c1e;">Template Surat</h1>
        <p class="text-sm mt-1" style="color: #3d4947;">Download template, isi secara mandiri, lalu upload saat membuat pengajuan.</p>
    </div>

    {{-- ALUR PANDUAN --}}
    <div class="bg-white rounded-[1.5rem] p-6 mb-8">
        <h2 class="font-manrope font-bold text-sm mb-4" style="color: #191c1e;">Cara Mengajukan Surat</h2>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div class="flex items-start gap-3">
                <div class="w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0 text-sm font-bold text-white"
                     style="background: linear-gradient(135deg, #00685d, #008376);">1</div>
                <div>
                    <p class="text-sm font-semibold" style="color: #191c1e;">Download Template</p>
                    <p class="text-xs mt-0.5" style="color: #6d7a77;">Unduh template surat yang sesuai kebutuhan Anda.</p>
                </div>
            </div>
            <div class="flex items-start gap-3">
                <div class="w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0 text-sm font-bold text-white"
                     style="background: linear-gradient(135deg, #2b6485, #3a82a8);">2</div>
                <div>
                    <p class="text-sm font-semibold" style="color: #191c1e;">Isi & Lengkapi</p>
                    <p class="text-xs mt-0.5" style="color: #6d7a77;">Isi data diri sesuai kebutuhan, pastikan informasi akurat.</p>
                </div>
            </div>
            <div class="flex items-start gap-3">
                <div class="w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0 text-sm font-bold text-white"
                     style="background: linear-gradient(135deg, #416538, #5a8a4f);">3</div>
                <div>
                    <p class="text-sm font-semibold" style="color: #191c1e;">Upload & Ajukan</p>
                    <p class="text-xs mt-0.5" style="color: #6d7a77;">Upload surat yang sudah diisi saat membuat pengajuan baru.</p>
                </div>
            </div>
        </div>
    </div>

    {{-- TEMPLATE GRID --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

        {{-- Template 1 --}}
        <div class="bg-white rounded-[1.5rem] p-6 ambient-lift flex flex-col">
            <div class="w-12 h-12 rounded-2xl flex items-center justify-center mb-4"
                 style="background: linear-gradient(135deg, rgba(0,104,93,0.10), rgba(0,104,93,0.04));">
                <span class="material-icons-outlined text-xl" style="color: #00685d;">home</span>
            </div>
            <h3 class="font-manrope font-bold text-base mb-1" style="color: #191c1e;">Surat Keterangan Domisili</h3>
            <p class="text-xs mb-4 flex-1" style="color: #6d7a77;">Digunakan untuk keperluan administrasi tempat tinggal, BPJS, dan sejenisnya.</p>
            <div class="flex gap-2 mt-auto">
                <a href="#" onclick="alertDummy(event)"
                   class="flex-1 inline-flex items-center justify-center gap-1.5 px-3 py-2 rounded-xl text-xs font-semibold text-white transition-all hover:shadow-md"
                   style="background: linear-gradient(135deg, #00685d, #008376);">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                    </svg>
                    Download
                </a>
                <button onclick="previewTemplate('Surat Keterangan Domisili','Digunakan untuk keperluan tempat tinggal, BPJS, dan administrasi lainnya. Isi nama lengkap, NIK, dan alamat.')"
                        class="px-3 py-2 rounded-xl text-xs font-semibold transition-colors hover:bg-[#00685d] hover:text-white"
                        style="background-color: #eceef0; color: #3d4947;">Preview</button>
            </div>
        </div>

        {{-- Template 2 --}}
        <div class="bg-white rounded-[1.5rem] p-6 ambient-lift flex flex-col">
            <div class="w-12 h-12 rounded-2xl flex items-center justify-center mb-4"
                 style="background: linear-gradient(135deg, rgba(65,101,56,0.10), rgba(65,101,56,0.04));">
                <span class="material-icons-outlined text-xl" style="color: #416538;">verified_user</span>
            </div>
            <h3 class="font-manrope font-bold text-base mb-1" style="color: #191c1e;">Surat Berkelakuan Baik</h3>
            <p class="text-xs mb-4 flex-1" style="color: #6d7a77;">Diperlukan untuk melamar pekerjaan, beasiswa, atau pendaftaran instansi.</p>
            <div class="flex gap-2 mt-auto">
                <a href="#" onclick="alertDummy(event)"
                   class="flex-1 inline-flex items-center justify-center gap-1.5 px-3 py-2 rounded-xl text-xs font-semibold text-white transition-all hover:shadow-md"
                   style="background: linear-gradient(135deg, #00685d, #008376);">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                    </svg>
                    Download
                </a>
                <button onclick="previewTemplate('Surat Berkelakuan Baik','Diperlukan untuk melamar pekerjaan, beasiswa, atau pendaftaran. Isi nama, NIK, dan tujuan surat.')"
                        class="px-3 py-2 rounded-xl text-xs font-semibold transition-colors hover:bg-[#00685d] hover:text-white"
                        style="background-color: #eceef0; color: #3d4947;">Preview</button>
            </div>
        </div>

        {{-- Template 3 --}}
        <div class="bg-white rounded-[1.5rem] p-6 ambient-lift flex flex-col">
            <div class="w-12 h-12 rounded-2xl flex items-center justify-center mb-4"
                 style="background: linear-gradient(135deg, rgba(43,100,133,0.10), rgba(43,100,133,0.04));">
                <span class="material-icons-outlined text-xl" style="color: #2b6485;">work</span>
            </div>
            <h3 class="font-manrope font-bold text-base mb-1" style="color: #191c1e;">Surat Keterangan Usaha</h3>
            <p class="text-xs mb-4 flex-1" style="color: #6d7a77;">Untuk keperluan KUR, permohonan kredit usaha mikro, atau legalitas usaha.</p>
            <div class="flex gap-2 mt-auto">
                <a href="#" onclick="alertDummy(event)"
                   class="flex-1 inline-flex items-center justify-center gap-1.5 px-3 py-2 rounded-xl text-xs font-semibold text-white transition-all hover:shadow-md"
                   style="background: linear-gradient(135deg, #00685d, #008376);">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                    </svg>
                    Download
                </a>
                <button onclick="previewTemplate('Surat Keterangan Usaha','Untuk keperluan KUR, kredit usaha, atau legalitas usaha. Isi nama usaha, jenis usaha, dan alamat usaha.')"
                        class="px-3 py-2 rounded-xl text-xs font-semibold transition-colors hover:bg-[#00685d] hover:text-white"
                        style="background-color: #eceef0; color: #3d4947;">Preview</button>
            </div>
        </div>

        {{-- Template 4 --}}
        <div class="bg-white rounded-[1.5rem] p-6 ambient-lift flex flex-col">
            <div class="w-12 h-12 rounded-2xl flex items-center justify-center mb-4"
                 style="background: linear-gradient(135deg, rgba(186,26,26,0.08), rgba(186,26,26,0.03));">
                <span class="material-icons-outlined text-xl" style="color: #ba1a1a;">volunteer_activism</span>
            </div>
            <h3 class="font-manrope font-bold text-base mb-1" style="color: #191c1e;">Surat Keterangan Tidak Mampu</h3>
            <p class="text-xs mb-4 flex-1" style="color: #6d7a77;">Untuk mengajukan bantuan sosial, beasiswa, atau keringanan biaya.</p>
            <div class="flex gap-2 mt-auto">
                <a href="#" onclick="alertDummy(event)"
                   class="flex-1 inline-flex items-center justify-center gap-1.5 px-3 py-2 rounded-xl text-xs font-semibold text-white transition-all hover:shadow-md"
                   style="background: linear-gradient(135deg, #00685d, #008376);">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                    </svg>
                    Download
                </a>
                <button onclick="previewTemplate('Surat Keterangan Tidak Mampu','Untuk bantuan sosial atau keringanan biaya. Isi nama, NIK, kondisi ekonomi, dan tujuan pengajuan.')"
                        class="px-3 py-2 rounded-xl text-xs font-semibold transition-colors hover:bg-[#00685d] hover:text-white"
                        style="background-color: #eceef0; color: #3d4947;">Preview</button>
            </div>
        </div>

        {{-- Template 5 --}}
        <div class="bg-white rounded-[1.5rem] p-6 ambient-lift flex flex-col">
            <div class="w-12 h-12 rounded-2xl flex items-center justify-center mb-4"
                 style="background: linear-gradient(135deg, rgba(0,104,93,0.10), rgba(0,104,93,0.04));">
                <span class="material-icons-outlined text-xl" style="color: #00685d;">family_restroom</span>
            </div>
            <h3 class="font-manrope font-bold text-base mb-1" style="color: #191c1e;">Surat Keterangan Keluarga</h3>
            <p class="text-xs mb-4 flex-1" style="color: #6d7a77;">Untuk mendaftar sekolah, BPJS, atau keperluan administrasi keluarga.</p>
            <div class="flex gap-2 mt-auto">
                <a href="#" onclick="alertDummy(event)"
                   class="flex-1 inline-flex items-center justify-center gap-1.5 px-3 py-2 rounded-xl text-xs font-semibold text-white transition-all hover:shadow-md"
                   style="background: linear-gradient(135deg, #00685d, #008376);">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                    </svg>
                    Download
                </a>
                <button onclick="previewTemplate('Surat Keterangan Keluarga','Untuk mendaftar sekolah atau administrasi keluarga. Isi nama kepala keluarga, anggota keluarga, dan hubungan.')"
                        class="px-3 py-2 rounded-xl text-xs font-semibold transition-colors hover:bg-[#00685d] hover:text-white"
                        style="background-color: #eceef0; color: #3d4947;">Preview</button>
            </div>
        </div>

        {{-- Template 6 --}}
        <div class="bg-white rounded-[1.5rem] p-6 ambient-lift flex flex-col">
            <div class="w-12 h-12 rounded-2xl flex items-center justify-center mb-4"
                 style="background: linear-gradient(135deg, rgba(65,101,56,0.10), rgba(65,101,56,0.04));">
                <span class="material-icons-outlined text-xl" style="color: #416538;">send</span>
            </div>
            <h3 class="font-manrope font-bold text-base mb-1" style="color: #191c1e;">Surat Pengantar Umum</h3>
            <p class="text-xs mb-4 flex-1" style="color: #6d7a77;">Surat pengantar untuk berbagai keperluan umum dari RT ke instansi lain.</p>
            <div class="flex gap-2 mt-auto">
                <a href="#" onclick="alertDummy(event)"
                   class="flex-1 inline-flex items-center justify-center gap-1.5 px-3 py-2 rounded-xl text-xs font-semibold text-white transition-all hover:shadow-md"
                   style="background: linear-gradient(135deg, #00685d, #008376);">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                    </svg>
                    Download
                </a>
                <button onclick="previewTemplate('Surat Pengantar Umum','Surat pengantar ke instansi lain. Isi nama, NIK, tujuan surat, dan instansi yang dituju.')"
                        class="px-3 py-2 rounded-xl text-xs font-semibold transition-colors hover:bg-[#00685d] hover:text-white"
                        style="background-color: #eceef0; color: #3d4947;">Preview</button>
            </div>
        </div>

    </div>

    {{-- MODAL PREVIEW --}}
    <div id="modal-preview" class="fixed inset-0 z-50 hidden items-center justify-center p-4"
         style="background-color: rgba(25,28,30,0.5); backdrop-filter: blur(4px);">
        <div class="w-full max-w-md rounded-[1.5rem] shadow-2xl overflow-hidden" style="background-color: #fff;">
            <div class="flex items-center justify-between px-6 pt-6 pb-4" style="border-bottom: 1px solid #eceef0;">
                <h2 id="prev-title" class="font-manrope font-bold text-base" style="color: #191c1e;"></h2>
                <button onclick="closePreview()" class="w-8 h-8 rounded-lg flex items-center justify-center transition-colors hover:bg-[#eceef0]">
                    <svg class="w-4 h-4" style="color: #6d7a77;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <div class="px-6 py-5">
                <div class="rounded-xl p-4 mb-4" style="background-color: #f2f4f6;">
                    <p id="prev-desc" class="text-sm" style="color: #3d4947;"></p>
                </div>
                <div class="rounded-xl p-4" style="background-color: #eceef0; border: 2px dashed #bcc9c6;">
                    <p class="text-xs text-center font-medium" style="color: #6d7a77;">Preview dokumen akan tersedia saat file asli diunggah oleh Ketua RT.</p>
                </div>
            </div>
            <div class="px-6 pb-6 flex gap-3">
                <button onclick="closePreview()" class="flex-1 px-4 py-2.5 rounded-xl text-sm font-semibold" style="background-color: #eceef0; color: #3d4947;">Tutup</button>
                <a href="#" onclick="alertDummy(event)"
                   class="flex-1 inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl text-sm font-semibold text-white"
                   style="background: linear-gradient(135deg, #00685d, #008376);">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                    </svg>
                    Download
                </a>
            </div>
        </div>
    </div>

@push('scripts')
<script>
function alertDummy(e) {
    e.preventDefault();
    alert('File dummy — akan diganti dengan template asli saat dokumen tersedia dari Ketua RT.');
}
function previewTemplate(title, desc) {
    document.getElementById('prev-title').textContent = title;
    document.getElementById('prev-desc').textContent  = desc;
    const m = document.getElementById('modal-preview');
    m.classList.remove('hidden'); m.classList.add('flex');
    document.body.style.overflow = 'hidden';
}
function closePreview() {
    const m = document.getElementById('modal-preview');
    m.classList.add('hidden'); m.classList.remove('flex');
    document.body.style.overflow = '';
}
document.getElementById('modal-preview').addEventListener('click', function(e) { if(e.target===this) closePreview(); });
document.addEventListener('keydown', e => { if(e.key==='Escape') closePreview(); });
</script>
@endpush

@endsection
