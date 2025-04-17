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
            $table->string('title', 45);
            $table->longText('abstract');
            $table->string('status', 45);
            $table->string('image', 45);
            $table->date('start_date');
            $table->date('end_date');
            $table->string('project_url', 45);
            $table->string('call_number', 45);
            $table->string('research_group', 45);
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
