<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Models\SuratTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PengajuanController extends Controller
{
    public function index()
    {
        $templates = SuratTemplate::orderBy('nama_surat')->get();
        return view('pengajuan.index', compact('templates'));
    }

    public function create(Request $request)
    {
        $templateId = $request->query('template');
        if (!$templateId) {
            return redirect()->route('pengajuan.index')->withErrors('Silakan pilih jenis surat terlebih dahulu.');
        }

        $template = SuratTemplate::findOrFail($templateId);
        return view('pengajuan.create', compact('template'));
    }

    public function getTemplateContent($id)
    {
        $template = SuratTemplate::findOrFail($id);

        return response()->json([
            'id' => $template->id,
            'jenis_surat' => $template->jenis_surat,
            'nama_surat' => $template->nama_surat,
            'content' => $template->content,
        ]);
    }

    public function templatePdf($id)
    {
        $template = SuratTemplate::findOrFail($id);

        if (! $template->file_path || ! Storage::disk('private')->exists($template->file_path)) {
            abort(404);
        }

        return Storage::disk('private')->response($template->file_path, null, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline',
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_template' => 'required|exists:surat_templates,id',
        ]);

        $warga = Auth::user()->warga;
        if (! $warga) {
            return back()->withErrors('Data warga tidak ditemukan. Hubungi admin RT.');
        }

        $template = SuratTemplate::findOrFail($validated['id_template']);

        // Collect all dynamic form inputs (exclude Laravel system fields & id_template)
        $exclude = ['_token', '_method', 'id_template', 'konten_surat', '_html_final'];
        $rawData = collect($request->except($exclude))
            ->filter(fn($v) => $v !== null && $v !== '')
            ->toArray();

        $dataTambahan = [];
        // Save the exact final HTML from the browser if provided
        if ($request->has('_html_final')) {
            $dataTambahan['_html_final'] = $request->input('_html_final');
        }

        $lines = [];
        foreach ($rawData as $key => $value) {
            // Remove 'field_' prefix if it exists to avoid 'field_field_' double prefix later
            $cleanKey = str_starts_with($key, 'field_') ? substr($key, 6) : $key;
            $dataTambahan[$cleanKey] = $value;
            
            $label = ucwords(str_replace('_', ' ', $cleanKey));
            $lines[] = "{$label}: {$value}";
        }
        $kontenSurat = implode("\n", $lines);

        Pengajuan::create([
            'id_warga'         => $warga->id_warga,
            'id_template'      => $template->id,
            'jenis_surat'      => $template->nama_surat,
            'konten_surat'     => $kontenSurat,
            'tanggal_pengajuan'=> now()->toDateString(),
            'status'           => 'pending',
            'file_dokumen'     => null,
            'data_tambahan'    => $dataTambahan,
        ]);

        return redirect()->route('warga.riwayat')
            ->with('success', 'Pengajuan surat berhasil dikirim ke RT untuk diverifikasi.');
    }

    public function show(Pengajuan $pengajuan)
    {
        if (Auth::user()->role !== 'rt' && Auth::user()->warga->id_warga !== $pengajuan->id_warga) {
            abort(403, 'Unauthorized');
        }

        $pengajuan->load(['warga', 'template']);

        return view('pengajuan.show', compact('pengajuan'));
    }

    public function edit(Pengajuan $pengajuan)
    {
        if (Auth::user()->warga->id_warga !== $pengajuan->id_warga) {
            abort(403, 'Unauthorized');
        }

        if ($pengajuan->status !== 'pending') {
            return redirect()->route('pengajuan.show', $pengajuan)
                ->withErrors('Pengajuan yang sudah diproses tidak dapat diedit.');
        }

        $templates = SuratTemplate::whereNotNull('file_path')->orderBy('nama_surat')->get();

        return view('pengajuan.edit', compact('pengajuan', 'templates'));
    }

    public function update(Request $request, Pengajuan $pengajuan)
    {
        if (Auth::user()->warga->id_warga !== $pengajuan->id_warga) {
            abort(403, 'Unauthorized');
        }

        if ($pengajuan->status !== 'pending') {
            return back()->withErrors('Pengajuan tidak dapat diubah.');
        }

        $validated = $request->validate([
            'jenis_surat' => 'required|string',
            'id_template' => 'required|exists:surat_templates,id',
            'file_pdf' => 'nullable|file|mimes:pdf|max:15360',
        ]);

        $data = [
            'jenis_surat' => $validated['jenis_surat'],
            'id_template' => $validated['id_template'],
        ];

        if ($request->hasFile('file_pdf')) {
            if ($pengajuan->file_dokumen) {
                Storage::disk('private')->delete($pengajuan->file_dokumen);
            }
            $warga = Auth::user()->warga;
            $data['file_dokumen'] = $request->file('file_pdf')->store(
                "pengajuan/{$warga->id_warga}/".now()->format('Ymd'),
                'private'
            );
        }

        $pengajuan->update($data);

        return redirect()->route('pengajuan.index')
            ->with('success', 'Pengajuan berhasil diperbarui.');
    }

    public function destroy(Pengajuan $pengajuan)
    {
        if (Auth::user()->warga->id_warga !== $pengajuan->id_warga) {
            abort(403, 'Unauthorized');
        }

        if ($pengajuan->file_dokumen) {
            Storage::disk('private')->delete($pengajuan->file_dokumen);
        }

        $pengajuan->delete();

        return redirect()->route('pengajuan.index')
            ->with('success', 'Pengajuan berhasil dihapus.');
    }

    public function downloadFile(Pengajuan $pengajuan)
    {
        if (Auth::user()->role !== 'rt' && Auth::user()->warga->id_warga !== $pengajuan->id_warga) {
            abort(403, 'Unauthorized');
        }

        // Get file path either from related Surat (final approved) or Warga upload (draft)
        $surat = $pengajuan->surat;
        $filePath = $surat ? $surat->file_surat : $pengajuan->file_dokumen;

        if (! $filePath || ! Storage::disk('private')->exists($filePath)) {
            return back()->withErrors('File tidak ditemukan');
        }

        $extension = pathinfo($filePath, PATHINFO_EXTENSION);
        $contentType = $extension === 'html' ? 'text/html' : 'application/pdf';
        $nomor = $surat ? str_replace('/', '_', $surat->nomor_surat) : $pengajuan->id_pengajuan;
        $name = 'Pengajuan_'.$pengajuan->jenis_surat.'_'.$nomor.'.'.$extension;

        $path = Storage::disk('private')->path($filePath);

        if (request()->boolean('inline')) {
            if ($extension === 'html') {
                return response()->file($path, [
                    'Content-Type' => 'text/html',
                    'Content-Disposition' => 'inline; filename="'.$name.'"',
                ]);
            } else {
                $base64 = base64_encode(file_get_contents($path));
                $dataUri = 'data:application/pdf;base64,' . $base64;
                $html = '<!DOCTYPE html><html><head><title>Pratinjau Surat</title><style>body,html{margin:0;padding:0;height:100%;overflow:hidden;}</style></head><body>';
                $html .= '<object data="'.$dataUri.'#toolbar=0" type="application/pdf" width="100%" height="100%">';
                $html .= '<p style="text-align:center;margin-top:20px;font-family:sans-serif;">Browser Anda tidak mendukung pratinjau PDF. Silakan matikan Internet Download Manager (IDM) atau unduh file secara manual.</p>';
                $html .= '</object></body></html>';
                return response($html)->header('Content-Type', 'text/html');
            }
        }

        return response()->download($path, $name);
    }
}
