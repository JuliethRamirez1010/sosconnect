<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('panic_alerts', function (Blueprint $table) {
            $table->id();
            $table->string('device_id', 80)->default('esp32-boton-1');
            $table->string('message')->default('Botón de pánico presionado');
            $table->timestamp('triggered_at')->useCurrent();
            $table->timestamps();
            $table->index('triggered_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('panic_alerts');
    }
};
