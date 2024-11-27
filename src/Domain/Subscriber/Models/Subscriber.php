<?php

namespace Domain\Subscriber\Models;

use Domain\Shared\Models\BaseModel;

class Subscriber extends BaseModel
{
    protected $fillable = [
        'email',
        'first_name',
        'last_name',
        'form_id',
        'user_id'
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function form()
    {
        return $this->belongsTo(Form::class)
            ->withDefault();
    }
}
