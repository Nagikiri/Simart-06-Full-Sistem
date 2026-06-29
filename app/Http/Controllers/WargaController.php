<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class WargaController extends Controller
{
    /**
     * Display warga profile
     */
    public function show(?Warga $warga = null)
    {
        if (!$warga || !$warga->exists) {
            $warga = Auth::user()->warga;
        }

        if (!$warga) {
            abort(404, 'Data warga tidak ditemukan.');
        }

        // Check if user authorized
        if (Auth::user()->warga->id_warga !== $warga->id_warga && Auth::user()->role !== 'rt') {
            abort(403, 'Unauthorized');
        }

        return view('warga.profile.index', compact('warga'));
    }

    /**
     * Show edit form
     */
    public function edit(?Warga $warga = null)
    {
        if (!$warga || !$warga->exists) {
            $warga = Auth::user()->warga;
        }

        if (!$warga) {
            abort(404, 'Data warga tidak ditemukan.');
        }

        // Check if user authorized
        if (Auth::user()->warga->id_warga !== $warga->id_warga) {
            abort(403, 'Unauthorized');
        }

        return view('warga.profile.edit', compact('warga'));
    }

    /**
     * Update warga profile
     */
    public function update(Request $request, ?Warga $warga = null)
    {
        if (!$warga || !$warga->exists) {
            $warga = Auth::user()->warga;
        }

        if (!$warga) {
            abort(404, 'Data warga tidak ditemukan.');
        }

        // Check if user authorized
        if (Auth::user()->warga->id_warga !== $warga->id_warga) {
            abort(403, 'Unauthorized');
        }

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'no_hp' => 'required|string',
            'email' => 'required|email|unique:warga,email,' . $warga->id_warga . ',id_warga',
        ]);

        $warga->update($validated);

        // Also update user table
        Auth::user()->update([
            'name' => $validated['nama'],
            'email' => $validated['email'],
        ]);

        return redirect()->route('warga.profile', $warga->id_warga)
            ->with('success', 'Profil berhasil diperbarui!');
    }

    /**
     * Show change password form
     */
    public function showChangePasswordForm(?Warga $warga = null)
    {
        if (!$warga || !$warga->exists) {
            $warga = Auth::user()->warga;
        }

        if (!$warga) {
            abort(404, 'Data warga tidak ditemukan.');
        }

        if (Auth::user()->warga->id_warga !== $warga->id_warga) {
            abort(403, 'Unauthorized');
        }

        return view('warga.profile.change-password', compact('warga'));
    }

    /**
     * Update password
     */
    public function updatePassword(Request $request, ?Warga $warga = null)
    {
        if (!$warga || !$warga->exists) {
            $warga = Auth::user()->warga;
        }

        if (!$warga) {
            abort(404, 'Data warga tidak ditemukan.');
        }

        if (Auth::user()->warga->id_warga !== $warga->id_warga) {
            abort(403, 'Unauthorized');
        }

        $validated = $request->validate([
            'current_password' => ['required', function ($attribute, $value, $fail) use ($warga) {
                if (!Hash::check($value, $warga->password)) {
                    $fail('Password saat ini tidak sesuai');
                }
            }],
            'password' => 'required|string|min:8|confirmed',
        ]);

        $hashedPassword = Hash::make($validated['password']);

        // Update tabel warga (manual hash — Warga model tidak pakai cast 'hashed')
        $warga->update(['password' => $hashedPassword]);

        // Update tabel users (kirim plain — User model pakai cast 'hashed', jadi auto-hash)
        Auth::user()->update(['password' => $validated['password']]);

        return redirect()->route('warga.profile')
            ->with('success', 'Password berhasil diubah!');
    }

    /**
     * Dashboard warga — loads real data from DB (no hardcodes).
     */
    public function getDashboard()
    {
        $warga = Auth::user()->warga;

        if (!$warga) {
            abort(404, 'Data warga tidak ditemukan.');
        }

        // Load semua pengajuan warga
        $allPengajuan = $warga->pengajuan()->orderBy('created_at', 'desc')->get();

        // Stats counters
        $stats = [
            'selesai'      => $allPengajuan->where('status', 'selesai')->count(),
            'dalam_antrian'=> $allPengajuan->whereIn('status', ['pending', 'diproses'])->count(),
            'ditolak'      => $allPengajuan->where('status', 'ditolak')->count(),
        ];

        // Pengajuan aktif (pending/diproses) untuk card kiri — maks 5
        $pengajuanAktif = $allPengajuan->whereIn('status', ['pending', 'diproses'])->take(5)->values();

        // Riwayat terakhir untuk tabel bawah — maks 5
        $riwayatTerakhir = $allPengajuan->take(5);

        // Aktivitas terkini: 3 entri dari pengajuan terbaru dengan status sebagai "event"
        $aktivitas = $allPengajuan->take(3)->map(function ($p) {
            $label = match ($p->status) {
                'selesai'  => 'Surat ' . $p->jenis_surat . ' Selesai',
                'ditolak'  => 'Pengajuan ' . $p->jenis_surat . ' Ditolak',
                'diproses' => 'Pengajuan ' . $p->jenis_surat . ' Diproses',
                default    => 'Pengajuan ' . $p->jenis_surat . ' Dikirim',
            };
            $color = match ($p->status) {
                'selesai'  => '#416538',
                'ditolak'  => '#ba1a1a',
                'diproses' => '#2b6485',
                default    => '#00685d',
            };
            return [
                'label'   => $label,
                'waktu'   => $p->updated_at->diffForHumans(),
                'color'   => $color,
                'catatan' => $p->catatan ?? null,
            ];
        });

        // Ambil pengumuman terbaru yang belum lewat 1 hari dari waktu selesai
        $pengumuman = \App\Models\Pengumuman::where('waktu_selesai', '>', now()->subDay())
                                            ->orderBy('created_at', 'desc')
                                            ->get();

        return view('dashboard.warga', compact(
            'stats', 'pengajuanAktif', 'riwayatTerakhir', 'aktivitas', 'warga', 'pengumuman'
        ));
    }

    /**
     * Get warga riwayat pengajuan — pass data as JSON for timeline JS
     */
    public function getRiwayat()
    {
        $warga   = Auth::user()->warga;
        $riwayat = $warga->pengajuan()->with('surat')->orderBy('created_at', 'desc')->get();

        // Build structured data for JS timeline (replaces all hardcode in view)
        $pengajuanJson = $riwayat->mapWithKeys(function ($p) {
            $status = $p->status;

            // Determine timeline steps based on status
            $steps = [];

            // Step 1: Diajukan — always completed
            $steps[] = [
                'label'  => 'Diajukan',
                'desc'   => 'Data telah diterima sistem',
                'time'   => $p->created_at->format('d M Y, H:i') . ' WIB',
                'status' => 'completed',
            ];

            // Step 2: Diverifikasi Admin
            if (in_array($status, ['diproses', 'selesai', 'ditolak'])) {
                $steps[] = [
                    'label'  => $status === 'ditolak' ? 'Ditolak Admin' : 'Diverifikasi Admin',
                    'desc'   => $status === 'ditolak'
                                ? ($p->catatan ?? 'Pengajuan tidak dapat diproses')
                                : 'Kelengkapan berkas terverifikasi',
                    'time'   => $p->updated_at->format('d M Y, H:i') . ' WIB',
                    'status' => $status === 'ditolak' ? 'rejected' : 'completed',
                ];
            } else {
                $steps[] = [
                    'label'  => 'Diverifikasi Admin',
                    'desc'   => 'Menunggu verifikasi berkas',
                    'time'   => null,
                    'status' => 'active',
                ];
            }

            // Step 3: Disetujui Ketua RT
            if ($status === 'selesai') {
                $steps[] = [
                    'label'  => 'Disetujui Ketua RT',
                    'desc'   => 'Ditandatangani oleh Ketua RT',
                    'time'   => $p->updated_at->format('d M Y, H:i') . ' WIB',
                    'status' => 'completed',
                ];
            } elseif ($status === 'ditolak') {
                $steps[] = [
                    'label'  => 'Disetujui Ketua RT',
                    'desc'   => 'Tidak dapat dilanjutkan',
                    'time'   => null,
                    'status' => 'pending',
                ];
            } elseif ($status === 'diproses') {
                $steps[] = [
                    'label'  => 'Disetujui Ketua RT',
                    'desc'   => 'Menunggu tanda tangan Ketua RT',
                    'time'   => null,
                    'status' => 'active',
                ];
            } else {
                $steps[] = [
                    'label'  => 'Disetujui Ketua RT',
                    'desc'   => 'Menunggu tahap sebelumnya',
                    'time'   => null,
                    'status' => 'pending',
                ];
            }

            // Step 4: Siap Diambil
            if ($status === 'selesai') {
                $steps[] = [
                    'label'  => 'Siap Diambil',
                    'desc'   => 'Dokumen dapat diunduh atau diambil',
                    'time'   => $p->updated_at->format('d M Y, H:i') . ' WIB',
                    'status' => 'completed',
                ];
            } else {
                $steps[] = [
                    'label'  => 'Siap Diambil',
                    'desc'   => $status === 'ditolak' ? 'Tidak dapat dilanjutkan' : 'Menunggu tahap sebelumnya',
                    'time'   => null,
                    'status' => 'pending',
                ];
            }

            // Progress calculation
            $progressMap = [
                'pending'  => ['value' => 10, 'text' => 'Menunggu verifikasi'],
                'diproses' => ['value' => 50, 'text' => '2 dari 4 tahap selesai'],
                'selesai'  => ['value' => 100, 'text' => '4 dari 4 tahap selesai'],
                'ditolak'  => ['value' => 25, 'text' => 'Ditolak pada tahap verifikasi'],
            ];
            $prog = $progressMap[$status] ?? ['value' => 10, 'text' => 'Menunggu'];

            // Download URL (jika selesai dan ada surat)
            $downloadUrl = null;
            if ($status === 'selesai' && $p->surat) {
                $downloadUrl = route('pengajuan.download', $p->id_pengajuan);
            }

            return [
                (string) $p->id_pengajuan => [
                    'id'           => '#RT06-' . $p->id_pengajuan,
                    'title'        => $p->jenis_surat,
                    'status'       => $status,
                    'date'         => $p->created_at->format('d M Y'),
                    'description'  => $p->catatan ?? 'Pengajuan ' . $p->jenis_surat . ' untuk keperluan administrasi.',
                    'progress'     => $prog['value'],
                    'progressText' => $prog['text'],
                    'steps'        => $steps,
                    'downloadUrl'  => $downloadUrl,
                ],
            ];
        });

        return view('warga.riwayat.index', compact('riwayat', 'pengajuanJson'));
    }

    /**
     * View all templates (surat templates from DB)
     */
    public function viewTemplates()
    {
        $templates = \App\Models\SuratTemplate::orderBy('created_at', 'desc')->get();
        return view('warga.template.index', compact('templates'));
    }
}

