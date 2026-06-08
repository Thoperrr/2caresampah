<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPickupOptionToWasteTransactionsTable extends Migration
{
    public function up()
    {
        Schema::table('waste_transactions', function (Blueprint $table) {
            $table->string('pickup_option')->default('antar');
        });
    }

    public function down()
    {
        Schema::table('waste_transactions', function (Blueprint $table) {
            $table->dropColumn('pickup_option');
        });
    }
}
