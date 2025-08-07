<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForeignKeys extends Migration
{
    public function up()
    {

        if (Schema::hasTable('Classrooms') && Schema::hasTable('Grades')) {
            Schema::table('Classrooms', function(Blueprint $table) {
                $table->foreign('Grade_id')->references('id')->on('grades')
                    ->onDelete('cascade');
            });
        }

        if (Schema::hasTable('sections') && Schema::hasTable('Grades')) {
            Schema::table('sections', function(Blueprint $table) {
                $table->foreign('Grade_id')->references('id')->on('grades')
                    ->onDelete('cascade');
            });
        }

        if (Schema::hasTable('sections') && Schema::hasTable('Classrooms')) {
            Schema::table('sections', function(Blueprint $table) {
                $table->foreign('classroom_id')->references('id')->on('Classrooms')
                    ->onDelete('cascade');
            });
        }
        Schema::table('my__parents', function(Blueprint $table) {
            $table->foreign('Nationality_Father_id')->references('id')->on('nationalitys');
            $table->foreign('Blood_Type_Father_id')->references('id')->on('type__bloods');
            $table->foreign('Religion_Father_id')->references('id')->on('religions');
            $table->foreign('Nationality_Mother_id')->references('id')->on('nationalitys');
            $table->foreign('Blood_Type_Mother_id')->references('id')->on('type__bloods');
            $table->foreign('Religion_Mother_id')->references('id')->on('religions');
        });

        Schema::table('parent_attachments', function(Blueprint $table) {
            $table->foreign('parent_id')->references('id')->on('my__parents');
        });
    }

    public function down()
    {
        Schema::table('Classrooms', function(Blueprint $table) {
			$table->dropForeign('Classrooms_Grade_id_foreign');
		});
        Schema::table('sections', function(Blueprint $table) {
            $table->dropForeign('sections_Grade_id_foreign');
        });
        Schema::table('sections', function(Blueprint $table) {
            $table->dropForeign('sections_Classroom_id_foreign');
        });
    }
}
