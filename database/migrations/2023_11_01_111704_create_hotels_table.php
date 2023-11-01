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
        Schema::create('hotels', function (Blueprint $table) {
            $table->ulid('id');
            $table->primary('id');

            $table->string('name')->index();
            $table->decimal('latitude', $precision = 18, $scale = 15)
                ->nullable()
                ->index();
            $table->decimal('longitude', $precision = 18, $scale = 15)
                ->nullable()
                ->index();
            $table->decimal('price_per_night', $precision = 8, $scale = 2)->index();

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotels');
    }
};
