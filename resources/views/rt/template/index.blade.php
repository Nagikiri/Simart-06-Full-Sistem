@extends('layouts.app')

@section('title', 'Template Surat')
@section('breadcrumb-parent', 'RT')
@section('breadcrumb-current', 'Template Surat')

@section('content')

    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="font-manrope font-bold text-2xl" style="color:#191c1e;">Manajemen Template Surat</h1>
            <p class="text-sm mt-1" style="color:#6d7a77;">Template ini dapat diunduh warga untuk diisi sebelum pengajuan.</p>
        </div>
        <button onclick="openUploadModal(null, null)"
                class="inline-flex items-center gap-2 text-white font-semibold px-5 py-2.5 rounded-xl text-sm hover:shadow-md transition-all"
                style="background:linear-gradient(135deg,#00685d,#008376);">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Tambah Template
        </button>
    </div>

    {{-- Info banner --}}
    <div class="rounded-[1.5rem] p-5 mb-8 flex items-start gap-4" style="background-color:#eceef0;">
        <div class="w-9 h-9 rounded-xl flex items-center justify-center flex-shrink-0" style="background:rgba(43,100,133,0.12);">
            <svg class="w-5 h-5" style="color:#2b6485;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <div>
            <p class="text-sm font-semibold" style="color:#191c1e;">Template Tersedia untuk Warga</p>
            <p class="text-xs mt-0.5" style="color:#6d7a77;">Warga dapat mengunduh template dari menu Template Surat di dashboard mereka, mengisi secara mandiri, lalu mengirimkannya ke RT untuk ditandatangani.</p>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

        @foreach([
            ['home','#00685d','rgba(0,104,93,0.10)','Surat Keterangan Domisili','Untuk keperluan tempat tinggal, BPJS, dan administrasi.'],
            ['verified_user','#416538','rgba(65,101,56,0.10)','Surat Berkelakuan Baik','Untuk melamar pekerjaan, beasiswa, atau pendaftaran.'],
            ['work','#2b6485','rgba(43,100,133,0.10)','Surat Keterangan Usaha','Untuk KUR, kredit usaha mikro, atau legalitas usaha.'],
            ['volunteer_activism','#ba1a1a','rgba(186,26,26,0.08)','Surat Keterangan Tidak Mampu','Untuk bantuan sosial, beasiswa, atau keringanan biaya.'],
            ['family_restroom','#00685d','rgba(0,104,93,0.10)','Surat Keterangan Keluarga','Untuk mendaftar sekolah, BPJS, atau administrasi keluarga.'],
            ['send','#416538','rgba(65,101,56,0.10)','Surat Pengantar Umum','Surat pengantar ke instansi lain untuk berbagai keperluan.'],
        ] as [$icon, $color, $bg, $title, $desc])
        <div class="bg-white rounded-[1.5rem] p-6 ambient-lift flex flex-col">
            <div class="w-12 h-12 rounded-2xl flex items-center justify-center mb-4" style="background:{{ $bg }};">
                <span class="material-icons-outlined text-xl" style="color:{{ $color }};">{{ $icon }}</span>
            </div>
            <h3 class="font-manrope font-bold text-base mb-1" style="color:#191c1e;">{{ $title }}</h3>
            <p class="text-xs mb-3 flex-1" style="color:#6d7a77;">{{ $desc }}</p>
            {{-- Status file --}}
            <div class="flex items-center gap-2 mb-4 px-3 py-2 rounded-xl" style="background-color:#eceef0;">
                <svg class="w-3.5 h-3.5 flex-shrink-0" style="color:#6d7a77;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/>
                </svg>
                <span class="text-xs" style="color:#6d7a77;">Belum ada file — klik Upload untuk tambah</span>
            </div>
            <div class="flex gap-2 flex-wrap mt-auto">
                <button onclick="openUploadModal('{{ $title }}')"
                        class="flex-1 px-3 py-2 rounded-xl text-xs font-semibold hover:bg-[#00685d] hover:text-white transition-colors"
                        style="background-color:#eceef0;color:#3d4947;">
                    Upload / Edit
                </button>
                <a href="#" onclick="alert('File dummy — akan tersedia setelah file diupload.')"
                   class="flex-1 inline-flex items-center justify-center gap-1.5 px-3 py-2 rounded-xl text-xs font-semibold text-white hover:shadow-md transition-all"
                   style="background:linear-gradient(135deg,#00685d,#008376);">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                    Download
                </a>
                <button onclick="alert('Fitur hapus tersedia setelah backend terhubung.')"
                        class="px-3 py-2 rounded-xl text-xs font-semibold transition-colors hover:bg-red-100"
                        style="background-color:#ffdad6;color:#93000a;">Hapus</button>
            </div>
        </div>
        @endforeach

    </div>

    {{-- MODAL UPLOAD TEMPLATE --}}
    <div id="modal-upload-template" class="fixed inset-0 z-50 hidden items-center justify-center p-4"
         style="background-color:rgba(25,28,30,0.5);backdrop-filter:blur(4px);">
        <div class="w-full max-w-lg rounded-[1.5rem] shadow-2xl overflow-hidden" style="background-color:#fff;">
            <div class="flex items-center justify-between px-6 pt-6 pb-4" style="border-bottom:1px solid #eceef0;">
                <div>
                    <h2 class="font-manrope font-bold text-base" style="color:#191c1e;">Upload Template Surat</h2>
                    <p id="upload-subtitle" class="text-xs mt-0.5" style="color:#6d7a77;"></p>
                </div>
                <button onclick="closeUploadModal()" class="w-8 h-8 rounded-lg flex items-center justify-center hover:bg-[#eceef0]">
                    <svg class="w-4 h-4" style="color:#6d7a77;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <div class="px-6 py-5 space-y-4">
                <div id="upload-jenis-wrapper">
                    <label class="text-xs font-semibold uppercase tracking-widest block mb-1.5" style="color:#6d7a77;">Jenis Surat</label>
                    <select id="upload-jenis" class="w-full px-4 py-2.5 rounded-xl text-sm focus:outline-none"
                            style="background-color:#f2f4f6;color:#191c1e;border:none;">
                        <option>Surat Keterangan Domisili</option>
                        <option>Surat Berkelakuan Baik</option>
                        <option>Surat Keterangan Usaha</option>
                        <option>Surat Keterangan Tidak Mampu</option>
                        <option>Surat Keterangan Keluarga</option>
                        <option>Surat Pengantar Umum</option>
                    </select>
                </div>
                <div>
                    <label class="text-xs font-semibold uppercase tracking-widest block mb-1.5" style="color:#6d7a77;">File Template (PDF / DOCX)</label>
                    <div id="upload-dropzone"
                         class="rounded-xl border-2 border-dashed p-8 text-center cursor-pointer transition-all"
                         style="border-color:#bcc9c6;background-color:#f7f9fb;"
                         onclick="document.getElementById('upload-file-input').click()"
                         ondragover="event.preventDefault();this.style.borderColor='#00685d'"
                         ondragleave="this.style.borderColor='#bcc9c6'"
                         ondrop="handleUploadDrop(event)">
                        <div class="w-12 h-12 mx-auto rounded-xl flex items-center justify-center mb-3" style="background:rgba(0,104,93,0.10);">
                            <svg class="w-6 h-6" style="color:#00685d;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                            </svg>
                        </div>
                        <p class="text-sm font-semibold" style="color:#191c1e;">Klik untuk pilih file</p>
                        <p class="text-xs mt-1" style="color:#6d7a77;">PDF, DOCX, DOC (maks. 10MB)</p>
                        <input type="file" id="upload-file-input" accept=".pdf,.doc,.docx" class="hidden" onchange="handleUploadFileSelect(this)">
                    </div>
                    <div id="upload-file-preview" class="hidden mt-3 flex items-center gap-3 px-4 py-3 rounded-xl" style="background-color:#f2f4f6;">
                        <svg class="w-8 h-8 flex-shrink-0" style="color:#2b6485;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                        </svg>
                        <div class="flex-1 min-w-0">
                            <p id="upload-file-name" class="text-sm font-semibold truncate" style="color:#191c1e;"></p>
                            <p id="upload-file-size" class="text-xs" style="color:#6d7a77;"></p>
                        </div>
                        <button type="button" onclick="clearUploadFile()" class="p-1 rounded-lg hover:bg-red-50" style="color:#ba1a1a;">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>
                </div>
                <div class="rounded-xl p-3 flex items-start gap-2" style="background-color:#eceef0;">
                    <svg class="w-4 h-4 flex-shrink-0 mt-0.5" style="color:#6d7a77;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <p class="text-xs" style="color:#6d7a77;">File yang diupload dapat diunduh oleh seluruh warga RT 06 sebagai template pengajuan surat.</p>
                </div>
            </div>
            <div class="px-6 pb-6 flex gap-3">
                <button onclick="closeUploadModal()" class="flex-1 px-4 py-2.5 rounded-xl text-sm font-semibold" style="background-color:#eceef0;color:#3d4947;">Batal</button>
                <button onclick="submitUploadTemplate()"
                        class="flex-1 px-4 py-2.5 rounded-xl text-sm font-semibold text-white hover:shadow-md transition-all"
                        style="background:linear-gradient(135deg,#00685d,#008376);">
                    <span id="upload-btn-text">Simpan Template</span>
                </button>
            </div>
        </div>
    </div>

@push('scripts')
<script>
let currentUploadFile = null;

function openUploadModal(title) {
    document.getElementById('upload-subtitle').textContent = title
        ? 'Mengganti file untuk: ' + title
        : 'Upload file template baru';
    const jenis = document.getElementById('upload-jenis');
    if (title) {
        for (let opt of jenis.options) { if (opt.text === title) { opt.selected = true; break; } }
        document.getElementById('upload-jenis-wrapper').style.display = 'none';
    } else {
        document.getElementById('upload-jenis-wrapper').style.display = 'block';
    }
    clearUploadFile();
    const m = document.getElementById('modal-upload-template');
    m.classList.remove('hidden'); m.classList.add('flex');
    document.body.style.overflow = 'hidden';
}

function closeUploadModal() {
    const m = document.getElementById('modal-upload-template');
    m.classList.add('hidden'); m.classList.remove('flex');
    document.body.style.overflow = '';
}

function handleUploadFileSelect(input) {
    if (input.files[0]) showUploadPreview(input.files[0]);
}

function handleUploadDrop(event) {
    event.preventDefault();
    document.getElementById('upload-dropzone').style.borderColor = '#bcc9c6';
    const file = event.dataTransfer.files[0];
    if (file) { document.getElementById('upload-file-input').files = event.dataTransfer.files; showUploadPreview(file); }
}

function showUploadPreview(file) {
    currentUploadFile = file;
    document.getElementById('upload-file-name').textContent = file.name;
    document.getElementById('upload-file-size').textContent = (file.size/1024).toFixed(1) + ' KB';
    document.getElementById('upload-dropzone').style.display = 'none';
    const prev = document.getElementById('upload-file-preview');
    prev.classList.remove('hidden'); prev.classList.add('flex');
}

function clearUploadFile() {
    currentUploadFile = null;
    document.getElementById('upload-file-input').value = '';
    const prev = document.getElementById('upload-file-preview');
    prev.classList.add('hidden'); prev.classList.remove('flex');
    document.getElementById('upload-dropzone').style.display = '';
}

function submitUploadTemplate() {
    if (!currentUploadFile) { alert('Pilih file template terlebih dahulu.'); return; }
    const btn = document.getElementById('upload-btn-text');
    btn.textContent = 'Menyimpan...';
    setTimeout(() => {
        closeUploadModal();
        btn.textContent = 'Simpan Template';
        alert('Template "' + currentUploadFile.name + '" berhasil diupload!\n(Demo — akan disimpan ke storage saat backend siap.)');
        currentUploadFile = null;
    }, 800);
}

document.getElementById('modal-upload-template').addEventListener('click', function(e) {
    if(e.target===this) closeUploadModal();
});
document.addEventListener('keydown', e => { if(e.key==='Escape') closeUploadModal(); });
</script>
@endpush

@endsection

