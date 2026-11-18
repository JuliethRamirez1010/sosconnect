<?php
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
uses(RefreshDatabase::class);
it('allows a user to login', function(){ $u=User::factory()->create(['email'=>'test@example.com','password'=>'Password123!','is_active'=>true]); $this->post('/login',['email'=>$u->email,'password'=>'Password123!'])->assertRedirect('/dashboard'); });
it('prevents a non admin from opening user administration', function(){ $u=User::factory()->create(['role'=>'doctor']); $this->actingAs($u)->get('/admin/users')->assertForbidden(); });
