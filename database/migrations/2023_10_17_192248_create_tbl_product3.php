<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tbl_product3', function (Blueprint $table) {
            $table->Increments('product_id');
            $table->text('product_name');
            $table->text('product_theloai');
            $table->integer('product_status');
            $table->text('product_desc');
            $table->text('product_content');
            $table->string('product_price');
            $table->string('product_image');
            $table->text('product_tacgia');
            $table->unsignedBigInteger('brand_id'); // Thêm cột khóa ngoại
    
            $table->foreign('brand_id')->references('brand_id')->on('btl_brand'); // Xác định khóa ngoại
            $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_product3');
    }
};
