<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ObjectDetection;
use Illuminate\Support\Facades\DB;

class ObjectDetectionController extends Controller
{
    // Store data sent by ESP8266
    public function store(Request $request)
    {
        $request->validate([
            'esp_device_id'   => 'required|integer',
            'object_detected' => 'required|boolean',
            'lamp_turned_on'  => 'required|boolean'
        ]);

        // Store data in the database
        ObjectDetection::create([
            'esp_device_id'   => $request->esp_device_id,
            'object_detected' => $request->object_detected,
            'lamp_turned_on'  => $request->lamp_turned_on,
            'created_at'      => now(), // Ensure correct timestamp
        ]);

        return response()->json(['message' => 'Data logged successfully'], 200);
    }

    // Fetch all logs (for API testing)
    public function index()
    {
        return response()->json(ObjectDetection::all());
    }

    // Fetch available years
    public function years()
    {
        $years = ObjectDetection::selectRaw("YEAR(created_at) as year")
            ->groupBy('year')
            ->orderBy('year', 'desc')
            ->pluck('year');

        return view('logs.years', compact('years'));
    }

    // Fetch available months for a selected year
    public function months($year)
    {
        $months = ObjectDetection::selectRaw("MONTH(created_at) as month, COUNT(*) as total_detections, SUM(lamp_turned_on) as total_lamp_on")
            ->whereYear('created_at', $year)
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->get();

        return view('logs.months', compact('months', 'year'));
    }

    // Fetch available dates for a selected month
    public function dates($year, $month)
    {
        $dates = ObjectDetection::selectRaw("DATE(created_at) as date, COUNT(*) as total_detections, SUM(lamp_turned_on) as total_lamp_on")
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();  
            

        return view('logs.dates', compact('dates', 'year', 'month'));
    }

    // Fetch ESP-wise data for a selected date
    public function espLogs($year, $month, $date)
    {
        $esps = ObjectDetection::selectRaw("esp_device_id, COUNT(*) as total_detections, SUM(lamp_turned_on) as total_lamp_on")
            ->whereDate('created_at', $date)
            ->groupBy('esp_device_id')
            ->orderBy('esp_device_id', 'asc')
            ->get();

        return view('logs.esps', compact('esps', 'year', 'month', 'date'));
    }

    // Fetch full logs for a selected ESP
    public function fullLogs($year, $month, $date, $esp_id)
    {
        $logs = ObjectDetection::whereDate('created_at', $date)
        ->where('esp_device_id', $esp_id)
        ->orderBy('created_at', 'asc')
        ->get();    

        return view('logs.full_logs', compact('logs', 'year', 'month', 'date', 'esp_id'));
    }
}
