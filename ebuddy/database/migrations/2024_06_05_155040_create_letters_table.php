<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('letters', function (Blueprint $table) {
            $table->id();
            $table->string('no_letter')->nullable(false); // Ensuring no_letter is not nullable
            $table->date('date_out')->nullable(false); // Ensuring date_out is not nullable
            $table->string('attachment')->nullable(false); // Ensuring date_out is not nullable
            $table->string('subject')->nullable(false); // Ensuring subject is not nullable
            $table->string('destination')->nullable(false); // Corrected spelling to 'destination' and ensuring it's not nullable
            $table->string('destination_position')->nullable(true); // Corrected spelling to 'destination' and ensuring it's not nullable
            $table->text('content')->nullable(false); // Changed to text for more content capacity, ensuring it's not nullable
            $table->string('comment')->default('Tidak Ada Komentar');
            $table->string('wm_creator')->nullable(false);
            $table->string('wm_approver')->nullable(false)->default('');
            $table->string('status')->default('pending');
            $table->foreignId('user_id_creator')->constrained()->nullable(false); // Ensuring user_id_creator is not nullable
            $table->foreignId('user_id_approver')->constrained()->nullable(false); // Ensuring user_id_approver is not nullable
            $table->foreignId('template_id')->nullable(false); // Ensuring template_id is not nullable
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('letters');
    }
};
