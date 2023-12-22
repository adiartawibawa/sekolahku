<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('guru_tendiks', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('nama');
            $table->string('nik');
            $table->string('nuptk')->nullable();
            $table->string('nip')->nullable();
            $table->char('gender', 1);
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('no_telp');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('tugas_gtks', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('guru_tendik_id')->references('id')->on('guru_tendiks')->onDelete('cascade');
            $table->foreignUuid('sekolah_id')->references('id')->on('sekolahs');
            $table->char('status_tugas', 10)->nullable();
            $table->string('mapel_ajar', 100)->nullable();
            $table->char('jam_mengajar', 2)->nullable();
            $table->year('tahun');
            $table->char('semester', 1);
            $table->timestamps();
        });

        Schema::create('kepegawaian_gtks', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('guru_tendik_id')->references('id')->on('guru_tendiks')->onDelete('cascade');
            $table->string('sk_cpns')->nullable();
            $table->date('tmt_cpns')->nullable();
            $table->string('sk_pengangkatan')->nullable();
            $table->date('tmt_pengangkatan')->nullable();
            $table->string('jenis_ptk')->nullable();
            $table->string('pendidikan_terakhir')->nullable();
            $table->string('bidang_studi_pendidikan')->nullable();
            $table->string('bidang_studi_sertifikasi')->nullable();
            $table->string('status_kepegawaian')->nullable();
            // $table->enum('jenis_ptk', ['guru_bk', 'mapel', 'kelas', 'tik', 'kepala_sekolah', 'pesuruh_office_boy', 'tenaga_administrasi']);
            // $table->enum('pendidikan', ['D1', 'D3', 'paket_b', 'paket_c', 'S1', 'S2', 'S3', 'SD_Sederajat', 'SMP_Sederajat', 'SMA_Sederajat']);
            // $table->enum('status_kepegawaian', ['CPNS', 'guru_honor_sekolah', 'sekolah_honor_1', 'sekolah_honor_tk_i', 'PNS', 'PNS_depag', 'PNS_diperbantukan', 'PPPK', 'tenaga_honor_sekolah']);
            $table->string('pangkat_gol_terakhir')->nullable();
            $table->date('tmt_pangkat_terakhir')->nullable();
            $table->integer('masa_kerja_tahun')->nullable();
            $table->integer('masa_kerja_bulan')->nullable();
            $table->boolean('is_kepsek')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tugas_gtks');
        Schema::dropIfExists('kepegawaian_gtks');
        Schema::dropIfExists('guru_tendiks');
    }
};
