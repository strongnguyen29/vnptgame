<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_id')->nullable()->default(0);
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('desc')->nullable();
            $table->string('type', 30)->index();
            $table->integer('sort')->default(0);
            $table->boolean('active')->default(true);
            $table->string('meta_title')->nullable();
            $table->string('meta_desc')->nullable();
            $table->string('language')->default('vi')->index();
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
        Schema::dropIfExists('categories');
    }
}
