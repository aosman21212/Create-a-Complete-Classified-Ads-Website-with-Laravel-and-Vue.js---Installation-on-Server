<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('ads', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->decimal('price', 8, 2);
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // References users table
            $table->foreignId('category_id')->constrained()->onDelete('cascade'); // References categories table
            $table->foreignId('subcategory_id')->constrained()->onDelete('cascade'); // References subcategories table
            $table->foreignId('child_category_id')->constrained()->onDelete('cascade'); // References child_categories table
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('ads', function (Blueprint $table) {
            // Drop foreign key constraints
            $table->dropForeign(['user_id']);
            $table->dropForeign(['category_id']);
            $table->dropForeign(['subcategory_id']);
            $table->dropForeign(['child_category_id']);
        });

        // Drop the ads table
        Schema::dropIfExists('ads');
    }
}