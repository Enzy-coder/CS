<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddContinentIdToCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('countries', function (Blueprint $table) {
            $table->unsignedBigInteger('continent_id')->nullable()->after('status');

            // Set up the foreign key constraint
            $table->foreign('continent_id')
                  ->references('id')
                  ->on('continents')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('countries', function (Blueprint $table) {
            // Drop the foreign key constraint
            $table->dropForeign(['continent_id']);
            // Drop the column
            $table->dropColumn('continent_id');
        });
    }
}
