<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceiveBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_receive_bills', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('vendor_id')->unsigned()->index()->nullable();
            $table->bigInteger('purchaseorder_id')->unsigned()->index()->nullable();
            $table->string('invoice')->unique();
            $table->string('date')->nullable();
            $table->string('display_order')->nullable();
            $table->string('remarks')->nullable();
            $table->enum('status',['active','in_active'])->nullable();
            $table->bigInteger('created_by')->unsigned()->index()->nullable();
            $table->bigInteger('last_updated_by')->unsigned()->index()->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('last_updated_by')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('vendor_id')->references('id')->on('tbl_vendors')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('purchaseorder_id')->references('id')->on('tbl_purchases')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('tbl_receive_bills');
    }
}