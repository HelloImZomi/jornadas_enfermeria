<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('convocations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->date('inscription_start_date')->nullable();
            $table->date('inscription_end_date')->nullable();
            $table->dateTimeTz('start_time')->nullable();
            $table->dateTimeTz('end_time')->nullable();
            $table->unsignedInteger('presencial_limit')->nullable();
            $table->unsignedInteger('virtual_limit')->nullable();
            $table->string('zoom_url')->nullable();
            $table->string('whatsapp_url')->nullable();
            $table->string('logo_path')->nullable();
            $table->boolean('is_visible');

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
        Schema::dropIfExists('convocations');
    }
};
