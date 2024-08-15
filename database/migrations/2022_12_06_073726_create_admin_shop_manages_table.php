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
        Schema::create('admin_shop_manages', function (Blueprint $table) {
            $table->id();
            $table->string("store_name");
            $table->unsignedBigInteger("logo_id");
            $table->unsignedBigInteger("cover_photo_id");
            $table->unsignedBigInteger("country_id");
            $table->unsignedBigInteger("state_id")->nullable();
            $table->string("city")->nullable();
            $table->string("zipcode")->nullable();
            $table->text("address")->nullable();
            $table->string("location")->nullable();
            $table->string("number")->nullable();
            $table->string("email")->nullable();
            $table->string("facebook_url")->nullable();
            $table->timestamps();
            $table->foreign("logo_id")->references("id")->on("media_uploads");
            $table->foreign("cover_photo_id")->references("id")->on("media_uploads");
            $table->foreign("country_id")->references("id")->on("countries");
            $table->foreign("state_id")->references("id")->on("states");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_shop_manages');
    }
};
