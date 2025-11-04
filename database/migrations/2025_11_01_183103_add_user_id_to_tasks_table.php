<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration
    {
        public function up(): void
        {
            Schema::table('tasks', function (Blueprint $table) {
                // Adiciona a coluna user_id e a chave estrangeira
                // O método constrained() garante que só IDs válidos de 'users' podem ser inseridos
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
            });
        }

        public function down(): void
        {
            Schema::table('tasks', function (Blueprint $table) {
                // Remove a chave estrangeira primeiro
                $table->dropForeign(['user_id']);
                // Remove a coluna user_id
                $table->dropColumn('user_id');
            });
        }
    };
    
