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
        Schema::create('overtimes', function (Blueprint $table) {
            $table->id();
            $table->date('start_date');
            $table->date('end_date');
            $table->longText("objective");
            $table->text('place');
            $table->longText('result');
            $table->string('status')->default('pending');
            $table->string('comment')->default('Tidak Ada Komentar');
            $table->foreignId('user_id_creator')->constrained();
            $table->foreignId('user_id_approver')->constrained();
            $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('overtimes');
    }
};
