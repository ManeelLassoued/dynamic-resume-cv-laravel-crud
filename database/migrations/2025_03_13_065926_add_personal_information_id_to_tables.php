<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tables = [
            'contact_information',
            'education',
            'experiences',
            'interests',
            'languages',
            'projects',
            'skills'
        ];

        foreach ($tables as $table) {
            Schema::table($table, function (Blueprint $table) {
                $table->unsignedBigInteger('personal_information_id')->nullable()->after('user_id');
                $table->foreign('personal_information_id')->references('id')->on('personal_information')->onDelete('cascade');
            });
        }
    }

    public function down()
    {
        $tables = [
            'contact_information',
            'education',
            'experiences',
            'interests',
            'languages',
            'projects',
            'skills'
        ];

        foreach ($tables as $table) {
            Schema::table($table, function (Blueprint $table) {
                $table->dropForeign([$table . '_personal_information_id_foreign']);
                $table->dropColumn('personal_information_id');
            });
        }
    }
};
