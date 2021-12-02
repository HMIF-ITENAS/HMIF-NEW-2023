<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBorrowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('borrows', function (Blueprint $table) {
            $table->id();
            $table->string('invoice');
            $table->enum('status', ['Sedang Diajukan', 'Disetujui', 'Tidak Disetujui', 'Sudah Dikembalikan']);
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('description');
            $table->date('begin_date');
            $table->date('end_date');
            // $table->unsignedBigInteger('item_id');
            // $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
            // $table->integer('qty');
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
        Schema::dropIfExists('item_transactions');
    }
}
