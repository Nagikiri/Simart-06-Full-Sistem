@extends('layouts.landing')

@section('title', 'Syarat & Ketentuan - SIMART-06')

@section('content')
<div class="pt-32 pb-24 bg-[#f7f9fb] min-h-screen">
    <div class="max-w-4xl mx-auto px-6 lg:px-8">
        <div class="bg-white rounded-[2rem] p-8 md:p-12 shadow-sm border border-gray-100">
            <h1 class="font-manrope font-bold text-3xl md:text-4xl text-[#191c1e] mb-4">Syarat & Ketentuan Layanan</h1>
            <p class="text-sm text-[#6d7a77] mb-10 border-b border-gray-100 pb-6">Terakhir diperbarui: {{ date('d F Y') }}</p>

            <div class="space-y-8 text-[#3d4947] text-sm md:text-base leading-relaxed">
                
                <section>
                    <h2 class="font-manrope font-bold text-xl text-[#191c1e] mb-3">1. Penerimaan Syarat</h2>
                    <p>Dengan mengakses dan menggunakan platform SIMART-06, Anda menyetujui untuk terikat oleh Syarat dan Ketentuan ini. Jika Anda tidak menyetujui sebagian atau seluruh syarat yang ditetapkan, Anda tidak diperkenankan untuk menggunakan layanan ini.</p>
                </section>

                <section>
                    <h2 class="font-manrope font-bold text-xl text-[#191c1e] mb-3">2. Penggunaan Layanan</h2>
                    <p class="mb-2">Platform ini diperuntukkan secara khusus bagi warga terdaftar di lingkungan RT 06. Anda setuju untuk:</p>
                    <ul class="list-disc pl-5 space-y-2">
                        <li>Memberikan data dan informasi yang valid, akurat, dan dapat dipertanggungjawabkan kebenarannya saat melakukan pengajuan administrasi.</li>
                        <li>Tidak menggunakan platform ini untuk tujuan ilegal, penipuan, atau pemalsuan dokumen.</li>
                        <li>Menjaga kerahasiaan kata sandi dan kredensial akun Anda, serta bertanggung jawab penuh atas seluruh aktivitas yang terjadi di bawah akun Anda.</li>
                    </ul>
                </section>

                <section>
                    <h2 class="font-manrope font-bold text-xl text-[#191c1e] mb-3">3. Proses Pengajuan dan Persetujuan</h2>
                    <p>Setiap pengajuan surat atau dokumen melalui SIMART-06 akan melalui proses verifikasi oleh Ketua RT. Pengurus RT berhak penuh untuk menyetujui, menunda, atau menolak permohonan apabila data yang diberikan dinilai tidak lengkap, tidak akurat, atau bertentangan dengan kebijakan lingkungan setempat tanpa kewajiban memberikan ganti rugi apa pun.</p>
                </section>

                <section>
                    <h2 class="font-manrope font-bold text-xl text-[#191c1e] mb-3">4. Hak Kekayaan Intelektual</h2>
                    <p>Seluruh desain, kode sumber, logo, dan konten yang ada pada platform SIMART-06 adalah hak milik pengembang dan tidak boleh disalin, didistribusikan, atau direproduksi tanpa izin tertulis sebelumnya.</p>
                </section>

                <section>
                    <h2 class="font-manrope font-bold text-xl text-[#191c1e] mb-3">5. Perubahan Ketentuan</h2>
                    <p>Kami berhak untuk memperbarui atau mengubah Syarat dan Ketentuan ini sewaktu-waktu. Perubahan akan berlaku segera setelah dipublikasikan di halaman ini. Anda dianjurkan untuk memeriksa halaman ini secara berkala untuk mengetahui pembaruan terbaru.</p>
                </section>

            </div>
        </div>
    </div>
</div>
@endsection
