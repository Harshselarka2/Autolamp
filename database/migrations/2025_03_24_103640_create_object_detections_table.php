<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('object_detections', function (Blueprint $table) {
            $table->id();
            $table->integer('esp_device_id');
            $table->boolean('object_detected');
            $table->boolean('lamp_turned_on');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('object_detections');
    }
};
