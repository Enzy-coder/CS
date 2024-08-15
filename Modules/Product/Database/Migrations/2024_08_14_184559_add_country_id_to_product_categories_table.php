<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCountryIdToProductCategoriesTable extends Migration
{
    public function up()
    {
        Schema::table('product_categories', function (Blueprint $table) {
            $table->unsignedBigInteger('country_id')->after('id')->nullable();

            // If you want to add a foreign key constraint, uncomment the following line
            // $table->foreign('country_id')->references('id')->on('countries')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('product_categories', function (Blueprint $table) {
            $table->dropForeign(['country_id']); // Drop foreign key if it exists
            $table->dropColumn('country_id');
        });
    }
}
