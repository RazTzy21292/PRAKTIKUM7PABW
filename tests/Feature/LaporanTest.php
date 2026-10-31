<?php

namespace Tests\Feature;

use App\Models\Laporan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class LaporanTest extends TestCase
{
    use RefreshDatabase;

    public function test_citizen_can_submit_a_report_with_a_photo(): void
    {
        Storage::fake('public');

        $response = $this->post(route('laporan.store'), [
            ...$this->validReportData(),
            'foto' => UploadedFile::fake()->create('banjir.jpg', 1, 'image/jpeg'),
        ]);

        $response->assertRedirect(route('laporan.konfirmasi'));
        $response->assertSessionHas('success', 'Laporan banjir berhasil dikirim.');

        $laporan = Laporan::firstOrFail();
        $this->assertSame('Menunggu', $laporan->status);
        Storage::disk('public')->assertExists($laporan->foto);
    }

    public function test_report_requires_a_supported_photo(): void
    {
        Storage::fake('public');

        $response = $this->from(route('laporan.create'))->post(route('laporan.store'), [
            ...$this->validReportData(),
            'foto' => UploadedFile::fake()->create('bukti.pdf', 100, 'application/pdf'),
        ]);

        $response->assertRedirect(route('laporan.create'));
        $response->assertSessionHasErrors('foto');
        $this->assertDatabaseCount('laporan', 0);
    }

    public function test_report_photo_cannot_exceed_two_megabytes(): void
    {
        Storage::fake('public');

        $response = $this->from(route('laporan.create'))->post(route('laporan.store'), [
            ...$this->validReportData(),
            'foto' => UploadedFile::fake()->create('banjir.jpg', 2049, 'image/jpeg'),
        ]);

        $response->assertRedirect(route('laporan.create'));
        $response->assertSessionHasErrors('foto');
        $this->assertDatabaseCount('laporan', 0);
    }

    public function test_report_management_requires_authentication(): void
    {
        $this->get(route('laporan.index'))->assertRedirect(route('login'));
    }

    public function test_public_form_and_petugas_management_pages_render(): void
    {
        Storage::fake('public');
        $laporan = Laporan::create([
            ...$this->validReportData(),
            'foto' => 'laporan/bukti.jpg',
        ]);

        $this->get(route('laporan.create'))->assertOk();

        $this->actingAs(User::factory()->create())
            ->get(route('laporan.index'))
            ->assertOk()
            ->assertSee('Warga Bandung');
        $this->get(route('laporan.show', $laporan))->assertOk();
        $this->get(route('laporan.edit', $laporan))->assertOk();
    }

    public function test_petugas_can_update_status_and_replace_report_photo(): void
    {
        Storage::fake('public');
        $fotoLama = UploadedFile::fake()->create('lama.jpg', 1, 'image/jpeg')->store('laporan', 'public');
        $laporan = Laporan::create([...$this->validReportData(), 'foto' => $fotoLama]);

        $response = $this->actingAs(User::factory()->create())
            ->put(route('laporan.update', $laporan), [
                ...$this->validReportData(),
                'status' => 'Diproses',
                'foto' => UploadedFile::fake()->create('baru.png', 1, 'image/png'),
            ]);

        $response->assertRedirect(route('laporan.show', $laporan));
        $response->assertSessionHas('success', 'Laporan berhasil diperbarui.');
        $this->assertSame('Diproses', $laporan->fresh()->status);
        Storage::disk('public')->assertMissing($fotoLama);
        Storage::disk('public')->assertExists($laporan->fresh()->foto);
    }

    public function test_petugas_can_delete_a_report_and_its_photo(): void
    {
        Storage::fake('public');
        $foto = UploadedFile::fake()->create('bukti.png', 1, 'image/png')->store('laporan', 'public');
        $laporan = Laporan::create([...$this->validReportData(), 'foto' => $foto]);

        $response = $this->actingAs(User::factory()->create())
            ->delete(route('laporan.destroy', $laporan));

        $response->assertRedirect(route('laporan.index'));
        $response->assertSessionHas('success', 'Laporan berhasil dihapus.');
        $this->assertDatabaseMissing('laporan', ['id' => $laporan->id]);
        Storage::disk('public')->assertMissing($foto);
    }

    private function validReportData(): array
    {
        return [
            'nama_pelapor' => 'Warga Bandung',
            'no_hp' => '081234567890',
            'lokasi' => 'Jalan Raya',
            'kecamatan' => 'Dayeuhkolot',
            'tinggi_air' => 80,
            'keterangan' => 'Air mulai masuk ke rumah warga.',
        ];
    }
}
