<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateNotesTable extends Migration {
    /**
     * @return void
     */
    public function up() {
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100)->unique();
            $table->text('body');
            $table->foreignId('user_id')->constrained()->onDelete('restrict');            
            $table->timestamps();
        });
    }

    /**
     * @return void
     */
    public function down() {
        Schema::dropIfExists('notes');
    }
}
