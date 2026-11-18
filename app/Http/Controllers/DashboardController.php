<?php
namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Room;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        $user = request()->user();

        return view('dashboard', [
            'user' => $user,
            'rooms' => Room::query()->orderBy('number')->get(),
            'patients' => Patient::query()->with('assignedNurse:id,name,role')->where('is_active', true)->orderBy('room')->orderBy('bed')->get(),
            'staff' => User::query()->where('is_active', true)->whereIn('role', ['doctor', 'nurse'])->orderBy('name')->get(['id', 'name', 'role']),
            'stats' => [
                'users' => User::count(),
                'doctors' => User::where('role', 'doctor')->count(),
                'nurses' => User::where('role', 'nurse')->count(),
                'active' => User::where('is_active', true)->count(),
            ],
        ]);
    }
}
