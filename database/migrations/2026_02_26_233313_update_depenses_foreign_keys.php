<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('dépense', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropForeign(['payer_id']);

            $table->renameColumn('category_id', 'catégorie_id');
            $table->renameColumn('payer_id', 'payeur_id');
        });

        Schema::table('dépense', function (Blueprint $table) {
            $table->foreign('catégorie_id')->references('id')->on('catégories')->onDelete('cascade');
            $table->foreign('payeur_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('dépenses', function (Blueprint $table) {
            $table->dropForeign(['catégorie_id']);
            $table->dropForeign(['payeur_id']);

            $table->renameColumn('catégorie_id', 'category_id');
            $table->renameColumn('payeur_id', 'payer_id');
        });

        Schema::table('dépenses', function (Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('payer_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
};