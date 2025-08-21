<?php

namespace App\Models;

use App\Models\Notification\AdminNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
    use HasFactory, HasRoles, Notifiable;

    protected $guard_name = 'admin';

    protected $fillable = [
        'name',
        'email',
        'password',
        'is_super_admin',
        'is_active',
        'last_login_at',
        'last_login_ip',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
        'is_super_admin' => 'boolean',
        'is_active' => 'boolean',
        'last_login_at' => 'datetime'
    ];

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
        return $this->hasMany(AdminNotification::class);
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
