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
        Schema::table('inscriptions', function (Blueprint $table) {
            $table
                ->foreign('convocation_id')
                ->references('id')
                ->on('convocations')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('school_id')
                ->references('id')
                ->on('schools')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inscriptions', function (Blueprint $table) {
            $table->dropForeign(['convocation_id']);
            $table->dropForeign(['school_id']);
        });
    }
};
