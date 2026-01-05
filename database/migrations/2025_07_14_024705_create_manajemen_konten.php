<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sliders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->text('image_url')->nullable();
            $table->integer('urutan')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamp('created_at')->useCurrent();
        });

        Schema::create('fitur', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('icon')->nullable();
            $table->integer('urutan')->nullable();
            $table->string('type')->default('boolean');
            $table->boolean('is_active')->default(true);
            $table->timestamp('created_at')->useCurrent();
        });

        Schema::create('alasan', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('icon')->nullable();
            $table->integer('urutan')->nullable();
            $table->timestamp('created_at')->useCurrent();
        });

        Schema::create('testimoni', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nama')->nullable();
            $table->string('profesi')->nullable();
            $table->text('pesan')->nullable();
            $table->text('foto_url')->nullable();
            $table->integer('urutan')->nullable();
            $table->timestamp('created_at')->useCurrent();
        });

        Schema::create('paket', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nama_paket', 100);
            $table->decimal('harga', 15, 2);
            $table->decimal('harga_normal', 15, 2)->nullable();
            $table->integer('diskon_persen')->nullable();
            $table->text('deskripsi')->nullable();
            $table->integer('durasi_bulan')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_popular')->default(false);
            $table->timestamp('created_at')->useCurrent();
        });

        Schema::create('fitur_paket', function (Blueprint $table) {
            $table->uuid('id')->primary();
            // Foreign key to the 'paket' table
            $table->foreignUuid('id_paket')->nullable()->constrained('paket')->onDelete('cascade');
            // Relation to 'fitur' table 
            $table->foreignUuid('id_fitur')->nullable()->constrained('fitur')->onDelete('cascade');
            $table->string('value');
        });

        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('id_sekolah', 10);
            $table->string('nama_sekolah', 100);
            $table->string('email_sekolah', 100);
            $table->text('alamat');
            $table->string('nomor_telepon', 15);
            $table->text('link_sekolah')->nullable();
            $table->string('password');
            $table->enum('role', ['admin', 'customer'])->default('admin');
            $table->rememberToken();
            $table->timestamp('created_at')->useCurrent();
        });

        Schema::create('sekolah', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('id_user')->nullable()->constrained('users')->onDelete('cascade');
            $table->timestamp('created_at')->useCurrent();
        });

        Schema::create('panduan', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title')->nullable();
            $table->text('video_url')->nullable();
            $table->text('thumbnail_url')->nullable();
            $table->integer('urutan')->nullable();
            $table->timestamp('created_at')->useCurrent();
        });

        Schema::create('billing', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('id_user')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignUuid('id_paket')->nullable()->constrained('paket')->onDelete('set null');
            $table->decimal('jumlah', 15, 2)->nullable();
            $table->enum('status', ['pending', 'paid', 'expired'])->default('pending');
            $table->date('tanggal_bayar')->nullable();
            $table->timestamp('created_at')->useCurrent();
        });

        Schema::create('history_billing', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('id_billing')->nullable()->constrained('billing')->onDelete('cascade');
            $table->enum('status_sebelumnya', ['pending', 'paid', 'expired'])->nullable();
            $table->enum('status_baru', ['pending', 'paid', 'expired'])->nullable();
            $table->timestamp('tanggal')->useCurrent();
        });

        // Placeholder so that it doesn't crash
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sliders');
        Schema::dropIfExists('users');
        Schema::dropIfExists('fitur');
        Schema::dropIfExists('alasan');
        Schema::dropIfExists('testimoni');
    }
};
