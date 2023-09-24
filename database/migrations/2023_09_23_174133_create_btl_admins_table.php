<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('btl_admins', function (Blueprint $table) {
            $table->increments('admin_id'); // Use "increments" for auto-incrementing primary key
            $table->string('admin_email', 100);
            $table->string('admin_password'); // You probably want this to be a string for storing hashed passwords
            $table->string('admin_name'); // You probably want this to be a string for the admin's name
            $table->string('admin_phone'); // You probably want this to be a string for the admin's phone number

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('btl_admins');
    }
};
