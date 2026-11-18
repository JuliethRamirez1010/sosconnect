<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
 public function up(): void { Schema::table('users', function(Blueprint $t){ $t->string('recovery_code_hash')->nullable(); $t->timestamp('recovery_code_expires_at')->nullable(); $t->unsignedTinyInteger('recovery_code_attempts')->default(0); $t->text('recovery_document_secret')->nullable(); }); }
 public function down(): void { Schema::table('users', function(Blueprint $t){ $t->dropColumn(['recovery_code_hash','recovery_code_expires_at','recovery_code_attempts','recovery_document_secret']); }); }
};
