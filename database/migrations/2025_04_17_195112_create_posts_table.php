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
        Schema::create('posts', function (Blueprint $table) {
            $table->id('id');
            $table->string('title', 255);
            $table->longText('abstract');
            $table->string('status', 255);
            $table->string('image', 255);
            $table->date('start_date');
            $table->date('end_date');
            $table->string('project_url', 255);
            $table->string('call_number', 255);
            $table->string('research_group', 255);
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
