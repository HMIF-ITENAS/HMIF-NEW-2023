<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidateVotersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidate_voters', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('leader_candidate_id');
            $table->foreign('leader_candidate_id')->references('id')->on('leader_candidates')->onDelete('cascade');
            $table->unsignedBigInteger('voter_id');
            $table->foreign('voter_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('candidate_voters');
    }
}
