<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIssueBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_issue_bills', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('draftbill_id')->unsigned()->index();
            $table->foreign('draftbill_id')->references('id')->on('tbl_draft_bills')->onUpdate('cascade')->onDelete('cascade');
            $table->string('bill_to')->nullable();
            $table->string('address')->nullable();
            $table->string('issue_bill_date')->nullable();
            $table->string('is_accepted')->default(null)->nullable();
            $table->string('is_printed')->default(null)->nullable();
            $table->string('display_order')->nullable();
            $table->string('remarks')->nullable();
            $table->enum('status',['active','in_active'])->nullable();
            $table->bigInteger('created_by')->unsigned()->index()->nullable();
            $table->bigInteger('last_updated_by')->unsigned()->index()->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('last_updated_by')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('tbl_issue_bills');
    }
}
