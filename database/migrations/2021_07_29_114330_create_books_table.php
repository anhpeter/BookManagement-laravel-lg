<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->decimal('price');
            $table->integer('inventory_qty')->default(100);
            $table->decimal('discount');
            $table->foreignId('author_id')->constrained('users');
            $table->foreignId('category_id')->constrained();
            $table->string('status');
            $table->string('picture')->nullable();
            $table->text('short_description')->nullable();
            $table->longText('long_description')->nullable();
            $table->foreignId('created_by')->nullable();
            $table->foreignId('modified_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
