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
        Schema::create('counterparty_updates', function (Blueprint $table) {
            $table->id();
            $table->string('counterparty_id');
            $table->json('changes');
            $table->string('operator_id'); 
            $table->dateTime('update_time');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('counterparty_updates');
    }
};

