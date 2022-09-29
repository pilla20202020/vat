<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToTblJobOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_job_orders', function (Blueprint $table) {
            //
            $table->boolean('is_billingadvice')->default(null)->nullable()->after('order_date');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tbl_job_orders', function (Blueprint $table) {
            //
            $table->dropColumn(['is_billingadvice']);
        });
    }
}
