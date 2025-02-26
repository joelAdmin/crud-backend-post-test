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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('post_id')->comment('Identificador único del post al que pertenece el comentario.'); 
            $table->unsignedBigInteger('user_id')->comment('Identificador único del usuario que crea el comentario.');
            $table->text('content')->comment('Contenido del comentario.');
            $table->boolean('status')->default(true)->comment('Estatus del comentario (true: activo, false: inactivo).');
            $table->softDeletes();
            $table->foreign('post_id')
                ->references('id')
                ->on('posts')
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->index('status');
            $table->index('post_id');
            $table->index('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
