<?php
namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class User extends Authenticatable {
 use HasFactory, Notifiable;
 protected $fillable=['name','email','password','role','is_active'];
 protected $hidden=['password','remember_token','recovery_code_hash','recovery_document_secret'];
 protected function casts(): array { return ['email_verified_at'=>'datetime','password'=>'hashed','is_active'=>'boolean','recovery_code_expires_at'=>'datetime']; }
}
