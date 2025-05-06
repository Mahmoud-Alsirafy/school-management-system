<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('Sections', function (Blueprint $table) {
            $table->id();
            $table->string("Name_Section");
            $table->Integer("Status");
            $table->bigInteger("Grade_id")->unsigned();
            $table->bigInteger("Class_id")->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Sections');
    }
};
