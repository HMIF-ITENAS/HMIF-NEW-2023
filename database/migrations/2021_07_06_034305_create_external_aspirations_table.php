<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExternalAspirationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('external_aspirations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('from');
            $table->string('title');
            $table->text('content');
            $table->enum('status', ['alumni', 'public', 'dosen']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('external_aspirations');
    }
}
