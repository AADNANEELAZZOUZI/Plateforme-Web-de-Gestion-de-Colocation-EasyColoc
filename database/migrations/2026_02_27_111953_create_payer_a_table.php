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
        Schema::create('payer_a', function (Blueprint $table) {
            $table->id();
            $table->foreignId('de_user_id')->constrained('users');
            $table->foreignId('a_user_id')->constrained('users');
            $table->foreignId('dépense_id')->constrained('dépenses')->onDelete('cascade');
            $table->decimal('montant', 10, 2);
            $table->enum('status', ['en_attente', 'payé'])->default('en_attente');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payer_a');
    }
};
