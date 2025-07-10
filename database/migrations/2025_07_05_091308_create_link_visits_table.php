<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('link_visits', function (Blueprint $table) {
            $table->id('visit_id');
            $table->unsignedBigInteger('link_id');
            $table->string('ip_address');
            $table->integer('count_transition')->default(0);
            $table->dateTime('transition');

            $table->foreign('link_id')
                ->references('link_id')
                ->on('links')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('link_visits');
    }
};
