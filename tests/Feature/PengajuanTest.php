<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Warga;
use App\Models\Pengajuan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PengajuanTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $warga;

    protected function setUp(): void
    {
        parent::setUp();

        // Create test user and warga
        $this->warga = Warga::factory()->create([
            'nik' => '1234567890123456',
            'email' => 'test@example.com',
        ]);

        $this->user = User::factory()->create([
            'email' => 'test@example.com',
            'name' => 'Test User',
        ]);
    }

    public function test_authenticated_user_can_view_pengajuan_list()
    {
        $this->actingAs($this->user);

        $response = $this->get(route('pengajuan.index'));

        $response->assertStatus(200);
        $response->assertViewIs('pengajuan.index');
    }

    public function test_authenticated_user_can_create_pengajuan()
    {
        $this->actingAs($this->user);

        $response = $this->post(route('pengajuan.store'), [
            'jenis_surat' => 'surat_domisili',
        ]);

        $this->assertDatabaseHas('pengajuan', [
            'jenis_surat' => 'surat_domisili',
            'status' => 'pending',
        ]);
    }

    public function test_pengajuan_requires_jenis_surat()
    {
        $this->actingAs($this->user);

        $response = $this->post(route('pengajuan.store'), [
            'jenis_surat' => '',
        ]);

        $response->assertSessionHasErrors('jenis_surat');
    }

    public function test_user_can_upload_file_with_pengajuan()
    {
        $this->actingAs($this->user);

        $file = \Illuminate\Http\UploadedFile::fake()->create('document.pdf', 100, 'application/pdf');

        $response = $this->post(route('pengajuan.store'), [
            'jenis_surat' => 'surat_kematian',
            'file_dokumen' => $file,
        ]);

        $this->assertDatabaseHas('pengajuan', [
            'jenis_surat' => 'surat_kematian',
        ]);
    }

    public function test_file_size_validation()
    {
        $this->actingAs($this->user);

        // Create a fake file that's too large
        $file = \Illuminate\Http\UploadedFile::fake()->create('document.pdf', 6000, 'application/pdf');

        $response = $this->post(route('pengajuan.store'), [
            'jenis_surat' => 'surat_domisili',
            'file_dokumen' => $file,
        ]);

        $response->assertSessionHasErrors('file_dokumen');
    }
}
