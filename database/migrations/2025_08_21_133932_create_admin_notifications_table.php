<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('admin_notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId("admin_id")->constrained("admins")->cascadeOnDelete()->nullable();
            $table->foreignId("notification_id")->constrained("notifications")->cascadeOnDelete();
            $table->timestamp("read_at")->nullable();
            $table->timestamp('delivered_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('admin_notifications', callback: function (Blueprint $table): void {
            $table->dropSoftDeletes();
        });

        Schema::dropIfExists('admin_notifications');
    }
};
