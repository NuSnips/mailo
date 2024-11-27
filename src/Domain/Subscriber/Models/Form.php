<?php

namespace Domain\Subscriber\Models;

use Database\Factories\Subscriber\FormFactory;
use Domain\Shared\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends BaseModel
{

    protected $fillable = ['title', 'content'];


    public function subscribers()
    {
        return $this->hasMany(Subscriber::class);
    }
}
