<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryRecruitmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_recruitment', function (Blueprint $table) {
            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete();
            $table->foreignId('recruitment_id')->constrained('recruitments')->cascadeOnDelete();
            $table->primary(['category_id', 'recruitment_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_recruitment');
    }
}
