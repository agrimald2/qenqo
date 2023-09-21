<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Schedule;
use App\Models\User;
use Log;

class ScheduleController extends Controller
{
    public function seeUserSchedule($id){
        $user = User::find($id);
        if($user->role_id != 2) {
            return Redirect::back();
        }
        $breadcrumbs = [["name" => "Horarios", "href" => ""], ["name" => $user->name, "href" => ""]];
        return Inertia::render('Schedules/UserSchedule', [
            'breadcrumbs' => $breadcrumbs,
            'user_id' => $id,
            'user' => $user,
        ]);    
    }

    public function getUserSchedules(Request $request){
        $user_id = $request->user_id;
        $schedules = Schedule::with('modality')->where('user_id', $user_id)->get();
        return response()->json($schedules);
    }
}
