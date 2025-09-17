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
        Schema::create('group_user', function (Blueprint $table) {
            $table->foreignId('group_id')->constrained('groups')->onDelete('cascade'); // to group not to be deleted use "set null" not "cascade"
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // to group not to be deleted use "set null" not "cascade"
            $table->primary(['group_id', 'user_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('group_user');
        Schema::enableForeignKeyConstraints();
    }
};
