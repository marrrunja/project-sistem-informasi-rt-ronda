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
        Schema::create('history_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("report_id");
            $table->string("title")->nullable(false);
            $table->string("description")->nullable(false);
            $table->date("tanggal_aksi")->nullable(false);
            $table->foreign("report_id")->references("id")->on("reports");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('history_reports');
    }
};
