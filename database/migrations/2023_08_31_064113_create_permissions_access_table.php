<?php

use App\Models\access;
use App\Models\permissions;
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
        Schema::create('permissions_access', function (Blueprint $table) {
            $table->id();
            $table->foreignId(permissions::class)->constrained();
            $table->foreignId(access::class)->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permissions_access');
    }
};
