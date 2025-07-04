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
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->string("title")->unique();
            $table->string("slug");
            $table->foreignId("semester_id")->constrained()->onUpdate("cascade");
            $table->foreignId("category_id")->constrained()->onUpdate("cascade");
            $table->string("photo")->nullable();
            $table->string("document");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};
