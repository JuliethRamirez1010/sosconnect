<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('patients', function (Blueprint $table) {
            $table->string('blood_type', 8)->nullable();
            $table->json('conditions')->nullable();
            $table->json('medications')->nullable();
            $table->string('emergency_contact_name')->nullable();
            $table->string('emergency_contact_phone', 40)->nullable();
            $table->foreignId('assigned_nurse_id')->nullable()->constrained('users')->nullOnDelete();
            $table->unique(['room', 'bed']);
        });

        Schema::table('panic_alerts', function (Blueprint $table) {
            $table->string('severity', 20)->nullable();
            $table->json('symptoms')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('panic_alerts', function (Blueprint $table) {
            $table->dropColumn(['severity', 'symptoms']);
        });

        Schema::table('patients', function (Blueprint $table) {
            $table->dropUnique(['room', 'bed']);
            $table->dropConstrainedForeignId('assigned_nurse_id');
            $table->dropColumn([
                'blood_type',
                'conditions',
                'medications',
                'emergency_contact_name',
                'emergency_contact_phone',
            ]);
        });
    }
};
