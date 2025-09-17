<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// зроблено
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('item_tag', function (Blueprint $table) {
            $table->foreignId('item_id')->constrained('items')->onDelete('cascade'); // to group not to be deleted use "set null" not "cascade"
            $table->foreignId('tag_id')->constrained('tags')->onDelete('cascade'); // to group not to be deleted use "set null" not "cascade"
            $table->primary(['item_id', 'tag_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('item_tag');
        Schema::enableForeignKeyConstraints();
    }
};
