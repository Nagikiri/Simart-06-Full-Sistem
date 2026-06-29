@extends('layouts.landing')

@section('title', 'Kebijakan Privasi - SIMART-06')

@section('content')
<div class="pt-32 pb-24 bg-[#f7f9fb] min-h-screen">
    <div class="max-w-4xl mx-auto px-6 lg:px-8">
        <div class="bg-white rounded-[2rem] p-8 md:p-12 shadow-sm border border-gray-100">
            <h1 class="font-manrope font-bold text-3xl md:text-4xl text-[#191c1e] mb-4">Kebijakan Privasi</h1>
            <p class="text-sm text-[#6d7a77] mb-10 border-b border-gray-100 pb-6">Terakhir diperbarui: {{ date('d F Y') }}</p>

            <div class="space-y-8 text-[#3d4947] text-sm md:text-base leading-relaxed">
                
                <section>
                    <h2 class="font-manrope font-bold text-xl text-[#191c1e] mb-3">1. Pengantar</h2>
                    <p>Selamat datang di SIMART-06. Kami sangat menghargai privasi Anda dan berkomitmen untuk melindungi data pribadi yang Anda bagikan kepada kami. Kebijakan Privasi ini menjelaskan bagaimana kami mengumpulkan, menggunakan, menyimpan, dan melindungi informasi Anda saat menggunakan layanan administrasi digital RT 06.</p>
                </section>

                <section>
                    <h2 class="font-manrope font-bold text-xl text-[#191c1e] mb-3">2. Informasi yang Kami Kumpulkan</h2>
                    <p class="mb-2">Saat Anda menggunakan layanan kami, kami dapat mengumpulkan informasi berikut:</p>
                    <ul class="list-disc pl-5 space-y-2">
                        <li><strong>Data Identitas:</strong> Nama lengkap, Nomor Induk Kependudukan (NIK), Nomor Kartu Keluarga (KK), tempat dan tanggal lahir, serta jenis kelamin.</li>
                        <li><strong>Data Kontak:</strong> Alamat email, nomor telepon, dan alamat tempat tinggal.</li>
                        <li><strong>Data Pendukung:</strong> Informasi yang Anda isi saat mengajukan surat pengantar (misalnya: status pernikahan, data pekerjaan, dan dokumen pendukung lainnya).</li>
                    </ul>
                </section>

                <section>
                    <h2 class="font-manrope font-bold text-xl text-[#191c1e] mb-3">3. Penggunaan Informasi</h2>
                    <p class="mb-2">Data pribadi yang dikumpulkan akan digunakan secara eksklusif untuk:</p>
                    <ul class="list-disc pl-5 space-y-2">
                        <li>Memverifikasi identitas Anda sebagai warga sah RT 06.</li>
                        <li>Memproses pengajuan administrasi dan pembuatan surat pengantar/keterangan yang Anda ajukan.</li>
                        <li>Menghubungi Anda terkait status permohonan atau memberikan informasi/pengumuman penting dari lingkungan RT 06.</li>
                    </ul>
                </section>

                <section>
                    <h2 class="font-manrope font-bold text-xl text-[#191c1e] mb-3">4. Keamanan dan Penyimpanan Data</h2>
                    <p>Kami menerapkan langkah-langkah keamanan teknis dan administratif untuk melindungi data Anda dari akses, modifikasi, atau pengungkapan yang tidak sah. Data Anda disimpan secara aman di dalam server dan hanya dapat diakses oleh pihak yang berwenang (Ketua RT dan pengurus terkait) secara terbatas sesuai dengan kebutuhan verifikasi administrasi.</p>
                </section>

                <section>
                    <h2 class="font-manrope font-bold text-xl text-[#191c1e] mb-3">5. Hak Anda</h2>
                    <p>Sebagai pengguna, Anda memiliki hak untuk memperbarui atau memperbaiki informasi pribadi Anda kapan saja melalui halaman Pengaturan Akun. Jika Anda memerlukan bantuan lebih lanjut terkait data Anda, Anda dapat menghubungi Ketua RT atau admin sistem kami.</p>
                </section>

            </div>
        </div>
    </div>
</div>
@endsection
