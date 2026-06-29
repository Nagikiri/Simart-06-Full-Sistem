<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Models\Pengajuan;
use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PengajuanApiController extends ApiController
{
    /**
     * Get all pengajuan (with filters)
     */
    public function index(Request $request)
    {
        $query = Pengajuan::with('warga');

        // Filter by status
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        // Filter by date range
        if ($request->has('from_date') && $request->has('to_date')) {
            $query->whereBetween('tanggal_pengajuan', [
                $request->from_date,
                $request->to_date,
            ]);
        }

        // Filter by jenis surat
        if ($request->has('jenis_surat')) {
            $query->where('jenis_surat', $request->jenis_surat);
        }

        // Pagination
        $limit = $request->get('limit', 15);
        $pengajuan = $query->paginate($limit);

        return $this->response($pengajuan, 'Data pengajuan berhasil diambil');
    }

    /**
     * Get detail pengajuan
     */
    public function show($id)
    {
        $pengajuan = Pengajuan::with('warga', 'surat')->find($id);

        if (!$pengajuan) {
            return $this->errorResponse('Pengajuan tidak ditemukan', 404);
        }

        return $this->response($pengajuan, 'Detail pengajuan');
    }

    /**
     * Create pengajuan
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'jenis_surat' => 'required|in:surat_domisili,surat_kematian,surat_kelahiran,surat_belum_menikah,surat_nikah,surat_cerai',
            'file_dokumen' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        $warga = Auth::user()->warga;
        if (!$warga) {
            return $this->errorResponse('Data warga tidak ditemukan', 404);
        }

        // Handle file upload
        if ($request->hasFile('file_dokumen')) {
            $file = $request->file('file_dokumen');
            $path = $file->store("pengajuan/{$warga->id_warga}", 'private');
            $validated['file_dokumen'] = $path;
        }

        $pengajuan = Pengajuan::create([
            'id_warga' => $warga->id_warga,
            'jenis_surat' => $validated['jenis_surat'],
            'tanggal_pengajuan' => now()->toDateString(),
            'status' => 'pending',
            'file_dokumen' => $validated['file_dokumen'] ?? null,
        ]);

        return $this->response($pengajuan, 'Pengajuan berhasil dibuat', 201);
    }

    /**
     * Update pengajuan
     */
    public function update(Request $request, $id)
    {
        $pengajuan = Pengajuan::find($id);

        if (!$pengajuan) {
            return $this->errorResponse('Pengajuan tidak ditemukan', 404);
        }

        // Check authorization
        if (Auth::user()->warga->id_warga !== $pengajuan->id_warga) {
            return $this->errorResponse('Tidak diizinkan', 403);
        }

        $validated = $request->validate([
            'jenis_surat' => 'required|in:surat_domisili,surat_kematian,surat_kelahiran,surat_belum_menikah,surat_nikah,surat_cerai',
            'file_dokumen' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        // Handle file upload
        if ($request->hasFile('file_dokumen')) {
            if ($pengajuan->file_dokumen) {
                Storage::disk('private')->delete($pengajuan->file_dokumen);
            }

            $file = $request->file('file_dokumen');
            $path = $file->store("pengajuan/{$pengajuan->id_warga}", 'private');
            $validated['file_dokumen'] = $path;
        }

        $pengajuan->update($validated);

        return $this->response($pengajuan, 'Pengajuan berhasil diperbarui');
    }

    /**
     * Delete pengajuan
     */
    public function destroy($id)
    {
        $pengajuan = Pengajuan::find($id);

        if (!$pengajuan) {
            return $this->errorResponse('Pengajuan tidak ditemukan', 404);
        }

        // Check authorization
        if (Auth::user()->warga->id_warga !== $pengajuan->id_warga) {
            return $this->errorResponse('Tidak diizinkan', 403);
        }

        // Delete file if exists
        if ($pengajuan->file_dokumen) {
            Storage::disk('private')->delete($pengajuan->file_dokumen);
        }

        $pengajuan->delete();

        return $this->response(null, 'Pengajuan berhasil dihapus');
    }

    /**
     * Get statistics
     */
    public function statistics()
    {
        $total = Pengajuan::count();
        $pending = Pengajuan::where('status', 'pending')->count();
        $diproses = Pengajuan::where('status', 'diproses')->count();
        $selesai = Pengajuan::where('status', 'selesai')->count();
        $ditolak = Pengajuan::where('status', 'ditolak')->count();

        return $this->response([
            'total' => $total,
            'pending' => $pending,
            'diproses' => $diproses,
            'selesai' => $selesai,
            'ditolak' => $ditolak,
        ], 'Statistik pengajuan');
    }
}
