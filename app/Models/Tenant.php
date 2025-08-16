<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Tenant extends Model
{
    /** @use HasFactory<\Database\Factories\TenantFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'logo',
        'favicon',
        'timezone',
        'currency',
        'language',
        'is_active',
        'user_id',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'deleted_at' => 'datetime',
    ];

    public function getSlugAttribute($value): string
    {
        return Str::slug($value);
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($tenant) {
            $tenant->slug = Str::slug($tenant->name);
        });
    }
}
