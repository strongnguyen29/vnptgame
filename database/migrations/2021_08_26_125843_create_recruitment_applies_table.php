<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecruitmentAppliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recruitment_applies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recruitment_id');
            $table->string('full_name');
            $table->string('email');
            $table->string('phone');
            $table->string('position')->nullable();
            $table->string('file_cv')->nullable();
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
        Schema::dropIfExists('recruitment_applies');
    }
}
