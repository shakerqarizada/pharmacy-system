<?php

namespace App\Http\Controllers;

use App\Models\TemperatureLog;
use Illuminate\Http\Request;

class TemperatureController extends Controller
{
    //
    public function store(Request $request)
    {
        $request->validate([
            'temperature' => 'required|numeric|between:-50,100',
            'humidity' => 'required|numeric|between:0,100',
        ]);

        $temperature = $request->temperature;
        $humidity = $request->humidity;
        
        // Determine status based on temperature thresholds
        $status = 'Normal';
        $alarm = false;
        
        if ($temperature > 25 || $temperature < 15) {
            $status = 'Warning';
            $alarm = true;
        }
        
        if ($temperature > 30 || $temperature < 10) {
            $status = 'Critical';
            $alarm = true;
        }

        TemperatureLog::create([
            'temperature' => $temperature,
            'humidity' => $humidity,
            'status' => $status,
            'alarm' => $alarm,
        ]);

        return redirect()->back()->with('success', 'Temperature logged successfully.');
    }

    public function index()
    {
        $recentLogs = TemperatureLog::latest()->take(10)->get();
        $latestLog = TemperatureLog::latest()->first();
        $alarmCount = TemperatureLog::where('alarm', true)->where('created_at', '>=', now()->subHours(24))->count();
        
        return view('backend.temperature.index', compact('recentLogs', 'latestLog', 'alarmCount'));
    }
}
