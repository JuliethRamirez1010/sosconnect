<?php
namespace Database\Seeders;
use App\Models\User;use Illuminate\Database\Seeder;
class DatabaseSeeder extends Seeder {public function run():void{foreach([['admin@example.com','Admin12345!','admin','Administrador'],['doctor@example.com','Doctor12345!','doctor','Doctor de Prueba'],['enfermero@example.com','Enfermero12345!','nurse','Enfermero de Prueba']] as [$email,$password,$role,$name]) User::updateOrCreate(['email'=>$email],['name'=>$name,'password'=>$password,'role'=>$role,'is_active'=>true]);}}
