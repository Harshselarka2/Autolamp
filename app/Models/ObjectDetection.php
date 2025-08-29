<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObjectDetection extends Model {
    use HasFactory;
    protected $fillable = ['esp_device_id', 'object_detected', 'lamp_turned_on'];
}
