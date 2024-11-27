<?php

namespace Domain\Subscriber\Models;

use Domain\Shared\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tag extends BaseModel
{

    protected $fillable = [
        'title',
    ];

    public function subscribers()
    {
        return $this->belongsToMany(Subscriber::class);
    }
}
