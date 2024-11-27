<?php

namespace Domain\Shared\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
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

    protected static function newFactory()
    {
        $parts = str(get_called_class())->explode('\\');
        $domain = $parts->get(1);
        $model = $parts->last();
        return app("Database\\Factories\\{$domain}\\{$model}Factory");
    }

    protected function fullname(): Attribute
    {
        return Attribute::make(
            get: fn(mixed $value, array $attributes) => "{$attributes['first_name']} {$attributes['last_name']}"
        );
    }



    public function apiTokens()
    {
        return $this->hasMany(ApiToken::class);
    }

    public function createToken(string $name): ApiToken
    {
        $plainTextToken = Str::random(60);
        $token = $this->apiTokens()->create([
            'name' => $name,
            'token' => hash('sha256', $plainTextToken),
        ]);
        $token->plainTextToken = $plainTextToken;

        return $token;
    }
}
