<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToTblPurchases extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_purchases', function (Blueprint $table) {
            //
            $table->boolean('is_receivedbill')->default(null)->nullable()->after('order_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tbl_purchases', function (Blueprint $table) {
            //
            $table->dropColumn(['is_receivedbill']);

        });
    }
}
