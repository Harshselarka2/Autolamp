<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up() {
        Schema::table('object_detections', function (Blueprint $table) {
            $table->timestamp('detected_at')->nullable()->after('esp_device_id');
        });
    }
    
    public function down() {
        Schema::table('object_detections', function (Blueprint $table) {
            $table->dropColumn('detected_at');
        });
    }
    
};
