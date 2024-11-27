<?php

namespace Domain\Mail\Models;

use Domain\Shared\Models\BaseModel;
use Domain\Subscriber\Models\Subscriber;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SentMail extends BaseModel
{
    use HasFactory;

    public function sendable()
    {
        return $this->morphTo();
    }
}
