<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('x_g_notifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vendor_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('model')->nullable();
            $table->unsignedBigInteger('model_id')->nullable();
            $table->text('message');
            $table->string('type');
            $table->boolean('is_read_admin')->default(false);
            $table->boolean('is_read_vendor')->default(false);
            $table->boolean('is_read_user')->default(false);
            $table->timestamps();
            $table->foreign("vendor_id")->references("id")->on("vendors");
            $table->foreign("user_id")->references("id")->on("users");
        });
    }
};
