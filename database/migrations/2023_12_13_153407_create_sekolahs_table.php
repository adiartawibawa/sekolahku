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
        Schema::create('sekolah_forms', function (Blueprint $table) {
            $table->id();
            $table->char('code', 8)->unique();
            $table->string('name');
            $table->text('desc')->nullable();
            $table->timestamps();
        });

        Schema::create('sekolahs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('npsn', 8);
            $table->string('nama');
            $table->char('sekolah_forms_code', 8);
            $table->string('status', 10)->nullable();
            $table->text('alamat')->nullable();
            $table->char('desa_code', 10)->nullable();
            $table->text('meta')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('desa_code')
                ->references('code')
                ->on('desas');

            $table->foreign('sekolah_forms_code')
                ->references('code')
                ->on('sekolah_forms');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sekolah_forms');
        Schema::dropIfExists('sekolahs');
    }
};
