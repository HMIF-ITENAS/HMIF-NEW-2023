<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeetingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meetings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('detail');
            $table->unsignedBigInteger('meeting_category_id');
            $table->foreign('meeting_category_id')->references('id')->on('meeting_categories')->onDelete('cascade');
            $table->date('begin_at');
            $table->time('start_meet_at');
            $table->time('end_meet_at');
            $table->time('start_presence');
            $table->time('end_presence');
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
        Schema::dropIfExists('meetings');
    }
}
