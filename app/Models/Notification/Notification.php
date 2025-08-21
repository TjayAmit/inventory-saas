<?php

namespace App\Models\Notification;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Notification extends Model
{
    /** @use HasFactory<\Database\Factories\NotificationFactory> */
    use HasFactory;

    protected $fillable = [
        "title",
        "message",
        "type",
        "action_url",
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_notifications');
    }

    public function admins()
    {
        return $this->belongsToMany(Admin::class, 'admin_notifications');
    }
}
