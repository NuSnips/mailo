<?php

namespace Domain\Shared\Models;


use Domain\Shared\Models\BaseModel;
use Domain\Shared\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ApiToken extends BaseModel
{
    use HasFactory;
    protected $table = 'api_tokens';
    protected $fillable = ['name', 'token',  'last_used_at', 'expires_at'];

    public string $plainTextToken;

    protected $casts = [
        'last_used_at' => 'datetime',
        'expires_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function isExpired(): bool
    {
        return $this->expires_at->isPast();
    }
}
