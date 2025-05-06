<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForeignKeys extends Migration
{
    public function up()
    {
        // تأكد من وجود الجداول أولاً
        if (Schema::hasTable('Classrooms') && Schema::hasTable('Grades')) {
            Schema::table('Classrooms', function(Blueprint $table) {
                $table->foreign('Grade_id')->references('id')->on('grades') // تغيير إلى حروف صغيرة
                    ->onDelete('cascade');
            });
        }

        if (Schema::hasTable('sections') && Schema::hasTable('Grades')) {
            Schema::table('sections', function(Blueprint $table) {
                $table->foreign('Grade_id')->references('id')->on('grades') // تغيير إلى حروف صغيرة
                    ->onDelete('cascade');
            });
        }

        if (Schema::hasTable('sections') && Schema::hasTable('Classrooms')) {
            Schema::table('sections', function(Blueprint $table) {
                $table->foreign('classroom_id')->references('id')->on('Classrooms') // تغيير إلى المفرد
                    ->onDelete('cascade');
            });
        }
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
            $table->dropForeign('sections_Class_id_foreign');
        });
    }
}
