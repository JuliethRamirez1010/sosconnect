<?php
namespace App\Http\Controllers;
use App\Mail\RecoveryDocumentMail;
use App\Services\RecoveryService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
class SecurityController extends Controller {
 public function edit(): View { return view('security.edit', ['user'=>request()->user()]); }
 public function password(Request $request): RedirectResponse { $data=$request->validate(['current_password'=>'required','password'=>'required|min:8|confirmed']); $user=$request->user(); if(!Hash::check($data['current_password'],$user->password)) return back()->withErrors(['current_password'=>'La contraseña actual no es correcta.']); $user->update(['password'=>$data['password']]); return back()->with('success','Contraseña actualizada.'); }
 public function generateDocument(RecoveryService $service): RedirectResponse {
  $user = request()->user();
  $contents = $service->createRecoveryDocument($user);
  Mail::to($user->email)->send(new RecoveryDocumentMail($contents));
  return back()->with('success', 'Se generó una nueva llave y se envió el archivo de recuperación a tu correo.');
 }
}
