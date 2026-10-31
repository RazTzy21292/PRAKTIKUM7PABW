<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('laporan', function (Blueprint $table) {
            $table->string('no_hp', 20)->nullable();
            $table->string('kecamatan')->nullable();
            $table->unsignedInteger('tinggi_air')->default(0);
            $table->text('keterangan')->nullable();
            $table->string('foto')->nullable();
            $table->string('status')->default('Menunggu');
        });

        DB::table('laporan')->update([
            'tinggi_air' => DB::raw('tinggi_genangan'),
        ]);

        Schema::table('laporan', function (Blueprint $table) {
            $table->dropColumn('tinggi_genangan');
            $table->date('tanggal_kejadian')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('laporan', function (Blueprint $table) {
            $table->integer('tinggi_genangan')->default(0);
        });

        DB::table('laporan')->update([
            'tinggi_genangan' => DB::raw('tinggi_air'),
        ]);

        Schema::table('laporan', function (Blueprint $table) {
            $table->dropColumn([
                'no_hp',
                'kecamatan',
                'tinggi_air',
                'keterangan',
                'foto',
                'status',
            ]);
        });
    }
};
