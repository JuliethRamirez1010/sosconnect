<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('document_id', 80)->nullable()->unique();
            $table->unsignedTinyInteger('age')->nullable();
            $table->string('room', 40);
            $table->string('bed', 20);
            $table->string('diagnosis')->nullable();
            $table->date('admitted_at')->nullable();
            $table->string('device_id', 80)->nullable()->unique();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->index(['room', 'bed']);
        });

        Schema::table('panic_alerts', function (Blueprint $table) {
            $table->foreignId('patient_id')->nullable()->after('device_id')->constrained('patients')->nullOnDelete();
            $table->string('status', 20)->default('pending')->after('message')->index();
            $table->foreignId('attended_by')->nullable()->after('status')->constrained('users')->nullOnDelete();
            $table->timestamp('attended_at')->nullable();
            $table->timestamp('resolved_at')->nullable();
            $table->longText('report')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('panic_alerts', function (Blueprint $table) {
            $table->dropConstrainedForeignId('patient_id');
            $table->dropConstrainedForeignId('attended_by');
            $table->dropColumn(['status', 'attended_at', 'resolved_at', 'report']);
        });

        Schema::dropIfExists('patients');
    }
};
