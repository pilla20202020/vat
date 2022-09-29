<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToTblBillingAdvice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_billing_advice', function (Blueprint $table) {
            //
            $table->string('is_accepted')->default(null)->nullable()->after('billing_advice_date');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tbl_billing_advice', function (Blueprint $table) {
            //
            $table->dropColumn(['is_accepted']);

        });
    }
}
