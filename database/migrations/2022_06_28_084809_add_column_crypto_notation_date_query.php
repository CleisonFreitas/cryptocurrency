<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('crypto_notation', function (Blueprint $table) {
            $table->string('query_date',10)->after('price_at_time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('crypto_notation', function (Blueprint $table) {
            $table->dropColumn('query_date');
        });
    }
};
