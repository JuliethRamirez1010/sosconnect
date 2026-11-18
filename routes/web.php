<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SecurityController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\PanicAlertController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\RoomController;
Route::post('/api/esp32/alerts',[PanicAlertController::class,'receive'])->name('esp32.alerts.receive');
Route::get('/',fn()=>redirect()->route('dashboard'));
Route::middleware('guest')->group(function(){
 Route::get('/login',[LoginController::class,'create'])->name('login'); Route::post('/login',[LoginController::class,'store']);
 Route::get('/register',[RegisterController::class,'create'])->name('register'); Route::post('/register',[RegisterController::class,'store']);
 Route::get('/forgot-password',[ForgotPasswordController::class,'create'])->name('password.request'); Route::post('/forgot-password',[ForgotPasswordController::class,'send'])->middleware('throttle:5,1')->name('password.email');
 Route::post('/forgot-password/code',[ForgotPasswordController::class,'requestCode'])->middleware('throttle:5,1')->name('recovery.code.request'); Route::get('/recovery-code',[ForgotPasswordController::class,'codeForm'])->name('recovery.code.form'); Route::post('/recovery-code',[ForgotPasswordController::class,'verifyCode'])->middleware('throttle:5,1')->name('recovery.code.verify');
 Route::post('/forgot-password/document',[ForgotPasswordController::class,'requestDocument'])->middleware('throttle:5,1')->name('recovery.document.request');
 Route::get('/recovery-document',[ForgotPasswordController::class,'documentForm'])->name('recovery.document.form'); Route::post('/recovery-document',[ForgotPasswordController::class,'verifyDocument'])->middleware('throttle:5,1')->name('recovery.document.verify');
 Route::get('/reset-password/{token}',[ResetPasswordController::class,'create'])->name('password.reset'); Route::post('/reset-password',[ResetPasswordController::class,'update'])->name('password.update');
 Route::get('/recovery-reset',[ResetPasswordController::class,'recoveryForm'])->name('password.recovery.form'); Route::post('/recovery-reset',[ResetPasswordController::class,'recoveryUpdate'])->name('password.recovery.update');
});
Route::middleware('auth')->group(function(){
 Route::get('/api/rooms', [RoomController::class, 'index'])->name('rooms.index');
 Route::post('/rooms', [RoomController::class, 'store'])->name('rooms.store');
 Route::get('/alerts/{panicAlert}/report', [PanicAlertController::class, 'report'])->name('alerts.report');
 Route::get('/dashboard',DashboardController::class)->name('dashboard'); Route::get('/api/alerts/latest',[PanicAlertController::class,'latest'])->name('alerts.latest'); Route::post('/api/alerts/{panicAlert}/attend',[PanicAlertController::class,'attend'])->name('alerts.attend'); Route::post('/api/alerts/{panicAlert}/complete',[PanicAlertController::class,'complete'])->name('alerts.complete'); Route::get('/api/patients',[PatientController::class,'index'])->name('patients.index'); Route::post('/patients',[PatientController::class,'store'])->name('patients.store'); Route::patch('/patients/{patient}',[PatientController::class,'update'])->name('patients.update'); Route::post('/logout',[LoginController::class,'destroy'])->name('logout');
 Route::get('/profile',[ProfileController::class,'edit'])->name('profile.edit'); Route::patch('/profile',[ProfileController::class,'update'])->name('profile.update');
 Route::get('/security',[SecurityController::class,'edit'])->name('security.edit'); Route::put('/security/password',[SecurityController::class,'password'])->name('security.password'); Route::post('/security/recovery-document',[SecurityController::class,'generateDocument'])->name('security.recovery-document');
 foreach(['settings'=>'Configuración','patients'=>'Pacientes','rooms'=>'Habitaciones','panic-buttons'=>'Botones de pánico','esp32'=>'ESP32'] as $path=>$title) Route::get('/'.$path,fn()=>view('placeholder',['title'=>$title,'message'=>'Próximamente. Esta sección está preparada para una etapa futura.']))->name(str_replace('-','.', $path));
});
Route::middleware(['auth','admin'])->prefix('admin')->name('admin.')->group(fn()=>Route::resource('users',AdminUserController::class));
