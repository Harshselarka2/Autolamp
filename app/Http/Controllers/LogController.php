<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ObjectDetection;

class LogController extends Controller
{
    // 📌 Show available years
    public function showYears() {
        $years = ObjectDetection::selectRaw('YEAR(created_at) as year')
            ->groupBy('year')
            ->orderByDesc('year')
            ->get();

        return view('logs.years', compact('years'));
    }

    // 📌 Show months with object detection count & lamp activation count
    public function showMonths($year) {
        $months = ObjectDetection::selectRaw('MONTH(created_at) as month, COUNT(*) as object_count, SUM(lamp_turned_on) as lamp_count')
            ->whereYear('created_at', $year)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        return view('logs.months', compact('year', 'months'));
    }

    // 📌 Show dates in a selected month
    public function showDates($year, $month) {
        $dates = ObjectDetection::selectRaw('DAY(created_at) as date, COUNT(*) as object_count, SUM(lamp_turned_on) as lamp_count')
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return view('logs.dates', compact('year', 'month', 'dates'));
    }

    // 📌 Show ESP-wise logs for a selected date
 // 📌 Show ESP-wise logs for a selected date
public function showEsps($year, $month, $date) {
    $esps = ObjectDetection::selectRaw('esp_device_id, COUNT(*) as total_detections, SUM(lamp_turned_on) as total_lamp_on')
        ->whereYear('created_at', $year)
        ->whereMonth('created_at', $month)
        ->whereDay('created_at', $date)
        ->groupBy('esp_device_id')
        ->get();

    return view('logs.esps', compact('year', 'month', 'date', 'esps'));
}


    // 📌 Show full logs with timestamps for a selected ESP
    public function showDetails($year, $month, $date, $esp_id) {
        $logs = ObjectDetection::where('esp_device_id', $esp_id)
            ->whereDate('created_at', "$year-$month-$date")
            ->orderBy('created_at', 'desc')
            ->paginate(10); // ✅ Use paginate() instead of get()
    
        return view('logs.details', compact('year', 'month', 'date', 'esp_id', 'logs'));
    }
    
}
