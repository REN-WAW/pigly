<?php

namespace App\Http\Controllers;

use App\Models\WeightLogs;
use App\Models\WeightTarget;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class WeightController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $query = $user->WeightLogs();

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $startDate = Carbon::parse($request->input('start_date'));
            $endDate = Carbon::parse($request->input('end_date'));
            $query->whereBetween('date', [$startDate, $endDate]);
        }
        
        $weightLogs = $query->orderBy('date', 'desc')->paginate(8);
        
        $weightTarget = $user->weightTarget()->first();
        $targetWeight = $weightTarget ? $weightTarget->target_weight : null;
        
        $currentWeightLog = $user->weightLogs()->latest('date')->first();
        $currentWeight = $currentWeightLog ? $currentWeightLog->weight : null;
        
        $weightDifference = null;
        if ($currentWeight !== null && $targetWeight !== null) {
            $weightDifference = $currentWeight - $targetWeight;
        }

        return view('weight', [
            'weightLogs' => $weightLogs,
            'targetWeight' => $targetWeight,
            'currentWeight' => $currentWeight,
            'weightDifference' => $weightDifference,
        ]);
    }
}
