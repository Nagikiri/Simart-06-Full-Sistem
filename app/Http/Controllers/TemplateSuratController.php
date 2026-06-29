<?php

namespace App\Http\Controllers;

use App\Models\SuratTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TemplateSuratController extends Controller
{
    public function index()
    {
        $templates = SuratTemplate::orderBy('nama_surat')->get();

        return view('rt.template.index', compact('templates'));
    }

    public function create()
    {
        return view('rt.template.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'jenis_surat' => 'required|alpha_dash|unique:surat_templates,jenis_surat',
            'nama_surat'  => 'required|string|max:255',
            'content'     => 'nullable|string',
        ]);

        SuratTemplate::create([
            'jenis_surat' => $validated['jenis_surat'],
            'nama_surat'  => $validated['nama_surat'],
            'content'     => $validated['content'] ?? null,
            'file_path'   => null,
            'file_name'   => null,
        ]);

        return redirect()->route('template.index')
            ->with('success', 'Template baru berhasil disimpan.');
    }

    public function edit($id)
    {
        $template = SuratTemplate::findOrFail($id);

        return view('rt.template.edit', compact('template'));
    }

    public function update(Request $request, $id)
    {
        $template = SuratTemplate::findOrFail($id);

        $validated = $request->validate([
            'nama_surat' => 'required|string|max:255',
            'file_template' => 'nullable|file|mimes:pdf|max:10240',
            'content' => 'nullable|string',
        ]);

        $data = [
            'nama_surat' => $validated['nama_surat'],
            'content' => $validated['content'] ?? $template->content,
        ];

        if ($request->hasFile('file_template')) {
            if ($template->file_path) {
                Storage::disk('private')->delete($template->file_path);
            }
            $file = $request->file('file_template');
            $data['file_path'] = $file->store('templates/'.Str::slug($template->jenis_surat), 'private');
            $data['file_name'] = $file->getClientOriginalName();
        }

        $template->update($data);

        return redirect()->route('template.index')
            ->with('success', 'Template berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $template = SuratTemplate::findOrFail($id);

        if ($template->file_path) {
            Storage::disk('private')->delete($template->file_path);
        }

        $template->delete();

        return back()->with('success', 'Template berhasil dihapus.');
    }

    /**
     * Duplikat template yang sudah ada.
     */
    public function duplicate($id)
    {
        $original = SuratTemplate::findOrFail($id);

        $newJenis = $original->jenis_surat . '_copy_' . time();

        SuratTemplate::create([
            'jenis_surat' => $newJenis,
            'nama_surat'  => 'Salinan: ' . $original->nama_surat,
            'content'     => $original->content,
            'file_path'   => null,
            'file_name'   => null,
        ]);

        return redirect()->route('template.index')
            ->with('success', 'Template berhasil diduplikat! Klik "Edit" pada salinan baru untuk menyesuaikan isinya.');
    }

    /**
     * Tampilkan pratinjau HTML template di tab baru.
     */
    public function preview($id)
    {
        $template = SuratTemplate::findOrFail($id);
        
        $html = '<!DOCTYPE html><html><head><title>Preview - '.$template->nama_surat.'</title>';
        $html .= '<style>body { background:#f3f4f6; padding:20px; display:flex; justify-content:center; } .paper { background:#fff; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); } </style></head><body>';
        $html .= '<div class="paper">' . $template->content . '</div>';
        $html .= '</body></html>';

        return response($html);
    }

    /**
     * Unduh / tampilkan PDF template (warga & RT).
     */
    public function downloadFile($id)
    {
        $template = SuratTemplate::findOrFail($id);

        if (! $template->file_path || ! Storage::disk('private')->exists($template->file_path)) {
            abort(404, 'File template tidak ditemukan.');
        }

        $name = $template->file_name ?: ($template->jenis_surat.'.pdf');

        $path = Storage::disk('private')->path($template->file_path);
        
        if (request()->boolean('inline')) {
            $base64 = base64_encode(file_get_contents($path));
            $dataUri = 'data:application/pdf;base64,' . $base64;
            $html = '<!DOCTYPE html><html><head><title>Pratinjau PDF</title><style>body,html{margin:0;padding:0;height:100%;overflow:hidden;}</style></head><body>';
            $html .= '<object data="'.$dataUri.'#toolbar=0" type="application/pdf" width="100%" height="100%">';
            $html .= '<p style="text-align:center;margin-top:20px;font-family:sans-serif;">Browser Anda tidak mendukung pratinjau PDF. Silakan matikan Internet Download Manager (IDM) atau unduh file secara manual.</p>';
            $html .= '</object></body></html>';
            return response($html)->header('Content-Type', 'text/html');
        }

        return response()->file($path, [
            'Content-Type'        => 'application/pdf',
            'Content-Disposition' => 'inline; filename="'.$name.'"',
        ]);
    }
}
