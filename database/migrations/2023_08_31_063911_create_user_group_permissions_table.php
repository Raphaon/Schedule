<?php

use App\Models\permissions;
use App\Models\userGroup;
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
        Schema::create('user_group_permissions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(userGroup::class)->constrained();
            $table->foreignIdFor(permissions::class)->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_group_permissions');
    }
};
