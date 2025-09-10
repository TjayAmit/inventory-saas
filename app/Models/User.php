<?php

namespace App\Models;

use App\Models\Notification\Notification;
use App\Models\Notification\UserNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, HasRoles, Notifiable;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'last_name',
        'first_name',
        'middle_name',
        'ext_name',
        'name', 
        'email',
        'password',
        'address'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function name(): string
    {
        return $this->last_name.", ".$this->first_name;
    }

    public function getRoleNamesAttribute(): array
    {
        return $this->getRoleNames()->toArray(); // Ensure array conversion
    }
    
    public function getAllPermissionsAttribute(): array
    {
        return $this->getAllPermissions()
            ->pluck('name')
            ->toArray(); // Ensure array conversion
    }

    public function notifications()
    {
        return $this->belongsToMany(Notification::class, 'user_notifications', 'user_id', 'notification_id');
    }
    
    public function toArray()
    {
        $array = parent::toArray();
        
        // Only include these if they're not already in hidden attributes
        if (!in_array('roles', $this->hidden)) {
            $array['roles'] = $this->getRoleNames()->toArray();
        }
        
        if (!in_array('permissions', $this->hidden)) {
            $array['permissions'] = $this->getAllPermissions()->pluck('name')->toArray();
        }
        
        return $array;
    }
}
