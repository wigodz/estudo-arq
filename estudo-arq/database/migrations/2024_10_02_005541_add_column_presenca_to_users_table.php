<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('presenca')->nullable()->default(null);
            $table->boolean('convidado')->nullable()->default(null);
            $table->string('telefone', 20)->unique();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('presenca');
            $table->dropColumn('convidado');
            $table->dropColumn('telefone');
        });
    }
};
